<!-- Modal -->
<div class="modal fade" id="modallistpeserta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('program/update_kelas_peserta', ['class' => 'formedit']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered nowrap mt-1" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $nomor = 0;
                            foreach ($peserta_onkelas as $data) :
                                $nomor++; ?>
                                <tr>
                                    <td width="5%"><?= $nomor ?></td>
                                    <td width="15%"><?= $data['nama_peserta'] ?></td>
                                    <td width="10%"><?= $data['nis'] ?></td>
                                    <td width="10%">
                                        <?php if($data['status_peserta_kelas'] == 'Belum Lulus') { ?>
                                            <button class="btn btn-secondary btn-sm" disabled>Belum Lulus</button> 
                                        <?php } ?>
                                        <?php if($data['status_peserta_kelas'] == 'Lulus') { ?>
                                            <button class="btn btn-success btn-sm" disabled>Lulus</button> 
                                        <?php } ?>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single-edit').select2({
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
                        if (response.error.program_id) {
                            $('#program_id').addClass('is-invalid');
                            $('.errorProgram').html(response.error.program_id);
                        } else {
                            $('#program_id').removeClass('is-invalid');
                            $('.errorProgram').html('');
                        }

                        if (response.error.nama_kelas) {
                            $('#nama_kelas').addClass('is-invalid');
                            $('.errorNamakelas').html(response.error.nama_kelas);
                        } else {
                            $('#nama_kelas').removeClass('is-invalid');
                            $('.errorNamakelas').html('');
                        }

                        if (response.error.pengajar_id) {
                            $('#pengajar_id').addClass('is-invalid');
                            $('.errorPengajar').html(response.error.pengajar_id);
                        } else {
                            $('#pengajar_id').removeClass('is-invalid');
                            $('.errorPengajar').html('');
                        }

                        if (response.error.hari_kelas) {
                            $('#hari_kelas').addClass('is-invalid');
                            $('.errorHarikelas').html(response.error.hari_kelas);
                        } else {
                            $('#hari_kelas').removeClass('is-invalid');
                            $('.errorHarikelas').html('');
                        }

                        if (response.error.waktu_kelas) {
                            $('#waktu_kelas').addClass('is-invalid');
                            $('.errorWaktukelas').html(response.error.waktu_kelas);
                        } else {
                            $('#waktu_kelas').removeClass('is-invalid');
                            $('.errorWaktukelas').html('');
                        }

                        if (response.error.peserta_level) {
                            $('#peserta_level').addClass('is-invalid');
                            $('.errorPesertalevel').html(response.error.peserta_level);
                        } else {
                            $('#peserta_level').removeClass('is-invalid');
                            $('.errorPesertalevel').html('');
                        }

                        if (response.error.jenkel) {
                            $('#jenkel').addClass('is-invalid');
                            $('.errorJenkel').html(response.error.jenkel);
                        } else {
                            $('#jenkel').removeClass('is-invalid');
                            $('.errorJenkel').html('');
                        }

                        if (response.error.status_kerja) {
                            $('#status_kerja').addClass('is-invalid');
                            $('.errorStatuskerja').html(response.error.status_kerja);
                        } else {
                            $('#status_kerja').removeClass('is-invalid');
                            $('.errorStatuskerja').html('');
                        }

                        if (response.error.kouta) {
                            $('#kouta').addClass('is-invalid');
                            $('.errorKouta').html(response.error.kouta);
                        } else {
                            $('#kouta').removeClass('is-invalid');
                            $('.errorKouta').html('');
                        }

                        if (response.error.metode_kelas) {
                            $('#metode_kelas').addClass('is-invalid');
                            $('.errorMetodekelas').html(response.error.metode_kelas);
                        } else {
                            $('#metode_kelas').removeClass('is-invalid');
                            $('.errorMetodekelas').html('');
                        }

                        if (response.error.status_kelas) {
                            $('#status_kelas').addClass('is-invalid');
                            $('.errorStatuskelas').html(response.error.status_kelas);
                        } else {
                            $('#status_kelas').removeClass('is-invalid');
                            $('.errorStatuskelas').html('');
                        }

                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Berhasil Edit Data Kelas",
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