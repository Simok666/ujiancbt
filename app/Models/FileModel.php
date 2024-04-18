<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table            = 'file';
    protected $primaryKey       = 'id_file';
    protected $allowedFields    = ['kode_file', 'nama_file'];

    public function getAllByKode($kode)
    {
        return $this
            ->where('kode_file', $kode)
            ->get()->getResultObject();
    }
}
