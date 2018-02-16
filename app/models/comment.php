<?php

class Comment extends BaseModel {
    public $id, $discussion_id, $comment, $published, $discussion_topic, $username;

    public static $base_sql = 'SELECT c.id, c.discussion_id, c.comment, c.published, d.topic as discussion_topic, r.user_name as username  FROM Comment as c JOIN Discussion as d ON c.discussion_id = d.id JOIN Reader as r ON c.reader_id = r.id ';
    
    public function _construct($attributes) {
        parent::_construct($attributes);
    }
    
    public static function save() {
        $query = DB::connection();
        $query->prepare('INSERT INTO Comment (discussion_id, reader_id, comment, published) VALUES (:discussion_id, :reader_id, :comment, :published) RETURNING ID');
        $query->execute;
        return $query->fetch();
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare(self::$base_sql . 'WHERE c.id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $comment = new Comment(array(
                'id' => $row['id'],
                'discussion_id' => $row['discussion_id'],
                'comment' => $row['comment'],
                'published' => $row['published'],
                'discussion_topic' => $row['discussion_topic'],
                'username' => $row['username']
            ));
            return $comment;
        }
        return null;
    }
    
    private static function all_base($sql, $id = false) {
        $query = DB::connection()->prepare($sql);
        $id ? $query->execute(array('id' => $id)) : $query->execute();
        $rows = $query->fetchAll();
        $comments = array();

        foreach ($rows as $row) {
            $comments[] = new Comment(array(
                'id' => $row['id'],
                'discussion_id' => $row['discussion_id'],
                'comment' => $row['comment'],
                'published' => $row['published'],
                'discussion_topic' => $row['discussion_topic'],
                'username' => $row['username']
            ));
        }
        return $comments;
    }
    
    public static function all() {
        return Comment::all_base(self::$base_sql);
    }
    
    public static function all_for_reader($id) {
        return Comment::all_base(self::$base_sql . 'where c.reader_id = :id', $id);
    }
    
    public static function all_for_discussion($id) {
        return Comment::all_base(self::$base_sql . 'where c.discussion_id = :id', $id);
    }
}

