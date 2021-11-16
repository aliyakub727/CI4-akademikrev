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
$routes->get('/error', 'Home::error');
// $routes->get('/dashboard', 'Dashboard::index');

// route admin
$routes->get('/admin', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/index', 'admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/*', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/dataakun', 'Admin::dataakun', ['filter' => 'role:admin']);
$routes->get('/admin/dataakun/(:any)', 'Admin::dataakun/$1', ['filter' => 'role:admin']);
$routes->get('/admin/editakun', 'Admin::editakun', ['filter' => 'role:admin']);
$routes->get('/admin/editakun/(:any)', 'Admin::editakun/$1', ['filter' => 'role:admin']);
$routes->get('/admin/update/(:any)', 'Admin::update/$1', ['filter' => 'role:admin']);
$routes->get('/admin/buatakun', 'Admin::buatakun', ['filter' => 'role:admin']);
$routes->get('/admin/buatakun/(:any)', 'Admin::buatakun/$1', ['filter' => 'role:admin']);
$routes->get('/admin/deleteakun/(:num)', 'Admin::deleteakun/$1', ['filter' => 'role:admin']);
$routes->get('/admin/landing_page', 'Admin::landing_page', ['filter' => 'role:admin']);
$routes->get('/admin/landing_page/(:any)', 'Admin::landing_page/$1', ['filter' => 'role:admin']);
$routes->get('/admin/ubahpage/(:any)', 'Admin::ubahpage/$1', ['filter' => 'role:admin']);
$routes->get('/admin/ubahdatapage/(:any)', 'Admin::ubahdatapage/$1', ['filter' => 'role:admin']);
$routes->get('/admin/sliderku', 'Admin::sliderku', ['filter' => 'role:admin']);
$routes->get('/admin/sliderku/(:any)', 'Admin::sliderku/$1', ['filter' => 'role:admin']);
$routes->get('/admin/ubahslider/(:any)', 'Admin::ubahslider/$1', ['filter' => 'role:admin']);
$routes->get('/admin/ubahdataslider/(:any)', 'Admin::ubahdataslider/$1', ['filter' => 'role:admin']);




// routes guru
$routes->get('/guru', 'Guru::index', ['filter' => 'role:guru']);
$routes->get('/guru/index', 'Guru::index', ['filter' => 'role:guru']);
$routes->get('/guru/index/*', 'Guru::index', ['filter' => 'role:guru']);
$routes->get('/guru/*', 'Guru::index', ['filter' => 'role:guru']);
$routes->get('/guru/tambahnilai', 'Guru::create', ['filter' => 'role:guru']);
$routes->get('/guru/tambahnilai/*', 'Guru::create', ['filter' => 'role:guru']);

// //route operator
$routes->get('/operator', 'Operator::index', ['filter' => 'role:operator']);
$routes->get('/operator/index', 'Operator::index', ['filter' => 'role:operator']);
$routes->get('/operator/index/*', 'Operator::index', ['filter' => 'role:operator']);
$routes->get('/operator/*', 'Operator::index', ['filter' => 'role:operator']);

//siswa
$routes->get('/operator/datasiswa', 'Operator::datasiswa', ['filter' => 'role:operator']);
$routes->get('/operator/datasiswa/(:any)', 'Operator::datasiswa', ['filter' => 'role:operator']);
$routes->get('/operator/tambahsiswa', 'Operator::tambahsiswa', ['filter' => 'role:operator']);
$routes->get('/operator/tambahsiswa/(:any)', 'Operator::tambahsiswa/$1', ['filter' => 'role:operator']);
$routes->get('/operator/savesiswa', 'Operator::datasiswa', ['filter' => 'role:operator']);
$routes->get('/operator/savesiswa/(:any)', 'Operator::savesiswa/$1', ['filter' => 'role:operator']);
$routes->get('/operator/editsiswa', 'Operator::datasiswa', ['filter' => 'role:operator']);
$routes->get('/operator/editsiswa/(:any)', 'Operator::editsiswa/$1', ['filter' => 'role:operator']);
$routes->get('/operator/saveeditsiswa/(:any)', 'Operator::saveeditsiswa/$1', ['filter' => 'role:operator']);
$routes->get('/operator/deletesiswa', 'Operator::datasiswa', ['filter' => 'role:operator']);
$routes->get('/operator/deletesiswa/(:num)', 'Operator::deletesiswa/$1', ['filter' => 'role:operator']);

//guru
$routes->get('/operator/dataguru', 'Operator::dataguru', ['filter' => 'role:operator']);
$routes->get('/operator/dataguru/(:any)', 'Operator::dataguru/$1', ['filter' => 'role:operator']);
$routes->get('/operator/tambahguru', 'Operator::tambahguru', ['filter' => 'role:operator']);
$routes->get('/operator/tambahguru/(:any)', 'Operator::tambahguru/$1', ['filter' => 'role:operator']);
$routes->get('/operator/saveguru', 'Operator::dataguru', ['filter' => 'role:operator']);
$routes->get('/operator/saveguru/(:any)', 'Operator::saveguru/$1', ['filter' => 'role:operator']);
$routes->get('/operator/editguru', 'Operator::dataguru', ['filter' => 'role:operator']);
$routes->get('/operator/editguru/(:any)', 'Operator::editguru/$1', ['filter' => 'role:operator']);
$routes->get('/operator/saveeditguru', 'Operator::dataguru', ['filter' => 'role:operator']);
$routes->get('/operator/saveeditguru/(:any)', 'Operator::saveeditguru/$1', ['filter' => 'role:operator']);
$routes->get('/operator/deleteguru', 'Operator::dataguru', ['filter' => 'role:operator']);
$routes->get('/operator/deleteguru/(:num)', 'Operator::deleteguru/$1', ['filter' => 'role:operator']);


//kelas
$routes->get('/operator/datakelas', 'Operator::datakelas', ['filter' => 'role:operator']);
$routes->get('/operator/datakelas/(:any)', 'Operator::datakelas/$1', ['filter' => 'role:operator']);
$routes->get('/operator/tambahkelas', 'Operator::tambahkelas', ['filter' => 'role:operator']);
$routes->get('/operator/tambahkelas/(:any)', 'Operator::tambahkelas/$1', ['filter' => 'role:operator']);
$routes->get('/operator/savekelas', 'Operator::datakelas', ['filter' => 'role:operator']);
$routes->get('/operator/savekelas/(:any)', 'Operator::savekelas/$1', ['filter' => 'role:operator']);
$routes->get('/operator/editdatakelas', 'Operator::datakelas', ['filter' => 'role:operator']);
$routes->get('/operator/editdatakelas/(:any)', 'Operator::editdatakelas/$1', ['filter' => 'role:operator']);
$routes->get('/operator/saveeditkelas', 'Operator::datakelas', ['filter' => 'role:operator']);
$routes->get('/operator/saveeditkelas/(:any)', 'Operator::saveeditkelas/$1', ['filter' => 'role:operator']);
$routes->get('/operator/deletekelas', 'Operator::datakelas', ['filter' => 'role:operator']);
$routes->get('/operator/deletekelas/(:num)', 'Operator::deletekelas/$1', ['filter' => 'role:operator']);


//jurusan
$routes->get('/operator/datajurusan', 'Operator::datajurusan', ['filter' => 'role:operator']);
$routes->get('/operator/datajurusan/(:any)', 'Operator::datajurusan/$1', ['filter' => 'role:operator']);
$routes->get('/operator/tambahjurusan', 'Operator::tambahjurusan', ['filter' => 'role:operator']);
$routes->get('/operator/tambahjurusan/(:any)', 'Operator::tambahjurusan/$1', ['filter' => 'role:operator']);
$routes->get('/operator/savejurusan', 'Operator::datajurusan', ['filter' => 'role:operator']);
$routes->get('/operator/savejurusan/(:any)', 'Operator::savejurusan/$1', ['filter' => 'role:operator']);
$routes->get('/operator/editjurusan', 'Operator::datajurusan', ['filter' => 'role:operator']);
$routes->get('/operator/editjurusan/(:any)', 'Operator::editjurusan/$1', ['filter' => 'role:operator']);
$routes->get('/operator/saveeditjurusan', 'Operator::datajurusan', ['filter' => 'role:operator']);
$routes->get('/operator/saveeditjurusan/(:any)', 'Operator::saveeditjurusan/$1', ['filter' => 'role:operator']);
$routes->get('/operator/deletejurusan', 'Operator::datajurusan', ['filter' => 'role:operator']);
$routes->get('/operator/deletejurusan/(:num)', 'Operator::deletejurusan/$1', ['filter' => 'role:operator']);


//jurusan
$routes->get('/operator/datamapel', 'Operator::datamapel', ['filter' => 'role:operator']);
$routes->get('/operator/datamapel/(:any)', 'Operator::datamapel/$1', ['filter' => 'role:operator']);
$routes->get('/operator/tambahmapel', 'Operator::tambahmapel', ['filter' => 'role:operator']);
$routes->get('/operator/tambahmapel/(:any)', 'Operator::tambahmapel/$1', ['filter' => 'role:operator']);
$routes->get('/operator/savemapel', 'Operator::datamapel', ['filter' => 'role:operator']);
$routes->get('/operator/savemapel/(:any)', 'Operator::savemapel/$1', ['filter' => 'role:operator']);
$routes->get('/operator/editmapel', 'Operator::datamapel', ['filter' => 'role:operator']);
$routes->get('/operator/editmapel/(:any)', 'Operator::editmapel/$1', ['filter' => 'role:operator']);
$routes->get('/operator/saveeditmapel', 'Operator::datamapel', ['filter' => 'role:operator']);
$routes->get('/operator/saveeditmapel/(:any)', 'Operator::saveeditmapel/$1', ['filter' => 'role:operator']);
$routes->get('/operator/deletedatamapel', 'Operator::datamapel', ['filter' => 'role:operator']);
$routes->get('/operator/deletedatamapel/(:num)', 'Operator::deletedatamapel/$1', ['filter' => 'role:operator']);


//tahun ajaran
$routes->get('/operator/datatahunajaran', 'Operator::datatahunajaran', ['filter' => 'role:operator']);
$routes->get('/operator/datatahunajaran/(:any)', 'Operator::datatahunajaran/$1', ['filter' => 'role:operator']);
$routes->get('/operator/tambahtahunajaran', 'Operator::tambahtahunajaran', ['filter' => 'role:operator']);
$routes->get('/operator/tambahtahunajaran/(:any)', 'Operator::tambahtahunajaran/$1', ['filter' => 'role:operator']);
$routes->get('/operator/savetahunajaran', 'Operator::datatahunajaran', ['filter' => 'role:operator']);
$routes->get('/operator/savetahunajaran/(:any)', 'Operator::savetahunajaran/$1', ['filter' => 'role:operator']);
$routes->get('/operator/edittahunajaran', 'Operator::datatahunajaran', ['filter' => 'role:operator']);
$routes->get('/operator/edittahunajaran/(:any)', 'Operator::edittahunajaran/$1', ['filter' => 'role:operator']);
$routes->get('/operator/saveedittahunajaran', 'Operator::datatahunajaran', ['filter' => 'role:operator']);
$routes->get('/operator/saveedittahunajaran/(:any)', 'Operator::saveedittahunajaran/$1', ['filter' => 'role:operator']);
$routes->get('/operator/deletedatatahunajaran', 'Operator::datatahunajaran', ['filter' => 'role:operator']);
$routes->get('/operator/deletedatatahunajaran/(:num)', 'Operator::deletedatatahunajaran/$1', ['filter' => 'role:operator']);



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
