<?php

namespace App\Models;

use CodeIgniter\Model;

class EssaydetailModel extends Model
{
    protected $table            = 'essay_detail';
    protected $primaryKey       = 'id_essay_detail';
    protected $allowedFields    = ['kode_ujian', 'soal'];

    public function getAllBykodeUjian($kode_ujian)
    {
        return $this
            ->where('kode_ujian', $kode_ujian)
            ->get()->getResultObject();
    }
}
