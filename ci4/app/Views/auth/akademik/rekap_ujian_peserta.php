<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<div class="row">
    <!-- <div class="col-sm-auto">
        <a href="<?= base_url('#') ?>"> 
            <button type="button" class="btn btn-secondary mb-3"><i class=" fa fa-file-download"></i> Export Excel (Download)</button>
        </a>
    </div> -->
    <div class="col-sm-auto mb-2">
        <label for="angkatan_kelas">Pilih Angkatan Perkuliahan</label>
        <select onchange="javascript:location.href = this.value;" class="form-control js-example-basic-single" name="angkatan_kelas" id="angkatan_kelas" class="js-example-basic-single mb-2">
            <?php foreach ($list_angkatan as $key => $data) { ?>
            <option value="/ais/public/auth/akademik/admin_rekap_ujian/<?= $data['angkatan_kelas'] ?>" <?php if ($angkatan_pilih == $data['angkatan_kelas']) echo "selected"; ?>> <?= $data['angkatan_kelas'] ?> </option>
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
                <th>Jenis <br> Kelamin</th>
                <th>Kelas</th>
                <th>Angkatan <br> Perkuliahan</th>
                <th>Pengajar</th>
                <th>Hari <br> Kelas</th>
                <th>Waktu <br> Kelas</th>
                <th>Tgl. <br> Ujian</th>
                <th>Waktu <br> Ujian</th>
                <th>Nilai <br> Ujian</th>
                <th>Nilai <br> Akhir</th>
                <th>Kelulusan</th>
                <th>Tindakan</th>
            </tr>
        </thead>

        <tbody>
            <?php $nomor = 0;
            foreach ($list as $data) :
                $nomor++; ?>
                <tr>
                    <td width="1%"><?= $nomor ?></td>
                    <td width="5%"><?= $data['nis'] ?></td>
                    <td width="12%"><?= $data['nama_peserta'] ?></td>
                    <td width="5%"><?= $data['jenkel'] ?></td>
                    <td width="12%"><?= $data['nama_kelas'] ?></td>
                    <td width="3%"><?= $data['angkatan_kelas'] ?></td>
                    <td width="4%"><?= $data['nama_pengajar'] ?></td>
                    <td width="3%"><?= $data['hari_kelas'] ?></td>
                    <td width="3%"><?= $data['waktu_kelas'] ?> <?= $data['zona_waktu_kelas'] ?></td>
                    <td width="3%"><?= $data['tgl_ujian'] ?></td>
                    <td width="3%"><?= $data['waktu_ujian'] ?></td>
                    <td width="3%"><?= $data['nilai_ujian'] ?></td>
                    <td width="3%"><?= $data['nilai_akhir'] ?></td>
                    <td width="5%">
                        <?php if($data['status_peserta_kelas'] == 'Belum Lulus') { ?>
                            <button class="btn btn-secondary btn-sm" disabled>Belum Lulus</button> 
                        <?php } ?>
                        <?php if($data['status_peserta_kelas'] == 'Lulus') { ?>
                            <button class="btn btn-success btn-sm" disabled>Lulus</button> 
                        <?php } ?>
                        <?php if($data['status_peserta_kelas'] == 'Mengulang') { ?>
                            <button class="btn btn-warning btn-sm" disabled>Mengulang</button> 
                        <?php } ?>
                    </td>
                    <td> <button class="btn btn-warning"> <i class="fa fa-edit"></i> Edit</button> </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="viewmodalrincian">
</div>

<script>
    $('#angkatan_kelas').bind('change', function () { // bind change event to select
        var url = $(this).val(); // get selected value
        if (url != '') { // require a URL
            window.location = url; // redirect
        }
        return false;
    });
</script>

<?= $this->endSection('isi') ?>