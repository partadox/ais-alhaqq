<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelprogram extends Model
{
    protected $table      = 'program_kelas ';
    protected $primaryKey = 'kelas_id';
    protected $allowedFields = ['program_id', 'peserta_level','pengajar_id', 'nama_kelas', 'angkatan_kelas', 'hari_kelas', 'waktu_kelas', 'zona_waktu_kelas', 'jenkel', 'status_kerja', 'kouta', 'sisa_kouta', 'metode_kelas','status_kelas'];

    //Daftar kelas untuk peserta -> TIDAK Bekerja -> Domisili Luar
    public function aktif($peserta_level, $peserta_jenkel, $peserta_status_kerja)
    {
        return $this->table('program_kelas')
            ->join('program', 'program.program_id = program_kelas.program_id')
            ->where('status_kelas', 'aktif')
            ->where('peserta_level', $peserta_level)
            ->where('jenkel', $peserta_jenkel)
            ->where('status_kerja', $peserta_status_kerja)
            ->where('metode_kelas', 'ONLINE')
            ->orderBy('kelas_id', 'ASC')
            ->get()->getResultArray();
    }

    //Daftar kelas untuk peserta -> TIDAK Bekerja -> Domisili Balikpapan
    public function aktif_balikpapan($peserta_level, $peserta_jenkel, $peserta_status_kerja)
    {
        return $this->table('program_kelas')
            ->join('program', 'program.program_id = program_kelas.program_id')
            ->where('status_kelas', 'aktif')
            ->where('peserta_level', $peserta_level)
            ->where('jenkel', $peserta_jenkel)
            ->where('status_kerja', $peserta_status_kerja)
            ->where('metode_kelas', 'OFFLINE')
            ->orderBy('kelas_id', 'ASC')
            ->get()->getResultArray();
    }

    //Daftar kelas untuk peserta -> Bekerja -> Domisili Luar
    public function aktif_pekerja($peserta_level, $peserta_jenkel)
    {
        return $this->table('program_kelas')
            ->join('program', 'program.program_id = program_kelas.program_id')
            ->where('status_kelas', 'aktif')
            ->where('peserta_level', $peserta_level)
            ->where('jenkel', $peserta_jenkel)
            ->where('metode_kelas', 'ONLINE')
            ->orderBy('kelas_id', 'ASC')
            ->get()->getResultArray();
    }

    //Daftar kelas untuk peserta -> Bekerja -> Domisili Balikpapan
    public function aktif_pekerja_balikpapan($peserta_level, $peserta_jenkel)
    {
        return $this->table('program_kelas')
            ->join('program', 'program.program_id = program_kelas.program_id')
            ->where('status_kelas', 'aktif')
            ->where('peserta_level', $peserta_level)
            ->where('jenkel', $peserta_jenkel)
            ->where('metode_kelas', 'OFFLINE')
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

    public function list_detail_kelas($kelas_id)
    {
        return $this->table('program_kelas')
            ->join('program', 'program.program_id = program_kelas.program_id')
            ->join('pengajar', 'pengajar.pengajar_id = program_kelas.pengajar_id')
            ->join('peserta_level', 'peserta_level.peserta_level_id = program_kelas.peserta_level')
            ->where('kelas_id', $kelas_id)
            ->get()->getResultArray();
    }

    //Group_concat hitung table jumlah fk dari pk tabel lain
    //  public function list_kelas_dan_jml_peserta()
    //  {
    //     return $this->table('program_kelas')
    //     ->join('program', 'program.program_id = program_kelas.program_id')
    //     ->join('pengajar', 'pengajar.pengajar_id = program_kelas.pengajar_id')
    //     ->join('peserta_level', 'peserta_level.peserta_level_id = program_kelas.peserta_level')
    //     ->join('peserta_kelas', 'data_kelas_id = program_kelas.kelas_id', 'left')
    //     ->count('data_kelas_id')
    //     ->orderBy('kelas_id', 'DESC')
    //     ->get()->getResultArray();
    //  }

    //Dashboard - Admin
    public function jml_kelas()
    {
        return $this->table('program_kelas')
        ->countAllResults();
    }
}
