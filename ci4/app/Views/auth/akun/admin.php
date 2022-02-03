<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<a> 
    <button type="button" class="btn btn-primary mb-3" onclick="tambah('')" ><i class=" fa fa-plus-circle"></i> Tambah Akun Admin</button>
</a>

<div class="table-responsive">
    <table id="datatable" class="table table-striped table-bordered nowrap mt-5" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>No.</th>
                <th>User Id</th>
                <th>Roles</th>
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
                    <td width="10%">
                        <?php if($data['level'] == '2') { ?>
                            <button class="btn btn-success btn-sm" disabled>Admin Pusat</button> 
                        <?php } ?>
                        <?php if($data['level'] == '3') { ?>
                            <button class="btn btn-primary btn-sm" disabled>Admin TU</button> 
                        <?php } ?>
                        <?php if($data['level'] == '7') { ?>
                            <button class="btn btn-warning btn-sm" disabled>Admin Cabang</button> 
                        <?php } ?>
                    </td>
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
                        <button type="button" class="btn btn-warning mb-2" onclick="edit('<?= $data['user_id'] ?>')" >
                        <i class=" fa fa-edit mr-1"></i>Edit</button> <br>
                        <button type="button" class="btn btn-danger" onclick="hapus('<?= $data['user_id'] ?>')" >
                        <i class=" fa fa-trash mr-1"></i>Hapus</button>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="modalakuntambah">
</div>

<div class="viewmodaldataedit">
</div>

<div class="viewmodaldataeditusername">
</div>

<script>
    function tambah() {
        $.ajax({
            type: "post",
            url: "<?= site_url('akun/input_admin') ?>",
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
            url: "<?= site_url('akun/edit_admin') ?>",
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
            url: "<?= site_url('akun/edit_admin_username') ?>",
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
            title: 'Hapus Akun Admin?',
            text: `Apakah anda yakin mmenghapus akun admin ini?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('akun/hapus_admin') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        user_id: user_id
                    },
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Anda berhasil menghapus akun ini!",
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