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
    <table id="datatable" class="table table-striped table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>No.</th>
                <th>Transaksi ID</th>
                <th>Bukti <br> Bayar</th>
                <th>Rincian</th>
                <th>Status <br> Bayar</th>
                <th>Status <br> Konfirmasi</th>
                <th>Tgl & Waktu</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 0;
            foreach ($bayar as $data) :
                $nomor++;  ?>
                <tr>
                    <td width="1%"><?=$nomor?></td>
                    <td width="1%"><?= $data['bayar_id'] ?></td>
                    <td width="15%">
                        <style>
                            .zoom {
                                transition: transform .2s; /* Animation */
                            }

                            .zoom:hover {
                                transform: scale(2.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
                            }
                        </style>
                        <img class="zoom" title="" src="<?= base_url('/img/transfer/' . $data['bukti_bayar']) ?>" alt="" width="150" align="right" border="1" hspace="" vspace="" />
                    </td>
                    <td width="12%">
                        <?php if($data['status_konfirmasi'] == 'Terkonfirmasi') { ?>
                            <a>Total: Rp <?= rupiah($data['nominal_bayar']) ?></a> <br>
                            <a>Daftar: Rp <?= rupiah($data['awal_bayar_daftar']) ?></a> <br>
                            <a>SPP1: Rp <?= rupiah($data['awal_bayar_spp1']) ?></a> <br>
                            <a>SPP2: Rp <?= rupiah($data['awal_bayar_spp2']) ?></a> <br>
                            <a>SPP3: Rp <?= rupiah($data['awal_bayar_spp3']) ?></a> <br>
                            <a>SPP4: Rp <?= rupiah($data['awal_bayar_spp4']) ?></a><br>
                            <a>Modul: Rp <?= rupiah($data['awal_bayar_modul']) ?></a> <br>
                            <a>Infaq: Rp <?= rupiah($data['awal_bayar_infaq']) ?></a> <br>
                            <a>Lain: Rp <?= rupiah($data['awal_bayar_lain']) ?></a> 
                        <?php } ?>
                        <?php if($data['status_konfirmasi'] == 'Proses') { ?>
                            <button class="btn btn-warning btn-sm mb-2" disabled>Proses</button>
                        <?php } ?>
                    </td>
                    <td width="8%">
                        <?php if($data['status_bayar_admin'] == 'SESUAI BAYAR') { ?>
                            <button class="btn btn-success btn-sm mb-2" disabled>SESUAI BAYAR</button>
                        <?php } ?>
                        <?php if($data['status_bayar_admin'] != 'SESUAI BAYAR') { ?>
                            <button class="btn btn-secondary btn-sm mb-2" disabled><?= $data['status_bayar_admin'] ?></button>
                        <?php } ?>
                        <p>Ket. <?= $data['keterangan_bayar_admin'] ?></p>
                    </td>
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
                    <td width="10%">
                        <?php if($data['tgl_bayar'] == '1000-01-01') { ?>
                            <a>Tgl Bayar: -</a> <br>
                        <?php } ?>
                        <?php if($data['tgl_bayar'] != '1000-01-01') { ?>
                            <a>Tgl Bayar:  <?= shortdate_indo($data['tgl_bayar'])?></a> <br>
                        <?php } ?>
                        <?php if($data['waktu_bayar'] == '00:00:00') { ?>
                          <a>Waktu Bayar: -</a> <br>
                        <?php } ?>
                        <?php if($data['waktu_bayar'] != '00:00:00') { ?>
                            <a>Waktu Bayar: <?= $data['waktu_bayar'] ?></a> <br>
                        <?php } ?>
                        <hr>
                        <?php if($data['tgl_bayar_konfirmasi'] == '1000-01-01') { ?>
                          <a>Tgl Konfirmasi: -</a> <br>
                        <?php } ?>
                        <?php if($data['tgl_bayar_konfirmasi'] != '1000-01-01') { ?>
                            <a>Tgl Konfirmasi: <?= shortdate_indo($data['tgl_bayar_konfirmasi'])?></a> <br>
                        <?php } ?>
                        <?php if($data['waktu_bayar_konfirmasi'] == '00:00:00') { ?>
                          <a>Waktu Konfirmasi: -</a> <br>
                        <?php } ?>
                        <?php if($data['waktu_bayar_konfirmasi'] != '00:00:00') { ?>
                            <p>Waktu Konfirmasi: <?= $data['waktu_bayar_konfirmasi'] ?></p> <br>
                        <?php } ?>
                    </td>
                    <td width="10%"><?= $data['keterangan_bayar'] ?></td>
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