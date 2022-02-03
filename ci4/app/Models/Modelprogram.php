<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelprogram extends Model
{
    protected $table      = 'program_kelas ';
    protected $primaryKey = 'kelas_id';
    protected $allowedFields = ['program_id', 'peserta_level','pengajar_id', 'nama_kelas', 'hari_kelas', 'waktu_kelas', 'jenkel', 'status_kerja', 'kouta', 'sisa_kouta', 'metode_kelas','status_kelas'];

    //Custom Query
    public function aktif($peserta_level, $peserta_jenkel, $peserta_status_kerja)
    {
        return $this->table('program_kelas')
            ->join('program', 'program.program_id = program_kelas.program_id')
            ->where('status_kelas', 'aktif')
            ->where('peserta_level', $peserta_level)
            ->where('jenkel', $peserta_jenkel)
            ->where('status_kerja', $peserta_status_kerja)
            ->orderBy('kelas_id', 'ASC')
            ->get()->getResultArray();
    }
    public function aktif_pekerja($peserta_level, $peserta_jenkel)
    {
        return $this->table('program_kelas')
            ->join('program', 'program.program_id = program_kelas.program_id')
            ->where('status_kelas', 'aktif')
            ->where('peserta_level', $peserta_level)
            ->where('jenkel', $peserta_jenkel)
            ->orderBy('kelas_id', 'ASC')
            ->get()->getResultArray();
    }

    // Get Sisa Kouta
    public function get_sisa_kouta($kelas_id)
    {
        return $this->table('program_kelas')
            ->select('sisa_kouta')
            ->where('kelas_id', $kelas_id)
            ->get()
            ->getUnbufferedRow();
    }

    // Get Data Kelas
    public function list()
    {
        return $this->table('program_kelas')
            ->join('program', 'program.program_id = program_kelas.program_id')
            ->join('pengajar', 'pengajar.pengajar_id = program_kelas.pengajar_id')
            ->join('peserta_level', 'peserta_level.peserta_level_id = program_kelas.peserta_level')
            ->orderBy('kelas_id', 'DESC')
            ->get()->getResultArray();
    }

    public function list_ada_kouta()
    {
        return $this->table('program_kelas')
            ->join('program', 'program.program_id = program_kelas.program_id')
            ->join('pengajar', 'pengajar.pengajar_id = program_kelas.pengajar_id')
            ->where('sisa_kouta !=', 0)
            ->orderBy('kelas_id', 'DESC')
            ->get()->getResultArray();
    }

    //Dashboaed - Admin
    public function jml_kelas()
    {
        return $this->table('program_kelas')
        ->countAllResults();
    }
}
