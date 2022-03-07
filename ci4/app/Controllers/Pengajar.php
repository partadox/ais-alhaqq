<?php

namespace App\Controllers;

use Config\Services;

class Pengajar extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Al-Haqq - Pengajar',
            'list' => $this->pengajar->list()
        ];
        return view('auth/pengajar/index', $data);
    }

    public function input_pengajar()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'title'           => 'Form Input Pengajar Baru',
                'kantor_cabang'   => $this->kantor_cabang->list(),
                'user'            => $this->user->list_pengajar_nonaktif(),
            ];
            $msg = [
                'sukses' => view('auth/pengajar/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_pengajar()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_pengajar' => [
                    'label' => 'nama_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nik_pengajar' => [
                    'label' => 'nik_pengajar',
                    'rules' => 'required|is_unique[pengajar.nik_pengajar]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} harus unik, sudah ada yang menggunakan {field} ini',
                    ]
                ],
                'tipe_pengajar' => [
                    'label' => 'tipe_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'kantor_cabang' => [
                    'label' => 'kantor_cabang',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jenkel_pengajar' => [
                    'label' => 'jenkel_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tmp_lahir_pengajar' => [
                    'label' => 'tmp_lahir_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tgl_lahir_pengajar' => [
                    'label' => 'tgl_lahir_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'suku_bangsa' => [
                    'label' => 'suku_bangsa',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'status_nikah' => [
                    'label' => 'status_nikah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jumlah_anak' => [
                    'label' => 'jumlah_anak',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'pendidikan_pengajar' => [
                    'label' => 'pendidikan_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jurusan_pengajar' => [
                    'label' => 'jurusan_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'hp_pengajar' => [
                    'label' => 'hp_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'email_pengajar' => [
                    'label' => 'email_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'alamat_pengajar' => [
                    'label' => 'alamat_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'user_id' => [
                    'label' => 'user_id',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tgl_gabung_pengajar' => [
                    'label' => 'tgl_gabung_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_pengajar'           => $validation->getError('nama_pengajar'),
                        'nik_pengajar'            => $validation->getError('nik_pengajar'),
                        'tipe_pengajar'           => $validation->getError('tipe_pengajar'),
                        'kantor_cabang'           => $validation->getError('kantor_cabang'),
                        'jenkel_pengajar'         => $validation->getError('jenkel_pengajar'),
                        'tmp_lahir_pengajar'      => $validation->getError('tmp_lahir_pengajar'),
                        'tgl_lahir_pengajar'      => $validation->getError('tgl_lahir_pengajar'),
                        'suku_bangsa'             => $validation->getError('suku_bangsa'),
                        'status_nikah'            => $validation->getError('status_nikah'),
                        'jumlah_anak'             => $validation->getError('jumlah_anak'),
                        'pendidikan_pengajar'     => $validation->getError('pendidikan_pengajar'),
                        'jurusan_pengajar'        => $validation->getError('jurusan_pengajar'),
                        'hp_pengajar'             => $validation->getError('hp_pengajar'),
                        'email_pengajar'          => $validation->getError('email_pengajar'),
                        'alamat_pengajar'         => $validation->getError('alamat_pengajar'),
                        'user_id'                 => $validation->getError('user_id'),
                        'tgl_gabung_pengajar'     => $validation->getError('tgl_gabung_pengajar'),
                    ]
                ];
            } else {
                $simpandata = [
                    'nama_pengajar'           => strtoupper($this->request->getVar('nama_pengajar')),
                    'nik_pengajar'            => $this->request->getVar('nik_pengajar'),
                    'tipe_pengajar'           => $this->request->getVar('tipe_pengajar'),
                    'asal_kantor'             => $this->request->getVar('kantor_cabang'),
                    'jenkel_pengajar'         => $this->request->getVar('jenkel_pengajar'),
                    'tmp_lahir_pengajar'      => strtoupper($this->request->getVar('tmp_lahir_pengajar')),
                    'tgl_lahir_pengajar'      => $this->request->getVar('tgl_lahir_pengajar'),
                    'suku_bangsa'             => strtoupper($this->request->getVar('suku_bangsa')),
                    'status_nikah'            => $this->request->getVar('status_nikah'),
                    'jumlah_anak'             => $this->request->getVar('jumlah_anak'),
                    'pendidikan_pengajar'     => $this->request->getVar('pendidikan_pengajar'),
                    'jurusan_pengajar'        => strtoupper($this->request->getVar('jurusan_pengajar')),
                    'hp_pengajar'             => $this->request->getVar('hp_pengajar'),
                    'email_pengajar'          => strtolower($this->request->getVar('email_pengajar')),
                    'alamat_pengajar'         => strtoupper($this->request->getVar('alamat_pengajar')),
                    'user_id'                 => $this->request->getVar('user_id'),
                    'tgl_gabung_pengajar'     => $this->request->getVar('tgl_gabung_pengajar'),
                    'foto_pengajar'           => 'default.png',
                ];

                $data_active = [
                    'active'      => '1',
                ];

                $this->pengajar->insert($simpandata);
                $user_id = $this->request->getVar('user_id');
                $this->user->update($user_id, $data_active);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Buat Data Pengajar Nama : ' .  $this->request->getVar('nama_pengajar'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'pengajar'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function datadiri()
    {
        if ($this->request->isAJAX()) {

            $pengajar_id = $this->request->getVar('pengajar_id');
            $pengajar =  $this->pengajar->find($pengajar_id);
            $data = [
                'title'                 => 'Data Diri Pengajar',
                'nama_pengajar'         => $pengajar['nama_pengajar'],
                'tmp_lahir_pengajar'    => $pengajar['tmp_lahir_pengajar'],
                'tgl_lahir_pengajar'    => $pengajar['tgl_lahir_pengajar'],
                'suku_bangsa'           => $pengajar['suku_bangsa'],
                'status_nikah'          => $pengajar['status_nikah'],
                'jumlah_anak'           => $pengajar['jumlah_anak'],
                'pendidikan_pengajar'   => $pengajar['pendidikan_pengajar'],
                'jurusan_pengajar'      => $pengajar['jurusan_pengajar'],
                'email_pengajar'        => $pengajar['email_pengajar'],
                'alamat_pengajar'       => $pengajar['alamat_pengajar'],
                'tgl_gabung_pengajar'   => $pengajar['tgl_gabung_pengajar'],
            ];
            $msg = [
                'sukses' => view('auth/pengajar/datadiri', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function edit_pengajar()
    {
        if ($this->request->isAJAX()) {

            $pengajar_id = $this->request->getVar('pengajar_id');
            $pengajar =  $this->pengajar->find($pengajar_id);
            $data = [
                'title'                 => 'Ubah Data Pengajar',
                'kantor_cabang'         => $this->kantor_cabang->list(),
                'user'                  => $this->user->list_pengajar(),
                'pengajar_id'           => $pengajar['pengajar_id'],
                'nama_pengajar'         => $pengajar['nama_pengajar'],
                'nik_pengajar'          => $pengajar['nik_pengajar'],
                'tipe_pengajar'         => $pengajar['tipe_pengajar'],
                'asal_kantor'           => $pengajar['asal_kantor'],
                'jenkel_pengajar'       => $pengajar['jenkel_pengajar'],
                'tmp_lahir_pengajar'    => $pengajar['tmp_lahir_pengajar'],
                'tgl_lahir_pengajar'    => $pengajar['tgl_lahir_pengajar'],
                'suku_bangsa'           => $pengajar['suku_bangsa'],
                'status_nikah'          => $pengajar['status_nikah'],
                'jumlah_anak'           => $pengajar['jumlah_anak'],
                'pendidikan_pengajar'   => $pengajar['pendidikan_pengajar'],
                'jurusan_pengajar'      => $pengajar['jurusan_pengajar'],
                'hp_pengajar'           => $pengajar['hp_pengajar'],
                'email_pengajar'        => $pengajar['email_pengajar'],
                'alamat_pengajar'       => $pengajar['alamat_pengajar'],
                'user_id'               => $pengajar['user_id'],
                'tgl_gabung_pengajar'   => $pengajar['tgl_gabung_pengajar'],
            ];
            $msg = [
                'sukses' => view('auth/pengajar/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update_pengajar()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_pengajar' => [
                    'label' => 'nama_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nik_pengajar' => [
                    'label' => 'nik_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tipe_pengajar' => [
                    'label' => 'tipe_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'kantor_cabang' => [
                    'label' => 'kantor_cabang',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jenkel_pengajar' => [
                    'label' => 'jenkel_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tmp_lahir_pengajar' => [
                    'label' => 'tmp_lahir_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tgl_lahir_pengajar' => [
                    'label' => 'tgl_lahir_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'suku_bangsa' => [
                    'label' => 'suku_bangsa',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'status_nikah' => [
                    'label' => 'status_nikah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jumlah_anak' => [
                    'label' => 'jumlah_anak',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'pendidikan_pengajar' => [
                    'label' => 'pendidikan_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jurusan_pengajar' => [
                    'label' => 'jurusan_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'hp_pengajar' => [
                    'label' => 'hp_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'email_pengajar' => [
                    'label' => 'email_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'alamat_pengajar' => [
                    'label' => 'alamat_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'user_id' => [
                    'label' => 'user_id',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tgl_gabung_pengajar' => [
                    'label' => 'tgl_gabung_pengajar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_pengajar'           => $validation->getError('nama_pengajar'),
                        'nik_pengajar'            => $validation->getError('nik_pengajar'),
                        'tipe_pengajar'           => $validation->getError('tipe_pengajar'),
                        'kantor_cabang'           => $validation->getError('kantor_cabang'),
                        'jenkel_pengajar'         => $validation->getError('jenkel_pengajar'),
                        'tmp_lahir_pengajar'      => $validation->getError('tmp_lahir_pengajar'),
                        'tgl_lahir_pengajar'      => $validation->getError('tgl_lahir_pengajar'),
                        'suku_bangsa'             => $validation->getError('suku_bangsa'),
                        'status_nikah'            => $validation->getError('status_nikah'),
                        'jumlah_anak'             => $validation->getError('jumlah_anak'),
                        'pendidikan_pengajar'     => $validation->getError('pendidikan_pengajar'),
                        'jurusan_pengajar'        => $validation->getError('jurusan_pengajar'),
                        'hp_pengajar'             => $validation->getError('hp_pengajar'),
                        'email_pengajar'          => $validation->getError('email_pengajar'),
                        'alamat_pengajar'         => $validation->getError('alamat_pengajar'),
                        'user_id'                 => $validation->getError('user_id'),
                        'tgl_gabung_pengajar'     => $validation->getError('tgl_gabung_pengajar'),
                    ]
                ];
            } else {
                $update_data = [
                    'nama_pengajar'           => strtoupper($this->request->getVar('nama_pengajar')),
                    'nik_pengajar'            => $this->request->getVar('nik_pengajar'),
                    'tipe_pengajar'           => $this->request->getVar('tipe_pengajar'),
                    'asal_kantor'             => $this->request->getVar('kantor_cabang'),
                    'jenkel_pengajar'         => $this->request->getVar('jenkel_pengajar'),
                    'tmp_lahir_pengajar'      => strtoupper($this->request->getVar('tmp_lahir_pengajar')),
                    'tgl_lahir_pengajar'      => $this->request->getVar('tgl_lahir_pengajar'),
                    'suku_bangsa'             => strtoupper($this->request->getVar('suku_bangsa')),
                    'status_nikah'            => $this->request->getVar('status_nikah'),
                    'jumlah_anak'             => $this->request->getVar('jumlah_anak'),
                    'pendidikan_pengajar'     => $this->request->getVar('pendidikan_pengajar'),
                    'jurusan_pengajar'        => strtoupper($this->request->getVar('jurusan_pengajar')),
                    'hp_pengajar'             => $this->request->getVar('hp_pengajar'),
                    'email_pengajar'          => strtolower($this->request->getVar('email_pengajar')),
                    'alamat_pengajar'         => strtoupper($this->request->getVar('alamat_pengajar')),
                    'user_id'                 => $this->request->getVar('user_id'),
                    'tgl_gabung_pengajar'     => $this->request->getVar('tgl_gabung_pengajar'),
                ];

                //Update Data Pengajar
                $pengajar_id = $this->request->getVar('pengajar_id');
                $this->pengajar->update($pengajar_id, $update_data);

                //Aktivasi ID User
                $iduser     = $this->request->getVar('user_id');
                $aktif_user = ['active' => 1, ];

                // Update Akun User
                $this->user->update($iduser, $aktif_user);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Edit Data Pengajar Nama : ' .  $this->request->getVar('nama_pengajar'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'pengajar'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapus_pengajar()
    {
        if ($this->request->isAJAX()) {

            $pengajar_id = $this->request->getVar('pengajar_id');

            //Get data user id
            $get_user_id = $this->pengajar->get_user_id($pengajar_id);
            $user_id = $get_user_id->user_id;
            $updatedata = ['active' => 0, ];

            //Get Nama dan NIS
            $data_pgj   = $this->pengajar->find($pengajar_id[$i]);
            $pgj_nama   = $data_pgj['nama_pengajar'];

            // Update Akun User
            $this->user->update($user_id, $updatedata);
            // Hapus Data Pengajar
            $this->pengajar->delete($pengajar_id);

            // Data Log START
            $log = [
                'username_log' => session()->get('username'),
                'tgl_log'      => date("Y-m-d"),
                'waktu_log'    => date("H:i:s"),
                'status_log'   => 'BERHASIL',
                'aktivitas_log'=> 'Hapus Data Pengajar/Penguji : ' .  $pgj_nama,
            ];
            $this->log->insert($log);
            // Data Log END

            $msg = [
                'sukses' => [
                    'link' => 'pengajar'
                ]
            ];
            echo json_encode($msg);
        }
    }

    public function hapusall_pengajar()
    {
        if ($this->request->isAJAX()) {
            $pengajar_id = $this->request->getVar('pengajar_id');
            $jmldata = count($pengajar_id);
            for ($i = 0; $i < $jmldata; $i++) {
                //Get data user id
                $get_user_id = $this->pengajar->get_user_id($pengajar_id[$i]);
                $user_id = $get_user_id->user_id;
                $updatedata = ['active' => 0, ];

                // Update Akun User
                $this->user->update($user_id, $updatedata);

                 //Get Nama dan NIS
                 $data_pgj   = $this->pengajar->find($pengajar_id[$i]);
                 $pgj_nama   = $data_pgj['nama_pengajar'];

                // Hapus Data Peserta
                $this->pengajar->delete($pengajar_id[$i]);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Hapus Data Pengajar/Penguji  : ' . $pgj_nama,
                ];
                $this->log->insert($log);
                // Data Log END
            }

            $msg = [
                'sukses' => [
                    'link' => 'pengajar'
                ]
            ];
            echo json_encode($msg);
        }
    }

    public function import_file()
    {
        $file   = $this->request->getFile('file_excel');
        $ext    = $file->getClientExtension();

        if ($ext == 'xls') {
            $render     = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else{
            $render     = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $render->load($file);
        $sheet       = $spreadsheet->getActiveSheet()->toArray();

        $jumlaherror   = 0;
        $jumlahsukses  = 0;

        foreach ($sheet as $x => $excel) {

            //Skip row pertama - keempat (judul tabel)
            if ($x == 0) {
                continue;
            }
            if ($x == 1) {
                continue;
            }
            if ($x == 2) {
                continue;
            }
            if ($x == 3) {
                continue;
            }

            //Skip data duplikat
            $nik    = $this->pengajar->cek_duplikat_import($excel['5']);
            if ($nik != 0 ) {
                $jumlaherror++;
            } elseif($nik == 0) {

                $jumlahsukses++;

                $data   = [
                    'user_id'               => $excel['1'],
                    'asal_kantor'           => $excel['2'],
                    'tipe_pengajar'         => $excel['3'],
                    'nama_pengajar'         => $excel['4'],
                    'nik_pengajar'          => $excel['5'],
                    'jenkel_pengajar'       => $excel['6'],
                    'tmp_lahir_pengajar'    => $excel['7'],
                    'tgl_lahir_pengajar'    => $excel['8'],
                    'suku_bangsa'           => $excel['9'],
                    'status_nikah'          => $excel['10'],
                    'jumlah_anak'           => $excel['11'],
                    'pendidikan_pengajar'   => $excel['12'],
                    'jurusan_pengajar'      => $excel['13'],
                    'tgl_gabung_pengajar'   => $excel['14'],
                    'hp_pengajar'           => $excel['15'],
                    'email_pengajar'        => $excel['16'],
                    'alamat_pengajar'       => $excel['17'],
                    'foto_pengajar'         => 'default.png',
                ];

                $this->pengajar->insert($data);

                //Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Buat Data Pengajar via Import Excel, Nama Pengajar : ' .  $excel['4'],
                ];
                $this->log->insert($log);
                //Data Log END
            }
        }

        $this->session->setFlashdata('pesan_sukses', "Data Excel Berhasil Import = $jumlahsukses <br> Data Gagal Import = $jumlaherror");
        return redirect()->to('index');
    }

    public function export()
    {
        $pengajar =  $this->pengajar->list();

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

        $sheet->setCellValue('A1', "DATA PENGAJAR & PENGUJI ALHAQQ - ACADEMIC ALHAQQ INFORMATION SYSTEM");
        $sheet->mergeCells('A1:U1');
        $sheet->getStyle('A1')->applyFromArray($styleColumn);

        $sheet->setCellValue('A2', date("Y-m-d"));
        $sheet->mergeCells('A2:U2');
        $sheet->getStyle('A2')->applyFromArray($styleColumn);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A4', 'PENGAJAR ID')
            ->setCellValue('B4', 'USER ID')
            ->setCellValue('C4', 'ASAL CABANG')
            ->setCellValue('D4', 'TIPE PENGAJAR/PENGUJI')
            ->setCellValue('E4', 'NAMA')
            ->setCellValue('F4', 'NIK')
            ->setCellValue('G4', 'JENKEL')
            ->setCellValue('H4', 'TMP. LAHIR')
            ->setCellValue('I4', 'TGL. LAHIR')
            ->setCellValue('J4', 'SUKU BANGSA')
            ->setCellValue('K4', 'STATUS NIKAH')
            ->setCellValue('L4', 'JUMLAH ANAK')
            ->setCellValue('M4', 'PENDIDIKAN')
            ->setCellValue('N4', 'JURUSAN')
            ->setCellValue('O4', 'TGL. GABUNG')
            ->setCellValue('P4', 'NO. HP')
            ->setCellValue('Q4', 'EMAIL')
            ->setCellValue('R4', 'ALAMAT');
        
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
        $sheet->getStyle('R4')->applyFromArray($styleColumn);
        $sheet->getStyle('R4')->applyFromArray($border);

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
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);

        $row = 5;

        foreach ($pengajar as $pgjdata) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $pgjdata['pengajar_id'])
                ->setCellValue('B' . $row, $pgjdata['user_id'])
                ->setCellValue('C' . $row, $pgjdata['asal_kantor'])
                ->setCellValue('D' . $row, $pgjdata['tipe_pengajar'])
                ->setCellValue('E' . $row, $pgjdata['nama_pengajar'])
                ->setCellValue('F' . $row, $pgjdata['nik_pengajar'])
                ->setCellValue('G' . $row, $pgjdata['jenkel_pengajar'])
                ->setCellValue('H' . $row, $pgjdata['tmp_lahir_pengajar'])
                ->setCellValue('I' . $row, $pgjdata['tgl_lahir_pengajar'])
                ->setCellValue('J' . $row, $pgjdata['suku_bangsa'])
                ->setCellValue('K' . $row, $pgjdata['status_nikah'])
                ->setCellValue('L' . $row, $pgjdata['jumlah_anak'])
                ->setCellValue('M' . $row, $pgjdata['pendidikan_pengajar'])
                ->setCellValue('N' . $row, $pgjdata['jurusan_pengajar'])
                ->setCellValue('O' . $row, $pgjdata['tgl_gabung_pengajar'])
                ->setCellValue('P' . $row, $pgjdata['hp_pengajar'])
                ->setCellValue('Q' . $row, $pgjdata['email_pengajar'])
                ->setCellValue('R' . $row, $pgjdata['alamat_pengajar']);

            $sheet->getStyle('F' . $row)->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);

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
            $sheet->getStyle('R' . $row)->applyFromArray($border);

            $row++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename =  'Data-Pengajar_Penguji-'. date('Y-m-d-His');

        // Data Log START
        $log = [
            'username_log' => session()->get('username'),
            'tgl_log'      => date("Y-m-d"),
            'waktu_log'    => date("H:i:s"),
            'status_log'   => 'BERHASIL',
            'aktivitas_log'=> 'Download Data Pengajar / Penguji via Export Excel, Waktu : ' .  date('Y-m-d-H:i:s'),
        ];
        $this->log->insert($log);
        // Data Log END

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

}
