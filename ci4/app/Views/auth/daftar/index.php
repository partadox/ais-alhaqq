<?= $this->extend('layout/awal_script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
  <!-- Container-fluid starts-->
<div class="container-fluid">
        <div class="row">
          <div class="col">
              <div class="card-header pb-0">
                <h6 class="card-title mb-2">Formulir Pendaftaran - Lengkapi Data Diri Anda</h6>
                <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
              </div>
              <p class="mt-1">Catatan :<br>
                  <i class="mdi mdi-information"></i> <code>Akun Belum Aktif</code><br>
                  <i class="mdi mdi-information"></i> Isi formulir pendaftaran, dan klik tombol "Daftar" untuk memilih program untuk peserta baru. <br>
                  <i class="mdi mdi-information"></i> Formulir berlabel <code>*</code> Wajib Diisi! <br>
                  <i class="mdi mdi-information"></i> Dapat mengisi tanggal degan cara klik icon <a><i class="mdi mdi-calendar-blank-outline"></i></a> atau isi dengan format tgl/bulan/tahun (cth: 30/01/1990) dalam angka. <br>
                  <i class="mdi mdi-information"></i> Jika anda berniat daftar di dua program peserta baru (Tajwidi-1 dan Tarjim), anda dapat memilih salah program terlebih dahulu kemudian ketika akun anda sudah aktif anda dapat melakukan penambahan program/kelas.<br>
              </p>
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
                      <input class="form-control text-uppercase" type="text" id="nama" name="nama" placeholder="Masukan nama lengkap anda">
                      <div class="invalid-feedback errorNama">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="mb-3">
                      <label class="form-label">NIK KTP (16 Digit)<code>*</code></label>
                      <input class="form-control" type="text" id="nik" name="nik" placeholder="MASUKAN NOMOR NIK ANDA">
                      <div class="invalid-feedback errorNik">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="mb-3">
                        <div class="form-group">
                          <label class="form-label">Tempat Lahir<code>*</code></label>
                          <input class="form-control text-uppercase" type="text" id="tmp_lahir" name="tmp_lahir" placeholder="Masukan kota tempat lahir anda">
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
                        <option value="" disabled selected>--PILIH--</option>
                        <option value="IKHWAN">IKHWAN</option>
                        <option value="AKHWAT">AKHWAT</option>
                      </select>
                      <div class="invalid-feedback errorJenkel">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="mb-3">
                      <label class="form-label">Pendidikan Terakhir<code>*</code></label>
                      <select class="form-control btn-square" id="pendidikan" name="pendidikan">
                        <option value="" disabled selected>--PILIH--</option>
                        <option value="SD">SD</option>
                        <option value="SLTP">SLTP</option>
                        <option value="SLTA">SLTA</option>
                        <option value="DIPLOMA">DIPLOMA</option>
                        <option value="SARJANA">SARJANA (S1)</option>
                        <option value="MAGISTER">MAGISTER (S2)</option>
                        <option value="DOKTOR">DOKTOR (S3)</option>
                      </select>
                      <div class="invalid-feedback errorPendidikan">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="mb-3">
                      <label class="form-label">Jurusan Pendidikan Terakhir<code>*</code></label>
                      <input class="form-control text-uppercase" type="text" id="jurusan" name="jurusan" placeholder="Masukan jurusan pendidikan terakhir anda">
                      <div class="invalid-feedback errorJurusan">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="mb-3">
                      <label class="form-label">Status Bekerja<code>*</code></label>
                      <select class="form-control btn-square" id="status_kerja" name="status_kerja">
                        <option value="" disabled selected>--PILIH--</option>
                        <option value="0">TIDAK DALAM IKATAN KERJA</option>
                        <option value="1">BEKERJA</option>
                      </select>
                      <div class="invalid-feedback errorStatuskerja">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="mb-3">
                      <label class="form-label">Pekerjaan<code>*</code></label>
                      <select class="form-control btn-square" id="pekerjaan" name="pekerjaan">
                        <option value="" disabled selected>--Pilih--</option>
                        <option value="WIRASWASTA">WIRASWASTA</option>
                        <option value="PEGAWAI SWASTA">PEGAWAI SWASTA</option>
                        <option value="PEMERINTAH/PNS">PEMERINTAH/PNS</option>
                        <option value="BUMN">BUMN</option>
                        <option value="USAHA/DAGANG">USAHA/DAGANG</option>
                        <option value="KEAMANAN/MILITER/POLISI">KEAMANAN/MILITER/POLISI</option>
                        <option value="PERBANKAN/KEUANGAN">PERBANKAN/KEUANGAN</option>
                        <option value="KESEHATAN">KESEHATAN</option>
                        <option value="PENDIDIKAN">PENDIDIKAN</option>
                        <option value="OLAHRAGA/ATLET">OLAHRAGA/ATLET</option>
                        <option value="KESENIAN/ARTIS">KESENIAN/ARTIS</option>
                        <option value="KEAGAMAAN/MAJELIS">KEAGAMAAN/MAJELIS</option>
                        <option value="PELAJAR/MAHASISWA">PELAJAR/MAHASISWA</option>
                        <option value="KELUARGA/RUMAH TANGGA">KELUARGA/RUMAH TANGGA</option>
                        <option value="FREELANCE">FREELANCE</option>
                        <option value="LAINNYA">LAINNYA</option>>
                      </select>
                      <div class="invalid-feedback errorPekerjaan">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="mb-3">
                      <label class="form-label"> No. HP (WhatsApp)<code>*</code></label>
                      <input class="form-control" type="text" id="hp" name="hp" placeholder="MASUKAN NOMOR HP/WA">
                      <div class="invalid-feedback errorHp">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="mb-3">
                      <label class="form-label">E-Mail<code>*</code></label>
                      <input class="form-control text-lowercase" type="text" id="email" name="email" placeholder="Masukan alamat email anda jika ada">
                      <div class="invalid-feedback errorEmail">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="mb-3">
                      <label class="form-label">Domisili<code>*</code></label>
                      <select class="form-control btn-square" id="domisili_peserta" name="domisili_peserta">
                        <option value="" disabled selected>--PILIH--</option>
                        <option value="BALIKPAPAN">BALIKPAPAN</option>
                        <option value="LUAR BALIKPAPAN">LUAR BALIKPAPAN</option>
                      </select>
                      <div class="invalid-feedback errorDomisili_peserta">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="mb-3">
                      <label class="form-label">Alamat<code>*</code></label>
                      <input class="form-control text-uppercase" type="text-area" id="alamat" name="alamat" placeholder="Masukan alamat domisili anda">
                      <div class="invalid-feedback errorAlamat">
                    </div>
                  </div>
              </div>
              <div style="position: absolute; right: 0;" class="row">
                <input  class="btn btn-warning mb-6 mr-4" type="submit" value="Daftar" ></input>
              </div>
              <?= form_close() ?>
          </div>
        </div>
    </div>
 <!-- Container-fluid Ends-->


<script>
    $(document).ready(function() {

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

                        // if (response.error.level_peserta) {
                        //     $('#level_peserta').addClass('is-invalid');
                        //     $('.errorLevel_peserta').html(response.error.level_peserta);
                        // } else {
                        //     $('#level_peserta').removeClass('is-invalid');
                        //     $('.errorLevel_peserta').html('');
                        // }

                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Akun Anda berhasil Diaktifkan, Silahkan Login Kembali!",
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
<?= $this->endSection('isi') ?>