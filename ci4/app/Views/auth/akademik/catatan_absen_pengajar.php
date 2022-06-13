<!-- Modal -->
<div class="modal fade" id="modalcatatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Pengajar : <?= $pengajar ?></h6>
                <div class="table-responsive">
                <table class="table table-striped table-bordered nowrap mt-1" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                        <th width="8%">Tatap Muka (TM)</th>
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
                                    <?php if($tgl_tm1 == '1000-01-01') { ?>
                                        <p>-</p>
                                    <?php } ?> 
                                    <?php if($tgl_tm1 != '1000-01-01') { ?>
                                        <?= longdate_indo($tgl_tm1) ?>
                                    <?php } ?> 
                                </td>
                                <td > <?= $note_tm1 ?> </td>
                            </tr>
                            <tr>
                                <td > Tatap Muka ke-2</td>
                                
                                <td > 
                                    <?php if($tgl_tm2 == '1000-01-01') { ?>
                                        <p>-</p>
                                    <?php } ?> 
                                    <?php if($tgl_tm2 != '1000-01-01') { ?>
                                        <?= longdate_indo($tgl_tm2) ?>
                                    <?php } ?> 
                                </td>
                                <td > <?= $note_tm2 ?> </td>
                            </tr>
                            <tr>
                                <td > Tatap Muka ke-3</td>
                                
                                <td > 
                                    <?php if($tgl_tm3 == '1000-01-01') { ?>
                                        <p>-</p>
                                    <?php } ?> 
                                    <?php if($tgl_tm3 != '1000-01-01') { ?>
                                        <?= longdate_indo($tgl_tm3) ?>
                                    <?php } ?> 
                                </td>
                                <td > <?= $note_tm3 ?> </td>
                            </tr>
                            <tr>
                                <td > Tatap Muka ke-4</td>
                                
                                <td > 
                                    <?php if($tgl_tm4 == '1000-01-01') { ?>
                                        <p>-</p>
                                    <?php } ?> 
                                    <?php if($tgl_tm4 != '1000-01-01') { ?>
                                        <?= longdate_indo($tgl_tm4) ?>
                                    <?php } ?> 
                                </td>
                                <td > <?= $note_tm4 ?> </td>
                            </tr>
                            <tr>
                                <td > Tatap Muka ke-5</td>
                                
                                <td > 
                                    <?php if($tgl_tm5 == '1000-01-01') { ?>
                                        <p>-</p>
                                    <?php } ?> 
                                    <?php if($tgl_tm5 != '1000-01-01') { ?>
                                        <?= longdate_indo($tgl_tm5) ?>
                                    <?php } ?> 
                                </td>
                                <td > <?= $note_tm5 ?> </td>
                            </tr>
                            <tr>
                                <td > Tatap Muka ke-6</td>
                                
                                <td > 
                                    <?php if($tgl_tm6 == '1000-01-01') { ?>
                                        <p>-</p>
                                    <?php } ?> 
                                    <?php if($tgl_tm6 != '1000-01-01') { ?>
                                        <?= longdate_indo($tgl_tm6) ?>
                                    <?php } ?> 
                                </td>
                                <td > <?= $note_tm6 ?> </td>
                            </tr>
                            <tr>
                                <td > Tatap Muka ke-7</td>
                                
                                <td > 
                                    <?php if($tgl_tm7 == '1000-01-01') { ?>
                                        <p>-</p>
                                    <?php } ?> 
                                    <?php if($tgl_tm7 != '1000-01-01') { ?>
                                        <?= longdate_indo($tgl_tm7) ?>
                                    <?php } ?> 
                                </td>
                                <td > <?= $note_tm7 ?> </td>
                            </tr>
                            <tr>
                                <td > Tatap Muka ke-8</td>
                                
                                <td > 
                                    <?php if($tgl_tm8 == '1000-01-01') { ?>
                                        <p>-</p>
                                    <?php } ?> 
                                    <?php if($tgl_tm8 != '1000-01-01') { ?>
                                        <?= longdate_indo($tgl_tm8) ?>
                                    <?php } ?> 
                                </td>
                                <td > <?= $note_tm8 ?> </td>
                            </tr>
                            <tr>
                                <td > Tatap Muka ke-9</td>
                                
                                <td > 
                                    <?php if($tgl_tm9 == '1000-01-01') { ?>
                                        <p>-</p>
                                    <?php } ?> 
                                    <?php if($tgl_tm9 != '1000-01-01') { ?>
                                        <?= longdate_indo($tgl_tm9) ?>
                                    <?php } ?> 
                                </td>
                                <td > <?= $note_tm9 ?> </td>
                            </tr>
                            <tr>
                                <td > Tatap Muka ke-10</td>
                                
                                <td > 
                                    <?php if($tgl_tm10 == '1000-01-01') { ?>
                                        <p>-</p>
                                    <?php } ?> 
                                    <?php if($tgl_tm10 != '1000-01-01') { ?>
                                        <?= longdate_indo($tgl_tm10) ?>
                                    <?php } ?> 
                                </td>
                                <td > <?= $note_tm10 ?> </td>
                            </tr>
                            <tr>
                                <td > Tatap Muka ke-11</td>
                                
                                <td > 
                                    <?php if($tgl_tm11 == '1000-01-01') { ?>
                                        <p>-</p>
                                    <?php } ?> 
                                    <?php if($tgl_tm11 != '1000-01-01') { ?>
                                        <?= longdate_indo($tgl_tm11) ?>
                                    <?php } ?> 
                                </td>
                                <td > <?= $note_tm11 ?> </td>
                            </tr>
                            <tr>
                                <td > Tatap Muka ke-12</td>
                                
                                <td > 
                                    <?php if($tgl_tm12 == '1000-01-01') { ?>
                                        <p>-</p>
                                    <?php } ?> 
                                    <?php if($tgl_tm12 != '1000-01-01') { ?>
                                        <?= longdate_indo($tgl_tm12) ?>
                                    <?php } ?> 
                                </td>
                                <td > <?= $note_tm12 ?> </td>
                            </tr>
                            <tr>
                                <td > Tatap Muka ke-13</td>
                                
                                <td > 
                                    <?php if($tgl_tm13 == '1000-01-01') { ?>
                                        <p>-</p>
                                    <?php } ?> 
                                    <?php if($tgl_tm13 != '1000-01-01') { ?>
                                        <?= longdate_indo($tgl_tm13) ?>
                                    <?php } ?> 
                                </td>
                                <td > <?= $note_tm13 ?> </td>
                            </tr>
                            <tr>
                                <td > Tatap Muka ke-14</td>
                               
                                <td > 
                                    <?php if($tgl_tm14 == '1000-01-01') { ?>
                                        <p>-</p>
                                    <?php } ?> 
                                    <?php if($tgl_tm14 != '1000-01-01') { ?>
                                        <?= longdate_indo($tgl_tm14) ?>
                                    <?php } ?> 
                                </td>
                                <td > <?= $note_tm14 ?> </td>
                            </tr>
                            <tr>
                                <td > Tatap Muka ke-15</td>
                                
                                <td > 
                                    <?php if($tgl_tm15 == '1000-01-01') { ?>
                                        <p>-</p>
                                    <?php } ?> 
                                    <?php if($tgl_tm15 != '1000-01-01') { ?>
                                        <?= longdate_indo($tgl_tm15) ?>
                                    <?php } ?> 
                                </td>
                                <td > <?= $note_tm15 ?> </td>
                            </tr>
                            <tr>
                                <td > Tatap Muka ke-16</td>
                               
                                <td > 
                                    <?php if($tgl_tm16 == '1000-01-01') { ?>
                                        <p>-</p>
                                    <?php } ?> 
                                    <?php if($tgl_tm16 != '1000-01-01') { ?>
                                        <?= longdate_indo($tgl_tm16) ?>
                                    <?php } ?> 
                                </td>
                                <td > <?= $note_tm16 ?> </td>
                            </tr>
                    </tbody>
                </table>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>