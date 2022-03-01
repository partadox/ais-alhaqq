<!-- Modal -->
<div class="modal fade" id="modaltm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?> <?= $tm_upper ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart('/absen/simpan_tm');
            ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="tatap_muka" value="<?= $tm ?>">
            <input type="hidden" name="kelas_id" value="<?= $kelas_id ?>">
            <input type="hidden" name="absen_pengajar_id" value="<?= $absen_pengajar_id ?>">
            <div class="modal-body">
                <h5> <u>Pengajar: <?= $nama_pengajar ?></u> </h5>

                <?php if($tm == 'tm1') { ?>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Absensi <?= $tm_upper ?><code>*</code></label>
                        <div class="col-sm-8">
                            <input type="checkbox" name="checkpgj1" value="1" <?php if ($absen_pengajar['tm1_pengajar'] == '1') echo "checked"; ?>>
                            <label class="form-check-label" for="checkpgj1"> HADIR</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_tm1" name="tgl_tm1" value="<?= $absen_pengajar['tgl_tm1']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Catatan <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-uppercase" id="note_tm1" name="note_tm1" value="<?= $absen_pengajar['note_tm1']?>">
                        </div>
                    </div>
                <?php } ?>
                <?php if($tm == 'tm2') { ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Absensi <?= $tm_upper ?><code>*</code></label>
                        <div class="col-sm-8">
                            <input type="checkbox" name="checkpgj2" value="1" <?php if ($absen_pengajar['tm2_pengajar'] == '1') echo "checked"; ?>>
                            <label class="form-check-label" for="checkpgj2"> HADIR</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_tm2" name="tgl_tm2" value="<?= $absen_pengajar['tgl_tm2']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Catatan <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-uppercase" id="note_tm2" name="note_tm2" value="<?= $absen_pengajar['note_tm2']?>">
                        </div>
                    </div>
                <?php } ?>
                <?php if($tm == 'tm3') { ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Absensi <?= $tm_upper ?><code>*</code></label>
                        <div class="col-sm-8">
                            <input type="checkbox" name="checkpgj3" value="1" <?php if ($absen_pengajar['tm3_pengajar'] == '1') echo "checked"; ?>>
                            <label class="form-check-label" for="checkpgj3"> HADIR</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_tm3" name="tgl_tm3" value="<?= $absen_pengajar['tgl_tm3']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Catatan <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-uppercase" id="note_tm3" name="note_tm3" value="<?= $absen_pengajar['note_tm3']?>">
                        </div>
                    </div>
                <?php } ?>
                <?php if($tm == 'tm4') { ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Absensi <?= $tm_upper ?><code>*</code></label>
                        <div class="col-sm-8">
                            <input type="checkbox" name="checkpgj4" value="1" <?php if ($absen_pengajar['tm4_pengajar'] == '1') echo "checked"; ?>>
                            <label class="form-check-label" for="checkpgj4"> HADIR</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_tm4" name="tgl_tm4" value="<?= $absen_pengajar['tgl_tm4']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Catatan <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-uppercase" id="note_tm4" name="note_tm4" value="<?= $absen_pengajar['note_tm4']?>">
                        </div>
                    </div>
                <?php } ?>
                <?php if($tm == 'tm5') { ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Absensi <?= $tm_upper ?><code>*</code></label>
                        <div class="col-sm-8">
                            <input type="checkbox" name="checkpgj5" value="1" <?php if ($absen_pengajar['tm5_pengajar'] == '1') echo "checked"; ?>>
                            <label class="form-check-label" for="checkpgj5"> HADIR</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_tm5" name="tgl_tm5" value="<?= $absen_pengajar['tgl_tm5']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Catatan <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-uppercase" id="note_tm5" name="note_tm5" value="<?= $absen_pengajar['note_tm5']?>">
                        </div>
                    </div>
                <?php } ?>
                <?php if($tm == 'tm6') { ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Absensi <?= $tm_upper ?><code>*</code></label>
                        <div class="col-sm-8">
                            <input type="checkbox" name="checkpgj6" value="1" <?php if ($absen_pengajar['tm6_pengajar'] == '1') echo "checked"; ?>>
                            <label class="form-check-label" for="checkpgj6"> HADIR</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_tm6" name="tgl_tm6" value="<?= $absen_pengajar['tgl_tm6']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Catatan <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-uppercase" id="note_tm6" name="note_tm6" value="<?= $absen_pengajar['note_tm6']?>">
                        </div>
                    </div>
                <?php } ?>
                <?php if($tm == 'tm7') { ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Absensi <?= $tm_upper ?><code>*</code></label>
                        <div class="col-sm-8">
                            <input type="checkbox" name="checkpgj7" value="1" <?php if ($absen_pengajar['tm7_pengajar'] == '1') echo "checked"; ?>>
                            <label class="form-check-label" for="checkpgj7"> HADIR</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_tm7" name="tgl_tm7" value="<?= $absen_pengajar['tgl_tm7']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Catatan <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-uppercase" id="note_tm7" name="note_tm7" value="<?= $absen_pengajar['note_tm7']?>">
                        </div>
                    </div>
                <?php } ?>
                <?php if($tm == 'tm8') { ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Absensi <?= $tm_upper ?><code>*</code></label>
                        <div class="col-sm-8">
                            <input type="checkbox" name="checkpgj8" value="1" <?php if ($absen_pengajar['tm8_pengajar'] == '1') echo "checked"; ?>>
                            <label class="form-check-label" for="checkpgj8"> HADIR</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_tm8" name="tgl_tm8" value="<?= $absen_pengajar['tgl_tm8']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Catatan <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-uppercase" id="note_tm8" name="note_tm8" value="<?= $absen_pengajar['note_tm8']?>">
                        </div>
                    </div>
                <?php } ?>
                <?php if($tm == 'tm9') { ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Absensi <?= $tm_upper ?><code>*</code></label>
                        <div class="col-sm-8">
                            <input type="checkbox" name="checkpgj9" value="1" <?php if ($absen_pengajar['tm9_pengajar'] == '1') echo "checked"; ?>>
                            <label class="form-check-label" for="checkpgj9"> HADIR</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_tm9" name="tgl_tm9" value="<?= $absen_pengajar['tgl_tm9']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Catatan <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-uppercase" id="note_tm9" name="note_tm9" value="<?= $absen_pengajar['note_tm9']?>">
                        </div>
                    </div>
                <?php } ?>
                <?php if($tm == 'tm10') { ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Absensi <?= $tm_upper ?><code>*</code></label>
                        <div class="col-sm-8">
                            <input type="checkbox" name="checkpgj10" value="1" <?php if ($absen_pengajar['tm10_pengajar'] == '1') echo "checked"; ?>>
                            <label class="form-check-label" for="checkpgj10"> HADIR</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_tm10" name="tgl_tm10" value="<?= $absen_pengajar['tgl_tm10']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Catatan <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-uppercase" id="note_tm10" name="note_tm10" value="<?= $absen_pengajar['note_tm10']?>">
                        </div>
                    </div>
                <?php } ?>
                <?php if($tm == 'tm11') { ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Absensi <?= $tm_upper ?><code>*</code></label>
                        <div class="col-sm-8">
                            <input type="checkbox" name="checkpgj11" value="1" <?php if ($absen_pengajar['tm11_pengajar'] == '1') echo "checked"; ?>>
                            <label class="form-check-label" for="checkpgj11"> HADIR</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_tm11" name="tgl_tm11" value="<?= $absen_pengajar['tgl_tm11']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Catatan <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-uppercase" id="note_tm11" name="note_tm11" value="<?= $absen_pengajar['note_tm11']?>">
                        </div>
                    </div>
                <?php } ?>
                <?php if($tm == 'tm12') { ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Absensi <?= $tm_upper ?><code>*</code></label>
                        <div class="col-sm-8">
                            <input type="checkbox" name="checkpgj12" value="1" <?php if ($absen_pengajar['tm12_pengajar'] == '1') echo "checked"; ?>>
                            <label class="form-check-label" for="checkpgj12"> HADIR</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_tm12" name="tgl_tm12" value="<?= $absen_pengajar['tgl_tm12']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Catatan <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-uppercase" id="note_tm12" name="note_tm12" value="<?= $absen_pengajar['note_tm12']?>">
                        </div>
                    </div>
                <?php } ?>
                <?php if($tm == 'tm13') { ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Absensi <?= $tm_upper ?><code>*</code></label>
                        <div class="col-sm-8">
                            <input type="checkbox" name="checkpgj13" value="1" <?php if ($absen_pengajar['tm13_pengajar'] == '1') echo "checked"; ?>>
                            <label class="form-check-label" for="checkpgj13"> HADIR</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_tm13" name="tgl_tm13" value="<?= $absen_pengajar['tgl_tm13']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Catatan <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-uppercase" id="note_tm13" name="note_tm13" value="<?= $absen_pengajar['note_tm13']?>">
                        </div>
                    </div>
                <?php } ?>
                <?php if($tm == 'tm14') { ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Absensi <?= $tm_upper ?><code>*</code></label>
                        <div class="col-sm-8">
                            <input type="checkbox" name="checkpgj14" value="1" <?php if ($absen_pengajar['tm14_pengajar'] == '1') echo "checked"; ?>>
                            <label class="form-check-label" for="checkpgj14"> HADIR</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_tm14" name="tgl_tm14" value="<?= $absen_pengajar['tgl_tm14']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Catatan <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-uppercase" id="note_tm14" name="note_tm14" value="<?= $absen_pengajar['note_tm14']?>">
                        </div>
                    </div>
                <?php } ?>
                <?php if($tm == 'tm15') { ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Absensi <?= $tm_upper ?><code>*</code></label>
                        <div class="col-sm-8">
                            <input type="checkbox" name="checkpgj15" value="1" <?php if ($absen_pengajar['tm15_pengajar'] == '1') echo "checked"; ?>>
                            <label class="form-check-label" for="checkpgj15"> HADIR</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_tm15" name="tgl_tm15" value="<?= $absen_pengajar['tgl_tm15']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Catatan <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-uppercase" id="note_tm15" name="note_tm15" value="<?= $absen_pengajar['note_tm15']?>">
                        </div>
                    </div>
                <?php } ?>
                <?php if($tm == 'tm16') { ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Absensi <?= $tm_upper ?><code>*</code></label>
                        <div class="col-sm-8">
                            <input type="checkbox" name="checkpgj16" value="1" <?php if ($absen_pengajar['tm16_pengajar'] == '1') echo "checked"; ?>>
                            <label class="form-check-label" for="checkpgj16"> HADIR</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_tm16" name="tgl_tm16" value="<?= $absen_pengajar['tgl_tm16']?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Catatan <?= $tm_upper ?> </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-uppercase" id="note_tm16" name="note_tm16" value="<?= $absen_pengajar['note_tm16']?>">
                        </div>
                    </div>
                <?php } ?>
                <hr>
                <style>
                    .table-responsive {
                        max-height:300px;
                    }

                    .wrapper {
                        position: relative;
                    }

                    .overlay th {
                        position: absolute;
                        top:0;
                    }
                </style>

                <h5> <u>Peserta</u></h5>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered nowrap mt-1" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                            <th width="2%">No.</th>
                            <th width="3%">NIS</th>
                            <th width="20%"class="name-col" >Nama Peserta</th>
                            <th width="4%" bgcolor="#87de9d">Hadir </th>
                            <th width="4%" bgcolor="#de8887">Tidak Hadir </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 0; $nomor = -1;
                            foreach ($absen_tm as $data) :
                                $no++; $nomor++; ?>
                                <tr>
                                <td ><?= $no ?></td>
                                <td ><?= $data['nis'] ?> <input type="hidden" name="jml_psrt[]" value="<?= $data['peserta_kelas_id'] ?>"></td>
                                <td ><?= $data['nama_peserta'] ?> <input type="hidden" name="psrt<?= $nomor ?>" value="<?= $data['data_absen'] ?>"></td>
                                <?php if($tm == 'tm1') { ?>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="1" <?php if ($data['tm1'] == '1') echo "checked"; ?>>
                                    </td>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="0" <?php if ($data['tm1'] == '0') echo "checked"; ?>>
                                    </td>
                                <?php } ?>
                                <?php if($tm == 'tm2') { ?>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="1" <?php if ($data['tm2'] == '1') echo "checked"; ?>>
                                    </td>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="0" <?php if ($data['tm2'] == '0') echo "checked"; ?>>
                                    </td>
                                <?php } ?>
                                <?php if($tm == 'tm3') { ?>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="1" <?php if ($data['tm3'] == '1') echo "checked"; ?>>
                                    </td>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="0" <?php if ($data['tm3'] == '0') echo "checked"; ?>>
                                    </td>
                                <?php } ?>
                                <?php if($tm == 'tm4') { ?>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="1" <?php if ($data['tm4'] == '1') echo "checked"; ?>>
                                    </td>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="0" <?php if ($data['tm4'] == '0') echo "checked"; ?>>
                                    </td>
                                <?php } ?>
                                <?php if($tm == 'tm5') { ?>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="1" <?php if ($data['tm5'] == '1') echo "checked"; ?>>
                                    </td>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="0" <?php if ($data['tm5'] == '0') echo "checked"; ?>>
                                    </td>
                                <?php } ?>
                                <?php if($tm == 'tm6') { ?>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="1" <?php if ($data['tm6'] == '1') echo "checked"; ?>>
                                    </td>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="0" <?php if ($data['tm6'] == '0') echo "checked"; ?>>
                                    </td>
                                <?php } ?>
                                <?php if($tm == 'tm7') { ?>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="1" <?php if ($data['tm7'] == '1') echo "checked"; ?>>
                                    </td>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="0" <?php if ($data['tm7'] == '0') echo "checked"; ?>>
                                    </td>
                                <?php } ?>
                                <?php if($tm == 'tm8') { ?>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="1" <?php if ($data['tm8'] == '1') echo "checked"; ?>>
                                    </td>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="0" <?php if ($data['tm8'] == '0') echo "checked"; ?>>
                                    </td>
                                <?php } ?>
                                <?php if($tm == 'tm9') { ?>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="1" <?php if ($data['tm9'] == '1') echo "checked"; ?>>
                                    </td>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="0" <?php if ($data['tm9'] == '0') echo "checked"; ?>>
                                    </td>
                                <?php } ?>
                                <?php if($tm == 'tm10') { ?>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="1" <?php if ($data['tm10'] == '1') echo "checked"; ?>>
                                    </td>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="0" <?php if ($data['tm10'] == '0') echo "checked"; ?>>
                                    </td>
                                <?php } ?>
                                <?php if($tm == 'tm11') { ?>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="1" <?php if ($data['tm11'] == '1') echo "checked"; ?>>
                                    </td>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="0" <?php if ($data['tm11'] == '0') echo "checked"; ?>>
                                    </td>
                                <?php } ?>
                                <?php if($tm == 'tm12') { ?>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="1" <?php if ($data['tm12'] == '1') echo "checked"; ?>>
                                    </td>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="0" <?php if ($data['tm12'] == '0') echo "checked"; ?>>
                                    </td>
                                <?php } ?>
                                <?php if($tm == 'tm13') { ?>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="1" <?php if ($data['tm13'] == '1') echo "checked"; ?>>
                                    </td>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="0" <?php if ($data['tm13'] == '0') echo "checked"; ?>>
                                    </td>
                                <?php } ?>
                                <?php if($tm == 'tm14') { ?>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="1" <?php if ($data['tm14'] == '1') echo "checked"; ?>>
                                    </td>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="0" <?php if ($data['tm14'] == '0') echo "checked"; ?>>
                                    </td>
                                <?php } ?>
                                <?php if($tm == 'tm15') { ?>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="1" <?php if ($data['tm15'] == '1') echo "checked"; ?>>
                                    </td>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="0" <?php if ($data['tm15'] == '0') echo "checked"; ?>>
                                    </td>
                                <?php } ?>
                                <?php if($tm == 'tm16') { ?>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="1" <?php if ($data['tm16'] == '1') echo "checked"; ?>>
                                    </td>
                                    <td >
                                        <input type="radio" name="check<?= $nomor ?>" value="0" <?php if ($data['tm16'] == '0') echo "checked"; ?>>
                                    </td>
                                <?php } ?>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-share-square"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            theme: "bootstrap4"
        });
        $('.formtambah').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    nama_bank: $('input#nama_bank').val(),
                    rekening_bank: $('input#rekening_bank').val(),
                    atas_nama_bank: $('input#atas_nama_bank').val(),
                },
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disable');
                    $('.btnsimpan').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable', 'disable');
                    $('.btnsimpan').html('<i class="fa fa-share-square"></i>  Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.nama_bank) {
                            $('#nama_bank').addClass('is-invalid');
                            $('.errorNama_bank').html(response.error.nama_bank);
                        } else {
                            $('#nama_bank').removeClass('is-invalid');
                            $('.errorNama_kantor').html('');
                        }

                        if (response.error.rekening_bank) {
                            $('#rekening_bank').addClass('is-invalid');
                            $('.errorRekening_bank').html(response.error.rekening_bank);
                        } else {
                            $('#rekening_bank').removeClass('is-invalid');
                            $('.errorRekening_bank').html('');
                        }

                        if (response.error.atas_nama_bank) {
                            $('#atas_nama_bank').addClass('is-invalid');
                            $('.errorAtas_nama_bank').html(response.error.atas_nama_bank);
                        } else {
                            $('#atas_nama_bank').removeClass('is-invalid');
                            $('.errorAtas_nama_bank').html('');
                        }
                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Berhasil Tambah Data Rekening Bank",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                                window.location = response.sukses.link;
                        });
                    }
                }
            });
        })
    });
</script>