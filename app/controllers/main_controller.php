<?php

  class MainController extends BaseController{

    public static function index(){
        $topics = isset($_SESSION['user']) ? Topic::all_for_reader(self::get_user_logged_in()->id) :Topic::all();
        View::make('discussion/index.html', array('topics' => $topics));
    }
    
    public static function category() {
        View::make('category.html');
    }
    
    public static function discussion() {
        View::make('discussion.html');
    }
    
    public static function comment() {
        View::make('comment.html');
    }
    
    public static function reader() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('reader.html');
    }
 
    public static function login() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('login.html');
    }

    public static function sandbox(){
        $comment = Comment::all_for_discussion(1);
        Kint::dump($comment);

    }
  }
