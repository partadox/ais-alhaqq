<?php

namespace App\Controllers;

class Register extends BaseController
{

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        if (session('login')) {
            session()->setFlashdata('pesan_gagal', 'Anda sudah login!');
            return redirect()->to('/auth/dashboard');
        }
        $data = [
            'title' => 'Al-Haqq - Daftar Akun'
        ];
        return view('auth/register', $data);
    }

    public function simpanuser()
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
                    'username'     => strtolower($this->request->getVar('username')),
                    'nama'         => strtoupper($this->request->getVar('nama')),
                    'password'     => (password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)),
                    'level'        => $this->request->getVar('level'),
                    'foto'         => $this->request->getVar('foto'),
                    'active'       => $this->request->getVar('active'),
                ];

                $this->user->insert($simpandata);
                $msg = [
                    'sukses' => [
                        'link' => 'login'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }
}
