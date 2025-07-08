<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
//public part
$routes->get('/welcome_message', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('contactus', 'Home::contactus');
$routes->get('membership', 'Home::membership');

$routes->get('/merchandise', 'Home::merchandise');

$routes->get('/earn_redeem', 'Home::earnRedeem');


$routes->get('/trainers', 'Home::trainers');

//login part
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::loginSubmit');

//register part
$routes->get('/register', 'registerController::index');
$routes->post('register/process', 'registerController::process');

//logout part
$routes->get('logout', 'AuthController::logout');

//admin part
$routes->get('admin/dashboard', 'AdminController::dashboard');
$routes->get('dashboard/admin', 'AdminController::dashboard');

$routes->get('/admin/manage-admin', 'AdminController::manageAdmin');


// Admin CRUD routes
$routes->get('/admin/get-admins', 'AdminController::getAdmins');
$routes->post('/admin/create-admin', 'AdminController::createAdmin');
$routes->post('/admin/update-admin', 'AdminController::updateAdmin');
$routes->post('/admin/delete-admin', 'AdminController::deleteAdmin');

// $routes->get('/admin/add', 'Admin::addAdminForm');       // Show form
// $routes->post('/admin/add', 'Admin::saveAdmin');         // Process form
// $routes->get('/admin/edit/(:num)', 'Admin::editAdminForm/$1'); // Edit form
// $routes->post('/admin/update/(:num)', 'Admin::updateAdmin/$1'); // Save changes
// $routes->get('/admin/delete/(:num)', 'Admin::deleteAdmin/$1'); // Delete admin
// $routes->get('/admin', 'Admin::dashboard');

//member part
$routes->get('/dashboard/member', 'MemberController::memberDashboard');
$routes->get('/shop', 'MemberController::shop');
$routes->get('/membership', 'MemberController::membership');
$routes->get('/buy-membership', 'MemberController::buyMembership');
$routes->get('/classes', 'MemberController::classes');
$routes->post('/book-class', 'MemberController::bookClass');
$routes->post('/purchase-membership', 'MemberController::purchaseMembership');
$routes->post('/purchase-merchandise', 'MemberController::purchaseMerchandise');

// Cart routes
$routes->post('/add-to-cart', 'MemberController::addToCart');
$routes->get('/cart', 'MemberController::viewCart');
$routes->post('/update-cart', 'MemberController::updateCart');
$routes->post('/remove-from-cart', 'MemberController::removeFromCart');
$routes->post('/checkout', 'MemberController::checkout');
$routes->post('/place-order', 'MemberController::placeOrder');

// Redeem routes
$routes->post('/redeem-merchandise', 'MemberController::redeemMerchandise');

// Order history route
$routes->get('/order-history', 'MemberController::orderHistory');

// Point routes
$routes->post('member/pointCheckout', 'MemberController::pointCheckout');
$routes->post('member/confirmPointRedemption', 'MemberController::confirmPointRedemption');

$routes->get('/admin/manage-membership', 'AdminController::manageMembership');
$routes->post('/admin/create-membership', 'AdminController::createMembership');
$routes->post('/admin/update-membership', 'AdminController::updateMembership');
$routes->post('/admin/delete-membership', 'AdminController::deleteMembership');

$routes->get('/admin/manage-trainer', 'AdminController::manageTrainer');
$routes->post('/admin/create-trainer', 'AdminController::createTrainer');
$routes->post('/admin/update-trainer', 'AdminController::updateTrainer');
$routes->post('/admin/delete-trainer', 'AdminController::deleteTrainer');

$routes->get('/admin/manage-class', 'AdminController::manageClass');
$routes->get('/admin/get-class', 'AdminController::getClass');
$routes->post('/admin/create-class', 'AdminController::createClass');
$routes->post('/admin/update-class', 'AdminController::updateClass');
$routes->post('/admin/delete-class', 'AdminController::deleteClass');

$routes->get('/admin/manage-schedule', 'AdminController::manageSchedule');
$routes->post('/admin/create-schedule', 'AdminController::createSchedule');
$routes->post('/admin/update-schedule', 'AdminController::updateSchedule');
$routes->post('/admin/delete-schedule', 'AdminController::deleteSchedule');
$routes->get('/admin/get-schedule', 'AdminController::getSchedule');

$routes->get('/admin/manage-merchandise', 'AdminController::manageMerchandise');
$routes->post('/admin/create-merchandise', 'AdminController::createMerchandise');
$routes->post('/admin/update-merchandise', 'AdminController::updateMerchandise');
$routes->post('/admin/delete-merchandise', 'AdminController::deleteMerchandise');





