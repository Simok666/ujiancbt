<?= $this->extend('template/app'); ?>
<?= $this->section('content'); ?>
<?= $this->include('template/sidebar/siswa'); ?>
<style>
    .btn-white {
        background: #cacaca;
        color: #fff;
    }

    .hidden {
        display: none;
    }
</style>
<?php

use App\Models\EssaysiswaModel;

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
                        <div class="row">
                            <div class="col-lg-6">
                                <table class="mt-2">
                                    <tr>
                                        <th>Jumlah Soal</th>
                                        <th> : <span class="text-primary"><?= count($essay_detail); ?> Soal</span></th>
                                    </tr>
                                    <tr>
                                        <th>Waktu Ujian</th>
                                        <th> : <?= $ujian->waktu_ujian; ?> Menit</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($waktu_ujian->selesai === null) : ?>
            <div class="row">
                <div class="col-lg-9">
                    <form id="examwizard-question" action="<?= base_url('siswa/kirim_essay'); ?>" method="POST">
                        <input type="hidden" name="kode" value="<?= $ujian->kode_ujian; ?>">
                        <div class="widget shadow p-2">
                            <div class="d-flex float-right">
                                <div class="badge badge-primary" style="font-size: 18px; font-weight: bold;"><span class="fas fa-clock"></span> | <span class="jam_skrng">00 : 00 : 00</span></div>
                            </div>
                            <div>
                                <?php
                                $no = 1;
                                $soal_hidden = '';
                                ?>
                                <?php foreach ($essay_detail as $soal) : ?>
                                    <?php $jawaban_siswa = $essaysiswamodel->getByUjianAndSiswa($soal->id_essay_detail, session()->get('id')); ?>
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
                                                <div class="timer-check hidden" style="margin: 10px 0px; width: 100%; height: 100%; background-color: rgba(255, 255, 255, 0.5);">
                                                    <h5 style="display: flex; justify-content: center; align-items: center; margin-top: 30px;">
                                                        <span class="badge badge-danger">Waktu Habis!</span>
                                                    </h5>
                                                </div>
                                                <div class="green-radio color-green">
                                                    <textarea name="<?= $soal->id_essay_detail; ?>" data-alternateName="<?= $soal->id_essay_detail; ?>" data-alternateValue="<?= $no; ?>" id="soal<?= $no; ?>-<?= $soal->id_essay_detail; ?>" data-essay_siswa="<?= $jawaban_siswa->id_essay_siswa; ?>" data-noSoal="<?= $no; ?>" class="form-control summernote-img" placeholder="tuliskan jawaban..."><?php if ($jawaban_siswa->jawaban !== null) {
                                                                                                                                                                                                                                                                                                                                                                                                echo $jawaban_siswa->jawaban;
                                                                                                                                                                                                                                                                                                                                                                                            } ?></textarea>
                                                </div>
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

                                <div class="col-sm-3 text-center mt-3 ragu-container">
                                    <?php
                                    $no = 1;
                                    $hidden = '';
                                    ?>

                                    <?php foreach ($essay_detail as $soal) : ?>
                                        <?php $jawaban_siswa = $essaysiswamodel->getByUjianAndSiswa($soal->id_essay_detail, session()->get('id')); ?>
                                        <div class="question <?= $hidden; ?> question-<?= $no; ?> ragus ragus-<?= $no; ?>" data-question="<?= $no; ?>">
                                            <a href="javascript:void(0);" class="btn btn-warning">
                                                <input type="checkbox" class="ragu" id="ragu<?= $soal->id_essay_detail ?>" data-id_essay="<?= $jawaban_siswa->id_essay_siswa; ?>" data-mark_name="<?= $soal->id_essay_detail ?>" data-question="<?= $no; ?>" <?= ($jawaban_siswa->ragu) ? 'checked' : ''; ?>>
                                                <label for="ragu<?= $soal->id_essay_detail ?>" class="mb-0 text-white">Ragu - Ragu</label>
                                            </a>
                                        </div>
                                        <?php
                                        $no++;
                                        $hidden = 'hidden';
                                        ?>
                                    <?php endforeach; ?>
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
                            <?php $no = 1; ?>
                            <?php foreach ($essay_detail as $soal) : ?>
                                <?php $jawaban = $essaysiswamodel->getByUjianAndSiswa($soal->id_essay_detail, session()->get('id')); ?>
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
                                <?php $no++ ?>
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
                    <div class="widget shadow p-3 mt-3">
                        <button class="btn btn-primary btn-block kirim-jawaban">Kirim Jawaban</button>
                    </div>
                </div>

            </div>
        <?php else : ?>
            <div class="row">
                <div class="col-lg-9">
                    <form id="examwizard-question" action="#" method="POST">
                        <div class="widget shadow p-2">
                            <div class="d-flex float-right">
                                <div class="badge badge-primary" style="font-size: 18px; font-weight: bold;"><span class="fas fa-clock"></span> | <span class="jam_skrng">00 : 00 : 00</span></div>
                            </div>
                            <div>
                                <?php
                                $no = 1;
                                $soal_hidden = '';
                                $total_nilai = 0;
                                ?>
                                <?php foreach ($essay_detail as $soal) : ?>
                                    <?php $jawaban_siswa = $essaysiswamodel->getByUjianAndSiswa($soal->id_essay_detail, session()->get('id')); ?>
                                    <?php $total_nilai = $total_nilai + $jawaban_siswa->score; ?>
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
                                                    <!-- <textarea name="<?= $soal->id_essay_detail; ?>" data-alternateName="<?= $soal->id_essay_detail; ?>" data-alternateValue="<?= $no; ?>" id="soal<?= $no; ?>-<?= $soal->id_essay_detail; ?>" data-essay_siswa="<?= $jawaban_siswa->id_essay_siswa; ?>" data-noSoal="<?= $no; ?>" class="form-control" readonly></textarea> -->
                                                    <?php if ($jawaban_siswa->jawaban !== null) {
                                                        echo $jawaban_siswa->jawaban;
                                                    } ?>
                                                    <p class="mt-2" style="font-weight: bold">Nilai : <?= $jawaban_siswa->score; ?></p>
                                                </div>
                                            </div>
                                            <div class="widget-footer pt-2" style="border-top: 1px solid #e0e6ed; font-weight: bold;">
                                                Total Nilai : <span class="total_nilai"></span>
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
                            <?php $no = 1; ?>
                            <?php foreach ($essay_detail as $soal) : ?>
                                <?php $jawaban = $essaysiswamodel->getByUjianAndSiswa($soal->id_essay_detail, session()->get('id')); ?>
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
                                <?php $no++ ?>
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
        <?php endif; ?>
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

