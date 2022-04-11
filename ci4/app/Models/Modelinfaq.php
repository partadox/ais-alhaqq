<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelinfaq extends Model
{
    protected $table      = 'program_bayar_infaq';
    protected $primaryKey = 'infaq_id';
    protected $allowedFields = ['infaq_bayar_id',  'bayar_infaq', 'data_peserta_id_infaq'];
}
