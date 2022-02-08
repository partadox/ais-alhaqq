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
                <th>NIK</th>
                <th>Asal Cb.</th>
                <th>Jenis Kelamin</th>
                <th>No. HP</th>
                <th>Level</th> 
                <th>Angkatan</th>
                <th>Usia</th>
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