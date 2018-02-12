<?php

class ReaderController extends BaseController{
    public static function index() {
        $readers = Reader::all();
        View::make('reader/index.html', array('readers' => $readers));
    }
    
    public static function create() {
        View::make('reader/new.html');
    }
    
    public static function destroy($id) {
        $reader = new Reader(array('id' => $id));
        $result = $reader->destroy($id);
        Redirect::to('/reader', array('message' => 'Käyttäjä on poistettu onnistuneesti!'));
    }
    
    public static function store() {
        $params = $_POST;
        $reader = new Reader(array(
            'password' => isset($params['password']) ? $params['password'] : 'wololoo',
            'first_name' => $params['first_name'],
            'last_name' => $params['last_name'],
            'moderator' => isset($params['moderator']) ? $params('moderator') : false,
            'e_mail' => $params['e_mail'],
            'user_name' => $params['user_name']
        ));

        $reader->save();
        Redirect::to('/reader/' . $reader->id , array('message' => 'käyttäjä ' . $reader->user_name . ' on lisätty kantaan'));
    }
    
    public static function show($id) {
        self::check_logged_in();
        $reader = Reader::find($id);
        View::make('reader/show.html', array('reader' => $reader));
    }
    
    public static function show_update($id) {
        $reader = Reader::find($id);
        View::make('reader/update.html', array('reader' => $reader));
    }

    public static function update($id) {
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