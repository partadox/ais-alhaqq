<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<div class="row">
    <!-- <div class="col-sm-auto">
        <a href="<?= base_url('pembayaran/rekap_spp_admin_export') ?>"> 
            <button type="button" class="btn btn-secondary mb-3"><i class=" fa fa-file-download"></i> Export Excel (Download)</button>
        </a>
    </div> -->
    <div class="col-sm-auto mb-2">
        <label for="export_spp">Export Excel (Download)</label>
        <select onchange="javascript:location.href = this.value;" class="form-control js-example-basic-single" name="export_spp" id="export_spp" class="js-example-basic-single mb-2">
            <option value="" disabled selected>Download...</option>
            <?php foreach ($list_angkatan as $key => $data) { ?>
            <option value="/ais/public/pembayaran/rekap_spp_admin_export/<?= $data['angkatan_kelas'] ?>"> Angkatan Kuliah <?= $data['angkatan_kelas'] ?> </option>
            <?php } ?>
        </select>
    </div>
    <div class="col-sm-auto mb-2">
        <label for="angkatan_kelas">Pilih Angkatan Perkuliahan</label>
        <select onchange="javascript:location.href = this.value;" class="form-control js-example-basic-single" name="angkatan_kelas" id="angkatan_kelas" class="js-example-basic-single mb-2">
            <?php foreach ($list_angkatan as $key => $data) { ?>
            <option value="/ais/public/auth/pembayaran/admin_rekap_bayar/<?= $data['angkatan_kelas'] ?>" <?php if ($angkatan_pilih == $data['angkatan_kelas']) echo "selected"; ?>> <?= $data['angkatan_kelas'] ?> </option>
            <?php } ?>
        </select>
    </div>
</div>

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
                        <?php if(($data['biaya_daftar'] + $data['biaya_modul'] + $data['biaya_program']) - ($data['byr_daftar'] + $data['byr_spp1'] + $data['byr_spp2'] + $data['byr_spp3'] + $data['byr_spp4'] + $data['byr_modul']) != 0) { ?>
                            <button class="btn btn-warning btn-sm mb-2" disabled>BELUM LUNAS</button>
                        <?php } ?>
                        <?php if(($data['biaya_daftar'] + $data['biaya_modul'] + $data['biaya_program']) - ($data['byr_daftar'] + $data['byr_spp1'] + $data['byr_spp2'] + $data['byr_spp3'] + $data['byr_spp4'] + $data['byr_modul']) == 0) { ?>
                            <button class="btn btn-success btn-sm mb-2" disabled>LUNAS</button>
                        <?php } ?>
                    </td>
                    <td width="3%">Rp <?= rupiah($data['byr_daftar'] + $data['byr_spp1'] + $data['byr_spp2'] + $data['byr_spp3'] + $data['byr_spp4'] + $data['byr_modul']) ?></td>
                    <td width="3%">Rp <?= rupiah(($data['biaya_daftar'] + $data['biaya_modul'] + $data['biaya_program']) - ($data['byr_daftar'] + $data['byr_spp1'] + $data['byr_spp2'] + $data['byr_spp3'] + $data['byr_spp4'] + $data['byr_modul'])) ?></td>
                    <td width="3%">
                        <?php if($data['byr_daftar'] == $data['biaya_daftar']) { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['byr_spp1'] == $data['biaya_bulanan']) { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['byr_spp2'] == $data['biaya_bulanan']) { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['byr_spp3'] == $data['biaya_bulanan']) { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['byr_spp4'] == $data['biaya_bulanan'] ) { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="3%">
                        <?php if($data['byr_modul'] == $data['biaya_modul']) { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td width="8%">
                        <a href="rekap_spp_peserta/<?= $data['peserta_id'] ?>/<?= $data['kelas_id'] ?>" class="btn btn-info mb-2">
                            <i class=" fa fa-info mr-1"></i> Rincian
                        </a> <br>
                        <button type="button" class="btn btn-warning mb-2" onclick="edit(<?= $data['peserta_kelas_id'] ?>, <?= $data['biaya_daftar'] ?>, <?= $data['biaya_modul'] ?>, <?= $data['biaya_program'] ?>)" >
                        <i class=" fa fa-edit mr-1"></i>Edit</button>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="viewmodalrincian">
</div>

<div class="viewmodaldataedit">
</div>

<script>
    $('#angkatan_kelas').bind('change', function () { // bind change event to select
        var url = $(this).val(); // get selected value
        if (url != '') { // require a URL
            window.location = url; // redirect
        }
        return false;
    });

    function edit(peserta_kelas_id, biaya_daftar, biaya_modul, biaya_program) {
        $.ajax({
            type: "post",
            url: "<?= site_url('pembayaran/edit_rekap_spp') ?>",
            data: {
                peserta_kelas_id : peserta_kelas_id,
                biaya_daftar : biaya_daftar,
                biaya_modul : biaya_modul,
                biaya_program : biaya_program
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

    $('#export_spp').bind('change', function () { // bind change event to select
        var url = $(this).val(); // get selected value
        if (url != '') { // require a URL
            window.location = url; // redirect
        }
        return false;
    });
</script>

<?= $this->endSection('isi') ?>