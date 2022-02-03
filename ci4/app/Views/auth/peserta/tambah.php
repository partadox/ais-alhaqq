<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('peserta/simpan_peserta', ['class' => 'formtambah']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nama Peserta <code>*</code></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama" name="nama">
                        <div class="invalid-feedback errorNama"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Asal Peserta<code>*</code></label>
                    <div class="col-sm-8">
                        <select name="asal_cabang_peserta" id="asal_cabang_peserta" class="js-example-basic-single">
                                <option value="" disabled selected>--Pilih--</option>
                            <?php foreach ($kantor_cabang as $key => $data) { ?>
                                <option value="<?= $data['kantor_id'] ?>"><?= $data['nama_kantor'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorAsal_cabang_peserta"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">NIS</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nis" name="nis">
                        <div class="invalid-feedback errorNis"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Angkatan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="angkatan" name="angkatan">
                        <div class="invalid-feedback errorAngkatan"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Level Peserta <code>*</code></label>
                    <div class="col-sm-8">
                        <select name="level_peserta" id="level_peserta" class="js-example-basic-single">
                                <option Disabled=true Selected=true> </option>
                            <?php foreach ($level as $key => $data) { ?>
                                <option value="<?= $data['peserta_level_id'] ?>"><?= $data['nama_level'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorLevelpeserta"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Jenis Kelamin <code>*</code></label>
                    <div class="col-sm-8">
                        <select class="form-control btn-square" id="jenkel" name="jenkel">
                            <option value="" disabled selected>--Pilih--</option>
                            <option value="Ikhwan">Ikhwan</option>
                            <option value="Akhwat">Akhwat</option>
                        </select>
                        <div class="invalid-feedback errorJenkel"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">NIK<code>*</code></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nik" name="nik">
                        <div class="invalid-feedback errorNik"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tempat Lahir<code>*</code></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir">
                        <div class="invalid-feedback errorTmp_lahir"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Tanggal Lahir<code>*</code></label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                        <div class="invalid-feedback errorTgl_Lahir"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Pendidikan<code>*</code></label>
                    <div class="col-sm-8">
                        <select class="form-control btn-square" id="pendidikan" name="pendidikan">
                            <option value="" disabled selected>--Pilih--</option>
                            <option value="SD">SD</option>
                            <option value="SLTP">SLTP</option>
                            <option value="SLTA">SLTA</option>
                            <option value="Diploma">Diploma</option>
                            <option value="Sarjana">Sarjana (S1)</option>
                            <option value="Magister">Magister (S2)</option>
                        </select>
                        <div class="invalid-feedback errorPendidikan"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Jurusan Pendidikan Terakhir<code>*</code></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" id="jurusan" name="jurusan">
                        <div class="invalid-feedback errorJurusan"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Status Bekerja<code>*</code></label>
                    <div class="col-sm-8">
                        <select class="form-control btn-square" id="status_kerja" name="status_kerja">
                            <option value="" disabled selected>--Pilih--</option>
                            <option value="0">Tidak Dalam Ikatan Kerja</option>
                            <option value="1">Bekerja</option>
                        </select>
                        <div class="invalid-feedback errorStatus_kerja"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Pekerjaan<code>*</code></label>
                    <div class="col-sm-8">
                        <select class="form-control btn-square" id="pekerjaan" name="pekerjaan">
                            <option value="" disabled selected>--Pilih--</option>
                            <option value="Swasta">Swasta</option>
                            <option value="Pegawai Swasta">Pegawai Swasta</option>
                            <option value="Pegawai Negeri">Pegawai Negeri</option>
                            <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>>
                            <option value="Pelajar / Mahasiswa">Pelajar / Mahasiswa</option>>
                            <option value="Freelance">Freelance</option>>
                        </select>
                        <div class="invalid-feedback errorPekerjaan"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">No. HP<code>*</code></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" id="hp" name="hp" >
                        <div class="invalid-feedback errorHp"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Email<code>*</code></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" id="email" name="email" >
                        <div class="invalid-feedback errorEmail"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Alamat<code>*</code></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" id="alamat" name="alamat" >
                        <div class="invalid-feedback errorAlamat"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Akun User Peserta <code>*</code></label>
                    <div class="col-sm-8">
                        <select name="user_id" id="user_id" class="js-example-basic-single">
                                <option Disabled=true Selected=true> </option>
                            <?php foreach ($user as $key => $data) { ?>
                                <option value="<?= $data['user_id'] ?>"><?= $data['nama'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorUser_id"></div>
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
        $('.js-example-basic-single').select2({
            theme: "bootstrap4"
        });
        $('.formtambah').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    nama: $('input#nama').val(),
                    asal_cabang_peserta: $('select#asal_cabang_peserta').val(),
                    nis: $('input#nis').val(),
                    angkatan: $('input#angkatan').val(),
                    level_peserta: $('select#level_peserta').val(),
                    jenkel: $('select#jenkel').val(),
                    nik: $('input#nik').val(),
                    tmp_lahir: $('input#tmp_lahir').val(),
                    tgl_lahir: $('input#tgl_lahir').val(),
                    pendidikan: $('select#pendidikan').val(),
                    jurusan: $('input#jurusan').val(),
                    status_kerja: $('select#status_kerja').val(),
                    pekerjaan: $('select#pekerjaan').val(),
                    hp: $('input#hp').val(),
                    email: $('input#email').val(),
                    alamat: $('input#alamat').val(),
                    user_id: $('select#user_id').val(),
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
                        if (response.error.nama) {
                            $('#nama').addClass('is-invalid');
                            $('.errorNama').html(response.error.nama);
                        } else {
                            $('#nama').removeClass('is-invalid');
                            $('.errorNama').html('');
                        }

                        if (response.error.asal_cabang_peserta) {
                            $('#asal_cabang_peserta').addClass('is-invalid');
                            $('.errorAsal_cabang_peserta').html(response.error.asal_cabang_peserta);
                        } else {
                            $('#asal_cabang_peserta').removeClass('is-invalid');
                            $('.errorAsal_cabang_peserta').html('');
                        }

                        if (response.error.level_peserta) {
                            $('#level_peserta').addClass('is-invalid');
                            $('.errorLevel_peserta').html(response.error.level_peserta);
                        } else {
                            $('#level_peserta').removeClass('is-invalid');
                            $('.errorLevel_peserta').html('');
                        }

                        if (response.error.jenkel) {
                            $('#jenkel').addClass('is-invalid');
                            $('.errorJenkel').html(response.error.jenkel);
                        } else {
                            $('#jenkel').removeClass('is-invalid');
                            $('.errorJenkel').html('');
                        }

                        if (response.error.nik) {
                            $('#nik').addClass('is-invalid');
                            $('.errorNik').html(response.error.nik);
                        } else {
                            $('#nik').removeClass('is-invalid');
                            $('.errorNik').html('');
                        }

                        if (response.error.tmp_lahir) {
                            $('#tmp_lahir').addClass('is-invalid');
                            $('.errorTmp_lahir').html(response.error.tmp_lahir);
                        } else {
                            $('#tmp_lahir').removeClass('is-invalid');
                            $('.errorTmp_lahir').html('');
                        }

                        if (response.error.tgl_lahir) {
                            $('#tgl_lahir').addClass('is-invalid');
                            $('.errorTgl_lahir').html(response.error.tgl_lahir);
                        } else {
                            $('#tgl_lahir').removeClass('is-invalid');
                            $('.errorTgl_lahir').html('');
                        }

                        if (response.error.pendidikan) {
                            $('#pendidikan').addClass('is-invalid');
                            $('.errorPendidikan').html(response.error.pendidikan);
                        } else {
                            $('#pendidikan').removeClass('is-invalid');
                            $('.errorPendidikan').html('');
                        }

                        if (response.error.jurusan) {
                            $('#jurusan').addClass('is-invalid');
                            $('.errorJurusan').html(response.error.jurusan);
                        } else {
                            $('#jurusan').removeClass('is-invalid');
                            $('.errorJurusan').html('');
                        }

                        if (response.error.status_kerja) {
                            $('#status_kerja').addClass('is-invalid');
                            $('.errorStatus_kerja').html(response.error.status_kerja);
                        } else {
                            $('#status_kerja').removeClass('is-invalid');
                            $('.errorStatus_kerja').html('');
                        }

                        if (response.error.pekerjaan) {
                            $('#pekerjaan').addClass('is-invalid');
                            $('.errorPekerjaan').html(response.error.pekerjaan);
                        } else {
                            $('#pekerjaan').removeClass('is-invalid');
                            $('.errorPekerjaan').html('');
                        }

                        if (response.error.hp) {
                            $('#hp').addClass('is-invalid');
                            $('.errorHp').html(response.error.hp);
                        } else {
                            $('#hp').removeClass('is-invalid');
                            $('.errorHp').html('');
                        }

                        if (response.error.email) {
                            $('#email').addClass('is-invalid');
                            $('.errorEmail').html(response.error.email);
                        } else {
                            $('#email').removeClass('is-invalid');
                            $('.errorEmail').html('');
                        }

                        if (response.error.alamat) {
                            $('#alamat').addClass('is-invalid');
                            $('.errorAlamat').html(response.error.alamat);
                        } else {
                            $('#alamat').removeClass('is-invalid');
                            $('.errorAlamat').html('');
                        }

                        if (response.error.user_id) {
                            $('#user_id').addClass('is-invalid');
                            $('.errorUser_id').html(response.error.user_id);
                        } else {
                            $('#user_id').removeClass('is-invalid');
                            $('.errorUser_id').html('');
                        }
                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Berhasil Tambah Data Peserta",
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