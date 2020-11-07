<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->get('/key', function () {
    return str_random(32);
});
$router->get('/foo', 'BooksController@index');
$router->get('/books/{id}', 'BooksController@getdataid');
$router->post('books', 'BooksController@store');
$router->put('books/{id}', 'BooksController@update');
$router->delete('books/{id}', 'BooksController@destroy');

$router->get('/authors', 'BooksController@authors');
$router->get('/authors/{id}', 'BooksController@authorsid');
$router->post('/authors', 'BooksController@authorsadd');
$router->put('/authors/{id}', 'BooksController@authorsupdate');
$router->delete('/authors/{id}', 'BooksController@authorsdestroy');

