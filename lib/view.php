<?php

  class View{

    public static function make($view, $content = array()){
      // Alustetaan Twig
      $twig = self::get_twig();

      try{
        // Asetetaan uudelleenohjauksen yhteydessä lisätty viesti
        self::set_flash_message($content);

        // Asetetaan näkyiin yleisiä polkumuuttujia
        $content['base_path'] = BASE_PATH;
        $content['reader_path'] = READER_PATH;
        $content['reader_update_path'] = READER_UPDATE_PATH;
        $content['reader_destroy_path'] = READER_DESTROY_PATH;
        $content['reader_new_path'] = READER_NEW_PATH;
        $content['discussion_path'] = DISCUSSION_PATH;
        $content['discussion_update_path'] = DISCUSSION_UPDATE_PATH;
        $content['discussion_destroy_path'] = DISCUSSION_DESTROY_PATH;
        $content['discussion_new_path'] = DISCUSSION_NEW_PATH;
        $content['comment_path'] = COMMENT_PATH;
        $content['comment_update_path'] = COMMENT_UPDATE_PATH;
        $content['comment_destroy_path'] = COMMENT_DESTROY_PATH;
        $content['comment_new_path'] = COMMENT_NEW_PATH;
        $content['topic_path'] = TOPIC_PATH;
        $content['topic_update_path'] = TOPIC_UPDATE_PATH;
        $content['topic_destroy_path'] = TOPIC_DESTROY_PATH;
        $content['topic_new_path'] = TOPIC_NEW_PATH;
        $content['reader_topic_path'] = READER_TOPIC_PATH;
        $content['reader_topic_new_path'] = READER_TOPIC_NEW_PATH;
        $content['reader_topic_destroy_path'] = READER_TOPIC_DESTROY_PATH;
        $content['logout_path'] = LOGOUT_PATH;
        $content['login_path'] = LOGIN_PATH;

        if(method_exists('BaseController', 'get_user_logged_in')){
          $content['user_logged_in'] = BaseController::get_user_logged_in();
        }

        // Tulostetaan Twig:n renderöimä näkymä
        echo $twig->render($view, $content);
      } catch (Exception $e){
        die('Virhe näkymän näyttämisessä: ' . $e->getMessage());
      }

      exit();
    }

    private static function get_twig(){
      Twig_Autoloader::register();

      $twig_loader = new Twig_Loader_Filesystem('app/views');

      return new Twig_Environment($twig_loader);
    }

    private static function set_flash_message(&$content){
      if(isset($_SESSION['flash_message'])){

        $flash = json_decode($_SESSION['flash_message']);

        foreach($flash as $key => $value){
          $content[$key] = $value;
        }

        unset($_SESSION['flash_message']);
      }
    }

  }
