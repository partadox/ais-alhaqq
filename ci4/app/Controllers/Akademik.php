<?php

namespace App\Controllers;

use Config\Services;

class Akademik extends BaseController
{
    public function index()
    {
        //Get All Data Peserta
        $user_id     = session()->get('user_id');
        $get_peserta = $this->peserta->get_peserta($user_id);

        //Get data peserta id
        $get_peserta_id = $this->peserta->get_peserta_id($user_id);
        $peserta_id     = $get_peserta_id->peserta_id;

        //Get kelas peserta 
        $kelas_peserta      = $this->peserta_kelas->kelas_peserta($peserta_id);
        // $kelas_peserta_lulus= $this->peserta_kelas->kelas_peserta_lulus($peserta_id);

        $data = [
            'title'         => 'Al-Haqq - Akademik Peserta',
            'kelas'         => $kelas_peserta,
            // 'kelas_lulus'   => $kelas_peserta_lulus,
        ];

        return view('auth/akademik/index', $data); 
    }

    public function admin_rekap_absen_peserta()
    {
        $uri                = service('uri');
        $get_angkatan_url   = $uri->getSegment(4);
        if ($get_angkatan_url == NULL) {
            $get_angkatan       = $this->konfigurasi->angkatan_kuliah();
            //Angkatan perkuliahan
            $angkatan           = $get_angkatan->angkatan_kuliah;
        } elseif ($get_angkatan_url != NULL) {
            $angkatan = $get_angkatan_url;
        }
        
        $list_angkatan      = $this->program->list_unik_angkatan();
        $list_absensi       = $this->peserta_kelas->admin_rekap_absen_peserta($angkatan);

        $data = [
            'title'         => 'Al-Haqq - Data Absensi Peserta pada Angkatan Perkuliahan ' . $angkatan,
            'list'          => $list_absensi,
            'list_angkatan' => $list_angkatan,
            'angkatan_pilih'=> $angkatan,
        ];
        return view('auth/akademik/rekap_absen_peserta', $data);
    }

    public function admin_rekap_absen_pengajar()
    {
        $uri                = service('uri');
        $get_angkatan_url   = $uri->getSegment(4);
        if ($get_angkatan_url == NULL) {
            $get_angkatan       = $this->konfigurasi->angkatan_kuliah();
            //Angkatan perkuliahan
            $angkatan           = $get_angkatan->angkatan_kuliah;
        } elseif ($get_angkatan_url != NULL) {
            $angkatan = $get_angkatan_url;
        }
        
        $list_angkatan      = $this->program->list_unik_angkatan();
        $list_absensi       = $this->program->admin_rekap_absen_pengajar($angkatan);
        
        $data = [
            'title'         => 'Al-Haqq - Data Absensi Pengajar pada Angkatan Perkuliahan ' . $angkatan,
            'list'          => $list_absensi,
            'list_angkatan' => $list_angkatan,
            'angkatan_pilih'=> $angkatan,
        ];
        return view('auth/akademik/rekap_absen_pengajar', $data);
    }

    public function admin_rekap_ujian()
    {
        $uri                = service('uri');
        $get_angkatan_url   = $uri->getSegment(4);
        if ($get_angkatan_url == NULL) {
            $get_angkatan       = $this->konfigurasi->angkatan_kuliah();
            //Angkatan perkuliahan
            $angkatan           = $get_angkatan->angkatan_kuliah;
        } elseif ($get_angkatan_url != NULL) {
            $angkatan = $get_angkatan_url;
        }
        
        $list_angkatan      = $this->program->list_unik_angkatan();
        $list_ujian         = $this->peserta_kelas->admin_rekap_ujian($angkatan);

        $data = [
            'title'         => 'Al-Haqq - Data Ujian Peserta pada Angkatan Perkuliahan ' . $angkatan,
            'list'          => $list_ujian,
            'list_angkatan' => $list_angkatan,
            'angkatan_pilih'=> $angkatan,
        ];
        return view('auth/akademik/rekap_ujian_peserta', $data);
    }
}
