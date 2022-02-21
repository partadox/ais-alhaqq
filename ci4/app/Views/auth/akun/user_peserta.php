<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<a> 
    <button type="button" class="btn btn-primary mb-3" onclick="tambah('')" ><i class=" fa fa-plus-circle"></i> Tambah Akun Peserta</button>
</a>

<a class="ml-5"> 
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#importexcelakunpeserta" ><i class=" fa fa-file-excel"></i> Import File Excel</button>
</a>

<a href="<?= base_url('akun/export_peserta') ?>"> 
    <button type="button" class="btn btn-secondary mb-3"><i class=" fa fa-file-download"></i> Download Data</button>
</a>

<a href="<?= base_url('/template/Template_Akun_Peserta_v1.xlsx') ?>"> 
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
                <th>Username</th> 
                <th>Status Aktif</th>
                <th>Tindakan</th>
            </tr>
        </thead>

        <tbody>
            <?php $nomor = 0;
            foreach ($list as $data) :
                $nomor++; ?>
                <tr>
                    <td width="5%"><?= $nomor ?></td>
                    <td width="6%"><?= $data['user_id'] ?></td>
                    <td width="20%"><?= $data['nama'] ?></td>
                    <td width="15%">
                        <h6><?= $data['username'] ?></h6>
                        <button type="button" class="btn btn-warning btn-sm" onclick="edit_username('<?= $data['user_id'] ?>')" >
                        <i class=" fa fa-edit mr-1"></i>Ubah</button>
                    </td>
                    <td width="10%">
                        <?php if($data['active'] == '0') { ?>
                            <button class="btn btn-secondary btn-sm" disabled>Nonaktif</button> 
                        <?php } ?>
                        <?php if($data['active'] == '1') { ?>
                            <button class="btn btn-success btn-sm" disabled>Aktif</button> 
                        <?php } ?>
                    </td>
                    <td width="5%">
                        <button type="button" class="btn btn-warning" onclick="edit('<?= $data['user_id'] ?>')" >
                        <i class=" fa fa-edit mr-1"></i>Edit</button> 
                        <?php if($data['active'] == '0') { ?>
                            <button type="button" class="btn btn-danger" onclick="hapus('<?= $data['user_id'] ?>')" >
                            <i class=" fa fa-trash mr-1"></i>Hapus</button>
                        <?php } ?>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="modalakuntambah">
</div>

<div class="viewmodaldataeditusername">
</div>

<div class="viewmodaldataedit">
</div>

<!-- Start Modal Import File Excel -->
<div class="modal fade" id="importexcelakunpeserta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import File Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart('/akun/import_file');
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
            url: "<?= site_url('akun/input_user_peserta') ?>",
            data: {
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.modalakuntambah').html(response.sukses).show();
                    $('#modalakuntambah').modal('show');
                }
            }
        });
    }

    function edit(user_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('akun/edit_user_peserta') ?>",
            data: {
                user_id : user_id
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

    function edit_username(user_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('akun/edit_user_username_peserta') ?>",
            data: {
                user_id : user_id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaldataeditusername').html(response.sukses).show();
                    $('#modaleditusername').modal('show');
                }
            }
        });
    }

    function hapus(user_id) {
        Swal.fire({
            title: 'Yakin Hapus Data Akun User ini?',
            text: `Data Akun User Akan Dihapus.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('akun/hapus_user_peserta') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        user_id : user_id
                    },
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Anda berhasil menghapus data akun user peserta!",
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