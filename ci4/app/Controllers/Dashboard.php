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

        //Angkatan
        $get_angkatan       = $this->konfigurasi->angkatan_kuliah();
        $angkatan           = $get_angkatan->angkatan_kuliah;

        //Dashboard Admin
        $jml_konfrimasi     = $this->program_bayar->jml_bayar_proses();
        $jml_peserta        = $this->peserta->jml_peserta();
        $jml_kantor         = $this->kantor_cabang->jml_kantor();
        $jml_program        = $this->program_data->jml_program();
        $jml_kelas          = $this->program->jml_kelas();
        $jml_pengajar       = $this->pengajar->jml_pengajar();
        $jml_akun_pengajar  = $this->user->jml_akun_pengajar();
        $jml_akun_peserta   = $this->user->jml_akun_peserta();

        //Rekap SPP - Pie Chart
        $get_spp_belum_lunas= $this->peserta_kelas->pie_spp_belum_lunas($angkatan);
        $spp_belum_lunas    = $get_spp_belum_lunas->spp_status;
        $get_spp_lunas      = $this->peserta_kelas->pie_spp_lunas($angkatan);
        $spp_lunas          = $get_spp_lunas->spp_status;
        // $pie_spp_rekap      = [
        //    'BELUM LUNAS'   => $spp_belum_lunas,
        //    'LUNAS'         => $spp_lunas,
        // ];
        
        
        $data = [
            'title'                 => 'Al-Haqq - Dashboard',
            'angkatan'              => $angkatan,
            'konfirmasi'            => $jml_konfrimasi,
            'kantor'                => $jml_kantor,
            'program'               => $jml_program,
            'kelas'                 => $jml_kelas,  
            'peserta'               => $jml_peserta,
            'pengajar'              => $jml_pengajar,
            'akun_pengajar'         => $jml_akun_pengajar,
            'akun_peserta'          => $jml_akun_peserta,
            'cek1'                  => $cek1,
            'spp_lunas'             => $spp_lunas,
            'spp_belum_lunas'       => $spp_belum_lunas,
        ];

        return view('auth/dashboard', $data);
    }
}
