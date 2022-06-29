<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<div class="card shadow-lg">
  <div class="card-header pb-0">
    <h6 class="card-title mb-2">Program/Kelas Peserta</h6>
    <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
    <table id="kelaspeserta" class="table table-striped table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>Nama Kelas</th>
                <th>Detail Kelas</th> 
                <th>Status</th>
                <th>Hasil Ujian</th>
                <th>Absensi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($kelas as $data) :
                ?>
                <tr>
                    <td width="20%"><?= $data['nama_kelas'] ?></td>
                    <td width="20%">
                        <p>Program: <?= $data['nama_program'] ?></p>
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
                    <td width="20%">
                        <?php if($data['status_peserta_kelas'] == 'BELUM LULUS') { ?>
                            <button class="btn btn-secondary" disabled>BELUM LULUS</button> 
                        <?php } ?>
                    </td>
                    <td></td>
                    <td>
                        <button type=button class="btn btn-info" onclick="absen(<?= $data['data_absen'] ?>, <?= $data['kelas_id'] ?>)" >
                            <i class=" fa fa-user-graduate mr-1"></i>Absensi
                        </button>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
    </div>

  </div>
</div>

<!-- <div class="card shadow-lg">
  <div class="card-header pb-0">
    <h6 class="card-title mb-2">Riwayat Program/Kelas</h6>
    <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
    <table id="kelaspeserta" class="table table-striped table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>Nama Kelas</th>
                <th>Detail Kelas</th> 
                <th>Status</th>
                <th>Hasil Ujian</th>
                <th>Absen</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>

  </div>
</div> -->

<div class="viewmodalabsen">
</div>

<script>
    function absen(data_absen, kelas_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('absen/list_peserta_kelas') ?>",
            data: {
                data_absen : data_absen,
                kelas_id : kelas_id,
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalabsen').html(response.sukses).show();
                    $('#modalabsen').modal('show');
                }
            }
        });
    }
</script>


<?= $this->endSection('isi') ?>