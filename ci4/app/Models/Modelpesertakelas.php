<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelpesertakelas extends Model
{
    protected $table      = 'peserta_kelas';
    protected $primaryKey = 'peserta_kelas_id';
    protected $allowedFields = ['peserta_kelas_id', 'data_peserta_id','data_kelas_id', 'data_absen', 'data_ujian', 'status_peserta_kelas', 'byr_daftar', 'byr_modul','byr_spp1','byr_spp2','byr_spp3', 'byr_spp4',];

    //Cek jumlah kelas yang diikuti peserta
    public function cek_peserta_kelas($peserta_id)
    {
        return $this->table('peserta_kelas')
        ->join('peserta', 'peserta.peserta_id = peserta_kelas.data_peserta_id')
        // ->where('status_peserta_kelas', 'Belum Lulus')
        ->where('data_peserta_id', $peserta_id)
        ->countAllResults();
    }

    public function peserta_onkelas($kelas_id)
    {
        return $this->table('peserta_kelas')
            ->join('peserta', 'peserta.peserta_id = peserta_kelas.data_peserta_id')
            ->where('data_kelas_id', $kelas_id)
            // ->where('status_peserta_kelas', 'Belum Lulus')
            ->orderBy('nama_peserta', 'ASC')
            ->get()->getResultArray();
    }

    //Jumlah peserta dalam kelas - Peserta_Kelas
    public function jumlah_peserta_onkelas($kelas_id)
    {
        return $this->table('peserta_kelas')
            ->where('data_kelas_id', $kelas_id)
            ->countAllResults();
    }

    // Get Data Peserta utk show di modal pindah kelas
    public function get_peserta_id($peserta_kelas_id)
    {
        return $this->table('program_kelas')
            ->select('data_peserta_id')
            ->where('peserta_kelas_id', $peserta_kelas_id)
            ->get()
            ->getUnbufferedRow();
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

    public function kelas_peserta_lulus($peserta_id)
    {
        return $this->table('peserta_kelas')
        ->join('peserta', 'peserta.peserta_id = peserta_kelas.data_peserta_id')
        ->join('program_kelas', 'program_kelas.kelas_id = peserta_kelas.data_kelas_id')
        ->join('program', 'program.program_id = program_kelas.program_id')
        ->join('pengajar', 'pengajar.pengajar_id = program_kelas.pengajar_id')
        ->where('status_peserta_kelas', 'Lulus')
        ->orwhere('status_peserta_kelas', 'Mengulang')
        ->where('data_peserta_id', $peserta_id)
        ->get()->getResultArray();
    }

    //Rekap data pembayaran tiap peserta - Admin panel
    public function admin_rekap_bayar()
    {
        return $this->table('peserta_kelas')
            ->join('peserta', 'peserta.peserta_id = peserta_kelas.data_peserta_id')
            ->join('program_kelas', 'program_kelas.kelas_id = peserta_kelas.data_kelas_id')
            ->join('program', 'program.program_id = program_kelas.program_id')
            ->join('pengajar', 'pengajar.pengajar_id = program_kelas.pengajar_id')
            // ->where('status_peserta_kelas', 'Belum Lulus')
            ->orderBy('angkatan_kelas', 'DESC')
            ->get()->getResultArray();
    }

    //Pembayaran SPP peserta - peserta panel
    public function list_kelas_peserta_belum_lulus($peserta_id)
    {
        return $this->table('peserta_kelas')
            ->join('peserta', 'peserta.peserta_id = peserta_kelas.data_peserta_id')
            ->join('program_kelas', 'program_kelas.kelas_id = peserta_kelas.data_kelas_id')
            ->join('program', 'program.program_id = program_kelas.program_id')
            // ->join('pengajar', 'pengajar.pengajar_id = program_kelas.pengajar_id')
            ->where('data_peserta_id', $peserta_id)
            ->where('status_peserta_kelas', 'Belum Lulus')
            // ->orderBy('angkatan_kelas', 'DESC')
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

    //Pengajar Panel - Absensi Peserta
    public function peserta_onkelas_absen($kelas_id)
    {
        return $this->table('peserta_kelas')
            ->join('peserta', 'peserta.peserta_id = peserta_kelas.data_peserta_id')
            ->join('absen_peserta', 'absen_peserta.absen_peserta_id = peserta_kelas.data_absen')
            ->where('data_kelas_id', $kelas_id)
            ->where('status_peserta_kelas', 'Belum Lulus')
            ->orderBy('nama_peserta', 'ASC')
            ->get()->getResultArray();
    }

    public function peserta_onkelas_absen_tm($tm, $kelas_id)
    {
        return $this->table('peserta_kelas')
            ->join('peserta', 'peserta.peserta_id = peserta_kelas.data_peserta_id')
            ->join('absen_peserta', 'absen_peserta.absen_peserta_id = peserta_kelas.data_absen')
            ->select('peserta_kelas_id')
            ->select('nis')
            ->select('nama_peserta')
            ->select('data_absen')
            ->select($tm)
            ->where('data_kelas_id', $kelas_id)
            ->where('status_peserta_kelas', 'Belum Lulus')
            ->orderBy('nama_peserta', 'ASC')
            ->get()->getResultArray();
    }

    // Get Data Kelas dari peserta_kelas_id
    public function get_kelas_peserta($peserta_kelas_id)
    {
        return $this->table('program_kelas')
            ->select('data_kelas_id')
            ->where('peserta_kelas_id', $peserta_kelas_id)
            ->get()
            ->getUnbufferedRow();
    }


}
