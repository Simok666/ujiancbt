<?php

namespace App\Models;

use CodeIgniter\Model;

class Tugas_siswaModel extends Model
{
    protected $table            = 'tugas_siswa';
    protected $primaryKey       = 'id_tugas_siswa';
    protected $allowedFields    = ['tugas', 'siswa', 'text_siswa', 'file_siswa', 'date_send', 'is_telat', 'nilai', 'catatan_guru'];

    public function getAllByKodeTugas($kode_tugas)
    {
        return $this
            ->join('siswa', 'siswa.id_siswa=tugas_siswa.siswa')
            ->where('tugas_siswa.tugas', $kode_tugas)
            ->get()->getResultObject();
    }

    public function getByKodeTugasAndSiswa($kode_tugas, $siswa)
    {
        return $this
            ->join('siswa', 'siswa.id_siswa=tugas_siswa.siswa')
            ->join('tugas', 'tugas.kode_tugas=tugas_siswa.tugas')
            ->where('tugas_siswa.tugas', $kode_tugas)
            ->where('tugas_siswa.siswa', $siswa)
            ->get()->getRowObject();
    }
}
