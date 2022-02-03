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
        <i class="mdi mdi-information"></i> Setelah anda merubah username atau password anda, silahkan keluar (logout) untuk melihat hasil perubahannya. <br>
    </p>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Username<code>*</code></label>
        <div class="col-sm-4">
            <input type="text" class="form-control" value="<?= session()->get('username') ?>" readonly>
        </div>
        <div class="col-sm-4">
          <button type="button" class="btn btn-primary" onclick="edit_username('<?= session()->get('user_id') ?>')" ><i class=" fa fa-edit mr-1"></i>Ganti Username</button>
        </div>
    </div>
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

<!-- <div class="card shadow-lg">
  <div class="card-body">
    <div class="container-fluid">
          <div class="row">
            <div class="col">
                <div class="card-header pb-0">
                  <h6 class="card-title mb-2">Data Diri Peserta</h6>
                  <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                </div>
                <div class="card-body">
                <?= form_open('daftar/simpandaftar', ['class' => 'formtambah']) ?>
                <?= csrf_field() ?>
                    <div class="form-group">
                    <input type="hidden" id="user_id" name="user_id" value="<?= session()->get('user_id') ?>">
                      <div class="mb-3">
                        <label class="form-label">Nama Akun</label>
                        <input class="form-control" type="text" placeholder="<?= session()->get('nama') ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Nama Lengkap (Sesuai KTP) <code>*</code> </label>
                        <input class="form-control" type="text" id="nama" name="nama" placeholder="Masukan nama lengkap anda">
                        <div class="invalid-feedback errorNama">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">NIK KTP (16 Digit)<code>*</code></label>
                        <input class="form-control" type="text" id="nik" name="nik" placeholder="Masukan nomor NIK anda">
                        <div class="invalid-feedback errorNik">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                          <div class="form-group">
                            <label class="form-label">Tempat Lahir<code>*</code></label>
                            <input class="form-control" type="text" id="tmp_lahir" name="tmp_lahir" placeholder="Masukan kota tempat lahir anda">
                            <div class="invalid-feedback errorTmp_lahir">
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                          <div class="form-group">
                            <label class="form-label">Tanggal Lahir<code>*</code></label>
                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                            <div class="invalid-feedback errorTgl_lahir">
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Jenis Kelamin<code>*</code></label>
                        <select class="form-control btn-square" id="jenkel" name="jenkel">
                          <option value="" disabled selected>--Pilih--</option>
                          <option value="Ikhwan">Ikhwan</option>
                          <option value="Akhwat">Akhwat</option>
                        </select>
                        <div class="invalid-feedback errorJenkel">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Pendidikan Terakhir<code>*</code></label>
                        <select class="form-control btn-square" id="pendidikan" name="pendidikan">
                          <option value="" disabled selected>--Pilih--</option>
                          <option value="SD">SD</option>
                          <option value="SLTP">SLTP</option>
                          <option value="SLTA">SLTA</option>
                          <option value="Diploma">Diploma</option>
                          <option value="Sarjana">Sarjana (S1)</option>
                          <option value="Magister">Magister (S2)</option>
                        </select>
                        <div class="invalid-feedback errorPendidikan">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Jurusan Pendidikan Terakhir<code>*</code></label>
                        <input class="form-control" type="text" id="jurusan" name="jurusan" placeholder="Masukan jurusan pendidikan terakhir anda">
                        <div class="invalid-feedback errorJurusan">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Status Bekerja<code>*</code></label>
                        <select class="form-control btn-square" id="status_kerja" name="status_kerja">
                          <option value="" disabled selected>--Pilih--</option>
                          <option value="0">Tidak Dalam Ikatan Kerja</option>
                          <option value="1">Bekerja</option>
                        </select>
                        <div class="invalid-feedback errorStatuskerja">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Pekerjaan<code>*</code></label>
                        <select class="form-control btn-square" id="pekerjaan" name="pekerjaan">
                          <option value="" disabled selected>--Pilih--</option>
                          <option value="Swasta">Swasta</option>
                          <option value="Pegawai Swasta">Pegawai Swasta</option>
                          <option value="Pegawai Negeri">Pegawai Negeri</option>
                          <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>>
                          <option value="Pelajar / Mahasiswa">Pelajar / Mahasiswa</option>>
                          <option value="Freelance">Freelance</option>>
                        </select>
                        <div class="invalid-feedback errorPekerjaan">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label"> No. HP (WhatsApp)<code>*</code></label>
                        <input class="form-control" type="text" id="hp" name="hp" placeholder="Masukan nomor WA anda">
                        <div class="invalid-feedback errorHp">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">E-Mail<code>*</code></label>
                        <input class="form-control" type="text" id="email" name="email" placeholder="Masukan alamat email anda jika ada">
                        <div class="invalid-feedback errorEmail">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Alamat<code>*</code></label>
                        <input class="form-control" type="text-area" id="alamat" name="alamat" placeholder="Masukan alamat domisili anda">
                        <div class="invalid-feedback errorAlamat">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="mb-3">
                        <label class="form-label">Level Peserta Saat Ini<code>*</code></label>
                        <input class="form-control" type="text"  readonly>
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
</div> -->

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
</script>
<?= $this->endSection('isi') ?>