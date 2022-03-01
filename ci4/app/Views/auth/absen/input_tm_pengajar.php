<!-- Modal -->
<div class="modal fade" id="modaltmpgj" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?> <?= $tm_upper ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart('/absen/simpan_tm_pengajar');
            ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="tatap_muka" value="<?= $tm ?>">
            <input type="hidden" name="kelas_id" value="<?= $kelas_id ?>">
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered nowrap mt-1" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                            <th width="20%"class="name-col" >Nama</th>
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