<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<?php if ($status_menu_sertifikat == 'TUTUP') { ?>
    <div class="card col d-flex justify-content-center">
        <div class="card-body">
            <h5 class="card-title">PENDAFTARAAN CETAK SERTIFIKAT BELUM DIBUKA</h5>
            <p class="card-text"> <b>Assalamu’alaikum Warahmatullahi Wabarakatuh</b> <br>
            Kami menginformasikan kepada seluruh peserta bahwa pendaftaran cetak sertifikat periode baru belum dibuka. <br>
            <b>Wassalamualaikum Warahmatullahi Wabarakatuh</b> <br> <br>
            <b>Hormat Kami,</b> <br>
            <i>Admin & Pengurus Al-Haqq</i>
            </p>
        </div>
    </div>
    <?php } ?>

<?php if ($status_menu_sertifikat == 'BUKA') { ?>
        
        <div class="container-fluid">
        <p class="mt-1">Catatan :<br>
            <i class="mdi mdi-information"></i> Yang dapat mengajukan cetak sertifikat adalah peserta yang telah lulus program TAJWIDI-2. <br>
        </p>
<?php } ?>

<?= $this->endSection('isi') ?>