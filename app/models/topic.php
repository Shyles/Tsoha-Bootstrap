<?php

class Topic extends BaseModel {
    public $id, $topic, $discussions, $reader_topic_id;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_topic');
    }
    
    public function validate_topic() {
        return $this->validate_string_length($this->topic, 5, 100, 'otsikko');
    }
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Topic (topic) VALUES (:topic) RETURNING id');
        $query->execute(array('topic' => $this->topic));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public static function all_base($sql) {
        $query = DB::connection()->prepare($sql);
        $query->execute();
        $rows = $query->fetchAll();
        $topics = array();

        foreach ($rows as $row) {
            $topic = new Topic(array(
                'id' => $row['id'],
                'topic' => $row['topic'],
                'reader_topic_id' => isset($row['reader_topic_id']) ? $row['reader_topic_id'] : ''
            ));
            $topic->discussions = $topic->discussions();
            $topics[] = $topic;
        }
        return $topics;
    }
    
    public static function all() {
        return Topic::all_base("SELECT * FROM Topic");
    }
    
    public static function all_for_reader($reader_id) {
        return Topic::all_base("SELECT t.id, topic, ut.reader_id, ut.topic_id, ut.id as reader_topic_id FROM Topic as t JOIN ReaderTopic as ut ON t.id = ut.topic_id WHERE ut.reader_id = " . $reader_id);
    }
    
    public static function all_remaining_for_reader($reader_id) {
        return Topic::all_base("SELECT * FROM Topic as t WHERE t.id NOT IN  (SELECT DISTINCT t.id FROM Topic LEFT JOIN ReaderTopic as ut ON t.id = ut.topic_id WHERE ut.reader_id = " . $reader_id . ")");
    }

    public function discussions() {
        return Discussion::all_for_topic($this->id);
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Topic WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $topic = new Topic(array(
                'id' => $row['id'],
                'topic' => $row['topic'],
                'reader_topic_id' => isset($row['reader_topic_id']) ? $row['reader_topic_id'] : ''
            ));
            $topic->discussions = $topic->discussions();
            return $topic;
        }
        return null;
    }
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE Topic SET topic = :topic WHERE id = :id RETURNING id');
        $query->execute(array('topic' => $this->topic, 'id' => $this->id));
    }

}