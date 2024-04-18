<?php

use App\Models\EssaysiswaModel;
use App\Models\WaktuujianModel;

$essaysiswamodel = new EssaysiswaModel();
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
                <th>Soal Dijawab</th>
                <th>Tidak Dijawab</th>
                <th>Total Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php $no  = 1 ?>
            <?php foreach ($siswa as $s) : ?>
                <?php $ujian_siswa = $WaktuUjianModel->getBySiswa($ujian->kode_ujian, $s->id_siswa); ?>
                <?php if ($ujian_siswa !== null) : ?>
                    <?php if ($ujian_siswa->selesai === null) : ?>
                        <tr class="text-center">
                            <td><?= $no++; ?></td>
                            <td><?= $s->nama_siswa; ?></td>
                            <td colspan="4">Belum Mengerjakan Ujian</td>
                        </tr>
                    <?php else : ?>
                        <?php $essay_siwa = $essaysiswamodel
                            ->where('ujian', $ujian->kode_ujian)
                            ->where('siswa', $s->id_siswa)
                            ->get()->getResultObject();
                        ?>
                        <?php
                        $soalDijawab = 0;
                        $tidakDijawab = 0;
                        ?>
                        <?php foreach ($essay_siwa as $es) {
                            if ($es->sudah_dikerjakan == 0) {
                                $tidakDijawab++;
                            }
                            if ($es->sudah_dikerjakan == 1) {
                                $soalDijawab++;
                            }
                        } ?>
                        <?php
                        $total_score = $essaysiswamodel
                            ->where('ujian', $ujian->kode_ujian)
                            ->where('siswa', $s->id_siswa)
                            ->select('sum(score) as sumScore')
                            ->get()->getRowObject();
                        ?>
                        <tr class="text-center">

                            <td><?= $no++; ?></td>
                            <td><?= $s->nama_siswa; ?></td>
                            <td><?= $soalDijawab; ?></td>
                            <td><?= $tidakDijawab; ?></td>
                            <td><?= $total_score->sumScore; ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script>
        window.print();
    </script>

</body>

</html>