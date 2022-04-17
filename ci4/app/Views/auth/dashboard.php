<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title">Dashboard</h4>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-right">
        <div id="clock"></div>
    </ol>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<div class="alert alert-secondary alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button> <i class="mdi mdi-account-multiple-outline"></i>
        <strong>Selamat Datang <?= session()->get('nama') ?> </strong> Di Sistem Informasi Al-Haqq.
</div>
<div class="row">

    <!-- Dashboard Peserta -->
    <?php if (session()->get('level') == 4) { ?>
        <?php if ($cek1 != 0) { ?>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-sm-3 col-md-3">
                        <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                            <div class="card-body">
                                <h5 style="text-align:center; color:red">Perhatian!</h5>
                                <i class="mdi mdi-information"></i> Anda telah memilih Kelas.<br>
                                <i class="mdi mdi-information"></i> Batas waktu bayar adalah 1 jam setelah anda memilih kelas, informasi lebih detail silahkan buka menu "Pembayaran Daftar"<br>
                                <i class="mdi mdi-information"></i> Anda harus mengupload bukti transfer dan isi formulir pembayaran agar terdaftar pada kelas yang sudah anda pilih.<br>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <!-- Dashboard Admin -->
    <?php if (session()->get('level') == 2 || session()->get('level') == 3) { ?>
        <div class="col-sm-3 col-md-3">
            <div class="card shadow-lg p-3">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-cash-marker bg-warning  text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Konfirmasi Pembayaran</h5>
                    </div>
                    <h3 class="mt-4"><?= $konfirmasi ?></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-3 col-md-3">
            <div class="card shadow-lg p-3">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-office-building bg-warning text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Jumlah Kantor/Cabng</h5>
                    </div>
                    <h5 class="mt-4"><?= $kantor ?></h5>
                </div>
            </div>
        </div>

        <div class="col-sm-3 col-md-3">
            <div class="card shadow-lg p-3">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-application bg-warning text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Jumlah Program</h5>
                    </div>
                    <h5 class="mt-4"><?= $program ?></h5>
                </div>
            </div>
        </div>

        <div class="col-sm-3 col-md-3">
            <div class="card shadow-lg p-3">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-school bg-warning text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Jumlah Kelas</h5>
                    </div>
                    <h5 class="mt-4"><?= $kelas ?></h5>
                </div>
            </div>
        </div>

        <div class="col-sm-3 col-md-3">
            <div class="card shadow-lg p-3">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-account bg-warning text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Jumlah Pengajar</h5>
                    </div>
                    <h5 class="mt-4"><?= $pengajar ?></h5>
                </div>
            </div>
        </div>

        <div class="col-sm-3 col-md-3">
            <div class="card shadow-lg p-3">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-account-badge bg-warning text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Jumlah Akun Pengajar</h5>
                    </div>
                    <h5 class="mt-4"><?= $akun_pengajar ?></h5>
                </div>
            </div>
        </div>

        <div class="col-sm-3 col-md-3">
            <div class="card shadow-lg p-3">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-account bg-warning text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Jumlah Peserta</h5>
                    </div>
                    <h5 class="mt-4"><?= $peserta ?></h5>
                </div>
            </div>
        </div>

        <div class="col-sm-3 col-md-3">
            <div class="card shadow-lg p-3">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-account-badge bg-warning text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Jumlah Akun Peserta</h5>
                    </div>
                    <h5 class="mt-4"><?= $akun_peserta ?></h5>
                </div>
            </div>
        </div>

    <?php } ?>

</div>

<!-- Dashboard Admin Chart-->
<?php if (session()->get('level') == 2 || session()->get('level') == 3) { ?>
        <div class="card shadow-lg">
            <div class="card-header pb-0">
                <h6 class="card-title mb-2">Rekap Pembayaran SPP Peserta Angkatan Perkuliahan <?= $angkatan ?></h6>
                <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <div id="bar_spp"></div>
                    </div>
                    <div class="col-4">
                        <div id="pie_spp"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <script>
    // Create the chart
    Highcharts.setOptions({
    colors: ['#fcbe2d', '#28a745']
    
    });

    Highcharts.chart('pie_spp', {
    chart: {
    type: 'pie'
    },
    title: {
    text: ''
    },

    accessibility: {
    announceNewData: {
        enabled: true
    },
    point: {
    //   valueSuffix: '%'
    }
    },

    credits: {
    enabled: false
    },

    plotOptions: {
    series: {
        dataLabels: {
        enabled: true,
        format: '{point.name}: {point.y:.0f}'
        }
    }
    },

    tooltip: {
    headerFormat: '<span style="font-size:14px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
    },

    series: [
    {
        name: "SPP Peserta",
        colorByPoint: true,
        data: [
        {
            name: "BELUM LUNAS",
            y: <?= $spp_belum_lunas ?>,
        //   drilldown: "Chrome"
        },
        {
            name: "LUNAS",
            y: <?= $spp_lunas ?>,
        //   drilldown: "Firefox"
        }
        ]
    }
    ]
    })

    //Bar chart
    Highcharts.chart('bar_spp', {
    chart: {
        type: 'bar'
    },
    title: {
        text: ''
    },
    credits: {
    enabled: false
    },
    xAxis: {
        categories: [
        // 'Jan',
        // 'Feb',
        // 'Mar',
        // 'Apr',
        // 'May',
        // 'Jun',
        // 'Jul',
        // 'Aug',
        // 'Sep',
        // 'Oct',
        // 'Nov',
        'Mushafy'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
        text: 'JUMLAH PESERTA'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:14px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        '<td style="padding:0"><b>{point.y:.0f} ORANG</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
        pointPadding: 0.2,
        borderWidth: 0
        },
        bar: {
        dataLabels: {
        enabled: true
        }
        }
    },
    series: [{
        name: 'BELUM LUNAS',
        data: [<?= $spp_belum_lunas ?>]

    }, {
        name: 'LUNAS',
        data: [<?= $spp_lunas ?>]

    }]
    });
    </script>

<?= $this->endSection('isi') ?>