<?php

namespace App\Controllers;

use Config\Services;

class Akun extends BaseController
{
    public function index()
    {
        
    }

    public function user_peserta()
    {
        $data = [
            'title' => 'Al-Haqq - Akun User Peserta',
            'list' => $this->user->list_peserta()
        ];
        //var_dump($data);
        return view('auth/akun/user_peserta', $data);
    }

    public function user_pengajar()
    {
        $data = [
            'title' => 'Al-Haqq - Akun User Pengajar & Penguji',
            'list' => $this->user->list_pengajar()
        ];
        //var_dump($data);
        return view('auth/akun/user_pengajar', $data);
    }

    public function input_user_peserta()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'title'   => 'Form Input Akun User Peserta Baru',
            ];
            $msg = [
                'sukses' => view('auth/akun/tambah_user_peserta', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function input_user_pengajar()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'title'   => 'Form Input Akun User Peserta Baru',
            ];
            $msg = [
                'sukses' => view('auth/akun/tambah_user_pengajar', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_user_peserta()
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
                        'password'  => $validation->getError('password'),
                    ]
                ];
            } else {
                $simpandata = [
                    'username'     => $this->request->getVar('username'),
                    'nama'         => strtoupper($this->request->getVar('nama')),
                    'password'     => (password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)),
                    'level'        => '4',
                    'foto'         => 'default.png',
                    'active'       => '0',
                ];

                $this->user->insert($simpandata);

                // Data Log START
                $usr_username   = $this->request->getVar('username');
                $usr_nama       = $this->request->getVar('nama');

                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Buat Data Akun Peserta : ' . $usr_username . ' | ' . $usr_nama ,
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'user_peserta'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function simpan_user_pengajar()
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
                    'label' => 'Level',
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
                    'username'     => $this->request->getVar('username'),
                    'nama'         => strtoupper($this->request->getVar('nama')),
                    'password'     => (password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)),
                    'level'        => $this->request->getVar('level'),
                    'foto'         => 'default.png',
                    'active'       => '0',
                ];

                $this->user->insert($simpandata);

                // Data Log START
                $usr_username   = $this->request->getVar('username');
                $usr_nama       = $this->request->getVar('nama');

                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Buat Data Akun Pengajar : ' . $usr_username . ' | ' . $usr_nama ,
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'user_pengajar'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function edit_user_peserta()
    {
        if ($this->request->isAJAX()) {

            $user_id = $this->request->getVar('user_id');
            $user =  $this->user->find($user_id);
            $data = [
                'title'      => 'Ubah Data Akun User Peserta',
                'user_id'    => $user['user_id'],
                'nama'       => $user['nama'],
                'active'     => $user['active'],
            ];
            $msg = [
                'sukses' => view('auth/akun/edit_user_peserta', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function edit_user_pengajar()
    {
        if ($this->request->isAJAX()) {

            $user_id = $this->request->getVar('user_id');
            $user =  $this->user->find($user_id);
            $data = [
                'title'      => 'Ubah Data Akun User',
                'user_id'    => $user['user_id'],
                'nama'       => $user['nama'],
                'level'      => $user['level'],
                'active'     => $user['active'],
            ];
            $msg = [
                'sukses' => view('auth/akun/edit_user_pengajar', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update_user_peserta()
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
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama'      => $validation->getError('nama'),
                    ]
                ];
            } else {
                $cek_password = $this->request->getVar('password');
                if($cek_password == ''){
                    $update_data = [
                        'nama'         => strtoupper($this->request->getVar('nama')),
                        'active'       => $this->request->getVar('active'),
                    ];
    
                    $user_id = $this->request->getVar('user_id');
                    $this->user->update($user_id, $update_data);
                } else{
                    $update_data = [
                        'nama'         => strtoupper($this->request->getVar('nama')),
                        'active'       => $this->request->getVar('active'),
                        'password'     => (password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)),
                    ];
    
                    $user_id = $this->request->getVar('user_id');
                    $this->user->update($user_id, $update_data);
                }

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Edit Data Akun Peserta : ' . $this->request->getVar('nama'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'user_peserta'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function update_user_pengajar()
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
                        'active'       => $this->request->getVar('active'),
                    ];
    
                    $user_id = $this->request->getVar('user_id');
                    $this->user->update($user_id, $update_data);
                } else{
                    $update_data = [
                        'nama'         => strtoupper($this->request->getVar('nama')),
                        'password'     => (password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)),
                        'level'        => $this->request->getVar('level'),
                        'active'       => $this->request->getVar('active'),
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
                        'link' => 'user_pengajar'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function edit_user_username_peserta()
    {
        if ($this->request->isAJAX()) {

            $user_id = $this->request->getVar('user_id');
            $user =  $this->user->find($user_id);
            $data = [
                'title'      => 'Ubah Username Peserta',
                'user_id'    => $user['user_id'],
                'username'   => $user['username'],
            ];
            $msg = [
                'sukses' => view('auth/akun/edit_user_username_peserta', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function edit_user_username_pengajar()
    {
        if ($this->request->isAJAX()) {

            $user_id = $this->request->getVar('user_id');
            $user =  $this->user->find($user_id);
            $data = [
                'title'      => 'Ubah Username Pengajar',
                'user_id'    => $user['user_id'],
                'username'   => $user['username'],
            ];
            $msg = [
                'sukses' => view('auth/akun/edit_user_username_pengajar', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update_user_username_peserta()
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

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Edit Data Akun Peserta : ' . $this->request->getVar('username'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'user_peserta'
                    ]
                ];
            }

            echo json_encode($msg);
        }
    }

    public function update_user_username_pengajar()
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

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Edit Data Akun Pengajar : ' . $this->request->getVar('username'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'user_pengajar'
                    ]
                ];
            }

            echo json_encode($msg);
        }
    }

    public function hapus_user_peserta()
    {
        if ($this->request->isAJAX()) {

            $user_id        = $this->request->getVar('user_id');
            $data_user      = $this->user->find($user_id);
            $usr_username   = $data_user['username'];
            $usr_nama       = $data_user['nama'];

            if ($user_id  == NULL || $user_id  == 0) {
                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'GAGAL',
                    'aktivitas_log'=> 'Hapus Data Akun Peserta : ' .  $usr_username . ' | ' . $usr_nama,
                ];
                $this->log->insert($log);
                // Data Log END
            } else {
                 // Hapus Akun User Juga
                $this->user->delete($user_id);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Hapus Data Akun Peserta : ' .  $usr_username . ' | ' . $usr_nama,
                ];
                $this->log->insert($log);
                // Data Log END
            }

            $msg = [
                'sukses' => [
                    'link' => 'user_peserta'
                ]
            ];
            echo json_encode($msg);
        }
    }

    public function hapusall_peserta()
    {
        if ($this->request->isAJAX()) {
            $user_id = $this->request->getVar('user_id');
            $jmldata = count($user_id);
            for ($i = 0; $i < $jmldata; $i++) {

                if ($user_id  == NULL || $user_id  == 0) {
                    // Data Log START
                    $log = [
                        'username_log' => session()->get('username'),
                        'tgl_log'      => date("Y-m-d"),
                        'waktu_log'    => date("H:i:s"),
                        'status_log'   => 'GAGAL',
                        'aktivitas_log'=> 'Hapus Data Akun Peserta  : ' .  $usr_username . ' | ' . $usr_nama ,
                    ];
                    $this->log->insert($log);
                    // Data Log END
                } else {
                    //Get Username dan Nama Akun
                    $data_user     = $this->user->find($user_id[$i]);
                    $usr_nama      = $data_user['nama'];
                    $usr_username  = $data_user['username'];

                    // Hapus Data Akun
                    $this->user->delete($user_id[$i]);

                    // Data Log START
                    $log = [
                        'username_log' => session()->get('username'),
                        'tgl_log'      => date("Y-m-d"),
                        'waktu_log'    => date("H:i:s"),
                        'status_log'   => 'BERHASIL',
                        'aktivitas_log'=> 'Hapus Data Akun Peserta  : ' .  $usr_username . ' | ' . $usr_nama ,
                    ];
                    $this->log->insert($log);
                    // Data Log END
                }
            }

            $msg = [
                'sukses' => [
                    'link' => 'user_peserta'
                ]
            ];
            echo json_encode($msg);
        }
    }

    public function hapus_user_pengajar()
    {
        if ($this->request->isAJAX()) {

            $user_id = $this->request->getVar('user_id');
            $data_user      = $this->user->find($user_id);
            $usr_username   = $data_user['username'];
            $usr_nama       = $data_user['nama'];

            if ($user_id  == NULL || $user_id  == 0) {
                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'GAGAL',
                    'aktivitas_log'=> 'Hapus Data Akun Pengajar : ' .  $usr_username . ' | ' . $usr_nama,
                ];
                $this->log->insert($log);
            // Data Log END
            } else {
                // Hapus Akun User Juga
                $this->user->delete($user_id);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Hapus Data Akun Pengajar : ' .  $usr_username . ' | ' . $usr_nama,
                ];
                $this->log->insert($log);
                // Data Log END
            }

            $msg = [
                'sukses' => [
                    'link' => 'user_pengajar'
                ]
            ];
            echo json_encode($msg);
        }
    }

    public function hapusall_pengajar()
    {
        if ($this->request->isAJAX()) {
            $user_id = $this->request->getVar('user_id');
            $jmldata = count($user_id);
            for ($i = 0; $i < $jmldata; $i++) {

                if ($user_id  == NULL || $user_id  == 0) {
                    // Data Log START
                    $log = [
                        'username_log' => session()->get('username'),
                        'tgl_log'      => date("Y-m-d"),
                        'waktu_log'    => date("H:i:s"),
                        'status_log'   => 'GAGAL',
                        'aktivitas_log'=> 'Hapus Data Akun Pengajar  : ' .  $usr_username . ' | ' . $usr_nama ,
                    ];
                    $this->log->insert($log);
                    // Data Log END
                } else {
                    //Get Username dan Nama Akun
                    $data_user     = $this->user->find($user_id[$i]);
                    $usr_nama      = $data_user['nama'];
                    $usr_username  = $data_user['username'];

                    // Hapus Data Akun
                    $this->user->delete($user_id[$i]);

                    // Data Log START
                    $log = [
                        'username_log' => session()->get('username'),
                        'tgl_log'      => date("Y-m-d"),
                        'waktu_log'    => date("H:i:s"),
                        'status_log'   => 'BERHASIL',
                        'aktivitas_log'=> 'Hapus Data Akun Pengajar  : ' .  $usr_username . ' | ' . $usr_nama ,
                    ];
                    $this->log->insert($log);
                    // Data Log END
                }
            }

            $msg = [
                'sukses' => [
                    'link' => 'user_pengajar'
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

    public function import_file()
    {
        $pst_or_pgj = $this->request->getVar('pst_or_pgj');
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

            //Skip data akun username duplikat
            $username    = $this->user->cek_duplikat_import_akun_peserta($excel['2']);
            if ($username != 0 ) {
                $jumlaherror++;
                //Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'GAGAL',
                    'aktivitas_log'=> 'Buat Data Akun via Import Excel, ' .   $pst_or_pgj .  ' Nama : ' . $excel["1"],
                ];
                $this->log->insert($log);
                //Data Log END
            } elseif($username == 0) {

                $jumlahsukses++;

                $data   = [
                    'nama'                  => strtoupper( $excel['1']),
                    'username'              => $excel['2'],
                    'password'              => (password_hash($excel['3'], PASSWORD_BCRYPT)),
                    'foto'                  => 'default.png',
                    'level'                 => $excel['4'],
                    'active'                => '0',
                ];

                $this->user->insert($data);

                //Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Buat Data Akun via Import Excel, Nama : ' .   $pst_or_pgj .  ' Nama : '. $excel["1"],
                ];
                $this->log->insert($log);
                //Data Log END
            }
        }

        $this->session->setFlashdata('pesan_sukses', "Data Excel Berhasil Import = $jumlahsukses <br> Data Gagal Import = $jumlaherror");
        if($pst_or_pgj == 'peserta'){
            return redirect()->to('user_peserta');
        } elseif($pst_or_pgj == 'pengajar') {
            return redirect()->to('user_pengajar');
        }
        
    }

    public function export_peserta()
    {

        $user =  $this->user->list_peserta();

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

        $sheet->setCellValue('A1', "DATA AKUN PESERTA ALHAQQ - ACADEMIC ALHAQQ INFORMATION SYSTEM");
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->applyFromArray($styleColumn);

        $sheet->setCellValue('A2', date("Y-m-d"));
        $sheet->mergeCells('A2:F2');
        $sheet->getStyle('A2')->applyFromArray($styleColumn);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A4', 'USER ID')
            ->setCellValue('B4', 'NAMA')
            ->setCellValue('C4', 'USERNAME')
            ->setCellValue('D4', 'PASSWORD')
            ->setCellValue('E4', 'ROLES (PESERTA=4)')
            ->setCellValue('F4', 'STATUS AKTIF AKUN (AKTIF=1, NONAKTIF=0)');
        
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

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

        $row = 5;

        foreach ($user as $userdata) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $userdata['user_id'])
                ->setCellValue('B' . $row, $userdata['nama'])
                ->setCellValue('C' . $row, $userdata['username'])
                ->setCellValue('D' . $row, $userdata['password'])
                ->setCellValue('E' . $row, $userdata['level'])
                ->setCellValue('F' . $row, $userdata['active']);

            $sheet->getStyle('A' . $row)->applyFromArray($border);
            $sheet->getStyle('B' . $row)->applyFromArray($border);
            $sheet->getStyle('C' . $row)->applyFromArray($border);
            $sheet->getStyle('D' . $row)->applyFromArray($border);
            $sheet->getStyle('E' . $row)->applyFromArray($border);
            $sheet->getStyle('F' . $row)->applyFromArray($border);

            $row++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        $filename =  'Data-Akun-Peserta-'. date('Y-m-d-His');

        // Data Log START
        $log = [
            'username_log' => session()->get('username'),
            'tgl_log'      => date("Y-m-d"),
            'waktu_log'    => date("H:i:s"),
            'status_log'   => 'BERHASIL',
            'aktivitas_log'=> 'Download Data via Export Excel' .  $filename,
        ];
        $this->log->insert($log);
        // Data Log END

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function export_pengajar()
    {

        $user =  $this->user->list_pengajar();

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

        $sheet->setCellValue('A1', "DATA AKUN PENGAJAR & PENGUJI ALHAQQ - ACADEMIC ALHAQQ INFORMATION SYSTEM");
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->applyFromArray($styleColumn);

        $sheet->setCellValue('A2', date("Y-m-d"));
        $sheet->mergeCells('A2:F2');
        $sheet->getStyle('A2')->applyFromArray($styleColumn);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A4', 'USER ID')
            ->setCellValue('B4', 'NAMA')
            ->setCellValue('C4', 'USERNAME')
            ->setCellValue('D4', 'PASSWORD')
            ->setCellValue('E4', 'ROLES (PENGAJAR=5, PENGUJI=6)')
            ->setCellValue('F4', 'STATUS AKTIF AKUN (AKTIF=1, NONAKTIF=0)');
        
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

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

        $row = 5;

        foreach ($user as $userdata) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $userdata['user_id'])
                ->setCellValue('B' . $row, $userdata['nama'])
                ->setCellValue('C' . $row, $userdata['username'])
                ->setCellValue('D' . $row, $userdata['password'])
                ->setCellValue('E' . $row, $userdata['level'])
                ->setCellValue('F' . $row, $userdata['active']);

            $sheet->getStyle('A' . $row)->applyFromArray($border);
            $sheet->getStyle('B' . $row)->applyFromArray($border);
            $sheet->getStyle('C' . $row)->applyFromArray($border);
            $sheet->getStyle('D' . $row)->applyFromArray($border);
            $sheet->getStyle('E' . $row)->applyFromArray($border);
            $sheet->getStyle('F' . $row)->applyFromArray($border);

            $row++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        $filename =  'Data-Akun-Pengajar-'. date('Y-m-d-His');

        // Data Log START
        $log = [
            'username_log' => session()->get('username'),
            'tgl_log'      => date("Y-m-d"),
            'waktu_log'    => date("H:i:s"),
            'status_log'   => 'BERHASIL',
            'aktivitas_log'=> 'Download Data via Export Excel' .  $filename,
        ];
        $this->log->insert($log);
        // Data Log END

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function edit_multiple()
    {
        $pst_or_pgj = $this->request->getVar('pst_or_pgj');
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

            //Skip data akun username duplikat
            $user_id    = $this->user->cek_multiple_edit($excel['0']);
            if ($user_id == 0 ) {
                $jumlaherror++;
                //Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'GAGAL',
                    'aktivitas_log'=> 'Edit Data Akun via Multiple Edit Excel,' .   $pst_or_pgj .  ' Nama : ' . $excel["1"] ,
                ];
                $this->log->insert($log);
                //Data Log END
            } elseif($user_id == 1) {

                $jumlahsukses++;

                $updatedata   = [
                    'nama'                  => strtoupper( $excel['1']),
                    'username'              => $excel['2'],
                    'password'              => (password_hash($excel['3'], PASSWORD_BCRYPT)),
                    'foto'                  => 'default.png',
                    'level'                 => $excel['4'],
                    'active'                => $excel['5'],
                ];

                // Update Data Akun Peserta
                $usrid = $excel['0'];
                $this->user->update($usrid, $updatedata);

                //Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Edit Data Akun via Multiple Edit Excel,' .   $pst_or_pgj .  ' Nama : ' . $excel["1"] ,
                ];
                $this->log->insert($log);
                //Data Log END
            }
        }

        $this->session->setFlashdata('pesan_sukses', "Data Berhasil Diedit = $jumlahsukses <br> Data Gagal Diedit = $jumlaherror");
        if($pst_or_pgj == 'peserta'){
            return redirect()->to('user_peserta');
        } elseif($pst_or_pgj == 'pengajar') {
            return redirect()->to('user_pengajar');
        }
        
    }

}
