<?php

namespace App\Models;

use CodeIgniter\Model;

class UjiansiswaModel extends Model
{
    protected $table            = 'ujian_siswa';
    protected $primaryKey       = 'id_ujian_siswa';
    protected $allowedFields    = ['ujian_id', 'ujian', 'siswa', 'jawaban', 'benar', 'ragu'];

    public function belum_terjawab($ujian, $siswa, $jawaban = null)
    {
        return $this
            ->where('ujian', $ujian)
            ->where('siswa', $siswa)
            ->where('jawaban', $jawaban)
            ->get()->getResultObject();
    }

    public function benar($ujian, $siswa, $benar)
    {
        return $this
            ->where('ujian', $ujian)
            ->where('siswa', $siswa)
            ->where('benar', $benar)
            ->get()->getResultObject();
    }

    public function salah($ujian, $siswa, $salah)
    {
        return $this
            ->where('ujian', $ujian)
            ->where('siswa', $siswa)
            ->where('benar', $salah)
            ->get()->getResultObject();
    }

    public function cek_sudah_ujian($ujian, $siswa)
    {
        return $this
            ->where('ujian', $ujian)
            ->where('siswa', $siswa)
            ->get()->getResultObject();
    }

    public function getJawabanSiswa($ujian, $siswa)
    {
        return $this
            ->where('ujian_id', $ujian)
            ->where('siswa', $siswa)
            ->get()->getRowObject();
    }
}
