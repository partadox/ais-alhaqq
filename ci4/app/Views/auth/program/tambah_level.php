<!-- Modal -->
<div class="modal fade" id="modaltambahlevel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('program/simpan_level', ['class' => 'formtambah']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nama Level <code>*</code></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control text-uppercase" id="nama_level" name="nama_level">
                        <div class="invalid-feedback errorNama_level"></div>
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Urutan Level<code>*</code></label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="urutan_level" name="urutan_level">
                        <div class="invalid-feedback errorUrutan_level"></div>
                    </div>
                </div> -->
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tampil Di Daftar Peserta Baru <code>*</code></label>
                    <div class="col-sm-8">
                        <select class="form-control btn-square" id="tampil_ondaftar" name="tampil_ondaftar">
                            <option value="" disabled selected>--Pilih--</option>
                            <option value="0">Tidak Tampil</option>
                            <option value="1">Tampil</option>
                        </select>
                        <div class="invalid-feedback errorTampil_ondaftar"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-share-square"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close() ?>
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
                    nama_level: $('input#nama_level').val(),
                    // urutan_level: $('input#urutan_level').val(),
                    tampil_ondaftar: $('select#tampil_ondaftar').val(),
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
                        if (response.error.nama_level) {
                            $('#nama_level').addClass('is-invalid');
                            $('.errorNama_level').html(response.error.nama_level);
                        } else {
                            $('#nama_level').removeClass('is-invalid');
                            $('.errorNama_level').html('');
                        }

                        // if (response.error.urutan_level) {
                        //     $('#urutan_level').addClass('is-invalid');
                        //     $('.errorUrutan_level').html(response.error.urutan_level);
                        // } else {
                        //     $('#urutan_level').removeClass('is-invalid');
                        //     $('.errorUrutan_level').html('');
                        // }

                        if (response.error.tampil_ondaftar) {
                            $('#tampil_ondaftar').addClass('is-invalid');
                            $('.errorTampil_ondaftar').html(response.error.tampil_ondaftar);
                        } else {
                            $('#tampil_ondaftar').removeClass('is-invalid');
                            $('.errorTampil_ondaftar').html('');
                        }
                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Berhasil Tambah Level",
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