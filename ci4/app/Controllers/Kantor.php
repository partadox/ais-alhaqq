<?php

namespace App\Controllers;

use Config\Services;

class Kantor extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Al-Haqq - Kantor & Cabang',
            'list' => $this->kantor_cabang->list()
        ];

        return view('auth/kantor/index', $data); 
    }

    public function input_kantor()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'title'   => 'Form Input Data Kantor / Cabang Baru',
            ];
            $msg = [
                'sukses' => view('auth/kantor/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_kantor()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_kantor' => [
                    'label' => 'nama_kantor',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'kota_kantor' => [
                    'label' => 'kota_kantor',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'alamat_kantor' => [
                    'label' => 'alamat_kantor',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'kontak_kantor' => [
                    'label' => 'kontak_kantor',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_kantor'   => $validation->getError('nama_kantor'),
                        'kota_kantor'   => $validation->getError('kota_kantor'),
                        'alamat_kantor' => $validation->getError('alamat_kantor'),
                        'kontak_kantor' => $validation->getError('kontak_kantor'),
                    ]
                ];
            } else {
                $simpandata = [
                    'nama_kantor'   => $this->request->getVar('nama_kantor'),
                    'kota_kantor'   => $this->request->getVar('kota_kantor'),
                    'alamat_kantor' => $this->request->getVar('alamat_kantor'),
                    'kontak_kantor' => $this->request->getVar('kontak_kantor'),
                ];

                $this->kantor_cabang->insert($simpandata);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Buat Data Kantor / Cabang Nama : ' .  $this->request->getVar('nama_kantor'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'kantor'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function edit_kantor()
    {
        if ($this->request->isAJAX()) {

            $kantor_id = $this->request->getVar('kantor_id');
            $kantor    =  $this->kantor_cabang->find($kantor_id);
            $data = [
                'title'         => 'Ubah Data Kantor / Cabang',
                'kantor_id'     => $kantor['kantor_id'],
                'nama_kantor'   => $kantor['nama_kantor'],
                'kota_kantor'   => $kantor['kota_kantor'],
                'alamat_kantor' => $kantor['alamat_kantor'],
                'kontak_kantor' => $kantor['kontak_kantor'],
            ];
            $msg = [
                'sukses' => view('auth/kantor/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update_kantor()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_kantor' => [
                    'label' => 'nama_kantor',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'kota_kantor' => [
                    'label' => 'kota_kantor',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'alamat_kantor' => [
                    'label' => 'alamat_kantor',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'kontak_kantor' => [
                    'label' => 'kontak_kantor',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_kantor'   => $validation->getError('nama_kantor'),
                        'kota_kantor'   => $validation->getError('kota_kantor'),
                        'alamat_kantor' => $validation->getError('alamat_kantor'),
                        'kontak_kantor' => $validation->getError('kontak_kantor'),
                    ]
                ];
            } else {
                $update_data = [
                    'nama_kantor'   => $this->request->getVar('nama_kantor'),
                    'kota_kantor'   => $this->request->getVar('kota_kantor'),
                    'alamat_kantor' => $this->request->getVar('alamat_kantor'),
                    'kontak_kantor' => $this->request->getVar('kontak_kantor'),
                ];

                $kantor_id = $this->request->getVar('kantor_id');
                $this->kantor_cabang->update($kantor_id, $update_data);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Ubah Data Kantor / Cabang Nama : ' .  $this->request->getVar('nama_kantor'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'kantor'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }
}
