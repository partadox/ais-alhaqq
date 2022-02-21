<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelpeserta extends Model
{
    protected $table      = 'peserta';
    protected $primaryKey = 'peserta_id';
    protected $allowedFields = ['user_id', 'asal_cabang_peserta','level_peserta','nama_peserta', 'status_peserta', 'nik', 'tmp_lahir', 'tgl_lahir', 'jenkel', 'pendidikan', 'jurusan', 'status_kerja','pekerjaan', 'domisili_peserta', 'alamat', 'hp', 'email', 'nis', 'angkatan', 'tgl_gabung'];

    //backend

    public function get_peserta($user_id)
    {
        return $this->table('peserta')
            ->where('user_id', $user_id)
            ->get()
            ->getRowArray();
    }

    public function get_peserta_id($user_id)
    {
        return $this->table('peserta')
            ->select('peserta_id')
            ->where('user_id', $user_id)
            ->get()
            ->getUnbufferedRow();
    }

    //Untuk filter level - Daftar Program Peserta
    public function get_peserta_level($user_id)
    {
        return $this->table('peserta')
            ->select('level_peserta')
            ->where('user_id', $user_id)
            ->get()
            ->getUnbufferedRow();
    }

    //Untuk filter jenis kelamin - Daftar Program Peserta
    public function get_peserta_jenkel($user_id)
    {
        return $this->table('peserta')
            ->select('jenkel')
            ->where('user_id', $user_id)
            ->get()
            ->getUnbufferedRow();
    }

    //Untuk filter status kerja - Daftar Program Peserta
    public function get_peserta_status_kerja($user_id)
    {
        return $this->table('peserta')
            ->select('status_kerja')
            ->where('user_id', $user_id)
            ->get()
            ->getUnbufferedRow();
    }

    //Untuk filter domisili - Daftar Program Peserta
    public function get_peserta_domisili($user_id)
    {
        return $this->table('peserta')
            ->select('domisili_peserta')
            ->where('user_id', $user_id)
            ->get()
            ->getUnbufferedRow();
    }

    //Hapus Akun Peserta saat Data Peserta Dihapus - Get User id
    public function get_user_id($peserta_id)
    {
        return $this->table('peserta')
            ->select('user_id')
            ->where('peserta_id', $peserta_id)
            ->get()
            ->getUnbufferedRow();
    }

    // Get List All Data Peserta for view of datatable
    public function list()
    {
        return $this->table('peserta')
            ->join('peserta_level', 'peserta_level.peserta_level_id = peserta.level_peserta')
            ->join('user', 'user.user_id = peserta.user_id')
            ->join('kantor_cabang', 'kantor_cabang.kantor_id = peserta.asal_cabang_peserta')
            ->orderBy('peserta_id', 'DESC')
            ->get()->getResultArray();
    }

    //Dashboard - Admin
    public function jml_peserta()
    {
        return $this->table('peserta')
        ->countAllResults();
    }

    //Cek data duplikat - import file excel pada data peserta
    public function cek_duplikat_import($nis)
    {
        return $this->table('peserta')
            ->where('nis', $nis)
            ->countAllResults();
    }
}
