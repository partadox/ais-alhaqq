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
                <th>Angkatan <br> Perkuliahan</th>
                <th>Program</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Metode TM</th>
                <th>Level</th>
                <th>Jml. <br> Peserta</th>
                <th>Status Kelas</th>
                <th>Tindakan</th>
            </tr>
        </thead>

        <tbody>
            <?php $nomor = 0;
            foreach ($list as $data) :
                $nomor++; ?>
                <tr>
                    <td width="3%"><?= $nomor ?></td>
                    <td width="15%"><?= $data['nama_kelas'] ?></td>
                    <td width="5%"><?= $data['angkatan_kelas'] ?></td>
                    <td width="10%"><?= $data['nama_program'] ?></td>
                    <td width="5%"><?= $data['hari_kelas'] ?></td>
                    <td width="5%"><?= $data['waktu_kelas'] ?> <?= $data['zona_waktu_kelas'] ?></td>
                    <td width="5%">
                        <?php if($data['metode_kelas'] == 'ONLINE') { ?>
                            <button class="btn btn-primary btn-sm" disabled>ONLINE</button> 
                        <?php } ?>
                        <?php if($data['metode_kelas'] == 'OFFLINE') { ?>
                            <button class="btn btn-info btn-sm" disabled>OFFLINE</button> 
                        <?php } ?>
                    </td>
                    <td  width="7%"><?= $data['nama_level'] ?></td>
                    <td><?= $data['jumlah_peserta'] ?></td>
                    <td width="5%">
                        <?php if($data['status_kelas'] == 'aktif') { ?>
                            <button class="btn btn-success btn-sm" disabled>AKTIF</button> 
                        <?php } ?>
                        <?php if($data['status_kelas'] == 'nonaktif') { ?>
                            <button class="btn btn-secondary btn-sm" disabled>NONAKTIF</button> 
                        <?php } ?>
                    </td>
                    <td width="10%">
                        <a href="list_absen/<?= $data['kelas_id'] ?>" class="btn btn-info">
                            <i class=" fa fa-user-graduate mr-1"></i>Absensi
                        </a>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection('isi') ?>