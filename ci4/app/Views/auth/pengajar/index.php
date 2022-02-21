<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<a> 
    <button type="button" class="btn btn-primary mb-3" onclick="tambah('')" ><i class=" fa fa-plus-circle"></i> Tambah Pengajar</button>
</a>

<a class="ml-5"> 
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#importexcel" ><i class=" fa fa-file-excel"></i> Import File Excel</button>
</a>

<a href="<?= base_url('pengajar/export') ?>"> 
    <button type="button" class="btn btn-secondary mb-3"><i class=" fa fa-file-download"></i> Download Data</button>
</a>

<a href="<?= base_url('/template/Template_Pengajar_v1.xlsx') ?>"> 
    <button type="button" class="btn btn-info mb-3"><i class=" fa fa-file-excel"></i> Template Import File Excel</button>
</a>

<?php
if (session()->getFlashdata('pesan_sukses')) {
    echo '<div class="alert alert-secondary alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button> <strong>';
    echo session()->getFlashdata('pesan_sukses');
    echo ' </strong> </div>';
}
?>

<div class="table-responsive">
    <table id="datatable" class="table table-striped table-bordered nowrap mt-5" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>No.</th>
                <th>User Id</th>
                <th>Nama</th>
                <th>Kantor</th>
                <th>Tipe</th> 
                <th>Jenis Kelamin</th>
                <th>NIK</th>
                <th>Usia</th>
                <th>User Akun</th>
                <th>No. HP</th>
                <th>Tindakan</th>
            </tr>
        </thead>

        <tbody>
            <?php $nomor = 0;
            foreach ($list as $data) :
                $nomor++; ?>
                <tr>
                    <td width="5%"><?= $nomor ?></td>
                    <td width="5%"><?= $data['user_id'] ?></td>
                    <td width="14%"><?= $data['nama_pengajar'] ?></td>
                    <td width="8%"><?= $data['nama_kantor'] ?></td>
                    <td width="8%">
                        <?php if($data['tipe_pengajar'] == 'PENGAJAR') { ?>
                            <button class="btn btn-success btn-sm" disabled>PENGAJAR</button> 
                        <?php } ?>
                        <?php if($data['tipe_pengajar'] == 'PENGUJI') { ?>
                            <button class="btn btn-info btn-sm" disabled>PENGUJI</button> 
                        <?php } ?>
                        <?php if($data['tipe_pengajar'] == 'PENGAJAR & PENGUJI') { ?>
                            <button class="btn btn-secondary btn-sm" disabled>PENGAJAR & PENGUJI</button> 
                        <?php } ?>
                    </td>
                    <td width="8%"><?= $data['jenkel_pengajar'] ?></td>
                    <td width="8%"><?= $data['nik_pengajar'] ?></td>
                    <td width="5%"><?= umur($data['tgl_lahir_pengajar']) ?> Tahun</td>
                    <td width="8%"><button class="btn btn-primary btn-sm" disabled> <?= $data['username'] ?></td>
                    <td width="8%"><?= $data['hp_pengajar'] ?></td>
                    <td width="10%">
                        <button type="button" class="btn btn-secondary" onclick="datadiri('<?= $data['pengajar_id'] ?>')" >
                        <i class=" fa fa-info"></i></button>
                        <button type="button" class="btn btn-warning" onclick="edit('<?= $data['pengajar_id'] ?>')" >
                        <i class=" fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger" onclick="hapus('<?= $data['pengajar_id'] ?>')" >
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
            <?php echo form_open_multipart('/pengajar/import_file');
            ?>
            <?= csrf_field() ?>
            <input type="hidden" class="form-control" id="pst_or_pgj" value="peserta" name="pst_or_pgj" readonly>
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
            url: "<?= site_url('pengajar/input_pengajar') ?>",
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

    function datadiri(pengajar_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('pengajar/datadiri') ?>",
            data: {
                pengajar_id : pengajar_id
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

    function edit(pengajar_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('pengajar/edit_pengajar') ?>",
            data: {
                pengajar_id: pengajar_id
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

    function hapus(pengajar_id) {
        Swal.fire({
            title: 'Yakin Hapus Data Pengajar ini?',
            text: `Data Kelas Terkait Data Pengajar ini Akan Hilang Juga.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('pengajar/hapus_pengajar') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        pengajar_id : pengajar_id
                    },
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Anda berhasil menghapus data pengajar ini!",
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