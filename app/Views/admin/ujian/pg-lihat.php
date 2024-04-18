<?= $this->extend('template/app'); ?>
<?= $this->section('content'); ?>
<?= $this->include('template/sidebar/admin'); ?>
<style>
    .table>tbody:before {
        line-height: 0em;
        content: "_";
        color: white;
        display: block;
    }
</style>
<?php

use App\Models\UjiansiswaModel;
use App\Models\WaktuujianModel;

$UjiansiswaModel = new UjiansiswaModel();
$WaktuUjianModel = new WaktuUjianModel();
?>

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 layout-spacing">
                <div class="widget shadow p-3">
                    <div class="widget-heading">
                        <h5 class="">lorem<?= $ujian->nama_ujian; ?></h5>
                        <table class="mt-2">
                            <tr>
                                <th>Kelas</th>
                                <th>: <?= $ujian->nama_kelas; ?></th>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <th>: <?= $ujian->nama_mapel; ?></th>
                            </tr>
                            <tr>
                                <th>Jumlah Soal</th>
                                <th>: <?= count($detail_ujian); ?> Soal</th>
                            </tr>
                            <tr>
                                <th>Waktu Ujian</th>
                                <th>: <?= $ujian->waktu_ujian; ?> Menit</th>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <!-- Soal Ujian -->
        <div id="toggleAccordion" class="shadow">
            <div class="card">
                <div class="card-header bg-white" id="...">
                    <section class="mb-0 mt-0">
                        <div role="menu" class="" data-toggle="collapse" data-target="#defaultAccordionOne" aria-expanded="true" aria-controls="defaultAccordionOne" style="cursor: pointer;">
                            Soal Ujian & Jawaban (Klik untuk lihat & tutup)
                        </div>
                    </section>
                </div>

                <div id="defaultAccordionOne" class="collapse show" aria-labelledby="..." data-parent="#toggleAccordion">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-9">
                                <form id="examwizard-question" action="#" method="POST">
                                    <div class="widget shadow p-2">
                                        <div>
                                            <?php
                                            $no = 1;
                                            $soal_hidden = '';
                                            foreach ($detail_ujian as $soal) : ?>
                                                <div class="question <?= $soal_hidden ?> question-<?= $no ?>" data-question="<?= $no ?>">
                                                    <div class="widget-heading pl-2 pt-2" style="border-bottom: 1px solid #e0e6ed;">
                                                        <div class="">
                                                            <h6 class="" style="font-weight: bold">Soal No. <span class="badge badge-primary no-soal"><?= $no ?></span>
                                                            </h6>
                                                        </div>
                                                    </div>

                                                    <div class="widget p-3 mt-3">
                                                        <div class="widget-heading" style="border-bottom: 1px solid #e0e6ed;">
                                                            <h6 class="question-title color-green" style="word-wrap: break-word">
                                                                <?= $soal->nama_soal; ?>
                                                            </h6>
                                                        </div>
                                                        <div class="widget-content mt-3">
                                                            <div class="alert alert-danger hidden"></div>
                                                            <div class="green-radio color-green">
                                                                <ol type="A" style="color: #000; margin-left: -20px;">
                                                                    <li class="answer-number">
                                                                        <label for="answer-<?= $soal->id_detail_ujian; ?>-<?= substr($soal->pg_1, 0, 1); ?>" class="answer-text" style="color: #000;">
                                                                            <span></span><?= substr($soal->pg_1, 3, strlen($soal->pg_1)); ?>
                                                                        </label>
                                                                    </li>
                                                                    <li class="answer-number">
                                                                        <label for="answer-<?= $soal->id_detail_ujian; ?>-<?= substr($soal->pg_2, 0, 1); ?>" class="answer-text" style="color: #000;">
                                                                            <span></span><?= substr($soal->pg_2, 3, strlen($soal->pg_2)); ?>
                                                                        </label>
                                                                    </li>
                                                                    <li class="answer-number">
                                                                        <label for="answer-<?= $soal->id_detail_ujian; ?>-<?= substr($soal->pg_3, 0, 1); ?>" class="answer-text" style="color: #000;">
                                                                            <span></span><?= substr($soal->pg_3, 3, strlen($soal->pg_3)); ?>
                                                                        </label>
                                                                    </li>
                                                                    <li class="answer-number">
                                                                        <label for="answer-<?= $soal->id_detail_ujian; ?>-<?= substr($soal->pg_4, 0, 1); ?>" class="answer-text" style="color: #000;">
                                                                            <span></span><?= substr($soal->pg_4, 3, strlen($soal->pg_4)); ?>
                                                                        </label>
                                                                    </li>
                                                                    <li class="answer-number">
                                                                        <label for="answer-<?= $soal->id_detail_ujian; ?>-<?= substr($soal->pg_5, 0, 1); ?>" class="answer-text" style="color: #000;">
                                                                            <span></span><?= substr($soal->pg_5, 3, strlen($soal->pg_5)); ?>
                                                                        </label>
                                                                    </li>
                                                                </ol>
                                                            </div>
                                                        </div>
                                                        <div class="widget-content mt-3" style="border-top: 1px solid #e0e6ed;">
                                                            <div class="widget-content mt-3">
                                                                <?= $soal->pembahasan; ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <?php $soal_hidden = 'hidden'; ?>
                                                <?php $no++ ?>
                                            <?php endforeach; ?>
                                        </div>
                                        <!-- SOAL -->

                                        <input type="hidden" value="1" id="currentQuestionNumber" name="currentQuestionNumber" />
                                        <input type="hidden" value="<?= count($detail_ujian); ?>" id="totalOfQuestion" name="totalOfQuestion" />
                                        <input type="hidden" value="[]" id="markedQuestion" name="markedQuestions" />
                                        <!-- END SOAL -->
                                    </div>
                                </form>

                            </div>

                            <div class="col-lg-3" id="quick-access-section" class="table-responsive">
                                <div class="widget shadow p-3">
                                    <div class="widget-content">
                                        <table class="table text-center table-hover">
                                            <thead class="question-response-header">
                                                <tr>
                                                    <th class="text-center">No. Soal</th>
                                                    <th class="text-center">Jawaban</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($detail_ujian as $soal) : ?>
                                                    <tr class="question-response-rows" data-question="<?= $no ?>" style="cursor: pointer;">
                                                        <td style="font-weight: bold;"><?= $no ?></td>
                                                        <td class="question-response-rows-value"><?= $soal->jawaban; ?></td>
                                                    </tr>
                                                    <?php $no++; ?>
                                                <?php endforeach; ?>

                                            </tbody>
                                        </table>
                                        <div class="text-nowrap text-center">
                                            <a href="javascript:void(0)" class="btn btn-success" id="quick-access-prev">
                                                &laquo;
                                            </a>
                                            <span class="alert alert-info" id="quick-access-info"></span>
                                            <a href="javascript:void(0)" class="btn btn-success" id="quick-access-next">&raquo;</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Exmas Footer - Multi Step Pages Footer -->
                        <div class="row mt-3">
                            <div class="col-lg-12 exams-footer p-3">
                                <div class="row">
                                    <div class="col-sm-1 back-to-prev-question-wrapper text-center">
                                        <a href="javascript:void(0);" id="back-to-prev-question" class="btn btn-success disabled">
                                            Back
                                        </a>
                                    </div>
                                    <div class="col-sm-2 footer-question-number-wrapper text-center">
                                        <div>
                                            <span id="current-question-number-label">1</span>
                                            <span>Dari <b><?= count($detail_ujian); ?></b></span>
                                        </div>
                                        <div>
                                            Nomor Soal
                                        </div>
                                    </div>
                                    <div class="col-sm-1 go-to-next-question-wrapper text-center">
                                        <a href="javascript:void(0);" id="go-to-next-question" class="btn btn-success">
                                            Next
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Jawaban Siswa -->
        <div id="iconsAccordion" class="accordion-icons shadow mt-3">
            <div class="card">
                <div class="card-header bg-white" id="...">
                    <section class="mb-0 mt-0">
                        <div role="menu" class="" data-toggle="collapse" data-target="#iconAccordionOne" aria-expanded="true" aria-controls="iconAccordionOne" style="cursor: pointer;">
                            Nilai Peserta (Klik untuk lihat & tutup)
                        </div>
                    </section>
                </div>

                <div id="iconAccordionOne" class="collapse show" aria-labelledby="..." data-parent="#iconsAccordion">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="widget p-3 shadow">
                                    <div class="widget-heading pl-2 pb-2" style="border-bottom: 1px solid #e0e6ed;">
                                        Nilai Peserta
                                    </div>

                                    <div class="widget-content">
                                        <a href="<?= base_url('guru/cetak_nilai_pg/' . encrypt_url($ujian->kode_ujian)); ?>" class="btn btn-info btn-sm" target="_blank"><span data-feather="printer"></span> Cetak</a>
                                        <div class="table-responsive mt-3">
                                            <table class="table table-bordered text-nowrap">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Nama Peserta</th>
                                                        <th>Benar</th>
                                                        <th>Salah</th>
                                                        <th>Tidak Dijawab</th>
                                                        <th>opsi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($siswa as $s) : ?>
                                                        <?php $ujian_siswa = $WaktuUjianModel->getBySiswa($ujian->kode_ujian, $s->id_siswa); ?>
                                                        <?php if ($ujian_siswa !== null) : ?>
                                                            <?php if ($ujian_siswa->selesai === null) : ?>
                                                                <tr class="text-center">
                                                                    <td><?= $s->nama_siswa; ?></td>
                                                                    <td colspan="4">Belum Mengerjakan Ujian</td>
                                                                </tr>
                                                            <?php else : ?>
                                                                <?php $belum_terjawab = $UjiansiswaModel->belum_terjawab($ujian->kode_ujian, $s->id_siswa, null); ?>
                                                                <?php $benar = $UjiansiswaModel->salah($ujian->kode_ujian, $s->id_siswa, 1); ?>
                                                                <?php $salah = $UjiansiswaModel->salah($ujian->kode_ujian, $s->id_siswa, 0); ?>

                                                                <tr class="text-center">
                                                                    <td><?= $s->nama_siswa; ?></td>
                                                                    <td><?= count($benar); ?></td>
                                                                    <td><?= count($salah); ?></td>
                                                                    <td><?= count($belum_terjawab); ?></td>
                                                                    <td>
                                                                        <a href="<?= base_url('guru/pg_siswa/') . '/' . encrypt_url($s->id_siswa) . '/' . encrypt_url($ujian->kode_ujian); ?>" class="btn btn-info btn-sm"><span class="fas fa-eye"></span></a>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="<?= base_url('guru/ujian'); ?>" class="btn btn-primary mt-3">Kembali</a>
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
    var examWizard = $.fn.examWizard({
        finishOption: {
            enableModal: !0
        },
        quickAccessOption: {
            quickAccessPagerItem: 5
        }
    });
    $(".question-response-rows").click(function() {
        var e = $(this).data("question"),
            s = ".question-" + e;
        $(".question").addClass("hidden"), $(s).removeClass("hidden"), $("input[name=currentQuestionNumber]").val(e), $("#current-question-number-label").text(e), $("#back-to-prev-question").removeClass("disabled"), $("#go-to-next-question").removeClass("disabled")
    });
    <?= session()->getFlashdata('pesan'); ?>
</script>


<?= $this->endSection(); ?>