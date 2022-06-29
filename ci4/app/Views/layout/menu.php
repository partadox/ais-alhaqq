<?= $this->extend('layout/main') ?>
<?= $this->section('nav') ?>
<nav class="navbar-custom">
    <ul class="navbar-right list-inline float-right mb-0">

        <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
            <div id="clock"></div>
        </li>
        
        <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
            <a href="javascript:void(0);"> Hello, <?= session()->get('nama') ?> </a>
        </li>

        <li class="dropdown notification-list list-inline-item">
            <div class="dropdown notification-list nav-pro-img">
                <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="<?= base_url('img/user/' .  session()->get('foto')) ?>" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <a class="dropdown-item text-danger" href="#" id="logout"><i class="mdi mdi-power text-danger"></i> Keluar</a>
                </div>
            </div>
        </li>

    </ul>

    <ul class="list-inline menu-left mb-0">
        <li class="float-left">
            <button class="button-menu-mobile open-left waves-effect">
                <i class="mdi mdi-menu"></i>
            </button>
        </li>

    </ul>

</nav>
<?= $this->endSection('nav') ?>


<?= $this->section('menu') ?>
<li class="menu-title">Dashboard</li>
<li>
    <a href="<?= base_url('auth/dashboard') ?>" class="waves-effect">
        <i class="icon-accelerator"></i> <span> Dashboard </span>
    </a>
</li>

<!--  Peserta Menu Start -->
<?php if (session()->get('level') == 4) { ?>
    <li class="menu-title">Pendaftaran Program</li>
    <li>
        <a href="<?= base_url('auth/daftar/program') ?>" class="waves-effect">
            <i class="mdi mdi-application"></i> <span>Pilih Program</span>
        </a>
        <!-- <a href="<?= base_url('#') ?>" class="waves-effect">
            <i class="mdi mdi-application"></i> <span>Program Non-Reguler</span>
        </a> -->
        <a href="<?= base_url('auth/daftar/bayar') ?>" class="waves-effect">
            <i class="mdi mdi-cash-register"></i> <span> Pembayaran Daftar </span>
        </a>
    </li>
<?php } ?>

<?php if (session()->get('level') == 4) { ?>
    <li class="menu-title">Akademik Peserta</li>
    <li>
        <a href="<?= base_url('auth/akademik') ?>" class="waves-effect">
            <i class="mdi mdi-application"></i> <span> Program & Absensi </span>
        </a>
        <a href="<?= base_url('auth/akademik/peserta_sertifikat') ?>" class="waves-effect">
            <i class="mdi mdi-certificate"></i> <span> Sertifikat</span>
        </a>
    </li>
<?php } ?>

<?php if (session()->get('level') == 4) { ?>
    <li class="menu-title">Pembayaran </li>
    <li>
        <a href="<?= base_url('auth/pembayaran/peserta_bayar_spp') ?>" class="waves-effect">
            <i class="mdi mdi-cash"></i> <span> Pembayaran SPP</span>
        </a>
        <a href="<?= base_url('auth/pembayaran/riwayat_bayar_peserta') ?>" class="waves-effect">
            <i class="mdi mdi-cash-multiple"></i> <span> Riwayat Pembayaran </span>
        </a>
    </li>
<?php } ?>

<?php if (session()->get('level') == 4) { ?>
    <li class="menu-title">Akun</li>
    <li>
        <a href="<?= base_url('auth/akun/biodata_peserta') ?>" class="waves-effect">
            <i class="mdi mdi-account-badge"></i> <span> Biodata dan Akun </span>
        </a>
    </li>
<?php } ?>
<!--  Peserta Menu End -->

