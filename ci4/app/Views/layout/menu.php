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
            <i class="mdi mdi-application"></i> <span> Pilih Program & Jadwal </span>
        </a>
        <a href="<?= base_url('auth/daftar/bayar') ?>" class="waves-effect">
            <i class="mdi mdi-cash-register"></i> <span> Pembayaran Daftar </span>
        </a>
    </li>
<?php } ?>

<?php if (session()->get('level') == 4) { ?>
    <li class="menu-title">Akademik Peserta</li>
    <li>
        <a href="<?= base_url('auth/akademik') ?>" class="waves-effect">
            <i class="mdi mdi-application"></i> <span> Program yang Diikuti </span>
        </a>
        <!-- <a href="<?= base_url('auth/akademik/spp') ?>" class="waves-effect">
            <i class="mdi mdi-cash"></i> <span> Pembayaran SPP </span>
        </a> -->
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
        <a href="<?= base_url('auth/pembayaran/konfirmasi') ?>" class="waves-effect">
            <i class="mdi mdi-cash-usd"></i> <span> Konfirmasi Pembayaran</span>
        </a>
        <a href="<?= base_url('auth/pembayaran/') ?>" class="waves-effect">
            <i class="mdi mdi-cash-register"></i> <span> Semua Pembayaran</span>
        </a>
        <!-- <a href="<?= base_url('') ?>" class="waves-effect">
            <i class="mdi mdi-cash-multiple"></i> <span> Riwayat SPP</span>
        </a> -->
        <!-- <a href="<?= base_url('auth/pembayaran') ?>" class="waves-effect">
            <i class="mdi mdi-cash-register"></i> <span>  Download & Hapus Bukti TF </span>
        </a> -->
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
    <li class="menu-title">Peserta & Pengajar</li>
    <li>
        <a href="<?= base_url('auth/peserta') ?>" class="waves-effect">
            <i class="mdi mdi-account"></i> <span> Data Peserta </span>
        </a>
        <a href="<?= base_url('auth/pengajar') ?>" class="waves-effect">
            <i class="mdi mdi-account-tie"></i> <span> Data Pengajar </span>
        </a>
        <a href="<?= base_url('auth/akun/user') ?>" class="waves-effect">
            <i class="mdi mdi-account-badge"></i> <span> Akun User</span>
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


<!--  BEKAS -->
<!-- <?php if (session()->get('level') == 2) { ?>
    <li class="menu-title">Tenaga Kependidik & Pendidik</li>
    <li>
        <a href="<?= base_url('auth/staf') ?>" class="waves-effect">
            <i class="mdi mdi-account-star-outline"></i> <span> Staf </span>
        </a>
    </li>
    <li>
        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-group"></i> <span> Guru <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
        <ul class="submenu">
            <li><a href="<?= base_url('auth/guru') ?>">List Guru</a></li>
            <li><a href="<?= base_url('auth/guru/mapel') ?>">Mapel</a></li>
        </ul>
    </li>
    <li>
        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-badge-horizontal"></i><span> Siswa <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
        <ul class="submenu">
            <li><a href="<?= base_url('auth/kelas') ?>">List Kelas</a></li>
            <li><a href="<?= base_url('auth/siswa') ?>">List Siswa</a></li>
            <li><a href="<?= base_url('auth/spp') ?>">SPP</a></li>
        </ul>
    </li>
<?php } ?>

<li class="menu-title">Posting</li>
<li>
    <a href="<?= base_url('auth/gallery') ?>" class="waves-effect">
        <i class="mdi mdi-folder-image"></i> <span> Gallery </span>
    </a>
</li>
<li>
    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-newspaper"></i> <span> Berita <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
    <ul class="submenu">
        <li><a href="<?= base_url('auth/berita/kategori') ?>">Kategori</a></li>
        <li><a href="<?= base_url('auth/berita') ?>">List Berita</a></li>
    </ul>
</li>
<li>
    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-bullhorn-outline"></i><span> Pengumuman <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
    <ul class="submenu">
        <li><a href="<?= base_url('auth/pengumuman') ?>">Pengumuman Umum</a></li>
        <?php if (session()->get('level') == 2) { ?>
            <li><a href="<?= base_url('auth/pengumuman/kelulusan') ?>">Pengumuman Kelulusan</a></li>
        <?php } ?>
    </ul>
</li>

<?php if (session()->get('level') == 2) { ?>
    <li class="menu-title">Etc</li>
    <li>
        <a href="<?= base_url('auth/konfigurasi/user') ?>" class="waves-effect">
            <i class="mdi mdi-account-switch"></i> <span> Konfigurasi User </span>
        </a>
    </li>
    <li>
        <a href="<?= base_url('auth/konfigurasi/web') ?>" class="waves-effect">
            <i class="mdi mdi-settings-outline"></i> <span> Konfigurasi Web </span>
        </a>
    </li>
<?php } ?> -->

<li class="menu-title">Logout Akun</li>
    <li>
        <a class="waves-effect" href="#" id="logout"><i class="mdi mdi-power text-danger"></i> Keluar</a>
    </li>
<?= $this->endSection('menu') ?>