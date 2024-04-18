<?php

namespace App\Models;

use CodeIgniter\Model;

class GurumapelModel extends Model
{
    protected $table            = 'guru_mapel';
    protected $primaryKey       = 'id_guru_mapel';
    protected $allowedFields    = ['guru', 'mapel', 'nama_mapel'];

    public function getALLByGuruAndMapel($guru, $mapel)
    {
        return $this
            ->where('guru', $guru)
            ->where('mapel', $mapel)
            ->get()->getResultObject();
    }

    public function getALLByGuru($guru)
    {
        return $this
            ->join('mapel', 'mapel.id_mapel=guru_mapel.mapel')
            ->where('guru_mapel.guru', $guru)
            ->get()->getResultObject();
    }
}
