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

// //member part
// $routes->get('/dashboard/member', 'DashboardController::member');

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




