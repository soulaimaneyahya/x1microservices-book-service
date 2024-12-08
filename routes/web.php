<?php

/** @var \Laravel\Lumen\Routing\Router $router */


$router->get('/books', 'BookController@index');
$router->get('/books/{bookId}', 'BookController@show');

$router->get('/', function () use ($router) {
    return $router->app->version();
});
