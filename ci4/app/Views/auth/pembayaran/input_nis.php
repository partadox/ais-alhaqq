<!-- Modal -->
<div class="modal fade" id="modalnis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('pembayaran/simpan_nis', ['class' => 'formnis']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <p class="mt-3">Catatan :<br> 
                    <i class="mdi mdi-information"></i> Format Penomoran NIS = ABCDEWXYZ. <br>
                    <i class="mdi mdi-information"></i> A = [1 DIGIT KODE JENIS KELAMIN] <br>
                    <i class="mdi mdi-information"></i> BC = [2 DIGIT KODE ANGKATAN] <br>
                    <i class="mdi mdi-information"></i> DE = [2 DIGIT KODE TAHUN MASUK] <br>
                    <i class="mdi mdi-information"></i> WXYZ = [NOMOR URUT PESERTA] <br>
                </p>
                <div class="form-group mb-2">
                    <label>Nama Lengkap</label>
                    <input type="hidden" class="form-control" id="peserta_id" name="peserta_id" value="<?= $peserta_id ?>" >
                    <input type="text" class="form-control" value="<?= $nama ?>"disabled>
                </div>
                <div class="form-group mb-2">
                    <label>Jenis Kelamin</label>
                    <input type="text" class="form-control" value="<?= $jenkel ?>"disabled>
                </div>
                <div class="form-group">
                    <label>Tanggal Daftar</label>
                    <input type="text" class="form-control" value="<?= shortdate_indo($tgl_gabung) ?>"disabled>
                </div>
                <hr>
                <div class="form-group mb-2">
                    <label>Angkatan</label>
                    <input type="text" class="form-control" id="angkatan" name="angkatan" placeholder="Masukan Angkatan Peserta">
                    <div class="invalid-feedback errorAngkatan">
                </div>
                <div class="form-group mb-2">
                    <label>NIS</label>
                    <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukan NIS Peserta">
                    <div class="invalid-feedback errorNis">
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
        $('.formnis').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    angkatan: $('input#angkatan').val(),
                    nis: $('input#nis').val(),
                    peserta_id: $('input#peserta_id').val(),
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
                        if (response.error.angkatan) {
                            $('#angkatan').addClass('is-invalid');
                            $('.errorAngkatan').html(response.error.angkatan);
                        } else {
                            $('#angkatan').removeClass('is-invalid');
                            $('.errorAngkatan').html('');
                        }

                        if (response.error.nis) {
                            $('#nis').addClass('is-invalid');
                            $('.errorNis').html(response.error.nis);
                        } else {
                            $('#nis').removeClass('is-invalid');
                            $('.errorNis').html('');
                        }

                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Anda berhasil input NIS dan angkatan peserta.",
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