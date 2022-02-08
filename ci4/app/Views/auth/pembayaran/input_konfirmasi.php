<!-- Modal -->
<div class="modal fade" id="modalkonfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('pembayaran/simpan_konfirmasi', ['class' => 'formkonfirmasi']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <!-- <center>
                    <img class="img-thumbnail" width="70%" src="<?= base_url('/img/transfer/' . $bukti_bayar) ?>">
                </center> -->
                <p class="mt-3">Catatan :<br> 
                    <i class="mdi mdi-information"></i> Lihat Bukti Bayar Dengan Teliti. <br>
                    <i class="mdi mdi-information"></i> Semua form input wajib diisi, jika nominal 0 input kembali dengan nominal 0. <br>
                    <i class="mdi mdi-information"></i> Bilah kiri adalah nominal input dari peserta, bilah kanan merupakan nominal input konfirmasi untuk admin yang harus diisi. <br>
                    <i class="mdi mdi-information"></i> Perhatikan nominal input dan ketrangan lain dari Peserta. Kemudian jika sesuai masukan kembali nominal pada form input kanan.<br>
                </p>
                <input type="hidden" class="form-control" id="bayar_id" name="bayar_id" value="<?= $bayar_id ?>" disabled>
                <input type="hidden" class="form-control" id="kelas_id" name="kelas_id" value="<?= $kelas_id ?>" disabled>
                <input type="hidden" class="form-control" id="peserta_id" name="peserta_id" value="<?= $bayar_peserta_id ?>" disabled>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Total Nominal Transfer<code>*</code></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nominal_bayar" name="nominal_bayar" value="Rp <?= rupiah($awal_bayar) ?>">
                        <div class="invalid-feedback errorNominal_bayar"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Daftar<code>*</code></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="bayar_daftar" name="bayar_daftar"  value="Rp <?= rupiah($awal_bayar_daftar) ?>">
                        <div class="invalid-feedback errorBayar_daftar"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">SPP-1<code>*</code></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="bayar_spp1" name="bayar_spp1" value="Rp <?= rupiah($awal_bayar_spp1) ?>">
                        <div class="invalid-feedback errorBayar_spp1"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">SPP-2<code>*</code></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="bayar_spp2" name="bayar_spp2" value="Rp <?= rupiah($awal_bayar_spp2) ?>">
                        <div class="invalid-feedback errorBayar_spp2"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">SPP-3<code>*</code></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="bayar_spp3" name="bayar_spp3" value="Rp <?= rupiah($awal_bayar_spp3) ?>">
                        <div class="invalid-feedback errorBayar_spp3"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">SPP-4<code>*</code></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="bayar_spp4" name="bayar_spp4" value="Rp <?= rupiah($awal_bayar_spp4) ?>">
                        <div class="invalid-feedback errorBayar_spp4"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Infaq<code>*</code></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="bayar_infaq" name="bayar_infaq" value="Rp <?= rupiah($awal_bayar_infaq) ?>">
                        <div class="invalid-feedback errorBayar_infaq"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Keterangan Dari Peserta</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $keterangan_bayar ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btnsimpan"><i class="fa fa-check"></i> Konfirmasi</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<script>

    // document.querySelectorAll('input[type-currency="IDR"]').forEach((element) => {
    //     element.addEventListener('keyup', function(e) {
    //     let cursorPostion = this.selectionStart;
    //         let value = parseInt(this.value.replace(/[^,\d]/g, ''));
    //         let originalLenght = this.value.length;
    //         if (isNaN(value)) {
    //         this.value = "";
    //         } else {    
    //         this.value = value.toLocaleString('id-ID', {
    //             currency: 'IDR',
    //             style: 'currency',
    //             minimumFractionDigits: 0
    //         });
    //         cursorPostion = this.value.length - originalLenght + cursorPostion;
    //         this.setSelectionRange(cursorPostion, cursorPostion);
    //         }
    //     });
    //     }); //source : https://codepen.io/tothepoints/pen/xxRwGvz

    $(document).ready(function () {
    $('#nominal_bayar').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0, allowZero:true});
    $('#bayar_daftar').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0, allowZero:true});
      $('#bayar_spp1').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0, allowZero:true});
      $('#bayar_infaq').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0, allowZero:true});
      $('#bayar_spp2').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0, allowZero:true});
      $('#bayar_spp3').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0, allowZero:true});
      $('#bayar_spp4').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0, allowZero:true});
  });


    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            theme: "bootstrap4"
        });
        $('.formkonfirmasi').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    bayar_id: $('input#bayar_id').val(),
                    kelas_id: $('input#kelas_id').val(),
                    peserta_id: $('input#peserta_id').val(),
                    nominal_bayar: $('input#nominal_bayar').val(),
                    bayar_daftar: $('input#bayar_daftar').val(),
                    bayar_spp1: $('input#bayar_spp1').val(),
                    bayar_spp2: $('input#bayar_spp2').val(),
                    bayar_spp3: $('input#bayar_spp3').val(),
                    bayar_spp4: $('input#bayar_spp4').val(),
                    bayar_infaq: $('input#bayar_infaq').val(),
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
                        if (response.error.nominal_bayar) {
                            $('#nominal_bayar').addClass('is-invalid');
                            $('.errorNominal_bayar').html(response.error.nominal_bayar);
                        } else {
                            $('#nominal_bayar').removeClass('is-invalid');
                            $('.errorNominal_bayar').html('');
                        }
                        if (response.error.bayar_daftar) {
                            $('#bayar_daftar').addClass('is-invalid');
                            $('.errorBayar_daftar').html(response.error.bayar_daftar);
                        } else {
                            $('#bayar_daftar').removeClass('is-invalid');
                            $('.errorBayar_daftar').html('');
                        }
                        if (response.error.bayar_infaq) {
                            $('#bayar_infaq').addClass('is-invalid');
                            $('.errorBayar_infaq').html(response.error.bayar_infaq);
                        } else {
                            $('#bayar_infaq').removeClass('is-invalid');
                            $('.errorBayar_infaq').html('');
                        }
                        if (response.error.bayar_spp3) {
                            $('#bayar_spp3').addClass('is-invalid');
                            $('.errorBayar_spp3').html(response.error.bayar_spp3);
                        } else {
                            $('#bayar_spp3').removeClass('is-invalid');
                            $('.errorBayar_spp3').html('');
                        }
                        if (response.error.bayar_spp1) {
                            $('#bayar_spp1').addClass('is-invalid');
                            $('.errorBayar_spp1').html(response.error.bayar_spp1);
                        } else {
                            $('#bayar_spp1').removeClass('is-invalid');
                            $('.errorBayar_spp1').html('');
                        }
                        if (response.error.bayar_spp2) {
                            $('#bayar_spp2').addClass('is-invalid');
                            $('.errorBayar_spp2').html(response.error.bayar_spp2);
                        } else {
                            $('#bayar_spp2').removeClass('is-invalid');
                            $('.errorBayar_spp2').html('');
                        }
                        if (response.error.bayar_spp4) {
                            $('#bayar_spp4').addClass('is-invalid');
                            $('.errorBayar_spp4').html(response.error.bayar_spp4);
                        } else {
                            $('#bayar_spp4').removeClass('is-invalid');
                            $('.errorBayar_spp4').html('');
                        }
                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Pembayaran Berhasil Dikonfirmasi",
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