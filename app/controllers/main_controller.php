<?php

  class MainController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('home.html');
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
      // Testaa koodiasi täällä
        View::make('helloworld.html');
    }
  }
