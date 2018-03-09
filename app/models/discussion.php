<?php

class Discussion extends BaseModel {

    public $id, $reader_id, $topic_id, $topic, $locked, $published, $username;

    public function _construct($attributes) {
        parent::_construct($attributes);
        $this->validators = array('validate_topic');
    }
    
    public  function validate_topic() {
        return $this->validate_string_length($this->topic, 5, 100, 'otsikko');
    }

    private static function all_base($sql, $id = false) {
        $query = DB::connection()->prepare($sql);
        $id ? $query->execute(array('id' => $id)) : $query->execute();
        $rows = $query->fetchAll();
        $discussions = array();

        foreach ($rows as $row) {
            $discussions[] = new discussion(array(
                'id' => $row['id'],
                'reader_id' => $row['reader_id'],
                'topic_id' => $row['topic_id'],
                'topic' => $row['topic'],
                'locked' => $row['locked'],
                'published' => $row['published'],
                'username' => isset($row['username']) ? $row['username'] : ''
            ));
        }
        return $discussions;
    }
    
    public static function all() {
        return Discussion::all_base('SELECT * FROM Discussion');
    }
    
    public static function all_for_topic($id) {
        return Discussion::all_base('SELECT d.id, d.reader_id, d.topic_id, d.topic, d.locked, d.published, r.user_name as username FROM Discussion as d JOIN Reader as r ON d.reader_id = r.id  WHERE topic_id = :id', $id);
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM discussion WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $discussion = new discussion(array(
                'id' => $row['id'],
                'reader_id' => $row['reader_id'],
                'topic_id' => $row['topic_id'],
                'topic' => $row['topic'],
                'locked' => $row['locked'],
                'published' => $row['published']
            ));
            return $discussion;
        }
        return null;
    }
  
    public function comments() {
        return Comment::all_for_discussion($this->id);
    }
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Discussion (topic, reader_id, topic_id, published) VALUES (:topic, :reader_id, :topic_id, now()) RETURNING id');
        $query->execute(array('topic' => $this->topic, 'reader_id' => $this->reader_id, 'topic_id' => $this->topic_id));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

}
