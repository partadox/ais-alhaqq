<?php

namespace App\Models;

use CodeIgniter\Model;

class Modellevel extends Model
{
    protected $table      = 'peserta_level';
    protected $primaryKey = 'peserta_level_id';
    protected $allowedFields = ['nama_level', 'urutan_level', 'tampil_ondaftar'];

    //backend
    public function list()
    {
        return $this->table('peserta_level')
            ->orderBy('urutan_level', 'ASC')
            ->get()->getResultArray();
    }

    public function list_tampil_ondaftar()
    {
        return $this->table('peserta_level')
            ->where('tampil_ondaftar',1)
            ->orderBy('urutan_level', 'ASC')
            ->get()->getResultArray();
    }

}
