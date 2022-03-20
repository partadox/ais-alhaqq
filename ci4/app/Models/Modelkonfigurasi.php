<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelkonfigurasi extends Model
{
    protected $table      = 'konfigurasi';
    protected $primaryKey = 'konfigurasi_id';
    protected $allowedFields = ['nama_web', 'deskripsi', 'visi', 'misi', 'instagram', 'facebook', 'whatsapp', 'email', 'alamat', 'logo', 'icon', 'status_pendaftaran','angkatan_kuliah', 'filter_domisili'];

    //backend
    public function list()
    {
        return $this->table('konfigurasi')
            ->orderBy('konfigurasi_id', 'ASC')
            ->get()->getResultArray();
    }

    //Mendapatkan angkatan perkuliahan
    public function angkatan_kuliah()
    {
        return $this->table('konfigurasi')
            ->select('angkatan_kuliah')
            ->get()
            ->getUnbufferedRow();
    }

    //Mendapatkan status pendaftarn
    public function status_pendaftaran()
    {
        return $this->table('konfigurasi')
            ->select('status_pendaftaran')
            ->get()
            ->getUnbufferedRow();
    }

    //Mendapatkan status aktif filter domisili
    public function filter_domisili()
    {
        return $this->table('konfigurasi')
            ->select('filter_domisili')
            ->get()
            ->getUnbufferedRow();
    }
}
