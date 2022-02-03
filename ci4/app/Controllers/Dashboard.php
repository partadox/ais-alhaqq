<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('auth/login');
        }

        //Dashboard Admin
        $jml_konfrimasi = $this->program_bayar->jml_bayar_proses();
        $jml_peserta    = $this->peserta->jml_peserta();
        $jml_kantor     = $this->kantor_cabang->jml_kantor();
        $jml_program    = $this->program_data->jml_program();
        $jml_kelas      = $this->program->jml_kelas();
        $jml_pengajar   = $this->pengajar->jml_pengajar();
        
        $data = [
            'title'                 => 'Al-Haqq - Dashboard',
            'konfirmasi'            => $jml_konfrimasi,
            'kantor'                => $jml_kantor,
            'program'               => $jml_program,
            'kelas'                 => $jml_kelas,  
            'peserta'               => $jml_peserta,
            'pengajar'              => $jml_pengajar,
        ];
        return view('auth/dashboard', $data);
    }
}
