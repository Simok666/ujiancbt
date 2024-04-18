<?= $this->extend('template/app'); ?>
<?= $this->section('content'); ?>
<?= $this->include('template/sidebar/siswa'); ?>
<?php

use App\Models\MapelModel;

$mapelmodel = new MapelModel();

?>

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">
            <div class="col-xl-6 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-one p-3">
                    <div class="widget-heading">
                        <h5 class="">Notifikasi Materi</h5>
                    </div>

                    <div class="widget-content">
                        <?php if ($materi_siswa != null) : ?>
                            <?php foreach ($materi_siswa as $ms) : ?>
                                <a href="<?= base_url('siswa/lihat_materi/') . '/' . encrypt_url($ms->kode_materi); ?>">
                                    <div class="transactions-list mt-1">
                                        <div class="t-item">
                                            <div class="t-company-name">
                                                <div class="t-icon">
                                                    <div class="icon">
                                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                            <polyline points="14 2 14 8 20 8"></polyline>
                                                            <line x1="16" y1="13" x2="8" y2="13"></line>
                                                            <line x1="16" y1="17" x2="8" y2="17"></line>
                                                            <polyline points="10 9 9 9 8 9"></polyline>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="t-name">
                                                    <h4><?= $ms->nama_materi; ?></h4>
                                                    <p class="meta-date"><?= $ms->nama_mapel; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="transactions-list" style="background: #ffeccb; border: 2px dashed #e2a03f;">
                                <div class="t-item">
                                    <div class="t-company-name">
                                        <div class="t-name">
                                            <h4 style="color: #e2a03f;">Heeemm.. Belum Ada Materi
                                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <line x1="8" y1="15" x2="16" y2="15"></line>
                                                    <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                                    <line x1="15" y1="9" x2="15.01" y2="9"></line>
                                                </svg>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-one p-3">
                    <div class="widget-heading">
                        <h5 class="">Notifikasi Ujian</h5>
                    </div>

                    <div class="widget-content">
                        <?php

                        // $waktuskrng = date('Y-m-d H:i', time());
                        // $db = \Config\Database::connect();
                        // $ujian = $db->query("SELECT * FROM ujian WHERE kelas = '$siswa->kelas' AND waktu_berakhir > '$waktuskrng'")->getResultObject();

                        ?>
                        <?php if ($ujian != null) : ?>
                            <?php foreach ($ujian as $u) : ?>
                                <?php $mapel = $mapelmodel->asObject()->find($u->mapel); ?>
                                <?php if ($u->jenis_ujian == 1) : ?>
                                    <!-- <a href="<?= base_url('siswa/lihat_essay/') . '/' . encrypt_url($u->kode_ujian) . '/' . encrypt_url(session()->get('id')); ?>"> -->
                                    <a class="ujian mulai-essay" data-link="<?= base_url('siswa/lihat_essay/') . '/' . encrypt_url($u->kode_ujian) . '/' . encrypt_url(session()->get('id')); ?>">
                                    <?php else : ?>
                                        <!-- <a href="<?= base_url('siswa/lihat_pg/') . '/' . encrypt_url($u->kode_ujian) . '/' . encrypt_url(session()->get('id')); ?>"> -->
                                        <a class="ujian mulai-ujian" data-link="<?= base_url('siswa/lihat_pg/') . '/' . encrypt_url($u->kode_ujian) . '/' . encrypt_url(session()->get('id')); ?>">
                                        <?php endif; ?>
                                        <div class="transactions-list mt-1">
                                            <div class="t-item">
                                                <div class="t-company-name">
                                                    <div class="t-icon">
                                                        <div class="icon">
                                                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                                                <polyline points="10 9 9 9 8 9"></polyline>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="t-name">
                                                        <h4><?= $u->nama_ujian; ?></h4>
                                                        <p class="meta-date"><?= $mapel->nama_mapel; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <div class="transactions-list" style="background: #ffeccb; border: 2px dashed #e2a03f;">
                                        <div class="t-item">
                                            <div class="t-company-name">
                                                <div class="t-name">
                                                    <h4 style="color: #e2a03f;">YahoOo.. Tidak ada ujian
                                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                                                            <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                                            <line x1="15" y1="9" x2="15.01" y2="9"></line>
                                                        </svg>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row layout-top-spacing">

            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                <div class="widget widget-five">
                    <div class="widget-content">
                        <div class="header">
                            <div class="header-body">
                                <h6>Total Materi</h6>
                            </div>
                        </div>
                        <div class="w-content">
                            <div class="">
                                <p class="task-left">
                                    <?= count($jumlah_materi_siswa); ?>
                                </p>
                                <p class="task-completed"><span>Ada <?= count($jumlah_materi_siswa); ?> Materi Dikelas Kamu</span></p>
                            </div>
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

    // $(".mulai-ujian").on("click", function(a) {
    //     a.preventDefault(); 
    //     url = $(this).data('link');
    //     swal({
    //         title: "apakah kamu yakin?",
    //         text: "jika ya, waktu ujian akan langsung dimulai!",
    //         type: "warning",
    //         showCancelButton: !0,
    //         cancelButtonText: "tidak",
    //         confirmButtonText: "ya, mulai",
    //         padding: "2em"
    //     }).then((result) => {
    //         if (result.value){
    //             // console.log(url);
    //             window.location = url;
    //         }
    //     })
    // });

    // $(".mulai-essay").on("click", function(a) {
    //     a.preventDefault();
    //     url = $(this).data('link');
    //     swal({
    //         title: "apakah kamu yakin?",
    //         text: "jika ya, waktu ujian akan langsung dimulai!",
    //         type: "warning",
    //         showCancelButton: !0,
    //         cancelButtonText: "tidak",
    //         confirmButtonText: "ya, mulai",
    //         padding: "2em"
    //     }).then((result) => {
    //         if (result.value){
    //             // console.log(url);
    //             window.location = url;
    //         }
    //     })
    // });

    // $('.ujian').hover(function() {
    //     $(this).css('cursor','pointer');
    // });
</script>

<?= $this->endSection(); ?>