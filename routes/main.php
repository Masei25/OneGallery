<?php

#Use the router module

use App\Controllers\CubeController;
use Cube\Router\Router;

#Create instance of router
$router = new Router();

#Add routes
$router->any('/', 'CubeController.home')->name('home');

$router->post('/login', 'CubeController.login')->name('login');

$router->post('/register', 'CubeController.register')->name('home');

$router->get('/dashboard', 'dashboard')->name('dashboard');

