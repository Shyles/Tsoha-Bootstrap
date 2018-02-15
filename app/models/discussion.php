<?php

class Discussion extends BaseModel {

    public $id, $reader_id, $topic_id, $topic, $locked, $published;

    public function _construct($attributes) {
        parent::_construct($attributes);
    }

    private static function all_base($sql, $id = false) {
        $query = DB::connection();
        $id ? $query->prepare(array('id' => $id)) : $query->prepare($sql);
        $query->execute();
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

}
