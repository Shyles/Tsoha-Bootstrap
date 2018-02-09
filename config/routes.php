<?php

  $routes->get('/', function() {
    MainController::index();
  });
  
  $routes->get('/category', function() {
      MainController::category();
  });
  
<<<<<<< HEAD
    $routes->get('/reader', function() {
    MainController::reader();
=======
  $routes->get('/reader', function() {
    ReaderController::index();
  });

  $routes->get('/reader/:id', function($id) {
    ReaderController::show($id);
>>>>>>> kaikki tähän mennessä
  });

  $routes->get('/discussion', function() {
      MainController::discussion();
  });

    $routes->get('/login', function() {
    MainController::login();
  });

  $routes->get('/comment', function() {
      MainController::comment();
  });

  $routes->get('/hiekkalaatikko', function() {
      MainController::sandbox();
  });
