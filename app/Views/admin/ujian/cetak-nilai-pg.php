<?php

use App\Models\UjiansiswaModel;
use App\Models\WaktuujianModel;

$UjiansiswaModel = new UjiansiswaModel();
$WaktuUjianModel = new WaktuUjianModel();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Ujian</title>
    <link href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <h2 class="text-center">NILAI UJIAN</h2>
    <hr>
    <table cellpadding="3">
        <tbody>
            <tr>
                <td>Ujian</td>
                <td> : <?= $ujian->nama_ujian; ?> | <?= ($ujian->jenis_ujian === null) ? 'Pilihan Ganda' : 'Essay'; ?></td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td> : <?= $ujian->nama_mapel; ?></td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td> : <?= $ujian->nama_kelas; ?></td>
            </tr>
            <tr>
                <td>Total Soal</td>
                <td> : <?= count($detail_ujian); ?> soal</td>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered text-nowrap mt-3">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Nama Peserta</th>
                <th>Benar</th>
                <th>Salah</th>
                <th>Tidak Dijawab</th>
            </tr>
        </thead>
        <tbody>
            <?php $no  = 1 ?>
            <?php foreach ($siswa as $s) : ?>
                <?php $ujian_siswa = $WaktuUjianModel->getBySiswa($ujian->kode_ujian, $s->id_siswa); ?>
                <?php if ($ujian_siswa->selesai === null) : ?>
                    <tr class="text-center">
                        <td><?= $no++; ?></td>
                        <td><?= $s->nama_siswa; ?></td>
                        <td colspan="3">Belum Mengerjakan Ujian</td>
                    </tr>
                <?php else : ?>
                    <?php $belum_terjawab = $UjiansiswaModel->belum_terjawab($ujian->kode_ujian, $s->id_siswa, null); ?>
                    <?php $benar = $UjiansiswaModel->salah($ujian->kode_ujian, $s->id_siswa, 1); ?>
                    <?php $salah = $UjiansiswaModel->salah($ujian->kode_ujian, $s->id_siswa, 0); ?>

                    <tr class="text-center">
                        <td><?= $no++; ?></td>
                        <td><?= $s->nama_siswa; ?></td>
                        <td><?= count($benar); ?></td>
                        <td><?= count($salah); ?></td>
                        <td><?= count($belum_terjawab); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script>
        window.print();
    </script>

</body>

</html>