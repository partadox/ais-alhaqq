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
                'user'            => $this->user->list_pengajar(),
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
                $simpandata = [
                    'nama_pengajar'           => $this->request->getVar('nama_pengajar'),
                    'nik_pengajar'            => $this->request->getVar('nik_pengajar'),
                    'tipe_pengajar'           => $this->request->getVar('tipe_pengajar'),
                    'asal_kantor'             => $this->request->getVar('kantor_cabang'),
                    'jenkel_pengajar'         => $this->request->getVar('jenkel_pengajar'),
                    'tmp_lahir_pengajar'      => $this->request->getVar('tmp_lahir_pengajar'),
                    'tgl_lahir_pengajar'      => $this->request->getVar('tgl_lahir_pengajar'),
                    'suku_bangsa'             => $this->request->getVar('suku_bangsa'),
                    'status_nikah'            => $this->request->getVar('status_nikah'),
                    'jumlah_anak'             => $this->request->getVar('jumlah_anak'),
                    'pendidikan_pengajar'     => $this->request->getVar('pendidikan_pengajar'),
                    'jurusan_pengajar'        => $this->request->getVar('jurusan_pengajar'),
                    'hp_pengajar'             => $this->request->getVar('hp_pengajar'),
                    'email_pengajar'          => $this->request->getVar('email_pengajar'),
                    'alamat_pengajar'         => $this->request->getVar('alamat_pengajar'),
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
                    'nama_pengajar'           => $this->request->getVar('nama_pengajar'),
                    'nik_pengajar'            => $this->request->getVar('nik_pengajar'),
                    'tipe_pengajar'           => $this->request->getVar('tipe_pengajar'),
                    'asal_kantor'             => $this->request->getVar('kantor_cabang'),
                    'jenkel_pengajar'         => $this->request->getVar('jenkel_pengajar'),
                    'tmp_lahir_pengajar'      => $this->request->getVar('tmp_lahir_pengajar'),
                    'tgl_lahir_pengajar'      => $this->request->getVar('tgl_lahir_pengajar'),
                    'suku_bangsa'             => $this->request->getVar('suku_bangsa'),
                    'status_nikah'            => $this->request->getVar('status_nikah'),
                    'jumlah_anak'             => $this->request->getVar('jumlah_anak'),
                    'pendidikan_pengajar'     => $this->request->getVar('pendidikan_pengajar'),
                    'jurusan_pengajar'        => $this->request->getVar('jurusan_pengajar'),
                    'hp_pengajar'             => $this->request->getVar('hp_pengajar'),
                    'email_pengajar'          => $this->request->getVar('email_pengajar'),
                    'alamat_pengajar'         => $this->request->getVar('alamat_pengajar'),
                    'user_id'                 => $this->request->getVar('user_id'),
                    'tgl_gabung_pengajar'     => $this->request->getVar('tgl_gabung_pengajar'),
                ];

                $pengajar_id = $this->request->getVar('pengajar_id');
                $this->pengajar->update($pengajar_id, $update_data);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
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
}
