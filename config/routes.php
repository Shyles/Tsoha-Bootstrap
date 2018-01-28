<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });
  
  $routes->get('/category', function() {
      CategoryController::index();
  });
  
    
  $routes->get('/discussion', function() {
    DiscussionController::index();
  });

  
    
  $routes->get('/comment', function() {
    CommentController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
