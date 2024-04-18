<?php

namespace App\Models;

use CodeIgniter\Model;

class UjianModel extends Model
{
    protected $table            = 'ujian';
    protected $primaryKey       = 'id_ujian';
    protected $allowedFields    = ['kode_ujian', 'nama_ujian', 'guru', 'kelas', 'mapel', 'date_created', 'waktu_ujian', 'jenis_ujian', 'publish'];

    public function getAllBykodeGuru($guru)
    {
        return $this
            ->join('kelas', 'kelas.id_kelas=ujian.kelas')
            ->join('mapel', 'mapel.id_mapel=ujian.mapel')
            ->join('guru', 'guru.id_guru=ujian.guru')
            ->where('ujian.guru', $guru)
            ->get()->getResultObject();
    }

    public function getAllBykodeAdmin($admin)
    {
        return $this
            ->join('kelas', 'kelas.id_kelas=ujian.kelas')
            ->join('mapel', 'mapel.id_mapel=ujian.mapel')
            ->join('admin', 'admin.id_admin=ujian.guru')
            ->where('ujian.guru', $admin)
            ->get()->getResultObject();
    }

    public function getAllBykelas($kelas)
    {
        return $this
            ->join('kelas', 'kelas.id_kelas=ujian.kelas')
            ->join('mapel', 'mapel.id_mapel=ujian.mapel')
            ->join('guru', 'guru.id_guru=ujian.guru')
            ->where('ujian.kelas', $kelas)
            ->get()->getResultObject();
    }

    public function getBykode($kode_ujian)
    {
        return $this
            ->join('kelas', 'kelas.id_kelas=ujian.kelas')
            ->join('mapel', 'mapel.id_mapel=ujian.mapel')
            ->join('guru', 'guru.id_guru=ujian.guru')
            ->where('ujian.kode_ujian', $kode_ujian)
            ->get()->getRowObject();
    }

    public function getBykodeAdmin($kode_ujian)
    {
        return $this
            ->join('kelas', 'kelas.id_kelas=ujian.kelas')
            ->join('mapel', 'mapel.id_mapel=ujian.mapel')
            ->join('admin', 'admin.id_admin=ujian.guru')
            ->where('ujian.kode_ujian', $kode_ujian)
            ->get()->getRowObject();
    }
}
