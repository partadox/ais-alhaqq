<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<div class="card shadow-lg">
  <div class="card-header pb-0">
    <h6 class="card-title mb-2">Akun Peserta</h6>
    <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
  </div>
  <div class="card-body">
    <p class="mt-1">Catatan :<br>
        <i class="mdi mdi-information"></i> Setelah anda merubah password anda, silahkan keluar (logout) dan login kembali menggunakan password baru anda. <br>
    </p>
    <!-- <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Username<code>*</code></label>
        <div class="col-sm-4">
            <input type="text" class="form-control" value="<?= session()->get('username') ?>" readonly>
        </div>
        <div class="col-sm-4">
          <button type="button" class="btn btn-primary" onclick="edit_username('<?= session()->get('user_id') ?>')" ><i class=" fa fa-edit mr-1"></i>Ganti Username</button>
        </div>
    </div> -->
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Password<code>*</code></label>
        <div class="col-sm-4">
            <input type="text" class="form-control" placeholder="************" readonly>
        </div>
        <div class="col-sm-4">
          <button type="button" class="btn btn-info" onclick="edit_password('<?= session()->get('user_id') ?>')" ><i class=" fa fa-edit mr-1"></i>Ganti Password</button>
        </div>
    </div>
  </div>
</div>

<div class="card shadow-lg">
  <div class="card-body">
    <div class="container-fluid">
          <div class="row">
            <div class="col">
                <div class="card-header pb-0">
                  <h6 class="card-title mb-2">Data Diri Peserta</h6>
                  <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                </div>
                <div class="card-body">
                <?= form_open('akun/biodata_peserta_update', ['class' => 'formtambah']) ?>
                <?= csrf_field() ?>
                    <div class="form-group">
                    <input type="hidden" id="user_id" name="user_id" value="<?= session()->get('user_id') ?>">
                    <input type="hidden" id="peserta_id" name="peserta_id" value="<?= $peserta_id ?>">
                      <!-- <div class="mb-3">
                        <label class="form-label">Nama Akun</label>
                        <input class="form-control" type="text" placeholder="<?= session()->get('nama') ?>" disabled>
                      </div> -->
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">NIK KTP (16 Digit)</label>
                        <input class="form-control" type="text" id="nik" name="nik"  value="<?= $nik ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">NIS</label>
                        <input class="form-control" type="text" id="nis" name="nis"  value="<?= $nis ?>"  disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Nama Lengkap (Sesuai KTP) <code>*</code> </label>
                        <input class="form-control text-uppercase" type="text" id="nama" name="nama"  value="<?= $nama ?>" disabled>
                        <div class="invalid-feedback errorNama">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                          <div class="form-group">
                            <label class="form-label">Tempat Lahir<code>*</code></label>
                            <input class="form-control text-uppercase" type="text" id="tmp_lahir" name="tmp_lahir"  value="<?= $tmp_lahir ?>">
                            <div class="invalid-feedback errorTmp_lahir">
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                          <div class="form-group">
                            <label class="form-label">Tanggal Lahir<code>*</code></label>
                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"  value="<?= $tgl_lahir ?>">
                            <div class="invalid-feedback errorTgl_lahir">
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Jenis Kelamin<code>*</code></label>
                        <input class="form-control text-uppercase" type="text" id="jenkel" name="jenkel"  value="<?= $jenkel ?>" disabled>
                        <div class="invalid-feedback errorJenkel">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Pendidikan Terakhir<code>*</code></label>
                        <select class="form-control btn-square" id="pendidikan" name="pendidikan">
                            <option value="SD" <?php if ($pendidikan == 'SD') echo "selected"; ?>>SD</option>
                            <option value="SLTP" <?php if ($pendidikan == 'SLPT') echo "selected"; ?>>SLTP</option>
                            <option value="SLTA" <?php if ($pendidikan == 'SLTA') echo "selected"; ?>>SLTA</option>
                            <option value="DIPLOMA" <?php if ($pendidikan == 'DIPLOMA') echo "selected"; ?>>DIPLOMA</option>
                            <option value="SARJANA" <?php if ($pendidikan == 'SARJANA') echo "selected"; ?>>SARJANA (S1)</option>
                            <option value="MAGISTER" <?php if ($pendidikan == 'MAGISTER') echo "selected"; ?>>MAGISTER (S2)</option>
                            <option value="DOKTOR" <?php if ($pendidikan == 'DOKTOR') echo "selected"; ?>>DOKTOR (S3)</option>
                            <option value="TIDAK DIKETAHUI"  <?php if ($pendidikan == 'TIDAK DIKETAHUI') echo "selected"; ?>>TIDAK DIKETAHUI</option>
                        </select>
                        <div class="invalid-feedback errorPendidikan">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Jurusan Pendidikan Terakhir<code>*</code></label>
                        <input class="form-control text-uppercase" type="text" id="jurusan" name="jurusan" value="<?= $jurusan ?>">
                        <div class="invalid-feedback errorJurusan">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Status Bekerja<code>*</code></label>
                        <select class="form-control btn-square" id="status_kerja" name="status_kerja">
                            <option value="0" <?php if ($status_kerja == '0') echo "selected"; ?>>TIDAK DALAM IKATAN KERJA</option>
                            <option value="1" <?php if ($status_kerja == '1') echo "selected"; ?>>BEKERJA</option>
                        </select>
                        <div class="invalid-feedback errorStatuskerja">
                      </div>
                    </div>
                    <div class="form-group">
                    <div class="mb-3">
                      <label class="form-label">Pekerjaan<code>*</code></label>
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
                            <option value="PENSIUNAN"  <?php if ($pekerjaan == 'PENSIUNAN') echo "selected"; ?>>PENSIUNAN</option>
                            <option value="LAINNYA" <?php if ($pekerjaan == 'LAINNYA') echo "selected"; ?>>LAINNYA</option>
                            <option value="TIDAK DIKETAHUI" <?php if ($pekerjaan == 'TIDAK DIKETAHUI') echo "selected"; ?>>TIDAK DIKETAHUI</option>
                        </select>
                      <div class="invalid-feedback errorPekerjaan">
                    </div>
                  </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label"> No. HP (WhatsApp)<code>*</code></label>
                        <input class="form-control" type="text" id="hp" name="hp" value="<?= $hp ?>">
                        <div class="invalid-feedback errorHp">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">E-Mail<code>*</code></label>
                        <input class="form-control text-lowercase" type="text" id="email" name="email" value="<?= $email ?>" disabled>
                        <div class="invalid-feedback errorEmail">
                      </div>
                    </div>
                    <div class="form-group">
                    <div class="mb-3">
                      <label class="form-label">Domisili<code>*</code></label>
                      <select class="form-control btn-square" id="domisili_peserta" name="domisili_peserta">
                        <option value="BALIKPAPAN"  <?php if ($domisili_peserta == 'BALIKPAPAN') echo "selected"; ?>>BALIKPAPAN</option>
                        <option value="LUAR BALIKPAPAN" <?php if ($domisili_peserta == 'LUAR BALIKPAPAN') echo "selected"; ?>>LUAR BALIKPAPAN</option>
                      </select>
                      <div class="invalid-feedback errorDomisili_peserta">
                    </div>
                  </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Alamat<code>*</code></label>
                        <input class="form-control text-uppercase" type="text-area" id="alamat" name="alamat" value="<?= $alamat ?>">
                        <div class="invalid-feedback errorAlamat">
                      </div>
                    </div>
                </div>
                <div style="position: absolute; right: 0;" class="row">
                  <input  class="btn btn-warning mb-6 mr-4" type="submit" value="Update" ></input>
                </div>
                <?= form_close() ?>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<div class="viewmodaleditusername">
