<?php

use App\Models\SiswaModel;
use App\Models\Materi_siswaModel;
use App\Models\Tugas_siswaModel;
use App\Models\TugasModel;
use App\Models\MateriModel;
use App\Models\MapelModel;
use App\Models\KelasModel;
use App\Models\WaktuujianModel;

$tugas_siswamodel = new Tugas_siswaModel();
$tugas_model = new TugasModel();
$materi_model = new MateriModel();
$materi_siswamodel = new Materi_siswaModel();
$siswamodel = new SiswaModel();
$mapel_model = new MapelModel();
$kelas_model = new KelasModel();
$WaktuujianModel = new WaktuujianModel();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Tryout</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/app-assets/img'); ?>/cbt-malela.png" />
    <link href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/plugins/table/datatable/dt-global_style.css">
    <link href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/assets/css/tables/table-basic.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <script src="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/plugins/sweetalerts/promise-polyfill.js"></script>
    <link href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <script src="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/plugins/sweetalerts/custom-sweetalert.js"></script>
    <link href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/assets/css/users/user-profile.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/assets/css/elements/infobox.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/assets/css/components/tabs-accordian/custom-accordions.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/assets/css/components/custom-list-group.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/assets/css/elements/avatar.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/plugins/jquery-step/jquery.steps.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/assets/css/forms/theme-checkbox-radio.css">

    <link rel="stylesheet" href="<?= base_url('assets/app-assets/ew'); ?>/css/style.css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />



    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/bootstrap/js/popper.min.js"></script>
    <script src="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/plugins/apex/apexcharts.min.js"></script>
    <script src="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/assets/js/dashboard/dash_1.js"></script>
    <script src="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/plugins/table/datatable/datatables.js"></script>
    <script src="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/plugins/file-upload/file-upload-with-preview.min.js"></script>
    <script src="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/assets/js/scrollspyNav.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="<?= base_url('assets/app-assets/ew'); ?>/js/examwizard.min.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

</head>

