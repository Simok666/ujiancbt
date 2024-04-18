<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{
    protected $table            = 'mapel';
    protected $primaryKey       = 'id_mapel';
    protected $allowedFields    = ['nama_mapel'];
}
