<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelspp1 extends Model
{
    protected $table      = 'program_bayar_spp1 ';
    protected $primaryKey = 'spp1_id';
    protected $allowedFields = ['spp1_bayar_id', 'bayar_daftar', 'bayar_spp1', 'status_spp1'];
}
