<?php

// action là callback

$router->get('/', function() {
  echo "home page";
});

// post
// $router->get('/post', 'PostController@index');
// $router->get('/post/create', 'PostController@create');
// $router->post('/post', 'PostController@store');
$router->get('/post/{id}', 'PostController@show');
$router->get('/post/{id}/edit', 'PostController@edit');
// $router->update('/post/{id}', 'PostController@update');
// $router->delete('/post/{id}', 'PostController@destroy');

// $router->get('/post', 'PostController@store');
// $router->get('/post', 'PostController@store');
// $router->get('/category', 'CategoryController@index');