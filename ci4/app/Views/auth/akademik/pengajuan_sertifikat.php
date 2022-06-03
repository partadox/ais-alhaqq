<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart('/akademik/simpan_pengajuan_sertifikat');
            helper('text');
            ?>
            <?= csrf_field() ?>

            <div class="modal-body">

                <p class="mt-3">Catatan :<br> 
                    <i class="mdi mdi-information"></i> Form input bertanda <code>*</code> wajib diisi! <br>
                </p>

                <input type="hidden" class="form-control" id="sertifikat_peserta_id" name="sertifikat_peserta_id" value="<?= $peserta_id ?>">
                <input type="hidden" class="form-control" id="periode_cetak" name="periode_cetak" value="<?= $periode_cetak ?>">

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Level <code>*</code></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-uppercase" id="sertifikat_level" name="sertifikat_level" value="TAJWIDI-2" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Nominal Bayar<code>*</code></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nominal_bayar_cetak" name="nominal_bayar_cetak" placeholder="Rp">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Keterangan Lain</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-uppercase" id="keterangan_cetak" name="keterangan_cetak">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Upload Bukti Transfer<code>*</code></label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"  id="foto" name="foto" onchange="previewimg()">
                                <label class="custom-file-label">Upload Bukti Transfer</label>
                            </div>
                        </div>
                    </div>
                    <div class="invalid-feedback errorFoto"></div>
                    <div class="col-lg-8 mt-2">
                    <div class="media">
                        <img src="" class="img-preview img-thumbnail rounded img-fluid" width="50%" alt >
                    </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-share-square"></i> Ajukan Cetak</button>
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
    });

    $(document).ready(function () {
    $('#nominal_bayar_cetak').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});
  });
</script>