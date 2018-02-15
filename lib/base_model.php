<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();
        
    foreach($this->validators as $validator){
        $errors = array_merge($this->{$validator}(), $errors);
    }

      return $errors;
    }
    
    public function validate_string_length($string, $min, $max, $column) {
        $errors = array();
        if ($string == null) {
                $errors[] = $column . ' ei saa olla tyhjä!';
        } else if (strlen($string) < $min) {
                $errors[] = $column . ' on liian lyhyt, sen on oltava vähintään ' . $min . ' merkkiä pitkä!';
        } else if (strlen($string) > $max) {
                $errors[] = $column . ' on liian pitkä, sen on oltava enintään ' . $max . ' merkkiä pitkä!';
        }
        return $errors;
    }

  }
