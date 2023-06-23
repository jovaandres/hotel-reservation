<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// Authentication
$routes->get('/login', 'Authentication::login');
$routes->post('/login', 'Authentication::attemptLogin');
$routes->get('/register', 'Authentication::register');
$routes->post('/register', 'Authentication::attemptRegister');

$routes->get('/user/', 'User::index');
$routes->get('/user/(:num)', 'User::show/$1');
$routes->post('/user/', 'User::create');
$routes->put('/user/(:num)', 'User::update/$1');
$routes->delete('/user/(:num)', 'User::delete/$1');

$routes->get('/hotel/', 'Hotel::index');
$routes->get('/hotel/(:num)', 'Hotel::show/$1');
$routes->post('/hotel/', 'Hotel::create');
$routes->put('/hotel/(:num)', 'Hotel::update/$1');
$routes->delete('/hotel/(:num)', 'Hotel::delete/$1');

$routes->get('/review/', 'Review::index');
$routes->get('/review/(:num)', 'Review::show/$1');
$routes->post('/review/', 'Review::create');
$routes->put('/review/(:num)', 'Review::update/$1');
$routes->delete('/review/(:num)', 'Review::delete/$1');

$routes->get('/room/', 'Room::index');
$routes->get('/room/(:num)', 'Room::show/$1');
$routes->post('/room/', 'Room::create');
$routes->put('/room/(:num)', 'Room::update/$1');
$routes->delete('/room/(:num)', 'Room::delete/$1');

$routes->get('/reservation/', 'Reservation::index');
$routes->get('/reservation/(:num)', 'Reservation::show/$1');
$routes->post('/reservation/', 'Reservation::create');
$routes->put('/reservation/(:num)', 'Reservation::update/$1');
$routes->delete('/reservation/(:num)', 'Reservation::delete/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
