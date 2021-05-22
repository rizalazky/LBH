<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/login', 'Home::login');
$routes->post('/auth', 'Home::auth');
$routes->get('/logout', 'Home::logout');


$routes->get('/', 'Home::index');
$routes->get('/pendaftaran', 'Pendaftaran::index');
$routes->post('/pendaftaran/next', 'Pendaftaran::create_customer');
$routes->get('/profile_user', 'Profile::index');
$routes->post('/profile_user/detail_anak', 'Profile::form_anak');
$routes->post('/profile_user/detail_anak/save', 'Profile::post_profile');
$routes->get('/inputstruk', 'InputStruk::index');
$routes->post('/inputstruk/save', 'InputStruk::post_struk');

$routes->get('/profile','Profile::index',['filter' => 'auth_customer']);
$routes->get('/profile/profile','Profile::profile',['filter' => 'auth_customer']);
$routes->get('/profile/inputstruck','Profile::inputStruck',['filter' => 'auth_customer']);
$routes->get('/profile/daftarhadiah','Profile::daftarhadiah',['filter' => 'auth_customer']);
$routes->get('/profile/history','Profile::history',['filter' => 'auth_customer']);

// kasir
$routes->get('/kasir/login','C_Auth_Kasir::index');
$routes->post('/kasir/auth','C_Auth_Kasir::auth');
$routes->get('/kasir/logout','C_Auth_Kasir::logout');

$routes->get('/kasir', 'C_Kasir::index',['filter' => 'auth']);
$routes->get('/kasir/caripelanggan', 'C_Kasir::index',['filter' => 'auth']);
$routes->post('/kasir', 'C_Kasir::index',['filter' => 'auth']);
$routes->get('/kasir/pendaftaran', 'C_Kasir::pendaftaran',['filter' => 'auth']);
$routes->post('/kasir/pendaftaran', 'C_Kasir::pendaftaran',['filter' => 'auth']);
$routes->get('/kasir/inputstruk', 'C_Kasir::inputStruck',['filter' => 'auth']);
$routes->post('/kasir/inputstruk', 'C_Kasir::inputStruck',['filter' => 'auth']);
$routes->get('/kasir/redeem', 'C_Kasir::redeem',['filter' => 'auth']);
$routes->get('/kasir/pilihhadiah', 'C_Kasir::pilihhadiah',['filter' => 'auth']);
$routes->post('/kasir/pilihhadiah', 'C_Kasir::pilihhadiah',['filter' => 'auth']);
$routes->get('/kasir/terimakasih', 'C_Kasir::terimakasih',['filter' => 'auth']);




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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
