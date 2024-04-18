<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table            = 'guru';
    protected $primaryKey       = 'id_guru';
    protected $allowedFields    = ['nama_guru', 'email', 'password', 'role', 'is_active', 'date_created', 'avatar'];

    public function getByEmail($email)
    {
        return $this
            ->where('email', $email)
            ->get()->getRowObject();
    }
}
