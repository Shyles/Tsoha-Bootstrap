<?php

class ReaderTopic extends BaseModel {

    public $id, $topic_id, $reader_id;
    public static $base_sql = 'SELECT * FROM ReaderTopic';

    public function _construct($attributes) {
        parent::_construct($attributes);
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO ReaderTopic (topic_id, reader_id) VALUES (:topic_id, :reader_id)');
        $query->execute(array('topic_id' => $this->topic_id, 'reader_id' => $this->reader_id));
        return $query->fetch();
    }

    public static function find($id) {
        $query = DB::connection()->prepare(self::$base_sql . 'WHERE c.id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $reader_topic = new Comment(array(
                'id' => $row['id'],
                'topic_id' => $row['topic_id'],
                'reader_id' => $row['reader_id'],
            ));
            return $reader_topic;
        }
        return null;
    }

    private static function all_base($sql, $id = false) {
        $query = DB::connection()->prepare($sql);
        $id ? $query->execute(array('id' => $id)) : $query->execute();
        $rows = $query->fetchAll();
        $reader_topics = array();

        foreach ($rows as $row) {
            $reader_topics[] = new ReaderTopic(array(
                'id' => $row['id'],
                'topic_id' => $row['topic_id'],
                'reader_id' => $row['reader_id'],
            ));
        }
        return $reader_topics;
    }

    public static function all() {
        return ReaderTopic::all_base(self::$base_sql);
    }

    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE FROM ReaderTopic where id = :id');
        $query->execute(array('id' => $id));
    }

}
