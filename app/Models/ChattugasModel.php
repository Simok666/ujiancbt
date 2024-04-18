<?php

namespace App\Models;

use CodeIgniter\Model;

class ChattugasModel extends Model
{
    protected $table            = 'chat_tugas';
    protected $primaryKey       = 'id_chat_tugas';
    protected $allowedFields    = ['tugas', 'nama', 'gambar', 'email', 'text', 'date_created'];

    public function getAllByKodeTugas($kode_tugas)
    {
        return $this
            ->where('tugas', $kode_tugas)
            ->get()->getResultObject();
    }
}
