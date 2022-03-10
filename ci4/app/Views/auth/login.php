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
                    <h6>Isi form dibawah untuk masuk akun!</h6>
                    <?= form_open('login/validasi', ['class' => 'formlogin']) ?>
                    <?= csrf_field() ?>
                        <div class="form-group">
                            <input type="text" placeholder="Username" name="username" id="username" class="fadeIn " />
                            <div class="invalid-feedback errorUsername">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" name="password" id="password"  class="fadeIn ">
                            <div class="invalid-feedback errorPassword">
                        </div>
                        <input type="submit" value="Masuk"></input>
                        <h6 id="formFooter"><a>Ingin daftar di program Al-Haqq? Silahkan hubungi admin untuk pembuatan akun.</a></h6>
                        <p id="formFooter"><a target="_blank">Lupa Username atau Password? Hubungi Admin</a></p>
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
            $('.formlogin').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $('.btnlogin').prop('disable', true);
                        $('.btnlogin').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Loading...')

                    },
                    complete: function() {
                        $('.btnlogin').prop('disable', false);
                        $('.btnlogin').html('Login')
                    },
                    success: function(response) {
                        if (response.error) {
                            if (response.error.username) {
                                $('#username').addClass('is-invalid');
                                $('.errorUsername').html(response.error.username);
                            } else {
                                $('#username').removeClass('is-invalid');
                                $('.errorUsername').html();
                            }

                            if (response.error.password) {
                                $('#password').addClass('is-invalid');
                                $('.errorPassword').html(response.error.password);
                            } else {
                                $('#password').removeClass('is-invalid');
                                $('.errorPassword').html();
                            }
                        }

                        if (response.sukses) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Anda berhasil login!",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1250
                            }).then(function() {
                                window.location = response.sukses.link;
                            });

                        }

                        if (response.nonactive) {
                            Swal.fire({
                                title: "Oooopss!",
                                text: "User belum aktif!",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 1250
                            });
                        }
                    }
                });
                return false;
            });
        });
    </script>
</body>

</html>