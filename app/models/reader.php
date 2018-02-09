<?php

class Reader extends BaseModel
{
    public $id, $password, $first_name, $last_name, $moderator;

    public function _construct($attributes)
    {
        parent::_construct($attributes);
    }

    public static function all()
    {
        $query = DB::connection()->prepare('SELECT * FROM Reader');
        $query->execute();
        $rows = $query->fetchAll();
        $readers = array();

        foreach ($rows as $row) {
            $readers[] = new Reader(array(
                'id' => $row['id'],
                'password' => $row['password'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'moderator' => $row['moderator']
            ));
        }
        return $readers;
    }

    public static function find($id)
    {
        $query = DB::connection()->prepare('SELECT * FROM Reader WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $reader = new Reader(array(
                'id' => $row['id'],
                'password' => $row['password'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'moderator' => $row['moderator']
            ));
            return $reader;
        }
        return null;
    }

}