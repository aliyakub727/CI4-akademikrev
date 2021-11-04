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

// // route admin
// $routes->get('/acoount', 'acoount::index', ['filter' => 'role:admin']);
// $routes->get('/acoount/index', 'acoount::index', ['filter' => 'role:admin']);
// // $routes->get('/acoount/createakun', 'Acoount::index', ['filter' => 'role:admin']);

// // routes guru

// //route operator

// //Controller siswa
// $routes->get('/siswa', 'Siswa::index', ['filter' => 'role:operator']);
// $routes->get('/siswa/index', 'Siswa::index', ['filter' => 'role:operator']);
// // $routes->get('/siswa/deletesiswa/(:any)', 'Siswa::index', ['filter' => 'role:operator']);

// //Controller jurusan
// $routes->get('/jurusan', 'Jurusan::index', ['filter' => 'role:operator']);
// $routes->get('/jurusan/index', 'Jurusan::index', ['filter' => 'role:operator']);
// // $routes->get('/jurusan/delete/(:any)', 'Jurusan::index', ['filter' => 'role:operator']);

// //Controller kelas
// $routes->get('/kelas', 'Kelas::index', ['filter' => 'role:operator']);
// $routes->get('/kelas/index', 'Kelas::index', ['filter' => 'role:operator']);

// // $routes->get('/kelas/deletekelas/(:any)', 'Kelas::index', ['filter' => 'role:operator']);

// //Controller mapel
// $routes->get('/mapel', 'Mapel::index', ['filter' => 'role:operator']);
// $routes->get('/mapel/index', 'Mapel::index', ['filter' => 'role:operator']);
// // $routes->get('/mapel/delete/(:any)', 'Mapel::index', ['filter' => 'role:operator']);

// //Controller guru
// $routes->get('/guru', 'Guru::index', ['filter' => 'role:operator']);
// $routes->get('/guru/index', 'Guru::index', ['filter' => 'role:operator']);
// // $routes->get('/guru/deleteguru/(:any)', 'Guru::index', ['filter' => 'role:operator']);

// //Controller masterdata
// $routes->get('/masterdata', 'Masterdata::index', ['filter' => 'role:operator']);
// $routes->get('/masterdata/index', 'Masterdata::index', ['filter' => 'role:operator']);
// // $routes->get('/masterdata/delete/(:any)', 'Masterdata::index', ['filter' => 'role:operator']);

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