<body class="sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->
    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">

            <ul class="navbar-nav theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="">
                        <img src="<?= base_url('assets/app-assets/img'); ?>/cbt-malela.png" class="navbar-logo" alt="logo">
                    </a>
                </li>
                <li class="nav-item theme-text">
                    <a href="" class="nav-link"> Tryout </a>
                </li>
                <li class="nav-item toggle-sidebar">
                    <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list">
                            <line x1="8" y1="6" x2="21" y2="6"></line>
                            <line x1="8" y1="12" x2="21" y2="12"></line>
                            <line x1="8" y1="18" x2="21" y2="18"></line>
                            <line x1="3" y1="6" x2="3" y2="6"></line>
                            <line x1="3" y1="12" x2="3" y2="12"></line>
                            <line x1="3" y1="18" x2="3" y2="18"></line>
                        </svg>
                    </a>
                </li>
            </ul>
            <ul class="navbar-item flex-row search-ul">
            </ul>
            <ul class="navbar-item flex-row navbar-dropdown">

                <!-- NOTIFIKASI SISWA -->
                <?php if (session()->get('role') == 2) : ?>
                    <?php
                    $tugas_siswa_where = [
                        'siswa' => session()->get('id'),
                        'date_send' => null
                    ];
                    $tugas_siswa = $tugas_siswamodel
                        ->where('siswa', session()->get('id'))
                        ->where('date_send', null)
                        ->get()->getResultObject();

                    $materi_siswa = $materi_siswamodel
                        ->where('siswa', session()->get('id'))
                        ->get()->getResultObject();

                    $aku = $siswamodel->getById(session()->get('id'));

                    $ujian = $WaktuujianModel->getNotif(session()->get('id'));

                    ?>
                    <li class="nav-item dropdown notification-dropdown">
                        <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                            </svg>
                            <?php if (count($tugas_siswa) > 0 || count($materi_siswa) > 0 || count($ujian) > 0) : ?>
                                <span class="badge badge-warning"></span>
                            <?php endif; ?>
                        </a>
                        <div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="notificationDropdown">
                            <div class="notification-scroll">
                                <?php if (count($tugas_siswa) > 0 || count($materi_siswa) > 0 || count($ujian) > 0) : ?>
                                    <?php foreach ($ujian as $u) : ?>
                                        <?php
                                        $kelas = $kelas_model->asObject()->find($u->kelas);
                                        $mapel = $mapel_model->asObject()->find($u->mapel);
                                        ?>
                                        <?php if ($u->jenis_ujian == 1) : ?>
                                            <!-- <a href="<?= base_url('siswa/lihat_essay/') . '/' . encrypt_url($u->kode_ujian) . '/' . encrypt_url(session()->get('id')); ?>"> -->
                                            <a class="ujian mulai-essay" data-link="<?= base_url('siswa/lihat_essay/') . '/' . encrypt_url($u->kode_ujian) . '/' . encrypt_url(session()->get('id')); ?>">
                                            <?php else : ?>
                                                <!-- <a href="<?= base_url('siswa/lihat_pg/') . '/' . encrypt_url($u->kode_ujian) . '/' . encrypt_url(session()->get('id')); ?>"> -->
                                                <a class="ujian mulai-ujian" data-link="<?= base_url('siswa/lihat_pg/') . '/' . encrypt_url($u->kode_ujian) . '/' . encrypt_url(session()->get('id')); ?>">
                                                <?php endif; ?>
                                                <div class="dropdown-item">
                                                    <div class="media file-upload">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                            <polyline points="14 2 14 8 20 8"></polyline>
                                                            <line x1="16" y1="13" x2="8" y2="13"></line>
                                                            <line x1="16" y1="17" x2="8" y2="17"></line>
                                                            <polyline points="10 9 9 9 8 9"></polyline>
                                                        </svg>
                                                        <div class="media-body">
                                                            <div class="data-info">
                                                                <h6 class=""><?= $u->nama_ujian; ?></h6>
                                                                <p class="">Ujian | <?= $mapel->nama_mapel; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </a>
                                            <?php endforeach; ?>
                                            <?php foreach ($tugas_siswa as $ts) : ?>
                                                <?php
                                                $tugas = $tugas_model->getBykodeTugas($ts->tugas);
                                                $kelas = $kelas_model->asObject()->find($tugas->kelas);
                                                $mapel = $mapel_model->asObject()->find($tugas->mapel);
                                                ?>
                                                <a href="<?= base_url('siswa/lihat_tugas/') . '/' . encrypt_url($tugas->kode_tugas); ?>">
                                                    <div class="dropdown-item">
                                                        <div class="media file-upload">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                                                <polyline points="10 9 9 9 8 9"></polyline>
                                                            </svg>
                                                            <div class="media-body">
                                                                <div class="data-info">
                                                                    <h6 class=""><?= $tugas->nama_tugas; ?></h6>
                                                                    <p class="">TUGAS | <?= $mapel->nama_mapel; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            <?php endforeach; ?>
                                            <?php foreach ($materi_siswa as $ms) : ?>
                                                <?php
                                                $materi = $materi_model->getBykodeMateri($ms->materi);
                                                if ($materi !== null) :
                                                    $kelas = $kelas_model->asObject()->find($materi->kelas);
                                                    $mapel = $mapel_model->asObject()->find($materi->mapel);
                                                ?>
                                                <a href="<?= base_url('siswa/lihat_materi/') . '/' . encrypt_url($materi->kode_materi); ?>">
                                                    <div class="dropdown-item">
                                                        <div class="media file-upload">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#009688" stroke="#009688" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server" style="color: #009688; fill: none;">
                                                                <rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
                                                                <rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
                                                                <line x1="6" y1="6" x2="6" y2="6"></line>
                                                                <line x1="6" y1="18" x2="6" y2="18"></line>
                                                            </svg>
                                                            <div class="media-body">
                                                                <div class="data-info">
                                                                    <h6 class=""><?= $materi->nama_materi; ?></h6>
                                                                    <p class="">MATERI | <?= $mapel->nama_mapel; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <div class="dropdown-item">
                                                <div class="media file-upload">
                                                    <div class="media-body">
                                                        <div class="data-info">
                                                            <h6 class="">WOoHOO</h6>
                                                            <p class="">Belum ada Pemberitahuan</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>
                <!-- END NOTIFIKASI SISWA -->

                <!-- NOTIFIKASI GURU -->
                <!-- END NOTIFIKASI GURU -->

                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                    </a>
                    <div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="userProfileDropdown">
                        <div class="user-profile-section">
                            <div class="media mx-auto">
                                <?php if (session()->get('role') == 1) : ?>
                                    <img src="<?= base_url('assets/app-assets/user/') . '/' . $admin->avatar; ?>" class="img-fluid mr-2 bg-white" alt="avatar">
                                    <div class="media-body">
                                        <h5><?= $admin->nama_admin; ?></h5>
                                        <p>ADMIN</p>
                                    </div>
                                <?php endif; ?>
                                <?php if (session()->get('role') == 2) : ?>
                                    <img src="<?= base_url('assets/app-assets/user/') . '/' . $siswa->avatar; ?>" class="img-fluid mr-2 bg-white" alt="avatar">
                                    <div class="media-body">
                                        <h5><?= $siswa->nama_siswa; ?></h5>
                                        <p>SISWA</p>
                                    </div>
                                <?php endif; ?>
                                <?php if (session()->get('role') == 3) : ?>
                                    <img src="<?= base_url('assets/app-assets/user/') . '/' . $guru->avatar; ?>" class="img-fluid mr-2 bg-white" alt="avatar">
                                    <div class="media-body">
                                        <h5><?= $guru->nama_guru; ?></h5>
                                        <p>GURU</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <?php if (session()->get('role') == 2) : ?>
                                <a href="<?= base_url('siswa/profile'); ?>">
                                <?php endif; ?>
                                <?php if (session()->get('role') == 3) : ?>
                                    <a href="<?= base_url('guru/profile'); ?>">
                                    <?php endif; ?>
                                    <?php if (session()->get('role') == 1) : ?>
                                        <a href="<?= base_url('app/profile'); ?>">
                                        <?php endif; ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg> <span>My Profile</span>
                                        </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="<?= base_url('auth/logout'); ?>" class="logout">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg> <span>Log Out</span>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!-- Content -->
        <?= $this->renderSection('content'); ?>

    </div>
    <!-- END MAIN CONTAINER -->
    <script src="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/plugins/jquery-step/jquery.steps.min.js"></script>
    <script src="<?= base_url('assets/app-assets/template/cbt-malela'); ?>/plugins/jquery-step/custom-jquery.steps.js"></script>
    <script>
        $(document).ready(function() {
            $(".btn-hapus").on("click", function(e) {
                e.preventDefault();
                var t = $(this).attr("href");
                swal({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Delete",
                    padding: "2em"
                }).then(function(e) {
                    e.value && (document.location.href = t)
                })
            }), $(".logout").on("click", function(e) {
                e.preventDefault();
                var t = $(this).attr("href");
                swal({
                    title: "Are you sure?",
                    text: "kamu harus login ulang untuk masuk kedalam aplikasi!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Logout",
                    padding: "2em"
                }).then(function(e) {
                    e.value && (document.location.href = t)
                })
            }), $(".custom-file-input").on("change", function() {
                var e = $(this).val().split("\\").pop();
                $(this).next(".custom-file-label").addClass("selected").html(e)
            }), $("#datatable-table").DataTable({
                oLanguage: {
                    oPaginate: {
                        sPrevious: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        sNext: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                    },
                    sInfo: "tampilkan halaman _PAGE_ dari _PAGES_",
                    sSearch: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    sSearchPlaceholder: "Cari Data...",
                    sLengthMenu: "Hasil :  _MENU_"
                },
                stripeClasses: [],
                lengthMenu: [
                    [-1, 5, 10, 25, 50],
                    ["All", 5, 10, 25, 50]
                ]
            })
        });
    $(".mulai-ujian").on("click", function(a) {
        a.preventDefault(); 
        url = $(this).data('link');
        swal({
            title: "apakah kamu yakin?",
            text: "jika ya, waktu ujian akan langsung dimulai!",
            type: "warning",
            showCancelButton: !0,
            cancelButtonText: "tidak",
            confirmButtonText: "ya, mulai",
            padding: "2em"
        }).then((result) => {
            if (result.value){
                // console.log(url);
                window.location = url;
            }
        })
    });

    $(".mulai-essay").on("click", function(a) {
        a.preventDefault();
        url = $(this).data('link');
        swal({
            title: "apakah kamu yakin?",
            text: "jika ya, waktu ujian akan langsung dimulai!",
            type: "warning",
            showCancelButton: !0,
            cancelButtonText: "tidak",
            confirmButtonText: "ya, mulai",
            padding: "2em"
        }).then((result) => {
            if (result.value){
                // console.log(url);
                window.location = url;
            }
        })
    });

    $('.ujian').hover(function() {
        $(this).css('cursor','pointer');
    });

    <?php if ($siswa->status_member != '1') : ?>
        $(".sidebar-materi").on("click", function(a) {
            a.preventDefault();
            url = "https://wa.me/085603220708?text=Halo%20saya%20ingin%20upgrade%20akun%20saya%20";
            swal({
                icon: "error",
                title: "Ups...",
                text: "Akun anda masih trial",
                type: "warning",
                showCancelButton: !0,
                cancelButtonText: "Nanti dulu",
                confirmButtonText: "Upgrade premium",
                padding: "2em"
                // footer: '<a href="https://wa.me/085603220708?text=Halo%20saya%20ingin%20upgrade%20akun%20saya%20" target="_blank">Upgrade ke premium jika ingin membuka fitur ini</a>'
            }).then((result) => {
            if (result.value){
                // console.log(url);
                window.open(url, '_blank');
            }
        })
        });
    <?php endif; ?>
    </script>

</body>


</html>