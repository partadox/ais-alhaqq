<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<div class="card shadow-lg">
  <div class="card-header pb-0">
    <h6 class="card-title mb-2">Pembayaran SPP</h6>
    <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
  </div>
  <div class="card-body">
    <p class="mt-1">Catatan :<br>
        <i class="mdi mdi-information"></i> Pilih kelas anda kemudian lakukan pembayaran SPP untuk kelas tersebut. <br>
    </p>
    <div class="form-group row">
        <label for="" class="col-sm-1 col-form-label">Pilih Kelas Anda<code>*</code></label>
        <div class="col-sm-4">
          <select name="data_kelas_id" id="data_kelas_id" class="form-control">
                  <option Disabled=true Selected=true> --PILIH-- </option>
              <?php foreach ($kelas as $key => $data) { ?>
                  <option value="<?= $data['data_kelas_id'] ?>"><?= $data['nama_program'] ?> | <?= $data['nama_kelas'] ?></option>
              <?php } ?>
          </select>
        </div>
        <div class="col-sm-4">
          <button type="button" class="btn btn-success" onclick="edit_password('<?= session()->get('user_id') ?>')" ><i class=" fa fa-money-bill mr-1"></i> Pembayaran SPP</button>
        </div>
    </div>
  </div>
</div>

<div class="card shadow-lg">
  <div class="card-body">
    <div class="container-fluid">
          <div class="row">
            <div class="col">
                <div class="card-header pb-0">
                  <h6 class="card-title mb-2">Riwayat Pembayaran</h6>
                  <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                </div>
                <div class="card-body">
                <?= form_open('akun/biodata_peserta_update', ['class' => 'formtambah']) ?>
                <?= csrf_field() ?>
                   
                <?= form_close() ?>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<div class="viewmodaleditusername">
</div>

<div class="viewmodaleditpassword">
</div>

<script>
</script>
<?= $this->endSection('isi') ?>