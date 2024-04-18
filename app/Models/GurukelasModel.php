<?php

namespace App\Models;

use CodeIgniter\Model;

class GurukelasModel extends Model
{
    protected $table            = 'guru_kelas';
    protected $primaryKey       = 'id_guru_kelas';
    protected $allowedFields    = ['guru', 'kelas', 'nama_kelas'];

    public function getALLByGuruAndKelas($guru, $kelas)
    {
        return $this
            ->where('guru', $guru)
            ->where('kelas', $kelas)
            ->get()->getResultObject();
    }

    public function getALLByGuru($guru)
    {
        return $this
            ->join('kelas', 'kelas.id_kelas=guru_kelas.kelas')
            ->where('guru_kelas.guru', $guru)
            ->get()->getResultObject();
    }
}
