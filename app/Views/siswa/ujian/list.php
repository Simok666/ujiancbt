<?= $this->extend('template/app'); ?>
<?= $this->section('content'); ?>
<?= $this->include('template/sidebar/siswa'); ?>
<?php

use App\Models\MapelModel;

$mapelModel = new MapelModel();

?>

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 layout-spacing">
                <div class="widget shadow p-3">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="widget-heading">
                                <h5 class="">Ujian / Quiz</h5>
                            </div>
                            <div class="table-responsive" style="overflow-x: scroll;">
                                <table id="datatable-table" class="table text-center text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Kategori</th>
                                            <th>Kelas</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ujian as $u) : ?>
                                            <?php $mapel = $mapelModel->asObject()->find($u->mapel); ?>
                                            <tr>
                                                <td><?= $u->nama_ujian; ?></td>
                                                <td><?= $mapel->nama_mapel; ?></td>
                                                <td><?= $siswa->nama_kelas; ?></td>
                                                <td>
                                                    <?php if ($u->jenis_ujian == 1) : ?>
                                                        <a href="<?= base_url('siswa/lihat_essay/') . '/' . encrypt_url($u->kode_ujian) . '/' . encrypt_url(session()->get('id')); ?>" class="btn btn-primary <?= ($u->waktu_berakhir === null) ? 'kerjakan' : '' ?>"><?= ($u->waktu_berakhir === null) ? 'kerjakan' : 'Lihat' ?></a>
                                                    <?php else : ?>
                                                        <a href="<?= base_url('siswa/lihat_pg/') . '/' . encrypt_url($u->kode_ujian) . '/' . encrypt_url(session()->get('id')); ?>" class="btn btn-primary <?= ($u->waktu_berakhir === null) ? 'kerjakan' : '' ?>"><?= ($u->waktu_berakhir === null) ? 'kerjakan' : 'Lihat' ?></a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <img src="<?= base_url('assets/app-assets/img/'); ?>/ujian.svg" class="align-middle" style="vertical-align: middle;" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

<script>
    <?= session()->getFlashdata('pesan'); ?>
    $('.kerjakan').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        swal({
            title: 'Are you sure?',
            text: "ujian akan dimulai & waktu akan berjalan!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Kerjakan',
            cancelButtonText: 'Nanti',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                document.location.href = href
            }
        });
    });
</script>

<?= $this->endSection(); ?>