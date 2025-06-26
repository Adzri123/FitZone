<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');

$routes->get('contactus', 'Home::contactus');


$routes->get('welcome_message', 'Home::index');


$routes->get('membership', 'Home::membership');

$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::loginSubmit');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/dashboard/member', 'DashboardController::member');
$routes->get('/dashboard/admin', 'DashboardController::admin');

$routes->get('/register', 'registerController::index');
$routes->post('register/process', 'registerController::process');

$routes->get('/admin/add', 'Admin::addAdminForm');       // Show form
$routes->post('/admin/add', 'Admin::saveAdmin');         // Process form
$routes->get('/admin/edit/(:num)', 'Admin::editAdminForm/$1'); // Edit form
$routes->post('/admin/update/(:num)', 'Admin::updateAdmin/$1'); // Save changes
$routes->get('/admin/delete/(:num)', 'Admin::deleteAdmin/$1'); // Delete admin
$routes->get('/admin', 'Admin::dashboard');
$routes->get('/admin/manage-admin', 'DashboardController::manageAdmin');





