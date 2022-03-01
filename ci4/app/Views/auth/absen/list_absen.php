<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>


<a href="<?= base_url('auth/absen/index_pengajar') ?>"> 
    <button type="button" class="btn btn-secondary mb-3"><i class=" fa fa-arrow-circle-left"></i> Kembali</button>
</a>

<h5 style="text-align:center;">Kelas <?= $detail_kelas[0]['nama_kelas'] ?></h5>
<h6 style="text-align:center;"><?= $detail_kelas[0]['hari_kelas'] ?>, <?= $detail_kelas[0]['waktu_kelas'] ?> - <?= $detail_kelas[0]['metode_kelas'] ?></h6>
<h6 style="text-align:center;"><?= $detail_kelas[0]['nama_pengajar'] ?></h6>
<h6 style="text-align:center;">Jumlah Peserta = <?= $detail_kelas[0]['jumlah_peserta'] ?></h6>

<p class="mt-1">Catatan :<br> 
    <i class="mdi mdi-information"></i> Kolom 1-16 merupakan kolom Tatap Muka ke-1 (TM-1) sampai Tatap Muka ke-16 (TM-16). <br>
    <!-- <i class="mdi mdi-information"></i> Untuk mengisi absen silahkan <i class=" fa fa-check-square mr-1"></i> <b>Check</b> pada Checkbox di setiap kolom Tatap Muka peserta jika peserta hadir. <br>
    <i class="mdi mdi-information"></i> Isi data absen diri anda dan isikan tanggal Tatap Muka dan catatan Tatap Muka jika terdapat catatan. <br> -->
</p>

<?php
if (session()->getFlashdata('pesan_error')) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button> <i class="mdi mdi-alert-circle"></i> <strong>';
    echo session()->getFlashdata('pesan_error');
    echo ' </strong> </div>';
}
if (session()->getFlashdata('pesan_sukses')) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button> <i class="mdi mdi-check-circle"></i> <strong>';
    echo session()->getFlashdata('pesan_sukses');
    echo ' </strong> </div>';
}
?>