</div>

<div class="viewmodaleditpassword">
</div>

<script>
  function edit_username(user_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('akun/biodata_edit_username') ?>",
            data: {
                user_id : user_id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaleditusername').html(response.sukses).show();
                    $('#modaleditusername').modal('show');
                }
            }
        });
    }

    function edit_password(user_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('akun/biodata_edit_password') ?>",
            data: {
                user_id : user_id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaleditpassword').html(response.sukses).show();
                    $('#modaleditpassword').modal('show');
                }
            }
        });
    }

    $('.formtambah').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    user_id: $('input#user_id').val(),
                    nama: $('input#nama').val(),
                    nik: $('input#nik').val(),
                    tmp_lahir: $('input#tmp_lahir').val(),
                    tgl_lahir: $('input#tgl_lahir').val(),
                    jenkel: $('select#jenkel').val(),
                    pendidikan: $('select#pendidikan').val(),
                    jurusan: $('input#jurusan').val(),
                    status_kerja: $('select#status_kerja').val(),
                    pekerjaan: $('select#pekerjaan').val(),
                    hp: $('input#hp').val(),
                    email: $('input#email').val(),
                    domisili_peserta: $('select#domisili_peserta').val(),
                    alamat: $('input#alamat').val(),
                    // level_peserta: $('select#level_peserta').val(),
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

                        if (response.error.jenkel) {
                            $('#jenkel').addClass('is-invalid');
                            $('.errorJenkel').html(response.error.jenkel);
                        } else {
                            $('#jenkel').removeClass('is-invalid');
                            $('.errorJenkel').html('');
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
                            $('.errorStatuskerja').html(response.error.status_kerja);
                        } else {
                            $('#status_kerja').removeClass('is-invalid');
                            $('.errorStatuskerja').html('');
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

                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Data Lengkap Diri Anda Berhasil Diubah",
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
</script>
<?= $this->endSection('isi') ?>