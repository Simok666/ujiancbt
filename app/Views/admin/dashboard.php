<?= $this->extend('template/app'); ?>
<?= $this->section('content'); ?>
<?= $this->include('template/sidebar/admin'); ?>
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-4 layout-spacing">
                <div class="widget widget-five infobox-3" style="width: 100%; padding: 10px;">
                    <div class="info-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <h5 class="info-heading mt-4 text-center">Jumlah Data Operator</h5>
                    <div class="widget-content">
                        <div class="w-content" style="padding: 0;">
                            <div class="">
                                <p class="task-left"><?= count($guru); ?></p>
                                <p class="task-completed"><span><?= count($guru_aktif); ?> Operator</span> Aktif</p>
                                <p class="task-hight-priority"><span><?= count($guru_tidak_aktif); ?> Operator</span> Tidak Aktif</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 layout-spacing">
                <div class="widget widget-five infobox-3" style="width: 100%; padding: 10px;">
                    <div class="info-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h5 class="info-heading mt-4 text-center">Jumlah Data Peserta</h5>
                    <div class="widget-content">
                        <div class="w-content" style="padding: 0;">
                            <div class="">
                                <p class="task-left"><?= count($siswa); ?></p>
                                <p class="task-completed"><span><?= count($siswa_aktif); ?> Peserta</span> Aktif</p>
                                <p class="task-hight-priority"><span><?= count($siswa_tidak_aktif); ?> Peserta</span> Tidak Aktif</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 layout-spacing">
                <div class="widget widget-five infobox-3" style="width: 100%; padding: 10px;">
                    <div class="info-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </div>
                    <h5 class="info-heading mt-4 text-center">Jumlah Data Kelas</h5>
                    <div class="widget-content">
                        <div class="w-content" style="padding: 0;">
                            <div class="">
                                <p class="task-left"><?= count($kelas); ?></p>
                                <p class="task-completed"><span><?= count($kelas); ?> Kelas</span> Aktif</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row layout-top-spacing">
            <div class="col-lg-4 layout-spacing">
                <div class="widget widget-five infobox-3" style="width: 100%; padding: 10px;">
                    <div class="info-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                        </svg>
                    </div>
                    <h5 class="info-heading mt-4 text-center">Jumlah Data Kategori</h5>
                    <div class="widget-content">
                        <div class="w-content" style="padding: 0;">
                            <div class="">
                                <p class="task-left"><?= count($mapel); ?></p>
                                <p class="task-completed"><span><?= count($mapel); ?> Kategori</span> Aktif</p>
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
<?= $this->endSection(); ?>