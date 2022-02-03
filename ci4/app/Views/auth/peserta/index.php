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

<div class="table-responsive">
    <table id="datatable" class="table table-striped table-bordered nowrap mt-5" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>No.</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Level</th> 
                <th>Jenis Kelamin</th>
                <th>Angkatan</th>
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
                    <td width="10%"><?= $data['nis'] ?></td>
                    <td width="13%"><?= $data['nama_peserta'] ?></td>
                    <td width="10%"><?= $data['nama_level'] ?></td>
                    <td width="8%"><?= $data['jenkel'] ?></td>
                    <td width="5%"><?= $data['angkatan'] ?></td>
                    <td width="5%"><?= umur($data['tgl_lahir']) ?> Tahun</td>
                    <td width="5%"> <button class="btn btn-primary btn-sm" disabled> <?= $data['username'] ?></button></td>
                    <td width="5%"><?= $data['hp'] ?></td>
                    <td width="5%">
                        <button type="button" class="btn btn-secondary mb-2" onclick="datadiri('<?= $data['peserta_id'] ?>')" >
                        <i class=" fa fa-info mr-1"></i>Detail</button> <br>
                        <button type="button" class="btn btn-warning" onclick="edit('<?= $data['peserta_id'] ?>')" >
                        <i class=" fa fa-edit mr-1"></i>Edit</button>
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
</script>
<?= $this->endSection('isi') ?>