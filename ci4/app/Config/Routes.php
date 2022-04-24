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
$routes->get('/auth/pembayaran/tambah_bayar_spp_ganti_angkatan/login', 'Login::index');
$routes->get('/auth/pembayaran/admin_rekap_bayar/login', 'Login::index');
$routes->get('/auth/program/kelas/login', 'Login::index');
$routes->get('/auth/pembayaran/rekap_spp_peserta/(:num)/login', 'Login::index');
$routes->get('/auth/akademik/admin_rekap_absen_peserta/login', 'Login::index');
$routes->get('/auth/akademik/admin_rekap_absen_pengajar/login', 'Login::index');

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
$routes->get('/auth/pembayaran/tambah_bayar_spp_ganti_angkatan/dashboard', 'Dashboard::index');
$routes->get('/auth/pembayaran/admin_rekap_bayar/dashboard', 'Dashboard::index');
$routes->get('/auth/program/kelas/dashboard', 'Dashboard::index');
$routes->get('/auth/pembayaran/rekap_spp_peserta/(:num)/dashboard', 'Dashboard::index');
$routes->get('/auth/akademik/admin_rekap_absen_peserta/dashboard', 'Dashboard::index', ['filter' => 'Validasilogin']);
$routes->get('/auth/akademik/admin_rekap_absen_pengajar/dashboard', 'Dashboard::index', ['filter' => 'Validasilogin']);

$routes->get('/auth/pembayaran/konfirmasi', 'Pembayaran::konfirmasi', ['filter' => 'Validasilogin']);
//Ganti Angakatan Rekap SPP - start
$routes->get('/auth/pembayaran/admin_rekap_bayar', 'Pembayaran::admin_rekap_bayar', ['filter' => 'Validasilogin']);
$routes->get('/auth/pembayaran/admin_rekap_bayar/(:num)', 'Pembayaran::admin_rekap_bayar/$1', ['filter' => 'Validasilogin']);
//Ganti Angkatan Rekap SPP - end
$routes->get('/auth/pembayaran/peserta_bayar_spp', 'Pembayaran::peserta_bayar_spp', ['filter' => 'Validasilogin']);
$routes->get('/auth/pembayaran/riwayat_bayar_peserta', 'Pembayaran::riwayat_bayar_peserta', ['filter' => 'Validasilogin']);
//Ganti Angkatan Index Pembayaran - start
$routes->get('/auth/pembayaran', 'Pembayaran::Index', ['filter' => 'Validasilogin']);
$routes->get('/auth/pembayaran/(:num)', 'Pembayaran::index/$1', ['filter' => 'Validasilogin']);
$routes->get('/auth/pembayaran/pembayaran', 'Pembayaran::Index', ['filter' => 'Validasilogin']);
//Ganti Angkatan Index Pembayaran - end
$routes->get('/auth/pembayaran/index_bayar_lain', 'Pembayaran::Index_bayar_lain', ['filter' => 'Validasilogin']);
$routes->get('/auth/pembayaran/index_bayar_infaq', 'Pembayaran::Index_bayar_infaq', ['filter' => 'Validasilogin']);
$routes->get('/auth/pembayaran/tambah_bayar_daftar', 'Pembayaran::tambah_bayar_daftar', ['filter' => 'Validasilogin']);
$routes->get('/auth/pembayaran/tambah_bayar_lain', 'Pembayaran::tambah_bayar_lain', ['filter' => 'Validasilogin']);
//Ganti Angkatan Tambah Bayar SPP - start
$routes->get('/auth/pembayaran/tambah_bayar_spp', 'Pembayaran::tambah_bayar_spp', ['filter' => 'Validasilogin']);
$routes->get('/auth/pembayaran/tambah_bayar_spp/(:num)', 'Pembayaran::tambah_bayar_spp/$1', ['filter' => 'Validasilogin']);
$routes->get('/auth/pembayaran/tambah_bayar_spp_ganti_angkatan', 'Pembayaran::tambah_bayar_spp', ['filter' => 'Validasilogin']);
$routes->get('/auth/pembayaran/tambah_bayar_spp_ganti_angkatan/(:num)', 'Pembayaran::tambah_bayar_spp_ganti_angkatan/$1', ['filter' => 'Validasilogin']);
//Ganti Angkatan Tambah Bayar SPP -end
$routes->get('/auth/program', 'Program::Index', ['filter' => 'Validasilogin']);
//Ganti Angkatan Kelas - start
$routes->get('/auth/program/kelas', 'Program::kelas', ['filter' => 'Validasilogin']);
$routes->get('/auth/program/kelas/(:num)', 'Program::kelas/$1', ['filter' => 'Validasilogin']);
// $routes->get('/auth/program/kelas', 'Pembayaran::Index', ['filter' => 'Validasilogin']);
//Ganti Angkatan Kelas - End
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
$routes->get('/auth/akademik/admin_rekap_absen_peserta', 'Akademik::admin_rekap_absen_peserta', ['filter' => 'Validasilogin']);
$routes->get('/auth/akademik/admin_rekap_absen_peserta/(:num)', 'Akademik::admin_rekap_absen_peserta/$1', ['filter' => 'Validasilogin']);
$routes->get('/auth/akademik/admin_rekap_absen_pengajar', 'Akademik::admin_rekap_absen_pengajar', ['filter' => 'Validasilogin']);
$routes->get('/auth/akademik/admin_rekap_absen_pengajar/(:num)', 'Akademik::admin_rekap_absen_pengajar/$1', ['filter' => 'Validasilogin']);


$routes->get('/auth/absen/index_pengajar', 'Absen::index_pengajar', ['filter' => 'Validasilogin']);
$routes->get('/auth/absen/list_absen/(:num)', 'Absen::list_absen/$1', ['filter' => 'Validasilogin']);

$routes->get('/auth/pembayaran/rekap_spp_peserta/(:num)/(:num)', 'Pembayaran::rekap_spp_peserta/$1/$1', ['filter' => 'Validasilogin']);


//Strange Bug
$routes->get('/auth/peserta/peserta', 'Peserta::Index', ['filter' => 'Validasilogin']);
$routes->get('/auth/pengajar/pengajar', 'Pengajar::Index', ['filter' => 'Validasilogin']);
$routes->get('/auth/auth/dashboard', 'Dashboard::index', ['filter' => 'Validasilogin']);

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
