<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'admin';
    protected $primaryKey       = 'id_admin';
    protected $allowedFields    = ['nama_admin', 'email', 'password', 'is_active', 'date_created', 'avatar', 'role', 'pm'];

    public function getbyemail($email)
    {
        return $this
            ->where('email', $email)
            ->get()->getRowObject();
    }
}
