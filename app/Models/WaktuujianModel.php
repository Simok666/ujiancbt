<?php

namespace App\Models;

use CodeIgniter\Model;

class WaktuujianModel extends Model
{
    protected $table            = 'waktu_ujian';
    protected $primaryKey       = 'id_waktu_ujian';
    protected $allowedFields    = ['kode_ujian', 'nama_ujian', 'siswa_id', 'waktu_berakhir', 'selesai'];

    public function getAllBySiswa($siswa_id)
    {
        return $this
            ->join('ujian', 'ujian.kode_ujian=waktu_ujian.kode_ujian')
            ->join('siswa', 'siswa.id_siswa=waktu_ujian.siswa_id')
            ->where('waktu_ujian.siswa_id', $siswa_id)
            ->get()->getResultObject();
    }

    public function getBySiswa($kode_ujian, $siswa_id)
    {
        return $this
            ->where('kode_ujian', $kode_ujian)
            ->where('siswa_id', $siswa_id)
            ->get()->getRowObject();
    }

    public function getNotif($siswa_id)
    {
        return $this
            ->join('ujian', 'ujian.kode_ujian=waktu_ujian.kode_ujian')
            ->join('siswa', 'siswa.id_siswa=waktu_ujian.siswa_id')
            ->where('waktu_ujian.siswa_id', $siswa_id)
            ->where('waktu_ujian.selesai =', null)
            ->where('publish =', 1)
            ->get()->getResultObject();
    }
}
