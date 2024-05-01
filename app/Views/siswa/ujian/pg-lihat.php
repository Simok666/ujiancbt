<?= $this->extend('template/app'); ?>
<?= $this->section('content'); ?>
<?= $this->include('template/sidebar/siswa'); ?>

<?php

use APP\Models\UjiansiswaModel;

$ujianSiswaModel = new UjiansiswaModel();
date_default_timezone_set('Asia/Jakarta');

?>
<style>
    .btn-white {
        background: #cacaca;
        color: #fff;
    }

    .hidden {
        display: none;
    }
</style>

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
                                        <th> : <span class="text-primary"><?= count($detail_ujian); ?> Soal</span></th>
                                    </tr>
                                    <tr>
                                        <th>Waktu Ujian</th>
                                        <th> : <?= $ujian->waktu_ujian; ?></th>
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
                    <form id="examwizard-question" action="<?= base_url('siswa/kirim_ujian'); ?>" method="POST">
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
                                <?php foreach ($detail_ujian as $soal) : ?>
                                    <?php $jawaban_siswa = $ujianSiswaModel
                                        ->where('ujian_id', $soal->id_detail_ujian)
                                        ->where('siswa', session()->get('id'))
                                        ->get()->getRowObject();
                                    ?>
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
                                                    <?= $soal->nama_soal; ?>
                                                </h6>
                                            </div>
                                            <div class="widget-content mt-3" style="position: relative;">
                                                <div class="alert alert-danger hidden"></div>
                                                <div class="timer-check hidden" style="position: absolute; width: 100%; height: 100%; background-color: rgba(255, 255, 255, 0.5);">
                                                    <h5 style="display: flex; justify-content: center; align-items: center; margin-top: 60px;">
                                                        <span class="badge badge-danger">Waktu Habis!</span>
                                                    </h5>
                                                </div>
                                                <div class="green-radio color-green">
                                                    <ol type="A" style="color: #000; margin-left: -20px;">
                                                        <li class="answer-number">
                                                            <input type="radio" data-alternatetype="radio" name="<?= $soal->id_detail_ujian; ?>" value="<?= substr($soal->pg_1, 0, 1); ?>" id="soal<?= $no; ?>-<?= substr($soal->pg_1, 0, 1); ?>" data-pg_siswa="<?= $jawaban_siswa->id_ujian_siswa; ?>" data-noSoal="<?= $no; ?>" <?= ($jawaban_siswa->jawaban == substr($soal->pg_1, 0, 1)) ? 'checked' : '' ?> />
                                                            <label for="soal<?= $no; ?>-<?= substr($soal->pg_1, 0, 1); ?>" class="answer-text" style="color: #000;">
                                                                <span><?= substr($soal->pg_1, 3, strlen($soal->pg_1)); ?></span>
                                                            </label>
                                                        </li>
                                                        <li class="answer-number">
                                                            <input type="radio" data-alternatetype="radio" name="<?= $soal->id_detail_ujian; ?>" value="<?= substr($soal->pg_2, 0, 1); ?>" id="soal<?= $no; ?>-<?= substr($soal->pg_2, 0, 1); ?>" data-pg_siswa="<?= $jawaban_siswa->id_ujian_siswa; ?>" data-noSoal="<?= $no; ?>" <?= ($jawaban_siswa->jawaban == substr($soal->pg_2, 0, 1)) ? 'checked' : '' ?> />
                                                            <label for="soal<?= $no; ?>-<?= substr($soal->pg_2, 0, 1); ?>" class="answer-text" style="color: #000;">
                                                                <span><?= substr($soal->pg_2, 3, strlen($soal->pg_2)); ?></span>
                                                            </label>
                                                        </li>
                                                        <li class="answer-number">
                                                            <input type="radio" data-alternatetype="radio" name="<?= $soal->id_detail_ujian; ?>" value="<?= substr($soal->pg_3, 0, 1); ?>" id="soal<?= $no; ?>-<?= substr($soal->pg_3, 0, 1); ?>" data-pg_siswa="<?= $jawaban_siswa->id_ujian_siswa; ?>" data-noSoal="<?= $no; ?>" <?= ($jawaban_siswa->jawaban == substr($soal->pg_3, 0, 1)) ? 'checked' : '' ?> />
                                                            <label for="soal<?= $no; ?>-<?= substr($soal->pg_3, 0, 1); ?>" class="answer-text" style="color: #000;">
                                                                <span><?= substr($soal->pg_3, 3, strlen($soal->pg_3)); ?></span>
                                                            </label>
                                                        </li>
                                                        <li class="answer-number">
                                                            <input type="radio" data-alternatetype="radio" name="<?= $soal->id_detail_ujian; ?>" value="<?= substr($soal->pg_4, 0, 1); ?>" id="soal<?= $no; ?>-<?= substr($soal->pg_4, 0, 1); ?>" data-pg_siswa="<?= $jawaban_siswa->id_ujian_siswa; ?>" data-noSoal="<?= $no; ?>" <?= ($jawaban_siswa->jawaban == substr($soal->pg_4, 0, 1)) ? 'checked' : '' ?> />
                                                            <label for="soal<?= $no; ?>-<?= substr($soal->pg_4, 0, 1); ?>" class="answer-text" style="color: #000;">
                                                                <span><?= substr($soal->pg_4, 3, strlen($soal->pg_4)); ?></span>
                                                            </label>
                                                        </li>
                                                        <li class="answer-number">
                                                            <input type="radio" data-alternatetype="radio" name="<?= $soal->id_detail_ujian; ?>" value="<?= substr($soal->pg_5, 0, 1); ?>" id="soal<?= $no; ?>-<?= substr($soal->pg_5, 0, 1); ?>" data-pg_siswa="<?= $jawaban_siswa->id_ujian_siswa; ?>" data-noSoal="<?= $no; ?>" <?= ($jawaban_siswa->jawaban == substr($soal->pg_5, 0, 1)) ? 'checked' : '' ?> />
                                                            <label for="soal<?= $no; ?>-<?= substr($soal->pg_5, 0, 1); ?>" class="answer-text" style="color: #000;">
                                                                <span><?= substr($soal->pg_5, 3, strlen($soal->pg_5)); ?></span>
                                                            </label>
                                                        </li>
                                                    </ol>
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
                            <input type="hidden" value="<?= count($detail_ujian); ?>" id="totalOfQuestion" name="totalOfQuestion" />
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
                                        <span>Dari <b><?= count($detail_ujian); ?></b></span>
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
                                    $soal_hidden = '';
                                    ?>
                                    <?php foreach ($detail_ujian as $soal) : ?>
                                        <?php $jawaban_siswa = $ujianSiswaModel
                                            ->where('ujian_id', $soal->id_detail_ujian)
                                            ->where('siswa', session()->get('id'))
                                            ->get()->getRowObject();
                                        ?>
                                        <div class="question <?= $soal_hidden; ?> question-<?= $no; ?> ragus ragus-<?= $no; ?>" data-question="<?= $no; ?>">
                                            <a href="javascript:void(0);" class="btn btn-warning">
                                                <input type="checkbox" class="ragu" id="ragu<?= $soal->id_detail_ujian; ?>" data-id_pg="<?= $jawaban_siswa->id_ujian_siswa; ?>" data-mark_name="<?= $soal->id_detail_ujian; ?>" data-question="<?= $no; ?>" <?= ($jawaban_siswa->ragu !== null) ? 'checked' : '' ?>>
                                                <label for="ragu<?= $soal->id_detail_ujian; ?>" class="mb-0 text-white">Ragu - Ragu</label>
                                            </a>
                                        </div>
                                        <?php
                                        $soal_hidden = 'hidden';
                                        $no++;
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
                            <?php
                            $no = 1;
                            ?>
                            <?php foreach ($detail_ujian as $soal) : ?>
                                <?php $jawaban_siswa = $ujianSiswaModel
                                    ->where('ujian_id', $soal->id_detail_ujian)
                                    ->where('siswa', session()->get('id'))
                                    ->get()->getRowObject();
                                ?>
                                <div class="question-response-rows d-inline" data-question="<?= $no; ?>">
                                    <button class="btn <?= ($jawaban_siswa->ragu == null && $jawaban_siswa->jawaban == null) ? 'btn-white' : ''; ?> shadow mt-2 question-response-rows-value <?= ($jawaban_siswa->jawaban !== null) ? 'btn-info' : ''; ?><?= ($jawaban_siswa->ragu !== null) ? ' btn-warning' : ''; ?>" id="soalId<?= $soal->id_detail_ujian ?>" style="width: 40px; height: 40px; font-weight: bold; text-align: center; padding: 0;">
                                        <?= $no; ?>
                                    </button>
                                </div>
                                <?php
                                $no++;
                                ?>
                            <?php endforeach; ?>
                            <div class="mt-3">
                                <span class="badge badge-info text-info" style="padding: 0px 6px;">-</span> = Sudah dikerjakan
                                <br>
                                <span class="badge badge-warning text-warning" style="padding: 0px 6px;">-</span> = Ragu - Ragu
                                <br>
                                <span class="badge btn-white" style="background-color: #cacaca; color: #cacaca; padding: 0px 6px;">-</span> = Belum dikerjakan
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
                                ?>
                                <?php foreach ($detail_ujian as $soal) : ?>
                                    <?php $jawaban_siswa = $ujianSiswaModel
                                        ->where('ujian_id', $soal->id_detail_ujian)
                                        ->where('siswa', session()->get('id'))
                                        ->get()->getRowObject();
                                    ?>
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
                                                    <?= $soal->nama_soal; ?>
                                                </h6>
                                            </div>
                                            <div class="widget-content mt-3" style="position: relative;">
                                                <div class="alert alert-danger hidden"></div>
                                                <div class="green-radio color-green">
                                                    <ol type="A" style="color: #000; margin-left: -20px;">
                                                        <li class="answer-number">
                                                            <label for="soal<?= $no; ?>-<?= substr($soal->pg_1, 0, 1); ?>" class="answer-text" style="color: #000;">
                                                                <span><?= substr($soal->pg_1, 3, strlen($soal->pg_1)); ?></span>
                                                            </label>
                                                        </li>
                                                        <li class="answer-number">
                                                            <label for="soal<?= $no; ?>-<?= substr($soal->pg_2, 0, 1); ?>" class="answer-text" style="color: #000;">
                                                                <span><?= substr($soal->pg_2, 3, strlen($soal->pg_2)); ?></span>
                                                            </label>
                                                        </li>
                                                        <li class="answer-number">
                                                            <label for="soal<?= $no; ?>-<?= substr($soal->pg_3, 0, 1); ?>" class="answer-text" style="color: #000;">
                                                                <span><?= substr($soal->pg_3, 3, strlen($soal->pg_3)); ?></span>
                                                            </label>
                                                        </li>
                                                        <li class="answer-number">
                                                            <label for="soal<?= $no; ?>-<?= substr($soal->pg_4, 0, 1); ?>" class="answer-text" style="color: #000;">
                                                                <span><?= substr($soal->pg_4, 3, strlen($soal->pg_4)); ?></span>
                                                            </label>
                                                        </li>
                                                        <li class="answer-number">
                                                            <label for="soal<?= $no; ?>-<?= substr($soal->pg_5, 0, 1); ?>" class="answer-text" style="color: #000;">
                                                                <span><?= substr($soal->pg_5, 3, strlen($soal->pg_5)); ?></span>
                                                            </label>
                                                        </li>
                                                    </ol>
                                                </div>
                                                <div class="mt-2" style="font-weight: bold;">
                                                    Jawaban Kamu :
                                                    <?= ($jawaban_siswa->jawaban == null) ? 'Tidak Dijawab' : $jawaban_siswa->jawaban; ?>

                                                    <?php if ($jawaban_siswa->benar == '1') {
                                                        echo '<span class="badge badge-success ml-1">benar</span>';
                                                    } ?>
                                                    <?php if ($jawaban_siswa->benar == '0') {
                                                        echo '<span class="badge badge-danger ml-1">salah</span>';
                                                    } ?>
                                                    <?php if ($jawaban_siswa->ragu == '1') {
                                                        echo '<span class="badge badge-warning ml-1">Ragu - Ragu</span>';
                                                    } ?>
                                                </div>
                                                <div class="mt-2" style="font-weight: bold;"> Jawaban Benar : <?= $soal->jawaban ?></div>
                                            </div>
                                            <div class="widget-content mt-3" style="border-top: 1px solid #e0e6ed;">
                                            <h6 class="widget-content mt-3">Pembahasan</h6>
                                                <div class="widget-content mt-3">
                                                    <?= $soal->pembahasan; ?>
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
                            <input type="hidden" value="<?= count($detail_ujian); ?>" id="totalOfQuestion" name="totalOfQuestion" />
                            <input type="hidden" value="[]" id="markedQuestion" name="markedQuestions" />
                            <!-- END SOAL -->

                            <?php
                            $salah = 0;
                            $benar = 0;
                            $tidakDijawab = 0;
                            ?>
                            <?php foreach ($ujian_siswa as $soal) {
                                if ($soal->benar == '0') {
                                    $salah++;
                                }
                                if ($soal->benar == '1') {
                                    $benar++;
                                }
                                if ($soal->benar === null) {
                                    $tidakDijawab++;
                                }
                            } ?>
                            <div class="widget-footer pl-2 py-2 mt-3" style="border-top: 1px solid #e0e6ed; font-weight: bold;">
                                Hasil Ujian |
                                Benar : <span class="badge badge-success mr-1"><?= $benar; ?></span>
                                Salah : <span class="badge badge-danger mr-1"><?= $salah; ?></span>
                                Tidak dijawab : <span class="badge btn-light"><?= $tidakDijawab; ?></span>
                            </div>

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
                                        <span>Dari <b><?= count($detail_ujian); ?></b></span>
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
                            ?>
                            <?php foreach ($detail_ujian as $soal) : ?>
                                <?php $jawaban_siswa = $ujianSiswaModel
                                    ->where('ujian_id', $soal->id_detail_ujian)
                                    ->where('siswa', session()->get('id'))
                                    ->get()->getRowObject();
                                ?>
                                <div class="question-response-rows d-inline" data-question="<?= $no; ?>">
                                    <button class="btn <?= ($jawaban_siswa->ragu == null && $jawaban_siswa->jawaban == null) ? 'btn-white' : ''; ?> shadow mt-2 question-response-rows-value <?= ($jawaban_siswa->jawaban !== null) ? 'btn-info' : ''; ?><?= ($jawaban_siswa->ragu !== null) ? ' btn-warning' : ''; ?>" id="soalId<?= $soal->id_detail_ujian ?>" style="width: 40px; height: 40px; font-weight: bold; text-align: center; padding: 0;">
                                        <?= $no; ?>
                                    </button>
                                </div>
                                <?php
                                $no++;
                                ?>
                            <?php endforeach; ?>
                            <div class="mt-3">
                                <span class="badge badge-info text-info" style="padding: 0px 6px;">-</span> = Sudah dikerjakan
                                <br>
                                <span class="badge badge-warning text-warning" style="padding: 0px 6px;">-</span> = Ragu - Ragu
                                <br>
                                <span class="badge btn-white" style="background-color: #cacaca; color: #cacaca; padding: 0px 6px;">-</span> = Belum dikerjakan
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

