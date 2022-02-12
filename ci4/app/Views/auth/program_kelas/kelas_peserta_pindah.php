<!-- Modal -->
<div class="modal fade" id="modalpindah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('program/pindah_kelas_simpan', ['class' => 'formedit']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="peserta_kelas_id" value="<?= $peserta_kelas_id ?>" name="peserta_kelas_id" 
                readonly>
                <h6 style="text-align:center;">Nama: <?= $nama_peserta ?></h6>
                <h6 style="text-align:center;">NIS: <?= $nis ?></h6>
                <h6 style="text-align:center;">Domisili: </h6>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Pindah ke Kelas <code>*</code></label>
                    <div class="col-sm-8">
                        <select name="data_kelas_id" id="data_kelas_id" class="js-example-basic-single-pindah">
                                <option Disabled=true Selected=true> </option>
                            <?php foreach ($kelas as $key => $data) { ?>
                                <option value="<?= $data['kelas_id'] ?>"  <?php if ($data['kelas_id'] == $data_kelas_id) echo "selected"; ?>><?= $data['nama_kelas'] ?> | <?= $data['nama_pengajar'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorData_kelas_id"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-share-square"></i> Pindah</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single-pindah').select2({
            theme: "bootstrap4"
        });
        $('.formedit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
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
                        if (response.error.data_kelas_id) {
                            $('#data_kelas_id').addClass('is-invalid');
                            $('.errorData_kelas_id').html(response.error.data_kelas_id);
                        } else {
                            $('#data_kelas_id').removeClass('is-invalid');
                            $('.errorData_kelas_id').html('');
                        }

                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Berhasil Memindahkan Kelas Peserta",
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