<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//public part
 $routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('contactus', 'Home::contactus');
$routes->get('membership', 'Home::membership');

//login part
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::loginSubmit');

//register part
$routes->get('/register', 'registerController::index');
$routes->post('register/process', 'registerController::process');

//logout part
$routes->get('logout', 'AuthController::logout');

//admin part
$routes->get('/dashboard/admin', 'AdminController::admin');

//member part
$routes->get('/dashboard/member', 'DashboardController::member');

// $routes->get('/admin/add', 'Admin::addAdminForm');       // Show form
// $routes->post('/admin/add', 'Admin::saveAdmin');         // Process form
// $routes->get('/admin/edit/(:num)', 'Admin::editAdminForm/$1'); // Edit form
// $routes->post('/admin/update/(:num)', 'Admin::updateAdmin/$1'); // Save changes
// $routes->get('/admin/delete/(:num)', 'Admin::deleteAdmin/$1'); // Delete admin
// $routes->get('/admin', 'Admin::dashboard');

//admin part
$routes->get('/dashboard/admin', 'AdminController::admin');

$routes->get('/admin/manage-admin', 'AdminController::manageAdmin');
$routes->get('admin/dashboard', 'AdminController::dashboard');





