<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<div class="card shadow-lg">
  <div class="card-header pb-0">
    <h6 class="card-title mb-2">Riwayat Pembayaran</h6>
    <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
  </div>
  <div class="card-body">

  <div class="table-responsive">
    <table id="kelaspeserta" class="table table-striped table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>No.</th>
                <th>Program</th>
                <th>Kelas</th>
                <th>Status <br> Konfirmasi</th>
                <th>Tgl Input </th>
                <th>Waktu Input </th>
                <th>Tgl Konfirmasi </th>
                <th>Waktu Konfirmasi</th>
                <th>Keterangan</th>
                <th>Rincian <br> Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 0;
            foreach ($bayar as $data) :
                $nomor++;  ?>
                <tr>
                    <td width="1%"><?=$nomor?></td>
                    <td width="8%"><?= $data['nama_program'] ?></td>
                    <td width="8%"><?= $data['nama_kelas'] ?></td>
                    <td width="10%">
                      <?php if($data['status_konfirmasi'] == 'Proses') { ?>
                          <button class="btn btn-secondary btn-sm" disabled>Proses</button> 
                      <?php } ?>
                      <?php if($data['status_konfirmasi'] == 'Terkonfirmasi') { ?>
                          <button class="btn btn-success btn-sm mb-2" disabled>Terkonfirmasi</button>
                      <?php } ?>
                      <?php if($data['status_konfirmasi'] == 'Tolak') { ?>
                          <button class="btn btn-danger btn-sm mb-2" disabled>Tolak</button>
                      <?php } ?>
                    </td>
                    <td width="5%">
                      <?php if($data['tgl_bayar'] == '1000-01-01') { ?>
                          <p>-</p> 
                      <?php } ?>
                      <?php if($data['tgl_bayar'] != '1000-01-01') { ?>
                          <p>Tgl:  <?= shortdate_indo($data['tgl_bayar'])?></p>
                      <?php } ?>
                    </td>
                    <td width="5%">
                      <?php if($data['waktu_bayar'] == '00:00:00') { ?>
                          <p>-</p> 
                      <?php } ?>
                      <?php if($data['waktu_bayar'] != '00:00:00') { ?>
                          <p>Jam: <?= $data['waktu_bayar'] ?></p>
                      <?php } ?>
                    </td>
                    <td width="5%">
                      <?php if($data['tgl_bayar_konfirmasi'] == '1000-01-01') { ?>
                          <p>-</p> 
                      <?php } ?>
                      <?php if($data['tgl_bayar_konfirmasi'] != '1000-01-01') { ?>
                          <p>Tgl:  <?= shortdate_indo($data['tgl_bayar_konfirmasi'])?></p>
                      <?php } ?>
                    </td>
                    <td width="5%">
                      <?php if($data['waktu_bayar_konfirmasi'] == '00:00:00') { ?>
                          <p>-</p> 
                      <?php } ?>
                      <?php if($data['waktu_bayar_konfirmasi'] != '00:00:00') { ?>
                          <p>Jam: <?= $data['waktu_bayar_konfirmasi'] ?></p>
                      <?php } ?>
                    </td>
                    <td width="10%"><?= $data['keterangan_bayar'] ?></td>
                    <td width="9%">
                            <button type="button" class="btn btn-info" onclick="edit('<?= $data['kelas_id'] ?>')" >
                            <i class=" fa fa-info mr-1"></i>Rincian Pembayaran</button>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
    </div>

  </div>
</div>

<div class="viewmodaleditusername">
</div>

<div class="viewmodaleditpassword">
</div>

<script>
</script>
<?= $this->endSection('isi') ?>