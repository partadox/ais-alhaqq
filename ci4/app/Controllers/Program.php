<?php

namespace App\Controllers;

use Config\Services;

class Program extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Al-Haqq - Program',
            'list' => $this->program_data->list()
        ];
        return view('auth/program/index', $data);
    }

    public function input_atur_pendaftaran()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'title'   => 'Form Pengaturan Pembukaan Pendaftaran Program',
                'konfig'  => $this->konfigurasi->list()
            ];
            $msg = [
                'sukses' => view('auth/program_kelas/atur_daftar', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_atur_pendaftaran()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'angkatan_kuliah' => [
                    'label' => 'angkatan_kuliah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'status_pendaftaran' => [
                    'label' => 'status_pendaftaran',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'angkatan_kuliah'        => $validation->getError('angkatan_kuliah'),
                        'status_pendaftaran'     => $validation->getError('status_pendaftaran'),
                    ]
                ];
            } else {

                $angkatan_kuliah = $this->request->getVar('angkatan_kuliah');
                $status_daftar   = $this->request->getVar('status_pendaftaran');

                $data = [
                    'angkatan_kuliah'            => $angkatan_kuliah,
                    'status_pendaftaran'         => $status_daftar,
                ];

                $konfig_id = 1;

                $this->konfigurasi->update($konfig_id, $data);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Ubah Pengaturan Pendaftarn Menjadi : ' .   $status_daftar . 'Angkatan Perkuliahan : ' . $angkatan_kuliah,
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'kelas'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function input_program()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'title'      => 'Form Input Program Baru',
            ];
            $msg = [
                'sukses' => view('auth/program/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_program()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_program' => [
                    'label' => 'nama_program',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jenis_program' => [
                    'label' => 'jenis_program',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'biaya_program' => [
                    'label' => 'biaya_program',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'biaya_bulanan' => [
                    'label' => 'biaya_bulanan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'biaya_daftar' => [
                    'label' => 'biaya_daftar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'biaya_modul' => [
                    'label' => 'biaya_modul',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'status_program' => [
                    'label' => 'status_program',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_program'   => $validation->getError('nama_program'),
                        'jenis_program'  => $validation->getError('jenis_program'),
                        'biaya_program'  => $validation->getError('biaya_program'),
                        'biaya_bulanan'  => $validation->getError('biaya_bulanan'),
                        'biaya_daftar'   => $validation->getError('biaya_daftar'),
                        'biaya_modul'    => $validation->getError('biaya_modul'),
                        'status_program' => $validation->getError('status_program'),
                    ]
                ];
            } else {

                //Get data nominal rupiah
                $get_biaya_program  = $this->request->getVar('biaya_program');
                $get_biaya_daftar   = $this->request->getVar('biaya_daftar');
                $get_biaya_bulanan  = $this->request->getVar('biaya_bulanan');
                $get_biaya_modul    = $this->request->getVar('biaya_modul');

                //Replace Rp. and thousand separtor from input
                $biaya_program_int   = str_replace(str_split('Rp. .'), '', $get_biaya_program);
                $biaya_daftar_int    = str_replace(str_split('Rp. .'), '', $get_biaya_daftar);
                $biaya_bulanan_int   = str_replace(str_split('Rp. .'), '', $get_biaya_bulanan);
                $biaya_modul_int     = str_replace(str_split('Rp. .'), '', $get_biaya_modul);

                //Variable int nominal rupiah
                $biaya_program  = $biaya_program_int;
                $biaya_daftar   = $biaya_daftar_int;
                $biaya_bulanan  = $biaya_bulanan_int;
                $biaya_modul    = $biaya_modul_int;

                $simpandata = [
                    'nama_program'    => strtoupper($this->request->getVar('nama_program')),
                    'jenis_program'   => $this->request->getVar('jenis_program'),
                    'kategori_program'=> $this->request->getVar('kategori_program'),
                    'biaya_program'   => $biaya_program,
                    'biaya_bulanan'   => $biaya_bulanan,
                    'biaya_daftar'    => $biaya_daftar,
                    'biaya_modul'     => $biaya_modul, 
                    'status_program'  => $this->request->getVar('status_program'),
                ];

                $this->program_data->insert($simpandata);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Buat Data Program Nama : ' .  $this->request->getVar('nama_program'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'program'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function edit_program()
    {
        if ($this->request->isAJAX()) {

            $program_id = $this->request->getVar('program_id');
            $program    =  $this->program_data->find($program_id);
            $data = [
                'title'             => 'Ubah Data Program',
                'program_id'        => $program['program_id'],
                'nama_program'      => $program['nama_program'],
                'jenis_program'     => $program['jenis_program'],
                'kategori_program'  => $program['kategori_program'],
                'biaya_program'     => $program['biaya_program'],
                'biaya_daftar'      => $program['biaya_daftar'],
                'biaya_bulanan'     => $program['biaya_bulanan'],
                'biaya_modul'       => $program['biaya_modul'],
                'status_program'    => $program['status_program'],
            ];
            $msg = [
                'sukses' => view('auth/program/edit_program', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update_program()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_program' => [
                    'label' => 'nama_program',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jenis_program' => [
                    'label' => 'jenis_program',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'biaya_program' => [
                    'label' => 'biaya_program',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'biaya_bulanan' => [
                    'label' => 'biaya_bulanan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'biaya_daftar' => [
                    'label' => 'biaya_daftar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'biaya_modul' => [
                    'label' => 'biaya_modul',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'status_program' => [
                    'label' => 'status_program',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_program'   => $validation->getError('nama_program'),
                        'jenis_program'  => $validation->getError('jenis_program'),
                        'biaya_program'  => $validation->getError('biaya_program'),
                        'biaya_bulanan'  => $validation->getError('biaya_bulanan'),
                        'biaya_daftar'   => $validation->getError('biaya_daftar'),
                        'biaya_modul'    => $validation->getError('biaya_modul'),
                        'status_program' => $validation->getError('status_program'),
                    ]
                ];
            } else {

                //Get data nominal rupiah
                $get_biaya_program  = $this->request->getVar('biaya_program');
                $get_biaya_daftar   = $this->request->getVar('biaya_daftar');
                $get_biaya_bulanan  = $this->request->getVar('biaya_bulanan');
                $get_biaya_modul    = $this->request->getVar('biaya_modul');

                //Replace Rp. and thousand separtor from input
                $biaya_program_int   = str_replace(str_split('Rp. .'), '', $get_biaya_program);
                $biaya_daftar_int    = str_replace(str_split('Rp. .'), '', $get_biaya_daftar);
                $biaya_bulanan_int   = str_replace(str_split('Rp. .'), '', $get_biaya_bulanan);
                $biaya_modul_int     = str_replace(str_split('Rp. .'), '', $get_biaya_modul);

                //Variable int nominal rupiah
                $biaya_program  = $biaya_program_int;
                $biaya_daftar   = $biaya_daftar_int;
                $biaya_bulanan  = $biaya_bulanan_int;
                $biaya_modul    = $biaya_modul_int;

                $updatedata = [
                    'nama_program'    => strtoupper($this->request->getVar('nama_program')),
                    'jenis_program'   => $this->request->getVar('jenis_program'),
                    'kategori_program'=> $this->request->getVar('kategori_program'),
                    'biaya_program'   => $biaya_program,
                    'biaya_bulanan'   => $biaya_bulanan,
                    'biaya_daftar'    => $biaya_daftar,
                    'biaya_modul'     => $biaya_modul,
                    'status_program'  => $this->request->getVar('status_program'),
                ];

                $program_id = $this->request->getVar('program_id');
                $this->program_data->update($program_id, $updatedata);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Ubah Data Program Nama : ' .  $this->request->getVar('nama_program'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'program'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function kelas()
    {
        $data = [
            'title'             => 'Al-Haqq - Kelas',
            'list'              => $this->program->list(),
        ];
        //var_dump($data);
        return view('auth/program_kelas/index', $data);
    }

    public function input_kelas()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'title'     => 'Form Input Kelas Baru',
                'program'   => $this->program_data->list_aktif(),
                'pengajar'  => $this->pengajar->list(),
                'level'     => $this->level->list(),
            ];
            $msg = [
                'sukses' => view('auth/program_kelas/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_kelas()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'program_id' => [
                    'label' => 'program_id',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nama_kelas' => [
                    'label' => 'nama_kelas',
                    'rules' => 'required|is_unique[program_kelas.nama_kelas]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} harus unik, sudah ada yang menggunakan {field} ini',
                    ]
                ],
                'angkatan_kelas' => [
                    'label' => 'angkatan_kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'pengajar_id' => [
                    'label' => 'pengajar_id',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'hari_kelas' => [
                    'label' => 'hari_kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'waktu_kelas' => [
                    'label' => 'waktu_kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'zona_waktu_kelas' => [
                    'label' => 'zona_waktu_kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'peserta_level' => [
                    'label' => 'peserta_level',
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
                // 'status_kerja' => [
                //     'label' => 'status_kerja',
                //     'rules' => 'required',
                //     'errors' => [
                //         'required' => '{field} tidak boleh kosong',
                //     ]
                // ],
                'kouta' => [
                    'label' => 'kouta',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'metode_kelas' => [
                    'label' => 'metode_kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'status_kelas' => [
                    'label' => 'status_kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'program_id'        => $validation->getError('program_id'),
                        'nama_kelas'        => $validation->getError('nama_kelas'),
                        'angkatan_kelas'    => $validation->getError('angkatan_kelas'),
                        'pengajar_id'       => $validation->getError('pengajar_id'),
                        'hari_kelas'        => $validation->getError('hari_kelas'),
                        'waktu_kelas'       => $validation->getError('waktu_kelas'),
                        'zona_waktu_kelas'  => $validation->getError('zona_waktu_kelas'),
                        'peserta_level'     => $validation->getError('peserta_level'),
                        'jenkel'            => $validation->getError('jenkel'),
                        // 'status_kerja'      => $validation->getError('status_kerja'),
                        'kouta'             => $validation->getError('kouta'),
                        'metode_kelas'      => $validation->getError('metode_kelas'),
                        'status_kelas'      => $validation->getError('status_kelas'),
                    ]
                ];
            } else {
                
                $hari_kelas     = $this->request->getVar('hari_kelas');

                if($hari_kelas == 'SABTU' || $hari_kelas == 'MINGGU'){
                    $status_kerja   = '1';
                } else{
                    $status_kerja   = '0';
                }

                //Create data absen pengajar
                $dataabsen = [
                    'tgl_tm1'                     => '1000-01-01', 
                    'tgl_tm2'                     => '1000-01-01',
                    'tgl_tm3'                     => '1000-01-01',
                    'tgl_tm4'                     => '1000-01-01',
                    'tgl_tm5'                     => '1000-01-01',
                    'tgl_tm6'                     => '1000-01-01',
                    'tgl_tm7'                     => '1000-01-01',
                    'tgl_tm8'                     => '1000-01-01',
                    'tgl_tm9'                     => '1000-01-01',
                    'tgl_tm10'                    => '1000-01-01',
                    'tgl_tm11'                    => '1000-01-01',
                    'tgl_tm12'                    => '1000-01-01',
                    'tgl_tm13'                    => '1000-01-01',
                    'tgl_tm14'                    => '1000-01-01',
                    'tgl_tm15'                    => '1000-01-01',
                    'tgl_tm16'                    => '1000-01-01',
                ];

                $this->absen_pengajar->insert($dataabsen);

                //Create data absen pengajar
                $last_id = $this->absen_pengajar->insertID();

                $simpandata = [
                    'program_id'            => $this->request->getVar('program_id'),
                    'nama_kelas'            => strtoupper($this->request->getVar('nama_kelas')),
                    'angkatan_kelas'        => $this->request->getVar('angkatan_kelas'),
                    'pengajar_id'           => $this->request->getVar('pengajar_id'),
                    'data_absen_pengajar'   => $last_id,
                    'hari_kelas'            => $this->request->getVar('hari_kelas'),
                    'waktu_kelas'           => $this->request->getVar('waktu_kelas'),
                    'zona_waktu_kelas'      => $this->request->getVar('zona_waktu_kelas'),
                    'peserta_level'         => $this->request->getVar('peserta_level'),
                    'jenkel'                => $this->request->getVar('jenkel'),
                    'status_kerja'          => $status_kerja,
                    'kouta'                 => $this->request->getVar('kouta'),
                    'sisa_kouta'            => $this->request->getVar('kouta'),
                    'jumlah_peserta'        => '0',
                    'metode_kelas'          => $this->request->getVar('metode_kelas'),
                    'status_kelas'          => $this->request->getVar('status_kelas'),
                ];

                $this->program->insert($simpandata);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'BERHASIL - Buat Data Kelas Nama : ' .  $this->request->getVar('nama_kelas'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'kelas'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function edit_kelas()
    {
        if ($this->request->isAJAX()) {

            $kelas_id   = $this->request->getVar('kelas_id');
            $kelas      =  $this->program->find($kelas_id);
            $data = [
                'title'             => 'Ubah Data Kelas',
                'program'           => $this->program_data->list_aktif(),
                'pengajar'          => $this->pengajar->list(),
                'level'             => $this->level->list(),
                'kelas_id'          => $kelas['kelas_id'],
                'program_id'        => $kelas['program_id'],
                'peserta_level'     => $kelas['peserta_level'],
                'pengajar_id'       => $kelas['pengajar_id'],
                'nama_kelas'        => $kelas['nama_kelas'],
                'angkatan_kelas'    => $kelas['angkatan_kelas'],
                'hari_kelas'        => $kelas['hari_kelas'],
                'waktu_kelas'       => $kelas['waktu_kelas'],
                'zona_waktu_kelas'  => $kelas['zona_waktu_kelas'],
                'jenkel'            => $kelas['jenkel'],
                'kouta'             => $kelas['kouta'],
                'sisa_kouta'        => $kelas['sisa_kouta'],
                'metode_kelas'      => $kelas['metode_kelas'],
                'status_kelas'      => $kelas['status_kelas'],
            ];
            $msg = [
                'sukses' => view('auth/program_kelas/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update_kelas()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'program_id' => [
                    'label' => 'program_id',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nama_kelas' => [
                    'label' => 'nama_kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'angkatan_kelas' => [
                    'label' => 'angkatan_kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'pengajar_id' => [
                    'label' => 'pengajar_id',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'hari_kelas' => [
                    'label' => 'hari_kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'waktu_kelas' => [
                    'label' => 'waktu_kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'zona_waktu_kelas' => [
                    'label' => 'zona_waktu_kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'peserta_level' => [
                    'label' => 'peserta_level',
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
                'kouta' => [
                    'label' => 'kouta',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'sisa_kouta' => [
                    'label' => 'sisa_kouta',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'metode_kelas' => [
                    'label' => 'metode_kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'status_kelas' => [
                    'label' => 'status_kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'program_id'        => $validation->getError('program_id'),
                        'nama_kelas'        => $validation->getError('nama_kelas'),
                        'angkatan_kelas'    => $validation->getError('angkatan_kelas'),
                        'pengajar_id'       => $validation->getError('pengajar_id'),
                        'hari_kelas'        => $validation->getError('hari_kelas'),
                        'waktu_kelas'       => $validation->getError('waktu_kelas'),
                        'zona_waktu_kelas'  => $validation->getError('zona_waktu_kelas'),
                        'peserta_level'     => $validation->getError('peserta_level'),
                        'jenkel'            => $validation->getError('jenkel'),
                        'kouta'             => $validation->getError('kouta'),
                        'sisa_kouta'        => $validation->getError('sisa_kouta'),
                        'metode_kelas'      => $validation->getError('metode_kelas'),
                        'status_kelas'      => $validation->getError('status_kelas'),
                    ]
                ];
            } else {

                $hari_kelas     = $this->request->getVar('hari_kelas');

                if($hari_kelas == 'SABTU' || $hari_kelas == 'MINGGU'){
                    $status_kerja   = '1';
                } else{
                    $status_kerja   = '0';
                }

                $updatedata = [
                    'program_id'        => $this->request->getVar('program_id'),
                    'nama_kelas'        => strtoupper($this->request->getVar('nama_kelas')),
                    'angkatan_kelas'    => $this->request->getVar('angkatan_kelas'),
                    'pengajar_id'       => $this->request->getVar('pengajar_id'),
                    'hari_kelas'        => $this->request->getVar('hari_kelas'),
                    'waktu_kelas'       => $this->request->getVar('waktu_kelas'),
                    'zona_waktu_kelas'  => $this->request->getVar('zona_waktu_kelas'),
                    'peserta_level'     => $this->request->getVar('peserta_level'),
                    'jenkel'            => $this->request->getVar('jenkel'),
                    'status_kerja'      => $status_kerja,
                    'kouta'             => $this->request->getVar('kouta'),
                    'sisa_kouta'        => $this->request->getVar('sisa_kouta'),
                    'metode_kelas'      => $this->request->getVar('metode_kelas'),
                    'status_kelas'      => $this->request->getVar('status_kelas'),
                ];

                $kelas_id = $this->request->getVar('kelas_id');
                $this->program->update($kelas_id, $updatedata);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Ubah Data Kelas Nama : ' .  $this->request->getVar('nama_kelas'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'kelas'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function level()
    {
        $data = [
            'title' => 'Al-Haqq - Level',
            'list' => $this->level->list()
        ];
        return view('auth/program/level', $data);
    }

    public function input_level()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'title'   => 'Form Input Level Baru',
            ];
            $msg = [
                'sukses' => view('auth/program/tambah_level', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_level()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_level' => [
                    'label' => 'nama_level',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'urutan_level' => [
                    'label' => 'urutan_level',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tampil_ondaftar' => [
                    'label' => 'tampil_ondaftar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_level'        => $validation->getError('nama_level'),
                        'urutan_level'      => $validation->getError('urutan_level'),
                        'tampil_ondaftar'   => $validation->getError('tampil_ondaftar'),
                    ]
                ];
            } else {
                $simpandata = [
                    'nama_level'        => strtoupper($this->request->getVar('nama_level')),
                    'urutan_level'      => $this->request->getVar('urutan_level'),
                    'tampil_ondaftar'   => $this->request->getVar('tampil_ondaftar'),
                ];

                $this->level->insert($simpandata);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Buat Data Level Nama : ' .  $this->request->getVar('nama_level'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'level'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function edit_level()
    {
        if ($this->request->isAJAX()) {

            $peserta_level_id   = $this->request->getVar('peserta_level_id');
            $level              = $this->level->find($peserta_level_id);
            $data = [
                'title'             => 'Ubah Data Level',
                'peserta_level_id'  => $level['peserta_level_id'],
                'nama_level'        => $level['nama_level'],
                'urutan_level'      => $level['urutan_level'],
                'tampil_ondaftar'   => $level['tampil_ondaftar'],
            ];
            $msg = [
                'sukses' => view('auth/program/edit_level', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update_level()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_level' => [
                    'label' => 'nama_level',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'urutan_level' => [
                    'label' => 'urutan_level',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tampil_ondaftar' => [
                    'label' => 'tampil_ondaftar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_level'        => $validation->getError('nama_level'),
                        'urutan_level'      => $validation->getError('urutan_level'),
                        'tampil_ondaftar'   => $validation->getError('tampil_ondaftar'),
                    ]
                ];
            } else {

                $updatedata = [
                    'nama_level'        => strtoupper($this->request->getVar('nama_level')),
                    'urutan_level'      => $this->request->getVar('urutan_level'),
                    'tampil_ondaftar'   => $this->request->getVar('tampil_ondaftar'),
                ];

                $peserta_level_id = $this->request->getVar('peserta_level_id');
                $this->level->update($peserta_level_id, $updatedata);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Ubah Data Level Nama : ' .  $this->request->getVar('nama_level'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'level'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function kelas_peserta($kelas_id)
    {
        $peserta_onkelas    = $this->peserta_kelas->peserta_onkelas($kelas_id);
        $data = [
            'title'             => 'Al-Haqq - Peserta Kelas',
            'list'              => $this->program->list(),
            'peserta_onkelas'   => $peserta_onkelas,
            'detail_kelas'      => $this->program->list_detail_kelas($kelas_id),
            'jumlah_peserta'    => $this->peserta_kelas->jumlah_peserta_onkelas($kelas_id),
        ];
        return view('auth/program_kelas/kelas_peserta', $data);
    }

    public function pindah_kelas()
    {
        if ($this->request->isAJAX()) {

            $peserta_kelas_id   = $this->request->getVar('peserta_kelas_id');
            $peserta_kelas      = $this->peserta_kelas->find($peserta_kelas_id);

            //get id peserta
            $peserta_id        = $this->peserta_kelas->get_peserta_id($peserta_kelas_id);
            $data_peserta      = $this->peserta->find($peserta_id );

            $data = [
                'title'             => 'Pindah Kelas Peserta',
                'peserta_kelas_id'  => $peserta_kelas_id,
                'data_kelas_id'     => $peserta_kelas['data_kelas_id'],
                'kelas'             => $this->program->list(),
                'nama_peserta'      => $data_peserta[0]['nama_peserta'],
                'nis'               => $data_peserta[0]['nis'],
                'domisili'          => $data_peserta[0]['domisili_peserta']
            ];
            $msg = [
                'sukses' => view('auth/program_kelas/kelas_peserta_pindah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function pindah_kelas_simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'data_kelas_id' => [
                    'label' => 'data_kelas_id',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'data_kelas_id'    => $validation->getError('data_kelas_id'),
                    ]
                ];
            } else {

                $tujuan_kelas_id = $this->request->getVar('data_kelas_id');
                $asal_kelas_id = $this->request->getVar('asal_kelas_id');

                $updatedata = [
                    'data_kelas_id'        => $tujuan_kelas_id,
                ];

                $peserta_kelas_id = $this->request->getVar('peserta_kelas_id');
                $this->peserta_kelas->update($peserta_kelas_id, $updatedata);

                $variable1 = 1;
                //1. START - Ubah sisa kouta kelas asal (tambah)
                $find_kelas_asal                =  $this->program->get_sisa_kouta_asal($asal_kelas_id);
                $get_sisa_kuota_kelas_asal      = $find_kelas_asal->sisa_kouta;
                $sisa_kuota_kelas_asal          = $get_sisa_kuota_kelas_asal  + $variable1;
                $updatedata_kuota_kelas_asal    = [
                    'sisa_kouta'        => $sisa_kuota_kelas_asal ,
                ];
                $this->program->update($asal_kelas_id, $updatedata_kuota_kelas_asal);
                //END - Ubah sisa kouta kelas asal (tambah)

                //1. START - Ubah sisa kouta kelas tujuan (kurang)
                $find_kelas_tujuan            =  $this->program->get_sisa_kouta_tujuan($tujuan_kelas_id);
                $get_sisa_kuota_kelas_tujuan  = $find_kelas_tujuan->sisa_kouta;
                $sisa_kuota_kelas_tujuan      = $get_sisa_kuota_kelas_tujuan - $variable1;
                $updatedata_kuota_kelas_tujuan   = [
                    'sisa_kouta'        => $sisa_kuota_kelas_tujuan ,
                ];
                $this->program->update($tujuan_kelas_id, $updatedata_kuota_kelas_tujuan);
                //END - Ubah sisa kouta kelas tujuan (kurang)

                //2. START - Ubah jumlah peserta kelas asal (kurang)
                $find_kelas_asal_jml            =  $this->program->get_jumlah_peserta_asal($asal_kelas_id);
                $get_jumlah_peserta_kelas_asal  = $find_kelas_asal_jml ->jumlah_peserta;
                $jumlah_peserta_kelas_asal      = $get_jumlah_peserta_kelas_asal  - $variable1;
                $updatedata_jumlah_peserta_asal = [
                    'jumlah_peserta'        => $jumlah_peserta_kelas_asal ,
                ];
                $this->program->update($asal_kelas_id, $updatedata_jumlah_peserta_asal);
                //END - Ubah jumlah peserta kelas asal (kurang)

                //2. START - Ubah jumlah peserta kelas tujuan (tamnbah)
                $find_kelas_tujuan_jml              =  $this->program->get_jumlah_peserta_tujuan($tujuan_kelas_id);
                $get_jumlah_peserta_kelas_tujuan    = $find_kelas_tujuan_jml ->jumlah_peserta;
                $jumlah_peserta_kelas_tujuan        = $get_jumlah_peserta_kelas_tujuan + $variable1;
                $updatedata_jumlah_peserta_tujuan      = [
                    'jumlah_peserta'        => $jumlah_peserta_kelas_tujuan  ,
                ];
                $this->program->update($tujuan_kelas_id, $updatedata_jumlah_peserta_tujuan);
                //END - Ubah jumlah peserta kelas tujuan (tambah)

                //3. START - Get Nama peserta, Nama kelas asal dan nama kelas tujuan
                $find_kelas_asal_nama       = $this->program->find($asal_kelas_id);
                $nama_kelas_asal            = $find_kelas_asal_nama['nama_kelas'];
                $find_kelas_tujuan_nama     = $this->program->find($tujuan_kelas_id);
                $nama_kelas_tujuan          = $find_kelas_tujuan_nama['nama_kelas'];
                $find_peserta_id            = $this->peserta_kelas->find($peserta_kelas_id);
                $get_peserta_id             = $find_peserta_id['data_peserta_id'];
                $peserta_data               = $this->peserta->find($get_peserta_id);
                $nama_peserta               = $peserta_data['nama_peserta'];
                //END - Get Nama peserta, Nama kelas asal dan nama kelas tujuan


                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Pindah Peserta Nama : ' . $nama_peserta . ' Dipindahkan Ke Kelas ' . $nama_kelas_tujuan   . ' Dari Kelas ' . $nama_kelas_asal,
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => $asal_kelas_id
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

}
