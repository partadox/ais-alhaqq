<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelujian extends Model
{
    protected $table      = 'ujian';
    protected $primaryKey = 'ujian_id';
    protected $allowedFields = ['tgl_ujian', 'waktu_ujian', 'nilai_ujian', 'nilai_akhir'];

}