<div class="table-responsive">
    <table class="table table-striped table-bordered nowrap mt-1" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
            <th width="3%">No.</th>
            <th width="7%">NIS</th>
            <th width="12%"class="name-col" >Nama</th>
            <th width="3%">1 <br>
                <button type="button" class="btn btn-sm btn-warning" onclick="tm('tm1', <?= $detail_kelas[0]['kelas_id'] ?>, <?= $detail_kelas[0]['data_absen_pengajar'] ?>)" >
                        <i class=" fa fa-edit"></i></button> 
            </th>
            <th width="3%">2 <br>
                <button type="button" class="btn btn-sm btn-warning" onclick="tm('tm2', <?= $detail_kelas[0]['kelas_id'] ?>, <?= $detail_kelas[0]['data_absen_pengajar'] ?>)" >
                        <i class=" fa fa-edit"></i></button> 
            </th>
            <th width="3%">3 <br>
                <button type="button" class="btn btn-sm btn-warning" onclick="tm('tm3', <?= $detail_kelas[0]['kelas_id'] ?>, <?= $detail_kelas[0]['data_absen_pengajar'] ?>)" >
                        <i class=" fa fa-edit"></i></button> 
            </th>
            <th width="3%">4 <br>
                <button type="button" class="btn btn-sm btn-warning" onclick="tm('tm4', <?= $detail_kelas[0]['kelas_id'] ?>, <?= $detail_kelas[0]['data_absen_pengajar'] ?>)" >
                        <i class=" fa fa-edit"></i></button> 
            </th>
            <th width="3%">5 <br>
                <button type="button" class="btn btn-sm btn-warning" onclick="tm('tm5', <?= $detail_kelas[0]['kelas_id'] ?>, <?= $detail_kelas[0]['data_absen_pengajar'] ?>)" >
                        <i class=" fa fa-edit"></i></button> 
            </th>
            <th width="3%">6 <br>
                <button type="button" class="btn btn-sm btn-warning" onclick="tm('tm6', <?= $detail_kelas[0]['kelas_id'] ?>, <?= $detail_kelas[0]['data_absen_pengajar'] ?>)" >
                        <i class=" fa fa-edit"></i></button> 
            </th>
            <th width="3%">7 <br>
                <button type="button" class="btn btn-sm btn-warning" onclick="tm('tm7', <?= $detail_kelas[0]['kelas_id'] ?>, <?= $detail_kelas[0]['data_absen_pengajar'] ?>)" >
                        <i class=" fa fa-edit"></i></button> 
            </th>
            <th width="3%">8 <br>
                <button type="button" class="btn btn-sm btn-warning" onclick="tm('tm8', <?= $detail_kelas[0]['kelas_id'] ?>, <?= $detail_kelas[0]['data_absen_pengajar'] ?>)" >
                        <i class=" fa fa-edit"></i></button> 
            </th>
            <th width="3%">9 <br>
                <button type="button" class="btn btn-sm btn-warning" onclick="tm('tm9', <?= $detail_kelas[0]['kelas_id'] ?>, <?= $detail_kelas[0]['data_absen_pengajar'] ?>)" >
                        <i class=" fa fa-edit"></i></button> 
            </th>
            <th width="3%">10 <br>
                <button type="button" class="btn btn-sm btn-warning" onclick="tm('tm10', <?= $detail_kelas[0]['kelas_id'] ?>, <?= $detail_kelas[0]['data_absen_pengajar'] ?>)" >
                        <i class=" fa fa-edit"></i></button> 
            </th>
            <th width="3%">11 <br>
                <button type="button" class="btn btn-sm btn-warning" onclick="tm('tm11', <?= $detail_kelas[0]['kelas_id'] ?>, <?= $detail_kelas[0]['data_absen_pengajar'] ?>)" >
                        <i class=" fa fa-edit"></i></button> 
            </th>
            <th width="3%">12 <br>
                <button type="button" class="btn btn-sm btn-warning" onclick="tm('tm12', <?= $detail_kelas[0]['kelas_id'] ?>, <?= $detail_kelas[0]['data_absen_pengajar'] ?>)" >
                        <i class=" fa fa-edit"></i></button> 
            </th>
            <th width="3%">13 <br>
                <button type="button" class="btn btn-sm btn-warning" onclick="tm('tm13', <?= $detail_kelas[0]['kelas_id'] ?>, <?= $detail_kelas[0]['data_absen_pengajar'] ?>)" >
                        <i class=" fa fa-edit"></i></button> 
            </th>
            <th width="3%">14 <br>
                <button type="button" class="btn btn-sm btn-warning" onclick="tm('tm14', <?= $detail_kelas[0]['kelas_id'] ?>, <?= $detail_kelas[0]['data_absen_pengajar'] ?>)" >
                        <i class=" fa fa-edit"></i></button> 
            </th>
            <th width="3%">15 <br>
                <button type="button" class="btn btn-sm btn-warning" onclick="tm('tm15', <?= $detail_kelas[0]['kelas_id'] ?>, <?= $detail_kelas[0]['data_absen_pengajar'] ?>)" >
                        <i class=" fa fa-edit"></i></button> 
            </th>
            <th width="3%">16 <br>
                <button type="button" class="btn btn-sm btn-warning" onclick="tm('tm16', <?= $detail_kelas[0]['kelas_id'] ?>, <?= $detail_kelas[0]['data_absen_pengajar'] ?>)" >
                        <i class=" fa fa-edit"></i></button> 
            </th>
            <th width="5%"class="missed-col">Jumlah <br> Kehadiran</th>
            </tr>
        </thead>

        <tbody>
            <?php $nomor = 0;
            foreach ($peserta_onkelas as $data) :
                $nomor++; ?>
                <tr>
                <td ><?= $nomor ?></td>
                <td ><?= $data['nis'] ?></td>
                <td ><?= $data['nama_peserta'] ?></td>
                <td >
                    <?php if($data['tm1'] == NULL) { ?>
                        <p></p>
                    <?php } ?>
                    <?php if($data['tm1'] == '0') { ?>
                        <i class=" fa fa-minus" style="color:red"></i>
                    <?php } ?>
                    <?php if($data['tm1'] == '1') { ?>
                        <i class=" fa fa-check" style="color:green"></i>
                    <?php } ?>
                </td>
                <td >
                    <?php if($data['tm2'] == NULL) { ?>
                        <p></p>
                    <?php } ?>
                    <?php if($data['tm2'] == '0') { ?>
                        <i class=" fa fa-minus" style="color:red"></i>
                    <?php } ?>
                    <?php if($data['tm2'] == '1') { ?>
                        <i class=" fa fa-check" style="color:green"></i>
                    <?php } ?>
                </td>
                <td >
                    <?php if($data['tm3'] == NULL) { ?>
                        <p></p>
                    <?php } ?>
                    <?php if($data['tm3'] == '0') { ?>
                        <i class=" fa fa-minus" style="color:red"></i>
                    <?php } ?>
                    <?php if($data['tm3'] == '1') { ?>
                        <i class=" fa fa-check" style="color:green"></i>
                    <?php } ?>
                </td>
                <td >
                    <?php if($data['tm4'] == NULL) { ?>
                        <p></p>
                    <?php } ?>
                    <?php if($data['tm4'] == '0') { ?>
                        <i class=" fa fa-minus" style="color:red"></i>
                    <?php } ?>
                    <?php if($data['tm4'] == '1') { ?>
                        <i class=" fa fa-check" style="color:green"></i>
                    <?php } ?>
                </td>
                <td >
                    <?php if($data['tm5'] == NULL) { ?>
                        <p></p>
                    <?php } ?>
                    <?php if($data['tm5'] == '0') { ?>
                        <i class=" fa fa-minus" style="color:red"></i>
                    <?php } ?>
                    <?php if($data['tm5'] == '1') { ?>
                        <i class=" fa fa-check" style="color:green"></i>
                    <?php } ?>
                </td>
                <td >
                    <?php if($data['tm6'] == NULL) { ?>
                        <p></p>
                    <?php } ?>
                    <?php if($data['tm6'] == '0') { ?>
                        <i class=" fa fa-minus" style="color:red"></i>
                    <?php } ?>
                    <?php if($data['tm6'] == '1') { ?>
                        <i class=" fa fa-check" style="color:green"></i>
                    <?php } ?>
                </td>
                <td >
                    <?php if($data['tm7'] == NULL) { ?>
                        <p></p>
                    <?php } ?>
                    <?php if($data['tm7'] == '0') { ?>
                        <i class=" fa fa-minus" style="color:red"></i>
                    <?php } ?>
                    <?php if($data['tm7'] == '1') { ?>
                        <i class=" fa fa-check" style="color:green"></i>
                    <?php } ?>
                </td>
                <td >
                    <?php if($data['tm8'] == NULL) { ?>
                        <p></p>
                    <?php } ?>
                    <?php if($data['tm8'] == '0') { ?>
                        <i class=" fa fa-minus" style="color:red"></i>
                    <?php } ?>
                    <?php if($data['tm8'] == '1') { ?>
                        <i class=" fa fa-check" style="color:green"></i>
                    <?php } ?>
                </td>
                <td >
                    <?php if($data['tm9'] == NULL) { ?>
                        <p></p>
                    <?php } ?>
                    <?php if($data['tm9'] == '0') { ?>
                        <i class=" fa fa-minus" style="color:red"></i>
                    <?php } ?>
                    <?php if($data['tm9'] == '1') { ?>
                        <i class=" fa fa-check" style="color:green"></i>
                    <?php } ?>
                </td>
                <td >
                    <?php if($data['tm10'] == NULL) { ?>
                        <p></p>
                    <?php } ?>
                    <?php if($data['tm10'] == '0') { ?>
                        <i class=" fa fa-minus" style="color:red"></i>
                    <?php } ?>
                    <?php if($data['tm10'] == '1') { ?>
                        <i class=" fa fa-check" style="color:green"></i>
                    <?php } ?>
                </td>
                <td >
                    <?php if($data['tm11'] == NULL) { ?>
                        <p></p>
                    <?php } ?>
                    <?php if($data['tm11'] == '0') { ?>
                        <i class=" fa fa-minus" style="color:red"></i>
                    <?php } ?>
                    <?php if($data['tm11'] == '1') { ?>
                        <i class=" fa fa-check" style="color:green"></i>
                    <?php } ?>
                </td>
                <td >
                    <?php if($data['tm12'] == NULL) { ?>
                        <p></p>
                    <?php } ?>
                    <?php if($data['tm12'] == '0') { ?>
                        <i class=" fa fa-minus" style="color:red"></i>
                    <?php } ?>
                    <?php if($data['tm12'] == '1') { ?>
                        <i class=" fa fa-check" style="color:green"></i>
                    <?php } ?>
                </td>
                <td >
                    <?php if($data['tm13'] == NULL) { ?>
                        <p></p>
                    <?php } ?>
                    <?php if($data['tm13'] == '0') { ?>
                        <i class=" fa fa-minus" style="color:red"></i>
                    <?php } ?>
                    <?php if($data['tm13'] == '1') { ?>
                        <i class=" fa fa-check" style="color:green"></i>
                    <?php } ?>
                </td>
                <td >
                    <?php if($data['tm14'] == NULL) { ?>
                        <p></p>
                    <?php } ?>
                    <?php if($data['tm14'] == '0') { ?>
                        <i class=" fa fa-minus" style="color:red"></i>
                    <?php } ?>
                    <?php if($data['tm14'] == '1') { ?>
                        <i class=" fa fa-check" style="color:green"></i>
                    <?php } ?>
                </td>
                <td >
                    <?php if($data['tm15'] == NULL) { ?>
                        <p></p>
                    <?php } ?>
                    <?php if($data['tm15'] == '0') { ?>
                        <i class=" fa fa-minus" style="color:red"></i>
                    <?php } ?>
                    <?php if($data['tm15'] == '1') { ?>
                        <i class=" fa fa-check" style="color:green"></i>
                    <?php } ?>
                </td>
                <td >
                    <?php if($data['tm16'] == NULL) { ?>
                        <p></p>
                    <?php } ?>
                    <?php if($data['tm16'] == '0') { ?>
                        <i class=" fa fa-minus" style="color:red"></i>
                    <?php } ?>
                    <?php if($data['tm16'] == '1') { ?>
                        <i class=" fa fa-check" style="color:green"></i>
                    <?php } ?>
                </td>
                <td ><?= $data['tm1']+$data['tm2']+$data['tm3']+$data['tm4']+$data['tm5']+$data['tm6']+$data['tm7']+$data['tm8']+$data['tm9']+$data['tm10']+$data['tm11']+$data['tm12']+$data['tm13']+$data['tm14']+$data['tm15']+$data['tm16'] ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<h5 class="mt-3"> <u> Absensi dan Catatan Pengajar</u></h5>

