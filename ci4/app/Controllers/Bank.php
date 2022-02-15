<?php

namespace App\Controllers;

use Config\Services;

class Bank extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Al-Haqq - Pengaturan Rekening Bank',
            'list' => $this->bank->list()
        ];

        return view('auth/bank/index', $data); 
    }

    public function input_bank()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'title'   => 'Form Input Data Rekening Bank Baru',
            ];
            $msg = [
                'sukses' => view('auth/bank/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_bank()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_bank' => [
                    'label' => 'nama_bank',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'rekening_bank' => [
                    'label' => 'rekening_bank',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'atas_nama_bank' => [
                    'label' => 'atas_nama_bank',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_bank'      => $validation->getError('nama_bank'),
                        'rekening_bank'  => $validation->getError('rekening_bank'),
                        'atas_nama_bank' => $validation->getError('atas_nama_bank'),
                    ]
                ];
            } else {
                $simpandata = [
                    'nama_bank'      => strtoupper($this->request->getVar('nama_bank')),
                    'rekening_bank'  => $this->request->getVar('rekening_bank'),
                    'atas_nama_bank' => strtoupper($this->request->getVar('atas_nama_bank')),
                ];

                $this->bank->insert($simpandata);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Buat Data Bank Rek. : ' .  $this->request->getVar('rekening_bank'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'bank'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function edit_bank()
    {
        if ($this->request->isAJAX()) {

            $bank_id = $this->request->getVar('bank_id');
            $bank    =  $this->bank->find($bank_id);
            $data = [
                'title'         => 'Ubah Rekening Bank',
                'bank_id'       => $bank['bank_id'],
                'nama_bank'     => $bank['nama_bank'],
                'rekening_bank' => $bank['rekening_bank'],
                'atas_nama_bank'=> $bank['atas_nama_bank'],
            ];
            $msg = [
                'sukses' => view('auth/bank/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update_bank()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_bank' => [
                    'label' => 'nama_bank',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'rekening_bank' => [
                    'label' => 'rekening_bank',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'atas_nama_bank' => [
                    'label' => 'atas_nama_bank',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_bank'      => $validation->getError('nama_bank'),
                        'rekening_bank'  => $validation->getError('rekening_bank'),
                        'atas_nama_bank' => $validation->getError('atas_nama_bank'),
                    ]
                ];
            } else {
                $update_data = [
                    'nama_bank'      => strtoupper($this->request->getVar('nama_bank')),
                    'rekening_bank'  => $this->request->getVar('rekening_bank'),
                    'atas_nama_bank' => strtoupper($this->request->getVar('atas_nama_bank')),
                ];

                $bank_id = $this->request->getVar('bank_id');
                $this->bank->update($bank_id, $update_data);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'aktivitas_log'=> 'Ubah Data Bank Rek. : ' .  $this->request->getVar('rekening_bank'),
                ];
                $this->log->insert($log);
                // Data Log END

                $msg = [
                    'sukses' => [
                        'link' => 'bank'
                    ]
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapus_bank()
    {
        if ($this->request->isAJAX()) {

            $bank_id = $this->request->getVar('bank_id');

            $this->bank->delete($bank_id);

            // Data Log START
            $log = [
                'username_log' => session()->get('username'),
                'tgl_log'      => date("Y-m-d"),
                'waktu_log'    => date("H:i:s"),
                'aktivitas_log'=> 'Hapus Data Bank ID : ' .  $this->request->getVar('bank_id'),
            ];
            $this->log->insert($log);
            // Data Log END

            $msg = [
                'sukses' => [
                    'link' => 'bank'
                ]
            ];
            echo json_encode($msg);
        }
    }
}
