<?php
    
  $routes->get('/', function() {
      DiscussionController::index();
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
  
  $routes->post('/comment/new', function() {
    CommentController::create();
  });
  
  $routes->post('/reader_topic', function() {
      ReaderTopicController::store(); 
  });

  $routes->post('/reader_topic/destroy/:id', function($id) {
    ReaderTopicController::destroy($id);
  });

  $routes->get('/hiekkalaatikko', function() {
      MainController::sandbox();
  });
  
  $routes->get('/topic/new', function() {
      TopicController::create();
  });
  
  $routes->get('/topic/:id', function($id) {
    TopicController::show($id);
  });
  
  $routes->get('/topic/update/:id', function($id) {
    TopicController::show_update($id);
  });
  
  $routes->post('/topic/update/:id', function($id) {
    TopicController::update($id);
  });

  $routes->post('/topic', function() {
      TopicController::store();
  });
  
  $routes->get('/topic', function() {
    TopicController::index();
  });
