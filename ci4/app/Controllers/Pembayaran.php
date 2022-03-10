<?php

namespace App\Controllers;

use Config\Services;

class Pembayaran extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Al-Haqq - Seluruh Data Pembayaran',
            'list'  => $this->program_bayar->list(),
        ];
        return view('auth/pembayaran/index', $data);
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

            $bayar_id = $this->request->getVar('bayar_id');
            $kelas_id = $this->request->getVar('kelas_id');
            $peserta_id = $this->request->getVar('peserta_id');

            //Get data sisa kouta dari tabel program_kelas
            $get_sisa_kouta = $this->program->get_sisa_kouta($kelas_id);
            $sisa_kouta = $get_sisa_kouta->sisa_kouta;

            //Pengurangan Kouta
            $minus1 = 1;
            $kouta_kurang = $sisa_kouta - $minus1;

            //Get data sisa kouta dari tabel program_kelas
            $get_jml_peserta = $this->program->get_jumlah_peserta($kelas_id);
            $jumlah_peserta = $get_jml_peserta ->jumlah_peserta;

            //Pengurangan Kouta
            $plus1 = 1;
            $tambah_peserta = $jumlah_peserta + $plus1;

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
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nominal_bayar' => $validation->getError('nominal_bayar'),
                        'bayar_daftar'  => $validation->getError('bayar_daftar'),
                        'bayar_spp1'    => $validation->getError('bayar_spp1'),
                        'bayar_spp2'    => $validation->getError('bayar_spp2'),
                        'bayar_spp3'    => $validation->getError('bayar_spp3'),
                        'bayar_spp4'    => $validation->getError('bayar_spp4'),
                        'bayar_infaq'   => $validation->getError('bayar_infaq'),
                        'bayar_modul'   => $validation->getError('bayar_modul'),
                        'bayar_lain'    => $validation->getError('bayar_lain'),
                    ]
                ];
            } else {

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
                    'nominal_bayar'             => $nominal_bayar,
                    'tgl_bayar_konfirmasi'      => $tgl,
                    'waktu_bayar_konfirmasi'    => $waktu,
                    'validator'                 => $validator,
                ];
                //Simpan update program_bayar 
                $this->program_bayar->update($bayar_id, $databayar);
                
                //Cek isian form untuk daftar dan spp1
                if($bayar_daftar != 0 && $bayar_spp1 != 0){
                    $data_spp1 = [
                        'spp1_bayar_id' => $bayar_id,
                        'bayar_daftar'  => $bayar_daftar,
                        'bayar_spp1'    => $bayar_spp1,
                        'status_spp1'   => 'Lunas',
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
                    $last_id = $this->absen_peserta->insertID();
        
                    $datapesertakelas = [
                        'data_peserta_id'       => $peserta_id,
                        'data_kelas_id'         => $kelas_id,
                        'data_absen'            => $last_id,
                        'status_peserta_kelas'  => 'Belum Lulus',
                        'byr_daftar'            => '1',
                        'byr_spp1'              => '1',
                    ];

                    $this->spp1->insert($data_spp1);
                    $this->program->update($kelas_id, $datakelas);
                    $this->peserta_kelas->insert($datapesertakelas);

                    // Get last id insert from peserta kelas
                    $last_id_psrt_kls = $this->peserta_kelas->insertID();

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
                        $data_update_spp2 = ['byr_spp2' => '1'];
                        $this->peserta_kelas->update($last_id_psrt_kls, $data_update_spp2);
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
                        $data_update_spp3 = ['byr_spp3' => '1'];
                        $this->peserta_kelas->update($last_id_psrt_kls, $data_update_spp3);
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
                        $data_update_spp4 = ['byr_spp4' => '1'];
                        $this->peserta_kelas->update($last_id_psrt_kls, $data_update_spp4);
                    }

                    //Cek isian form untuk modul
                    if($bayar_modul != 0){
                        $data_modul = [
                            'bayar_modul_id'        => $bayar_id,
                            'bayar_modul'           => $bayar_modul,
                            'status_bayar_modul'    => 'Lunas',
                        ];
                        $this->bayar_modul->insert($data_modul);

                        // Update status bayar pada tabel peserta kelas
                        $data_update_modul = ['byr_modul' => '1'];
                        $this->peserta_kelas->update($last_id_psrt_kls, $data_update_modul);
                    } elseif ($bayar_modul == 0) {
                        // Update status bayar pada tabel peserta kelas
                        $data_update_modul = ['byr_modul' => '0'];
                        $this->peserta_kelas->update($last_id_psrt_kls, $data_update_modul);
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

                } elseif ($bayar_daftar == 0 && $bayar_spp1 == 0) {
                    // Get id from peserta kelas
                    $id_psrt_kls = $this->request->getVar('peserta_kelas_id');

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
                        $data_update_spp2 = ['byr_spp2' => '1'];
                        $this->peserta_kelas->update($id_psrt_kls, $data_update_spp2);
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
                        $data_update_spp3 = ['byr_spp3' => '1'];
                        $this->peserta_kelas->update($id_psrt_kls, $data_update_spp3);
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
                        $data_update_spp4 = ['byr_spp4' => '1'];
                        $this->peserta_kelas->update($id_psrt_kls, $data_update_spp4);
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
                    'aktivitas_log'=> 'Konfirmasi Pembayaran ID ' . $bayar_id,
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

    public function peserta_bayar_spp()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('login');
        }

        //Get data peserta
        $user_id = session()->get('user_id');
        $get_peserta = $this->peserta->get_peserta_id($user_id);
        $peserta_id = $get_peserta->peserta_id;

        // Get peserta_kelas_id yang belum lulus 
        $psrt_kls_id = $this->peserta_kelas->list_kelas_peserta_belum_lulus($peserta_id);


        $data = [
            'title'         => 'Al-Haqq - Pembayaran SPP',
            'kelas'         => $psrt_kls_id,
        ];
        //var_dump($cek);
        return view('auth/pembayaran/bayar_spp_peserta', $data);
    }



}
