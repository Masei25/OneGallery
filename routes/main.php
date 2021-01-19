<?php

#Use the router module

use App\Controllers\CubeController;
use Cube\Router\Router;

#Create instance of router
$router = new Router();

#Add routes
$router->any('/', 'CubeController.home');

$router->group()->register(function(Router $router){
    $router->post('/login', 'CubeController.login')->name('login');

    $router->get('/register', '@register');

    $router->post('/register', 'CubeController.register');
});




$router->get('/dashboard', 'dashboard')->name('dashboard');

