<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatmateriModel extends Model
{
    protected $table            = 'chat_materi';
    protected $primaryKey       = 'id_chat_materi';
    protected $allowedFields    = ['materi', 'nama', 'gambar', 'email', 'text', 'date_created'];

    public function getAllByKodeMateri($kode_materi)
    {
        return $this
            ->where('materi', $kode_materi)
            ->get()->getResultObject();
    }
}
