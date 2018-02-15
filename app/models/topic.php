<?php

class Topic extends BaseModel {
    public $id, $topic;
    
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
            $topics[] = new Topic(array(
                'id' => $row['id'],
                'topic' => $row['topic']
            ));
        }
        return $topics;
    }
    
    public static function discussions() {
        Comment::all_for_discussion($this->id);
    }
}