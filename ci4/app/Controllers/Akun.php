<?php

namespace App\Controllers;

use Config\Services;

class Akun extends BaseController
{
    public function index()
    {
        
    }

    public function user()
    {
        $data = [
            'title' => 'Al-Haqq - Akun User Peserta, Pengajar, Penguji',
            'list' => $this->user->list_peserta_pengajar()
        ];
        //var_dump($data);
        return view('auth/akun/user', $data);
    }

    public function input_user()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'title'   => 'Form Input Akun User Baru',
            ];
            $msg = [
                'sukses' => view('auth/akun/tambah_user', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_user()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|is_unique[user.username]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => 'sudah ada yang menggunakan {field} ini',
                    ]
                ],
                'nama' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'level' => [
                    'label' => 'level',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'username'  => $validation->getError('username'),
                        'nama'      => $validation->getError('nama'),
                        'level'     => $validation->getError('level'),
                        'password'  => $validation->getError('password'),
                    ]
                ];
            } else {
                $simpandata = [
                    'username'     => strtolower($this->request->getVar('username')),
                    'nama'         => strtoupper($this->request->getVar('nama')),
                    'password'     => (password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)),
                    'level'        => $this->request->getVar('level'),
                    'foto'         => 'default.png',
                    'active'       => '0',
                ];

                $this->user->insert($simpandata);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Buat Data Akun User Username : ' . $this->request->getVar('username'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'user'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function edit_user()
    {
        if ($this->request->isAJAX()) {

            $user_id = $this->request->getVar('user_id');
            $user =  $this->user->find($user_id);
            $data = [
                'title'      => 'Ubah Data Akun User',
                'user_id'    => $user['user_id'],
                'nama'       => $user['nama'],
                'level'      => $user['level'],
            ];
            $msg = [
                'sukses' => view('auth/akun/edit_user', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update_user()
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
                'level' => [
                    'label' => 'level',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama'      => $validation->getError('nama'),
                        'level'      => $validation->getError('level'),
                    ]
                ];
            } else {
                $cek_password = $this->request->getVar('password');
                if($cek_password == ''){
                    $update_data = [
                        'nama'         => strtoupper($this->request->getVar('nama')),
                        'level'        => $this->request->getVar('level'),
                    ];
    
                    $user_id = $this->request->getVar('user_id');
                    $this->user->update($user_id, $update_data);
                } else{
                    $update_data = [
                        'nama'         => strtoupper($this->request->getVar('nama')),
                        'password'     => (password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)),
                        'level'        => $this->request->getVar('level'),
                    ];
    
                    $user_id = $this->request->getVar('user_id');
                    $this->user->update($user_id, $update_data);
                }

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Edit Data Akun User Nama : ' . $this->request->getVar('nama'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'user'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function edit_user_username()
    {
        if ($this->request->isAJAX()) {

            $user_id = $this->request->getVar('user_id');
            $user =  $this->user->find($user_id);
            $data = [
                'title'      => 'Ubah Username',
                'user_id'    => $user['user_id'],
                'username'   => $user['username'],
            ];
            $msg = [
                'sukses' => view('auth/akun/edit_user_username', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update_user_username()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|is_unique[user.username]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => 'sudah ada yang menggunakan {field} ini',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'username'   => $validation->getError('username'),
                    ]
                ];
            } else {

                $update_data = [
                    'username'  => strtolower($this->request->getVar('username')),
                ];

                $user_id = $this->request->getVar('user_id');
                $this->user->update($user_id, $update_data);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Edit Data Akun User Username : ' . $this->request->getVar('username'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'user'
                    ]
                ];
            }

            echo json_encode($msg);
        }
    }

    public function hapus_user()
    {
        if ($this->request->isAJAX()) {

            $user_id = $this->request->getVar('user_id');

            // Hapus Akun User Juga
            $this->user->delete($user_id);

            // Data Log START
            $log = [
                'username_log' => session()->get('username'),
                'tgl_log'      => date("Y-m-d"),
                'waktu_log'    => date("H:i:s"),
                'aktivitas_log'=> 'Hapus Data Akun User ID : ' .  $this->request->getVar('user_id'),
            ];
            $this->log->insert($log);
            // Data Log END

            $msg = [
                'sukses' => [
                    'link' => 'user'
                ]
            ];
            echo json_encode($msg);
        }
    }

    public function admin()
    {
        $data = [
            'title' => 'Al-Haqq - Akun Admin Al Haqq',
            'list' => $this->user->list_admin()
        ];
        //var_dump($data);
        return view('auth/akun/admin', $data);
    }

    public function input_admin()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'title'   => 'Form Input Akun Admin Baru',
            ];
            $msg = [
                'sukses' => view('auth/akun/tambah_admin', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_admin()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|is_unique[user.username]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => 'sudah ada yang menggunakan {field} ini',
                    ]
                ],
                'nama' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'level' => [
                    'label' => 'level',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'username'  => $validation->getError('username'),
                        'nama'      => $validation->getError('nama'),
                        'level'     => $validation->getError('level'),
                        'password'  => $validation->getError('password'),
                    ]
                ];
            } else {
                $simpandata = [
                    'username'     => strtolower($this->request->getVar('username')),
                    'nama'         => strtoupper($this->request->getVar('nama')),
                    'password'     => (password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)),
                    'level'        => $this->request->getVar('level'),
                    'foto'         => 'default.png',
                    'active'       => '1',
                ];

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Buat Data Akun Admin Nama : ' . $this->request->getVar('nama'),
                ];
                $this->log->insert($log);
                // Data Log END

                $this->user->insert($simpandata);
                $msg = [
                    'sukses' => [
                        'link' => 'admin'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function edit_admin()
    {
        if ($this->request->isAJAX()) {

            $user_id = $this->request->getVar('user_id');
            $user =  $this->user->find($user_id);
            $data = [
                'title'      => 'Ubah Data Akun Admin',
                'user_id'    => $user['user_id'],
                'nama'       => $user['nama'],
                'level'      => $user['level'],
            ];
            $msg = [
                'sukses' => view('auth/akun/edit_admin', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update_admin()
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
                'level' => [
                    'label' => 'level',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama'      => $validation->getError('nama'),
                        'level'      => $validation->getError('level'),
                    ]
                ];
            } else {
                $cek_password = $this->request->getVar('password');
                if($cek_password == ''){
                    $update_data = [
                        'nama'         => strtoupper($this->request->getVar('nama')),
                        'level'        => $this->request->getVar('level'),
                    ];
    
                    $user_id = $this->request->getVar('user_id');
                    $this->user->update($user_id, $update_data);
                } else{
                    $update_data = [
                        'nama'         => strtoupper($this->request->getVar('nama')),
                        'password'     => (password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)),
                        'level'        => $this->request->getVar('level'),
                    ];
    
                    $user_id = $this->request->getVar('user_id');
                    $this->user->update($user_id, $update_data);
                }

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Edit Data Akun Admin Nama : ' . $this->request->getVar('nama'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'admin'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function edit_admin_username()
    {
        if ($this->request->isAJAX()) {

            $user_id = $this->request->getVar('user_id');
            $user =  $this->user->find($user_id);
            $data = [
                'title'      => 'Ubah Username',
                'user_id'    => $user['user_id'],
                'username'   => $user['username'],
            ];
            $msg = [
                'sukses' => view('auth/akun/edit_admin_username', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update_admin_username()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|is_unique[user.username]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => 'sudah ada yang menggunakan {field} ini',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'username'   => $validation->getError('username'),
                    ]
                ];
            } else {

                $update_data = [
                    'username'  => strtolower($this->request->getVar('username')),
                ];

                $user_id = $this->request->getVar('user_id');
                $this->user->update($user_id, $update_data);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Edit Data Akun Admin Username : ' .  $this->request->getVar('username'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'admin'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapus_admin()
    {
        if ($this->request->isAJAX()) {

            $user_id = $this->request->getVar('user_id');

            $this->user->delete($user_id);

            // Data Log START
            $log = [
                'username_log' => session()->get('username'),
                'tgl_log'      => date("Y-m-d"),
                'waktu_log'    => date("H:i:s"),
                'aktivitas_log'=> 'Hapus Data Akun Admin ID : ' .  $this->request->getVar('user_id'),
            ];
            $this->log->insert($log);
            // Data Log END

            $msg = [
                'sukses' => [
                    'link' => 'admin'
                ]
            ];
            echo json_encode($msg);
        }
    }

    public function biodata_peserta()
    {
        $user_id = session()->get('user_id');

        //Get data peserta id
        $get_peserta_id = $this->peserta->get_peserta_id($user_id);
        $peserta_id = $get_peserta_id->peserta_id;

        $peserta =  $this->peserta->find($peserta_id);

        $data = [
            'title'                 => 'Al-Haqq - Manajemen Data Diri dan Akun Peserta',
            'user_id'               => $user_id,
            'peserta_id'            => $peserta['peserta_id'],
            'nama'                  => $peserta['nama_peserta'],
            'nis'                   => $peserta['nis'],
            'nik'                   => $peserta['nik'],
            'jenkel'                => $peserta['jenkel'],
            'tmp_lahir'             => $peserta['tmp_lahir'],
            'tgl_lahir'             => $peserta['tgl_lahir'],
            'pendidikan'            => $peserta['pendidikan'],
            'jurusan'               => $peserta['jurusan'],
            'status_kerja'          => $peserta['status_kerja'],
            'pekerjaan'             => $peserta['pekerjaan'],
            'domisili_peserta'      => $peserta['domisili_peserta'],
            'alamat'                => $peserta['alamat'],
            'hp'                    => $peserta['hp'],
            'email'                 => $peserta['email'],
        ];
        return view('auth/akun/biodata_peserta', $data);
    }

    public function biodata_peserta_update()
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
                    ]
                ];
            } else {

                $update_data = [
                    'user_id'               => $this->request->getVar('user_id'),
                    'nama_peserta'          => strtoupper($this->request->getVar('nama')),
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
                ];

                $peserta_id = $this->request->getVar('peserta_id');
                $this->peserta->update($peserta_id, $update_data);

                $msg = [
                    'sukses' => [
                        'link' => 'biodata_peserta'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function biodata_edit_username()
    {
        if ($this->request->isAJAX()) {

            $user_id = $this->request->getVar('user_id');
            $user =  $this->user->find($user_id);
            $data = [
                'title'      => 'Ubah Username',
                'user_id'    => $user['user_id'],
                'username'   => $user['username'],
            ];
            $msg = [
                'sukses' => view('auth/akun/biodata_edit_username', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function biodata_update_username()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|is_unique[user.username]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => 'sudah ada yang menggunakan {field} ini',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'username'   => $validation->getError('username'),
                    ]
                ];
            } else {

                $update_data = [
                    'username'  => $this->request->getVar('username'),
                ];

                $user_id = $this->request->getVar('user_id');
                $this->user->update($user_id, $update_data);

                $msg = [
                    'sukses' => [
                        'link' => 'biodata_peserta'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function biodata_edit_password()
    {
        if ($this->request->isAJAX()) {

            $user_id = $this->request->getVar('user_id');
            $user =  $this->user->find($user_id);
            $data = [
                'title'      => 'Ubah Password',
                'user_id'    => $user['user_id'],
            ];
            $msg = [
                'sukses' => view('auth/akun/biodata_edit_password', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function biodata_update_password()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'password' => [
                    'label' => 'password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'password'   => $validation->getError('password'),
                    ]
                ];
            } else {

                $update_data = [
                    'password'  => (password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)),
                ];

                $user_id = $this->request->getVar('user_id');
                $this->user->update($user_id, $update_data);

                $msg = [
                    'sukses' => [
                        'link' => 'biodata_peserta'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }
}
