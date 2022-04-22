<?= form_open('akun/hapusall_peserta', ['class' => 'formhapus']) ?>

<button type="submit" class="btn btn-danger btn">
<i class="fa fa-trash"></i> Hapus yang Diceklist
</button>
<hr>

<div class="table-responsive">
    <table id="list_userpeserta" class="table table-striped table-bordered nowrap mt-5" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>
                    <input type="checkbox" id="centangSemua">
                </th>
                <th>No.</th>
                <th>User Id</th>
                <th>Nama</th>
                <th>Username</th> 
                <th>Status Aktif</th>
                <th>Tindakan</th>
            </tr>
        </thead>


        <tbody>

        </tbody>
    </table>
    <?= form_close() ?>
</div>

<script>
    function getdata_userpeserta() {
        var table = $('#list_userpeserta').DataTable({
            "processing": true,
            "serverside": true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('akun/getdata_userpeserta') ?>",
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
        getdata_userpeserta();
        $('#centangSemua').click(function(e) {
            if ($(this).is(':checked')) {
                $('.centangUserid').prop('checked', true);
            } else {
                $('.centangUserid').prop('checked', false);
            }
        });

        $('.formhapus').submit(function(e) {
            e.preventDefault();
            let jmldata = $('.centangUserid:checked');
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

    function edit(user_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('akun/edit_user_peserta') ?>",
            data: {
                user_id : user_id
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

    function edit_username(user_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('akun/edit_user_username_peserta') ?>",
            data: {
                user_id : user_id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaldataeditusername').html(response.sukses).show();
                    $('#modaleditusername').modal('show');
                }
            }
        });
    }

    function hapus(user_id) {
        Swal.fire({
            title: 'Yakin Hapus Data Akun User ini?',
            text: `Data Akun User Akan Dihapus.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('akun/hapus_user_peserta') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        user_id : user_id
                    },
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Anda berhasil menghapus data akun user peserta!",
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