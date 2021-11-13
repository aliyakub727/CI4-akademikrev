<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);


/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
// $routes->get('/dashboard', 'Dashboard::index');

// route admin
$routes->get('/admin', 'admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/index', 'admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/*', 'admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/dataakun', 'admin::dataakun', ['filter' => 'role:admin']);
$routes->get('/admin/dataakun/(:any)', 'admin::dataakun/$1', ['filter' => 'role:admin']);
$routes->get('/admin/editakun', 'admin::editakun', ['filter' => 'role:admin']);
$routes->get('/admin/editakun/(:any)', 'admin::editakun/$1', ['filter' => 'role:admin']);
$routes->get('/admin/update/(:any)', 'admin::update/$1', ['filter' => 'role:admin']);
$routes->get('/admin/buatakun', 'admin::buatakun', ['filter' => 'role:admin']);
$routes->get('/admin/buatakun/(:any)', 'admin::buatakun/$1', ['filter' => 'role:admin']);
$routes->get('/admin/deleteakun/(:num)', 'admin::deleteakun/$1', ['filter' => 'role:admin']);
$routes->get('/admin/landing_page', 'admin::landing_page', ['filter' => 'role:admin']);
$routes->get('/admin/landing_page/(:any)', 'admin::landing_page/$1', ['filter' => 'role:admin']);
$routes->get('/admin/ubahpage/(:any)', 'admin::ubahpage/$1', ['filter' => 'role:admin']);
$routes->get('/admin/ubahdatapage/(:any)', 'admin::ubahdatapage/$1', ['filter' => 'role:admin']);
$routes->get('/admin/sliderku', 'admin::sliderku', ['filter' => 'role:admin']);
$routes->get('/admin/sliderku/(:any)', 'admin::sliderku/$1', ['filter' => 'role:admin']);
$routes->get('/admin/ubahslider/(:any)', 'admin::ubahslider/$1', ['filter' => 'role:admin']);
$routes->get('/admin/ubahdataslider/(:any)', 'admin::ubahdataslider/$1', ['filter' => 'role:admin']);




// routes guru
$routes->get('/guru', 'guru::index', ['filter' => 'role:guru']);
$routes->get('/guru/index', 'guru::index', ['filter' => 'role:guru']);
$routes->get('/guru/index/*', 'guru::index', ['filter' => 'role:guru']);
$routes->get('/guru/*', 'guru::index', ['filter' => 'role:guru']);
$routes->get('/guru/tambahnilai', 'guru::create', ['filter' => 'role:guru']);
$routes->get('/guru/tambahnilai/*', 'guru::create', ['filter' => 'role:guru']);

// //route operator
$routes->get('/operator', 'operator::index', ['filter' => 'role:operator']);
$routes->get('/operator/index', 'operator::index', ['filter' => 'role:operator']);
$routes->get('/operator/index/*', 'operator::index', ['filter' => 'role:operator']);
$routes->get('/operator/*', 'operator::index', ['filter' => 'role:operator']);

//siswa
$routes->get('/operator/datasiswa', 'operator::datasiswa', ['filter' => 'role:operator']);
$routes->get('/operator/datasiswa/(:any)', 'operator::datasiswa', ['filter' => 'role:operator']);
$routes->get('/operator/tambahsiswa', 'operator::tambahsiswa', ['filter' => 'role:operator']);
$routes->get('/operator/tambahsiswa/(:any)', 'operator::tambahsiswa/$1', ['filter' => 'role:operator']);
$routes->get('/operator/savesiswa', 'operator::savesiswa', ['filter' => 'role:operator']);
$routes->get('/operator/savesiswa/(:any)', 'operator::savesiswa/$1', ['filter' => 'role:operator']);
$routes->get('/operator/editsiswa/(:any)', 'operator::editsiswa/$1', ['filter' => 'role:operator']);
$routes->get('/operator/saveeditsiswa/(:any)', 'operator::saveeditsiswa/$1', ['filter' => 'role:operator']);
$routes->get('/operator/deletesiswa', 'operator::deletesiswa', ['filter' => 'role:operator']);
$routes->get('/operator/deletesiswa/(:num)', 'operator::deletesiswa/$1', ['filter' => 'role:operator']);

//guru
$routes->get('/operator/dataguru', 'operator::dataguru', ['filter' => 'role:operator']);
$routes->get('/operator/dataguru/(:any)', 'operator::dataguru/$1', ['filter' => 'role:operator']);
$routes->get('/operator/tambahguru', 'operator::tambahguru', ['filter' => 'role:operator']);
$routes->get('/operator/tambahguru/*', 'operator::tambahguru', ['filter' => 'role:operator']);
$routes->get('/operator/tambahguru', 'operator::tambahguru', ['filter' => 'role:operator']);
$routes->get('/operator/tambahguru/*', 'operator::tambahguru', ['filter' => 'role:operator']);




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
