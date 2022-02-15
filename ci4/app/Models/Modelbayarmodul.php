<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelbayarmodul extends Model
{
    protected $table      = 'program_bayar_modul';
    protected $primaryKey = 'modul_id';
    protected $allowedFields = ['bayar_modul_id', 'bayar_modul', 'status_bayar_modul'];
}
