<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<div class="table-responsive">
    <table id="datatable" class="table table-striped table-bordered nowrap mt-1" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>No.</th>
                <th>NIS</th>
                <th>Nama Peserta</th>
                <th>Kelas</th>
                <th>Angkatan <br> Perkuliahan</th>
                <th>Status <br> Kelulusan</th>
                <th>Bayar <br> Pendaftaran</th>
                <th>Bayar <br> SPP1</th>
                <th>Bayar <br> SPP2</th>
                <th>Bayar <br> SPP3</th>
                <th>Bayar <br> SPP4</th>
                <th>Bayar <br> Modul</th>
                <th>Rincian <br> Pembayaran</th>
            </tr>
        </thead>

        <tbody>
            <?php $nomor = 0;
            foreach ($list as $data) :
                $nomor++; ?>
                <tr>
                    <td width="1%"><?= $nomor ?></td>
                    <td width="5%"><?= $data['nis'] ?></td>
                    <td width="10%"><?= $data['nama_peserta'] ?></td>
                    <td width="10%"><?= $data['nama_kelas'] ?></td>
                    <td width="3%"><?= $data['angkatan_kelas'] ?></td>
                    <td width="5%"><?= $data['status_peserta_kelas'] ?></td>
                    <td width="3%">
                        <?php if($data['byr_daftar'] == 1) { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['byr_spp1'] == 1) { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['byr_spp2'] == 1) { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['byr_spp3'] == 1) { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['byr_spp4'] == 1) { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['byr_modul'] == '0') { ?>
                            <i class=" fa fa-minus" style="color:grey"></i>
                        <?php } ?>
                        <?php if($data['byr_modul'] == 1) { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="8%">
                        <button type="button" class="btn btn-warning" onclick="rincian('')" >
                            <i class=" fa fa-info mr-1"></i>Rincian</button>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="viewmodalrincian">
</div>

<script>

</script>

<?= $this->endSection('isi') ?>