<!-- MODAL -->
<script>
    <?= session()->getFlashdata('pesan'); ?>

    $(document).ready(function() {
        function uploadImage(e, a) {
            var l = new FormData;
            l.append("image", e), $.ajax({
                url: "<?= base_url('siswa/upload_summernote') ?>",
                cache: !1,
                contentType: !1,
                processData: !1,
                data: l,
                type: "POST",
                success: function(e) {
                    $(a).summernote("insertImage", e)
                },
                error: function(e) {
                    console.log(e)
                }
            })
        }
    
        function deleteImage(e) {
            $.ajax({
                data: {
                    src: e
                },
                type: "POST",
                url: "<?= base_url('siswa/delete_image') ?>",
                cache: !1,
                success: function(e) {
                    console.log(e)
                }
            })
        }
        setInterval(() => {
            $(".summernote-img").summernote({
                // placeholder: "Hello stand alone ui",
                tabsize: 2,
                // width: 340,
                // height: 120,
                toolbar: [
                    ["insert", ["picture"]],
                ],
                callbacks: {
                    onImageUpload: function(e, a = this) {
                        uploadImage(e[0], a)
                    },
                    onMediaDelete: function(e) {
                        deleteImage(e[0].src)
                    }
                }
            })
        }, 1e3);

    })

    $(".question-response-rows").click(function() {
        var e = $(this).data("question"),
            n = ".question-" + e;
        $(".question").addClass("hidden"), $(n).removeClass("hidden"), $("input[name=currentQuestionNumber]").val(e), $("#current-question-number-label").text(e), $("#back-to-prev-question").removeClass("disabled"), $("#go-to-next-question").removeClass("disabled")
    });
    var examWizard = $.fn.examWizard({
        finishOption: {
            enableModal: !0
        }
    });

    <?php if ($waktu_ujian->selesai === null) : ?>
        var countDownDate = new Date("<?= $waktu_ujian->waktu_berakhir; ?>").getTime();
        var x = setInterval(function() {
            var e = (new Date).getTime(),
                r = countDownDate - e,
                n = (Math.floor(r / 864e5), Math.floor(r % 864e5 / 36e5)),
                a = Math.floor(r % 36e5 / 6e4),
                e = Math.floor(r % 6e4 / 1e3);
            document.querySelector(".jam_skrng").innerHTML = n + " : " + a + " : " + e, r < 0 && (clearInterval(x), document.querySelector(".jam_skrng").innerHTML = "00 : 00 : 00", $(".timer-check").removeClass("hidden"), $(".ragu-container").addClass("hidden"))
        }, 500);
        // $("textarea").change(function() {
        $(".summernote-img").on('summernote.change',function() {
            var a = "soalId" + $(this).attr("name");
            "" == $(this).val() ? ($("#" + a).addClass("btn-white"), $("#" + a).removeClass("btn-info")) : ($("#" + a).removeClass("btn-white"), $("#" + a).addClass("btn-info"), $("#" + a).addClass("text-white"));
            var s = $(this).attr("name"),
                t = $(this).data("essay_siswa"),
                // a = $(this).val();
                a = $(this).summernote('code');
            $.ajax({
                type: "POST",
                data: {
                    idDetail: s,
                    id_essay: t,
                    jawaban: a
                },
                async: !0,
                url: "<?= base_url('siswa/simpan_essay') ?>",
                success: function(a) {
                    console.log(a)
                }
            })
        });
        $(".ragu").click(function() {
            var s, a = "soalId" + $(this).data("mark_name");
            $(this).is(":checked") ? ($("#" + a).removeClass("btn-white"), $("#" + a).addClass("btn-warning"), s = $(this).data("id_essay"), $.ajax({
                type: "POST",
                data: {
                    ragu: 1,
                    id_essay: s
                },
                async: !0,
                url: "<?= base_url('siswa/ragu_essay') ?>",
                success: function(s) {
                    console.log(s)
                }
            })) : ($("#" + a).removeClass("btn-warning"), $("#" + a).hasClass("btn-info") ? $("#" + a).removeClass("btn-white") : $("#" + a).addClass("btn-white"), s = $(this).data("id_essay"), $.ajax({
                type: "POST",
                data: {
                    ragu: "",
                    id_essay: s
                },
                async: !0,
                url: "<?= base_url('siswa/ragu_essay') ?>",
                success: function(s) {
                    console.log(s)
                }
            }))
        });
        $("#go-to-next-question").click(function() {
            var e = $("input[name=currentQuestionNumber]").val(),
                n = parseInt(e) + parseInt(1),
                e = "ragus-" + n;
            n <= "<?= count($essay_detail); ?>" && ($(".ragus").addClass("hidden"), $("." + e).removeClass("hidden"))
        }), $("#back-to-prev-question").click(function() {
            var e = $("input[name=currentQuestionNumber]").val(),
                n = parseInt(e) - parseInt(1),
                e = "ragus-" + n;
            0 != n && ($(".ragus").addClass("hidden"), $("." + e).removeClass("hidden"))
        });
        $(".kirim-jawaban").on("click", function(a) {
            a.preventDefault(), swal({
                title: "apakah kamu yakin?",
                text: "pastikan anda sudah menjawab soal dengan benar!",
                type: "warning",
                showCancelButton: !0,
                cancelButtonText: "tidak",
                confirmButtonText: "ya, kirim",
                padding: "2em"
            }).then(function(a) {
                a.value && $("#examwizard-question").submit()
            })
        });
    <?php else : ?>
        setTimeout(() => {
            $('.total_nilai').html("<?= $total_nilai; ?>");
        }, 500);
    <?php endif; ?>
</script>

<?= $this->endSection(); ?>