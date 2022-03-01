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
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->setDefaultNamespace('');
$routes->get('/auth', 'Login::index');
$routes->get('/auth/login', 'Login::index');
$routes->get('/auth/pembayaran/login', 'Login::index');
$routes->get('/auth/program/login', 'Login::index');
$routes->get('/auth/akun/login', 'Login::index');
$routes->get('/auth/daftar/login', 'Login::index');
$routes->get('/auth/program/kelas_peserta/login', 'Login::index');
$routes->get('/auth/absen/login', 'Login::index');
$routes->get('/auth/absen/list_absen/login', 'Login::index');

$routes->get('/auth/register', 'Register::index');
$routes->get('/auth/daftar', 'Daftar::index', ['filter' => 'Validasilogin']);
$routes->get('/auth/daftar/program', 'Daftar::program', ['filter' => 'Validasilogin']);
$routes->get('/auth/daftar/bayar', 'Daftar::bayar', ['filter' => 'Validasilogin']);

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'Validasilogin']);
$routes->get('/auth/dashboard', 'Dashboard::index', ['filter' => 'Validasilogin']);
$routes->get('/auth/pembayaran/dashboard', 'Dashboard::index', ['filter' => 'Validasilogin']);
$routes->get('/auth/program/dashboard', 'Dashboard::index', ['filter' => 'Validasilogin']);
$routes->get('/auth/akun/dashboard', 'Dashboard::index', ['filter' => 'Validasilogin']);
$routes->get('/auth/daftar/dashboard', 'Dashboard::index', ['filter' => 'Validasilogin']);
$routes->get('/auth/program/kelas_peserta/dashboard', 'Dashboard::index', ['filter' => 'Validasilogin']);
$routes->get('/auth/absen/dashboard', 'Dashboard::index', ['filter' => 'Validasilogin']);
$routes->get('/auth/absen/list_absen/dashboard', 'Dashboard::index', ['filter' => 'Validasilogin']);

$routes->get('/auth/pembayaran/konfirmasi', 'Pembayaran::konfirmasi', ['filter' => 'Validasilogin']);
$routes->get('/auth/pembayaran', 'Pembayaran::Index', ['filter' => 'Validasilogin']);
$routes->get('/auth/program', 'Program::Index', ['filter' => 'Validasilogin']);
$routes->get('/auth/program/kelas', 'Program::kelas', ['filter' => 'Validasilogin']);
$routes->get('/auth/program/level', 'Program::level', ['filter' => 'Validasilogin']);
$routes->get('/auth/peserta', 'Peserta::Index', ['filter' => 'Validasilogin']);
$routes->get('/auth/pengajar', 'Pengajar::Index', ['filter' => 'Validasilogin']);
$routes->get('/auth/akun/user_peserta', 'Akun::user_peserta', ['filter' => 'Validasilogin']);
$routes->get('/auth/akun/user_pengajar', 'Akun::user_pengajar', ['filter' => 'Validasilogin']);
$routes->get('/auth/akun/admin', 'Akun::admin', ['filter' => 'Validasilogin']);
$routes->get('/auth/kantor', 'Kantor::Index', ['filter' => 'Validasilogin']);
$routes->get('/auth/bank', 'Bank::Index', ['filter' => 'Validasilogin']);
$routes->get('/auth/log', 'Log::Index', ['filter' => 'Validasilogin']);

$routes->get('/auth/program/kelas_peserta', 'Program::kelas_peserta', ['filter' => 'Validasilogin']);
$routes->get('/auth/program/kelas_peserta/(:num)', 'Program::kelas_peserta/$1', ['filter' => 'Validasilogin']);

$routes->get('/auth/akademik', 'Akademik::Index', ['filter' => 'Validasilogin']);
$routes->get('/auth/akun/biodata_peserta', 'Akun::biodata_peserta', ['filter' => 'Validasilogin']);

$routes->get('/auth/absen/index_pengajar', 'Absen::index_pengajar', ['filter' => 'Validasilogin']);
$routes->get('/auth/absen/list_absen/(:num)', 'Absen::list_absen/$1', ['filter' => 'Validasilogin']);


//Strange Bug
$routes->get('/auth/peserta/peserta', 'Peserta::Index', ['filter' => 'Validasilogin']);

// $routes->get('/auth/staf', 'Staf::index', ['filter' => 'Validasilogin']);
// $routes->get('/auth/guru', 'Guru::index', ['filter' => 'Validasilogin']);
// $routes->get('/auth/guru/mapel', 'Guru::mapel', ['filter' => 'Validasilogin']);
// $routes->get('/auth/siswa', 'Siswa::index', ['filter' => 'Validasilogin']);
// $routes->get('/auth/kelas', 'Siswa::kelas', ['filter' => 'Validasilogin']);
// $routes->get('/auth/spp', 'Siswa::spp', ['filter' => 'Validasilogin']);
// $routes->get('/auth/berita', 'Berita::index', ['filter' => 'Validasilogin']);
// $routes->get('/auth/berita/kategori', 'Berita::kategori', ['filter' => 'Validasilogin']);
// $routes->get('/auth/gallery', 'Gallery::index', ['filter' => 'Validasilogin']);
// $routes->get('/auth/pengumuman', 'Pengumuman::index', ['filter' => 'Validasilogin']);
// $routes->get('/auth/pengumuman/kelulusan', 'Pengumuman::kelulusan', ['filter' => 'Validasilogin']);
// $routes->get('/auth/konfigurasi/web', 'Konfigurasi::index', ['filter' => 'Validasilogin']);
// $routes->get('/auth/konfigurasi/user', 'Konfigurasi::user', ['filter' => 'Validasilogin']);



/**
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
