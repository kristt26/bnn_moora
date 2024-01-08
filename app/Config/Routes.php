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
$routes->group('periode', function ($routes) {
    $routes->get('/', 'Periode::index');
    $routes->get('read', 'Periode::read');
    $routes->post('post', 'Periode::post');
    $routes->put('put', 'Periode::put');
    $routes->delete('deleted/(:any)', 'Periode::deleted/$1');
});

$routes->group('kriteria', function ($routes) {
    $routes->get('/', 'Kriteria::index');
    $routes->get('read', 'Kriteria::read');
    $routes->post('post', 'Kriteria::post');
    $routes->put('put', 'Kriteria::put');
    $routes->delete('delete/(:any)', 'Kriteria::deleted/$1');
});

$routes->group('range', function ($routes) {
    $routes->get('read', 'Range::read');
    $routes->post('post', 'Range::post');
    $routes->put('put', 'Range::put');
    $routes->delete('delete/(:any)', 'Range::deleted/$1');
});

$routes->group('alternatif', function ($routes) {
    $routes->get('/', 'Alternatif::index');
    $routes->get('read', 'Alternatif::read');
    $routes->post('post', 'Alternatif::post');
    $routes->post('set_data', 'Alternatif::set_data');
    $routes->put('put', 'Alternatif::put');
    $routes->delete('delete /(:any)', 'Alternatif::deleted/$1');
});

$routes->group('client', function ($routes) {
    $routes->get('/', 'Client::index');
    $routes->get('read', 'Client::read');
    $routes->post('post', 'Client::post');
    $routes->put('put', 'Client::put');
    $routes->delete('delete/(:any)', 'Client::deleted/$1');
});

$routes->group('penilaian', function ($routes) {
    $routes->get('/', 'Penilaian::index');
    $routes->get('getNilai/(:any)', 'Penilaian::getNilai/$1');
    $routes->get('read', 'Penilaian::read');
    $routes->post('post', 'Penilaian::post');
    $routes->put('put', 'Penilaian::put');
    $routes->delete('delete/(:any)', 'Penilaian::deleted/$1');
});

$routes->group('hasil', function ($routes) {
    $routes->get('/', 'Hasil::index');
    $routes->get('hitung', 'Hasil::hitung');
});



$routes->group('laporan', function ($routes) {
    $routes->get('/', 'Laporan::index');
    $routes->get('read', 'Laporan::read');
    $routes->post('post', 'Laporan::post');
    $routes->put('put', 'Laporan::put');
    $routes->delete('delete/(:any)', 'Laporan::deleted/$1');
});

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
