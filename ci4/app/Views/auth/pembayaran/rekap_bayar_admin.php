<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<a href="<?= base_url('pembayaran/rekap_spp_admin_export') ?>"> 
    <button type="button" class="btn btn-secondary mb-3"><i class=" fa fa-file-download"></i> Export Excel (Download)</button>
</a>

<div class="table-responsive">
    <table id="datatable" class="table table-striped table-bordered nowrap mt-1" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>No.</th>
                <th>NIS</th>
                <th>Peserta</th>
                <th>Kelas</th>
                <th>Angkatan <br> Perkuliahan</th>
                <th>Status <br> Peserta</th>
                <th>Status <br> SPP</th>
                <th>Terbayar</th>
                <th>Piutang</th>
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
                    <td width="1%"><?= $data['angkatan_kelas'] ?></td>
                    <td width="2%">
                        <?php if($data['status_peserta'] == 'AKTIF') { ?>
                            <button class="btn btn-success btn-sm mb-2" disabled>AKTIF</button>
                        <?php } ?>
                        <?php if($data['status_peserta'] == 'OFF') { ?>
                            <button class="btn btn-secondary btn-sm mb-2" disabled>OFF</button>
                        <?php } ?>
                        <?php if($data['status_peserta'] == 'CUTI') { ?>
                            <button class="btn btn-warning btn-sm mb-2" disabled>CUTI</button>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['spp_status'] == 'BELUM LUNAS') { ?>
                            <button class="btn btn-warning btn-sm mb-2" disabled>BELUM LUNAS</button>
                        <?php } ?>
                        <?php if($data['spp_status'] == 'LUNAS') { ?>
                            <button class="btn btn-success btn-sm mb-2" disabled>LUNAS</button>
                        <?php } ?>
                    </td>
                    <td width="3%">Rp <?= rupiah($data['spp_terbayar']) ?></td>
                    <td width="3%">Rp <?= rupiah($data['spp_piutang']) ?></td>
                    <td width="3%">
                        <?php if($data['byr_daftar'] != NULL && $data['byr_daftar'] != '0') { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['byr_spp1'] != NULL && $data['byr_spp1'] != '0') { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['byr_spp2'] != NULL && $data['byr_spp2'] != '0') { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['byr_spp3'] != NULL && $data['byr_spp3'] != '0') { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['byr_spp4'] != NULL && $data['byr_spp4'] != '0' ) { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['byr_modul'] == '0') { ?>
                            <i class=" fa fa-minus" style="color:grey"></i>
                        <?php } ?>
                        <?php if($data['byr_modul'] != NULL && $data['byr_modul'] != '0') { ?>
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