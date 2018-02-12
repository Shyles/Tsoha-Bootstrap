<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null, $validators = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
      $this->validators = array('validate_first_name', 'validate_last_name', 'validate_user_name', 'validate_e_mail', 'validate_password');;
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();
        
    foreach($this->validators as $validator){
        $errors[] = $this->{$validator}();
    }

      return $errors;
    }
    
    public function validate_string_length($string, $min, $max) {
        $errors = array();
        if ($string == null) {
                $errors[] = 'Nimi ei saa olla tyhjä!';
        } else if (strlen($string) < $min) {
                $errors[] = 'Merkkijono on liian lyhyt!';
        } else if (strlen($string) > $max) {
                $errors[] = 'Merkkijono on liian pitkä!';
        }
        return $errors;
    }

  }
