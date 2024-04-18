<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table            = 'siswa';
    protected $primaryKey       = 'id_siswa';
    protected $allowedFields    = ['no_induk_siswa', 'nama_siswa', 'email', 'password', 'jenis_kelamin', 'kelas', 'role', 'is_active', 'status_member', 'date_created', 'avatar'];

    public function getAll()
    {
        return $this
            ->join('kelas', 'kelas.id_kelas = siswa.kelas')
            ->orderBy('siswa.nama_siswa', 'ASC')
            ->get()->getResultObject();
    }

    public function getAllbyKelas($kelas)
    {
        return $this
            ->join('kelas', 'kelas.id_kelas = siswa.kelas')
            ->where('siswa.kelas', $kelas)
            ->get()->getResultObject();
    }

    public function getByEmail($email)
    {
        return $this
            ->join('kelas', 'kelas.id_kelas = siswa.kelas')
            ->where('siswa.email', $email)
            ->get()->getRowObject();
    }

    public function getById($id)
    {
        return $this
            ->join('kelas', 'kelas.id_kelas = siswa.kelas')
            ->where('siswa.id_siswa', $id)
            ->get()->getRowObject();
    }

    public function getByNoInduk($nim)
    {
        return $this
            ->join('kelas', 'kelas.id_kelas = siswa.kelas')
            ->where('siswa.no_induk_siswa', $nim)
            ->get()->getRowObject();
    }
}
