<?php

#Use the router module

use App\Controllers\CubeController;
use Cube\Router\Router;

#Create instance of router
$router = new Router();

#Add routes
$router->get('/', 'CubeController.home');

$router->group()->register(function(Router $router){
    $router->post('/', 'CubeController.login');

    $router->get('/register', '@register');

    $router->post('/register', 'CubeController.register');
});

$router->group('/dashboard')->namespace('Dashboard')->register(function(Router $router){
    $router->get('/', 'MainController.index');
});  

