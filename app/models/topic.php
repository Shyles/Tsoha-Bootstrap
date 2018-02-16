<?php

class Topic extends BaseModel {
    public $id, $topic, $discussions;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array();
    }
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Topic');
        $query->execute();
        $rows = $query->fetchAll();
        $topics = array();

        foreach ($rows as $row) {
            $topic = new Topic(array(
                'id' => $row['id'],
                'topic' => $row['topic']
            ));
            $topic->discussions = $topic->discussions();
            $topics[] = $topic;
        }
        return $topics;
    }
    
    public function discussions() {
        Discussion::all_for_topic($this->id);
    }
}