<?php

class Discussion extends BaseModel {

    public $id, $reader_id, $topic_id, $topic, $locked, $published;

    public function _construct($attributes) {
        parent::_construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM discussion');
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

}
