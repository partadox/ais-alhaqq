<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<div class="table-responsive">
    <table id="datatable" class="table table-sm table-bordered mt-5" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Jam</th> 
                <th>Admin</th>
                <th>Aktivitas</th>
            </tr>
        </thead>

        <tbody>
            <?php $nomor = 0;
            foreach ($list as $data) :
                $nomor++; ?>
                <tr>
                    <td width="2%"><?= $nomor ?></td>
                    <td width="5%"><?= shortdate_indo($data['tgl_log']) ?></td>
                    <td width="5%"><?= $data['waktu_log'] ?></td>
                    <td width="10%"><?= $data['username_log'] ?></td>
                    <td width="25%"><?= $data['aktivitas_log'] ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection('isi') ?>