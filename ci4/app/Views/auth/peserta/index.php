<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<a> 
    <button type="button" class="btn btn-primary mb-3" onclick="tambah('')" ><i class=" fa fa-plus-circle"></i> Tambah Peserta</button>
</a>

<a class="ml-5"> 
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#importexcel" ><i class=" fa fa-file-excel"></i> Import File Excel</button>
</a>

<a href="/peserta/export"> 
    <button type="button" class="btn btn-secondary mb-3"><i class=" fa fa-file-download"></i> Download Data</button>
</a>

<?php
// if (session()->getFlashdata('pesan_error')) {
//     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
//     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//         <span aria-hidden="true">×</span>
//     </button> <i class="mdi mdi-alert-circle"></i> <strong>';
//     echo session()->getFlashdata('pesan_error');
//     echo ' </strong> </div>';
// }
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
                <th>NIS</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Asal Cb.</th>
                <th>Jenis Kelamin</th>
                <th>No. HP</th>
                <th>Level</th> 
                <th>Angkatan</th>
                <th>Usia</th>
                <th>Status</th>
                <th>Akun</th>
                <th>Tindakan</th>
            </tr>
        </thead>

        <tbody>
            <?php $nomor = 0;
            foreach ($list as $data) :
                $nomor++; ?>
                <tr>
                    <td width="2%"><?= $nomor ?></td>
                    <td width="5%"><?= $data['nis'] ?></td>
                    <td width="10%"><?= $data['nama_peserta'] ?></td>
                    <td width="10%"><?= $data['nik'] ?></td>
                    <td width="10%"><?= $data['nama_kantor'] ?></td>
                    <td width="5%"><?= $data['jenkel'] ?></td>
                    <td width="5%"><?= $data['hp'] ?></td>
                    <td width="5%"><?= $data['nama_level'] ?></td>
                    <td width="5%"><?= $data['angkatan'] ?></td>
                    <td width="5%"><?= umur($data['tgl_lahir']) ?> Tahun</td>
                    <td width="5%">
                        <?php if($data['status_peserta'] == 'AKTIF') { ?>
                            <button class="btn btn-success btn-sm" disabled>AKTIF</button> 
                        <?php } ?>
                        <?php if($data['status_peserta'] == 'OFF') { ?>
                            <button class="btn btn-secondary btn-sm" disabled>OFF</button> 
                        <?php } ?>
                        <?php if($data['status_peserta'] == 'CUTI') { ?>
                            <button class="btn btn-secondary btn-sm" disabled>CUTI</button> 
                        <?php } ?>
                    </td>
                    <td width="5%"> <button class="btn btn-primary btn-sm" disabled> <?= $data['username'] ?></button></td>
                    <td width="5%">
                        <button type="button" class="btn btn-secondary" onclick="datadiri('<?= $data['peserta_id'] ?>')" >
                        <i class=" fa fa-info"></i></button>
                        <button type="button" class="btn btn-warning" onclick="edit('<?= $data['peserta_id'] ?>')" >
                        <i class=" fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger" onclick="hapus('<?= $data['peserta_id'] ?>')" >
                        <i class=" fa fa-trash"></i></button>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="viewmodaltambah">
</div>

<div class="viewmodaldatadiri">
</div>

<div class="viewmodaldataedit">
</div>

<!-- Start Modal Import File Excel -->
<div class="modal fade" id="importexcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import File Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart('/peserta/import_file');
            ?>
            <?= csrf_field() ?>
            <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih File Excel</label>
                        <input type="file" class="form-control" name="file_excel" accept=".xls, .xlsx">
                    </div>
            </div>    
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btnsimpan"><i class="fa fa-file-upload"></i> Import</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

            <?php echo form_close() ?>
        </div>
    </div>
</div>
<!-- End Modal Import File Excel -->

<script>

    function tambah() {
        $.ajax({
            type: "post",
            url: "<?= site_url('peserta/input_peserta') ?>",
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

    function datadiri(peserta_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('peserta/datadiri') ?>",
            data: {
                peserta_id: peserta_id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaldatadiri').html(response.sukses).show();
                    $('#modaldatadiri').modal('show');
                }
            }
        });
    }

    function edit(peserta_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('peserta/edit_peserta') ?>",
            data: {
                peserta_id: peserta_id
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

    function hapus(peserta_id) {
        Swal.fire({
            title: 'Yakin Hapus Data Peserta ini?',
            text: `Data Peserta dalam Kelas & Riwayat Pembayaran Terkait Data Peserta ini Akan Hilang Juga.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('peserta/hapus_peserta') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        peserta_id : peserta_id
                    },
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Anda berhasil menghapus data peserta ini!",
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