<script>
    <?= session()->getFlashdata('pesan'); ?>

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
        var countDownDate = new Date("<?= $waktu_ujian->waktu_berakhir; ?>").getTime(),
            x = setInterval(function() {
                var e = (new Date).getTime(),
                    a = countDownDate - e,
                    t = (Math.floor(a / 864e5), Math.floor(a % 864e5 / 36e5)),
                    n = Math.floor(a % 36e5 / 6e4),
                    e = Math.floor(a % 6e4 / 1e3);
                document.querySelector(".jam_skrng").innerHTML = t + " : " + n + " : " + e, a < 0 && (clearInterval(x), document.querySelector(".jam_skrng").innerHTML = "00 : 00 : 00", $(".timer-check").removeClass("hidden"), $(".ragu-container").addClass("hidden"))
            }, 500)
        $("input[type=radio]").click(function() {
            var a = "soalId" + $(this).attr("name");
            $("#" + a).removeClass("btn-white"), $("#" + a).addClass("btn-info"), $("#" + a).addClass("text-white");
            var s = $(this).attr("name"),
                t = $(this).data("pg_siswa"),
                a = $(this).val();
            $.ajax({
                type: "POST",
                data: {
                    idDetail: s,
                    id_pg: t,
                    jawaban: a
                },
                async: !0,
                url: "<?= base_url('siswa/simpan_pg'); ?>",
                success: function(a) {
                    console.log(a)
                }
            })
        });
        $(".ragu").click(function() {
            var a, s = "soalId" + $(this).data("mark_name");
            $(this).is(":checked") ? ($("#" + s).removeClass("btn-white"), $("#" + s).addClass("btn-warning"), a = $(this).data("id_pg"), $.ajax({
                type: "POST",
                data: {
                    ragu: 1,
                    id_pg: a
                },
                async: !0,
                url: "<?= base_url('siswa/ragu'); ?>",
                success: function(a) {
                    console.log(a)
                }
            })) : ($("#" + s).removeClass("btn-warning"), $("#" + s).hasClass("btn-info") ? $("#" + s).removeClass("btn-white") : $("#" + s).addClass("btn-white"), a = $(this).data("id_pg"), $.ajax({
                type: "POST",
                data: {
                    ragu: "",
                    id_pg: a
                },
                async: !0,
                url: "<?= base_url('siswa/ragu'); ?>",
                success: function(a) {
                    console.log(a)
                }
            }))
        });
        $("#go-to-next-question").click(function() {
            var e = $("input[name=currentQuestionNumber]").val(),
                n = parseInt(e) + parseInt(1),
                e = "ragus-" + n;
            n <= "<?= count($detail_ujian); ?>" && ($(".ragus").addClass("hidden"), $("." + e).removeClass("hidden"))
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
    <?php endif; ?>
</script>

<?= $this->endSection(); ?>