<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');

$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::loginSubmit');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/dashboard/member', 'DashboardController::member');
$routes->get('/dashboard/admin', 'DashboardController::admin');

$routes->get('/register', 'registerController::index');
$routes->post('register/process', 'registerController::process');



