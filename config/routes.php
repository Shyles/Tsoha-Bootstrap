<?php
    
  $routes->get('/', function() {
    MainController::index();
  });
  
  $routes->get('/category', function() {
      MainController::category();
  });
  
  $routes->post('/reader/:id/destroy', function($id) {
    ReaderController::destroy($id);  
  });
  
  $routes->get('/reader/update/:id', function($id) {
    ReaderController::show_update($id);
  });

  $routes->post('/reader/update/:id', function($id) {
    ReaderController::update($id);
  });
  
  $routes->get('/reader/logout', function() {
      ReaderController::logout(); 
  });
  
    $routes->get('/reader/login', function() {
    ReaderController::show_login();
  });

  $routes->post('/reader/login', function() {
    ReaderController::login();
  });

  $routes->get('/reader', function() {
    ReaderController::index();
  });
  
  $routes->get('/reader/new', function() {
    ReaderController::create();
  });

  $routes->post('/reader', function() {
     ReaderController::store(); 
  });

  $routes->get('/reader/:id', function($id) {
    ReaderController::show($id);
  });

  $routes->get('/discussion', function() {
      MainController::discussion();
  });

  $routes->get('/comment', function() {
      MainController::comment();
  });
  

$routes->get('/hiekkalaatikko', function() {
      MainController::sandbox();
  });
