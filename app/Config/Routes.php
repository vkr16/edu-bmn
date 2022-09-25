<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->post('/login', 'Auth::authenticate');



/**
 * Admin Side Routes
 */
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/user-management', 'Admin::usermanagement');
$routes->post('/admin/user-management/add', 'Admin::adduser');
$routes->post('/admin/user-management/update', 'Admin::edituser');
$routes->post('/admin/user-management/reset-password', 'Admin::resetpassuser');
$routes->post('/admin/user-management/delete', 'Admin::deleteuser');

$routes->post('/admin/account/update/password', 'Admin::updatepassword');
$routes->post('/admin/account/update/email', 'Admin::updateemail');

$routes->get('/admin/data/peralatan-dan-mesin', 'Admin::pdmdata');
$routes->post('/admin/data/peralatan-dan-mesin/upload', 'Admin::pdmupload');
$routes->post('/admin/data/peralatan-dan-mesin/detail', 'Admin::pdmdetail');
$routes->post('/admin/data/peralatan-dan-mesin/delete', 'Admin::pdmdelete');



/** 
 * PDM Side Routes
 */
$routes->get('/pdm', 'Pdm::index');
$routes->get('/pdm/data/peralatan-dan-mesin', 'Pdm::pdmdata');
$routes->post('/pdm/data/peralatan-dan-mesin/upload', 'Pdm::pdmupload');
$routes->post('/pdm/data/peralatan-dan-mesin/detail', 'Pdm::pdmdetail');
$routes->post('/pdm/data/peralatan-dan-mesin/delete', 'Pdm::pdmdelete');

$routes->post('/pdm/account/update/password', 'Pdm::updatepassword');
$routes->post('/pdm/account/update/email', 'Pdm::updateemail');




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
