<?php

  // Laitetaan virheilmoitukset näkymään
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  // Selvitetään, missä kansiossa index.php on
  $script_name = $_SERVER['SCRIPT_NAME'];
  $explode =  explode('/', $script_name);

  if($explode[1] == 'index.php'){
    $base_folder = '';
  }else{
    $base_folder = $explode[1];
  }

  // Määritetään sovelluksen juuripolulle vakio BASE_PATH
  define('BASE_PATH', '/' . $base_folder);
  define('READER_PATH', BASE_PATH . '/reader');
  define('READER_UPDATE_PATH', READER_PATH . '/update/');
  define('READER_DESTROY_PATH', READER_PATH . '/destroy/');
  define('READER_NEW_PATH', READER_PATH . '/new');
  define('DISCUSSION_PATH', BASE_PATH . '/discussion');
  define('DISCUSSION_UPDATE_PATH', DISCUSSION_PATH . '/update/');
  define('DISCUSSION_DESTROY_PATH', DISCUSSION_PATH . '/destroy/');
  define('DISCUSSION_NEW_PATH', DISCUSSION_PATH . '/new');
  define('COMMENT_PATH', BASE_PATH . '/comment');
  define('COMMENT_UPDATE_PATH', COMMENT_PATH . '/update/');
  define('COMMENT_DESTROY_PATH', COMMENT_PATH . '/destroy/');
  define('COMMENT_NEW_PATH', COMMENT_PATH . '/new');
  define('TOPIC_PATH', BASE_PATH . '/topic');
  define('TOPIC_UPDATE_PATH', TOPIC_PATH . '/update/');
  define('TOPIC_DESTROY_PATH', TOPIC_PATH . '/destroy/');
  define('TOPIC_NEW_PATH', TOPIC_PATH . '/new');
  define('READER_TOPIC_PATH', BASE_PATH . '/reader_topic');
  define('READER_TOPIC_NEW_PATH', READER_TOPIC_PATH . '/new');
  define('READER_TOPIC_DESTROY_PATH', READER_TOPIC_PATH . '/destroy/');
  define('LOGIN_PATH', '/' . $base_folder . '/reader/login');
  define('LOGOUT_PATH', '/' . $base_folder . '/reader/logout');
  
// Luodaan uusi tai palautetaan olemassaoleva sessio
  if(session_id() == '') {
    session_start();
  }

  // Asetetaan vastauksen Content-Type-otsake, jotta ääkköset näkyvät normaalisti
  header('Content-Type: text/html; charset=utf-8');

  // Otetaan Composer käyttöön
  require 'vendor/autoload.php';

  $routes = new \Slim\Slim();
  $routes->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware);

  $routes->get('/tietokantayhteys', function(){
    DB::test_connection();
  });

  // Otetaan reitit käyttöön
  require 'config/routes.php';

  $routes->run();