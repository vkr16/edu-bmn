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

/** 
 * TNH Side Routes
 */
$routes->get('/tnh', 'Tnh::index');
$routes->get('/tnh/data/tanah', 'Tnh::tnhdata');
$routes->post('/tnh/data/tanah/upload', 'Tnh::tnhupload');
$routes->post('/tnh/data/tanah/detail', 'Tnh::tnhdetail');
$routes->post('/tnh/data/tanah/delete', 'Tnh::tnhdelete');

$routes->post('/tnh/account/update/password', 'Tnh::updatepassword');
$routes->post('/tnh/account/update/email', 'Tnh::updateemail');


/** 
 * GDB Side Routes
 */
$routes->get('/gdb', 'Gdb::index');
$routes->get('/gdb/data/tanah', 'Gdb::gdbdata');
$routes->post('/gdb/data/tanah/upload', 'Gdb::gdbupload');
$routes->post('/gdb/data/tanah/detail', 'Gdb::gdbdetail');
$routes->post('/gdb/data/tanah/delete', 'Gdb::gdbdelete');

$routes->post('/gdb/account/update/password', 'Gdb::updatepassword');
$routes->post('/gdb/account/update/email', 'Gdb::updateemail');

/** 
 * JIJ Side Routes
 */
$routes->get('/jij', 'Jij::index');
$routes->get('/jij/data/tanah', 'Jij::jijdata');
$routes->post('/jij/data/tanah/upload', 'Jij::jijupload');
$routes->post('/jij/data/tanah/detail', 'Jij::jijdetail');
$routes->post('/jij/data/tanah/delete', 'Jij::jijdelete');

$routes->post('/jij/account/update/password', 'Jij::updatepassword');
$routes->post('/jij/account/update/email', 'Jij::updateemail');


/** 
 * ATL Side Routes
 */
$routes->get('/atl', 'Atl::index');
$routes->get('/atl/data/tanah', 'Atl::atldata');
$routes->post('/atl/data/tanah/upload', 'Atl::atlupload');
$routes->post('/atl/data/tanah/detail', 'Atl::atldetail');
$routes->post('/atl/data/tanah/delete', 'Atl::atldelete');

$routes->post('/atl/account/update/password', 'Atl::updatepassword');
$routes->post('/atl/account/update/email', 'Atl::updateemail');


/** 
 * KDP Side Routes
 */
$routes->get('/kdp', 'Kdp::index');
$routes->get('/kdp/data/tanah', 'Kdp::kdpdata');
$routes->post('/kdp/data/tanah/upload', 'Kdp::kdpupload');
$routes->post('/kdp/data/tanah/detail', 'Kdp::kdpdetail');
$routes->post('/kdp/data/tanah/delete', 'Kdp::kdpdelete');

$routes->post('/kdp/account/update/password', 'Kdp::updatepassword');
$routes->post('/kdp/account/update/email', 'Kdp::updateemail');






/**
 * Outsider Side Routes
 */
$routes->get('/data/pdm', 'Home::pdmdata');





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
