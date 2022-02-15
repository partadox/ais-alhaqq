<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelprogramdata extends Model
{
    protected $table      = 'program';
    protected $primaryKey = 'program_id';
    protected $allowedFields = ['nama_program', 'jenis_program', 'kategori_program', 'biaya_program', 'biaya_bulanan', 'biaya_modul', 'biaya_daftar', 'status_program'];

    //backend
    public function list()
    {
        return $this->table('program')
            //->orderBy('nama_program', 'ASC')
            ->get()->getResultArray();
    }

    public function list_aktif()
    {
        return $this->table('program')
            ->orderBy('nama_program', 'ASC')
            ->where('status_program', 'aktif')
            ->get()->getResultArray();
    }

    //Dashboaed - Admin
    public function jml_program()
    {
        return $this->table('program')
        ->countAllResults();
    }
}
