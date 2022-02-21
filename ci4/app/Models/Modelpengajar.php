<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelpengajar extends Model
{
    protected $table      = 'pengajar';
    protected $primaryKey = 'pengajar_id';
    protected $allowedFields = ['user_id', 'asal_kantor', 'tipe_pengajar','nama_pengajar', 'nik_pengajar', 'jenkel_pengajar', 'tmp_lahir_pengajar', 'tgl_lahir_pengajar', 'suku_bangsa', 'status_nikah', 'jumlah_anak', 'pendidikan_pengajar', 'jurusan_pengajar', 'tgl_gabung_pengajar', 'hp_pengajar', 'email_pengajar', 'alamat_pengajar', 'foto_pengajar'];

    //backend
    public function list()
    {
        return $this->table('pengajar')
            ->join('kantor_cabang', 'kantor_cabang.kantor_id = pengajar.asal_kantor')
            ->join('user', 'user.user_id = pengajar.user_id')
            //->orderBy('nama_program', 'ASC')
            ->get()->getResultArray();
    }

    //Hapus Akun Pengajar saat Data Pengajar Dihapus - Get User id
    public function get_user_id($pengajar_id)
    {
        return $this->table('pengajar')
            ->select('user_id')
            ->where('pengajar_id', $pengajar_id)
            ->get()
            ->getUnbufferedRow();
    }

    //Dashboaed - Admin
    public function jml_pengajar()
    {
        return $this->table('pengajar')
        ->countAllResults();
    }

    //Cek data duplikat - import file excel pada data peserta
    public function cek_duplikat_import($nik)
    {
        return $this->table('pengajar')
            ->where('nik', $nik)
            ->countAllResults();
    }
}
