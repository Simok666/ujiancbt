<?php

namespace App\Models;

use CodeIgniter\Model;

class EssaysiswaModel extends Model
{
    protected $table            = 'essay_siswa';
    protected $primaryKey       = 'id_essay_siswa';
    protected $allowedFields    = ['essay_id', 'ujian', 'siswa', 'jawaban', 'score', 'sudah_dikerjakan', 'ragu'];

    public function getAllByUjianAndSiswa($ujian, $siswa)
    {
        return $this
            ->where('ujian', $ujian)
            ->where('siswa', $siswa)
            ->get()->getResultObject();
    }

    public function getByUjianAndSiswa($essay_id, $siswa)
    {
        return $this
            ->where('essay_id', $essay_id)
            ->where('siswa', $siswa)
            ->get()->getRowObject();
    }
}
