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
    <li class="menu-title">Pendaftaran Awal</li>
    <li>
        <a href="<?= base_url('auth/daftar/') ?>" class="waves-effect">
            <i class="mdi mdi-account-star-outline"></i> <span> Formulir Daftar </span>
        </a>
        <?php if (session()->get('kelengkapan_data') == 1) { ?>
        <a href="<?= base_url('auth/daftar/bayar') ?>" class="waves-effect">
            <i class="mdi mdi-cash-register"></i> <span> Pembayaran Daftar </span>
        </a>
        <?php } ?>
    </li>
    <li class="menu-title">Logout Akun</li>
    <li>
        <a class="waves-effect" href="#" id="logout"><i class="mdi mdi-power text-danger"></i> Keluar</a>
    </li>
<?= $this->endSection('menu') ?>