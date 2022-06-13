<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<!-- <button type="button" class="btn btn-primary mb-3" onclick="tambah('')"><i class=" fa fa-plus-circle"></i> Tambah Pembayaran</button> -->

<div class="row">
    <div class="col-sm-auto mb-2">
        <label for="angkatan_kelas">Pilih Angkatan Perkuliahan</label>
        <select onchange="javascript:location.href = this.value;" class="form-control js-example-basic-single" name="angkatan_kelas" id="angkatan_kelas" class="js-example-basic-single mb-2">
            <?php foreach ($list_angkatan as $key => $data) { ?>
            <option value="/ais/public/auth/pembayaran/<?= $data['angkatan_kelas'] ?>" <?php if ($angkatan_pilih == $data['angkatan_kelas']) echo "selected"; ?>> <?= $data['angkatan_kelas'] ?> </option>
            <?php } ?>
        </select>
    </div>
</div>

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
<table id="listbayar" class="table table-striped table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>No.</th>
            <th>Transaksi ID</th>
            <th>Peserta</th>
            <!-- <th>Program Kelas</th> -->
            <th>Upload Bayar</th>
            <th>Rincian Bayar</th>
            <th>Status <br> Pembayaran</th>
            <th>Bukti Transfer</th>
            <th>Status Konfirmasi</th>
            <th>Tindakan</th>
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
                    <p>Kelas: <?= $data['nama_kelas'] ?></p>
                </td>
                
                <td width="10%">
                    <p>Tgl:  <?= shortdate_indo($data['tgl_bayar'])?></p>
                    <p>Jam: <?= $data['waktu_bayar'] ?></p>
                </td>
                <td width="13%">
                    <?php if($data['status_konfirmasi'] == 'Terkonfirmasi') { ?>
                        <a>Total: Rp <?= rupiah($data['nominal_bayar']) ?></a> <br>
                        <a>Daftar: Rp <?= rupiah($data['awal_bayar_daftar']) ?></a> <br>
                        <a>SPP1: Rp <?= rupiah($data['awal_bayar_spp1']) ?></a> <br>
                        <a>SPP2: Rp <?= rupiah($data['awal_bayar_spp2']) ?></a> <br>
                        <a>SPP3: Rp <?= rupiah($data['awal_bayar_spp3']) ?></a> <br>
                        <a>SPP4: Rp <?= rupiah($data['awal_bayar_spp4']) ?></a><br>
                        <a>Modul: Rp <?= rupiah($data['awal_bayar_modul']) ?></a> <br>
                        <a>Infaq: Rp <?= rupiah($data['awal_bayar_infaq']) ?></a> <br>
                        <a>Lain: Rp <?= rupiah($data['awal_bayar_lain']) ?></a> <br>
                        <a>Ket: <?= $data['keterangan_bayar'] ?></a> 
                    <?php } ?>
                    <?php if($data['status_konfirmasi'] == 'Proses') { ?>
                        <button class="btn btn-warning btn-sm mb-2" disabled>Proses</button>
                    <?php } ?>
                </td>
                <td width="8%">
                    <?php if($data['status_bayar_admin'] == 'SESUAI BAYAR') { ?>
                        <button class="btn btn-success btn-sm mb-2" disabled>SESUAI BAYAR</button>
                    <?php } ?>
                    <?php if($data['status_bayar_admin'] == 'KURANG BAYAR') { ?>
                        <button class="btn btn-warning btn-sm mb-2" disabled><?= $data['status_bayar_admin'] ?></button>
                    <?php } ?>
                    <?php if($data['status_bayar_admin'] == 'LEBIH BAYAR') { ?>
                        <button class="btn btn-secondary btn-sm mb-2" disabled><?= $data['status_bayar_admin'] ?></button>
                    <?php } ?>
                    <?php if($data['status_bayar_admin'] == 'BELUM BAYAR') { ?>
                        <button class="btn btn-danger btn-sm mb-2" disabled><?= $data['status_bayar_admin'] ?></button>
                    <?php } ?>
                    <?php if($data['status_bayar_admin'] == 'BEBAS BIAYA') { ?>
                        <button class="btn btn-info btn-sm mb-2" disabled><?= $data['status_bayar_admin'] ?></button>
                    <?php } ?>
                    <p>Ket Adm: <br> <?= $data['keterangan_bayar_admin'] ?></p>
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
                <td width="10%">
                        <button type="button" class="btn btn-warning mb-2" onclick="edit('<?= $data['bayar_id'] ?>')" >
                        <i class=" fa fa-edit mr-1"></i>Edit</button>
                        <button type="button" class="btn btn-danger mb-2" onclick="hapus('<?= $data['bayar_id'] ?>')" >
                        <i class=" fa fa-trash mr-1"></i>Hapus</button>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>
</div>

<div class="viewmodaltambah">
</div>

<div class="viewmodaldataedit">
</div>

<script>
     $('#angkatan_kelas').bind('change', function () { // bind change event to select
        var url = $(this).val(); // get selected value
        if (url != '') { // require a URL
            window.location = url; // redirect
        }
        return false;
    });

    $(document).ready(function() {
        $('#listbayar').DataTable( {
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
    
                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );
    
                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        } );
    } );

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

    function edit(bayar_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('pembayaran/edit_bayar') ?>",
            data: {
                bayar_id : bayar_id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaldataedit').html(response.sukses).show();
                    $('#modaledit').modal('show');
                }
            }
        });
    }

    function hapus(bayar_id) {
        Swal.fire({
            title: 'Yakin Hapus Data Pembayaran ini?',
            text: `Data SPP/Infaq yang Terkait Data Pembayaran ini Akan Hilang Juga.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('pembayaran/hapus_bayar') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        bayar_id : bayar_id
                    },
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Anda berhasil menghapus pembayaran ini!",
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