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
$routes->get('/', 'Home::index', ['filter' => 'userFilter']);
$routes->get('/dashboard', 'Home::index', ['filter' => 'userFilter']);
$routes->get('/settings', 'Home::setting', ['filter' => 'userFilter']);

// Auth
$routes->get('/login', 'Auth::index');
$routes->get('/logout', 'Auth::logout');
$routes->post('/do_login', 'Auth::login');
$routes->post('/updt_akun', 'Auth::update');

// Karyawan
$routes->get('/karyawan', 'Karyawan::index', ['filter' => 'userFilter', 'filter' => 'aksesFilter']);
$routes->post('/tambah_karyawan', 'Karyawan::insert', ['filter' => 'userFilter', 'filter' => 'aksesFilter']);
$routes->post('/edit_karyawan', 'Karyawan::update', ['filter' => 'userFilter', 'filter' => 'aksesFilter']);
$routes->post('/hapus_karyawan', 'Karyawan::delete', ['filter' => 'userFilter', 'filter' => 'aksesFilter']);
$routes->get('/karyawan/tambah', 'Karyawan::tambah', ['filter' => 'userFilter', 'filter' => 'aksesFilter']);
$routes->get('/karyawan/edit', 'Karyawan::edit', ['filter' => 'userFilter', 'filter' => 'aksesFilter']);

// Absensi
$routes->get('/absensi', 'Absensi::index', ['filter' => 'userFilter', 'filter' => 'aksesFilter']);
$routes->post('/tambah_absensi', 'Absensi::insert', ['filter' => 'userFilter', 'filter' => 'aksesFilter']);
$routes->post('/submit_absensi', 'Absensi::submit_by_karyawan', ['filter' => 'userFilter']);
$routes->post('/edit_absensi', 'Absensi::update', ['filter' => 'userFilter', 'filter' => 'aksesFilter']);
$routes->post('/hapus_absensi', 'Absensi::delete', ['filter' => 'userFilter', 'filter' => 'aksesFilter']);
$routes->get('/absensi/detail', 'Absensi::detail', ['filter' => 'userFilter', 'filter' => 'aksesFilter']);

// Gaji
$routes->get('/laporan', 'Gaji::index', ['filter' => 'userFilter', 'filter' => 'aksesFilter']);

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
