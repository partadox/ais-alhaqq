<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('auth/login');
        }

        //Get level akun user
        $level_usr  =  session()->get('level');
        if ($level_usr == 4) {
            $user_id = session()->get('user_id');
            $get_peserta = $this->peserta->get_peserta_id($user_id);
            $peserta_id = $get_peserta->peserta_id;
            $cek1 = $this->program_bayar->cek_belum_lunas($peserta_id);
        } else {
            $cek1 = NULL;
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
            'cek1'                  => $cek1,
        ];
        return view('auth/dashboard', $data);
    }
}
