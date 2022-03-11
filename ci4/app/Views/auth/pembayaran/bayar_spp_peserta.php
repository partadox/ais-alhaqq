<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<div class="card shadow-lg">
  <div class="card-header pb-0">
    <h6 class="card-title mb-2">Pembayaran SPP</h6>
    <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
  </div>
  <div class="card-body">
  <?php
    if (session()->getFlashdata('pesan_error')) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button> <i class="mdi mdi-alert-circle"></i> <strong>';
        echo session()->getFlashdata('pesan_error');
        echo ' </strong> </div>';
    }
    if (session()->getFlashdata('pesan_sukses')) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button> <i class="mdi mdi-check-circle"></i> <strong>';
        echo session()->getFlashdata('pesan_sukses');
        echo ' </strong> </div>';
    }
    ?>
    <p class="mt-1">Catatan :<br>
        <i class="mdi mdi-information"></i> Pilih kelas anda kemudian klik tombol <b>Lakukan Pembayaran</b>. <br>
        <i class="mdi mdi-information"></i> Masukan nominal transfer dan masukan nominal bayar pada setiap kategori. <br>
    </p>
    
    <div class="table-responsive">
    <table id="kelaspeserta" class="table table-striped table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>No.</th>
                <th>Program</th>
                <th>Kelas</th>
                <th>Pendaftaran</th>
                <th>SPP-1</th>
                <th>SPP-2</th>
                <th>SPP-3</th>
                <th>SPP-4</th>
                <th>Modul</th>
                <th>Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 0;
            foreach ($kelas as $data) :
                $nomor++;  ?>
                <tr>
                    <td width="1%"><?=$nomor?></td>
                    <td width="8%"><?= $data['nama_program'] ?></td>
                    <td width="8%"><?= $data['nama_kelas'] ?></td>
                    <td width="3%">
                        <?php if($data['byr_daftar'] == 1) { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['byr_spp1'] == 1) { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['byr_spp2'] == 1) { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['byr_spp3'] == 1) { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['byr_spp4'] == 1) { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['byr_modul'] == '0') { ?>
                            <i class=" fa fa-minus" style="color:grey"></i>
                        <?php } ?>
                        <?php if($data['byr_modul'] == 1) { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="10%">
                            <button type="button" class="btn btn-success" onclick="bayar(<?= $data['kelas_id'] ?>, <?= $data['peserta_id'] ?>, <?= $data['peserta_kelas_id'] ?>)" >
                            <i class=" fa fa-money-bill-wave mr-1"></i>Lakukan Pembayaran</button>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
    </div>

  </div>
</div>

<div class="viewmodalbayar">
</div>


<script>
    function bayar(kelas_id, peserta_id, peserta_kelas_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('pembayaran/input_pembayaran_spp_peserta') ?>",
            data: {
                kelas_id : kelas_id,
                peserta_id : peserta_id,
                peserta_kelas_id : peserta_kelas_id,
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalbayar').html(response.sukses).show();
                    $('#modalbayar').modal('show');
                }
            }
        });
    }
</script>
<?= $this->endSection('isi') ?>