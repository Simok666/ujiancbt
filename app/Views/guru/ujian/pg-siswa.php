<?= $this->extend('template/app'); ?>
<?= $this->section('content'); ?>
<?= $this->include('template/sidebar/guru'); ?>

<?php

use App\Models\UjiansiswaModel;

$UjiansiswaModel = new UjiansiswaModel();
?>

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 layout-spacing">
                <div class="widget shadow p-3">
                    <div class="widget-heading">
                        <h6 class="text-center"><?= $ujian->nama_ujian; ?></h6>
                        Nama Peserta : <?= $siswa->nama_siswa; ?>
                    </div>
                    <div class="widget-content">
                        <div class="table-responsive mt-2">
                            <table class="table table-bordered text-nowrap">
                                <thead>
                                    <tr class="text-center">
                                        <th>No Soal</th>
                                        <th>Kunci Jawaban</th>
                                        <th>Jawaban Peserta</th>
                                        <th>Status</th>
                                        <th>Ragu Ragu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($detail_ujian as $soal) : ?>
                                        <?php $jawaban_siswa = $UjiansiswaModel->getJawabanSiswa($soal->id_detail_ujian, $siswa->id_siswa) ?>
                                        <tr class="text-center">
                                            <td><?= $no++; ?></td>
                                            <td><?= $soal->jawaban; ?></td>
                                            <td>
                                                <?= ($jawaban_siswa->jawaban === null) ? 'TIDAK DIJAWAB' : $jawaban_siswa->jawaban; ?>
                                            </td>
                                            <td>
                                                <?php

                                                if ($jawaban_siswa->benar === null) {
                                                    echo 'TIDAK DIJAWAB';
                                                }
                                                if ($jawaban_siswa->benar == '1') {
                                                    echo 'BENAR';
                                                }
                                                if ($jawaban_siswa->benar == '0') {
                                                    echo 'SALAH';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?= ($jawaban_siswa->ragu === null) ? 'TIDAK' : 'YA'; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="<?= base_url('guru/lihat_ujian/') . '/' . encrypt_url($ujian->kode_ujian) . '/' . encrypt_url(session()->get('id')); ?>" class="btn btn-danger btn-sm"><span class="fas fa-arrow-alt-circle-left"></span> kembali</a>

    </div>
    <div class="footer-wrapper">
        <div class="footer-section f-section-1">
            <p class="">Copyright © 2024 <a target="_blank" href="#">Tryout</a>, All rights reserved.</p>
        </div>
        <div class="footer-section f-section-2">
            <p class=""><b>Version</b> 1.0</p>
        </div>
    </div>
</div>
<!--  END CONTENT AREA  -->



<?= $this->endSection(); ?>