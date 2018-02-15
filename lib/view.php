<?php

  class View{

    public static function make($view, $content = array()){
      // Alustetaan Twig
      $twig = self::get_twig();

      try{
        // Asetetaan uudelleenohjauksen yhteydessä lisätty viesti
        self::set_flash_message($content);

        // Asetetaan näkymään base_path-muuttuja index.php:ssa määritellyllä BASE_PATH vakiolla
        $content['base_path'] = BASE_PATH;
        $content['reader_path'] = READER_PATH;
        $content['reader_update_path'] = READER_UPDATE_PATH;
        $content['reader_destroy_path'] = READER_DESTROY_PATH;
        $content['reader_new_path'] = READER_NEW_PATH;
        $content['discussion_path'] = DISCUSSION_PATH;
        $content['discussion_update_path'] = DISCUSSION_UPDATE_PATH;
        $content['discussion_destroy_path'] = DISCUSSION_DESTROY_PATH;
        $content['discussion_new_path'] = DISCUSSION_NEW_PATH;
        $content['logout_path'] = LOGOUT_PATH;
        $content['login_path'] = LOGIN_PATH;

            // Asetetaan näkymään kirjautunut käyttäjä, jos get_user_logged_in-metodi on toteutettu
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
