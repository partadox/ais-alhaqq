<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<a> 
    <button type="button" class="btn btn-primary mb-3" onclick="tambah('')" ><i class=" fa fa-plus-circle"></i> Tambah Program</button>
</a>

<div class="table-responsive">
    <table id="datatable" class="table table-striped table-bordered nowrap mt-5" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Program</th>
                <th>Jenis</th>
                <th>Kategori</th>
                <th>Biaya Program</th>
                <th>SPP Bulanan</th>
                <th>Biaya Daftar</th>
                <th>Status</th>
                <th>Tindakan</th>
            </tr>
        </thead>

        <tbody>
            <?php $nomor = 0;
            foreach ($list as $data) :
                $nomor++; ?>
                <tr>
                    <td width="5%"><?= $nomor ?></td>
                    <td width="20%"><?= $data['nama_program'] ?></td>
                    <td width="12%"><?= $data['jenis_program'] ?></td>
                    <td width="10%"><?= $data['kategori_program'] ?></td>
                    <td width="10%">Rp <?= rupiah($data['biaya_program']) ?></td>
                    <td width="10%">Rp <?= rupiah($data['biaya_bulanan']) ?></td>
                    <td width="10%">Rp <?= rupiah($data['biaya_daftar']) ?></td>
                    <td width="10%">
                        <?php if($data['status_program'] == 'aktif') { ?>
                            <button class="btn btn-success btn-sm" disabled>Aktif</button> 
                        <?php } ?>
                        <?php if($data['status_program'] == 'nonaktif') { ?>
                            <button class="btn btn-secondary btn-sm" disabled>Nonaktif</button> 
                        <?php } ?>
                    </td>
                    <td width="10%">
                        <button type="button" class="btn btn-warning" onclick="edit('<?= $data['program_id'] ?>')" >
                        <i class=" fa fa-edit mr-1"></i>Edit</button>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="viewmodaltambah">
</div>

<div class="viewmodaledit">
</div>


<script>
    function tambah() {
        $.ajax({
            type: "post",
            url: "<?= site_url('program/input_program') ?>",
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

    function edit(program_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('program/edit_program') ?>",
            data: {
                program_id : program_id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaledit').html(response.sukses).show();
                    $('#modaledit').modal('show');
                }
            }
        });
    }
</script>
<?= $this->endSection('isi') ?>