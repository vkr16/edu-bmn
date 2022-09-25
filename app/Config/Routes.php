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

$routes->get('/admin/data/tanah', 'Admin::tnhdata');
$routes->post('/admin/data/tanah/upload', 'Admin::tnhupload');
$routes->post('/admin/data/tanah/detail', 'Admin::tnhdetail');
$routes->post('/admin/data/tanah/delete', 'Admin::tnhdelete');

$routes->get('/admin/data/gedung-dan-bangunan', 'Admin::gdbdata');
$routes->post('/admin/data/gedung-dan-bangunan/upload', 'Admin::gdbupload');
$routes->post('/admin/data/gedung-dan-bangunan/detail', 'Admin::gdbdetail');
$routes->post('/admin/data/gedung-dan-bangunan/delete', 'Admin::gdbdelete');

$routes->get('/admin/data/jalan-irigasi-dan-jaringan', 'Admin::jijdata');
$routes->post('/admin/data/jalan-irigasi-dan-jaringan/upload', 'Admin::jijupload');
$routes->post('/admin/data/jalan-irigasi-dan-jaringan/detail', 'Admin::jijdetail');
$routes->post('/admin/data/jalan-irigasi-dan-jaringan/delete', 'Admin::jijdelete');

$routes->get('/admin/data/aset-tetap-lainnya', 'Admin::atldata');
$routes->post('/admin/data/aset-tetap-lainnya/upload', 'Admin::atlupload');
$routes->post('/admin/data/aset-tetap-lainnya/detail', 'Admin::atldetail');
$routes->post('/admin/data/aset-tetap-lainnya/delete', 'Admin::atldelete');

$routes->get('/admin/data/konstruksi-dalam-pengerjaan', 'Admin::kdpdata');
$routes->post('/admin/data/konstruksi-dalam-pengerjaan/upload', 'Admin::kdpupload');
$routes->post('/admin/data/konstruksi-dalam-pengerjaan/detail', 'Admin::kdpdetail');
$routes->post('/admin/data/konstruksi-dalam-pengerjaan/delete', 'Admin::kdpdelete');



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
$routes->get('/gdb/data/gedung-dan-bangunan', 'Gdb::gdbdata');
$routes->post('/gdb/data/gedung-dan-bangunan/upload', 'Gdb::gdbupload');
$routes->post('/gdb/data/gedung-dan-bangunan/detail', 'Gdb::gdbdetail');
$routes->post('/gdb/data/gedung-dan-bangunan/delete', 'Gdb::gdbdelete');

$routes->post('/gdb/account/update/password', 'Gdb::updatepassword');
$routes->post('/gdb/account/update/email', 'Gdb::updateemail');

/** 
 * JIJ Side Routes
 */
$routes->get('/jij', 'Jij::index');
$routes->get('/jij/data/jalan-irigasi-dan-jaringan', 'Jij::jijdata');
$routes->post('/jij/data/jalan-irigasi-dan-jaringan/upload', 'Jij::jijupload');
$routes->post('/jij/data/jalan-irigasi-dan-jaringan/detail', 'Jij::jijdetail');
$routes->post('/jij/data/jalan-irigasi-dan-jaringan/delete', 'Jij::jijdelete');

$routes->post('/jij/account/update/password', 'Jij::updatepassword');
$routes->post('/jij/account/update/email', 'Jij::updateemail');


/** 
 * ATL Side Routes
 */
$routes->get('/atl', 'Atl::index');
$routes->get('/atl/data/aset-tetap-lainnya', 'Atl::atldata');
$routes->post('/atl/data/aset-tetap-lainnya/upload', 'Atl::atlupload');
$routes->post('/atl/data/aset-tetap-lainnya/detail', 'Atl::atldetail');
$routes->post('/atl/data/aset-tetap-lainnya/delete', 'Atl::atldelete');

$routes->post('/atl/account/update/password', 'Atl::updatepassword');
$routes->post('/atl/account/update/email', 'Atl::updateemail');


/** 
 * KDP Side Routes
 */
$routes->get('/kdp', 'Kdp::index');
$routes->get('/kdp/data/konstruksi-dalam-pengerjaan', 'Kdp::kdpdata');
$routes->post('/kdp/data/konstruksi-dalam-pengerjaan/upload', 'Kdp::kdpupload');
$routes->post('/kdp/data/konstruksi-dalam-pengerjaan/detail', 'Kdp::kdpdetail');
$routes->post('/kdp/data/konstruksi-dalam-pengerjaan/delete', 'Kdp::kdpdelete');

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
