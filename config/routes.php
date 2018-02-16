<?php
    
  $routes->get('/', function() {
    MainController::index();
  });
  
  $routes->get('/category', function() {
      MainController::category();
  });
  
  $routes->post('/reader/destroy/:id', function($id) {
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
      DiscussionController::index();
  });
  
  $routes->get('/discussion/new', function() {
      DiscussionController::create(); 
  });
  
  $routes->get('/discussion/:id', function($id) {
    DiscussionController::show($id);
  });
  
  $routes->post('/discussion', function() {
    DiscussionController::store();
  });
  
  $routes->post('/comment', function($id) {
    CommentController::create($id);
  });


  $routes->get('/hiekkalaatikko', function() {
      MainController::sandbox();
  });
