<?php

class Reader extends BaseModel
{
    public $id, $password, $first_name, $last_name, $moderator, $e_mail, $user_name;

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
                'moderator' => $row['moderator'],
                'e_mail' => $row['e_mail'],
                'user_name' => $row['user_name']
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
                'moderator' => $row['moderator'],
                'e_mail' => $row['e_mail'],
                'user_name' => $row['user_name']
            ));
            return $reader;
        }
        return null;
    }
    
    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE FROM Reader where id = :id');
        $query->execute(array('id' => $id));
    }
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Reader (first_name, last_name, e_mail, password, user_name) VALUES (:first_name, :last_name, :e_mail, :password, :user_name) RETURNING id');
        $query->execute(array('first_name' => $this->first_name, 'last_name' => $this->last_name, 'e_mail' => $this->e_mail, 'password' => $this->password, 'user_name' => $this->user_name));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE Reader SET first_name = :first_name, last_name = :last_name, e_mail = :e_mail, user_name = :user_name, password = :password WHERE id = :id RETURNING id');
        $query->execute(array('id'=> $this->id, 'first_name' => $this->first_name, 'last_name' => $this->last_name, 'e_mail' => $this->e_mail, 'password' => $this->password, 'user_name' => $this->user_name));
    }
    
    public static function authenticate($password, $username) {
        $query = DB::connection()->prepare('SELECT * FROM Reader where password = :password and user_name = :username LIMIT 1');
        $query->execute(array('password' => $password, 'username' => $username));
        $row = $query->fetch();
        
        if ($row) {
            return new Reader(array(
                'user_name' => $row['user_name'],
                'id' => $row['id']
            ));
        } else {
            return null;
        }
    }

}