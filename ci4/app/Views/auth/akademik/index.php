<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<div class="card">
    <div class="card-body">
        <h5>Program / Kelas yang Diikuti</h5>
        <div class="table-responsive">
            <table class="table table-striped table-bordered nowrap mt-5" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>Nama Kelas</th>
                        <th>Detail Kelas</th> 
                        <th>Status</th>
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
                                <?php if($data['status_peserta_kelas'] == 'Belum Lulus') { ?>
                                    <button class="btn btn-secondary" disabled>Belum Lulus</button> 
                                <?php } ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- <div class="card">
    <div class="card-body">
    </div>
</div> -->

<?= $this->endSection('isi') ?>