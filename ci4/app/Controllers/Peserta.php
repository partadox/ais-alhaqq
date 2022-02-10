<?php

namespace App\Controllers;

use Config\Services;

class Peserta extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Al-Haqq - Peserta',
            'list' => $this->peserta->list()
        ];
        return view('auth/peserta/index', $data);
    }

    public function datadiri()
    {
        if ($this->request->isAJAX()) {

            $peserta_id = $this->request->getVar('peserta_id');
            $peserta =  $this->peserta->find($peserta_id);
            $data = [
                'title'         => 'Data Diri Peserta',
                'nama'          => $peserta['nama_peserta'],
                'nis'           => $peserta['nis'],
                'jenkel'        => $peserta['jenkel'],
                'tmp_lahir'     => $peserta['tmp_lahir'],
                'tgl_lahir'     => $peserta['tgl_lahir'],
                'nik'           => $peserta['nik'],
                'pendidikan'    => $peserta['pendidikan'],
                'jurusan'       => $peserta['jurusan'],
                'status_kerja'  => $peserta['status_kerja'],
                'pekerjaan'     => $peserta['pekerjaan'],
                'alamat'        => $peserta['alamat'],
                'hp'            => $peserta['hp'],
                'email'         => $peserta['email'],
                'tgl_gabung'    => $peserta['tgl_gabung'],
            ];
            $msg = [
                'sukses' => view('auth/peserta/datadiri', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function input_peserta()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'title'             => 'Form Input Peserta Baru',
                'level'             => $this->level->list(),
                'kantor_cabang'     => $this->kantor_cabang->list(),
                'user'              => $this->user->getnonaktif(),
            ];
            $msg = [
                'sukses' => view('auth/peserta/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_peserta()
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
                'nis' => [
                    'label' => 'nis',
                    'rules' => 'is_unique[peserta.nis]',
                    'errors' => [
                        'is_unique' => '{field} harus unik, sudah ada yang menggunakan {field} ini',
                    ]
                ],
                'asal_cabang_peserta' => [
                    'label' => 'asal_cabang_peserta',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'level_peserta' => [
                    'label' => 'level_peserta',
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
                'alamat' => [
                    'label' => 'alamat',
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
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama'                  => $validation->getError('nama'),
                        'asal_cabang_peserta'   => $validation->getError('asal_cabang_peserta'),
                        'nis'                   => $validation->getError('nis'),
                        'level_peserta'         => $validation->getError('level_peserta'),
                        'jenkel'                => $validation->getError('jenkel'),
                        'nik'                   => $validation->getError('nik'),
                        'tmp_lahir'             => $validation->getError('tmp_lahir'),
                        'tgl_lahir'             => $validation->getError('tgl_lahir'),
                        'pendidikan'            => $validation->getError('pendidikan'),
                        'jurusan'               => $validation->getError('jurusan'),
                        'status_kerja'          => $validation->getError('status_kerja'),
                        'pekerjaan'             => $validation->getError('pekerjaan'),
                        'hp'                    => $validation->getError('hp'),
                        'email'                 => $validation->getError('email'),
                        'alamat'                => $validation->getError('alamat'),
                        'user_id'               => $validation->getError('user_id'),
                    ]
                ];
            } else {
                $simpandata = [
                    'nama_peserta'          => $this->request->getVar('nama'),
                    'asal_cabang_peserta'   => $this->request->getVar('asal_cabang_peserta'),
                    'nis'                   => $this->request->getVar('nis'),
                    'angkatan'              => $this->request->getVar('angkatan'),
                    'level_peserta'         => $this->request->getVar('level_peserta'),
                    'jenkel'                => $this->request->getVar('jenkel'),
                    'nik'                   => $this->request->getVar('nik'),
                    'tmp_lahir'             => $this->request->getVar('tmp_lahir'),
                    'tgl_lahir'             => $this->request->getVar('tgl_lahir'),
                    'pendidikan'            => $this->request->getVar('pendidikan'),
                    'jurusan'               => $this->request->getVar('jurusan'),
                    'status_kerja'          => $this->request->getVar('status_kerja'),
                    'pekerjaan'             => $this->request->getVar('pekerjaan'),
                    'hp'                    => $this->request->getVar('hp'),
                    'email'                 => $this->request->getVar('email'),
                    'alamat'                => $this->request->getVar('alamat'),
                    'user_id'               => $this->request->getVar('user_id'),
                ];

                $data_active = [
                    'active'      => '1',
                ];

                $this->peserta->insert($simpandata);
                $user_id = $this->request->getVar('user_id');
                $this->user->update($user_id, $data_active);
                
                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Buat Data Peserta ' . $this->request->getVar('nama'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'peserta'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function edit_peserta()
    {
        if ($this->request->isAJAX()) {

            $peserta_id = $this->request->getVar('peserta_id');
            $peserta =  $this->peserta->find($peserta_id);
            $data = [
                'title'                 => 'Ubah Data Peserta',
                'level'                 => $this->level->list(),
                'kantor_cabang'         => $this->kantor_cabang->list(),
                'user'                  => $this->user->list(),
                'peserta_id'            => $peserta['peserta_id'],
                'nama'                  => $peserta['nama_peserta'],
                'asal_cabang_peserta'   => $peserta['asal_cabang_peserta'],
                'nis'                   => $peserta['nis'],
                'angkatan'              => $peserta['angkatan'],
                'level_peserta'         => $peserta['level_peserta'],
                'jenkel'                => $peserta['jenkel'],
                'nik'                   => $peserta['nik'],
                'tmp_lahir'             => $peserta['tmp_lahir'],
                'tgl_lahir'             => $peserta['tgl_lahir'],
                'pendidikan'            => $peserta['pendidikan'],
                'jurusan'               => $peserta['jurusan'],
                'status_kerja'          => $peserta['status_kerja'],
                'pekerjaan'             => $peserta['pekerjaan'],
                'alamat'                => $peserta['alamat'],
                'hp'                    => $peserta['hp'],
                'email'                 => $peserta['email'],
                'user_id'               => $peserta['user_id'],
            ];
            $msg = [
                'sukses' => view('auth/peserta/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update_peserta()
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
                'level_peserta' => [
                    'label' => 'level_peserta',
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
                'nik' => [
                    'label' => 'nik',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
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
                'alamat' => [
                    'label' => 'alamat',
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
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama'                  => $validation->getError('nama'),
                        'asal_cabang_peserta'   => $validation->getError('asal_cabang_peserta'),
                        'level_peserta'         => $validation->getError('level_peserta'),
                        'jenkel'                => $validation->getError('jenkel'),
                        'nik'                   => $validation->getError('nik'),
                        'tmp_lahir'             => $validation->getError('tmp_lahir'),
                        'tgl_lahir'             => $validation->getError('tgl_lahir'),
                        'pendidikan'            => $validation->getError('pendidikan'),
                        'jurusan'               => $validation->getError('jurusan'),
                        'status_kerja'          => $validation->getError('status_kerja'),
                        'pekerjaan'             => $validation->getError('pekerjaan'),
                        'hp'                    => $validation->getError('hp'),
                        'email'                 => $validation->getError('email'),
                        'alamat'                => $validation->getError('alamat'),
                        'user_id'               => $validation->getError('user_id'),
                    ]
                ];
            } else {

                $updatedata = [
                    'nama_peserta'          => $this->request->getVar('nama'),
                    'asal_cabang_peserta'   => $this->request->getVar('asal_cabang_peserta'),
                    'nis'                   => $this->request->getVar('nis'),
                    'angkatan'              => $this->request->getVar('angkatan'),
                    'level_peserta'         => $this->request->getVar('level_peserta'),
                    'jenkel'                => $this->request->getVar('jenkel'),
                    'nik'                   => $this->request->getVar('nik'),
                    'tmp_lahir'             => $this->request->getVar('tmp_lahir'),
                    'tgl_lahir'             => $this->request->getVar('tgl_lahir'),
                    'pendidikan'            => $this->request->getVar('pendidikan'),
                    'jurusan'               => $this->request->getVar('jurusan'),
                    'status_kerja'          => $this->request->getVar('status_kerja'),
                    'pekerjaan'             => $this->request->getVar('pekerjaan'),
                    'hp'                    => $this->request->getVar('hp'),
                    'email'                 => $this->request->getVar('email'),
                    'alamat'                => $this->request->getVar('alamat'),
                    'user_id'               => $this->request->getVar('user_id'),
                ];

                $peserta_id = $this->request->getVar('peserta_id');
                $this->peserta->update($peserta_id, $updatedata);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Edit Data Peserta ' . $this->request->getVar('nama'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'peserta'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapus_peserta()
    {
        if ($this->request->isAJAX()) {

            $peserta_id = $this->request->getVar('peserta_id');

            //Get data user id
            $get_user_id = $this->peserta->get_user_id($peserta_id);
            $user_id = $get_user_id->user_id;
            $updatedata = ['active' => 0, ];

            // Update Akun User
            $this->user->update($user_id, $updatedata);
            // Hapus Data Peserta
            $this->peserta->delete($peserta_id);

            // Data Log START
            $log = [
                'username_log' => session()->get('username'),
                'tgl_log'      => date("Y-m-d"),
                'waktu_log'    => date("H:i:s"),
                'aktivitas_log'=> 'Hapus Data Peserta ID : ' .  $this->request->getVar('peserta_id'),
            ];
            $this->log->insert($log);
            // Data Log END

            $msg = [
                'sukses' => [
                    'link' => 'peserta'
                ]
            ];
            echo json_encode($msg);
        }
    }
}
