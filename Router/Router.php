<?php

$router->get('/home', 'home@index');

$router->get('/users', 'home@index');

$router->post('/users', 'home@index');

$router->get('/tasks', 'home@index');

$router->post('/tasks', 'home@uploadImage');


$router->get('/', function() {
    echo 'Welcome ';
});