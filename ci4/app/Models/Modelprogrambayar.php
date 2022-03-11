<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelprogrambayar extends Model
{
    protected $table      = 'program_bayar ';
    protected $primaryKey = 'bayar_id';
    protected $allowedFields = ['kelas_id', 'bayar_peserta_id','status_bayar', 'status_konfirmasi', 'awal_bayar', 'awal_bayar_daftar', 'awal_bayar_infaq', 'awal_bayar_modul', 'awal_bayar_lainnya', 'awal_bayar_spp1', 'awal_bayar_spp2', 'awal_bayar_spp3', 'awal_bayar_spp4', 'nominal_bayar','bukti_bayar', 'keterangan_bayar', 'keterangan_bayar_tolak','tgl_bayar', 'waktu_bayar', 'tgl_bayar_konfirmasi', 'waktu_bayar_konfirmasi', 'validator'];

    
    //Custom Query
    public function belum_lunas($peserta_id)
    {
        return $this->table('program_bayar')
            ->join('program_kelas', 'program_kelas.kelas_id = program_bayar.kelas_id')
            ->join('peserta', 'peserta.peserta_id = program_bayar.bayar_peserta_id')
            ->join('program', 'program_kelas.program_id = program.program_id')
            ->where('status_bayar', 'Belum Lunas')
            ->where('bayar_peserta_id', $peserta_id)
            ->get()
            ->getResultArray();
    }

    public function cek_belum_lunas($peserta_id)
    {
        return $this->table('program_bayar')
        ->join('program_kelas', 'program_kelas.kelas_id = program_bayar.kelas_id')
        ->join('peserta', 'peserta.peserta_id = program_bayar.bayar_peserta_id')
        ->join('program', 'program_kelas.program_id = program.program_id')
        ->where('status_bayar', 'Belum Lunas')
        ->where('bayar_peserta_id', $peserta_id)
        ->countAllResults();
    }

    //Admin - Controller Pembayaran
    public function bayar_konfirmasi()
    {
        return $this->table('program_bayar')
        ->join('program_kelas', 'program_kelas.kelas_id = program_bayar.kelas_id')
        ->join('peserta', 'peserta.peserta_id = program_bayar.bayar_peserta_id')
        ->join('program', 'program_kelas.program_id = program.program_id')
        ->join('pengajar', 'pengajar.pengajar_id = program_kelas.pengajar_id')
        ->where('status_konfirmasi', 'Proses')
        ->get()
        ->getResultArray();
    }

    //Get jenis bayar
    public function get_jenis_bayar()
    {
        return $this->table('program_bayar')
        ->select('jenis_bayar')
        ->where('status_bayar', 'Belum Lunas')
        ->get()
        ->getResultArray();
    }

    public function get_kelas_id($bayar_id)
    {
        return $this->table('program_bayar')
            ->select('kelas_id')
            ->where('bayar_id', $bayar_id)
            ->get()
            ->getUnbufferedRow();
    }

    public function list()
    {
        return $this->table('program_bayar')
        ->join('program_kelas', 'program_kelas.kelas_id = program_bayar.kelas_id')
        ->join('peserta', 'peserta.peserta_id = program_bayar.bayar_peserta_id')
        ->join('program', 'program_kelas.program_id = program.program_id')
        ->join('pengajar', 'pengajar.pengajar_id = program_kelas.pengajar_id')
        ->orderBy('bayar_id', 'DESC')
        ->get()
        ->getResultArray();
    }

    //Get list pembayran peserta - Panel Peserta
    public function list_pembayaran_peserta($peserta_id)
    {
        return $this->table('program_bayar')
        ->join('program_kelas', 'program_kelas.kelas_id = program_bayar.kelas_id')
        ->join('peserta', 'peserta.peserta_id = program_bayar.bayar_peserta_id')
        ->join('program', 'program_kelas.program_id = program.program_id')
        ->where('bayar_peserta_id', $peserta_id)
        ->orderBy('bayar_id', 'DESC')
        ->get()
        ->getResultArray();
    }

    //Dashboard - Admin
    public function jml_bayar_proses()
    {
        return $this->table('program_bayar')
        ->where('status_konfirmasi', 'Proses')
        ->countAllResults();
    }
}