<!--  Admin Menu Start-->
<?php if (session()->get('level') == 2) { ?>
    <li class="menu-title"> Pembayaran</li>
    <li>
        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-plus-circle-outline"></i> <span> Tambah Bayar <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
        <ul class="submenu">
            <li><a href="<?= base_url('auth/pembayaran/tambah_bayar_daftar') ?>">Pendaftaran</a></li>
            <li><a href="<?= base_url('auth/pembayaran/tambah_bayar_spp') ?>">SPP</a></li>
            <li><a href="<?= base_url('auth/pembayaran/tambah_bayar_lain') ?>">Infaq & Lain</a></li>
        </ul>
        <a href="<?= base_url('auth/pembayaran/konfirmasi') ?>" class="waves-effect">
            <i class="mdi mdi-cash-usd"></i> <span> Konfirmasi Pembayaran</span>
        </a>
        <a href="<?= base_url('auth/pembayaran/') ?>" class="waves-effect">
            <i class="mdi mdi-cash-register"></i> <span> Semua Pembayaran</span>
        </a>
        <a href="<?= base_url('auth/pembayaran/admin_rekap_bayar') ?>" class="waves-effect">
            <i class="mdi mdi-cash-multiple"></i> <span> Rekap Pembayaran SPP</span>
        </a>
        <a href="<?= base_url('auth/pembayaran/index_bayar_infaq') ?>" class="waves-effect">
            <i class="mdi mdi-cash-multiple"></i> <span>Rekap Infaq</span>
        </a>
        <a href="<?= base_url('auth/pembayaran/index_bayar_lain') ?>" class="waves-effect">
            <i class="mdi mdi-cash-multiple"></i> <span>Rekap Pemby. Lain</span>
        </a>
    </li>
    <li class="menu-title">Program & Kelas</li>
    <li>
        <a href="<?= base_url('auth/program') ?>" class="waves-effect">
            <i class="mdi mdi-application"></i> <span> Program </span>
        </a>
        <a href="<?= base_url('auth/program/kelas') ?>" class="waves-effect">
            <i class="mdi mdi-school"></i> <span> Kelas </span>
        </a>
        <!-- <a href="<?= base_url('auth/program/kelas_peserta') ?>" class="waves-effect">
            <i class="mdi mdi-chair-school"></i> <span> Kelas-Peserta </span>
        </a> -->
        <a href="<?= base_url('auth/program/level') ?>" class="waves-effect">
            <i class="mdi mdi-account-badge-horizontal-outline"></i> <span>  Level</span>
        </a>
    </li>
    <li class="menu-title">Akademik</li>
    <li>
        <!-- <a href="#" class="waves-effect">
            <i class="mdi mdi-timeline"></i> <span> Riwayat Kelas Peserta </span>
        </a> -->
        <!-- <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-check-bold"></i> <span> Rekap Absensi <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
        <ul class="submenu">
            <li><a href="#">Semua</a></li>
            <li><a href="#">Per Kelas</a></li>
        </ul> -->
        <a href="<?= base_url('auth/akademik/admin_rekap_absen_peserta') ?>" class="waves-effect">
            <i class="mdi mdi-check-bold"></i> <span> Absensi Peserta</span>
        </a>
        <a href="<?= base_url('auth/akademik/admin_rekap_absen_pengajar') ?>" class="waves-effect">
            <i class="mdi mdi-check-box-outline"></i> <span> Absensi Pengajar</span>
        </a>
        <a href="<?= base_url('auth/akademik/admin_rekap_ujian') ?>" class="waves-effect">
            <i class="mdi mdi-book"></i> <span> Hasil Ujian </span>
        </a>
        <a href="<?= base_url('auth/akademik/admin_sertifikat') ?>" class="waves-effect">
            <i class="mdi mdi-certificate"></i> <span> Sertifikat </span>
        </a>
    </li>
    <li class="menu-title">Peserta & Pengajar</li>
    <li>
        <a href="<?= base_url('auth/peserta') ?>" class="waves-effect">
            <i class="mdi mdi-account"></i> <span> Data Peserta </span>
        </a>
        <a href="<?= base_url('auth/akun/user_peserta') ?>" class="waves-effect">
            <i class="mdi mdi-account-badge"></i> <span> Akun Peserta</span>
        </a>
        <a href="<?= base_url('auth/pengajar') ?>" class="waves-effect">
            <i class="mdi mdi-account-tie"></i> <span> Data Pengajar </span>
        </a>
        <a href="<?= base_url('auth/akun/user_pengajar') ?>" class="waves-effect">
            <i class="mdi mdi-account-tie"></i> <span> Akun Pengajar</span>
        </a>
    </li>
    <li class="menu-title"> Al-Haqq</li>
    <li>
        <a href="<?= base_url('auth/akun/admin') ?>" class="waves-effect">
            <i class="mdi mdi-account-badge-alert-outline"></i> <span> Akun Admin</span>
        </a>
        <a href="<?= base_url('auth/kantor') ?>" class="waves-effect">
            <i class="mdi mdi-office-building"></i> <span> Kantor & Cabang</span>
        </a>
        <a href="<?= base_url('auth/bank') ?>" class="waves-effect">
            <i class="mdi mdi-bank-transfer"></i> <span> Rek. Bank</span>
        </a>
        <a href="<?= base_url('auth/log') ?>" class="waves-effect">
            <i class="mdi mdi-history"></i> <span> Log Aktivitas </span>
        </a>
    </li>
<?php } ?>
<!--  Admin Menu End-->

<!--  Pengajar Menu Start -->
<?php if (session()->get('level') == 5) { ?>
    <li class="menu-title">Akademik</li>
    <li>
        <a href="<?= base_url('auth/absen/index_pengajar') ?>" class="waves-effect">
            <i class="mdi mdi-school"></i> <span> Kelas </span>
        </a>
    </li>
    <li class="menu-title">Akun</li>
    <li>
        <a href="<?= base_url('auth/akun/biodata_pengajar') ?>" class="waves-effect">
            <i class="mdi mdi-account-badge"></i> <span> Biodata dan Akun </span>
        </a>
    </li>
<?php } ?>
<!--  Pengajar Menu End -->

<!--  Penguji Menu Start -->
<?php if (session()->get('level') == 6) { ?>
    <li class="menu-title">Akademik</li>
    <li>
        <a href="<?= base_url('auth/absen/index_pengajar') ?>" class="waves-effect">
            <i class="mdi mdi-school"></i> <span> Kelas </span>
        </a>
    </li>
    <li class="menu-title">Akun</li>
    <li>
        <a href="<?= base_url('auth/akun/biodata_pengajar') ?>" class="waves-effect">
            <i class="mdi mdi-account-badge"></i> <span> Biodata dan Akun </span>
        </a>
    </li>
<?php } ?>
<!--  Pengajar Menu End -->



<li class="menu-title">Logout Akun</li>
    <li>
        <a class="waves-effect" href="#" id="logout"><i class="mdi mdi-power text-danger"></i> Keluar</a>
    </li>
<?= $this->endSection('menu') ?>