<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelujian extends Model
{
    protected $table      = 'ujian';
    protected $primaryKey = 'ujian_id';
    protected $allowedFields = ['tgl_ujian', 'waktu_ujian', 'nilai_ujian', 'nilai_akhir'];

    //Cek data duplikat - import file excel pada data admin rekap ujian peserta
    public function cek_ujian($id_ujian)
    {
        return $this->table('ujian')
            ->where('ujian_id', $id_ujian)
            ->countAllResults();
    }

}
