<?php

namespace App\Models;

use CodeIgniter\Model;

class Modeluser extends Model
{
    protected $table      = 'user ';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['username', 'nama', 'password', 'foto', 'level', 'active'];

    //backend
    public function list()
    {
        return $this->table('user')
            ->orderBy('user_id', 'ASC')
            ->get()->getResultArray();
    }

    public function list_peserta()
    {
        return $this->table('user')
            ->where('level', 4)
            ->orderBy('user_id', 'ASC')
            ->get()->getResultArray();
    }

    public function list_pengajar()
    {
        return $this->table('user')
            ->where('level', 5)
            ->orwhere('level', 6)
            ->orderBy('user_id', 'ASC')
            ->get()->getResultArray();
    }

    public function list_pengajar_nonaktif()
    {
        return $this->table('user')
            ->where('active', 0)
            ->where('level', 5)
            ->orwhere('level', 6)
            ->orderBy('user_id', 'ASC')
            ->get()->getResultArray();
    }

    public function list_peserta_pengajar()
    {
        //$where = "level=4 OR level=5";
        return $this->table('user')
            ->where('level',  4) 
            ->orwhere('level', 5)
            ->orwhere('level', 6)
            //->join('user_level', 'user_level.user_level_id = user.level')
            ->orderBy('user_id', 'ASC')
            ->get()->getResultArray();
    }

    public function list_admin()
    {
        //$where = "level=4 OR level=5";
        return $this->table('user')
            ->where('level',  2) 
            ->orwhere('level', 3)
            ->orwhere('level', 7)
            //->join('user_level', 'user_level.user_level_id = user.level')
            ->orderBy('user_id', 'ASC')
            ->get()->getResultArray();
    }

    public function getaktif()
    {
        return $this->table('user')
            ->like('active', '1')
            ->orderBy('user_id', 'ASC')
            ->get()->getResultArray();
    }

    public function getnonaktif()
    {
        return $this->table('user')
            ->where('active', 0)
            ->orderBy('user_id', 'ASC')
            ->get()->getResultArray();
    }

    public function getnonaktif_peserta()
    {
        return $this->table('user')
            ->where('active', 0)
            ->where('level', 4)
            ->orderBy('user_id', 'ASC')
            ->get()->getResultArray();
    }

    //Cek data duplikat - import file excel pada data akun user peserta
    public function cek_duplikat_import_akun_peserta($username)
    {
        return $this->table('user')
            ->where('username', $username)
            ->countAllResults();
    }

    //Cek data akun peserta ada atau tidak berdasarkan user_id
    public function cek_multiple_edit($user_id)
    {
        return $this->table('user')
            ->where('user_id', $user_id)
            ->countAllResults();
    }

    //Dashboard - Admin - Jumlah Akun Pengajar
    public function jml_akun_pengajar()
    {
        return $this->table('user')
        ->where('level', 5)
        ->orwhere('level', 6)
        ->countAllResults();
    }

    //Dashboard - Admin - Jumlah Akun Peserta
    public function jml_akun_peserta()
    {
        return $this->table('user')
        ->where('level', 4)
        ->countAllResults();
    }

}
