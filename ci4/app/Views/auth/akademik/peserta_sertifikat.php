<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<?php if ($status_menu_sertifikat == 'TUTUP') { ?>
    <div class="card col d-flex justify-content-center">
        <div class="card-body">
            <h5 class="card-title">PENDAFTARAAN CETAK SERTIFIKAT BELUM DIBUKA</h5>
            <p class="card-text"> <b>Assalamu’alaikum Warahmatullahi Wabarakatuh</b> <br>
            Kami menginformasikan kepada seluruh peserta bahwa pendaftaran cetak sertifikat periode baru belum dibuka. <br>
            <b>Wassalamualaikum Warahmatullahi Wabarakatuh</b> <br> <br>
            <b>Hormat Kami,</b> <br>
            <i>Admin & Pengurus Al-Haqq</i>
            </p>
        </div>
    </div>
    <?php } ?>

<?php if ($status_menu_sertifikat == 'BUKA') { ?>
        
        
        <p class="mt-1">Catatan :<br>
            <i class="mdi mdi-information"></i> Anda dapat mengajukan cetak sertifikat setelah anda lulus pada suatu program (Untuk sekarang yang bisa mengajukan hanya peserta yang telah lulus program Tajwidi-2). <br>
        </p>

        <h5 class="text-center">Biaya Cetak Sertifikat Rp <?= rupiah($biaya_sertifikat) ?> </h5>

        <a> 
            <button type="button" class="btn btn-primary mb-3" onclick="tambah(<?= $peserta_id ?>)" ><i class=" fa fa-plus-circle"></i> Ajukan Cetak Sertifikat</button>
        </a>

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
            <table id="datatable" class="table table-striped table-bordered nowrap mt-5" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Periode Cetak</th>
                        <th>Lulus Level</th> 
                        <th>No. Sertifikat</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Nominal Bayar</th>
                        <th>Bukti Bayar</th>
                        <th>Keterangan</th>
                        <th>Download</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $nomor = 0;
                    foreach ($list as $data) :
                        $nomor++; ?>
                        <tr>
                            <td width="2%"><?= $nomor ?></td>
                            <td width="5%"><?= $data['periode_cetak'] ?></td>
                            <td width="8%"><?= $data['sertifikat_level'] ?></td>
                            <td width="5%"><?= $data['nomor_sertifikat'] ?></td>
                            <td width="5%">
                                <p>Pengajuan : <?= $data['dt_ajuan'] ?></p> 
                                <?php if($data['dt_konfirmasi'] == '1000-01-01 00:00:00') { ?>
                                    <p>Konfirmasi : </p>
                                <?php } ?>
                                <?php if($data['dt_konfirmasi'] != '1000-01-01 00:00:00') { ?>
                                    <p>Konfirmasi : <?= $data['dt_konfirmasi'] ?></p>
                                <?php } ?>
                            </td>
                            <td width="8%">
                                <?php if($data['status_cetak'] == 'Proses') { ?>
                                    <button class="btn btn-warning btn-sm" disabled>Proses</button> 
                                <?php } ?>
                                <?php if($data['status_cetak'] == 'Terkonfirmasi') { ?>
                                    <button class="btn btn-success btn-sm" disabled>Terkonfirmasi</button> 
                                <?php } ?>
                            </td>
                            <td width="5%">Rp <?= rupiah($data['nominal_bayar_cetak']) ?></td>
                            <td width="18%">
                                <style>
                                    .zoom {
                                        transition: transform .2s; /* Animation */
                                    }

                                    .zoom:hover {
                                        transform: scale(2.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
                                    }
                                </style>
                                <img class="zoom" title="" src="<?= base_url('/img/transfer/' . $data['bukti_bayar_cetak']) ?>" alt="" width="150" align="right" border="1" hspace="" vspace="" />
                            </td>
                            <td  width="8%"><?= $data['keterangan_cetak'] ?></td>
                            <td width="10%">
                                <?php if($data['link_cetak'] != NULL) { ?>
                                    <a href="<?= $data['link_cetak'] ?>" class="btn btn-info"> <i class="fa fa-download mr-1" style="font-size: 22px"></i> Download</a>
                                <?php } ?>
                                <?php if($data['link_cetak'] == NULL) { ?>
                                    <a>-</a>
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
            function tambah(peserta_id) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('akademik/input_pengajuan_sertifikat') ?>",
                    data: {
                        peserta_id : peserta_id,
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


<?php } ?>

<?= $this->endSection('isi') ?>