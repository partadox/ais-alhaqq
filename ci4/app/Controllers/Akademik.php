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
        $kelas_peserta_lulus= $this->peserta_kelas->kelas_peserta_lulus($peserta_id);

        $data = [
            'title'         => 'Al-Haqq - Akademik Peserta',
            'kelas'         => $kelas_peserta,
            'kelas_lulus'   => $kelas_peserta_lulus,
        ];

        return view('auth/akademik/index', $data); 
    }
}
