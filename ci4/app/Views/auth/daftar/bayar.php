<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?> </h4>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
</p>

<?php if ($cek1 != 0) { ?>
  <!-- Container-fluid starts-->
<div class="container-fluid">
            <div class="edit-profile">
              <div class="row">
                <div class="col">
                    <div class="card-header pb-0">
                      <h6 class="card-title mb-2">Formulir Konfirmasi Pembayaran Pendaftaran</h6>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="swal" data-swal="<?= session()->get('pesan'); ?>"></div>
                    <p class="mt-3">Catatan :<br> 
                      <i class="mdi mdi-information"></i> Anda harus mengupload bukti transfer dan klik tombol "Konfirmasi Pembayaran". <br>
                      <i class="mdi mdi-information"></i> Jika "Status Konfirmasi" bertulis "Proses" maka, bukti transfer anda berhasil dikirim dan menunggu konfirmasi admin. <br>
                      <i class="mdi mdi-information"></i> Minimal nilai pembayaran yang harus anda bayarkan adalah <b>Total Pendaftaran + SPP 1 + Modul</b>. <br>
                    </p>
                    <h6> <u> Metode Pembayaran Transfer Bank Dapat Melalui Pilihan Rekening Berikut:</u> <br></h6>
                    <?php foreach ($bank as $key => $data) { ?>
                      <h6><i class="mdi mdi-bank-transfer"></i> <?= $data['nama_bank'] ?> = <?= $data['rekening_bank'] ?> a.n <?= $data['atas_nama_bank'] ?></h6>
                      <?php } ?>
                    
                    <h5  style="text-align:center"> Anda Daftar Pada Program : </h5>
                    <div class="card-body">
                      <div class="row">
                        <div class="table-responsive">
                        <table id="" class="table table-striped table-bordered b-0 fixed-solution " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                          <thead>
                              <tr>
                                  <th width="15%">Nama Pendaftar</th>
                                  <th width="15%">Program & Kelas</th>
                                  <th width="10%">Total SPP Program</th>
                                  <th width="7%">Biaya Pendaftaran</th>
                                  <th width="10%">SPP Perbulan</th>
                                  <th width="7%">Biaya Modul</th>
                                  <th width="18%">Total Bayar</th>
                                  <th width="10%">Batal Pendaftaran</th>
                              </tr>
                          </thead>
                          <tbody>
                                  <tr>
                                      <td><?= $program_bayar[0]['nama_peserta'] ?></td>
                                      <td>
                                        Program: <?= $program_bayar[0]['nama_program'] ?> <br>
                                        Kelas: <?= $program_bayar[0]['nama_kelas'] ?> <br>
                                        Hari: <?= $program_bayar[0]['hari_kelas'] ?> <br>
                                        Jam: <?= $program_bayar[0]['waktu_kelas'] ?>
                                      </td>
                                      <td>Rp <?= rupiah($program_bayar[0]['biaya_program']) ?></td>
                                      <td>Rp <?= rupiah($program_bayar[0]['biaya_daftar']) ?></td>
                                      <td>Rp <?= rupiah($program_bayar[0]['biaya_bulanan']) ?> (x4)</td>
                                      <td>Rp <?= rupiah($program_bayar[0]['biaya_modul']) ?></td>
                                      <td> 
                                      Total Bayar Lunas = <br> <b>Rp <?= rupiah( $program_bayar[0]['biaya_program']+$program_bayar[0]['biaya_daftar']+$program_bayar[0]['biaya_modul']) ?></b>
                                      <hr>
                                        Total Pendaftaran + SPP 1 + Modul= <br> <b>Rp <?= rupiah($program_bayar[0]['biaya_bulanan']+$program_bayar[0]['biaya_daftar']+$program_bayar[0]['biaya_modul']) ?></b>
                                      </td>
                                      <td>
                                      <?php if($program_bayar[0]['status_konfirmasi'] == '') { ?>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $program_bayar[0]['bayar_id'] ?>')">Batal</button>
                                      <?php } ?>
                                      <?php if($program_bayar[0]['status_konfirmasi'] != '') { ?>
                                        <p>-</p>
                                      <?php } ?>
                                      </td> 
                                  </tr>
                          </tbody>
                        </table>
                        </div>
                        
                      </div>
                        <h5 style="text-align:center"> Status Konfirmasi : <button class="btn btn-warning" disabled><?= $program_bayar[0]['status_konfirmasi'] ?></button> </h5>
                        <?php
                          if (session()->getFlashdata('pesan_eror')) {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                              </button> <i class="mdi mdi-alert-circle"></i> <strong>';
                              echo session()->getFlashdata('pesan_eror');
                              echo ' </strong> </div>';
                          }
                          ?>

                          <?php
                          if (session()->getFlashdata('pesan_sukses')) {
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                              </button> <i class="mdi mdi-check-circle"></i> <strong>';
                              echo session()->getFlashdata('pesan_sukses');
                              echo ' </strong> </div>';
                          }
                          ?>

                        <?php if($program_bayar[0]['status_konfirmasi'] == '') { ?>
                            
                        
                        <?php echo form_open_multipart('/daftar/bayarprogram');
                        helper('text');
                        ?>
                        <?= csrf_field() ?>
                        <input type="hidden" name="bayar_id" id="bayar_id" value="<?= $program_bayar[0]['bayar_id'] ?>" />
                        <div class="form-group">
                          <div class="mb-3">
                            <label class="form-label">Total Nominal Transfer<code>*</code></label>
                              <input class="form-control number-separator" type="text" id="awal_bayar" name="awal_bayar" placeholder="Input Nominal Transfer">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="mb-3">
                            <label class="form-label">Pendaftaran <code>*</code></label>
                            <input class="form-control number-separator" type="text" id="daftar" name="daftar" placeholder="Input Nominal Daftar" value="<?= $program_bayar[0]['biaya_daftar'] ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="mb-3">
                            <label class="form-label">SPP-1 <code>*</code></label>
                            <input class="form-control number-separator" type="text" id="spp1" name="spp1" placeholder="Input Nominal SPP-1" value="<?= $program_bayar[0]['biaya_bulanan'] ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="mb-3">
                            <label class="form-label">SPP-2 <code>*</code></label>
                            <input class="form-control number-separator" type="text" id="spp2" name="spp2" placeholder="(Masukan 0 jika hanya bayar untuk daftar dan SPP-1)">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="mb-3">
                            <label class="form-label">SPP-3 <code>*</code></label>
                            <input class="form-control number-separator" type="text" id="spp3" name="spp3" placeholder="(Masukan 0 jika hanya bayar untuk daftar dan SPP-1)">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="mb-3">
                            <label class="form-label">SPP-4 <code>*</code></label>
                            <input class="form-control number-separator" type="text" id="spp4" name="spp4" placeholder="(Masukan 0 jika hanya bayar untuk daftar dan SPP-1)">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="mb-3">
                            <label class="form-label">Infaq <code>*</code></label>
                            <input class="form-control number-separator" type="text" id="infaq" name="infaq" placeholder="(Masukan 0 jika tidak ada infaq)">
                          </div>
                        </div>
                        <div class="form-group">
                        <div class="form-group">
                          <div class="mb-3">
                            <label class="form-label">Modul <code>*</code></label>
                            <input class="form-control number-separator" type="text" id="modul" name="modul" placeholder="(Masukan 0 jika tidak membayar modul)" value="<?= $program_bayar[0]['biaya_modul'] ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="mb-3">
                            <label class="form-label">Biaya Lainnya (Merchandise, dsb) <code>*</code></label>
                            <input class="form-control number-separator" type="text" id="lain" name="lain" placeholder="(Masukan 0 jika tidak biaya lainnya)">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="mb-3">
                            <label class="form-label">Keterangan Transfer</label>
                            <input class="form-control text-uppercase" type="text-area" id="keterangan_bayar" name="keterangan_bayar" placeholder="Masukan Keterangan Pengiring (jika ada)">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-sm-2 col-form-label">Upload Bukti Transfer<code>*</code></label>
                          <div class="col-lg-6">
                              <div class="input-group">
                                  <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="foto" name="foto" onchange="previewimg()">
                                      <label class="custom-file-label">Upload Bukti Transfer</label>
                                  </div>
                              </div>
                          </div>
                          <div class="invalid-feedback errorFoto"></div>
                          <div class="col-lg-6 mt-2">
                            <div class="media">
                                <img src="" class="img-preview img-thumbnail rounded img-fluid" width="50%" alt >
                            </div>
                          </div>
                      </div>
                        <button class="btn btn-warning mt-5" type="submit">Konfirmasi Pembayaran</button>
                        <?php echo form_close() ?>
                      </div>
                      <?php } ?>  
                    </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
<?php } ?>

<?php if ($cek1 == 0) { ?>
  <div class="alert alert-secondary alert-dismissible fade show" role="alert"> <i class="mdi mdi-account-multiple-outline"></i>
        <strong>Anda Belum Memiliki Program Yang Akan Dibayar. Silihkan Pilih Program Dan Kelas Dahulu di Menu Pilih Program & Jadwal</strong> 
  </div>  
<?php } ?>

<script>
  $(document).ready(function () {
			$('#awal_bayar').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});
			$('#daftar').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});
      $('#spp1').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});
      $('#spp2').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0, allowZero:true});
      $('#spp3').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0, allowZero:true});
      $('#spp4').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0, allowZero:true});
      $('#infaq').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0, allowZero:true});
      $('#modul').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0, allowZero:true});
      $('#lain').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0, allowZero:true});
  });


  function hapus(bayar_id) {
        Swal.fire({
            title: 'Batal Daftar?',
            text: `Apakah anda yakin membatalkan pendaftaran program/kelas ini?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('daftar/batalprogram') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        bayar_id: bayar_id
                    },
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Anda berhasil membatalkan ambil program/kelas",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location = response.sukses.link;
                        });
                        }
                    }
                });
            }
        })
    }
</script>

<?= $this->endSection('isi') ?>