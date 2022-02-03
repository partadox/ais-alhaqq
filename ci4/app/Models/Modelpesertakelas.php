<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelpesertakelas extends Model
{
    protected $table      = 'peserta_kelas';
    protected $primaryKey = 'peserta_kelas_id';
    protected $allowedFields = ['peserta_kelas_id', 'data_peserta_id','data_kelas_id', 'status_peserta_kelas'];

    //Cek jumlah kelas yang diikuti peserta
    public function cek_peserta_kelas($peserta_id)
    {
        return $this->table('peserta_kelas')
        ->join('peserta', 'peserta.peserta_id = peserta_kelas.data_peserta_id')
        ->where('status_peserta_kelas', 'Belum Lulus')
        ->where('data_peserta_id', $peserta_id)
        ->countAllResults();
    }

    public function peserta_onkelas($kelas_id)
    {
        return $this->table('peserta_kelas')
            ->join('peserta', 'peserta.peserta_id = peserta_kelas.data_peserta_id')
            ->where('data_kelas_id', $kelas_id)
            ->where('status_peserta_kelas', 'Belum Lulus')
            ->orderBy('nama_peserta', 'ASC')
            ->get()->getResultArray();
    }

    //Cek Kelas Peserta
    public function kelas_peserta($peserta_id)
    {
        return $this->table('peserta_kelas')
        ->join('peserta', 'peserta.peserta_id = peserta_kelas.data_peserta_id')
        ->join('program_kelas', 'program_kelas.kelas_id = peserta_kelas.data_kelas_id')
        ->join('program', 'program.program_id = program_kelas.program_id')
        ->join('pengajar', 'pengajar.pengajar_id = program_kelas.pengajar_id')
        ->where('status_peserta_kelas', 'Belum Lulus')
        ->where('data_peserta_id', $peserta_id)
        ->get()->getResultArray();
    }

    //Dashboard Peserta - Hitung Jumlah Kelas Sedang Diikuti
    public function jml_kelas_sedang_ikut($peserta_id)
    {
        return $this->table('peserta_kelas')
        ->where('status_peserta_kelas', 'Belum Lulus')
        ->where('data_peserta_id', $peserta_id)
        ->countAllResults();
    }


}
