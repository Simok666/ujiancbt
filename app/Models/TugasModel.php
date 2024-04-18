<?php

namespace App\Models;

use CodeIgniter\Model;

class TugasModel extends Model
{
    protected $table            = 'tugas';
    protected $primaryKey       = 'id_tugas';
    protected $allowedFields    = ['kode_tugas', 'kelas', 'mapel', 'guru', 'nama_tugas', 'deskripsi', 'date_created', 'due_date', 'date_updated'];

    public function getBykodeTugas($kode_tugas)
    {
        return $this
            ->join('kelas', 'kelas.id_kelas=tugas.kelas')
            ->join('mapel', 'mapel.id_mapel=tugas.mapel')
            // ->join('guru', 'guru.id_guru=tugas.guru')
            ->where('tugas.kode_tugas', $kode_tugas)
            ->get()->getRowObject();
    }

    public function getAllByGuru($guru)
    {
        return $this
            ->join('kelas', 'kelas.id_kelas=tugas.kelas')
            ->join('mapel', 'mapel.id_mapel=tugas.mapel')
            ->where('tugas.guru', $guru)
            ->get()->getResultObject();
    }
    public function getAllByKelas($kelas)

    {
        return $this
            ->join('kelas', 'kelas.id_kelas=tugas.kelas')
            ->join('mapel', 'mapel.id_mapel=tugas.mapel')
            ->where('tugas.kelas', $kelas)
            ->get()->getResultObject();
    }
}
