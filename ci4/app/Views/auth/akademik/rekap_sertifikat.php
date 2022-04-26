<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<div class="row">
    <!-- <div class="col-sm-auto">
        <a href="<?= base_url('#') ?>"> 
            <button type="button" class="btn btn-secondary mb-3"><i class=" fa fa-file-download"></i> Export Excel (Download)</button>
        </a>
    </div> -->
    
</div>

<div class="table-responsive">
    <table id="datatable" class="table table-striped table-bordered nowrap mt-1" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nomor Sertifikat</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Jenis <br> Kelamin</th>
                <th>Level</th>
                <th>Jenis <br> Sertifikat</th>
                <th>Status <br> Cetak</th>
                <th>Nominal Bayar</th>
                <th>Bukti Bayar</th>
                <th>Ketrangan & Link</th>
                <th>Tindakan</th>
            </tr>
        </thead>

        <tbody>
            <?php $nomor = 0;
            foreach ($list as $data) :
                $nomor++; ?>
                <tr>
                    <td width="1%"><?= $nomor ?></td>
                    <td width="5%"><?= $data['nomor_sertifikat'] ?></td>
                    <td width="5%"><?= $data['nis'] ?></td>
                    <td width="10%"><?= $data['nama_peserta'] ?></td>
                    <td width="5%"><?= $data['jenkel'] ?></td>
                    <td width="4%"><?= $data['nama_level'] ?></td>
                    <td width="4%"><?= $data['jenis_sertifikat'] ?></td>
                    <td width="5%">
                        <?php if($data['status_cetak'] == 'Proses') { ?>
                            <button class="btn btn-warning btn-sm" disabled>Proses</button> 
                        <?php } ?>
                        <?php if($data['status_cetak'] == 'Terkonfirmasi') { ?>
                            <button class="btn btn-success btn-sm" disabled>Terkonfirmasi</button> 
                        <?php } ?>
                    </td>
                    <td width="5%"><?= rupiah($data['nominal_bayar_cetak']) ?></td>
                    <td width="15%">
                    <style>
                        .zoom {
                            transition: transform .2s; /* Animation */
                        }

                        .zoom:hover {
                            transform: scale(2.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
                        }
                    </style>
                    <img class="zoom" title="" src="<?= base_url('/img/transfer/' . $data['bukti_bayar_cetak']) ?>" alt="" width="150" align="right" border="1" hspace="" vspace="" />
                    </td>
                    <td width="10%">
                        Link: <a href="<?= $data['link_cetak'] ?>" class="btn btn-info"><i class="fa fa-info"></i></a>
                        Ket: <?= $data['ketrangan cetak_cetak'] ?>
                    </td>
                    <td> 
                        <?php if($data['status_cetak'] == 'Proses') { ?>
                            <button class="btn btn-success"> <i class="fa fa-check"></i> Konfirmasi</button>
                        <?php } ?>
                            <button class="btn btn-warning"> <i class="fa fa-edit"></i> Edit</button> 
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="viewmodalrincian">
</div>

<script>
    $('#periode_cetak').bind('change', function () { // bind change event to select
        var url = $(this).val(); // get selected value
        if (url != '') { // require a URL
            window.location = url; // redirect
        }
        return false;
    });
</script>

<?= $this->endSection('isi') ?>