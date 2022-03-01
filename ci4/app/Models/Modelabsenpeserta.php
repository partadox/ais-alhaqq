<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelabsenpeserta extends Model
{
    protected $table      = 'absen_peserta';
    protected $primaryKey = 'absen_peserta_id';
    protected $allowedFields = ['tm1', 'tm2' , 'tm3', 'tm4', 'tm5', 'tm6', 'tm7', 'tm8', 'tm9', 'tm10', 'tm11', 'tm12', 'tm13', 'tm14', 'tm15', 'tm16'];

}
