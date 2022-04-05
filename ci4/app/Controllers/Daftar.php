<?php

namespace App\Controllers;

use Config\Services;

class Daftar extends BaseController
{
    public function index()
    {
        $data = [
            'title'           => 'Al-Haqq - Pendaftaran Peserta Baru',
            'tampil_ondaftar' => $this->level->list_tampil_ondaftar(),
            'kantor'          => $this->kantor_cabang->list(),
        ];
        return view('auth/daftar/index', $data);
    }

    // Simpan Daftar Profil Peserta Baru
    public function simpandaftar()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'asal_cabang_peserta' => [
                    'label' => 'asal_cabang_peserta',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nik' => [
                    'label' => 'nik',
                    'rules' => 'required|is_unique[peserta.nik]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} harus unik, sudah ada yang menggunakan {field} ini',
                    ]
                ],
                'tmp_lahir' => [
                    'label' => 'tmp_lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tgl_lahir' => [
                    'label' => 'tgl_lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jenkel' => [
                    'label' => 'jenkel',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'pendidikan' => [
                    'label' => 'pendidikan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jurusan' => [
                    'label' => 'jurusan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'status_kerja' => [
                    'label' => 'status_kerja',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'pekerjaan' => [
                    'label' => 'pekerjaan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'hp' => [
                    'label' => 'hp',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'email' => [
                    'label' => 'email',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'domisili_peserta' => [
                    'label' => 'domisili_peserta',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'alamat' => [
                    'label' => 'alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama'              => $validation->getError('nama'),
                        'asal_cabang_peserta' => $validation->getError('asal_cabang_peserta'),
                        'nik'               => $validation->getError('nik'),
                        'tmp_lahir'         => $validation->getError('tmp_lahir'),
                        'tgl_lahir'         => $validation->getError('tgl_lahir'),
                        'jenkel'            => $validation->getError('jenkel'),
                        'pendidikan'        => $validation->getError('pendidikan'),
                        'jurusan'           => $validation->getError('jurusan'),
                        'status_kerja'      => $validation->getError('status_kerja'),
                        'pekerjaan'         => $validation->getError('pekerjaan'),
                        'hp'                => $validation->getError('hp'),
                        'email'             => $validation->getError('email'),
                        'domisili_peserta'  => $validation->getError('domisili_peserta'),
                        'alamat'            => $validation->getError('alamat'),
                        // 'level_peserta'  => $validation->getError('level_peserta'),
                        
                    ]
                ];
            } else {
                
                $get_angkatan = $this->konfigurasi->angkatan_kuliah();
                $angkatan     = $get_angkatan->angkatan_kuliah;

                $simpandata = [
                    'user_id'               => $this->request->getVar('user_id'),
                    'angkatan'              => $angkatan,
                    'nama_peserta'          => strtoupper($this->request->getVar('nama')),
                    'asal_cabang_peserta'   => $this->request->getVar('asal_cabang_peserta'),
                    'nis'                   => $this->request->getVar('nis'),
                    'nik'                   => $this->request->getVar('nik'),
                    'tmp_lahir'             => strtoupper($this->request->getVar('tmp_lahir')),
                    'tgl_lahir'             => $this->request->getVar('tgl_lahir'),
                    'jenkel'                => $this->request->getVar('jenkel'),
                    'pendidikan'            => $this->request->getVar('pendidikan'),
                    'jurusan'               => strtoupper($this->request->getVar('jurusan')),
                    'status_kerja'          => $this->request->getVar('status_kerja'),
                    'pekerjaan'             => $this->request->getVar('pekerjaan'),
                    'hp'                    => $this->request->getVar('hp'),
                    'email'                 => strtolower($this->request->getVar('email')),
                    'domisili_peserta'      => $this->request->getVar('domisili_peserta'),
                    'alamat'                => strtoupper($this->request->getVar('alamat')),
                    'status_peserta'        => 'AKTIF',
                    'tgl_gabung'            => date("Y-m-d"),
                    // 'level_peserta'         => $this->request->getVar('level_peserta'),
                ];

                $data_active = [
                    'active'      => '1',
                ];

                $this->peserta->insert($simpandata);
                //var_dump($simpandata);
                $user_id = $this->request->getVar('user_id');
                $this->user->update($user_id, $data_active);
                $msg = [
                    'sukses' => [
                        'link' => 'dashboard'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    // Simpan Daftar Level Kelas Peserta Baru - Di Halaman Memilih Program & Jadwal
    public function simpandaftar_level()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'level_peserta' => [
                    'label' => 'level_peserta',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Harap Memilih Level Kelas',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'level_peserta'  => $validation->getError('level_peserta'),
                        
                    ]
                ];
            } else {
                $simpandata = [
                    'level_peserta'        => $this->request->getVar('level_peserta'),
                ];

                $peserta_id  = $this->request->getVar('peserta_id');

                $this->peserta->update($peserta_id, $simpandata);
                $msg = [
                    'sukses' => [
                        'link' => 'program'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    // Tampil Seluruh Jadwal Kelas berdasarkan filter (level, jenkel, status kerja)
    public function program()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('login');
        }

        //Get All Data Peserta
        $user_id = session()->get('user_id');
        $get_peserta = $this->peserta->get_peserta($user_id);

        //Get data peserta id
        $get_peserta_id = $this->peserta->get_peserta_id($user_id);
        $peserta_id = $get_peserta_id->peserta_id;

        //Get data peserta level - FILTER PESERTA LEVEL
        $get_peserta_level = $this->peserta->get_peserta_level($user_id);
        $peserta_level = $get_peserta_level->level_peserta;

        //Get data peserta jenis kelamin - FILTER PESERTA JENIS KELAMIN
        $get_peserta_jenkel = $this->peserta->get_peserta_jenkel($user_id);
        $peserta_jenkel = $get_peserta_jenkel->jenkel;

        //Get data peserta jenis kelamin - FILTER STATUS BEKERJA (0=TIDAK KERJA, 1=KERJA)
        $get_peserta_status_kerja = $this->peserta->get_peserta_status_kerja($user_id);
        $peserta_status_kerja = $get_peserta_status_kerja->status_kerja;

        //Get data peserta jenis kelamin - FILTER PESERTA DOMISILI
        $get_peserta_domisili = $this->peserta->get_peserta_domisili($user_id);
        $peserta_domisili = $get_peserta_domisili->domisili_peserta;

        //Jika status bukan pekerja maka akan tampil kelas dengan status_kerja = 0 (Kelas di Weekdays saja)
        //Else status pekerja maka akan tampil kelas dengan status_kerja 1 dan 0 (Weekdays dan Weekend Akan Tampil)

        //Aktif Filter Pencocokan Domisili dengan Metode Perkuliahahn
        $get_filter_domisili = $this->konfigurasi->filter_domisili();
        $filter_domisili    = $get_filter_domisili->filter_domisili;
        // MAIN FILTER FUNGSI

        if ($filter_domisili == 'AKTIF') {
            if($peserta_status_kerja == 0){
                if ($peserta_domisili == 'BALIKPAPAN') {
                    //Filter -> 1.level, 2.jenkel, 3.kerja=tidak, 4.domisili=balikpapan
                    $program = $this->program->aktif_balikpapan($peserta_level, $peserta_jenkel, $peserta_status_kerja);
                } else {
                    //Filter -> 1.level, 2.jenkel, 3.kerja=tidak, 4.domisili=luar
                    $program = $this->program->aktif($peserta_level, $peserta_jenkel, $peserta_status_kerja);
                }
                    
            }else{
                if ($peserta_domisili == "BALIKPAPAN") {
                    //Filter -> 1.level, 2.jenkel, 3.kerja=ya, 4.domisili=balikpapan
                    $program = $this->program->aktif_pekerja_balikpapan($peserta_level, $peserta_jenkel);
                } else {
                    //Filter -> 1.level, 2.jenkel, 3.kerja=ya, 4.domisili=luar
                    $program = $this->program->aktif_pekerja($peserta_level, $peserta_jenkel);
                }
            } 
        } elseif ($filter_domisili == 'NONAKTIF') {
            if($peserta_status_kerja == 0){
                //Filter -> 1.level, 2.jenkel, 3.kerja=tidak
                $program = $this->program->aktif_nodomisili($peserta_level, $peserta_jenkel, $peserta_status_kerja);
            }else{
                //Filter -> 1.level, 2.jenkel, 3.kerja=ya
                $program = $this->program->aktif_pekerja_nodomisili($peserta_level, $peserta_jenkel);
            }
        }

        

        //Cek Status Pendaftarn
        $get_status_daftar = $this->konfigurasi->status_pendaftaran();
        $status_daftar     = $get_status_daftar->status_pendaftaran;
        // Cek ada data yang belum dibayar
        $cek1 = $this->program_bayar->cek_belum_lunas($peserta_id);
        // Cek Sudah punya kelas belum
        //$cek2 = $this->peserta_kelas->cek_peserta_kelas($peserta_id);
        
        $data = [
            'title'              => 'Al-Haqq - Daftar Program',
            'tampil_ondaftar'    => $this->level->list_tampil_ondaftar(),
            'peserta'            => $get_peserta,
            'program'            => $program,
            'status_pendaftaran' => $status_daftar,
            'cek1'               => $cek1,
            //'cek2'               => $cek2,
        ];
        //var_dump($program);
        return view('auth/daftar/daftar', $data);
    }

    public function daftar_program()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
                $simpandata = [
                    'kelas_id'              => $this->request->getVar('kelas_id'),
                    'bayar_peserta_id'      => $this->request->getVar('peserta_id'),
                    'status_bayar'          => 'Belum Lunas',
                    'tgl_bayar'             => '1000-01-01',
                    'tgl_bayar_konfirmasi'  => '1000-01-01',
                    'waktu_bayar'           => '00:00:00',
                    'waktu_bayar_konfirmasi'=> '00:00:00',
                    'bukti_bayar'           => 'default.png',
                ];
                //var_dump($simpandata);
                $this->program_bayar->insert($simpandata);
                $msg = [
                    'sukses' => [
                        'link' => 'bayar'
                    ]
                ];
            echo json_encode($msg);
        }
    }

    public function bayar()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('login');
        }

        //Get data peserta
        $user_id = session()->get('user_id');
        $get_peserta = $this->peserta->get_peserta_id($user_id);
        $peserta_id = $get_peserta->peserta_id;

        // Get Data peserta, program, kelas, bayar
        $program_bayar = $this->program_bayar->belum_lunas($peserta_id);
        //$bayar_awal = $program_bayar[0]['bayar_id'];
        
        // Cek ada data yang belum dibayar
        $cek1 = $this->program_bayar->cek_belum_lunas($peserta_id);

        $data = [
            'title'         => 'Al-Haqq - Bayar Daftar Program',
            'peserta'       => $get_peserta,
            'program_bayar' => $program_bayar,
            //'bayar_lunas'   => $bayar_lunas,
            'cek1'           => $cek1,
            'bank'           => $this->bank->list(),
        ];
        //var_dump($cek);
        return view('auth/daftar/bayar', $data);
    }

    public function bayarprogram()
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
                'foto' => [
                    'rules' => 'uploaded[foto]|mime_in[foto,image/png,image/jpg,image/jpeg]|is_image[foto]',
                    'errors' => [
                        'mime_in' => 'Harus gambar!'
                    ]
                ]
            ]);

            if (!$valid) {
                $this->session->setFlashdata('pesan_eror', 'ERROR! Seluruh Form Input Bertanda * Wajib Diisi dan Harap Upload Bukti Bayar!');
                return redirect()->to('bayar');
            } else {

                // get file foto from input
                $filefoto = $this->request->getFile('foto');
                // ambil nama file
                $namafoto = $filefoto->getName();
                // nama foto baru
                $namafoto_new = $user_nama . '_'. $tgl . '_' . $strwaktu .'_'. $namafoto;
                
                //Get nominal (on rupiah curenncy format) input from view
                 $get_awal_bayar         = $this->request->getVar('awal_bayar');
                 $get_awal_bayar_daftar  = $this->request->getVar('daftar');
                 $get_awal_bayar_spp1    = $this->request->getVar('spp1');
                 $get_awal_bayar_spp2    = $this->request->getVar('spp2');
                 $get_awal_bayar_spp3    = $this->request->getVar('spp3');
                 $get_awal_bayar_spp4    = $this->request->getVar('spp4');
                 $get_awal_bayar_infaq   = $this->request->getVar('infaq');
                 $get_awal_bayar_modul   = $this->request->getVar('modul');
                 $get_awal_bayar_lain    = $this->request->getVar('lain');

                 //Replace Rp. and thousand separtor from input
                 $awal_bayar_int           = str_replace(str_split('Rp. .'), '', $get_awal_bayar);
                 $awal_bayar_daftar_int    = str_replace(str_split('Rp. .'), '', $get_awal_bayar_daftar);
                 $awal_bayar_spp1_int      = str_replace(str_split('Rp. .'), '', $get_awal_bayar_spp1);
                 $awal_bayar_spp2_int      = str_replace(str_split('Rp. .'), '', $get_awal_bayar_spp2);
                 $awal_bayar_spp3_int      = str_replace(str_split('Rp. .'), '', $get_awal_bayar_spp3);
                 $awal_bayar_spp4_int      = str_replace(str_split('Rp. .'), '', $get_awal_bayar_spp4);
                 $awal_bayar_infaq_int     = str_replace(str_split('Rp. .'), '', $get_awal_bayar_infaq);
                 $awal_bayar_modul_int     = str_replace(str_split('Rp. .'), '', $get_awal_bayar_modul);
                 $awal_bayar_lain_int      = str_replace(str_split('Rp. .'), '', $get_awal_bayar_lain);

                 //Get Data from Input view
                 $bayar_id                = $this->request->getVar('bayar_id');
                 $awal_bayar              = $awal_bayar_int;
                 $awal_bayar_daftar       = $awal_bayar_daftar_int;
                 $awal_bayar_spp1         = $awal_bayar_spp1_int;
                 $awal_bayar_spp2         = $awal_bayar_spp2_int;
                 $awal_bayar_spp3         = $awal_bayar_spp3_int;
                 $awal_bayar_spp4         = $awal_bayar_spp4_int;
                 $awal_bayar_infaq        = $awal_bayar_infaq_int;
                 $awal_bayar_modul        = $awal_bayar_modul_int;
                 $awal_bayar_lain         = $awal_bayar_lain_int;


                $data_bayar = [
                    'status_konfirmasi'         => 'Proses',
                    'awal_bayar'                => $awal_bayar,
                    'awal_bayar_daftar'         => $awal_bayar_daftar,
                    'awal_bayar_infaq'          => $awal_bayar_infaq,
                    'awal_bayar_spp1'           => $awal_bayar_spp1,
                    'awal_bayar_spp2'           => $awal_bayar_spp2,
                    'awal_bayar_spp3'           => $awal_bayar_spp3,
                    'awal_bayar_spp4'           => $awal_bayar_spp4,
                    'awal_bayar_modul'          => $awal_bayar_modul,
                    'awal_bayar_lainnya'        => $awal_bayar_lain,
                    'bukti_bayar'               => $namafoto_new,
                    'tgl_bayar'                 => $tgl,
                    'waktu_bayar'               => $waktu,
                    'keterangan_bayar'          => strtoupper($this->request->getVar('keterangan_bayar')),
                    'tgl_bayar_konfirmasi'      => '1000-01-01',
                    'waktu_bayar_konfirmasi'    => '00:00:00',
                ];
                //var_dump($data_bayar);
                // update status konfirmasi
                $this->program_bayar->update($bayar_id, $data_bayar);

                // simpan file foto upload ke server
                // \Config\Services::image()
                //     ->withFile($filefoto)
                //     ->save('img/transer/' . $user_nama . '_' . $tgl . '_' .  $filefoto->getName());

                $filefoto->move('img/transfer/', $namafoto_new);
                $this->session->setFlashdata('pesan_sukses', 'Bukti Transfer Anda Berhasil Diupload. Silahkan Tunggu Proses Konfirmasi dari Admin.');
                return redirect()->to('bayar');
            }
            echo json_encode($msg);
    }

    public function batal()
    {
            $bayar_id = $this->request->getVar('hapus_bayar');
            $this->program_bayar->delete($bayar_id);
            return redirect()->to('/daftar/program');
    }

    public function batalprogram()
    {
        if ($this->request->isAJAX()) {

            $bayar_id = $this->request->getVar('bayar_id');

            $this->program_bayar->delete($bayar_id);
            $msg = [
                'sukses' => [
                    'link' => 'program'
                ]
            ];
            echo json_encode($msg);
        }
    }

}
