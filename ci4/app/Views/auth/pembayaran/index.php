<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<button type="button" class="btn btn-primary mb-3" onclick="tambah('')"><i class=" fa fa-plus-circle"></i> Tambah Pembayaran</button>

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

<div class="table-responsive">
<table id="datatable" class="table table-striped table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>No.</th>
            <th>ID Bayar</th>
            <th>Peserta</th>
            <th>Program Kelas</th>
            <th>Upload Bayar</th>
            <th>Nominal Bayar</th>
            <th>Bukti Transfer</th>
            <th>Status Konfirmasi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 0;
        foreach ($list as $data) :
            $nomor++;  ?>
            <tr>
                <td width="2%"><?=$nomor?></td>
                <td width="5%"><?= $data['bayar_id'] ?></td>
                <td width="15%">
                    <h6>Nama: <?= $data['nama_peserta'] ?></h6>
                    <p>NIS: <?= $data['nis'] ?></p>
                </td>
                <td width="15%">
                    <p>Prgram: <?= $data['nama_program'] ?></p>
                    <p>Kelas: <?= $data['nama_kelas'] ?></p>
                    <p>Hari: <?= $data['hari_kelas'] ?></p>
                    <p>Waktu: <?= $data['waktu_kelas'] ?></p>
                    <p>Pengajar: <?= $data['nama_pengajar'] ?></p>
                </td>
                <td width="10%">
                    <p>Tgl:  <?= shortdate_indo($data['tgl_bayar'])?></p>
                    <p>Jam: <?= $data['waktu_bayar'] ?></p>
                </td>
                <td width="11%">
                    <?php if($data['status_konfirmasi'] == 'Terkonfirmasi') { ?>
                        <p>Rp <?= rupiah($data['nominal_bayar']) ?></p> 
                    <?php } ?>
                    <?php if($data['status_konfirmasi'] == 'Proses') { ?>
                        <button class="btn btn-warning btn-sm mb-2" disabled>Proses</button>
                    <?php } ?>
                </td>
                <td width="18%">
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
                <td width="10%">
                    <?php if($data['status_konfirmasi'] == 'Proses') { ?>
                        <button class="btn btn-secondary btn-sm" disabled>Proses</button> 
                    <?php } ?>
                    <?php if($data['status_konfirmasi'] == 'Terkonfirmasi') { ?>
                        <button class="btn btn-success btn-sm mb-2" disabled>Terkonfirmasi</button>
                        <p>Validator: <?= $data['validator'] ?></p> 
                    <?php } ?>
                    <?php if($data['status_konfirmasi'] == 'Tolak') { ?>
                        <button class="btn btn-danger btn-sm mb-2" disabled>Tolak</button>
                        <p>Validator: <?= $data['validator'] ?></p> 
                    <?php } ?>
                    <?php if($data['tgl_bayar_konfirmasi'] == '1000-01-01') { ?>
                        <p>Belum Terkonfirmasi</p> 
                    <?php } ?>
                    <?php if($data['tgl_bayar_konfirmasi'] != '1000-01-01') { ?>
                        <p>Tgl:  <?= shortdate_indo($data['tgl_bayar_konfirmasi'])?></p>
                        <p>Jam: <?= $data['waktu_bayar_konfirmasi'] ?></p>
                    <?php } ?>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>
</div>

<div class="viewmodaltambah">
</div>

<script>
    function tambah() {
        $.ajax({
            type: "post",
            url: "<?= site_url('pembayaran/input_bayar') ?>",
            data: {
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaltambah').html(response.sukses).show();
                    $('#modaltambah').modal('show');
                }
            }
        });
    }

</script>


<?= $this->endSection('isi') ?>