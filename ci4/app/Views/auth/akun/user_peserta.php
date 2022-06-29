<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<a> 
    <button type="button" class="btn btn-primary mb-3 tambah"><i class=" fa fa-plus-circle"></i> Tambah Akun Peserta</button>
</a>

<a class="ml-5"> 
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#importexcelakunpeserta" ><i class=" fa fa-file-excel"></i> Import File Excel</button>
</a>

<a href="<?= base_url('akun/export_peserta') ?>"> 
    <button type="button" class="btn btn-secondary mb-3"><i class=" fa fa-file-download"></i> Export Excel (Download)</button>
</a>

<a> 
    <button type="button" class="btn btn-warning mb-3" data-toggle="modal" data-target="#editbatch" ><i class=" fa fa-edit"></i> Multiple Edit</button>
</a>

<div class="dropdown d-inline float-right">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class=" fa fa-file-alt mr-1"></i>
    Template
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="<?= base_url('/template/Template_Akun_Peserta_v1.xlsx') ?>"> <i class=" fa fa-file-excel"></i> Import File Excel</a>
    <a class="dropdown-item" href="<?= base_url('/template/Template_Multiple_Edit_Akun_Peserta.xlsx') ?>"> <i class=" fa fa-edit"></i> Multiple Edit</a>
  </div>
</div>

<?php
if (session()->getFlashdata('pesan_error')) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button> <strong>';
    echo session()->getFlashdata('pesan_error');
    echo ' </strong> </div>';
}
?>

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

<div class="modalakuntambah">
</div>

<div class="viewdata">
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
                <p class="mt-1">Catatan :<br> 
                    <i class="mdi mdi-information"></i> Data import Excel maximal berisi 300 Data/Baris. Jika lebih maka data selebihnya akan gagal ter-import ke dalam sistem.<br>
                </p>
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

<!-- Start Modal Multiple Edit -->
<div class="modal fade" id="editbatch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Multiple Edit Akun Peserta via File Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart('/akun/edit_multiple');
            ?>
            <?= csrf_field() ?>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="pst_or_pgj" value="peserta" name="pst_or_pgj" readonly>
                <p class="mt-1">Catatan :<br> 
                    <i class="mdi mdi-information"></i> Download file template yang disediakan untuk multiple edit data akun peserta dari file excel.<br>
                    <i class="mdi mdi-information"></i> Download / Export Excel terlebih dahulu untuk mendapatkan <b>USER ID</b>.<br>
                    <i class="mdi mdi-information"></i> Data multiple edit via Excel maximal berisi 300 Data/Baris. Jika lebih maka data selebihnya akan gagal ter-import ke dalam sistem.<br>
                </p>
                    <div class="form-group">
                        <label>Pilih File Excel</label>
                        <input type="file" class="form-control" name="file_excel" accept=".xls, .xlsx">
                    </div>
            </div>    
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning btnsimpan"><i class="fa fa-edit"></i> Edit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

            <?php echo form_close() ?>
        </div>
    </div>
</div>
<!-- End Modal Multiple Edit -->

<script>
    function list_userpeserta() {
        $.ajax({
            url: "<?= site_url('akun/getdata_list_userpeserta') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        list_userpeserta();
        $('.tambah').click(function(e) {
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
        });
    });
</script>
<?= $this->endSection('isi') ?>