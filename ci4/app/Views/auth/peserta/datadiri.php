<!-- Modal -->
<div class="modal fade" id="modaldatadiri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Nama </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $nama ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">NIS </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $nis ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">NIK </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $nik ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">TTL / Usia </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $tmp_lahir  ?>, <?= shortdate_indo($tgl_lahir)?> / <?= umur($tgl_lahir) ?> Tahun" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Pendidikan </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $pendidikan ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Jurusan </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $jurusan ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Pekerjaan </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $pekerjaan ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">HP </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $hp ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Email </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $email ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Tgl. Daftar </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= shortdate_indo($tgl_gabung) ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Domisili </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $domisili_peserta ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label">Alamat </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $alamat ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>