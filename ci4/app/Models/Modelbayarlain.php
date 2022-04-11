<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelbayarlain extends Model
{
    protected $table      = 'program_bayar_lainnya';
    protected $primaryKey = 'biaya_lainnya_id';
    protected $allowedFields = ['lainnya_bayar_id', 'bayar_lainnya', 'status_bayar_lainnya', 'data_peserta_id_lain'];
}
