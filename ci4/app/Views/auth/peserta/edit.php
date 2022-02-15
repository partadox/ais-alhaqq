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
            <?= form_open('peserta/update_peserta', ['class' => 'formedit']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="peserta_id" value="<?= $peserta_id ?>" name="peserta_id" readonly>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nama Peserta <code>*</code></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control text-uppercase" id="nama" name="nama" value="<?= $nama ?>">
                        <div class="invalid-feedback errorNama"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Asal Peserta<code>*</code></label>
                    <div class="col-sm-8">
                        <select name="asal_cabang_peserta" id="asal_cabang_peserta" class="js-example-basic-single-edit">
                            <?php foreach ($kantor_cabang as $key => $data) { ?>
                                <option value="<?= $data['kantor_id'] ?>" <?php if ($data['kantor_id'] == $asal_cabang_peserta) echo "selected"; ?>><?= $data['nama_kantor'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorAsal_cabang_peserta"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">NIS</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nis" name="nis" value="<?= $nis ?>">
                        <div class="invalid-feedback errorNis"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Angkatan</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="angkatan" name="angkatan" value="<?= $angkatan ?>">
                        <div class="invalid-feedback errorAngkatan"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Level Peserta <code>*</code></label>
                    <div class="col-sm-8">
                        <select name="level_peserta" id="level_peserta" class="js-example-basic-single-edit">
                            <?php foreach ($level as $key => $data) { ?>
                                <option value="<?= $data['peserta_level_id'] ?>" <?php if ($data['peserta_level_id'] == $level_peserta) echo "selected"; ?>><?= $data['nama_level'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorLevelpeserta"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Jenis Kelamin <code>*</code></label>
                    <div class="col-sm-8">
                        <select class="form-control btn-square" id="jenkel" name="jenkel">
                            <option value="IKHWAN"  <?php if ($jenkel == 'IKHWAN') echo "selected"; ?>>IKHWAN</option>
                            <option value="AKHWAT"  <?php if ($jenkel == 'AKHWAT') echo "selected"; ?>>AKHWAT</option>
                        </select>
                        <div class="invalid-feedback errorJenkel"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">NIK<code>*</code></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nik" name="nik" value="<?= $nik ?>">
                        <div class="invalid-feedback errorNik"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tempat Lahir<code>*</code></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control text-uppercase" id="tmp_lahir" name="tmp_lahir" value="<?= $tmp_lahir ?>">
                        <div class="invalid-feedback errorTmp_lahir"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Tanggal Lahir<code>*</code></label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"  value="<?= $tgl_lahir ?>">
                        <div class="invalid-feedback errorTgl_Lahir"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Pendidikan<code>*</code></label>
                    <div class="col-sm-8">
                        <select class="form-control btn-square" id="pendidikan" name="pendidikan">
                            <option value="SD" <?php if ($pendidikan == 'SD') echo "selected"; ?>>SD</option>
                            <option value="SLTP" <?php if ($pendidikan == 'SLPT') echo "selected"; ?>>SLTP</option>
                            <option value="SLTA" <?php if ($pendidikan == 'SLTA') echo "selected"; ?>>SLTA</option>
                            <option value="DIPLOMA" <?php if ($pendidikan == 'DIPLOMA') echo "selected"; ?>>DIPLOMA</option>
                            <option value="SARJANA" <?php if ($pendidikan == 'SARJANA') echo "selected"; ?>>SARJANA (S1)</option>
                            <option value="MAGISTER" <?php if ($pendidikan == 'MAGISTER') echo "selected"; ?>>MAGISTER (S2)</option>
                            <option value="DOKTOR" <?php if ($pendidikan == 'DOKTOR') echo "selected"; ?>>DOKTOR (S3)</option>
                        </select>
                        <div class="invalid-feedback errorPendidikan"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Jurusan Pendidikan Terakhir<code>*</code></label>
                    <div class="col-sm-8">
                        <input class="form-control text-uppercase" type="text" id="jurusan" name="jurusan" value="<?= $jurusan ?>">
                        <div class="invalid-feedback errorJurusan"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Status Bekerja<code>*</code></label>
                    <div class="col-sm-8">
                        <select class="form-control btn-square" id="status_kerja" name="status_kerja">
                            <option value="0" <?php if ($status_kerja == '0') echo "selected"; ?>>TIDAK DALAM IKATAN KERJA</option>
                            <option value="1" <?php if ($status_kerja == '1') echo "selected"; ?>>BEKERJA</option>
                        </select>
                        <div class="invalid-feedback errorStatus_kerja"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Pekerjaan<code>*</code></label>
                    <div class="col-sm-8">
                        <select class="form-control btn-square" id="pekerjaan" name="pekerjaan">
                            <option value="WIRASWASTA" <?php if ($pekerjaan == 'WIRASWASTA') echo "selected"; ?>>WIRASWASTA</option>
                            <option value="PEGAWAI SWASTA" <?php if ($pekerjaan == 'PEGAWAI SWASTA') echo "selected"; ?>>PEGAWAI SWASTA</option>
                            <option value="PEMERINTAH/PNS" <?php if ($pekerjaan == 'PEMERINTAH/PNS') echo "selected"; ?>>PEMERINTAH/PNS</option>
                            <option value="BUMN" <?php if ($pekerjaan == 'BUMN') echo "selected"; ?>>BUMN</option>
                            <option value="USAHA/DAGANG" <?php if ($pekerjaan == 'USAHA/DAGANG') echo "selected"; ?>>USAHA/DAGANG</option>
                            <option value="KEAMANAN/MILITER/POLISI" <?php if ($pekerjaan == 'KEAMANAN/MILITER/POLISI') echo "selected"; ?>>KEAMANAN/MILITER/POLISI</option>
                            <option value="PERBANKAN/KEUANGAN" <?php if ($pekerjaan == 'PERBANKAN/KEUANGAN') echo "selected"; ?>>PERBANKAN/KEUANGAN</option>
                            <option value="KESEHATAN" <?php if ($pekerjaan == 'KESEHATAN') echo "selected"; ?>>KESEHATAN</option>
                            <option value="PENDIDIKAN" <?php if ($pekerjaan == 'PENDIDIKAN') echo "selected"; ?>>PENDIDIKAN</option>
                            <option value="OLAHRAGA/ATLET" <?php if ($pekerjaan == 'OLAHRAGA/ATLET') echo "selected"; ?>>OLAHRAGA/ATLET</option>
                            <option value="KESENIAN/ARTIS" <?php if ($pekerjaan == 'KESENIAN/ARTIS') echo "selected"; ?>>KESENIAN/ARTIS</option>
                            <option value="KEAGAMAAN/MAJELIS" <?php if ($pekerjaan == 'KEAGAMAAN/MAJELIS') echo "selected"; ?>>KEAGAMAAN/MAJELIS</option>
                            <option value="PELAJAR/MAHASISWA" <?php if ($pekerjaan == 'PELAJAR/MAHASISWA') echo "selected"; ?>>PELAJAR/MAHASISWA</option>
                            <option value="KELUARGA/RUMAH TANGGA" <?php if ($pekerjaan == 'KELUARGA/RUMAH TANGGA') echo "selected"; ?>>KELUARGA/RUMAH TANGGA</option>
                            <option value="FREELANCE" <?php if ($pekerjaan == 'FREELANCE') echo "selected"; ?>>FREELANCE</option>
                            <option value="LAINNYA" <?php if ($pekerjaan == 'LAINNYA') echo "selected"; ?>>LAINNYA</option>
                        </select>
                        <div class="invalid-feedback errorPekerjaan"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">No. HP<code>*</code></label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" id="hp" name="hp" value="<?= $hp ?>">
                        <div class="invalid-feedback errorHp"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Email<code>*</code></label>
                    <div class="col-sm-8">
                        <input class="form-control text-lowercase" type="text" id="email" name="email" value="<?= $email ?>">
                        <div class="invalid-feedback errorEmail"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Domisili<code>*</code></label>
                    <div class="col-sm-8">
                        <select class="form-control btn-square" id="domisili_peserta" name="domisili_peserta">
                            <option value="BALIKPAPAN" <?php if ($domisili_peserta == 'BALIKPAPAN') echo "selected"; ?>>BALIKPAPAN</option>
                            <option value="LUAR BALIKPAPAN" <?php if ($domisili_peserta == 'LUAR BALIKPAPAN') echo "selected"; ?>>LUAR BALIKPAPAN</option>
                        </select>
                        <div class="invalid-feedback errorDomisili_peserta"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Alamat<code>*</code></label>
                    <div class="col-sm-8">
                        <input class="form-control text-uppercase" type="text" id="alamat" name="alamat" value="<?= $alamat ?>">
                        <div class="invalid-feedback errorAlamat"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Status Peserta <code>*</code></label>
                    <div class="col-sm-8">
                        <select class="form-control btn-square" id="status_peserta" name="status_peserta">
                            <option value="AKTIF" <?php if ($status_peserta == 'AKTIF') echo "selected"; ?>>AKTIF</option>
                            <option value="OFF" <?php if ($status_peserta == 'OFF') echo "selected"; ?>>OFF</option>
                            <option value="CUTI" <?php if ($status_peserta == 'CUTI') echo "selected"; ?>>CUTI</option>
                        </select>
                        <div class="invalid-feedback errorStatus_peserta"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Akun User Peserta <code>*</code></label>
                    <div class="col-sm-8">
                        <select name="user_id" id="user_id" class="js-example-basic-single-edit">
                                <option Disabled=true Selected=true> </option>
                            <?php foreach ($user as $key => $data) { ?>
                                <option value="<?= $data['user_id'] ?>" <?php if ($data['user_id'] == $user_id) echo "selected"; ?>><?= $data['nama'] ?></option>
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

                        if (response.error.nis) {
                            $('#nis').addClass('is-invalid');
                            $('.errorNis').html(response.error.nis);
                        } else {
                            $('#nis').removeClass('is-invalid');
                            $('.errorNis').html('');
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

                        if (response.error.domisili_peserta) {
                            $('#domisili_peserta').addClass('is-invalid');
                            $('.errorDomisili_peserta').html(response.error.domisili_peserta);
                        } else {
                            $('#domisili_peserta').removeClass('is-invalid');
                            $('.errorDomisili_peserta').html('');
                        }

                        if (response.error.alamat) {
                            $('#alamat').addClass('is-invalid');
                            $('.errorAlamat').html(response.error.alamat);
                        } else {
                            $('#alamat').removeClass('is-invalid');
                            $('.errorAlamat').html('');
                        }

                        if (response.error.status_peserta) {
                            $('#status_peserta').addClass('is-invalid');
                            $('.errorStatus_peserta').html(response.error.status_peserta);
                        } else {
                            $('#status_peserta').removeClass('is-invalid');
                            $('.errorStatus_peserta').html('');
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
                            text: "Berhasil Edit Data Peserta",
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