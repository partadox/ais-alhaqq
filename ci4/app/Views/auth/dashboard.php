<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title">Dashboard</h4>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-right">
        <div id="clock"></div>
    </ol>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<div class="alert alert-secondary alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button> <i class="mdi mdi-account-multiple-outline"></i>
        <strong>Selamat Datang <?= session()->get('nama') ?> </strong> Di Sistem Informasi Al-Haqq.
</div>
<div class="row">

    <!-- Dashboard Peserta -->
    <?php if (session()->get('level') == 4) { ?>
        <!-- <div class="card col d-flex justify-content-center">
            <div class="card-body">
                <h5 class="card-title">SELAMAT DATANG DI SISTEM INFORMASI AKADEMIK AL-HAQQ</h5>
                <p class="card-text"> <b>Assalamu’alaikum Warahmatullahi Wabarakatuh</b> <br>
                Pada sistem ini terdapat beberapa menu seperti pendaftaran program/kelas, melakukan upload bukti pembayaran, cek absensi, dll. Jika terdapat kendala anda dapat segera menghubungi admin kami. <br>
                <b>Wassalamualaikum Warahmatullahi Wabarakatuh</b> <br> <br>
                <b>Hormat Kami,</b> <br>
                <i>Admin & Pengurus Al-Haqq</i>
                </p>
            </div>
        </div> -->
    <?php } ?>

    <!-- Dashboard Admin -->
    <?php if (session()->get('level') == 2) { ?>
        <div class="col-sm-3 col-md-3">
            <div class="card shadow-lg p-3">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-cash-marker bg-warning  text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Konfirmasi Pembayaran</h5>
                    </div>
                    <h3 class="mt-4"><?= $konfirmasi ?></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-3 col-md-3">
            <div class="card shadow-lg p-3">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-office-building bg-warning text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Jumlah Kantor/Cabng</h5>
                    </div>
                    <h5 class="mt-4"><?= $kantor ?></h5>
                </div>
            </div>
        </div>

        <div class="col-sm-3 col-md-3">
            <div class="card shadow-lg p-3">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-application bg-warning text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Jumlah Program</h5>
                    </div>
                    <h5 class="mt-4"><?= $program ?></h5>
                </div>
            </div>
        </div>

        <div class="col-sm-3 col-md-3">
            <div class="card shadow-lg p-3">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-school bg-warning text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Jumlah Kelas</h5>
                    </div>
                    <h5 class="mt-4"><?= $kelas ?></h5>
                </div>
            </div>
        </div>

        <div class="col-sm-3 col-md-3">
            <div class="card shadow-lg p-3">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-account bg-warning text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Jumlah Pengajar</h5>
                    </div>
                    <h5 class="mt-4"><?= $pengajar ?></h5>
                </div>
            </div>
        </div>

        <div class="col-sm-3 col-md-3">
            <div class="card shadow-lg p-3">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-account bg-warning text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Jumlah Peserta</h5>
                    </div>
                    <h5 class="mt-4"><?= $peserta ?></h5>
                </div>
            </div>
        </div>

    <?php } ?>

    <!-- Dashboard BEKAS -->
    <!-- <?php if (session()->get('level') == 1) { ?>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-heading p-4">
                <div class="mini-stat-icon float-right">
                    <i class="mdi mdi-folder-image bg-danger text-white"></i>
                </div>
                <div>
                    <h5 class="font-16">Gallery</h5>
                </div>
                <h3 class="mt-4"><?= $gallery['gallery_id'] ?></h3>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-heading p-4">
                <div class="mini-stat-icon float-right">
                    <i class="mdi mdi-newspaper bg-warning text-white"></i>
                </div>
                <div>
                    <h5 class="font-16">Berita</h5>
                </div>
                <h3 class="mt-4"><?= $berita['berita_id'] ?></h3>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-heading p-4">
                <div class="mini-stat-icon float-right">
                    <i class="mdi mdi-bullhorn-outline bg-primary text-white"></i>
                </div>
                <div>
                    <h5 class="font-16">Kelulusan</h5>
                </div>
                <h3 class="mt-4"><?= $kelulusan['kelulusan_id'] ?></h3>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-heading p-4">
                <div class="mini-stat-icon float-right">
                    <i class="mdi mdi-bullhorn-outline bg-secondary text-white"></i>
                </div>
                <div>
                    <h5 class="font-16">Pengumuman</h5>
                </div>
                <h3 class="mt-4"><?= $pengumuman['pengumuman_id'] ?></h3>
            </div>
        </div>
    </div>
    <?php } ?> -->
</div>

<?= $this->endSection('isi') ?>