<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?> <?= $detail_kelas[0]['nama_kelas'] ?></h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<!-- <a> 
    <button type="button" class="btn btn-primary mb-3" onclick="tambah('')" ><i class=" fa fa-plus-circle"></i> Masukan Peserta Pindah</button>
</a> -->
<a href="<?= base_url('auth/program/kelas') ?>"> 
    <button type="button" class="btn btn-secondary mb-3"><i class=" fa fa-arrow-circle-left"></i> Kembali</button>
</a>

<h5 style="text-align:center;">Kelas <?= $detail_kelas[0]['nama_kelas'] ?></h5>
<h6 style="text-align:center;"><?= $detail_kelas[0]['hari_kelas'] ?>, <?= $detail_kelas[0]['waktu_kelas'] ?> - <?= $detail_kelas[0]['metode_kelas'] ?></h6>
<h6 style="text-align:center;"><?= $detail_kelas[0]['nama_pengajar'] ?></h6>
<h6 style="text-align:center;">Jumlah Peserta = <?= $detail_kelas[0]['jumlah_peserta'] ?></h6>

<div class="table-responsive">
    <table id="datatable" class="table table-striped table-bordered nowrap mt-1" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>No.</th>
                <th>NIS</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Domisili</th>
                <th>HP</th>
                <th>Status</th>
                <th>Tindakan</th>
            </tr>
        </thead>

        <tbody>
            <?php $nomor = 0;
            foreach ($peserta_onkelas as $data) :
                $nomor++; ?>
                <tr>
                    <td width="5%"><?= $nomor ?></td>
                    <td width="10%"><?= $data['nis'] ?></td>
                    <td width="10%"><?= $data['nik'] ?></td>
                    <td width="15%"><?= $data['nama_peserta'] ?></td>
                    <td width="10%"><?= $data['domisili_peserta'] ?></td>
                    <td width="10%"><?= $data['hp'] ?></td>
                    <td width="10%">
                        <?php if($data['status_peserta_kelas'] == 'Belum Lulus') { ?>
                            <button class="btn btn-secondary btn-sm" disabled>Belum Lulus</button> 
                        <?php } ?>
                        <?php if($data['status_peserta_kelas'] == 'Lulus') { ?>
                            <button class="btn btn-success btn-sm" disabled>Lulus</button> 
                        <?php } ?>
                    </td>
                    <td width="8%">
                        <button type="button" class="btn btn-warning" onclick="pindah('<?= $data['peserta_kelas_id'] ?>')" >
                            <i class=" fa fa-sign-in-alt mr-1"></i>Pindah</button>
                        <button type="button" class="btn btn-danger" onclick="hapus('<?= $data['peserta_kelas_id'] ?>')" >
                            <i class=" fa fa-trash"></i></button>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="viewmodalpindah">
</div>

<script>
    function pindah(peserta_kelas_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('program/pindah_kelas') ?>",
            data: {
                peserta_kelas_id : peserta_kelas_id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalpindah').html(response.sukses).show();
                    $('#modalpindah').modal('show');
                }
            }
        });
    }

    function hapus(peserta_kelas_id) {
        Swal.fire({
            title: 'Hapus Data Peserta di Kelas Ini?',
            text: `Hapus data peserta kelas ini akan berdampak pada terhapusnya data absen peserta`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('program/hapus_peserta_kelas') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        peserta_kelas_id : peserta_kelas_id
                    },
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Anda berhasil menghapus peserta dari kelas ini ini!",
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