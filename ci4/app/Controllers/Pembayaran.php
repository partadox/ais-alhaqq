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
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
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
                'bayar_infaq' => [
                    'label' => 'bayar_infaq',
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
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nominal_bayar' => $validation->getError('nominal_bayar'),
                        'bayar_daftar'  => $validation->getError('bayar_daftar'),
                        'bayar_spp1'    => $validation->getError('bayar_spp1'),
                        'bayar_infaq'   => $validation->getError('bayar_infaq'),
                        'bayar_spp2'    => $validation->getError('bayar_spp2'),
                        'bayar_spp3'    => $validation->getError('bayar_spp3'),
                        'bayar_spp4'    => $validation->getError('bayar_spp4'),
                    ]
                ];
            } else {

                //Get nominal (on rupiah curenncy format) input from view
                $get_nominal_bayar = $this->request->getVar('nominal_bayar');
                $get_bayar_daftar  = $this->request->getVar('bayar_daftar');
                $get_bayar_spp1    = $this->request->getVar('bayar_spp1');
                $get_bayar_infaq   = $this->request->getVar('bayar_infaq');
                $get_bayar_spp2    = $this->request->getVar('bayar_spp2');
                $get_bayar_spp3    = $this->request->getVar('bayar_spp3');
                $get_bayar_spp4    = $this->request->getVar('bayar_spp4');

                //Replace Rp. and thousand separtor from input
                $nominal_bayar_int   = str_replace(str_split('Rp. .'), '', $get_nominal_bayar);
                $bayar_daftar_int    = str_replace(str_split('Rp. .'), '', $get_bayar_daftar);
                $bayar_spp1_int      = str_replace(str_split('Rp. .'), '', $get_bayar_spp1);
                $bayar_infaq_int     = str_replace(str_split('Rp. .'), '', $get_bayar_infaq);
                $bayar_spp2_int      = str_replace(str_split('Rp. .'), '', $get_bayar_spp2);
                $bayar_spp3_int      = str_replace(str_split('Rp. .'), '', $get_bayar_spp3);
                $bayar_spp4_int      = str_replace(str_split('Rp. .'), '', $get_bayar_spp4);

                //Get Data from Input view
                $nominal_bayar      = $nominal_bayar_int;
                $bayar_daftar       = $bayar_daftar_int;
                $bayar_spp1         = $bayar_spp1_int;
                $bayar_infaq        = $bayar_infaq_int;
                $bayar_spp2         = $bayar_spp2_int;
                $bayar_spp3         = $bayar_spp3_int;
                $bayar_spp4         = $bayar_spp4_int;

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
                if($bayar_daftar != 0 || $bayar_spp1 != 0){
                    $data_spp1 = [
                        'spp1_bayar_id' => $bayar_id,
                        'bayar_daftar' => $bayar_daftar,
                        'bayar_spp1'   => $bayar_spp1,
                        'status_spp1'  => 'Lunas',
                    ];

                    $datakelas = [
                        'sisa_kouta'      => $kouta_kurang,
                    ];
        
                    $datapesertakelas = [
                        'data_peserta_id'       => $peserta_id,
                        'data_kelas_id'         => $kelas_id,
                        'status_peserta_kelas'  => 'Belum Lulus'
                    ];
                    $this->spp1->insert($data_spp1);
                    $this->program->update($kelas_id, $datakelas);
                    $this->peserta_kelas->insert($datapesertakelas);
                }

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
                }

                //Cek isian form untuk spp3
                if($bayar_spp3 != 0){
                    $data_spp3 = [
                        'spp3_bayar_id'    => $bayar_id,
                        'bayar_spp3'       => $bayar_spp3,
                        'status_spp3'      => 'Lunas',
                    ];
                    $this->spp3->insert($data_spp3);
                }

                //Cek isian form untuk spp4
                if($bayar_spp4 != 0){
                    $data_spp4 = [
                        'spp4_bayar_id'    => $bayar_id,
                        'bayar_spp4'       => $bayar_spp4,
                        'status_spp4'      => 'Lunas',
                    ];
                    $this->spp4->insert($data_spp4);
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
}
