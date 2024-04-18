<?php

namespace App\Models;

use CodeIgniter\Model;

class MateriModel extends Model
{
    protected $table            = 'materi';
    protected $primaryKey       = 'id_materi';
    protected $allowedFields    = ['kode_materi', 'nama_materi', 'guru', 'mapel', 'kelas', 'text_materi', 'date_created'];

    public function getAllbyKelas($kelas)
    {
        return $this
            ->join('kelas', 'kelas.id_kelas=materi.kelas')
            ->join('mapel', 'mapel.id_mapel=materi.mapel')
            ->where('materi.kelas', $kelas)
            ->get()->getResultObject();
    }

    public function getBykodeMateri($kode_materi)
    {
        return $this
            ->join('kelas', 'kelas.id_kelas=materi.kelas')
            ->join('mapel', 'mapel.id_mapel=materi.mapel')
            ->join('guru', 'guru.id_guru=materi.guru')
            ->where('materi.kode_materi', $kode_materi)
            ->get()->getRowObject();
    }

    public function getBykodeMateriAdmin($kode_materi)
    {
        return $this
            ->join('kelas', 'kelas.id_kelas=materi.kelas')
            ->join('mapel', 'mapel.id_mapel=materi.mapel')
            ->join('admin', 'admin.id_admin=materi.guru')
            ->where('materi.kode_materi', $kode_materi)
            ->get()->getRowObject();
    }

    public function getById($id_materi)
    {
        return $this
            ->join('kelas', 'kelas.id_kelas=materi.kelas')
            ->join('mapel', 'mapel.id_mapel=materi.mapel')
            ->where('materi.id_materi', $id_materi)
            ->get()->getRowObject();
    }

    public function getAllByGuru($guru)
    {
        return $this
            ->join('kelas', 'kelas.id_kelas=materi.kelas')
            ->join('mapel', 'mapel.id_mapel=materi.mapel')
            ->where('materi.guru', $guru)
            ->get()->getResultObject();
    }
}
