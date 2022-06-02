<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelsertifikat extends Model
{
    protected $table      = 'sertifikat';
    protected $primaryKey = 'sertifikat_id';
    protected $allowedFields = ['sertifikat_peserta_id', 'nomor_sertifikat', 'periode_cetak','jenis_sertifikat', 'nominal_bayar_cetak', 'status_cetak', 'link_cetak', 'bukti_bayar_cetak', 'keterangan_cetak'];

    public function list($periode)
    {
        return $this->table('sertifikat')
            //->join('peserta_kelas', 'peserta_kelas.peserta_kelas_id = sertifikat.sertifikat_peserta_kelas_id')
            ->join('peserta', 'peserta.peserta_id = sertifikat.sertifikat_peserta_id')
            //->join('program_kelas', 'program_kelas.kelas_id = peserta_kelas.data_kelas_id')
            //->join('program', 'program.program_id = program_kelas.program_id')
            ->join('peserta_level', 'peserta_level.peserta_level_id = peserta.level_peserta')
            ->where('periode_cetak', $periode)
            ->orderBy('status_cetak', 'ASC')
            ->get()->getResultArray();
    }

    //Seluruh periode cetak (unik value / Distinct)
    public function list_unik_periode()
    {
        return $this->table('sertifikat')
            ->select('periode_cetak')
            ->orderBy('periode_cetak', 'DESC')
            ->distinct()
            ->get()->getResultArray();
    }

}