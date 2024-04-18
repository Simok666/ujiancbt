<?= $this->extend('template/app'); ?>
<?= $this->section('content'); ?>
<?= $this->include('template/sidebar/guru'); ?>
<style>
    .btn-white {
        background: #cacaca;
        color: #fff;
    }
</style>

<?php

use App\Models\EssaysiswaModel;
use App\Models\EssaydetailModel;

$essaysiswamodel = new EssaysiswaModel();
?>

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 layout-spacing">
                <div class="widget shadow p-3">
                    <div class="widget-heading">
                        <h5 class=""><?= $ujian->nama_ujian; ?></h5>
                        <table class="mt-2">
                            <tr>
                                <th>Jumlah Soal</th>
                                <th>: <?= count($essay_detail); ?> Soal</th>
                            </tr>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>: <?= $siswa->nama_siswa; ?></th>
                            </tr>
                            <tr>
                                <th>Kelas</th>
                                <th>: <?= $ujian->nama_kelas; ?></th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="widget-content">
                    <div class="row">
                        <div class="col-lg-9">
                            <form id="examwizard-question" action="javascript:void(0);" method="POST">
                                <input type="hidden" name="kode" value="<?= $ujian->kode_ujian; ?>">
                                <div class="widget shadow p-2">
                                    <div>
                                        <?php
                                        $no = 1;
                                        $soal_hidden = '';
                                        ?>
                                        <?php foreach ($essay_detail as $soal) : ?>
                                            <?php $jawaban_siswa = $essaysiswamodel->getByUjianAndSiswa($soal->id_essay_detail, $siswa->id_siswa); ?>
                                            <div class="question <?= $soal_hidden; ?> question-<?= $no; ?>" data-question="<?= $no; ?>">
                                                <div class="widget-heading pl-2 pt-2" style="border-bottom: 1px solid #e0e6ed;">
                                                    <div class="">
                                                        <h6 class="" style="font-weight: bold">Soal No. <span class="badge badge-primary no-soal" style="font-size: 1rem"><?= $no; ?></span>
                                                        </h6>
                                                    </div>
                                                </div>

                                                <div class="widget p-3 mt-3">
                                                    <div class="widget-heading" style="border-bottom: 1px solid #e0e6ed;">
                                                        <h6 class="question-title color-green" style="word-wrap: break-word">
                                                            <?= $soal->soal; ?>
                                                        </h6>
                                                    </div>
                                                    <div class="widget-content mt-3" style="position: relative;">
                                                        <div class="alert alert-danger hidden"></div>
                                                        <div class="green-radio color-green">
                                                            <!-- <textarea name="<?= $soal->id_essay_detail; ?>" data-alternateName="<?= $soal->id_essay_detail; ?>" data-alternateValue="<?= $no; ?>" id="soal<?= $no; ?>-<?= $soal->id_essay_detail ?>" data-essay_siswa="<?= $jawaban_siswa->id_essay_siswa; ?>" data-noSoal="<?= $no; ?>" class="form-control" placeholder="Tidak Dijawab..." readonly style="background-color: #fff !important"><?php if ($jawaban_siswa->jawaban !== null) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo $jawaban_siswa->jawaban;
                                                                                                                                                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo "Tidak dikerjakan";
                                                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>
                                                            </textarea> -->
                                                            <?php if ($jawaban_siswa->jawaban !== null) {
                                                                    echo $jawaban_siswa->jawaban;
                                                                } else {
                                                                    echo "Tidak dikerjakan";
                                                                }
                                                            ?>
                                                        </div>
                                                        <p class="mt-2" style="font-weight: bold">Nilai : <?= ($jawaban_siswa->score == null) ? 'belum dinilai' : $jawaban_siswa->score; ?></p>
                                                    </div>
                                                    <div class="widget-footer pt-2" style="border-top: 1px solid #e0e6ed; font-weight: bold;">
                                                        <input type="number" name="nilai" class="form-control" class="nilai" placeholder="input nilai disini" data-id="<?= $jawaban_siswa->id_essay_siswa; ?>">
                                                    </div>
                                                </div>

                                            </div>
                                            <?php
                                            $soal_hidden = 'hidden';
                                            $no++;
                                            ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <!-- SOAL -->

                                    <input type="hidden" value="1" id="currentQuestionNumber" name="currentQuestionNumber" />
                                    <input type="hidden" value="<?= count($essay_detail); ?>" id="totalOfQuestion" name="totalOfQuestion" />
                                    <input type="hidden" value="[]" id="markedQuestion" name="markedQuestions" />
                                    <!-- END SOAL -->
                                </div>
                            </form>

                            <!-- Exmas Footer - Multi Step Pages Footer -->
                            <div class="row">
                                <div class="col-lg-12 exams-footer">
                                    <div class="row pb-3">
                                        <div class="col-sm-1 back-to-prev-question-wrapper text-center mt-3">
                                            <a href="javascript:void(0);" id="back-to-prev-question" class="btn btn-primary disabled">
                                                Back
                                            </a>
                                        </div>

                                        <div class="col-sm-2 footer-question-number-wrapper text-center mt-3">
                                            <div>
                                                <span id="current-question-number-label">1</span>
                                                <span>Dari <b><?= count($essay_detail); ?></b></span>
                                            </div>
                                            <div>
                                                Nomor Soal
                                            </div>
                                        </div>
                                        <div class="col-sm-1 go-to-next-question-wrapper text-center mt-3">
                                            <a href="javascript:void(0);" id="go-to-next-question" class="btn btn-primary">
                                                Next
                                            </a>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-lg-3" id="quick-access-section" class="table-responsive">
                            <div class="widget shadow p-3">
                                <div class="widget-heading pl-2 pt-2" style="border-bottom: 1px solid #e0e6ed;">
                                    <h6 style="font-weight: bold;">Nomor Soal</h6>
                                </div>
                                <div class="widget-content">
                                    <?php
                                    $no = 1;
                                    $soal_hidden = '';
                                    ?>
                                    <?php foreach ($essay_detail as $soal) : ?>
                                        <?php $jawaban = $essaysiswamodel->getByUjianAndSiswa($soal->id_essay_detail, $siswa->id_siswa); ?>
                                        <div class="question-response-rows d-inline" data-question="<?= $no; ?>">
                                            <button class="btn 
                                        <?php
                                        if ($jawaban->ragu == null && $jawaban->jawaban == null) {
                                            echo 'btn-white';
                                        }

                                        ?>
                                        shadow mt-2 question-response-rows-value 
                                        <?php
                                        if ($jawaban->jawaban !== null) {
                                            echo 'btn-info';
                                        }
                                        if ($jawaban->ragu == 1) {
                                            echo ' btn-warning';
                                        }
                                        ?>" id="soalId<?= $soal->id_essay_detail ?>" style="width: 40px; height: 40px; font-weight: bold; padding: 0;">
                                                <?= $no; ?>
                                            </button>
                                        </div>
                                        <?php $no++; ?>
                                    <?php endforeach; ?>
                                    <div class="mt-3">
                                        <span class="badge badge-info text-info" style="padding: 0px 6px;">-</span> = Sudah dikerjakan
                                        <br>
                                        <span class="badge badge-warning text-warning" style="padding: 0px 6px;">-</span> = Ragu - Ragu
                                        <br>
                                        <span class="badge btn-white" style="color: #cacaca; padding: 0px 6px;">-</span> = Belum dikerjakan
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <a href="<?= base_url('guru/lihat_essay/' . encrypt_url($ujian->kode_ujian)) . '/' . encrypt_url(session()->get('id')); ?>" class="btn btn-primary mt-3">Kembali</a>
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
</script>
<script>
    $('input[name=nilai]').change(function() {
        var nilai = $(this).val();
        var id = $(this).data('id');

        $.ajax({
            type: 'post',
            data: {
                nilai: nilai,
                id: id
            },
            async: true,
            url: "<?= base_url('guru/nilai_essay'); ?>",
            success: function(data) {
                console.log(data);
            }
        });
    });

    var examWizard = $.fn.examWizard({
        finishOption: {
            enableModal: !0
        }
    });
    $(".question-response-rows").click(function() {
        var e = $(this).data("question"),
            n = ".question-" + e;
        $(".question").addClass("hidden"), $(n).removeClass("hidden"), $("input[name=currentQuestionNumber]").val(e), $("#current-question-number-label").text(e), $("#back-to-prev-question").removeClass("disabled"), $("#go-to-next-question").removeClass("disabled")
    });
</script>


<?= $this->endSection(); ?>