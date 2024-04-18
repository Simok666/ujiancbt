<?php

namespace App\Models;

use CodeIgniter\Model;

class UjiandetailModel extends Model
{
    protected $table            = 'ujian_detail';
    protected $primaryKey       = 'id_ujian_detail';
    protected $allowedFields    = ['kode_ujian', 'nama_soal', 'pg_1', 'pg_2', 'pg_3', 'pg_4', 'pg_5', 'jawaban', 'pembahasan'];

    public function getAllBykodeUjian($kode_ujian)
    {
        return $this
            ->where('kode_ujian', $kode_ujian)
            ->get()->getResultObject();
    }

    public function getById($id)
    {
        return $this
            ->where('id_detail_ujian', $id)
            ->get()->getRowObject();
    }
}
