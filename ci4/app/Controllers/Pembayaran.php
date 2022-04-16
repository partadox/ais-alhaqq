<?php

namespace App\Controllers;

use Config\Services;

class Pembayaran extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Al-Haqq - Seluruh Data Pembayaran',
            'list'  => $this->program_bayar->list_without_kelas(),
        ];
        return view('auth/pembayaran/index', $data);
    }

    public function index_bayar_infaq()
    {
        $data = [
            'title'  => 'Al-Haqq - Rekap Data Pembayaran Infaq',
            'infaq'  => $this->infaq->list(),
        ];
        return view('auth/pembayaran/index_bayar_infaq', $data);
    }

    public function index_bayar_lain()
    {
        $data = [
            'title'  => 'Al-Haqq - Rekap Data Pembayaran Lain',
            'lain'   => $this->bayar_lain->list(),
        ];
        return view('auth/pembayaran/index_bayar_lain', $data);
    }

    // Halaman List Data Konfirmasi Pembayaran
    public function konfirmasi()
    {
        //$datetime = date("Y-m-d H:i:s");
        //var_dump($datetime);
        $program_bayar = $this->program_bayar->bayar_konfirmasi();

        // $jenis = array_map(function($value) {
        //     return explode(', ', $value['jenis_bayar']);
        // }, $get_jenis);

        $data = [
            'title'    => 'Al-Haqq - Konfirmasi Pembayaran',
            'list'     => $program_bayar,
        ];
        //var_dump($result);
        return view('auth/pembayaran/konfirmasi', $data);
    }

    public function input_nis()
    {
        if ($this->request->isAJAX()) {
            $peserta_id = $this->request->getVar('peserta_id');
            $peserta =  $this->peserta->find($peserta_id);
            $data = [
                'title'         => 'Buat NIS Peserta Baru',
                'peserta_id'    => $peserta_id,
                'nama'          => $peserta['nama_peserta'],
                'jenkel'        => $peserta['jenkel'],
                'tgl_gabung'    => $peserta['tgl_gabung'],
            ];
            $msg = [
                'sukses' => view('auth/pembayaran/input_nis', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_nis()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'angkatan' => [
                    'label' => 'angkatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nis' => [
                    'label' => 'nis',
                    'rules' => 'required|is_unique[peserta.nis]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} harus unik, sudah ada yang menggunakan {field} ini',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'angkatan'      => $validation->getError('angkatan'),
                        'nis'           => $validation->getError('nis'),
                    ]
                ];
            } else {
                $simpandata = [
                    'angkatan'   => $this->request->getVar('angkatan'),
                    'nis'        => $this->request->getVar('nis'),
                ];
                
                $peserta_id = $this->request->getVar('peserta_id');
                $this->peserta->update($peserta_id, $simpandata);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Buat NIS Peserta ' . $this->request->getVar('nis'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'konfirmasi'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function input_konfirmasi()
    {
        if ($this->request->isAJAX()) {
            $bayar_id = $this->request->getVar('bayar_id');
            $pembayaran =  $this->program_bayar->find($bayar_id);

            //Get data Kelas id from tabel program bayar
            $get_kelas_id = $this->program_bayar->get_kelas_id($bayar_id);
            $kelas_id = $get_kelas_id->kelas_id;

            $data = [
                'title'               => 'Konfirmasi & Input Nominal Bayar',
                'bayar_id'            => $bayar_id,
                'kelas_id'            => $kelas_id,
                'bayar_peserta_id'    => $pembayaran['bayar_peserta_id'],
                'bukti_bayar'         => $pembayaran['bukti_bayar'],
                'awal_bayar'          => $pembayaran['awal_bayar'],
                'awal_bayar_daftar'   => $pembayaran['awal_bayar_daftar'],
                'awal_bayar_infaq'    => $pembayaran['awal_bayar_infaq'],
                'awal_bayar_spp1'     => $pembayaran['awal_bayar_spp1'],
                'awal_bayar_spp2'     => $pembayaran['awal_bayar_spp2'],
                'awal_bayar_spp3'     => $pembayaran['awal_bayar_spp3'],
                'awal_bayar_spp4'     => $pembayaran['awal_bayar_spp4'],
                'awal_bayar_modul'    => $pembayaran['awal_bayar_modul'],
                'awal_bayar_lainnya'  => $pembayaran['awal_bayar_lainnya'],
                'keterangan_bayar'    => $pembayaran['keterangan_bayar'],
            ];
            $msg = [
                'sukses' => view('auth/pembayaran/input_konfirmasi', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_konfirmasi()
    {
        if ($this->request->isAJAX()) {

            $tgl        = date("Y-m-d");
            $waktu      = date("H:i:s");
            $validator  = session()->get('username');

            $bayar_id   = $this->request->getVar('bayar_id');
            $kelas_id   = $this->request->getVar('kelas_id');
            $peserta_id = $this->request->getVar('peserta_id');

            //Get peserta_kelas_id
            $get_peserta_kelas_id   = $this->peserta_kelas->get_peserta_kelas_id($peserta_id, $kelas_id);
            $peserta_kelas_id       = $get_peserta_kelas_id->peserta_kelas_id;

            //Data Peserta
            $data_peserta       = $this->peserta->find($peserta_id);
            $log_nama_peserta   = $data_peserta['nama_peserta'];
            $log_nis_peserta    = $data_peserta['nis'];

            //Get data total bayar
            $get_program_id    = $this->program->get_program_id($kelas_id);
            $program_id        = $get_program_id->program_id;
            $get_biaya_bulanan = $this->program_data->get_biaya_bulanan($program_id);
            $biaya_bulanan     = $get_biaya_bulanan->biaya_bulanan;
            $get_biaya_program = $this->program_data->get_biaya_program($program_id);
            $biaya_program     = $get_biaya_program->biaya_program;
            $get_biaya_daftar  = $this->program_data->get_biaya_daftar($program_id);
            $biaya_daftar      = $get_biaya_daftar->biaya_daftar;
            $get_biaya_modul   = $this->program_data->get_biaya_modul($program_id);
            $biaya_modul       = $get_biaya_modul->biaya_modul;
            $total_lunas       = $biaya_program + $biaya_daftar + $biaya_modul;

            // //Get data sisa kouta dari tabel program_kelas
            // $get_sisa_kouta = $this->program->get_sisa_kouta($kelas_id);
            // $sisa_kouta = $get_sisa_kouta->sisa_kouta;

            // //Pengurangan Kouta
            // $minus1 = 1;
            // $kouta_kurang = $sisa_kouta - $minus1;

            // //Get data jumlah peserta dari tabel program_kelas
            // $get_jml_peserta = $this->program->get_jumlah_peserta($kelas_id);
            // $jumlah_peserta = $get_jml_peserta ->jumlah_peserta;

            // //Pengurangan Kouta
            // $plus1 = 1;
            // $tambah_peserta = $jumlah_peserta + $plus1;

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nominal_bayar' => [
                    'label' => 'nominal_bayar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'bayar_daftar' => [
                    'label' => 'bayar_daftar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'bayar_spp1' => [
                    'label' => 'bayar_spp1',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'bayar_spp2' => [
                    'label' => 'bayar_spp2',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'bayar_spp3' => [
                    'label' => 'bayar_spp3',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'bayar_spp4' => [
                    'label' => 'bayar_spp4',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'bayar_infaq' => [
                    'label' => 'bayar_infaq',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'bayar_modul' => [
                    'label' => 'bayar_modul',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'bayar_lain' => [
                    'label' => 'bayar_lain',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'status_bayar_admin' => [
                    'label' => 'status_bayar_admin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nominal_bayar'         => $validation->getError('nominal_bayar'),
                        'bayar_daftar'          => $validation->getError('bayar_daftar'),
                        'bayar_spp1'            => $validation->getError('bayar_spp1'),
                        'bayar_spp2'            => $validation->getError('bayar_spp2'),
                        'bayar_spp3'            => $validation->getError('bayar_spp3'),
                        'bayar_spp4'            => $validation->getError('bayar_spp4'),
                        'bayar_infaq'           => $validation->getError('bayar_infaq'),
                        'bayar_modul'           => $validation->getError('bayar_modul'),
                        'bayar_lain'            => $validation->getError('bayar_lain'),
                        'status_bayar_admin'    => $validation->getError('status_bayar_admin'),
                    ]
                ];
            } else {

                //Get var
                $status_bayar_admin = $this->request->getVar('status_bayar_admin');
                $keterangan_admin   = strtoupper($this->request->getVar('keterangan_bayar_admin'));

                //Get nominal (on rupiah curenncy format) input from view
                $get_nominal_bayar = $this->request->getVar('nominal_bayar');
                $get_bayar_daftar  = $this->request->getVar('bayar_daftar');
                $get_bayar_spp1    = $this->request->getVar('bayar_spp1');
                $get_bayar_spp2    = $this->request->getVar('bayar_spp2');
                $get_bayar_spp3    = $this->request->getVar('bayar_spp3');
                $get_bayar_spp4    = $this->request->getVar('bayar_spp4');
                $get_bayar_infaq   = $this->request->getVar('bayar_infaq');
                $get_bayar_modul   = $this->request->getVar('bayar_modul');
                $get_bayar_lain    = $this->request->getVar('bayar_lain');

                //Replace Rp. and thousand separtor from input
                $nominal_bayar_int   = str_replace(str_split('Rp. .'), '', $get_nominal_bayar);
                $bayar_daftar_int    = str_replace(str_split('Rp. .'), '', $get_bayar_daftar);
                $bayar_spp1_int      = str_replace(str_split('Rp. .'), '', $get_bayar_spp1);
                $bayar_spp2_int      = str_replace(str_split('Rp. .'), '', $get_bayar_spp2);
                $bayar_spp3_int      = str_replace(str_split('Rp. .'), '', $get_bayar_spp3);
                $bayar_spp4_int      = str_replace(str_split('Rp. .'), '', $get_bayar_spp4);
                $bayar_infaq_int     = str_replace(str_split('Rp. .'), '', $get_bayar_infaq);
                $bayar_modul_int     = str_replace(str_split('Rp. .'), '', $get_bayar_modul);
                $bayar_lain_int      = str_replace(str_split('Rp. .'), '', $get_bayar_lain);

                //Get Data from Input view
                $nominal_bayar      = $nominal_bayar_int;
                $bayar_daftar       = $bayar_daftar_int;
                $bayar_spp1         = $bayar_spp1_int;
                $bayar_spp2         = $bayar_spp2_int;
                $bayar_spp3         = $bayar_spp3_int;
                $bayar_spp4         = $bayar_spp4_int;
                $bayar_infaq        = $bayar_infaq_int;
                $bayar_modul        = $bayar_modul_int;
                $bayar_lain         = $bayar_lain_int;

                $databayar = [
                    'status_bayar'              => 'Lunas',
                    'status_konfirmasi'         => 'Terkonfirmasi',
                    'status_bayar_admin'        => $status_bayar_admin,
                    'keterangan_bayar_admin'    => $keterangan_admin,
                    'nominal_bayar'             => $nominal_bayar,
                    'tgl_bayar_konfirmasi'      => $tgl,
                    'waktu_bayar_konfirmasi'    => $waktu,
                    'validator'                 => $validator,
                ];
                //Simpan update program_bayar 
                $this->program_bayar->update($bayar_id, $databayar);
                
                //Cek isian form untuk daftar dan spp1
                if($bayar_daftar != 0 && $bayar_spp1 != 0 && $bayar_modul == $biaya_modul){
                    $data_spp1 = [
                        'spp1_bayar_id' => $bayar_id,
                        'bayar_daftar'  => $bayar_daftar,
                        'bayar_spp1'    => $bayar_spp1,
                        'status_spp1'   => 'Lunas',
                    ];

                    $data_modul = [
                        'bayar_modul_id'        => $bayar_id,
                        'bayar_modul'           => $bayar_modul,
                        'status_bayar_modul'    => 'Lunas',
                    ];

                    // $datakelas = [
                    //     'sisa_kouta'      => $kouta_kurang,
                    //     'jumlah_peserta'  => $tambah_peserta,
                    // ];

                    //Create Absen Peserta di Kelas
                    $dataabsen = [
                        'tm1'   => NULL,
                    ];
                    $this->absen_peserta->insert($dataabsen);

                    // Get last id insert from absen peserta
                    $last_id = $this->absen_peserta->insertID();

                    $sppdaftar = $biaya_bulanan + $biaya_daftar + $biaya_modul;
                    $piutang1  = $total_lunas - $sppdaftar;

                    if($bayar_modul == 0){
                        $byr_modul_value = '0';
                    } else {
                        $byr_modul_value = $bayar_modul;
                    }
        
                    $datapesertakelas = [
                        // 'data_peserta_id'       => $peserta_id,
                        // 'data_kelas_id'         => $kelas_id,
                        'data_absen'            => $last_id,
                        'status_peserta_kelas'  => 'Belum Lulus',
                        'byr_daftar'            => $bayar_daftar,
                        'byr_spp1'              => $bayar_spp1,
                        'byr_modul'             => $byr_modul_value,
                        'spp_terbayar'          => $sppdaftar,
                        'spp_piutang'           => $piutang1,
                        'spp_status'            => 'BELUM LUNAS',
                    ];

                    $this->spp1->insert($data_spp1);
                    $this->bayar_modul->insert($data_modul);
                    // $this->program->update($kelas_id, $datakelas);
                    $this->peserta_kelas->update($peserta_kelas_id, $datapesertakelas);

                    // Get last id insert from peserta kelas
                    //$last_id_psrt_kls = $this->peserta_kelas->insertID();

                    //Cek isian form untuk infaq
                    if($bayar_infaq != 0){
                        $data_infaq = [
                            'infaq_bayar_id'        => $bayar_id,
                            'bayar_infaq'           => $bayar_infaq,
                            'data_peserta_id_infaq' => $peserta_id,
                        ];
                        $this->infaq->insert($data_infaq);
                    }

                    //Cek isian form untuk spp2
                    if($bayar_spp2 != 0){
                        $data_spp2 = [
                            'spp2_bayar_id' => $bayar_id,
                            'bayar_spp2'    => $bayar_spp2,
                            'status_spp2'   => 'Lunas',
                        ];
                        $this->spp2->insert($data_spp2);

                        // Update status bayar pada tabel peserta kelas
                        $spp2daftar = (2*$biaya_bulanan) + $biaya_daftar + $biaya_modul;
                        $piutang2   = $total_lunas - $spp2daftar;
                        $data_update_spp2 = [
                            'byr_spp2'      => $bayar_spp2,
                            'spp_terbayar'  => $spp2daftar,
                            'spp_piutang'   => $piutang2,
                            'spp_status'    => 'BELUM LUNAS',
                        ];
                        $this->peserta_kelas->update($peserta_kelas_id, $data_update_spp2);
                    }

                    //Cek isian form untuk spp3
                    if($bayar_spp3 != 0){
                        $data_spp3 = [
                            'spp3_bayar_id'    => $bayar_id,
                            'bayar_spp3'       => $bayar_spp3,
                            'status_spp3'      => 'Lunas',
                        ];
                        $this->spp3->insert($data_spp3);

                        // Update status bayar pada tabel peserta kelas
                        $spp3daftar = (3*$biaya_bulanan) + $biaya_daftar + $biaya_modul;
                        $piutang3   = $total_lunas - $spp3daftar;
                        $data_update_spp3 = [
                            'byr_spp3'      => $bayar_spp3,
                            'spp_terbayar'  => $spp3daftar,
                            'spp_piutang'   => $piutang3,
                            'spp_status'    => 'BELUM LUNAS',
                        ];
                        $this->peserta_kelas->update($peserta_kelas_id, $data_update_spp3);
                    }

                    //Cek isian form untuk spp4
                    if($bayar_spp4 != 0){
                        $data_spp4 = [
                            'spp4_bayar_id'    => $bayar_id,
                            'bayar_spp4'       => $bayar_spp4,
                            'status_spp4'      => 'Lunas',
                        ];
                        $this->spp4->insert($data_spp4);

                        // Update status bayar pada tabel peserta kelas
                        $spp4daftar = (4*$biaya_bulanan) + $biaya_daftar + $biaya_modul;
                        $piutang4   = $total_lunas - $spp4daftar;
                        $data_update_spp4 = [
                            'byr_spp4'      => $bayar_spp4,
                            'spp_terbayar'  => $spp4daftar,
                            'spp_piutang'   => $piutang4,
                            'spp_status'    => 'LUNAS',
                        ];
                        $this->peserta_kelas->update($peserta_kelas_id, $data_update_spp4);
                    }

                    //Cek isian form untuk lain
                    if($bayar_lain != 0){
                        $data_lain = [
                            'lainnya_bayar_id'        => $bayar_id,
                            'bayar_lainnya'           => $bayar_lain,
                            'data_peserta_id_lain'    => $peserta_id,
                            'status_bayar_lainnya'    => 'Lunas',
                        ];
                        $this->bayar_lain->insert($data_lain);
                    }

                } elseif ($bayar_daftar == 0 && $bayar_spp1 == 0) {
                    // Get id from peserta kelas
                    // $get_id_psrt_kelas = $this->peserta_kelas->get_peserta_kelas_id($peserta_id, $kelas_id);
                    // $id_psrt_kls = $get_id_psrt_kelas->peserta_kelas_id;

                    //Cek isian form untuk infaq
                    if($bayar_infaq != 0){
                        $data_infaq = [
                            'infaq_bayar_id'=> $bayar_id,
                            'bayar_infaq'   => $bayar_infaq,
                        ];
                        $this->infaq->insert($data_infaq);
                    }

                    //Cek isian form untuk spp2
                    if($bayar_spp2 != 0){
                        $data_spp2 = [
                            'spp2_bayar_id' => $bayar_id,
                            'bayar_spp2'    => $bayar_spp2,
                            'status_spp2'   => 'Lunas',
                        ];
                        $this->spp2->insert($data_spp2);

                        // Update status bayar pada tabel peserta kelas
                        $spp2daftar = (2*$biaya_bulanan) + $biaya_daftar + $biaya_modul;
                        $piutang2   = $total_lunas - $spp2daftar;
                        $data_update_spp2 = [
                            'byr_spp2'      => $bayar_spp2,
                            'spp_terbayar'  => $spp2daftar,
                            'spp_piutang'   => $piutang2,
                            'spp_status'    => 'BELUM LUNAS',
                        ];
                        $this->peserta_kelas->update($peserta_kelas_id, $data_update_spp2);
                    }

                    //Cek isian form untuk spp3
                    if($bayar_spp3 != 0){
                        $data_spp3 = [
                            'spp3_bayar_id'    => $bayar_id,
                            'bayar_spp3'       => $bayar_spp3,
                            'status_spp3'      => 'Lunas',
                        ];
                        $this->spp3->insert($data_spp3);

                        // Update status bayar pada tabel peserta kelas
                        $spp3daftar = (3*$biaya_bulanan) + $biaya_daftar + $biaya_modul;
                        $piutang3   = $total_lunas - $spp3daftar;
                        $data_update_spp3 = [
                            'byr_spp3'      => $bayar_spp3,
                            'spp_terbayar'  => $spp3daftar,
                            'spp_piutang'   => $piutang3,
                            'spp_status'    => 'BELUM LUNAS',
                        ];
                        $this->peserta_kelas->update($peserta_kelas_id, $data_update_spp3);
                    }

                    //Cek isian form untuk spp4
                    if($bayar_spp4 != 0){
                        $data_spp4 = [
                            'spp4_bayar_id'    => $bayar_id,
                            'bayar_spp4'       => $bayar_spp4,
                            'status_spp4'      => 'Lunas',
                        ];
                        $this->spp4->insert($data_spp4);

                        // Update status bayar pada tabel peserta kelas
                        $spp4daftar = (4*$biaya_bulanan) + $biaya_daftar + $biaya_modul;
                        $piutang4   = $total_lunas - $spp4daftar;
                        $data_update_spp4 = [
                            'byr_spp4'      => $bayar_spp4,
                            'spp_terbayar'  => $spp4daftar,
                            'spp_piutang'   => $piutang4,
                            'spp_status'    => 'LUNAS',
                        ];
                        $this->peserta_kelas->update($peserta_kelas_id, $data_update_spp4);
                    }

                    //Cek isian form untuk lain
                    if($bayar_lain != 0){
                        $data_lain = [
                            'lainnya_bayar_id'        => $bayar_id,
                            'bayar_lainnya'           => $bayar_lain,
                            'status_bayar_lainnya'    => 'Lunas',
                        ];
                        $this->bayar_lain->insert($data_lain);
                    }
                }

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Konfirmasi Transaksi ID ' . $bayar_id . ' - ' . $log_nis_peserta . ' ' . $log_nama_peserta,
                ];
                $this->log->insert($log);
                // Data Log END
    
                $msg = [
                    'sukses' => [
                        'link' => 'konfirmasi'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function input_bayar()
    {
        if ($this->request->isAJAX()) {

            $kelas_ada          = $this->program-> list_ada_kouta();

            $data = [
                'title'     => 'Form Input pembayaran Baru',
                'peserta'   => $this->peserta->list(),
                'kelas'     => $kelas_ada
            ];
            $msg = [
                'sukses' => view('auth/pembayaran/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_bayar()
    {
            $validation = \Config\Services::validation();

            //Get Nama User
            $user_nama = session()->get('nama');
            //Get Tgl Today
            $tgl = date("Y-m-d");
            $waktu = date("H:i:s");
            $strwaktu = date("H-i-s");

            $valid = $this->validate([
                'bayar_peserta_id' => [
                    'label' => 'bayar_peserta_id',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'kelas_id' => [
                    'label' => 'kelas_id',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'awal_bayar' => [
                    'label' => 'awal_bayar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'awal_bayar_infaq' => [
                    'label' => 'awal_bayar_infaq',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'awal_bayar_daftar' => [
                    'label' => 'awal_bayar_daftar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'awal_bayar_spp1' => [
                    'label' => 'awal_bayar_spp1',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'awal_bayar_spp2' => [
                    'label' => 'awal_bayar_spp2',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'awal_bayar_spp3' => [
                    'label' => 'awal_bayar_spp3',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'awal_bayar_spp4' => [
                    'label' => 'awal_bayar_spp4',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'foto' => [
                    'rules' => 'uploaded[foto]|mime_in[foto,image/png,image/jpg,image/jpeg]|is_image[foto]',
                    'errors' => [
                        'mime_in' => 'Harus gambar!'
                    ]
                ]
            ]);

            if (!$valid) {
                $this->session->setFlashdata('pesan_error', 'ERROR! Seluruh Form Input Bertanda * Wajib Diisi dan Harap Upload Bukti Bayar!');
                return redirect()->to('index');
            } else {

                // get file foto from input
                $filefoto = $this->request->getFile('foto');
                // ambil nama file
                $namafoto = $filefoto->getName();
                // nama foto baru
                $namafoto_new = $user_nama . '_'. $tgl . '_' . $strwaktu .'_'. $namafoto;

                //Get from form input view modal
                $get_awal_bayar         =  $this->request->getVar('awal_bayar');
                $get_awal_bayar_infaq   =  $this->request->getVar('awal_bayar_infaq');
                $get_awal_bayar_daftar  =  $this->request->getVar('awal_bayar_daftar');
                $get_awal_bayar_spp1    =  $this->request->getVar('awal_bayar_spp1');
                $get_awal_bayar_spp2    =  $this->request->getVar('awal_bayar_spp2');
                $get_awal_bayar_spp3    =  $this->request->getVar('awal_bayar_spp3');
                $get_awal_bayar_spp4    =  $this->request->getVar('awal_bayar_spp4');

                //Replace Rp. and thousand separtor from input
                $awal_bayar_int           = str_replace(str_split('Rp. .'), '', $get_awal_bayar);
                $awal_bayar_daftar_int    = str_replace(str_split('Rp. .'), '', $get_awal_bayar_daftar);
                $awal_bayar_spp1_int      = str_replace(str_split('Rp. .'), '', $get_awal_bayar_spp1);
                $awal_bayar_infaq_int     = str_replace(str_split('Rp. .'), '', $get_awal_bayar_infaq);
                $awal_bayar_spp2_int      = str_replace(str_split('Rp. .'), '', $get_awal_bayar_spp2);
                $awal_bayar_spp3_int      = str_replace(str_split('Rp. .'), '', $get_awal_bayar_spp3);
                $awal_bayar_spp4_int      = str_replace(str_split('Rp. .'), '', $get_awal_bayar_spp4);

                //Get Data from Input view
                $kelas_id               =  $this->request->getVar('kelas_id');
                $bayar_peserta_id       =  $this->request->getVar('bayar_peserta_id');
                $keterangan_bayar       =  $this->request->getVar('keterangan_bayar');
                $awal_bayar              = $awal_bayar_int;
                $awal_bayar_daftar       = $awal_bayar_daftar_int;
                $awal_bayar_spp1         = $awal_bayar_spp1_int;
                $awal_bayar_infaq        = $awal_bayar_infaq_int;
                $awal_bayar_spp2         = $awal_bayar_spp2_int;
                $awal_bayar_spp3         = $awal_bayar_spp3_int;
                $awal_bayar_spp4         = $awal_bayar_spp4_int;

                $data_bayar = [
                    'bayar_peserta_id'          => $bayar_peserta_id,
                    'kelas_id'                  => $kelas_id,
                    'awal_bayar'                => $awal_bayar,
                    'awal_bayar_daftar'         => $awal_bayar_daftar,
                    'awal_bayar_infaq'          => $awal_bayar_infaq,
                    'awal_bayar_spp1'           => $awal_bayar_spp1,
                    'awal_bayar_spp2'           => $awal_bayar_spp2,
                    'awal_bayar_spp3'           => $awal_bayar_spp3,
                    'awal_bayar_spp4'           => $awal_bayar_spp4,
                    'status_bayar'              => 'Belum Lunas',
                    'status_konfirmasi'         => 'Proses',
                    'bukti_bayar'               => $namafoto_new,
                    'tgl_bayar'                 => $tgl,
                    'waktu_bayar'               => $waktu,
                    'keterangan_bayar'          => $keterangan_bayar ,
                    'tgl_bayar_konfirmasi'      => '1000-01-01',
                    'waktu_bayar_konfirmasi'    => '00:00:00',
                ];
                
                // insert status konfirmasi
                $this->program_bayar->insert($data_bayar);

                $filefoto->move('img/transfer/', $namafoto_new);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Buat Data Pembayaran Baru Peserta ID : ' . $bayar_peserta_id,
                ];
                $this->log->insert($log);
                // Data Log END
                
                $this->session->setFlashdata('pesan_sukses', 'Data Pembayaran Baru Berhasil Ditambahkan!');
                return redirect()->to('index');
            }
    }

    public function edit_bayar()
    {
        if ($this->request->isAJAX()) {

            $bayar_id       = $this->request->getVar('bayar_id');
            $pembayaran     =  $this->program_bayar->find($bayar_id);
            $data = [
                'title'                 => 'Ubah Data Pembayaran',
                'bayar_id'              => $pembayaran['bayar_id'],
                'awal_bayar'            => $pembayaran['awal_bayar'],
                'awal_bayar_infaq'      => $pembayaran['awal_bayar_infaq'],
                'awal_bayar_daftar'     => $pembayaran['awal_bayar_daftar'],
                'awal_bayar_spp1'       => $pembayaran['awal_bayar_spp1'],
                'awal_bayar_spp2'       => $pembayaran['awal_bayar_spp2'],
                'awal_bayar_spp3'       => $pembayaran['awal_bayar_spp3'],
                'awal_bayar_spp4'       => $pembayaran['awal_bayar_spp4'],
                'keterangan_bayar'      => $pembayaran['keterangan_bayar'],
            ];
            $msg = [
                'sukses' => view('auth/pembayaran/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update_bayar()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'awal_bayar' => [
                    'label' => 'awal_bayar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'awal_bayar_infaq' => [
                    'label' => 'awal_bayar_infaq',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'awal_bayar_daftar' => [
                    'label' => 'awal_bayar_daftar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'awal_bayar_spp1' => [
                    'label' => 'awal_bayar_spp1',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'awal_bayar_spp2' => [
                    'label' => 'awal_bayar_spp2',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'awal_bayar_spp3' => [
                    'label' => 'awal_bayar_spp3',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'awal_bayar_spp4' => [
                    'label' => 'awal_bayar_spp4',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'awal_bayar'        => $validation->getError('awal_bayar'),
                        'awal_bayar_infaq'  => $validation->getError('awal_bayar_infaq'),
                        'awal_bayar_daftar' => $validation->getError('awal_bayar_daftar'),
                        'awal_bayar_spp1'   => $validation->getError('awal_bayar_spp1'),
                        'awal_bayar_spp2'   => $validation->getError('awal_bayar_spp2'),
                        'awal_bayar_spp3'   => $validation->getError('awal_bayar_spp3'),
                        'awal_bayar_spp4'   => $validation->getError('awal_bayar_spp4'),
                    ]
                ];
            } else {

                //Get from form input view modal
                $get_awal_bayar         =  $this->request->getVar('awal_bayar');
                $get_awal_bayar_infaq   =  $this->request->getVar('awal_bayar_infaq');
                $get_awal_bayar_daftar  =  $this->request->getVar('awal_bayar_daftar');
                $get_awal_bayar_spp1    =  $this->request->getVar('awal_bayar_spp1');
                $get_awal_bayar_spp2    =  $this->request->getVar('awal_bayar_spp2');
                $get_awal_bayar_spp3    =  $this->request->getVar('awal_bayar_spp3');
                $get_awal_bayar_spp4    =  $this->request->getVar('awal_bayar_spp4');

                //Replace Rp. and thousand separtor from input
                $awal_bayar_int           = str_replace(str_split('Rp. .'), '', $get_awal_bayar);
                $awal_bayar_daftar_int    = str_replace(str_split('Rp. .'), '', $get_awal_bayar_daftar);
                $awal_bayar_spp1_int      = str_replace(str_split('Rp. .'), '', $get_awal_bayar_spp1);
                $awal_bayar_infaq_int     = str_replace(str_split('Rp. .'), '', $get_awal_bayar_infaq);
                $awal_bayar_spp2_int      = str_replace(str_split('Rp. .'), '', $get_awal_bayar_spp2);
                $awal_bayar_spp3_int      = str_replace(str_split('Rp. .'), '', $get_awal_bayar_spp3);
                $awal_bayar_spp4_int      = str_replace(str_split('Rp. .'), '', $get_awal_bayar_spp4);

                //Get Data from Input view
                $keterangan_bayar       =  $this->request->getVar('keterangan_bayar');
                $awal_bayar              = $awal_bayar_int;
                $awal_bayar_daftar       = $awal_bayar_daftar_int;
                $awal_bayar_spp1         = $awal_bayar_spp1_int;
                $awal_bayar_infaq        = $awal_bayar_infaq_int;
                $awal_bayar_spp2         = $awal_bayar_spp2_int;
                $awal_bayar_spp3         = $awal_bayar_spp3_int;
                $awal_bayar_spp4         = $awal_bayar_spp4_int;

                $update_data = [
                    'awal_bayar'        => $awal_bayar ,
                    'awal_bayar_infaq'  => $awal_bayar_infaq ,
                    'awal_bayar_daftar' => $awal_bayar_daftar,
                    'awal_bayar_spp1'   => $awal_bayar_spp1,
                    'awal_bayar_spp2'   => $awal_bayar_spp2,
                    'awal_bayar_spp3'   => $awal_bayar_spp3,
                    'awal_bayar_spp4'   => $awal_bayar_spp4,
                    'keterangan_bayar'  => $keterangan_bayar, 
                ];

                $bayar_id = $this->request->getVar('bayar_id');
                $this->program_bayar->update($bayar_id, $update_data);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Ubah Data Pembayaran ID : ' .  $this->request->getVar('bayar_id'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'pembayaran'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapus_bayar()
    {
        if ($this->request->isAJAX()) {

            $bayar_id = $this->request->getVar('bayar_id');

            $this->program_bayar->delete($bayar_id);

            // Data Log START
            $log = [
                'username_log' => session()->get('username'),
                'tgl_log'      => date("Y-m-d"),
                'waktu_log'    => date("H:i:s"),
                'aktivitas_log'=> 'Hapus Data Pembayaran ID : ' .  $this->request->getVar('bayar_id'),
            ];
            $this->log->insert($log);
            // Data Log END

            $msg = [
                'sukses' => [
                    'link' => 'pembayaran'
                ]
            ];
            echo json_encode($msg);
        }
    }

    public function admin_rekap_bayar()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('login');
        }

        $data = [
            'title'         => 'Al-Haqq - Rekap Data Pembayaran Peserta',
            'list'          => $this->peserta_kelas->admin_rekap_bayar(),
        ];
        
        return view('auth/pembayaran/rekap_bayar_admin', $data);
    }

    public function rekap_spp_admin_export()
    {
        $rekap_spp =  $this->peserta_kelas->admin_rekap_bayar();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $styleColumn = [
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $border = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->setCellValue('A1', "DATA REKAP PEMBAYARAN SPP ALHAQQ - ACADEMIC ALHAQQ INFORMATION SYSTEM");
        $sheet->mergeCells('A1:U1');
        $sheet->getStyle('A1')->applyFromArray($styleColumn);

        $sheet->setCellValue('A2', date("Y-m-d"));
        $sheet->mergeCells('A2:U2');
        $sheet->getStyle('A2')->applyFromArray($styleColumn);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A4', 'NIS')
            ->setCellValue('B4', 'NAMA PESERTA')
            ->setCellValue('C4', 'JENIS KELAMIN')
            ->setCellValue('D4', 'LEVEL')
            ->setCellValue('E4', 'ANGKATAN PERKULIAHAN')
            ->setCellValue('F4', 'STATUS PESERTA')
            ->setCellValue('G4', 'KELAS')
            ->setCellValue('H4', 'PENGAJAR')
            ->setCellValue('I4', 'STATUS SPP')
            ->setCellValue('J4', 'TERBAYAR')
            ->setCellValue('K4', 'PIUTANG')
            ->setCellValue('L4', 'BAYAR PENDAFTARAN')
            ->setCellValue('M4', 'BAYAR SPP-1')
            ->setCellValue('N4', 'BAYAR SPP-2')
            ->setCellValue('O4', 'BAYAR SPP-3')
            ->setCellValue('P4', 'BAYAR SPP-4')
            ->setCellValue('Q4', 'BAYAR MODUL');
        
        $sheet->getStyle('A4')->applyFromArray($styleColumn);
        $sheet->getStyle('A4')->applyFromArray($border);
        $sheet->getStyle('B4')->applyFromArray($styleColumn);
        $sheet->getStyle('B4')->applyFromArray($border);
        $sheet->getStyle('C4')->applyFromArray($styleColumn);
        $sheet->getStyle('C4')->applyFromArray($border);
        $sheet->getStyle('D4')->applyFromArray($styleColumn);
        $sheet->getStyle('D4')->applyFromArray($border);
        $sheet->getStyle('E4')->applyFromArray($styleColumn);
        $sheet->getStyle('E4')->applyFromArray($border);
        $sheet->getStyle('F4')->applyFromArray($styleColumn);
        $sheet->getStyle('F4')->applyFromArray($border);
        $sheet->getStyle('G4')->applyFromArray($styleColumn);
        $sheet->getStyle('G4')->applyFromArray($border);
        $sheet->getStyle('H4')->applyFromArray($styleColumn);
        $sheet->getStyle('H4')->applyFromArray($border);
        $sheet->getStyle('I4')->applyFromArray($styleColumn);
        $sheet->getStyle('I4')->applyFromArray($border);
        $sheet->getStyle('J4')->applyFromArray($styleColumn);
        $sheet->getStyle('J4')->applyFromArray($border);
        $sheet->getStyle('K4')->applyFromArray($styleColumn);
        $sheet->getStyle('K4')->applyFromArray($border);
        $sheet->getStyle('L4')->applyFromArray($styleColumn);
        $sheet->getStyle('L4')->applyFromArray($border);
        $sheet->getStyle('M4')->applyFromArray($styleColumn);
        $sheet->getStyle('M4')->applyFromArray($border);
        $sheet->getStyle('N4')->applyFromArray($styleColumn);
        $sheet->getStyle('N4')->applyFromArray($border);
        $sheet->getStyle('O4')->applyFromArray($styleColumn);
        $sheet->getStyle('O4')->applyFromArray($border);
        $sheet->getStyle('P4')->applyFromArray($styleColumn);
        $sheet->getStyle('P4')->applyFromArray($border);
        $sheet->getStyle('Q4')->applyFromArray($styleColumn);
        $sheet->getStyle('Q4')->applyFromArray($border);

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);

        $row = 5;

        foreach ($rekap_spp as $rekap) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $rekap['nis'])
                ->setCellValue('B' . $row, $rekap['nama_peserta'])
                ->setCellValue('C' . $row, $rekap['jenkel'])
                ->setCellValue('D' . $row, $rekap['nama_level'])
                ->setCellValue('E' . $row, $rekap['angkatan_kelas'])
                ->setCellValue('F' . $row, $rekap['status_peserta'])
                ->setCellValue('G' . $row, $rekap['nama_kelas'])
                ->setCellValue('H' . $row, $rekap['nama_pengajar'])
                ->setCellValue('I' . $row, $rekap['spp_status'])
                ->setCellValue('J' . $row, $rekap['spp_terbayar'])
                ->setCellValue('K' . $row, $rekap['spp_piutang'])
                ->setCellValue('L' . $row, $rekap['byr_daftar'])
                ->setCellValue('M' . $row, $rekap['byr_spp1'])
                ->setCellValue('N' . $row, $rekap['byr_spp2'])
                ->setCellValue('O' . $row, $rekap['byr_spp3'])
                ->setCellValue('P' . $row, $rekap['byr_spp4'])
                ->setCellValue('Q' . $row, $rekap['byr_modul']);

            $sheet->getStyle('A' . $row)->applyFromArray($border);
            $sheet->getStyle('B' . $row)->applyFromArray($border);
            $sheet->getStyle('C' . $row)->applyFromArray($border);
            $sheet->getStyle('D' . $row)->applyFromArray($border);
            $sheet->getStyle('E' . $row)->applyFromArray($border);
            $sheet->getStyle('F' . $row)->applyFromArray($border);
            $sheet->getStyle('G' . $row)->applyFromArray($border);
            $sheet->getStyle('H' . $row)->applyFromArray($border);
            $sheet->getStyle('I' . $row)->applyFromArray($border);
            $sheet->getStyle('J' . $row)->applyFromArray($border);
            $sheet->getStyle('K' . $row)->applyFromArray($border);
            $sheet->getStyle('L' . $row)->applyFromArray($border);
            $sheet->getStyle('M' . $row)->applyFromArray($border);
            $sheet->getStyle('N' . $row)->applyFromArray($border);
            $sheet->getStyle('O' . $row)->applyFromArray($border);
            $sheet->getStyle('P' . $row)->applyFromArray($border);
            $sheet->getStyle('Q' . $row)->applyFromArray($border);

            $row++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename =  'Data-Rekap-SPP-'. date('Y-m-d-His');

        // Data Log START
        $log = [
            'username_log' => session()->get('username'),
            'tgl_log'      => date("Y-m-d"),
            'waktu_log'    => date("H:i:s"),
            'status_log'   => 'BERHASIL',
            'aktivitas_log'=> 'Download Data Rekap SPP via Export Excel, Waktu : ' .  date('Y-m-d-H:i:s'),
        ];
        $this->log->insert($log);
        // Data Log END

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function export_infaq()
    {
        $rekap_infaq =  $this->infaq->list();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $styleColumn = [
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $border = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->setCellValue('A1', "DATA REKAP PEMBAYARAN INFAQ ALHAQQ - ACADEMIC ALHAQQ INFORMATION SYSTEM");
        $sheet->mergeCells('A1:I1');
        $sheet->getStyle('A1')->applyFromArray($styleColumn);

        $sheet->setCellValue('A2', date("Y-m-d"));
        $sheet->mergeCells('A2:I2');
        $sheet->getStyle('A2')->applyFromArray($styleColumn);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A4', 'TRANSAKSI ID')
            ->setCellValue('B4', 'NIS')
            ->setCellValue('C4', 'NAMA PESERTA')
            ->setCellValue('D4', 'TGL BAYAR')
            ->setCellValue('E4', 'WAKTU BAYAR')
            ->setCellValue('F4', 'NOMINAL')
            ->setCellValue('G4', 'VALIDATOR')
            ->setCellValue('H4', 'KET. PESERTA')
            ->setCellValue('I4', 'KET. ADMIN');
        
        $sheet->getStyle('A4')->applyFromArray($styleColumn);
        $sheet->getStyle('A4')->applyFromArray($border);
        $sheet->getStyle('B4')->applyFromArray($styleColumn);
        $sheet->getStyle('B4')->applyFromArray($border);
        $sheet->getStyle('C4')->applyFromArray($styleColumn);
        $sheet->getStyle('C4')->applyFromArray($border);
        $sheet->getStyle('D4')->applyFromArray($styleColumn);
        $sheet->getStyle('D4')->applyFromArray($border);
        $sheet->getStyle('E4')->applyFromArray($styleColumn);
        $sheet->getStyle('E4')->applyFromArray($border);
        $sheet->getStyle('F4')->applyFromArray($styleColumn);
        $sheet->getStyle('F4')->applyFromArray($border);
        $sheet->getStyle('G4')->applyFromArray($styleColumn);
        $sheet->getStyle('G4')->applyFromArray($border);
        $sheet->getStyle('H4')->applyFromArray($styleColumn);
        $sheet->getStyle('H4')->applyFromArray($border);
        $sheet->getStyle('I4')->applyFromArray($styleColumn);
        $sheet->getStyle('I4')->applyFromArray($border);

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);

        $row = 5;

        foreach ($rekap_infaq as $rekap) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $rekap['bayar_id'])
                ->setCellValue('B' . $row, $rekap['nis'])
                ->setCellValue('C' . $row, $rekap['nama_peserta'])
                ->setCellValue('D' . $row, $rekap['tgl_bayar'])
                ->setCellValue('E' . $row, $rekap['waktu_bayar'])
                ->setCellValue('F' . $row, $rekap['bayar_infaq'])
                ->setCellValue('G' . $row, $rekap['validator'])
                ->setCellValue('H' . $row, $rekap['keterangan_bayar'])
                ->setCellValue('I' . $row, $rekap['keterangan_bayar_admin']);

            $sheet->getStyle('A' . $row)->applyFromArray($border);
            $sheet->getStyle('B' . $row)->applyFromArray($border);
            $sheet->getStyle('C' . $row)->applyFromArray($border);
            $sheet->getStyle('D' . $row)->applyFromArray($border);
            $sheet->getStyle('E' . $row)->applyFromArray($border);
            $sheet->getStyle('F' . $row)->applyFromArray($border);
            $sheet->getStyle('G' . $row)->applyFromArray($border);
            $sheet->getStyle('H' . $row)->applyFromArray($border);
            $sheet->getStyle('I' . $row)->applyFromArray($border);

            $row++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename =  'Data-Rekap-Infaq-'. date('Y-m-d-His');

        // Data Log START
        $log = [
            'username_log' => session()->get('username'),
            'tgl_log'      => date("Y-m-d"),
            'waktu_log'    => date("H:i:s"),
            'status_log'   => 'BERHASIL',
            'aktivitas_log'=> 'Download Data Rekap Infaq via Export Excel, Waktu : ' .  date('Y-m-d-H:i:s'),
        ];
        $this->log->insert($log);
        // Data Log END

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function export_lain()
    {
        $rekap_lain =  $this->bayar_lain->list();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $styleColumn = [
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $border = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->setCellValue('A1', "DATA REKAP PEMBAYARAN LAINNYA ALHAQQ - ACADEMIC ALHAQQ INFORMATION SYSTEM");
        $sheet->mergeCells('A1:I1');
        $sheet->getStyle('A1')->applyFromArray($styleColumn);

        $sheet->setCellValue('A2', date("Y-m-d"));
        $sheet->mergeCells('A2:I2');
        $sheet->getStyle('A2')->applyFromArray($styleColumn);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A4', 'TRANSAKSI ID')
            ->setCellValue('B4', 'NIS')
            ->setCellValue('C4', 'NAMA PESERTA')
            ->setCellValue('D4', 'TGL BAYAR')
            ->setCellValue('E4', 'WAKTU BAYAR')
            ->setCellValue('F4', 'NOMINAL')
            ->setCellValue('G4', 'VALIDATOR')
            ->setCellValue('H4', 'KET. PESERTA')
            ->setCellValue('I4', 'KET. ADMIN');
        
        $sheet->getStyle('A4')->applyFromArray($styleColumn);
        $sheet->getStyle('A4')->applyFromArray($border);
        $sheet->getStyle('B4')->applyFromArray($styleColumn);
        $sheet->getStyle('B4')->applyFromArray($border);
        $sheet->getStyle('C4')->applyFromArray($styleColumn);
        $sheet->getStyle('C4')->applyFromArray($border);
        $sheet->getStyle('D4')->applyFromArray($styleColumn);
        $sheet->getStyle('D4')->applyFromArray($border);
        $sheet->getStyle('E4')->applyFromArray($styleColumn);
        $sheet->getStyle('E4')->applyFromArray($border);
        $sheet->getStyle('F4')->applyFromArray($styleColumn);
        $sheet->getStyle('F4')->applyFromArray($border);
        $sheet->getStyle('G4')->applyFromArray($styleColumn);
        $sheet->getStyle('G4')->applyFromArray($border);
        $sheet->getStyle('H4')->applyFromArray($styleColumn);
        $sheet->getStyle('H4')->applyFromArray($border);
        $sheet->getStyle('I4')->applyFromArray($styleColumn);
        $sheet->getStyle('I4')->applyFromArray($border);

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);

        $row = 5;

        foreach ($rekap_lain as $rekap) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $rekap['bayar_id'])
                ->setCellValue('B' . $row, $rekap['nis'])
                ->setCellValue('C' . $row, $rekap['nama_peserta'])
                ->setCellValue('D' . $row, $rekap['tgl_bayar'])
                ->setCellValue('E' . $row, $rekap['waktu_bayar'])
                ->setCellValue('F' . $row, $rekap['bayar_lainnya'])
                ->setCellValue('G' . $row, $rekap['validator'])
                ->setCellValue('H' . $row, $rekap['keterangan_bayar'])
                ->setCellValue('I' . $row, $rekap['keterangan_bayar_admin']);

            $sheet->getStyle('A' . $row)->applyFromArray($border);
            $sheet->getStyle('B' . $row)->applyFromArray($border);
            $sheet->getStyle('C' . $row)->applyFromArray($border);
            $sheet->getStyle('D' . $row)->applyFromArray($border);
            $sheet->getStyle('E' . $row)->applyFromArray($border);
            $sheet->getStyle('F' . $row)->applyFromArray($border);
            $sheet->getStyle('G' . $row)->applyFromArray($border);
            $sheet->getStyle('H' . $row)->applyFromArray($border);
            $sheet->getStyle('I' . $row)->applyFromArray($border);

            $row++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename =  'Data-Rekap-Pembyaran-Lain-'. date('Y-m-d-His');

        // Data Log START
        $log = [
            'username_log' => session()->get('username'),
            'tgl_log'      => date("Y-m-d"),
            'waktu_log'    => date("H:i:s"),
            'status_log'   => 'BERHASIL',
            'aktivitas_log'=> 'Download Data Rekap Pemby. Lain via Export Excel, Waktu : ' .  date('Y-m-d-H:i:s'),
        ];
        $this->log->insert($log);
        // Data Log END

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function peserta_bayar_spp()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('login');
        }

        //Get data peserta
        $user_id = session()->get('user_id');
        $get_peserta = $this->peserta->get_peserta_id($user_id);
        $peserta_id = $get_peserta->peserta_id;

        // Get data peserta_kelas yang belum lulus 
        $psrt_kls_id = $this->peserta_kelas->list_kelas_peserta_belum_lulus($peserta_id);


        $data = [
            'title'         => 'Al-Haqq - Pembayaran SPP',
            'kelas'         => $psrt_kls_id,
        ];
        return view('auth/pembayaran/bayar_spp_peserta', $data);
    }

    public function input_pembayaran_spp_peserta()
    {
        if ($this->request->isAJAX()) {

            $kelas_id           = $this->request->getVar('kelas_id');
            $peserta_id         = $this->request->getVar('peserta_id');
            $peserta_kelas_id   = $this->request->getVar('peserta_kelas_id');

            $data_psrt_kls      = $this->peserta_kelas->find($peserta_kelas_id);

            $data = [
                'title'         => 'Absensi Pengajar & Peserta',
                'kelas_id'      => $kelas_id,
                'peserta_id'    => $peserta_id,
                'data_psrt_kls' => $data_psrt_kls,
            ];

            $msg = [
                'sukses' => view('auth/pembayaran/input_bayar_spp_peserta', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_bayar_spp_peserta()
    {
            $validation = \Config\Services::validation();

            //Get Nama User
            $user_nama = session()->get('nama');
            //Get Tgl Today
            $tgl = date("Y-m-d");
            $waktu = date("H:i:s");
            $strwaktu = date("H-i-s");

            $valid = $this->validate([
                'awal_bayar' => [
                    'label' => 'awal_bayar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'awal_bayar_infaq' => [
                    'label' => 'awal_bayar_infaq',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'awal_bayar_spp2' => [
                    'label' => 'awal_bayar_spp2',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'awal_bayar_spp3' => [
                    'label' => 'awal_bayar_spp3',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'awal_bayar_spp4' => [
                    'label' => 'awal_bayar_spp4',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'foto' => [
                    'rules' => 'uploaded[foto]|mime_in[foto,image/png,image/jpg,image/jpeg]|is_image[foto]',
                    'errors' => [
                        'mime_in' => 'Harus gambar!'
                    ]
                ]
            ]);

            if (!$valid) {
                $this->session->setFlashdata('pesan_error', 'ERROR! Seluruh Form Input Bertanda * Wajib Diisi dan Harap Upload Bukti Bayar!');
                return redirect()->to('peserta_bayar_spp');
            } else {

                // get file foto from input
                $filefoto = $this->request->getFile('foto');
                // ambil nama file
                $namafoto = $filefoto->getName();
                // nama foto baru
                $namafoto_new = $user_nama . '_'. $tgl . '_' . $strwaktu .'_'. $namafoto;

                //Get from form input view modal
                $get_awal_bayar         =  $this->request->getVar('awal_bayar');
                $get_awal_bayar_infaq   =  $this->request->getVar('awal_bayar_infaq');
                $get_awal_bayar_spp2    =  $this->request->getVar('awal_bayar_spp2');
                $get_awal_bayar_spp3    =  $this->request->getVar('awal_bayar_spp3');
                $get_awal_bayar_spp4    =  $this->request->getVar('awal_bayar_spp4');
                $get_awal_bayar_lainnya =  $this->request->getVar('awal_bayar_lainnya');

                //Replace Rp. and thousand separtor from input
                $awal_bayar_int           = str_replace(str_split('Rp. .'), '', $get_awal_bayar);
                $awal_bayar_infaq_int     = str_replace(str_split('Rp. .'), '', $get_awal_bayar_infaq);
                $awal_bayar_spp2_int      = str_replace(str_split('Rp. .'), '', $get_awal_bayar_spp2);
                $awal_bayar_spp3_int      = str_replace(str_split('Rp. .'), '', $get_awal_bayar_spp3);
                $awal_bayar_spp4_int      = str_replace(str_split('Rp. .'), '', $get_awal_bayar_spp4);
                $awal_bayar_lainnya_int   = str_replace(str_split('Rp. .'), '', $get_awal_bayar_lainnya);

                //Get Data from Input view
                $kelas_id                =  $this->request->getVar('kelas_id');
                $peserta_id              =  $this->request->getVar('peserta_id');
                $keterangan_bayar        =  $this->request->getVar('keterangan_bayar');
                $awal_bayar              = $awal_bayar_int;
                $awal_bayar_infaq        = $awal_bayar_infaq_int;
                $awal_bayar_spp2         = $awal_bayar_spp2_int;
                $awal_bayar_spp3         = $awal_bayar_spp3_int;
                $awal_bayar_spp4         = $awal_bayar_spp4_int;
                $awal_bayar_lainnya      = $awal_bayar_lainnya_int;

                $data_bayar = [
                    'bayar_peserta_id'          => $peserta_id,
                    'kelas_id'                  => $kelas_id,
                    'awal_bayar'                => $awal_bayar,
                    'awal_bayar_daftar'         => '0',
                    'awal_bayar_infaq'          => $awal_bayar_infaq,
                    'awal_bayar_spp1'           => '0',
                    'awal_bayar_spp2'           => $awal_bayar_spp2,
                    'awal_bayar_spp3'           => $awal_bayar_spp3,
                    'awal_bayar_spp4'           => $awal_bayar_spp4,
                    'awal_bayar_lainnya'        => $awal_bayar_lainnya, 
                    'status_bayar'              => 'Belum Lunas',
                    'status_konfirmasi'         => 'Proses',
                    'bukti_bayar'               => $namafoto_new,
                    'tgl_bayar'                 => $tgl,
                    'waktu_bayar'               => $waktu,
                    'keterangan_bayar'          => $keterangan_bayar ,
                    'tgl_bayar_konfirmasi'      => '1000-01-01',
                    'waktu_bayar_konfirmasi'    => '00:00:00',
                ];
                
                // insert status konfirmasi
                $this->program_bayar->insert($data_bayar);

                $filefoto->move('img/transfer/', $namafoto_new);
                
                $this->session->setFlashdata('pesan_sukses', 'Data Pembayaran Baru Berhasil Ditambahkan!');
                return redirect()->to('peserta_bayar_spp');
            }
    }

    public function riwayat_bayar_peserta()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('login');
        }

        //Get data peserta
        $user_id = session()->get('user_id');
        $get_peserta = $this->peserta->get_peserta_id($user_id);
        $peserta_id = $get_peserta->peserta_id;

        // Get data peserta_kelas yang belum lulus 
        $pembayaran = $this->program_bayar->list_pembayaran_peserta($peserta_id);


        $data = [
            'title'         => 'Al-Haqq - Riwayat Pembayaran Peserta',
            'bayar'         => $pembayaran,
        ];
        return view('auth/pembayaran/riwayat_bayar_peserta', $data);
    }

    public function tambah_bayar_daftar()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('login');
        }
        $get_angkatan = $this->konfigurasi->angkatan_kuliah();
        $angkatan     = $get_angkatan->angkatan_kuliah;

        $peserta       = $this->peserta->list();
        $kelas         = $this->program->list_sesuai_angkatan_perkuliahan($angkatan);

        $data = [
            'title'         => 'Al-Haqq - Tambah Pembayaran Pendaftaran Program Peserta',
            'peserta'       => $peserta,
            'kelas'         => $kelas,
        ];
        return view('auth/pembayaran/tambah_bayar_daftar', $data);
    }

    public function simpan_bayar_daftar()
    {
            $validation = \Config\Services::validation();

            //Get Tgl Today
            $tgl = date("Y-m-d");
            $waktu = date("H:i:s");
            $strwaktu = date("H-i-s");

            $valid = $this->validate([
                'peserta' => [
                    'label' => 'peserta',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'kelas' => [
                    'label' => 'kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'awal_bayar' => [
                    'label' => 'awal_bayar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'daftar' => [
                    'label' => 'daftar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'spp1' => [
                    'label' => 'spp1',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'spp2' => [
                    'label' => 'spp2',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'spp3' => [
                    'label' => 'spp3',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'spp4' => [
                    'label' => 'spp4',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'infaq' => [
                    'label' => 'infaq',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'modul' => [
                    'label' => 'modul',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'lain' => [
                    'label' => 'lain',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'status_bayar_admin' => [
                    'label' => 'status_bayar_admin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'foto' => [
                    'rules' => 'uploaded[foto]|mime_in[foto,image/png,image/jpg,image/jpeg]|is_image[foto]',
                    'errors' => [
                        'mime_in' => 'Harus gambar!'
                    ]
                ]
            ]);

            if (!$valid) {
                $this->session->setFlashdata('pesan_eror', 'ERROR! Seluruh Form Input Bertanda * Wajib Diisi dan Harap Upload Bukti Bayar!');
                return redirect()->to('tambah_bayar_daftar');
            } else {

                //Admin input
                $validator          = session()->get('username');

                //Get inputan peserta, kelas, status bayar dan keterangan admin
                $peserta_id         = $this->request->getVar('peserta');
                $kelas_id           = $this->request->getVar('kelas');
                $status_bayar_admin = $this->request->getVar('status_bayar_admin');
                $keterangan_admin   = strtoupper($this->request->getVar('keterangan_admin'));

                //Get data total bayar
                $get_program_id    = $this->program->get_program_id($kelas_id);
                $program_id        = $get_program_id->program_id;
                $get_biaya_bulanan = $this->program_data->get_biaya_bulanan($program_id);
                $biaya_bulanan     = $get_biaya_bulanan->biaya_bulanan;
                $get_biaya_program = $this->program_data->get_biaya_program($program_id);
                $biaya_program     = $get_biaya_program->biaya_program;
                $get_biaya_daftar  = $this->program_data->get_biaya_daftar($program_id);
                $biaya_daftar      = $get_biaya_daftar->biaya_daftar;
                $get_biaya_modul   = $this->program_data->get_biaya_modul($program_id);
                $biaya_modul       = $get_biaya_modul->biaya_modul;
                $total_lunas       = $biaya_program + $biaya_daftar + $biaya_modul;

                //Get nama peserta
                $get_nama_peserta   = $this->peserta->find($peserta_id);
                $nama_peserta       = $get_nama_peserta['nama_peserta'];
                $nis                = $get_nama_peserta['nis'];

                //Get data sisa kouta dari tabel program_kelas
                $get_sisa_kouta = $this->program->get_sisa_kouta($kelas_id);
                $sisa_kouta = $get_sisa_kouta->sisa_kouta;

                //Pengurangan Kouta
                $minus1 = 1;
                $kouta_kurang = $sisa_kouta - $minus1;

                //Get data jumlah peserta dari tabel program_kelas
                $get_jml_peserta = $this->program->get_jumlah_peserta($kelas_id);
                $jumlah_peserta = $get_jml_peserta ->jumlah_peserta;

                //Pengurangan Kouta
                $plus1 = 1;
                $tambah_peserta = $jumlah_peserta + $plus1;
                

                // get file foto from input
                $filefoto = $this->request->getFile('foto');
                // ambil nama file
                $namafoto = $filefoto->getName();
                // nama foto baru
                $namafoto_new = $nama_peserta . '_'. $tgl . '_' . $strwaktu .'_'. $namafoto;
                
                //Get nominal (on rupiah curenncy format) input from view
                 $get_awal_bayar    = $this->request->getVar('awal_bayar');
                 $get_bayar_daftar  = $this->request->getVar('daftar');
                 $get_bayar_spp1    = $this->request->getVar('spp1');
                 $get_bayar_spp2    = $this->request->getVar('spp2');
                 $get_bayar_spp3    = $this->request->getVar('spp3');
                 $get_bayar_spp4    = $this->request->getVar('spp4');
                 $get_bayar_infaq   = $this->request->getVar('infaq');
                 $get_bayar_modul   = $this->request->getVar('modul');
                 $get_bayar_lain    = $this->request->getVar('lain');

                 //Replace Rp. and thousand separtor from input
                 $awal_bayar_int      = str_replace(str_split('Rp. .'), '', $get_awal_bayar);
                 $bayar_daftar_int    = str_replace(str_split('Rp. .'), '', $get_bayar_daftar);
                 $bayar_spp1_int      = str_replace(str_split('Rp. .'), '', $get_bayar_spp1);
                 $bayar_spp2_int      = str_replace(str_split('Rp. .'), '', $get_bayar_spp2);
                 $bayar_spp3_int      = str_replace(str_split('Rp. .'), '', $get_bayar_spp3);
                 $bayar_spp4_int      = str_replace(str_split('Rp. .'), '', $get_bayar_spp4);
                 $bayar_infaq_int     = str_replace(str_split('Rp. .'), '', $get_bayar_infaq);
                 $bayar_modul_int     = str_replace(str_split('Rp. .'), '', $get_bayar_modul);
                 $bayar_lain_int      = str_replace(str_split('Rp. .'), '', $get_bayar_lain);

                 //Get Data from Input view
                 //$bayar_id         = $this->request->getVar('bayar_id');
                 $awal_bayar         = $awal_bayar_int;
                 $bayar_daftar       = $bayar_daftar_int;
                 $bayar_spp1         = $bayar_spp1_int;
                 $bayar_spp2         = $bayar_spp2_int;
                 $bayar_spp3         = $bayar_spp3_int;
                 $bayar_spp4         = $bayar_spp4_int;
                 $bayar_infaq        = $bayar_infaq_int;
                 $bayar_modul        = $bayar_modul_int;
                 $bayar_lain         = $bayar_lain_int;


                $data_bayar = [
                    'kelas_id'                  => $kelas_id,
                    'bayar_peserta_id'          => $peserta_id,
                    'status_bayar'              => 'Lunas',
                    'status_bayar_admin'        => $status_bayar_admin,
                    'status_konfirmasi'         => 'Terkonfirmasi',
                    'awal_bayar'                => $awal_bayar,
                    'awal_bayar_daftar'         => $bayar_daftar,
                    'awal_bayar_infaq'          => $bayar_infaq,
                    'awal_bayar_spp1'           => $bayar_spp1,
                    'awal_bayar_spp2'           => $bayar_spp2,
                    'awal_bayar_spp3'           => $bayar_spp3,
                    'awal_bayar_spp4'           => $bayar_spp4,
                    'awal_bayar_modul'          => $bayar_modul,
                    'awal_bayar_lainnya'        => $bayar_lain,
                    'bukti_bayar'               => $namafoto_new,
                    'tgl_bayar'                 => $tgl,
                    'waktu_bayar'               => $waktu,
                    'keterangan_bayar_admin'    => $keterangan_admin,
                    'tgl_bayar_konfirmasi'      => $tgl,
                    'waktu_bayar_konfirmasi'    => $waktu,
                    'nominal_bayar'             => $awal_bayar,
                    'validator'                 => $validator,
                ];

                //Simpan data pembayaran
                $this->program_bayar->insert($data_bayar);


                $filefoto->move('img/transfer/', $namafoto_new);

                // Get last id insert from program bayar
                $pembayaran_last_id = $this->program_bayar->insertID();
            
                $data_spp1 = [
                    'spp1_bayar_id' => $pembayaran_last_id,
                    'bayar_daftar'  => $bayar_daftar,
                    'bayar_spp1'    => $bayar_spp1,
                    'status_spp1'   => 'Lunas',
                ];

                $data_modul = [
                    'bayar_modul_id'        => $pembayaran_last_id,
                    'bayar_modul'           => $bayar_modul,
                    'status_bayar_modul'    => 'Lunas',
                ];

                $datakelas = [
                    'sisa_kouta'      => $kouta_kurang,
                    'jumlah_peserta'  => $tambah_peserta,
                ];

                //Create Absen Peserta di Kelas
                $dataabsen = [
                    'tm1'   => NULL,
                ];
                $this->absen_peserta->insert($dataabsen);

                // Get last id insert from absen peserta
                $absen_last_id = $this->absen_peserta->insertID();

                $sppdaftar = $bayar_daftar + $bayar_spp1 + $bayar_spp2 + $bayar_spp3 + $bayar_spp4 + $bayar_modul;
                $piutang1  = $total_lunas - $sppdaftar;

                if($bayar_modul == 0){
                    $byr_modul_value = '0';
                } else {
                    $byr_modul_value = $bayar_modul;
                }

                if($bayar_daftar != '0' && $bayar_spp1 != '0' && $bayar_spp2 != '0' && $bayar_spp3 != '0' && $bayar_spp4 != '0'){
                    $spp_status_value = 'LUNAS';
                } else {
                    $spp_status_value = 'BELUM LUNAS';
                }
    
                $datapesertakelas = [
                    'data_peserta_id'       => $peserta_id,
                    'data_kelas_id'         => $kelas_id,
                    'data_absen'            => $absen_last_id,
                    'status_peserta_kelas'  => 'Belum Lulus',
                    'byr_daftar'            => $bayar_daftar,
                    'byr_spp1'              => $bayar_spp1,
                    'byr_spp2'              => $bayar_spp2,
                    'byr_spp3'              => $bayar_spp3,
                    'byr_spp4'              => $bayar_spp4,
                    'byr_modul'             => $byr_modul_value,
                    'spp_terbayar'          => $sppdaftar,
                    'spp_piutang'           => $piutang1,
                    'spp_status'            => $spp_status_value,
                ];

                $this->spp1->insert($data_spp1);
                $this->bayar_modul->insert($data_modul);
                $this->program->update($kelas_id, $datakelas);
                $this->peserta_kelas->insert($datapesertakelas);

                // Get last id insert from peserta kelas
                $last_id_psrt_kls = $this->peserta_kelas->insertID();

                //Cek isian form untuk infaq
                if($bayar_infaq != 0){
                    $data_infaq = [
                        'infaq_bayar_id'        => $pembayaran_last_id,
                        'bayar_infaq'           => $bayar_infaq,
                        'data_peserta_id_infaq' => $peserta_id,
                    ];
                    $this->infaq->insert($data_infaq);
                }

                //Cek isian form untuk spp2
                if($bayar_spp2 != 0){
                    $data_spp2 = [
                        'spp2_bayar_id' => $pembayaran_last_id,
                        'bayar_spp2'    => $bayar_spp2,
                        'status_spp2'   => 'Lunas',
                    ];
                    $this->spp2->insert($data_spp2);
                }

                //Cek isian form untuk spp3
                if($bayar_spp3 != 0){
                    $data_spp3 = [
                        'spp3_bayar_id'    => $pembayaran_last_id,
                        'bayar_spp3'       => $bayar_spp3,
                        'status_spp3'      => 'Lunas',
                    ];
                    $this->spp3->insert($data_spp3);
                }

                //Cek isian form untuk spp4
                if($bayar_spp4 != 0){
                    $data_spp4 = [
                        'spp4_bayar_id'    => $pembayaran_last_id,
                        'bayar_spp4'       => $bayar_spp4,
                        'status_spp4'      => 'Lunas',
                    ];
                    $this->spp4->insert($data_spp4);
                }

                //Cek isian form untuk lain
                if($bayar_lain != 0){
                    $data_lain = [
                        'lainnya_bayar_id'        => $pembayaran_last_id,
                        'bayar_lainnya'           => $bayar_lain,
                        'data_peserta_id_lain'    => $peserta_id,
                        'status_bayar_lainnya'    => 'Lunas',
                    ];
                    $this->bayar_lain->insert($data_lain);
                }

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Buat Data Pembayaran Pendaftaran Atas Nama Peserta : ' . $nis . ' - ' . $nama_peserta,
                ];
                $this->log->insert($log);
                // Data Log END

                $this->session->setFlashdata('pesan_sukses', 'Pembuatan Pembayaran dan Pendaftaran Peserta oleh Admin Berhasil. Peserta Sudah Masuk di Kelas yang Dipilih.');
                return redirect()->to('tambah_bayar_daftar');
            }
    }

    public function tambah_bayar_spp()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('login');
        }
        $get_angkatan       = $this->konfigurasi->angkatan_kuliah();
        //$get_angkatan_pilih = $this->request->getVar('angkatan_kelas');

        //Angkatan perkuliahan
        $angkatan           = $get_angkatan->angkatan_kuliah;
        
        $peserta_kelas      = $this->peserta_kelas->list_kelas_peserta($angkatan );
        $list_angkatan      = $this->program->list_unik_angkatan();

        $data = [
            'title'         => 'Al-Haqq - Tambah Pembayaran SPP Peserta',
            'list_angkatan' => $list_angkatan,
            'peserta_kelas' => $peserta_kelas,
            'angkatan_pilih'=> $angkatan,
        ];
        //var_dump($cek);
        return view('auth/pembayaran/tambah_bayar_spp', $data);
    }

    public function tambah_bayar_spp_ganti_angkatan($angkatan_kelas)
    {
        if (!session()->get('user_id')) {
            return redirect()->to('login');
        }

        //Angkatan perkuliahan
        $angkatan       = $angkatan_kelas;
        
        $peserta_kelas      = $this->peserta_kelas->list_kelas_peserta($angkatan );
        $list_angkatan      = $this->program->list_unik_angkatan();

        $data = [
            'title'         => 'Al-Haqq - Tambah Pembayaran SPP Peserta',
            'list_angkatan' => $list_angkatan,
            'peserta_kelas' => $peserta_kelas,
            'angkatan_pilih'=> $angkatan,
        ];
        //var_dump($cek);
        return view('auth/pembayaran/tambah_bayar_spp', $data);
    }

    public function simpan_bayar_spp()
    {
            $validation = \Config\Services::validation();

            //Get Tgl Today
            $tgl = date("Y-m-d");
            $waktu = date("H:i:s");
            $strwaktu = date("H-i-s");

            $valid = $this->validate([
                'peserta_kelas_id' => [
                    'label' => 'peserta_kelas_id',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'awal_bayar' => [
                    'label' => 'awal_bayar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'spp2' => [
                    'label' => 'spp2',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'spp3' => [
                    'label' => 'spp3',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'spp4' => [
                    'label' => 'spp4',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'infaq' => [
                    'label' => 'infaq',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'lain' => [
                    'label' => 'lain',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'status_bayar_admin' => [
                    'label' => 'status_bayar_admin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'foto' => [
                    'rules' => 'uploaded[foto]|mime_in[foto,image/png,image/jpg,image/jpeg]|is_image[foto]',
                    'errors' => [
                        'mime_in' => 'Harus gambar!'
                    ]
                ]
            ]);

            if (!$valid) {
                $this->session->setFlashdata('pesan_eror', 'ERROR! Seluruh Form Input Bertanda * Wajib Diisi dan Harap Upload Bukti Bayar!');
                return redirect()->to('tambah_bayar_spp');
            } else {

                //Admin input
                $validator          = session()->get('username');

                //Get inputan peserta, kelas, status bayar dan keterangan admin
                $peserta_kelas_id   = $this->request->getVar('peserta_kelas_id');
                $status_bayar_admin = $this->request->getVar('status_bayar_admin');
                $keterangan_admin   = strtoupper($this->request->getVar('keterangan_admin'));

                //Get Data Peserta-Kelas, Peserta, dan Data Kelas
                $get_data_peserta_kelas = $this->peserta_kelas->find($peserta_kelas_id);;
                $peserta_id             = $get_data_peserta_kelas['data_peserta_id'];
                $kelas_id               = $get_data_peserta_kelas['data_kelas_id'];
                $data_bayar_daftar      = $get_data_peserta_kelas['byr_daftar'];
                $data_bayar_modul       = $get_data_peserta_kelas['byr_modul'];
                $data_bayar_spp1       = $get_data_peserta_kelas['byr_spp1'];
                $data_bayar_spp2       = $get_data_peserta_kelas['byr_spp2'];
                $data_bayar_spp3       = $get_data_peserta_kelas['byr_spp3'];
                $data_bayar_spp4       = $get_data_peserta_kelas['byr_spp4'];

                $get_data_peserta       = $this->peserta->find($peserta_id);
                $nama_peserta           = $get_data_peserta['nama_peserta'];
                $nis                    = $get_data_peserta['nis'];

                $get_data_kelas         = $this->program->find($kelas_id);
                $nama_kelas             = $get_data_kelas['nama_kelas'];

                //Get data total bayar
                $get_program_id    = $this->program->get_program_id($kelas_id);
                $program_id        = $get_program_id->program_id;
                $get_biaya_bulanan = $this->program_data->get_biaya_bulanan($program_id);
                $biaya_bulanan     = $get_biaya_bulanan->biaya_bulanan;
                $get_biaya_program = $this->program_data->get_biaya_program($program_id);
                $biaya_program     = $get_biaya_program->biaya_program;
                $get_biaya_daftar  = $this->program_data->get_biaya_daftar($program_id);
                $biaya_daftar      = $get_biaya_daftar->biaya_daftar;
                $get_biaya_modul   = $this->program_data->get_biaya_modul($program_id);
                $biaya_modul       = $get_biaya_modul->biaya_modul;
                $total_lunas       = $biaya_program + $biaya_daftar + $biaya_modul;
                
                // get file foto from input
                $filefoto = $this->request->getFile('foto');
                // ambil nama file
                $namafoto = $filefoto->getName();
                // nama foto baru
                $namafoto_new = $nama_peserta . '_'. $tgl . '_' . $strwaktu .'_'. $namafoto;
                
                //Get nominal (on rupiah curenncy format) input from view
                 $get_awal_bayar    = $this->request->getVar('awal_bayar');
                 $get_bayar_spp2    = $this->request->getVar('spp2');
                 $get_bayar_spp3    = $this->request->getVar('spp3');
                 $get_bayar_spp4    = $this->request->getVar('spp4');
                 $get_bayar_infaq   = $this->request->getVar('infaq');
                 $get_bayar_lain    = $this->request->getVar('lain');

                 //Replace Rp. and thousand separtor from input
                 $awal_bayar_int      = str_replace(str_split('Rp. .'), '', $get_awal_bayar);
                 $bayar_spp2_int      = str_replace(str_split('Rp. .'), '', $get_bayar_spp2);
                 $bayar_spp3_int      = str_replace(str_split('Rp. .'), '', $get_bayar_spp3);
                 $bayar_spp4_int      = str_replace(str_split('Rp. .'), '', $get_bayar_spp4);
                 $bayar_infaq_int     = str_replace(str_split('Rp. .'), '', $get_bayar_infaq);
                 $bayar_lain_int      = str_replace(str_split('Rp. .'), '', $get_bayar_lain);

                 //Get Data from Input view
                 $awal_bayar         = $awal_bayar_int;
                 $var_bayar_spp2     = $bayar_spp2_int;
                 $var_bayar_spp3     = $bayar_spp3_int;
                 $var_bayar_spp4     = $bayar_spp4_int;
                 $bayar_infaq        = $bayar_infaq_int;
                 $bayar_lain         = $bayar_lain_int;

                 //cek apa sudah bayar spp2
                 if ($data_bayar_spp2 == '0' || $data_bayar_spp2 == NULL) {
                    $bayar_spp2 = $var_bayar_spp2;
                 } else {
                    $bayar_spp2 = $data_bayar_spp2;
                 }

                 //cek apa sudah bayar spp3
                 if ($data_bayar_spp3 == '0' || $data_bayar_spp3 == NULL) {
                    $bayar_spp3 = $var_bayar_spp3;
                 } else {
                    $bayar_spp3 = $data_bayar_spp3;
                 }

                 //cek apa sudah bayar spp4
                 if ($data_bayar_spp4 == '0' || $data_bayar_spp4 == NULL) {
                    $bayar_spp4 = $var_bayar_spp4;
                 } else {
                    $bayar_spp4 = $data_bayar_spp4;
                 }


                $data_bayar = [
                    'kelas_id'                  => $kelas_id,
                    'bayar_peserta_id'          => $peserta_id,
                    'status_bayar'              => 'Lunas',
                    'status_bayar_admin'        => $status_bayar_admin,
                    'status_konfirmasi'         => 'Terkonfirmasi',
                    'awal_bayar'                => $awal_bayar,
                    'awal_bayar_daftar'         => '0',
                    'awal_bayar_infaq'          => $bayar_infaq,
                    'awal_bayar_spp1'           => '0',
                    'awal_bayar_spp2'           => $bayar_spp2,
                    'awal_bayar_spp3'           => $bayar_spp3,
                    'awal_bayar_spp4'           => $bayar_spp4,
                    'awal_bayar_modul'          => '0',
                    'awal_bayar_lainnya'        => $bayar_lain,
                    'bukti_bayar'               => $namafoto_new,
                    'tgl_bayar'                 => $tgl,
                    'waktu_bayar'               => $waktu,
                    'keterangan_bayar_admin'    => $keterangan_admin,
                    'tgl_bayar_konfirmasi'      => $tgl,
                    'waktu_bayar_konfirmasi'    => $waktu,
                    'nominal_bayar'             => $awal_bayar,
                    'validator'                 => $validator,
                ];

                //Simpan data pembayaran
                $this->program_bayar->insert($data_bayar);


                $filefoto->move('img/transfer/', $namafoto_new);

                // Get last id insert from program bayar
                $pembayaran_last_id = $this->program_bayar->insertID();

                $sppdaftar = $data_bayar_daftar + $data_bayar_spp1 + $bayar_spp2 + $bayar_spp3 + $bayar_spp4 + $data_bayar_modul;
                $piutang  = $total_lunas - $sppdaftar;

                if($piutang == '0'){
                    $spp_status_value = 'LUNAS';
                } else {
                    $spp_status_value = 'BELUM LUNAS';
                }
    
                $datapesertakelas = [
                    'byr_spp2'              => $bayar_spp2,
                    'byr_spp3'              => $bayar_spp3,
                    'byr_spp4'              => $bayar_spp4,
                    'spp_terbayar'          => $sppdaftar,
                    'spp_piutang'           => $piutang,
                    'spp_status'            => $spp_status_value,
                ];

                $this->peserta_kelas->update($peserta_kelas_id, $datapesertakelas);

                // Get last id insert from peserta kelas
                // $last_id_psrt_kls = $this->peserta_kelas->insertID();

                //Cek isian form untuk infaq
                if($bayar_infaq != 0){
                    $data_infaq = [
                        'infaq_bayar_id'        => $pembayaran_last_id,
                        'bayar_infaq'           => $bayar_infaq,
                        'data_peserta_id_infaq' => $peserta_id,
                    ];
                    $this->infaq->insert($data_infaq);
                }

                //Cek isian form untuk spp2
                if($bayar_spp2 != 0){
                    $data_spp2 = [
                        'spp2_bayar_id' => $pembayaran_last_id,
                        'bayar_spp2'    => $bayar_spp2,
                        'status_spp2'   => 'Lunas',
                    ];
                    $this->spp2->insert($data_spp2);
                }

                //Cek isian form untuk spp3
                if($bayar_spp3 != 0){
                    $data_spp3 = [
                        'spp3_bayar_id'    => $pembayaran_last_id,
                        'bayar_spp3'       => $bayar_spp3,
                        'status_spp3'      => 'Lunas',
                    ];
                    $this->spp3->insert($data_spp3);
                }

                //Cek isian form untuk spp4
                if($bayar_spp4 != 0){
                    $data_spp4 = [
                        'spp4_bayar_id'    => $pembayaran_last_id,
                        'bayar_spp4'       => $bayar_spp4,
                        'status_spp4'      => 'Lunas',
                    ];
                    $this->spp4->insert($data_spp4);
                }

                //Cek isian form untuk lain
                if($bayar_lain != 0){
                    $data_lain = [
                        'lainnya_bayar_id'        => $pembayaran_last_id,
                        'bayar_lainnya'           => $bayar_lain,
                        'data_peserta_id_lain'    => $peserta_id,
                        'status_bayar_lainnya'    => 'Lunas',
                    ];
                    $this->bayar_lain->insert($data_lain);
                }

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Buat Data Pembayaran SPP Atas Nama Peserta : ' . $nis . ' - ' . $nama_peserta,
                ];
                $this->log->insert($log);
                // Data Log END

                $this->session->setFlashdata('pesan_sukses', 'Pembuatan Pembayaran SPP oleh Admin Berhasil.');
                return redirect()->to('tambah_bayar_spp');
            }
    }

    public function tambah_bayar_lain()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('login');
        }
        
        $peserta            = $this->peserta->list();

        $data = [
            'title'         => 'Al-Haqq - Tambah Pembayaran Infaq & Lainnya Peserta',
            'peserta'       => $peserta,
        ];
        //var_dump($cek);
        return view('auth/pembayaran/tambah_bayar_lain', $data);
    }

    public function simpan_bayar_lain()
    {
            $validation = \Config\Services::validation();

            //Get Tgl Today
            $tgl = date("Y-m-d");
            $waktu = date("H:i:s");
            $strwaktu = date("H-i-s");

            $valid = $this->validate([
                'peserta_id' => [
                    'label' => 'peserta_id',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'awal_bayar' => [
                    'label' => 'awal_bayar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'infaq' => [
                    'label' => 'infaq',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'lain' => [
                    'label' => 'lain',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'status_bayar_admin' => [
                    'label' => 'status_bayar_admin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'foto' => [
                    'rules' => 'uploaded[foto]|mime_in[foto,image/png,image/jpg,image/jpeg]|is_image[foto]',
                    'errors' => [
                        'mime_in' => 'Harus gambar!'
                    ]
                ]
            ]);

            if (!$valid) {
                $this->session->setFlashdata('pesan_eror', 'ERROR! Seluruh Form Input Bertanda * Wajib Diisi dan Harap Upload Bukti Bayar!');
                return redirect()->to('tambah_bayar_lain');
            } else {

                //Admin input
                $validator          = session()->get('username');

                //Get inputan peserta, kelas, status bayar dan keterangan admin
                $peserta_id         = $this->request->getVar('peserta_id');
                $status_bayar_admin = $this->request->getVar('status_bayar_admin');
                $keterangan_admin   = strtoupper($this->request->getVar('keterangan_admin'));

                $get_data_peserta       = $this->peserta->find($peserta_id);
                $nama_peserta           = $get_data_peserta['nama_peserta'];
                $nis                    = $get_data_peserta['nis'];
                
                // get file foto from input
                $filefoto = $this->request->getFile('foto');
                // ambil nama file
                $namafoto = $filefoto->getName();
                // nama foto baru
                $namafoto_new = $nama_peserta . '_'. $tgl . '_' . $strwaktu .'_'. $namafoto;
                
                //Get nominal (on rupiah curenncy format) input from view
                 $get_awal_bayar    = $this->request->getVar('awal_bayar');
                 $get_bayar_infaq   = $this->request->getVar('infaq');
                 $get_bayar_lain    = $this->request->getVar('lain');

                 //Replace Rp. and thousand separtor from input
                 $awal_bayar_int      = str_replace(str_split('Rp. .'), '', $get_awal_bayar);
                 $bayar_infaq_int     = str_replace(str_split('Rp. .'), '', $get_bayar_infaq);
                 $bayar_lain_int      = str_replace(str_split('Rp. .'), '', $get_bayar_lain);

                 //Get Data from Input view
                 $awal_bayar         = $awal_bayar_int;
                 $bayar_infaq        = $bayar_infaq_int;
                 $bayar_lain         = $bayar_lain_int;

                $data_bayar = [
                    'bayar_peserta_id'          => $peserta_id,
                    'status_bayar'              => 'Lunas',
                    'status_bayar_admin'        => $status_bayar_admin,
                    'status_konfirmasi'         => 'Terkonfirmasi',
                    'awal_bayar'                => $awal_bayar,
                    'awal_bayar_daftar'         => '0',
                    'awal_bayar_infaq'          => $bayar_infaq,
                    'awal_bayar_spp1'           => '0',
                    'awal_bayar_spp2'           => '0',
                    'awal_bayar_spp3'           => '0',
                    'awal_bayar_spp4'           => '0',
                    'awal_bayar_modul'          => '0',
                    'awal_bayar_lainnya'        => $bayar_lain,
                    'bukti_bayar'               => $namafoto_new,
                    'tgl_bayar'                 => $tgl,
                    'waktu_bayar'               => $waktu,
                    'keterangan_bayar_admin'    => $keterangan_admin,
                    'tgl_bayar_konfirmasi'      => $tgl,
                    'waktu_bayar_konfirmasi'    => $waktu,
                    'nominal_bayar'             => $awal_bayar,
                    'validator'                 => $validator,
                ];

                //Simpan data pembayaran
                $this->program_bayar->insert($data_bayar);


                $filefoto->move('img/transfer/', $namafoto_new);

                // Get last id insert from program bayar
                $pembayaran_last_id = $this->program_bayar->insertID();

                //Cek isian form untuk infaq
                if($bayar_infaq != 0){
                    $data_infaq = [
                        'infaq_bayar_id'        => $pembayaran_last_id,
                        'bayar_infaq'           => $bayar_infaq,
                        'data_peserta_id_infaq' => $peserta_id,
                    ];
                    $this->infaq->insert($data_infaq);
                }

                //Cek isian form untuk lain
                if($bayar_lain != 0){
                    $data_lain = [
                        'lainnya_bayar_id'        => $pembayaran_last_id,
                        'bayar_lainnya'           => $bayar_lain,
                        'data_peserta_id_lain'    => $peserta_id,
                        'status_bayar_lainnya'    => 'Lunas',
                    ];
                    $this->bayar_lain->insert($data_lain);
                }

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Buat Data Pembayaran Infaq & Lain Atas Nama Peserta : ' . $nis . ' - ' . $nama_peserta,
                ];
                $this->log->insert($log);
                // Data Log END

                $this->session->setFlashdata('pesan_sukses', 'Pembuatan Pembayaran Infaq & Pembayaran Lain oleh Admin Berhasil.');
                return redirect()->to('tambah_bayar_lain');
            }
    }

}
