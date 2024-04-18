<?php

namespace App\Models;

use CodeIgniter\Model;

class SmtpModel extends Model
{
    protected $table            = 'mail';
    protected $primaryKey       = 'id_mail';
    protected $allowedFields    = ['smtp_host', 'smtp_user', 'smtp_pass', 'smtp_port', 'smtp_crypto', 'notif_akun', 'notif_materi', 'notif_tugas', 'notif_ujian'];
}
