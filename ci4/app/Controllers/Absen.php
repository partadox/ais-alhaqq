<?php

namespace App\Controllers;

use Config\Services;

class Absen extends BaseController
{
    public function index_pengajar()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('login');
        }

        //Get Data Pengajar
        $user_id            = session()->get('user_id');
        $get_pengajar_id    = $this->pengajar->get_pengajar_id($user_id);
        $pengajar_id        = $get_pengajar_id->pengajar_id;

        $data = [
            'title' => 'Al-Haqq - Daftar Kelas Anda',
            'list' => $this->program->kelas_pengajar($pengajar_id),
        ];

        return view('auth/absen/index_pengajar', $data); 
    }

    public function list_absen($kelas_id)
    {
        if (!session()->get('user_id')) {
            return redirect()->to('login');
        }

        $peserta_onkelas    = $this->peserta_kelas->peserta_onkelas_absen($kelas_id);

        // Get ID data absen pengajar
        $get_absen_pengajar_id  = $this->program->get_data_absen_pengajar_id($kelas_id);
        $absen_pengajar_id      = $get_absen_pengajar_id->data_absen_pengajar;
        // Get data absen pengajar
        $absen_pengajar         = $this->absen_pengajar->find($absen_pengajar_id);

        $data = [
            'title'             => 'Al-Haqq - Peserta Kelas',
            'list'              => $this->program->list(),
            'peserta_onkelas'   => $peserta_onkelas,
            'tm1'               => $absen_pengajar ['tm1_pengajar'],
            'tm2'               => $absen_pengajar ['tm2_pengajar'],
            'tm3'               => $absen_pengajar ['tm3_pengajar'],
            'tm4'               => $absen_pengajar ['tm4_pengajar'],
            'tm5'               => $absen_pengajar ['tm5_pengajar'],
            'tm6'               => $absen_pengajar ['tm6_pengajar'],
            'tm7'               => $absen_pengajar ['tm7_pengajar'],
            'tm8'               => $absen_pengajar ['tm8_pengajar'],
            'tm9'               => $absen_pengajar ['tm9_pengajar'],
            'tm10'              => $absen_pengajar ['tm10_pengajar'],
            'tm11'              => $absen_pengajar ['tm11_pengajar'],
            'tm12'              => $absen_pengajar ['tm12_pengajar'],
            'tm13'              => $absen_pengajar ['tm13_pengajar'],
            'tm14'              => $absen_pengajar ['tm14_pengajar'],
            'tm15'              => $absen_pengajar ['tm15_pengajar'],
            'tm16'              => $absen_pengajar ['tm16_pengajar'],

            'note_tm1'               => $absen_pengajar ['note_tm1'],
            'note_tm2'               => $absen_pengajar ['note_tm2'],
            'note_tm3'               => $absen_pengajar ['note_tm3'],
            'note_tm4'               => $absen_pengajar ['note_tm4'],
            'note_tm5'               => $absen_pengajar ['note_tm5'],
            'note_tm6'               => $absen_pengajar ['note_tm6'],
            'note_tm7'               => $absen_pengajar ['note_tm7'],
            'note_tm8'               => $absen_pengajar ['note_tm8'],
            'note_tm9'               => $absen_pengajar ['note_tm9'],
            'note_tm10'              => $absen_pengajar ['note_tm10'],
            'note_tm11'              => $absen_pengajar ['note_tm11'],
            'note_tm12'              => $absen_pengajar ['note_tm12'],
            'note_tm13'              => $absen_pengajar ['note_tm13'],
            'note_tm14'              => $absen_pengajar ['note_tm14'],
            'note_tm15'              => $absen_pengajar ['note_tm15'],
            'note_tm16'              => $absen_pengajar ['note_tm16'],

            'tgl_tm1'               => $absen_pengajar ['tgl_tm1'],
            'tgl_tm2'               => $absen_pengajar ['tgl_tm2'],
            'tgl_tm3'               => $absen_pengajar ['tgl_tm3'],
            'tgl_tm4'               => $absen_pengajar ['tgl_tm4'],
            'tgl_tm5'               => $absen_pengajar ['tgl_tm5'],
            'tgl_tm6'               => $absen_pengajar ['tgl_tm6'],
            'tgl_tm7'               => $absen_pengajar ['tgl_tm7'],
            'tgl_tm8'               => $absen_pengajar ['tgl_tm8'],
            'tgl_tm9'               => $absen_pengajar ['tgl_tm9'],
            'tgl_tm10'              => $absen_pengajar ['tgl_tm10'],
            'tgl_tm11'              => $absen_pengajar ['tgl_tm11'],
            'tgl_tm12'              => $absen_pengajar ['tgl_tm12'],
            'tgl_tm13'              => $absen_pengajar ['tgl_tm13'],
            'tgl_tm14'              => $absen_pengajar ['tgl_tm14'],
            'tgl_tm15'              => $absen_pengajar ['tgl_tm15'],
            'tgl_tm16'              => $absen_pengajar ['tgl_tm16'],

            'detail_kelas'      => $this->program->list_detail_kelas($kelas_id),
            'jumlah_peserta'    => $this->peserta_kelas->jumlah_peserta_onkelas($kelas_id),
        ];
        return view('auth/absen/list_absen', $data);
    }

    public function input_tm()
    {
        if ($this->request->isAJAX()) {

            $tm         = $this->request->getVar('tm');
            $tm_upper   = strtoupper($tm);
            $kelas_id   = $this->request->getVar('kelas_id');
            $absen_tm   = $this->peserta_kelas->peserta_onkelas_absen_tm($tm, $kelas_id);
            $data_absen_pengajar   = $this->request->getVar('data_absen_pengajar');

            //Data Kelas
            $data_kelas         = $this->program->list_detail_kelas($kelas_id);
            $nama_pengajar      = $data_kelas[0]['nama_pengajar'];
            $absen_pengajar_id  = $data_kelas[0]['data_absen_pengajar'];

            //Data absen pengajar
            $absen_pengajar  = $this->absen_pengajar->find($data_absen_pengajar);

            $data = [
                'title'         => 'Absensi Pengajar & Peserta',
                'tm'            => $tm,
                'kelas_id'      => $kelas_id,
                'tm_upper'      => $tm_upper,
                'nama_pengajar' => $nama_pengajar, 
                'absen_tm'      => $absen_tm,
                'absen_pengajar'=> $absen_pengajar,
                'absen_pengajar_id' => $absen_pengajar_id,
            ];

            $msg = [
                'sukses' => view('auth/absen/input_tm', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_tm()
    {
        //Get jumlah peserta pada kelas
        $jml_psrt   = $this->request->getPost('jml_psrt');
        $total      = count($jml_psrt);

        //Get variabel global
        $tatap_muka     = $this->request->getPost('tatap_muka');
        $kelas_id       = $this->request->getPost('kelas_id');

        //url redirect
        $url_kelas      = 'list_absen/' . $kelas_id;

         //Logic if setiap tatap muka PENGAJAR
         if ($tatap_muka == 'tm1') {

            $absen_pengajar_id  = $this->request->getPost('absen_pengajar_id');
            $checkpgj           = $this->request->getPost('checkpgj1'); 
            $tgl_tm             = $this->request->getPost('tgl_tm1');
            $note_tm            = $this->request->getPost('note_tm1');

            //Logic if radio button pengajar yang tidak terpilih
            if ($checkpgj == NULL) {
                $this->session->setFlashdata('pesan_error', 'ERROR! Data pengajar pada form absensi TM-1 belum diisi!, Pilih Hadir!');
                return redirect()->to($url_kelas);
            } else {
                //update data absen tm1 pengajar 
                $updatepengajar = [
                    'tm1_pengajar'        => $checkpgj,
                    'tgl_tm1'             => $tgl_tm,
                    'note_tm1'            => $note_tm,
                ]; 
                
                $this->absen_pengajar->update($absen_pengajar_id, $updatepengajar);
            }
        } elseif ($tatap_muka == 'tm2') {
            $absen_pengajar_id  = $this->request->getPost('absen_pengajar_id');
            $checkpgj           = $this->request->getPost('checkpgj2'); 
            $tgl_tm             = $this->request->getPost('tgl_tm2');
            $note_tm            = $this->request->getPost('note_tm2');

            //Logic if radio button pengajar yang tidak terpilih
            if ($checkpgj == NULL) {
                $this->session->setFlashdata('pesan_error', 'ERROR! Data pengajar pada form absensi TM-2 belum diisi!, Pilih Hadir!');
                return redirect()->to($url_kelas);
            } else {
                //update data absen tm2 pengajar 
                $updatepengajar = [
                    'tm2_pengajar'        => $checkpgj,
                    'tgl_tm2'             => $tgl_tm,
                    'note_tm2'            => $note_tm,
                ]; 
                
                $this->absen_pengajar->update($absen_pengajar_id, $updatepengajar);
            }
        } elseif ($tatap_muka == 'tm3') {
            $absen_pengajar_id  = $this->request->getPost('absen_pengajar_id');
            $checkpgj           = $this->request->getPost('checkpgj3'); 
            $tgl_tm             = $this->request->getPost('tgl_tm3');
            $note_tm            = $this->request->getPost('note_tm3');

            //Logic if radio button pengajar yang tidak terpilih
            if ($checkpgj == NULL) {
                $this->session->setFlashdata('pesan_error', 'ERROR! Data pengajar pada form absensi TM-3 belum diisi!, Pilih Hadir!');
                return redirect()->to($url_kelas);
            } else {
                //update data absen tm3 pengajar 
                $updatepengajar = [
                    'tm3_pengajar'        => $checkpgj,
                    'tgl_tm3'             => $tgl_tm,
                    'note_tm3'            => $note_tm,
                ]; 
                
                $this->absen_pengajar->update($absen_pengajar_id, $updatepengajar);
            }
        } elseif ($tatap_muka == 'tm4') {
            $absen_pengajar_id  = $this->request->getPost('absen_pengajar_id');
            $checkpgj           = $this->request->getPost('checkpgj4'); 
            $tgl_tm             = $this->request->getPost('tgl_tm4');
            $note_tm            = $this->request->getPost('note_tm4');

            //Logic if radio button pengajar yang tidak terpilih
            if ($checkpgj == NULL) {
                $this->session->setFlashdata('pesan_error', 'ERROR! Data pengajar pada form absensi TM-4 belum diisi!, Pilih Hadir!');
                return redirect()->to($url_kelas);
            } else {
                //update data absen tm4 pengajar 
                $updatepengajar = [
                    'tm4_pengajar'        => $checkpgj,
                    'tgl_tm4'             => $tgl_tm,
                    'note_tm4'            => $note_tm,
                ]; 
                
                $this->absen_pengajar->update($absen_pengajar_id, $updatepengajar);
            }
        } elseif ($tatap_muka == 'tm5') {
            $absen_pengajar_id  = $this->request->getPost('absen_pengajar_id');
            $checkpgj           = $this->request->getPost('checkpgj5'); 
            $tgl_tm             = $this->request->getPost('tgl_tm5');
            $note_tm            = $this->request->getPost('note_tm5');

            //Logic if radio button pengajar yang tidak terpilih
            if ($checkpgj == NULL) {
                $this->session->setFlashdata('pesan_error', 'ERROR! Data pengajar pada form absensi TM-5 belum diisi!, Pilih Hadir!');
                return redirect()->to($url_kelas);
            } else {
                //update data absen tm5 pengajar 
                $updatepengajar = [
                    'tm5_pengajar'        => $checkpgj,
                    'tgl_tm5'             => $tgl_tm,
                    'note_tm5'            => $note_tm,
                ]; 
                
                $this->absen_pengajar->update($absen_pengajar_id, $updatepengajar);
            }
        } elseif ($tatap_muka == 'tm6') {
            $absen_pengajar_id  = $this->request->getPost('absen_pengajar_id');
            $checkpgj           = $this->request->getPost('checkpgj6'); 
            $tgl_tm             = $this->request->getPost('tgl_tm6');
            $note_tm            = $this->request->getPost('note_tm6');

            //Logic if radio button pengajar yang tidak terpilih
            if ($checkpgj == NULL) {
                $this->session->setFlashdata('pesan_error', 'ERROR! Data pengajar pada form absensi TM-6 belum diisi!, Pilih Hadir!');
                return redirect()->to($url_kelas);
            } else {
                //update data absen tm6 pengajar 
                $updatepengajar = [
                    'tm6_pengajar'        => $checkpgj,
                    'tgl_tm6'             => $tgl_tm,
                    'note_tm6'            => $note_tm,
                ]; 
                
                $this->absen_pengajar->update($absen_pengajar_id, $updatepengajar);
            }
        } elseif ($tatap_muka == 'tm7') {
            $absen_pengajar_id  = $this->request->getPost('absen_pengajar_id');
            $checkpgj           = $this->request->getPost('checkpgj7'); 
            $tgl_tm             = $this->request->getPost('tgl_tm7');
            $note_tm            = $this->request->getPost('note_tm7');

            //Logic if radio button pengajar yang tidak terpilih
            if ($checkpgj == NULL) {
                $this->session->setFlashdata('pesan_error', 'ERROR! Data pengajar pada form absensi TM-7 belum diisi!, Pilih Hadir!');
                return redirect()->to($url_kelas);
            } else {
                //update data absen tm7 pengajar 
                $updatepengajar = [
                    'tm7_pengajar'        => $checkpgj,
                    'tgl_tm7'             => $tgl_tm,
                    'note_tm7'            => $note_tm,
                ]; 
                
                $this->absen_pengajar->update($absen_pengajar_id, $updatepengajar);
            }
        } elseif ($tatap_muka == 'tm8') {
            $absen_pengajar_id  = $this->request->getPost('absen_pengajar_id');
            $checkpgj           = $this->request->getPost('checkpgj8'); 
            $tgl_tm             = $this->request->getPost('tgl_tm8');
            $note_tm            = $this->request->getPost('note_tm8');

            //Logic if radio button pengajar yang tidak terpilih
            if ($checkpgj == NULL) {
                $this->session->setFlashdata('pesan_error', 'ERROR! Data pengajar pada form absensi TM-8 belum diisi!, Pilih Hadir!');
                return redirect()->to($url_kelas);
            } else {
                //update data absen tm8 pengajar 
                $updatepengajar = [
                    'tm8_pengajar'        => $checkpgj,
                    'tgl_tm8'             => $tgl_tm,
                    'note_tm8'            => $note_tm,
                ]; 
                
                $this->absen_pengajar->update($absen_pengajar_id, $updatepengajar);
            }
        } elseif ($tatap_muka == 'tm9') {
            $absen_pengajar_id  = $this->request->getPost('absen_pengajar_id');
            $checkpgj           = $this->request->getPost('checkpgj9'); 
            $tgl_tm             = $this->request->getPost('tgl_tm9');
            $note_tm            = $this->request->getPost('note_tm9');

            //Logic if radio button pengajar yang tidak terpilih
            if ($checkpgj == NULL) {
                $this->session->setFlashdata('pesan_error', 'ERROR! Data pengajar pada form absensi TM-9 belum diisi!, Pilih Hadir!');
                return redirect()->to($url_kelas);
            } else {
                //update data absen tm9 pengajar 
                $updatepengajar = [
                    'tm9_pengajar'        => $checkpgj,
                    'tgl_tm9'             => $tgl_tm,
                    'note_tm9'            => $note_tm,
                ]; 
                
                $this->absen_pengajar->update($absen_pengajar_id, $updatepengajar);
            }
        } elseif ($tatap_muka == 'tm10') {
            $absen_pengajar_id  = $this->request->getPost('absen_pengajar_id');
            $checkpgj           = $this->request->getPost('checkpgj10'); 
            $tgl_tm             = $this->request->getPost('tgl_tm10');
            $note_tm            = $this->request->getPost('note_tm10');

            //Logic if radio button pengajar yang tidak terpilih
            if ($checkpgj == NULL) {
                $this->session->setFlashdata('pesan_error', 'ERROR! Data pengajar pada form absensi TM-10 belum diisi!, Pilih Hadir!');
                return redirect()->to($url_kelas);
            } else {
                //update data absen tm10 pengajar 
                $updatepengajar = [
                    'tm10_pengajar'        => $checkpgj,
                    'tgl_tm10'             => $tgl_tm,
                    'note_tm10'            => $note_tm,
                ]; 
                
                $this->absen_pengajar->update($absen_pengajar_id, $updatepengajar);
            }
        } elseif ($tatap_muka == 'tm11') {
            $absen_pengajar_id  = $this->request->getPost('absen_pengajar_id');
            $checkpgj           = $this->request->getPost('checkpgj11'); 
            $tgl_tm             = $this->request->getPost('tgl_tm11');
            $note_tm            = $this->request->getPost('note_tm11');

            //Logic if radio button pengajar yang tidak terpilih
            if ($checkpgj == NULL) {
                $this->session->setFlashdata('pesan_error', 'ERROR! Data pengajar pada form absensi TM-11 belum diisi!, Pilih Hadir!');
                return redirect()->to($url_kelas);
            } else {
                //update data absen tm11 pengajar 
                $updatepengajar = [
                    'tm11_pengajar'        => $checkpgj,
                    'tgl_tm11'             => $tgl_tm,
                    'note_tm11'            => $note_tm,
                ]; 
                
                $this->absen_pengajar->update($absen_pengajar_id, $updatepengajar);
            }
        } elseif ($tatap_muka == 'tm12') {
            $absen_pengajar_id  = $this->request->getPost('absen_pengajar_id');
            $checkpgj           = $this->request->getPost('checkpgj12'); 
            $tgl_tm             = $this->request->getPost('tgl_tm12');
            $note_tm            = $this->request->getPost('note_tm12');

            //Logic if radio button pengajar yang tidak terpilih
            if ($checkpgj == NULL) {
                $this->session->setFlashdata('pesan_error', 'ERROR! Data pengajar pada form absensi TM-12 belum diisi!, Pilih Hadir!');
                return redirect()->to($url_kelas);
            } else {
                //update data absen tm12 pengajar 
                $updatepengajar = [
                    'tm12_pengajar'        => $checkpgj,
                    'tgl_tm12'             => $tgl_tm,
                    'note_tm12'            => $note_tm,
                ]; 
                
                $this->absen_pengajar->update($absen_pengajar_id, $updatepengajar);
            }
        } elseif ($tatap_muka == 'tm13') {
            $absen_pengajar_id  = $this->request->getPost('absen_pengajar_id');
            $checkpgj           = $this->request->getPost('checkpgj13'); 
            $tgl_tm             = $this->request->getPost('tgl_tm13');
            $note_tm            = $this->request->getPost('note_tm13');

            //Logic if radio button pengajar yang tidak terpilih
            if ($checkpgj == NULL) {
                $this->session->setFlashdata('pesan_error', 'ERROR! Data pengajar pada form absensi TM-13 belum diisi!, Pilih Hadir!');
                return redirect()->to($url_kelas);
            } else {
                //update data absen tm13 pengajar 
                $updatepengajar = [
                    'tm13_pengajar'        => $checkpgj,
                    'tgl_tm13'             => $tgl_tm,
                    'note_tm13'            => $note_tm,
                ]; 
                
                $this->absen_pengajar->update($absen_pengajar_id, $updatepengajar);
            }
        } elseif ($tatap_muka == 'tm14') {
            $absen_pengajar_id  = $this->request->getPost('absen_pengajar_id');
            $checkpgj           = $this->request->getPost('checkpgj14'); 
            $tgl_tm             = $this->request->getPost('tgl_tm14');
            $note_tm            = $this->request->getPost('note_tm14');

            //Logic if radio button pengajar yang tidak terpilih
            if ($checkpgj == NULL) {
                $this->session->setFlashdata('pesan_error', 'ERROR! Data pengajar pada form absensi TM-14 belum diisi!, Pilih Hadir!');
                return redirect()->to($url_kelas);
            } else {
                //update data absen tm14 pengajar 
                $updatepengajar = [
                    'tm14_pengajar'        => $checkpgj,
                    'tgl_tm14'             => $tgl_tm,
                    'note_tm14'            => $note_tm,
                ]; 
                
                $this->absen_pengajar->update($absen_pengajar_id, $updatepengajar);
            }
        } elseif ($tatap_muka == 'tm15') {
            $absen_pengajar_id  = $this->request->getPost('absen_pengajar_id');
            $checkpgj           = $this->request->getPost('checkpgj15'); 
            $tgl_tm             = $this->request->getPost('tgl_tm15');
            $note_tm            = $this->request->getPost('note_tm15');

            //Logic if radio button pengajar yang tidak terpilih
            if ($checkpgj == NULL) {
                $this->session->setFlashdata('pesan_error', 'ERROR! Data pengajar pada form absensi TM-15 belum diisi!, Pilih Hadir!');
                return redirect()->to($url_kelas);
            } else {
                //update data absen tm15 pengajar 
                $updatepengajar = [
                    'tm15_pengajar'        => $checkpgj,
                    'tgl_tm15'             => $tgl_tm,
                    'note_tm15'            => $note_tm,
                ]; 
                
                $this->absen_pengajar->update($absen_pengajar_id, $updatepengajar);
            }
        } elseif ($tatap_muka == 'tm16') {
            $absen_pengajar_id  = $this->request->getPost('absen_pengajar_id');
            $checkpgj           = $this->request->getPost('checkpgj16'); 
            $tgl_tm             = $this->request->getPost('tgl_tm16');
            $note_tm            = $this->request->getPost('note_tm16');

            //Logic if radio button pengajar yang tidak terpilih
            if ($checkpgj == NULL) {
                $this->session->setFlashdata('pesan_error', 'ERROR! Data pengajar pada form absensi TM-16 belum diisi!, Pilih Hadir!');
                return redirect()->to($url_kelas);
            } else {
                //update data absen tm16 pengajar 
                $updatepengajar = [
                    'tm16_pengajar'        => $checkpgj,
                    'tgl_tm16'             => $tgl_tm,
                    'note_tm16'            => $note_tm,
                ]; 
                
                $this->absen_pengajar->update($absen_pengajar_id, $updatepengajar);
            }
        }

        //Logic loop setiap DATA PESERTA
        for ($i=0; $i<$total; $i++){

            //Variabel increment
            $var_tm         = 'check' . $i;
            $var_psrt       = 'psrt' . $i;
            $psrt_id        = $this->request->getPost($var_psrt);

            //Logic if setiap tatap muka
            if ($tatap_muka == 'tm1') {
                $check         = $this->request->getPost($var_tm);
                $checkpgj      = $this->request->getPost($var_checkpgj); 

                //Logic if radio button ada yang tidak terpilih
                if ($check == NULL) {
                    $this->session->setFlashdata('pesan_error', 'ERROR! Terdapat data peserta pada form absensi TM-1 belum diisi!, Pilih Hadir atau Tidak Hadir');
                    return redirect()->to($url_kelas);
                } else {
                    //update data absen tm1 setiap peserta
                    $updatedata = [
                        'tm1'        => $check,
                    ]; 
                    $this->absen_peserta->update($psrt_id, $updatedata);
                }
            } elseif ($tatap_muka == 'tm2') {
                $check         = $this->request->getPost($var_tm); 

                //Logic if radio button ada yang tidak terpilih
                if ($check == NULL) {
                    $this->session->setFlashdata('pesan_error', 'ERROR! Terdapat data peserta pada form absensi TM-2 belum diisi!, Pilih Hadir atau Tidak Hadir');
                    return redirect()->to($url_kelas);
                } else {
                    $updatedata = [
                        'tm2'        => $check,
                    ]; 
                    //update data absen tm1 setiap peserta 
                    $this->absen_peserta->update($psrt_id, $updatedata);
                }
            } elseif ($tatap_muka == 'tm3') {
                $check         = $this->request->getPost($var_tm); 

                //Logic if radio button ada yang tidak terpilih
                if ($check == NULL) {
                    $this->session->setFlashdata('pesan_error', 'ERROR! Terdapat data peserta pada form absensi TM-3 belum diisi!, Pilih Hadir atau Tidak Hadir');
                    return redirect()->to($url_kelas);
                } else {
                    $updatedata = [
                        'tm3'        => $check,
                    ]; 
                    //update data absen tm1 setiap peserta 
                    $this->absen_peserta->update($psrt_id, $updatedata);
                }
            } elseif ($tatap_muka == 'tm4') {
                $check         = $this->request->getPost($var_tm); 

                //Logic if radio button ada yang tidak terpilih
                if ($check == NULL) {
                    $this->session->setFlashdata('pesan_error', 'ERROR! Terdapat data peserta pada form absensi TM-4 belum diisi!, Pilih Hadir atau Tidak Hadir');
                    return redirect()->to($url_kelas);
                } else {
                    $updatedata = [
                        'tm4'        => $check,
                    ]; 
                    //update data absen tm1 setiap peserta 
                    $this->absen_peserta->update($psrt_id, $updatedata);
                }
            } elseif ($tatap_muka == 'tm5') {
                $check         = $this->request->getPost($var_tm); 

                //Logic if radio button ada yang tidak terpilih
                if ($check == NULL) {
                    $this->session->setFlashdata('pesan_error', 'ERROR! Terdapat data peserta pada form absensi TM-5 belum diisi!, Pilih Hadir atau Tidak Hadir');
                    return redirect()->to($url_kelas);
                } else {
                    $updatedata = [
                        'tm5'        => $check,
                    ]; 
                    //update data absen tm1 setiap peserta 
                    $this->absen_peserta->update($psrt_id, $updatedata);
                }
            } elseif ($tatap_muka == 'tm6') {
                $check         = $this->request->getPost($var_tm); 

                //Logic if radio button ada yang tidak terpilih
                if ($check == NULL) {
                    $this->session->setFlashdata('pesan_error', 'ERROR! Terdapat data peserta pada form absensi TM-6 belum diisi!, Pilih Hadir atau Tidak Hadir');
                    return redirect()->to($url_kelas);
                } else {
                    $updatedata = [
                        'tm6'        => $check,
                    ]; 
                    //update data absen tm1 setiap peserta 
                    $this->absen_peserta->update($psrt_id, $updatedata);
                }
            } elseif ($tatap_muka == 'tm7') {
                $check         = $this->request->getPost($var_tm); 

                //Logic if radio button ada yang tidak terpilih
                if ($check == NULL) {
                    $this->session->setFlashdata('pesan_error', 'ERROR! Terdapat data peserta pada form absensi TM-7 belum diisi!, Pilih Hadir atau Tidak Hadir');
                    return redirect()->to($url_kelas);
                } else {
                    $updatedata = [
                        'tm7'        => $check,
                    ]; 
                    //update data absen tm1 setiap peserta 
                    $this->absen_peserta->update($psrt_id, $updatedata);
                }
            } elseif ($tatap_muka == 'tm8') {
                $check         = $this->request->getPost($var_tm); 

                //Logic if radio button ada yang tidak terpilih
                if ($check == NULL) {
                    $this->session->setFlashdata('pesan_error', 'ERROR! Terdapat data peserta pada form absensi TM-8 belum diisi!, Pilih Hadir atau Tidak Hadir');
                    return redirect()->to($url_kelas);
                } else {
                    $updatedata = [
                        'tm8'        => $check,
                    ]; 
                    //update data absen tm1 setiap peserta 
                    $this->absen_peserta->update($psrt_id, $updatedata);
                }
            } elseif ($tatap_muka == 'tm9') {
                $check         = $this->request->getPost($var_tm); 

                //Logic if radio button ada yang tidak terpilih
                if ($check == NULL) {
                    $this->session->setFlashdata('pesan_error', 'ERROR! Terdapat data peserta pada form absensi TM-9 belum diisi!, Pilih Hadir atau Tidak Hadir');
                    return redirect()->to($url_kelas);
                } else {
                    $updatedata = [
                        'tm9'        => $check,
                    ]; 
                    //update data absen tm1 setiap peserta 
                    $this->absen_peserta->update($psrt_id, $updatedata);
                }
            } elseif ($tatap_muka == 'tm10') {
                $check         = $this->request->getPost($var_tm); 

                //Logic if radio button ada yang tidak terpilih
                if ($check == NULL) {
                    $this->session->setFlashdata('pesan_error', 'ERROR! Terdapat data peserta pada form absensi TM-10 belum diisi!, Pilih Hadir atau Tidak Hadir');
                    return redirect()->to($url_kelas);
                } else {
                    $updatedata = [
                        'tm10'        => $check,
                    ]; 
                    //update data absen tm1 setiap peserta 
                    $this->absen_peserta->update($psrt_id, $updatedata);
                }
            } elseif ($tatap_muka == 'tm11') {
                $check         = $this->request->getPost($var_tm); 

                //Logic if radio button ada yang tidak terpilih
                if ($check == NULL) {
                    $this->session->setFlashdata('pesan_error', 'ERROR! Terdapat data peserta pada form absensi TM-11 belum diisi!, Pilih Hadir atau Tidak Hadir');
                    return redirect()->to($url_kelas);
                } else {
                    $updatedata = [
                        'tm11'        => $check,
                    ]; 
                    //update data absen tm1 setiap peserta 
                    $this->absen_peserta->update($psrt_id, $updatedata);
                }
            } elseif ($tatap_muka == 'tm12') {
                $check         = $this->request->getPost($var_tm); 

                //Logic if radio button ada yang tidak terpilih
                if ($check == NULL) {
                    $this->session->setFlashdata('pesan_error', 'ERROR! Terdapat data peserta pada form absensi TM-12 belum diisi!, Pilih Hadir atau Tidak Hadir');
                    return redirect()->to($url_kelas);
                } else {
                    $updatedata = [
                        'tm12'        => $check,
                    ]; 
                    //update data absen tm1 setiap peserta 
                    $this->absen_peserta->update($psrt_id, $updatedata);
                }
            } elseif ($tatap_muka == 'tm13') {
                $check         = $this->request->getPost($var_tm); 

                //Logic if radio button ada yang tidak terpilih
                if ($check == NULL) {
                    $this->session->setFlashdata('pesan_error', 'ERROR! Terdapat data peserta pada form absensi TM-13 belum diisi!, Pilih Hadir atau Tidak Hadir');
                    return redirect()->to($url_kelas);
                } else {
                    $updatedata = [
                        'tm13'        => $check,
                    ]; 
                    //update data absen tm1 setiap peserta 
                    $this->absen_peserta->update($psrt_id, $updatedata);
                }
            } elseif ($tatap_muka == 'tm14') {
                $check         = $this->request->getPost($var_tm); 

                //Logic if radio button ada yang tidak terpilih
                if ($check == NULL) {
                    $this->session->setFlashdata('pesan_error', 'ERROR! Terdapat data peserta pada form absensi TM-14 belum diisi!, Pilih Hadir atau Tidak Hadir');
                    return redirect()->to($url_kelas);
                } else {
                    $updatedata = [
                        'tm14'        => $check,
                    ]; 
                    //update data absen tm1 setiap peserta 
                    $this->absen_peserta->update($psrt_id, $updatedata);
                }
            } elseif ($tatap_muka == 'tm15') {
                $check         = $this->request->getPost($var_tm); 

                //Logic if radio button ada yang tidak terpilih
                if ($check == NULL) {
                    $this->session->setFlashdata('pesan_error', 'ERROR! Terdapat data peserta pada form absensi TM-15 belum diisi!, Pilih Hadir atau Tidak Hadir');
                    return redirect()->to($url_kelas);
                } else {
                    $updatedata = [
                        'tm15'        => $check,
                    ]; 
                    //update data absen tm1 setiap peserta 
                    $this->absen_peserta->update($psrt_id, $updatedata);
                }
            } elseif ($tatap_muka == 'tm16') {
                $check         = $this->request->getPost($var_tm); 

                //Logic if radio button ada yang tidak terpilih
                if ($check == NULL) {
                    $this->session->setFlashdata('pesan_error', 'ERROR! Terdapat data peserta pada form absensi TM-16 belum diisi!, Pilih Hadir atau Tidak Hadir');
                    return redirect()->to($url_kelas);
                } else {
                    $updatedata = [
                        'tm16'        => $check,
                    ]; 
                    //update data absen tm1 setiap peserta 
                    $this->absen_peserta->update($psrt_id, $updatedata);
                }
            }
        }
        $this->session->setFlashdata('pesan_sukses', 'BERHASIL! Semua data absensi pengajar dan peserta Tatap Muka terisi');
        return redirect()->to($url_kelas); 
    }

    public function input_tm_pengajar()
    {
        if ($this->request->isAJAX()) {

            $tm         = $this->request->getVar('tm');
            $tm_upper   = strtoupper($tm);
            $kelas_id   = $this->request->getVar('kelas_id');
            $absen_tm   = $this->peserta_kelas->peserta_onkelas_absen_tm($tm, $kelas_id);
            $data = [
                'title'         => 'Absensi Peserta',
                'tm'            => $tm,
                'kelas_id'      => $kelas_id,
                'tm_upper'      => $tm_upper,
                'absen_tm'      => $absen_tm ,
            ];

            $msg = [
                'sukses' => view('auth/absen/input_tm_pengajar', $data)
            ];
            echo json_encode($msg);
        }
    }

}
