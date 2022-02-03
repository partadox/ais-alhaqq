<?php

use App\Models\Modelkonfigurasi;

$this->konfigurasi = new Modelkonfigurasi();
$konfigurasi = $this->konfigurasi->orderBy('konfigurasi_id')->first();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?= $title ?></title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="<?= base_url('img/konfigurasi/icon/' . $konfigurasi['icon']) ?>">

    <link href="<?= base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>/assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>/assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>/assets/css/front_login_reg.css" rel="stylesheet" type="text/css">

</head>

<body>

    <!-- Begin page -->
    <div class="blockSign">
        <div id="formContent">

                <div id="signin">
                    <div class="text-center m-t-0 m-b-15">
                        <a href="index.html" class="logo logo-admin"><img src="<?= base_url('img/logo-alhaqq.png') ?>" alt="" height="55"></a>
                    </div>
                    <h6>Isi form dibawah untuk mendaftar akun baru!</h6>
                    <?= form_open('register/simpanuser', ['class' => 'formtambah']) ?>
                    <?= csrf_field() ?>
                        <div class="form-group">
                            <input type="text" placeholder="Nama" name="nama" id="nama" class="fadeIn " />
                            <div class="invalid-feedback errorNama">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Username" name="username" id="username" class="fadeIn " />
                            <div class="invalid-feedback errorUser">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" name="password" id="password"  class="fadeIn ">
                            <div class="invalid-feedback errorPass">
                        </div>
                        <input class="m-t-8" type="submit" value="Daftar"></input>
                        <h6 id="formFooter"><a href="<?= base_url('auth/login') ?>">Sudah punya akun? Silahkan login ke akun anda.</a></h6>
                        <p id="formFooter"><a href="https://api.whatsapp.com/send/?app_absent=0&phone=6281347050573&text=Saya+peserta+yang+memiliki+level+sebelumnya+:%0A%0ANama:+:%0A%0ATingkatan+Terakhir:" target="_blank">Jika anda sudah pernah mengikuti program di Yayasan Al-Haqq dan sudah mempunyai level silahkan hubungi admin.</a></p>
                        <p id="formFooter"><a href="https://alhaqq.or.id/">Kembali ke Website Depan alhaqq.or.id</a></p>
                    <?= form_close() ?>
                </div>
        </div>
    </div>


    <script src="<?= base_url() ?>/assets/js/sweetalert2@10.js"></script>
    <!-- jQuery  -->
    <script src="<?= base_url() ?>/assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/metismenu.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.slimscroll.js"></script>
    <script src="<?= base_url() ?>/assets/js/waves.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/front_logreg.js"></script>


    <!-- App js -->
    <script src="<?= base_url() ?>/assets/js/app.js"></script>

    <script>
    $(document).ready(function() {
        $('.formtambah').submit(function(e) {
            let title = $('input#judul_berita').val()
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    username: $('input#username').val(),
                    nama: $('input#nama').val(),
                    password: $('input#password').val(),
                    level: '4',
                    foto: 'default.png',
                    active: '0',
                },
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disable');
                    $('.btnsimpan').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable', 'disable');
                    $('.btnsimpan').html('<i class="fa fa-share-square"></i>  Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.username) {
                            $('#username').addClass('is-invalid');
                            $('.errorUser').html(response.error.username);
                        } else {
                            $('#username').removeClass('is-invalid');
                            $('.errorUser').html('');
                        }

                        if (response.error.nama) {
                            $('#nama').addClass('is-invalid');
                            $('.errorNama').html(response.error.nama);
                        } else {
                            $('#nama').removeClass('is-invalid');
                            $('.errorNama').html('');
                        }

                        if (response.error.password) {
                            $('#password').addClass('is-invalid');
                            $('.errorPass').html(response.error.password);
                        } else {
                            $('#password').removeClass('is-invalid');
                            $('.errorPass').html('');
                        }

                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Akun Anda berhasil Dibuat, Silahkan Login!",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                                window.location = response.sukses.link;
                        });
                        $('#modaltambah').modal('hide');
                        listuser();
                    }
                }
            });
        })
    });
</script>
</body>

</html>