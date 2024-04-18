<?php

namespace App\Models;

use CodeIgniter\Model;

class TokenModel extends Model
{
    protected $table            = 'user_token';
    protected $primaryKey       = 'id_user_token';
    protected $allowedFields    = ['email', 'token', 'date_created'];

    public function getByEmailAndToken($email, $token)
    {
        return $this
            ->where('email', $email)
            ->where('token', $token)
            ->get()->getRowObject();
    }
}
