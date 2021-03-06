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
            <?php echo form_open_multipart('/pembayaran/simpan_bayar');
            helper('text');
            ?>
            <?= csrf_field() ?>
            <div class="modal-body">
                <p class="mt-3">Catatan :<br> 
                    <i class="mdi mdi-information"></i> Semua form input wajib diisi, Isikan nominal 0 pada tipe pembayaran yang tidak diinginkan. <br>
                </p>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label"> Peserta<code>*</code></label>
                    <div class="col-sm-10">
                        <select name="bayar_peserta_id" id="bayar_peserta_id" class="js-example-basic-single">
                                <option value="" disabled selected>--Pilih--</option>
                            <?php foreach ($peserta as $key => $data) { ?>
                                <option value="<?= $data['peserta_id'] ?>"><?= $data['nama'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorBayar_peserta_id"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label"> Kelas Ada Kuota<code>*</code></label>
                    <div class="col-sm-10">
                        <select name="kelas_id" id="kelas_id" class="js-example-basic-single">
                                <option value="" disabled selected>--Pilih--</option>
                            <?php foreach ($kelas as $key => $data) { ?>
                                <option value="<?= $data['kelas_id'] ?>"><?= $data['nama_kelas'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorKelas_id"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Nominal Bayar<code>*</code></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="awal_bayar" name="awal_bayar" placeholder="Rp">
                        <div class="invalid-feedback errorAwal_bayar"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Infaq<code>*</code></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="awal_bayar_infaq" name="awal_bayar_infaq" placeholder="Rp">
                        <div class="invalid-feedback errorInfaq"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Biaya Daftar<code>*</code></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="awal_bayar_daftar" name="awal_bayar_daftar" placeholder="Rp">
                        <div class="invalid-feedback errorBayar_daftar"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">SPP-1<code>*</code></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="awal_bayar_spp1" name="awal_bayar_spp1" placeholder="Rp">
                        <div class="invalid-feedback errorSpp1"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">SPP-2<code>*</code></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="awal_bayar_spp2" name="awal_bayar_spp2" placeholder="Rp">
                        <div class="invalid-feedback errorSpp2"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">SPP-3<code>*</code></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="awal_bayar_spp3" name="awal_bayar_spp3" placeholder="Rp">
                        <div class="invalid-feedback errorSpp3"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">SPP-4<code>*</code></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="awal_bayar_spp4" name="awal_bayar_spp4" placeholder="Rp">
                        <div class="invalid-feedback errorSpp4"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Keterangan Bayar</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="keterangan_bayar" name="keterangan_bayar">
                        <div class="invalid-feedback errorKeterangan_bayar"></div>
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
    });

    $(document).ready(function () {
    $('#awal_bayar').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0, allowZero:true});
    $('#awal_bayar_daftar').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0, allowZero:true});
      $('#awal_bayar_spp1').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0, allowZero:true});
      $('#awal_bayar_infaq').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0, allowZero:true});
      $('#awal_bayar_spp2').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0, allowZero:true});
      $('#awal_bayar_spp3').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0, allowZero:true});
      $('#awal_bayar_spp4').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0, allowZero:true});
  });
</script>