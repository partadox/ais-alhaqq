<?php

namespace App\Controllers;

use Config\Services;
use App\Models\Modelpeserta;

class Peserta extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Al-Haqq - Peserta',
            // 'list' => $this->peserta->list()
        ];
        return view('auth/peserta/index', $data);
    }

    public function getdata_listpeserta()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Al-Haqq - Peserta',
                'list' => $this->peserta->list()

            ];
            $msg = [
                'data' => view('auth/peserta/list_peserta', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function getdata_peserta()
    {
        $request = Services::request();
        $datamodel = $this->peserta;
        if ($request->getMethod()) {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;

                $row = [];
                $edit = "<button type=\"button\" title=\"Edit Data Peserta\" class=\"btn btn-warning btn-sm\" onclick=\"edit('" . $list->peserta_id . "')\">
                <i class=\"fa fa-edit\"></i>
            </button>";
                $hapus = "<button type=\"button\" title=\"Hapus Peserta\" class=\"btn btn-danger btn-sm\" onclick=\"hapus('" . $list->peserta_id . "')\">
                <i class=\"fa fa-trash\"></i>
            </button>";
                $datadiri = "<button type=\"button\" title=\"Data Diri Peserta\" class=\"btn btn-secondary btn-sm\" onclick=\"datadiri('" . $list->peserta_id . "')\">
                <i class=\"fa fa-info\"></i>
            </button>";
                if($list->status_peserta == 'AKTIF'){$status_peserta = "<button type=\"button\" class=\"btn btn-success btn-sm\" disabled>AKTIF</button>";}
                elseif($list->status_peserta == 'OFF'){$status_peserta = "<button type=\"button\" class=\"btn btn-secondary btn-sm\" disabled>OFF</button>";}
                elseif($list->status_peserta == 'CUTI'){$status_peserta = "<button type=\"button\" class=\"btn btn-info btn-sm\" disabled>CUTI</button>";};
                $row[] = "<input type=\"checkbox\" name=\"peserta_id[]\" class=\"centangPesertaid\" value=\"$list->peserta_id\">";

                $row[] = $no;
                $row[] = $list->peserta_id;
                $row[] = $list->nis;
                $row[] = $list->nama_peserta;
                $row[] = $list->nik;
                $row[] = $list->nama_kantor;
                $row[] = $list->jenkel;
                $row[] = $list->hp;
                $row[] = $list->nama_level;
                $row[] = $list->angkatan;
                $row[] = umur($list->tgl_lahir);
                $row[] = $status_peserta;
                $row[] = "ID:" . $list->user_id . "-" . $list->username;
                $row[] = $datadiri . " " . $edit . " " . $hapus;
                $data[] = $row;
            }
            $output = [
                "recordTotal" => $datamodel->count_all(),
                "recordsFiltered" => $datamodel->count_filtered(),
                "data" => $data
            ];

            echo json_encode($output);
        }
    }

    public function datadiri()
    {
        if ($this->request->isAJAX()) {

            $peserta_id = $this->request->getVar('peserta_id');
            $peserta =  $this->peserta->find($peserta_id);
            $data = [
                'title'             => 'Data Diri Peserta',
                'nama'              => $peserta['nama_peserta'],
                'nis'               => $peserta['nis'],
                'jenkel'            => $peserta['jenkel'],
                'tmp_lahir'         => $peserta['tmp_lahir'],
                'tgl_lahir'         => $peserta['tgl_lahir'],
                'nik'               => $peserta['nik'],
                'pendidikan'        => $peserta['pendidikan'],
                'jurusan'           => $peserta['jurusan'],
                'status_kerja'      => $peserta['status_kerja'],
                'pekerjaan'         => $peserta['pekerjaan'],
                'domisili_peserta'  => $peserta['domisili_peserta'],
                'alamat'            => $peserta['alamat'],
                'hp'                => $peserta['hp'],
                'email'             => $peserta['email'],
                'tgl_gabung'        => $peserta['tgl_gabung'],
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
                'user'              => $this->user->getnonaktif_peserta(),
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
                'status_peserta' => [
                    'label' => 'status_peserta',
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
                        'domisili_peserta'      => $validation->getError('domisili_peserta'),
                        'alamat'                => $validation->getError('alamat'),
                        'status_peserta'        => $validation->getError('status_peserta'),
                        'user_id'               => $validation->getError('user_id'),
                    ]
                ];
            } else {
                $simpandata = [
                    'nama_peserta'          => strtoupper($this->request->getVar('nama')),
                    'asal_cabang_peserta'   => $this->request->getVar('asal_cabang_peserta'),
                    'nis'                   => $this->request->getVar('nis'),
                    'angkatan'              => $this->request->getVar('angkatan'),
                    'level_peserta'         => $this->request->getVar('level_peserta'),
                    'jenkel'                => $this->request->getVar('jenkel'),
                    'nik'                   => $this->request->getVar('nik'),
                    'tmp_lahir'             => strtoupper($this->request->getVar('tmp_lahir')),
                    'tgl_lahir'             => $this->request->getVar('tgl_lahir'),
                    'pendidikan'            => $this->request->getVar('pendidikan'),
                    'jurusan'               => strtoupper($this->request->getVar('jurusan')),
                    'status_kerja'          => $this->request->getVar('status_kerja'),
                    'pekerjaan'             => $this->request->getVar('pekerjaan'),
                    'hp'                    => $this->request->getVar('hp'),
                    'email'                 => strtolower($this->request->getVar('email')),
                    'domisili_peserta'      => $this->request->getVar('domisili_peserta'),
                    'alamat'                => strtoupper($this->request->getVar('alamat')),
                    'status_peserta'        => $this->request->getVar('status_peserta'),
                    'user_id'               => $this->request->getVar('user_id'),
                    'tgl_gabung'            => date("Y-m-d"),
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
                    'status_log'   => 'BERHASIL',
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
                'user'                  => $this->user->list_peserta(),
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
                'domisili_peserta'      => $peserta['domisili_peserta'],
                'alamat'                => $peserta['alamat'],
                'status_peserta'        => $peserta['status_peserta'],
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
                'status_peserta' => [
                    'label' => 'status_peserta',
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
                        'domisili_peserta'      => $validation->getError('domisili_peserta'),
                        'alamat'                => $validation->getError('alamat'),
                        'status_peserta'        => $validation->getError('status_peserta'),
                        'user_id'               => $validation->getError('user_id'),
                    ]
                ];
            } else {

                $updatedata = [
                    'nama_peserta'          => strtoupper($this->request->getVar('nama')),
                    'asal_cabang_peserta'   => $this->request->getVar('asal_cabang_peserta'),
                    'nis'                   => $this->request->getVar('nis'),
                    'angkatan'              => $this->request->getVar('angkatan'),
                    'level_peserta'         => $this->request->getVar('level_peserta'),
                    'jenkel'                => $this->request->getVar('jenkel'),
                    'nik'                   => $this->request->getVar('nik'),
                    'tmp_lahir'             => strtoupper($this->request->getVar('tmp_lahir')),
                    'tgl_lahir'             => $this->request->getVar('tgl_lahir'),
                    'pendidikan'            => $this->request->getVar('pendidikan'),
                    'jurusan'               => strtoupper($this->request->getVar('jurusan')),
                    'status_kerja'          => $this->request->getVar('status_kerja'),
                    'pekerjaan'             => $this->request->getVar('pekerjaan'),
                    'hp'                    => $this->request->getVar('hp'),
                    'email'                 => strtolower($this->request->getVar('email')),
                    'domisili_peserta'      => $this->request->getVar('domisili_peserta'),
                    'alamat'                => strtoupper($this->request->getVar('alamat')),
                    'status_peserta'        => $this->request->getVar('status_peserta'),
                    'user_id'               => $this->request->getVar('user_id'),
                ];

                // Update Data Peserta
                $peserta_id = $this->request->getVar('peserta_id');
                $this->peserta->update($peserta_id, $updatedata);

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

            if ($peserta_id == NULL || $peserta_id == 0) {
                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'GAGAL',
                    'aktivitas_log'=> 'Hapus Data Peserta : ' .  $psrt_nis . ' ' . $psrt_nama,
                ];
                $this->log->insert($log);
                // Data Log END
            } else {
                //Get data user id
                $get_user_id = $this->peserta->get_user_id($peserta_id);
                $user_id = $get_user_id->user_id;
                $updatedata = ['active' => 0, ];

                // Update Akun User
                $this->user->update($user_id, $updatedata);

                //Get Nama dan NIS
                $data_psrt  = $this->peserta->find($peserta_id);
                $psrt_nis   = $data_psrt['nis'];
                $psrt_nama  = $data_psrt['nama_peserta'];

                // Hapus Data Peserta
                $this->peserta->delete($peserta_id);

                // Data Log START
                $log = [
                    'username_log' => session()->get('username'),
                    'tgl_log'      => date("Y-m-d"),
                    'waktu_log'    => date("H:i:s"),
                    'status_log'   => 'BERHASIL',
                    'aktivitas_log'=> 'Hapus Data Peserta : ' .  $psrt_nis . ' ' . $psrt_nama,
                ];
                $this->log->insert($log);
                // Data Log END
            }
            $msg = [
                'sukses' => [
                    'link' => 'peserta'
                ]
            ];
            echo json_encode($msg);
        }
    }

    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $peserta_id = $this->request->getVar('peserta_id');
            $jmldata = count($peserta_id);
            for ($i = 0; $i < $jmldata; $i++) {

                if($peserta_id[$i] == NULL || $peserta_id[$i] == 0) {
                    // Data Log START
                    $log = [
                        'username_log' => session()->get('username'),
                        'tgl_log'      => date("Y-m-d"),
                        'waktu_log'    => date("H:i:s"),
                        'status_log'   => 'GAGAL',
                        'aktivitas_log'=> 'Hapus Data Peserta  : ' .  $psrt_nis . ' ' . $psrt_nama ,
                    ];
                    $this->log->insert($log);
                    // Data Log END
                } else{
                    //Get data user id
                    $get_user_id = $this->peserta->get_user_id($peserta_id[$i]);
                    $user_id = $get_user_id->user_id;
                    $updatedata = ['active' => 0, ];

                    // Update Akun User
                    $this->user->update($user_id, $updatedata);

                    //Get Nama dan NIS
                    $data_psrt  = $this->peserta->find($peserta_id[$i]);
                    $psrt_nis   = $data_psrt['nis'];
                    $psrt_nama  = $data_psrt['nama_peserta'];

                    // Hapus Data Peserta
                    $this->peserta->delete($peserta_id[$i]);

                    // Data Log START
                    $log = [
                        'username_log' => session()->get('username'),
                        'tgl_log'      => date("Y-m-d"),
                        'waktu_log'    => date("H:i:s"),
                        'status_log'   => 'BERHASIL',
                        'aktivitas_log'=> 'Hapus Data Peserta  : ' .  $psrt_nis . ' ' . $psrt_nama ,
                    ];
                    $this->log->insert($log);
                    // Data Log END
                }
            }

            $msg = [
                'sukses' => [
                    'link' => 'peserta'
                ]
            ];
            echo json_encode($msg);
        }
    }

    public function import_file()
    {
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'file_excel' => [
                'rules' => 'uploaded[file_excel]|ext_in[file_excel,xls,xlsx]',
                'errors' => [
                    'uploaded' => 'Harap Upload',
                    'ext_in' => 'Harus File Excel!'
                ]
            ]
        ]);

        if (!$valid) {
            $this->session->setFlashdata('pesan_error', 'ERROR! Untuk Import Harap Upload File Berjenis Excel!');
            return redirect()->to('index');
        } else {

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

                //Cek Duplikat Nis
                $nis            = $this->peserta->cek_duplikat_import($excel['3']);
                //Cek Data User ada
                $user           = $this->user->cek_user_ada($excel['1']); 
                //Cek Duplikat User
                $duplikat_user  = $this->peserta->cek_duplikat_user($excel['1']);

                if ($nis != 0 || $user != 1 || $duplikat_user != 0) {
                    $jumlaherror++;
                    if ($nis != 0) {
                        $gagal1 =  ' Karena NIS Duplikat';
                    } else{
                        $gagal1 = '';
                    }
                    
                    if ($user != 1) {
                        $gagal2 = ', Karena User ID Tidak Ditemukan';
                    } else{
                        $gagal2 ='';
                    }
                    
                    if ($duplikat_user != 0) {
                        $gagal3 =  ', Karena User ID Duplikat';
                    } else{
                        $gagal3 = '';
                    }
                    //Data Log START
                    $log = [
                        'username_log' => session()->get('username'),
                        'tgl_log'      => date("Y-m-d"),
                        'waktu_log'    => date("H:i:s"),
                        'status_log'   => 'GAGAL',
                        'aktivitas_log'=> 'Buat Data Peserta via Import Excel, Nama Peserta : ' .  $excel['4'] . $gagal1 . $gagal2 . $gagal3,
                    ];
                    $this->log->insert($log);
                    //Data Log END
                } elseif($nis == 0 && $user == 1 && $duplikat_user == 0) {

                    $jumlahsukses++;

                    $data   = [
                        'user_id'               => $excel['1'],
                        'angkatan'              => $excel['2'],
                        'nis'                   => $excel['3'],
                        'nama_peserta'          => strtoupper($excel['4']),
                        'nik'                   => $excel['5'],
                        'level_peserta'         => $excel['6'],
                        'status_peserta'        => strtoupper($excel['7']),
                        'asal_cabang_peserta'   => $excel['8'],
                        'tmp_lahir'             => strtoupper($excel['9']),
                        'tgl_lahir'             => $excel['10'],
                        'jenkel'                => strtoupper($excel['11']),
                        'pendidikan'            => strtoupper($excel['12']),
                        'jurusan'               => strtoupper($excel['13']),
                        'status_kerja'          => $excel['14'],
                        'pekerjaan'             => strtoupper($excel['15']),
                        'domisili_peserta'      => strtoupper($excel['16']),
                        'alamat'                => strtoupper($excel['17']),
                        'hp'                    => $excel['18'],
                        'email'                 => strtolower($excel['19']),
                        'tgl_gabung'            => $excel['20'],
                    ];

                    $this->peserta->insert($data);

                    //Update Status User Aktif
                    $updateusr = ['active' => '1'];
                    $usrid = $excel['1'];
                    $this->user->update($usrid, $updateusr);

                    //Data Log START
                    $log = [
                        'username_log' => session()->get('username'),
                        'tgl_log'      => date("Y-m-d"),
                        'waktu_log'    => date("H:i:s"),
                        'status_log'   => 'BERHASIL',
                        'aktivitas_log'=> 'Buat Data Peserta via Import Excel, Nama Peserta : ' .  $excel['4'],
                    ];
                    $this->log->insert($log);
                    //Data Log END
                }
            }
            $this->session->setFlashdata('pesan_sukses', "Data Excel Berhasil Import = $jumlahsukses <br> Data Gagal Import = $jumlaherror");
            return redirect()->to('index');
        }

    }

    public function export()
    {
        $peserta =  $this->peserta->list();

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

        $sheet->setCellValue('A1', "DATA PESERTA ALHAQQ - ACADEMIC ALHAQQ INFORMATION SYSTEM");
        $sheet->mergeCells('A1:U1');
        $sheet->getStyle('A1')->applyFromArray($styleColumn);

        $sheet->setCellValue('A2', date("Y-m-d"));
        $sheet->mergeCells('A2:U2');
        $sheet->getStyle('A2')->applyFromArray($styleColumn);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A4', 'PESERTA ID')
            ->setCellValue('B4', 'USER ID')
            ->setCellValue('C4', 'ANGKATAN')
            ->setCellValue('D4', 'NIS')
            ->setCellValue('E4', 'NAMA PESERTA')
            ->setCellValue('F4', 'NIK')
            ->setCellValue('G4', 'LEVEL')
            ->setCellValue('H4', 'STATUS')
            ->setCellValue('I4', 'ASAL CABANG')
            ->setCellValue('J4', 'TMP. LAHIR')
            ->setCellValue('K4', 'TGL. LAHIR')
            ->setCellValue('L4', 'JENKEL')
            ->setCellValue('M4', 'PENDIDIKAN')
            ->setCellValue('N4', 'JURUSAN')
            ->setCellValue('O4', 'STATUS KERJA')
            ->setCellValue('P4', 'PEKERJAAN')
            ->setCellValue('Q4', 'DOMISILI')
            ->setCellValue('R4', 'ALAMAT')
            ->setCellValue('S4', 'HP')
            ->setCellValue('T4', 'EMAIL')
            ->setCellValue('U4', 'TGL GABUNG');
        
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
        $sheet->getStyle('S4')->applyFromArray($styleColumn);
        $sheet->getStyle('S4')->applyFromArray($border);
        $sheet->getStyle('T4')->applyFromArray($styleColumn);
        $sheet->getStyle('T4')->applyFromArray($border);
        $sheet->getStyle('U4')->applyFromArray($styleColumn);
        $sheet->getStyle('U4')->applyFromArray($border);

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
        $spreadsheet->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);

        $row = 5;

        foreach ($peserta as $psrtdata) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $psrtdata['peserta_id'])
                ->setCellValue('B' . $row, $psrtdata['user_id'])
                ->setCellValue('C' . $row, $psrtdata['angkatan'])
                ->setCellValue('D' . $row, $psrtdata['nis'])
                ->setCellValue('E' . $row, $psrtdata['nama_peserta'])
                ->setCellValue('F' . $row, $psrtdata['nik'])
                ->setCellValue('G' . $row, $psrtdata['level_peserta'])
                ->setCellValue('H' . $row, $psrtdata['status_peserta'])
                ->setCellValue('I' . $row, $psrtdata['asal_cabang_peserta'])
                ->setCellValue('J' . $row, $psrtdata['tmp_lahir'])
                ->setCellValue('K' . $row, $psrtdata['tgl_lahir'])
                ->setCellValue('L' . $row, $psrtdata['jenkel'])
                ->setCellValue('M' . $row, $psrtdata['pendidikan'])
                ->setCellValue('N' . $row, $psrtdata['jurusan'])
                ->setCellValue('O' . $row, $psrtdata['status_kerja'])
                ->setCellValue('P' . $row, $psrtdata['pekerjaan'])
                ->setCellValue('Q' . $row, $psrtdata['domisili_peserta'])
                ->setCellValue('R' . $row, $psrtdata['alamat'])
                ->setCellValue('S' . $row, $psrtdata['hp'])
                ->setCellValue('T' . $row, $psrtdata['email'])
                ->setCellValue('U' . $row, $psrtdata['tgl_gabung']);

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
            $sheet->getStyle('S' . $row)->applyFromArray($border);
            $sheet->getStyle('T' . $row)->applyFromArray($border);
            $sheet->getStyle('U' . $row)->applyFromArray($border);

            $row++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename =  'Data-Peserta-'. date('Y-m-d-His');

        // Data Log START
        $log = [
            'username_log' => session()->get('username'),
            'tgl_log'      => date("Y-m-d"),
            'waktu_log'    => date("H:i:s"),
            'status_log'   => 'BERHASIL',
            'aktivitas_log'=> 'Download Data Peserta via Export Excel, Waktu : ' .  date('Y-m-d-H:i:s'),
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
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'file_excel' => [
                'rules' => 'uploaded[file_excel]|ext_in[file_excel,xls,xlsx]',
                'errors' => [
                    'uploaded' => 'Harap Upload',
                    'ext_in' => 'Harus File Excel!'
                ]
            ]
        ]);

        if (!$valid) {
            $this->session->setFlashdata('pesan_error', 'ERROR! Untuk Import Harap Upload File Berjenis Excel!');
            return redirect()->to('index');
        } else {

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
                $peserta_id    = $this->peserta->cek_multiple_edit($excel['1']);
                //Cek Duplikat Nis
                $nis            = $this->peserta->cek_duplikat_import($excel['4']);
                //Cek Data User ada
                $user           = $this->user->cek_user_ada($excel['2']); 
                //Cek Duplikat User
                $duplikat_user  = $this->peserta->cek_duplikat_user($excel['2']);

                if ($peserta_id == 0 || $nis != 0 || $user != 1 || $duplikat_user != 0) {
                    $jumlaherror++;

                    if ($nis != 0) {
                        $gagal1 =  ' Karena NIS Duplikat';
                    } else{
                        $gagal1 = '';
                    }
                    
                    if ($user != 1) {
                        $gagal2 = ', Karena User ID Tidak Ditemukan';
                    } else{
                        $gagal2 ='';
                    }
                    
                    if ($duplikat_user != 0) {
                        $gagal3 =  ', Karena User ID Duplikat';
                    } else{
                        $gagal3 = '';
                    }

                    if ($peserta_id == 0) {
                        $gagal4 =  ', Karena Peserta ID Tidak Ditemukan';
                    } else{
                        $gagal4 = '';
                    }

                    //Data Log START
                    $log = [
                        'username_log' => session()->get('username'),
                        'tgl_log'      => date("Y-m-d"),
                        'waktu_log'    => date("H:i:s"),
                        'status_log'   => 'GAGAL',
                        'aktivitas_log'=> 'Edit Data Peserta via Multiple Edit, Peserta : ' .  $excel['4'] . ' - ' .  $excel['5'] . ' ' . $gagal1 . $gagal2 . $gagal3 . $gagal4,
                    ];
                    $this->log->insert($log);
                    //Data Log END
                } elseif($peserta_id == 1 && $nis == 0 || $user == 1 || $duplikat_user == 0) {

                    $jumlahsukses++;

                    $updatedata   = [
                        'user_id'               => $excel['2'],
                        'angkatan'              => $excel['3'],
                        'nis'                   => $excel['4'],
                        'nama_peserta'          => strtoupper($excel['5']),
                        'nik'                   => $excel['6'],
                        'level_peserta'         => $excel['7'],
                        'status_peserta'        => strtoupper($excel['8']),
                        'asal_cabang_peserta'   => $excel['9'],
                        'tmp_lahir'             => strtoupper($excel['10']),
                        'tgl_lahir'             => $excel['11'],
                        'jenkel'                => strtoupper($excel['12']),
                        'pendidikan'            => strtoupper($excel['13']),
                        'jurusan'               => strtoupper($excel['14']),
                        'status_kerja'          => $excel['15'],
                        'pekerjaan'             => strtoupper($excel['16']),
                        'domisili_peserta'      => strtoupper($excel['17']),
                        'alamat'                => strtoupper($excel['18']),
                        'hp'                    => $excel['19'],
                        'email'                 => strtolower($excel['20']),
                        'tgl_gabung'            => $excel['21'],
                    ];

                    // Update Data Peserta
                    $psrtid = $excel['1'];
                    $this->peserta->update($psrtid, $updatedata);

                    // Data Log START
                    $log = [
                        'username_log' => session()->get('username'),
                        'tgl_log'      => date("Y-m-d"),
                        'waktu_log'    => date("H:i:s"),
                        'status_log'   => 'BERHASIL',
                        'aktivitas_log'=> 'Edit Data Peserta via Multiple Edit, Peserta : '  .  $excel['4'] . ' | ' .  $excel['5'],
                    ];
                    $this->log->insert($log);
                    // Data Log END
                }
            }
            $this->session->setFlashdata('pesan_sukses', "Data Berhasil Diedit = $jumlahsukses <br> Data Gagal Diedit = $jumlaherror");
            return redirect()->to('index');
        }
        
    }


}
