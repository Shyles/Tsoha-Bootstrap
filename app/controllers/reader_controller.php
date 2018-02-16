<?php

class ReaderController extends BaseController{
    public static function index() {
        self::check_logged_in();
        $readers = Reader::all();
        View::make('reader/index.html', array('readers' => $readers));
    }
    
    public static function create() {
        View::make('reader/new.html');
    }
    
    public static function destroy($id) {
        self::check_logged_in();
        $reader = new Reader(array('id' => $id));
        $result = $reader->destroy($id);
        Redirect::to('/reader', array('message' => 'Käyttäjä on poistettu onnistuneesti!'));
    }
    
    public static function store() {
        $params = $_POST;
        $attributes = array(
        'password' => $params['password'],
        'first_name' => $params['first_name'],
        'last_name' => $params['last_name'],
        'e_mail' => $params['e_mail'],
        'user_name' => $params['user_name']);
        
        $reader = new Reader($attributes);
        $validator_errors = $reader->errors();
        if (count($validator_errors) == 0) {
            $reader->save();
            if (isset($_SESSION['user'])) {
                Redirect::to('/reader/' . $reader->id, array('message' => 'Käyttäjä ' . $reader->user_name . ' on lisätty kantaan'));
            } else {
                Redirect::to('/reader/login', array('message' => 'Käyttäjä ' . $reader->user_name . ' on lisätty kantaan. Voit nyt kirjautua sisään!'));
            }
        } else {
            View::make('reader/new.html', array('validator_errors' => $validator_errors, 'attributes' => $attributes));
        }
        
    }
    
    public static function show($id) {
        self::check_logged_in();
        $reader = Reader::find($id);
        $comments = $reader->comments();
        View::make('reader/show.html', array('reader' => $reader, 'comments' => $comments));
    }
    
    public static function show_update($id) {
        self::check_logged_in();
        $reader = Reader::find($id);
        View::make('reader/update.html', array('reader' => $reader));
    }

    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;
        $original_reader = Reader::find($id);
        $reader = new Reader(array(
            'id' => $id,
            'password' => isset($params['password']) ? $params['password'] : $original_reader->password,
            'first_name' => isset($params['first_name']) ? $params['first_name'] : $original_reader->first_name,
            'last_name' => isset($params['last_name']) ? $params['last_name'] : $original_reader->last_name,
            'moderator' => isset($params['moderator']) ? $params('moderator') : $original_reader->moderator,
            'e_mail' => isset($params['e_mail']) ? $params['e_mail'] : $original_reader->e_mail,
            'user_name' => isset($params['user_name']) ? $params['user_name'] : $original_reader->user_name
        ));
        $reader->update();
        Redirect::to('/reader/' . $reader->id, array('message' => 'käyttäjää '.$reader->user_name.' on muokattu onnistuneesti'));
    }
    
    public static function show_login() {
        View::make('reader/login.html');
    }
    
    public static function login() {
        $params = $_POST;
        $reader = Reader::authenticate($params['password'], $params['username']);
        if ($reader) {
            $_SESSION['user'] = $reader->id;
            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $reader->user_name . '!'));
        } else {
            View::make('reader/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        }        
    }
    
    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/', array('message' => 'Uloskirjautuminen onnistui'));
    }
}