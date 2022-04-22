<?= form_open('peserta/hapusall', ['class' => 'formhapus']) ?>

<button type="submit" class="btn btn-danger btn">
<i class="fa fa-trash"></i> Hapus yang Diceklist
</button>

<hr>
<div class="table-responsive">
    <table id="listpeserta" class="table table-striped table-bordered nowrap mt-5" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>
                    <input type="checkbox" id="centangSemua">
                </th>
                <th>No.</th>
                <th>Peserta ID</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Asal Cabang</th>
                <th>Jenis <br> Kelamin</th>
                <th>No. HP</th>
                <th>Level</th> 
                <th>Angkatan <br> Bergabung</th>
                <th>Usia</th>
                <th>Status</th>
                <th>Akun</th>
                <th>Tindakan</th>
            </tr>
        </thead>


        <tbody>

        </tbody>
    </table>
    <?= form_close() ?>
</div>

<script>
    function getdata_peserta() {
        var table = $('#listpeserta').DataTable({
            "processing": true,
            "serverside": true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('peserta/getdata_peserta') ?>",
                "type": "POST"
            },
            "columnDefs": [{
                    "targets": 0,
                    "orderable": false,
                },
                {
                    "targets": -1,
                    "orderable": false,
                },
            ],
            buttons: [
                // {
                //     extend: 'excel',
                //     exportOptions: {
                //         columns: ':visible'
                //     }
                // },
                // {
                //     extend: 'print',
                //     orientation: 'landscape',
                //     exportOptions: {
                //         columns: ':visible'
                //     }
                // },
                // {
                //     extend: 'pdf',
                //     orientation: 'landscape',
                //     exportOptions: {
                //         columns: ':visible'
                //     }
                // },
            ],
            columnDefs: [{
                targets: -1,
                visible: false
            }],
            dom: "<'row px-2 px-md-4 pt-2'<'col-md-3'l><'col-md-5 text-center py-2'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row px-2 px-md-4 py-3'<'col-md-5'i><'col-md-7'p>>",
            lengthMenu: [
                [25, 50, 75, 100, -1],
                [25, 50, 75, 100, "All"]
            ],
            columnDefs: [{
                targets: -1,
                orderable: false,
                searchable: false
            }],
        });
        table.buttons().container().appendTo('#dataTable_wrapper .col-md-5:eq(0)');

    }
    $(document).ready(function() {
    getdata_peserta();
    $('#centangSemua').click(function(e) {
            if ($(this).is(':checked')) {
                $('.centangPesertaid').prop('checked', true);
            } else {
                $('.centangPesertaid').prop('checked', false);
            }
        });

        $('.formhapus').submit(function(e) {
            e.preventDefault();
            let jmldata = $('.centangPesertaid:checked');
            if (jmldata.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops!',
                    text: 'Silahkan pilih data!',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                Swal.fire({
                    title: 'Hapus data',
                    text: `Apakah anda yakin ingin menghapus sebanyak ${jmldata.length} data?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: $(this).attr('action'),
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Data berhasil dihapus!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                window.location = response.sukses.link;
                        });
                            }
                        });
                    }
                })
            }
        });
    });

    function datadiri(peserta_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('peserta/datadiri') ?>",
            data: {
                peserta_id: peserta_id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaldatadiri').html(response.sukses).show();
                    $('#modaldatadiri').modal('show');
                }
            }
        });
    }

    function edit(peserta_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('peserta/edit_peserta') ?>",
            data: {
                peserta_id: peserta_id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaldataedit').html(response.sukses).show();
                    $('#modaledit').modal('show');
                }
            }
        });
    }

    function hapus(peserta_id) {
        Swal.fire({
            title: 'Yakin Hapus Data Peserta ini?',
            text: `Data Peserta dalam Kelas & Riwayat Pembayaran Terkait Data Peserta ini Akan Hilang Juga.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('peserta/hapus_peserta') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        peserta_id : peserta_id
                    },
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Anda berhasil menghapus data peserta ini!",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location = response.sukses.link;
                        });
                        }
                    }
                });
            }
        })
    }
</script>