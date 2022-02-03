<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<?php if ($cek1 != 0) { ?>
  <div class="alert alert-secondary alert-dismissible fade show" role="alert"> <i class="mdi mdi-account-multiple-outline"></i>
        <strong>Anda Sudah Memilih Program dan Perlu Menyelesaikan Pembayaran Pendaftaran.</strong> 
  </div>  
<?php } ?>

<?php if ($cek1 == 0 && $cek2 == 0) { ?>
 <div class="container-fluid">
  <p class="mt-1">Catatan :<br>
      <i class="mdi mdi-information"></i> Pilih kelas yang masih memiliki kouta. <br>
  </p>
   <div class="row">
      <?php
      foreach ($program as $data) :
      ?>
      <div class="col-sm-3 col-md-3">
        <div class="card shadow-lg p-3 mb-5 bg-white rounded">
          <div class="card-body">
            <h6><?= $data['nama_program'] ?></h6>
            <h5 class="card-title"><?= $data['nama_kelas'] ?></h5>
            <hr>
            <p> <i class="mdi mdi-calendar"></i> Hari = <?= $data['hari_kelas'] ?> </p>
            <p> <i class="mdi mdi-clock"></i> Waktu = <?= $data['waktu_kelas'] ?></p>
            <hr>
            <p> <i class="mdi mdi-cash-marker"></i> Biaya Pendaftaran = Rp <?= rupiah($data['biaya_daftar']) ?></p>
            <p> <i class="mdi mdi-cash-register"></i> SPP per Bulan = Rp <?= rupiah($data['biaya_bulanan']) ?> (x 4 Bulan)</p>
            <hr>
            <p> <i class="mdi mdi-bookmark-check"></i> Total Kouta = <?= $data['kouta'] ?></p>
            <h6> <i class="mdi mdi-bookmark-minus"> </i> Sisa Kouta = <?= $data['sisa_kouta'] ?> </h6>
            
              <input type="hidden" name="peserta_id" id="peserta_id" value="<?= $peserta['peserta_id'] ?>" />
              <input type="hidden" name="kelas_id" id="kelas_id" value="<?= $data['kelas_id'] ?>" />
              <input type="hidden" name="biaya_daftar" id="biaya_daftar" value="<?= $data['biaya_daftar'] ?>" />
              <input type="hidden" name="biaya_bulanan" id="biaya_bulanan" value="<?= $data['biaya_bulanan'] ?>" />
              <?php if($data['sisa_kouta'] == '0') { ?>
                        <button type="button" class="btn btn-danger btn-sm" disabled>PENUH</button>
                    <?php } ?>
                    <?php if($data['sisa_kouta'] != '0') { ?>
                        <input type='submit' class='btn btn-warning align-right' value='Daftar' onclick="daftar('<?= $data['kelas_id'] ?>')"></input>
                    <?php } ?>
            
          </div>
        </div>
      </div>
      <?php endforeach; ?>
   </div>
</div>
<?php } ?>

<?php if ($cek2 != 0) { ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="mdi mdi-account-multiple-outline"></i>
        <strong>Anda Sudah Terdaftar Pada Salah Satu Program di Al-Haqq. Jika Anda Ingin Daftar di Program Lain Silahkan Hubungi Admin</strong> 
  </div> 
<?php } ?>

<script>
    function daftar(kelas_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('daftar/daftar_program') ?>",
            data: {
                peserta_id: $('input#peserta_id').val(),
                kelas_id: kelas_id,
                biaya_daftar: $('input#biaya_daftar').val(),
                biaya_bulanan: $('input#biaya_bulanan').val(),
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

                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Anda Berhasil Memilih Program, Silahkan Lanjutkan Pembayaran!",
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
</script>
<?= $this->endSection('isi') ?>