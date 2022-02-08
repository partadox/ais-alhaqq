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

<div class="table-responsive">
    <table id="datatable" class="table table-striped table-bordered nowrap mt-5" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>No.</th>
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
                    <td width="14%"><?= $data['nama_pengajar'] ?></td>
                    <td width="8%"><?= $data['nama_kantor'] ?></td>
                    <td width="8%"><?= $data['tipe_pengajar'] ?></td>
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