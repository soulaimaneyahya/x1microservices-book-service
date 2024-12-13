<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/books', 'BookController@index');
$router->post('/books', 'BookController@store');
$router->get('/books/{bookId}', 'BookController@show');
$router->put('/books/{bookId}', 'BookController@update');
$router->delete('/books/{bookId}', 'BookController@destroy');

$router->get('/', function () use ($router) {
    return $router->app->version();
});
