<?php

#Use the router module

use App\Controllers\CubeController;
use Cube\Router\Router;

#Create instance of router
$router = new Router();

#Add routes
$router->any('/', 'CubeController.home');


$router->get('/login', '@login');
$router->post('/login', 'CubeController.login')->name('login');
$router->post('/register', 'CubeController.register')->name('register');

