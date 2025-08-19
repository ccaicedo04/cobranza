<?php
$router->get('/', function () {
    Response::redirect(View::route('login'));
});

$router->get('/login', 'AuthController@showLogin');
$router->post('/login', 'AuthController@login');
$router->get('/logout', 'AuthController@logout');
$router->get('/dashboard', 'DashboardController@index');
