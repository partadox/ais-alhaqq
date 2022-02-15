<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('pengajar/update_pengajar', ['class' => 'formedit']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="pengajar_id" value="<?= $pengajar_id ?>" name="pengajar_id" readonly>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nama Pengajar <code>*</code></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control text-uppercase" id="nama_pengajar" name="nama_pengajar" value="<?= $nama_pengajar ?>">
                        <div class="invalid-feedback errorNama_pengajar"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">NIK<code>*</code></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nik_pengajar" name="nik_pengajar" value="<?= $nik_pengajar ?>">
                        <div class="invalid-feedback errorNik_pengajar"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tipe Pengajar<code>*</code></label>
                    <div class="col-sm-8">
                        <select name="tipe_pengajar" id="tipe_pengajar" class="js-example-basic-single-edit">
                            <option value="PENGAJAR" <?php if ($tipe_pengajar == 'PENGAJAR') echo "selected"; ?>>PENGAJAR</option>
                            <option value="PENGUJI"  <?php if ($tipe_pengajar == 'PENGUJI') echo "selected"; ?>>PENGUJI</option>
                        </select>
                        <div class="invalid-feedback errorTipe_pengajar"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Kantor<code>*</code></label>
                    <div class="col-sm-8">
                        <select name="kantor_cabang" id="kantor_cabang" class="js-example-basic-single-edit">
                            <?php foreach ($kantor_cabang as $key => $data) { ?>
                                <option value="<?= $data['kantor_id'] ?>" <?php if ($data['kantor_id'] == $asal_kantor) echo "selected"; ?>><?= $data['nama_kantor'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorKantor_cabang"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Jenis Kelamin <code>*</code></label>
                    <div class="col-sm-8">
                        <select class="form-control btn-square" id="jenkel_pengajar" name="jenkel_pengajar">
                            <option value="IKHWAN" <?php if ($jenkel_pengajar == 'IKHWAN') echo "selected"; ?>>IKHWAN</option>
                            <option value="AKHWAT" <?php if ($jenkel_pengajar == 'AKHWAT') echo "selected"; ?>>AKHWAT</option>
                        </select>
                        <div class="invalid-feedback errorJenkel_pengajar"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tempat Lahir<code>*</code></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control text-uppercase" id="tmp_lahir_pengajar" name="tmp_lahir_pengajar" value="<?= $tmp_lahir_pengajar ?>">
                        <div class="invalid-feedback errorTmp_lahir_pengajar"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Tanggal Lahir<code>*</code></label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="tgl_lahir_pengajar" name="tgl_lahir_pengajar" value="<?= $tgl_lahir_pengajar ?>">
                        <div class="invalid-feedback errorTgl_lahir_pengajar"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Suku Bangsa<code>*</code></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control text-uppercase" id="suku_bangsa" name="suku_bangsa" value="<?= $suku_bangsa ?>">
                        <div class="invalid-feedback errorSuku_bangsa"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Status Nikah<code>*</code></label>
                    <div class="col-sm-8">
                        <select class="form-control btn-square" id="status_nikah" name="status_nikah">
                            <option value="MENIKAH"  <?php if ($status_nikah == 'MENIKAH') echo "selected"; ?>>MENIKAH</option>
                            <option value="LAJANG" <?php if ($status_nikah == 'LAJANG') echo "selected"; ?>>LAJANG</option>
                            <option value="SINGLE PARENT" <?php if ($status_nikah == 'SINGLE PARENT') echo "selected"; ?>>SINGLE PARENT</option>
                        </select>
                        <div class="invalid-feedback errorStatus_nikah"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Jumlah Anak<code>*</code></label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="jumlah_anak" name="jumlah_anak" value="<?= $jumlah_anak ?>">
                        <div class="invalid-feedback errorJumlah_anak"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Pendidikan<code>*</code></label>
                    <div class="col-sm-8">
                        <select class="form-control btn-square" id="pendidikan_pengajar" name="pendidikan_pengajar">
                            <option value="SD" <?php if ($pendidikan_pengajar == 'SD') echo "selected"; ?>>SD</option>
                            <option value="SLTP" <?php if ($pendidikan_pengajar == 'SLPT') echo "selected"; ?>>SLTP</option>
                            <option value="SLTA" <?php if ($pendidikan_pengajar == 'SLTA') echo "selected"; ?>>SLTA</option>
                            <option value="DIPLOMA" <?php if ($pendidikan_pengajar == 'DIPLOMA') echo "selected"; ?>>DIPLOMA</option>
                            <option value="SARJANA" <?php if ($pendidikan_pengajar == 'SARJANA') echo "selected"; ?>>SARJANA (S1)</option>
                            <option value="MAGISTER" <?php if ($pendidikan_pengajar == 'MAGISTER') echo "selected"; ?>>MAGISTER (S2)</option>
                            <option value="DOKTOR" <?php if ($pendidikan_pengajar == 'DOKTOR') echo "selected"; ?>>DOKTOR (S3)</option>
                        </select>
                        <div class="invalid-feedback errorPendidikan_pengajar"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Jurusan Pendidikan Terakhir<code>*</code></label>
                    <div class="col-sm-8">
                        <input class="form-control text-uppercase" type="text" id="jurusan_pengajar" name="jurusan_pengajar" value="<?= $jurusan_pengajar ?>">
                        <div class="invalid-feedback errorJurusan_pengajar"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">No. HP<code>*</code></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" id="hp_pengajar" name="hp_pengajar" value="<?= $hp_pengajar ?>">
                        <div class="invalid-feedback errorHp_pengajar"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Email<code>*</code></label>
                    <div class="col-sm-8">
                        <input class="form-control text-lowercase" type="text" id="email_pengajar" name="email_pengajar" value="<?= $email_pengajar ?>">
                        <div class="invalid-feedback errorEmail_pengajar"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Alamat<code>*</code></label>
                    <div class="col-sm-8">
                        <input class="form-control text-uppercase" type="text" id="alamat_pengajar" name="alamat_pengajar" value="<?= $alamat_pengajar ?>">
                        <div class="invalid-feedback errorAlamat_pengajar"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Akun User Pengajar<code>*</code></label>
                    <div class="col-sm-8">
                        <select name="user_id" id="user_id" class="js-example-basic-single-edit">
                                <option Disabled=true Selected=true> </option>
                            <?php foreach ($user as $key => $data) { ?>
                                <option value="<?= $data['user_id'] ?>" <?php if ($data['user_id'] == $user_id) echo "selected"; ?>><?= $data['nama'] ?> | <?= $data['username'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorUser_id"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Tanggal Gabung<code>*</code></label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="tgl_gabung_pengajar" name="tgl_gabung_pengajar" value="<?= $tgl_gabung_pengajar ?>">
                        <div class="invalid-feedback errorTgl_gabung_pengajar"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-share-square"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single-edit').select2({
            theme: "bootstrap4"
        });
        $('.formedit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
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
                        if (response.error.nama_pengajar) {
                            $('#nama_pengajar').addClass('is-invalid');
                            $('.errorNama_pengajar').html(response.error.nama_pengajar);
                        } else {
                            $('#nama_pengajar').removeClass('is-invalid');
                            $('.errorNama_pengajar').html('');
                        }

                        if (response.error.nik_pengajar) {
                            $('#nik_pengajar').addClass('is-invalid');
                            $('.errorNik_pengajar').html(response.error.nik_pengajar);
                        } else {
                            $('#nik_pengajar').removeClass('is-invalid');
                            $('.errorNik_pengajar').html('');
                        }

                        if (response.error.tipe_pengajar) {
                            $('#tipe_pengajar').addClass('is-invalid');
                            $('.errorTipe_pengajar').html(response.error.tipe_pengajar);
                        } else {
                            $('#tipe_pengajar').removeClass('is-invalid');
                            $('.errorTipe_pengajar').html('');
                        }

                        if (response.error.kantor_cabang) {
                            $('#kantor_cabang').addClass('is-invalid');
                            $('.errorKantor_cabang').html(response.error.kantor_cabang);
                        } else {
                            $('#kantor_cabang').removeClass('is-invalid');
                            $('.errorKantor_cabang').html('');
                        }

                        if (response.error.jenkel_pengajar) {
                            $('#jenkel_pengajar').addClass('is-invalid');
                            $('.errorJenkel_pengajar').html(response.error.jenkel_pengajar);
                        } else {
                            $('#jenkel_pengajar').removeClass('is-invalid');
                            $('.errorJenkel_pengajar').html('');
                        }

                        if (response.error.tmp_lahir_pengajar) {
                            $('#tmp_lahir_pengajar').addClass('is-invalid');
                            $('.errorTmp_lahir_pengajar').html(response.error.tmp_lahir_pengajar);
                        } else {
                            $('#tmp_lahir_pengajar').removeClass('is-invalid');
                            $('.errorTmp_lahir_pengajar').html('');
                        }

                        if (response.error.tgl_lahir_pengajar) {
                            $('#tgl_lahir_pengajar').addClass('is-invalid');
                            $('.errorTgl_lahir_pengajar').html(response.error.tgl_lahir_pengajar);
                        } else {
                            $('#tgl_lahir_pengajar').removeClass('is-invalid');
                            $('.errorTgl_lahir_pengajar').html('');
                        }

                        if (response.error.suku_bangsa) {
                            $('#suku_bangsa').addClass('is-invalid');
                            $('.errorSuku_bangsa').html(response.error.suku_bangsa);
                        } else {
                            $('#suku_bangsa').removeClass('is-invalid');
                            $('.errorSuku_bangsa').html('');
                        }

                        if (response.error.status_nikah) {
                            $('#status_nikah').addClass('is-invalid');
                            $('.errorStatus_nikah').html(response.error.status_nikah);
                        } else {
                            $('#status_nikah').removeClass('is-invalid');
                            $('.errorStatus_nikah').html('');
                        }

                        if (response.error.jumlah_anak) {
                            $('#jumlah_anak').addClass('is-invalid');
                            $('.errorJumlah_anak').html(response.error.jumlah_anak);
                        } else {
                            $('#jumlah_anak').removeClass('is-invalid');
                            $('.errorJumlah_anak').html('');
                        }

                        if (response.error.pendidikan_pengajar) {
                            $('#pendidikan_pengajar').addClass('is-invalid');
                            $('.errorPendidikan_pengajar').html(response.error.pendidikan_pengajar);
                        } else {
                            $('#pendidikan_pengajar').removeClass('is-invalid');
                            $('.errorPendidikan_pengajar').html('');
                        }

                        if (response.error.jurusan_pengajar) {
                            $('#jurusan_pengajar').addClass('is-invalid');
                            $('.errorJurusan_pengajar').html(response.error.jurusan_pengajar);
                        } else {
                            $('#jurusan_pengajar').removeClass('is-invalid');
                            $('.errorJurusan_pengajar').html('');
                        }

                        if (response.error.hp_pengajar) {
                            $('#hp_pengajar').addClass('is-invalid');
                            $('.errorHp_pengajar').html(response.error.hp_pengajar);
                        } else {
                            $('#hp_pengajar').removeClass('is-invalid');
                            $('.errorHp_pengajar').html('');
                        }

                        if (response.error.email_pengajar) {
                            $('#email_pengajar').addClass('is-invalid');
                            $('.errorEmail_pengajar').html(response.error.email_pengajar);
                        } else {
                            $('#email_pengajar').removeClass('is-invalid');
                            $('.errorEmail_pengajar').html('');
                        }

                        if (response.error.alamat_pengajar) {
                            $('#alamat_pengajar').addClass('is-invalid');
                            $('.errorAlamat_pengajar').html(response.error.alamat_pengajar);
                        } else {
                            $('#alamat_pengajar').removeClass('is-invalid');
                            $('.errorAlamat_pengajar').html('');
                        }

                        if (response.error.user_id) {
                            $('#user_id').addClass('is-invalid');
                            $('.errorUser_id').html(response.error.user_id);
                        } else {
                            $('#user_id').removeClass('is-invalid');
                            $('.errorUser_id').html('');
                        }

                        if (response.error.tgl_gabung_pengajar) {
                            $('#tgl_gabung_pengajar').addClass('is-invalid');
                            $('.errorTgl_gabung_pengajar').html(response.error.tgl_gabung_pengajar);
                        } else {
                            $('#tgl_gabung_pengajar').removeClass('is-invalid');
                            $('.errorTgl_gabung_pengajar').html('');
                        }
                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Berhasil Edit Data Pengajar",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                                window.location = response.sukses.link;
                        });
                    }
                }
            });
        })
    });
</script>