<div class="table-responsive">
    <table class="table table-striped table-bordered nowrap mt-1" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
            <th width="8%">Tatap Muka (TM)</th>
            <th width="3%">Absensi <br> Pengajar</th>
            <th width="4%">Tanggal Tatap Muka</th>
            <th width="20%">Catatan Tatap Muka</th>
            <!-- <th width="8%">Tanggal Isi <br>Absensi</th> -->
            </tr>
        </thead>

        <tbody>
                <tr>
                    <td > 
                        Tatap Muka ke-1
                        <!-- <button type="button" class="btn btn-sm btn-info ml-2" onclick="tm_pengajar('tm1', <?= $detail_kelas[0]['kelas_id'] ?>, <?= $detail_kelas[0]['data_absen_pengajar'] ?>)" >
                        <i class=" fa fa-edit"></i></button>  -->
                    </td>
                    <td >
                        <?php if($tm1 == NULL) { ?>
                            <p></p>
                        <?php } ?>
                        <?php if($tm1 == '0') { ?>
                            <i class=" fa fa-minus" style="color:red"></i>
                        <?php } ?>
                        <?php if($tm1 == '1') { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td > 
                        <?php if($tgl_tm1 == '1000-01-01') { ?>
                            <p>-</p>
                        <?php } ?> 
                        <?php if($tgl_tm1 != '1000-01-01') { ?>
                            <?= shortdate_indo($tgl_tm1) ?>
                        <?php } ?> 
                    </td>
                    <td > <?= $note_tm1 ?> </td>
                </tr>
                <tr>
                    <td > Tatap Muka ke-2</td>
                    <td >
                        <?php if($tm2 == NULL) { ?>
                            <p></p>
                        <?php } ?>
                        <?php if($tm2 == '0') { ?>
                            <i class=" fa fa-minus" style="color:red"></i>
                        <?php } ?>
                        <?php if($tm2 == '1') { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td > 
                        <?php if($tgl_tm2 == '1000-01-01') { ?>
                            <p>-</p>
                        <?php } ?> 
                        <?php if($tgl_tm2 != '1000-01-01') { ?>
                            <?= shortdate_indo($tgl_tm2) ?>
                        <?php } ?> 
                    </td>
                    <td > <?= $note_tm2 ?> </td>
                </tr>
                <tr>
                    <td > Tatap Muka ke-3</td>
                    <td >
                        <?php if($tm3 == NULL) { ?>
                            <p></p>
                        <?php } ?>
                        <?php if($tm3 == '0') { ?>
                            <i class=" fa fa-minus" style="color:red"></i>
                        <?php } ?>
                        <?php if($tm3 == '1') { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td > 
                        <?php if($tgl_tm3 == '1000-01-01') { ?>
                            <p>-</p>
                        <?php } ?> 
                        <?php if($tgl_tm3 != '1000-01-01') { ?>
                            <?= shortdate_indo($tgl_tm3) ?>
                        <?php } ?> 
                    </td>
                    <td > <?= $note_tm3 ?> </td>
                </tr>
                <tr>
                    <td > Tatap Muka ke-4</td>
                    <td >
                        <?php if($tm4 == NULL) { ?>
                            <p></p>
                        <?php } ?>
                        <?php if($tm4 == '0') { ?>
                            <i class=" fa fa-minus" style="color:red"></i>
                        <?php } ?>
                        <?php if($tm4 == '1') { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td > 
                        <?php if($tgl_tm4 == '1000-01-01') { ?>
                            <p>-</p>
                        <?php } ?> 
                        <?php if($tgl_tm4 != '1000-01-01') { ?>
                            <?= shortdate_indo($tgl_tm4) ?>
                        <?php } ?> 
                    </td>
                    <td > <?= $note_tm4 ?> </td>
                </tr>
                <tr>
                    <td > Tatap Muka ke-5</td>
                    <td >
                        <?php if($tm5 == NULL) { ?>
                            <p></p>
                        <?php } ?>
                        <?php if($tm5 == '0') { ?>
                            <i class=" fa fa-minus" style="color:red"></i>
                        <?php } ?>
                        <?php if($tm5 == '1') { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td > 
                        <?php if($tgl_tm5 == '1000-01-01') { ?>
                            <p>-</p>
                        <?php } ?> 
                        <?php if($tgl_tm5 != '1000-01-01') { ?>
                            <?= shortdate_indo($tgl_tm5) ?>
                        <?php } ?> 
                    </td>
                    <td > <?= $note_tm5 ?> </td>
                </tr>
                <tr>
                    <td > Tatap Muka ke-6</td>
                    <td >
                        <?php if($tm6 == NULL) { ?>
                            <p></p>
                        <?php } ?>
                        <?php if($tm6 == '0') { ?>
                            <i class=" fa fa-minus" style="color:red"></i>
                        <?php } ?>
                        <?php if($tm6 == '1') { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td > 
                        <?php if($tgl_tm6 == '1000-01-01') { ?>
                            <p>-</p>
                        <?php } ?> 
                        <?php if($tgl_tm6 != '1000-01-01') { ?>
                            <?= shortdate_indo($tgl_tm6) ?>
                        <?php } ?> 
                    </td>
                    <td > <?= $note_tm6 ?> </td>
                </tr>
                <tr>
                    <td > Tatap Muka ke-7</td>
                    <td >
                        <?php if($tm7 == NULL) { ?>
                            <p></p>
                        <?php } ?>
                        <?php if($tm7 == '0') { ?>
                            <i class=" fa fa-minus" style="color:red"></i>
                        <?php } ?>
                        <?php if($tm7 == '1') { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td > 
                        <?php if($tgl_tm7 == '1000-01-01') { ?>
                            <p>-</p>
                        <?php } ?> 
                        <?php if($tgl_tm7 != '1000-01-01') { ?>
                            <?= shortdate_indo($tgl_tm7) ?>
                        <?php } ?> 
                    </td>
                    <td > <?= $note_tm7 ?> </td>
                </tr>
                <tr>
                    <td > Tatap Muka ke-8</td>
                    <td >
                        <?php if($tm8 == NULL) { ?>
                            <p></p>
                        <?php } ?>
                        <?php if($tm8 == '0') { ?>
                            <i class=" fa fa-minus" style="color:red"></i>
                        <?php } ?>
                        <?php if($tm8 == '1') { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td > 
                        <?php if($tgl_tm8 == '1000-01-01') { ?>
                            <p>-</p>
                        <?php } ?> 
                        <?php if($tgl_tm8 != '1000-01-01') { ?>
                            <?= shortdate_indo($tgl_tm8) ?>
                        <?php } ?> 
                    </td>
                    <td > <?= $note_tm8 ?> </td>
                </tr>
                <tr>
                    <td > Tatap Muka ke-9</td>
                    <td >
                        <?php if($tm9 == NULL) { ?>
                            <p></p>
                        <?php } ?>
                        <?php if($tm9 == '0') { ?>
                            <i class=" fa fa-minus" style="color:red"></i>
                        <?php } ?>
                        <?php if($tm9 == '1') { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td > 
                        <?php if($tgl_tm9 == '1000-01-01') { ?>
                            <p>-</p>
                        <?php } ?> 
                        <?php if($tgl_tm9 != '1000-01-01') { ?>
                            <?= shortdate_indo($tgl_tm9) ?>
                        <?php } ?> 
                    </td>
                    <td > <?= $note_tm9 ?> </td>
                </tr>
                <tr>
                    <td > Tatap Muka ke-10</td>
                    <td >
                        <?php if($tm10 == NULL) { ?>
                            <p></p>
                        <?php } ?>
                        <?php if($tm10 == '0') { ?>
                            <i class=" fa fa-minus" style="color:red"></i>
                        <?php } ?>
                        <?php if($tm10 == '1') { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td > 
                        <?php if($tgl_tm10 == '1000-01-01') { ?>
                            <p>-</p>
                        <?php } ?> 
                        <?php if($tgl_tm10 != '1000-01-01') { ?>
                            <?= shortdate_indo($tgl_tm10) ?>
                        <?php } ?> 
                    </td>
                    <td > <?= $note_tm10 ?> </td>
                </tr>
                <tr>
                    <td > Tatap Muka ke-11</td>
                    <td >
                        <?php if($tm11 == NULL) { ?>
                            <p></p>
                        <?php } ?>
                        <?php if($tm11 == '0') { ?>
                            <i class=" fa fa-minus" style="color:red"></i>
                        <?php } ?>
                        <?php if($tm11 == '1') { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td > 
                        <?php if($tgl_tm11 == '1000-01-01') { ?>
                            <p>-</p>
                        <?php } ?> 
                        <?php if($tgl_tm11 != '1000-01-01') { ?>
                            <?= shortdate_indo($tgl_tm11) ?>
                        <?php } ?> 
                    </td>
                    <td > <?= $note_tm11 ?> </td>
                </tr>
                <tr>
                    <td > Tatap Muka ke-12</td>
                    <td >
                        <?php if($tm12 == NULL) { ?>
                            <p></p>
                        <?php } ?>
                        <?php if($tm12 == '0') { ?>
                            <i class=" fa fa-minus" style="color:red"></i>
                        <?php } ?>
                        <?php if($tm12 == '1') { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td > 
                        <?php if($tgl_tm12 == '1000-01-01') { ?>
                            <p>-</p>
                        <?php } ?> 
                        <?php if($tgl_tm12 != '1000-01-01') { ?>
                            <?= shortdate_indo($tgl_tm12) ?>
                        <?php } ?> 
                    </td>
                    <td > <?= $note_tm12 ?> </td>
                </tr>
                <tr>
                    <td > Tatap Muka ke-13</td>
                    <td >
                        <?php if($tm13 == NULL) { ?>
                            <p></p>
                        <?php } ?>
                        <?php if($tm13 == '0') { ?>
                            <i class=" fa fa-minus" style="color:red"></i>
                        <?php } ?>
                        <?php if($tm13 == '1') { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td > 
                        <?php if($tgl_tm13 == '1000-01-01') { ?>
                            <p>-</p>
                        <?php } ?> 
                        <?php if($tgl_tm13 != '1000-01-01') { ?>
                            <?= shortdate_indo($tgl_tm13) ?>
                        <?php } ?> 
                    </td>
                    <td > <?= $note_tm13 ?> </td>
                </tr>
                <tr>
                    <td > Tatap Muka ke-14</td>
                    <td >
                        <?php if($tm14 == NULL) { ?>
                            <p></p>
                        <?php } ?>
                        <?php if($tm14 == '0') { ?>
                            <i class=" fa fa-minus" style="color:red"></i>
                        <?php } ?>
                        <?php if($tm14 == '1') { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td > 
                        <?php if($tgl_tm14 == '1000-01-01') { ?>
                            <p>-</p>
                        <?php } ?> 
                        <?php if($tgl_tm14 != '1000-01-01') { ?>
                            <?= shortdate_indo($tgl_tm14) ?>
                        <?php } ?> 
                    </td>
                    <td > <?= $note_tm14 ?> </td>
                </tr>
                <tr>
                    <td > Tatap Muka ke-15</td>
                    <td >
                        <?php if($tm15 == NULL) { ?>
                            <p></p>
                        <?php } ?>
                        <?php if($tm15 == '0') { ?>
                            <i class=" fa fa-minus" style="color:red"></i>
                        <?php } ?>
                        <?php if($tm15 == '1') { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td > 
                        <?php if($tgl_tm15 == '1000-01-01') { ?>
                            <p>-</p>
                        <?php } ?> 
                        <?php if($tgl_tm15 != '1000-01-01') { ?>
                            <?= shortdate_indo($tgl_tm15) ?>
                        <?php } ?> 
                    </td>
                    <td > <?= $note_tm15 ?> </td>
                </tr>
                <tr>
                    <td > Tatap Muka ke-16</td>
                    <td >
                        <?php if($tm16 == NULL) { ?>
                            <p></p>
                        <?php } ?>
                        <?php if($tm16 == '0') { ?>
                            <i class=" fa fa-minus" style="color:red"></i>
                        <?php } ?>
                        <?php if($tm16 == '1') { ?>
                            <i class=" fa fa-check" style="color:green"></i>
                        <?php } ?>
                    </td>
                    <td > 
                        <?php if($tgl_tm16 == '1000-01-01') { ?>
                            <p>-</p>
                        <?php } ?> 
                        <?php if($tgl_tm16 != '1000-01-01') { ?>
                            <?= shortdate_indo($tgl_tm16) ?>
                        <?php } ?> 
                    </td>
                    <td > <?= $note_tm16 ?> </td>
                </tr>
        </tbody>
    </table>
</div>

<div class="viewmodaltm">
</div>

<div class="viewmodaltmpgj">
</div>

<script>
    function tm(tm, kelas_id, data_absen_pengajar) {
        $.ajax({
            type: "post",
            url: "<?= site_url('absen/input_tm') ?>",
            data: {
                tm : tm,
                kelas_id : kelas_id,
                data_absen_pengajar : data_absen_pengajar,
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaltm').html(response.sukses).show();
                    $('#modaltm').modal('show');
                }
            }
        });
    }

    // function tm_pengajar(tm, kelas_id, data_absen_pengajar) {
    //     $.ajax({
    //         type: "post",
    //         url: "<?= site_url('absen/input_tm_pengajar') ?>",
    //         data: {
    //             tm : tm,
    //             kelas_id : kelas_id,
    //             data_absen_pengajar : data_absen_pengajar
    //         },
    //         dataType: "json",
    //         success: function(response) {
    //             if (response.sukses) {
    //                 $('.viewmodaltmpgj').html(response.sukses).show();
    //                 $('#modaltmpgj').modal('show');
    //             }
    //         }
    //     });
    // }
</script>

<?= $this->endSection('isi') ?>