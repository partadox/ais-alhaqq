<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<div class="table-responsive">
    <table id="datatable" class="table table-striped table-bordered nowrap mt-5" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kelas</th>
                <th>Program</th>
                <th>Ket. Kelas</th>
                <th>Kouta</th>
                <th>Status</th>
                <th>Peserta</th>
            </tr>
        </thead>

        <tbody>
            <?php $nomor = 0;
            foreach ($list as $data) :
                $nomor++; ?>
                <tr>
                    <td width="5%"><?= $nomor ?></td>
                    <td width="15%"><?= $data['nama_kelas'] ?></td>
                    <td width="10%"><?= $data['nama_program'] ?></td>
                    <td width="20%">
                        <p>Hari: <?= $data['hari_kelas'] ?></p>
                        <p>Jam: <?= $data['waktu_kelas'] ?></p>
                        <p>Pengajar: <?= $data['nama_pengajar'] ?></p>
                        <?php if($data['metode_kelas'] == 'online') { ?>
                            <button class="btn btn-primary btn-sm" disabled>Online</button> 
                        <?php } ?>
                        <?php if($data['metode_kelas'] == 'offline') { ?>
                            <button class="btn btn-info btn-sm" disabled>Offline</button> 
                        <?php } ?>
                    </td>
                    <td width="15%">
                        <p>Kouta: <?= $data['kouta'] ?></p>
                        <p>Sisa Kouta: <?= $data['sisa_kouta'] ?></p>
                    </td>
                    <td width="5%">
                        <?php if($data['status_kelas'] == 'aktif') { ?>
                            <button class="btn btn-success btn-sm" disabled>Aktif</button> 
                        <?php } ?>
                        <?php if($data['status_kelas'] == 'nonaktif') { ?>
                            <button class="btn btn-secondary btn-sm" disabled>Nonaktif</button> 
                        <?php } ?>
                    </td>
                    <td width="10%">
                        <button type="button" class="btn btn-info" onclick="peserta('<?= $data['kelas_id'] ?>')" >
                            <i class=" fa fa-user-graduate mr-1"></i>Peserta</button>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="viewmodaltambah">
</div>

<div class="viewmodallistpeserta">
</div>

<script>
    function tambah() {
        $.ajax({
            type: "post",
            url: "<?= site_url('program/input_kelas') ?>",
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

    function peserta(kelas_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('program/kelas_peserta_list') ?>",
            data: {
                kelas_id : kelas_id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodallistpeserta').html(response.sukses).show();
                    $('#modallistpeserta').modal('show');
                }
            }
        });
    }
</script>
<?= $this->endSection('isi') ?>