<?php

class Discussion extends BaseModel {

    public $id, $reader_id, $topic_id, $topic, $locked, $published;

    public function _construct($attributes) {
        parent::_construct($attributes);
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
                'published' => $row['published']
            ));
        }
        return $discussions;
    }
    
    public static function all() {
        return Discussion::all_base('SELECT * FROM Discussion');
    }
    
    public static function all_for_topic($id) {
        return Discussion::all_base('SELECT * FROM Discussion WHERE topic_id = :id', $id);
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
        $query = DB::connection()->prepare('INSERT INTO Discussion (topic, reader_id, topic_id) VALUES (:topic, :reader_id, :topic_id) RETURNING id');
        $query->execute(array('topic' => $this->topic, 'reader_id' => $this->reader_id, 'topic_id' => $this->topic_id));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

}
