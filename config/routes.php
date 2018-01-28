<?php

  $routes->get('/', function() {
    MainController::index();
  });
  
  $routes->get('/category', function() {
      MainController::category();
  });
  
    $routes->get('/reader', function() {
    MainController::reader();
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
