<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<a> 
    <button type="button" class="btn btn-primary mb-3" onclick="tambah('')" ><i class=" fa fa-plus-circle"></i> Tambah Kelas</button>
</a>

<div class="table-responsive">
    <table id="datatable" class="table table-striped table-bordered nowrap mt-5" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kelas</th>
                <th>Program</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Pengajar</th>
                <th>Metode TM</th>
                <th>Level</th>
                <th>Jen. Kel.</th>
                <th>Kuota Pendaftaran</th>
                <th>Jml Peserta</th>
                <th>Status Kelas</th>
                <th>Tindakan</th>
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
                    <td width="5%"><?= $data['hari_kelas'] ?> <br>
                        <?php if($data['status_kerja'] == '0') { ?>
                            <p>(Weekdays)</p>
                        <?php } ?>
                        <?php if($data['status_kerja'] == '1') { ?>
                            <p>(Weekend)</p>
                        <?php } ?>
                    </td>
                    <td width="5%"><?= $data['waktu_kelas'] ?></td>
                    <td width="7%"><?= $data['nama_pengajar'] ?></td>
                    <td width="5%">
                        <?php if($data['metode_kelas'] == 'online') { ?>
                            <button class="btn btn-primary btn-sm" disabled>Online</button> 
                        <?php } ?>
                        <?php if($data['metode_kelas'] == 'offline') { ?>
                            <button class="btn btn-info btn-sm" disabled>Offline</button> 
                        <?php } ?>
                    </td>
                    <td  width="7%"><?= $data['nama_level'] ?></td>
                    <td  width="7%"><?= $data['jenkel'] ?></td>
                    <td width="15%">
                        <p>Kuota: <?= $data['kouta'] ?></p>
                        <p>Sisa Kuota: <?= $data['sisa_kouta'] ?></p>
                    </td>
                    <td></td>
                    <td width="5%">
                        <?php if($data['status_kelas'] == 'aktif') { ?>
                            <button class="btn btn-success btn-sm" disabled>Aktif</button> 
                        <?php } ?>
                        <?php if($data['status_kelas'] == 'nonaktif') { ?>
                            <button class="btn btn-secondary btn-sm" disabled>Nonaktif</button> 
                        <?php } ?>
                    </td>
                    <td width="10%">
                        <button type="button" class="btn btn-warning" onclick="edit('<?= $data['kelas_id'] ?>')" >
                            <i class=" fa fa-edit"></i></button>

                        <!-- <form action="kelas_peserta/<?= $data['kelas_id'] ?>" method="post" class="d-inline">
                            <?= csrf_field()?>
                            <input type="hidden" id=kelas_id value="<?= $data['kelas_id'] ?>">
                            <button type="button" class="btn btn-info" ><i class="fa fa-user-graduate"></i></button>
                        </form> -->
                        
                        <a href="kelas_peserta/<?= $data['kelas_id'] ?>" class="btn btn-info">
                            <i class=" fa fa-user-graduate"></i>
                        </a>
                        <!-- <button type="button" class="btn btn-info" onclick="peserta('<?= $data['kelas_id'] ?>')" >
                            <i class=" fa fa-user-graduate mr-1"></i></button> -->
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

    function edit(kelas_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('program/edit_kelas') ?>",
            data: {
                kelas_id : kelas_id
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

    function peserta(kelas_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('program/kelas_peserta') ?>",
            data: {
                kelas_id : kelas_id
            },
            dataType: "json",
            // success: function(response) {
            //     (function() {
            //                     window.location = response.sukses.link;
            //             });
            // }
        });
    }
</script>
<?= $this->endSection('isi') ?>