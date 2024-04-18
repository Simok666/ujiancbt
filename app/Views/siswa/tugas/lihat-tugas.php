<?= $this->extend('template/app'); ?>
<?= $this->section('content'); ?>
<?= $this->include('template/sidebar/siswa'); ?>

<?php

use APP\Models\FileModel;

$filemodel = new FileModel();

?>

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 layout-spacing">
                <div class="widget shadow p-3">
                    <div class="widget-heading">
                        <h5 class=""><?= $tugas->nama_tugas; ?></h5>
                        <table class="mt-3">
                            <tr>
                                <th>Guru</th>
                                <th> : <?= $guru->nama_guru; ?></th>
                            </tr>
                            <tr>
                                <th>Kelas</th>
                                <th> : <?= $tugas->nama_kelas; ?></th>
                            </tr>
                            <tr>
                                <th>Waktu & Tanggal</th>
                                <th> : <?= date('d-M-Y H:i', $tugas->date_created); ?></th>
                            </tr>
                            <tr>
                                <th>Due Date</th>
                                <th> : <?= $tugas->due_date; ?></th>
                            </tr>
                        </table>
                        <hr>
                        <p style="white-space: pre-line;"><?= $tugas->deskripsi; ?></p>
                        <hr>
                        <?php if ($file != null) : ?>
                            <div class="row">
                                <?php foreach ($file as $f) : ?>
                                    <div class="col-lg-3 mt-2">
                                        <a href="<?= base_url('download/file/') . '/' . $f->nama_file; ?>">
                                            <div class="card component-card_4">
                                                <div class="card-body" style="padding: 2px;">
                                                    <div class="text-center">
                                                        <?php
                                                        $berkas = base_url('assets/app-assets/file/') . '/' . $f->nama_file;
                                                        $ekstensi = pathinfo($berkas, PATHINFO_EXTENSION);
                                                        if ($ekstensi == 'jpg' || $ekstensi == 'JPG' || $ekstensi == 'jpeg' || $ekstensi == 'JPEG' || $ekstensi == 'png' || $ekstensi == 'PNG') : ?>
                                                            <img src="<?= base_url('assets/app-assets/file/') . '/' . $f->nama_file; ?>" style="height: 100px;">
                                                        <?php elseif ($ekstensi == 'mp4' || $ekstensi == '3gp' || $ekstensi == 'mov' || $ekstensi == 'wmp') : ?>
                                                            <video src="<?= base_url('assets/app-assets/file/') . '/' . $f->nama_file; ?>" style="height: 100px;"></video>
                                                        <?php else : ?>
                                                            <img src=" <?= base_url('assets/app-assets/img/'); ?>/file.png" style="height: 100px;">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="text-center">
                                                        <p><?= $ekstensi; ?></p>
                                                        <p style="margin-top: -10px;"><?= ukuran_file('./assets/app-assets/file/' . $f->nama_file); ?></p>
                                                        <p style="margin-top: -10px;"><?= $f->nama_file; ?> </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <hr>
                        <?php endif; ?>
                        <div id="toggleAccordion">
                            <div class="card">
                                <div class="card-header" id="...">
                                    <section class="mb-0 mt-0">
                                        <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionOne" aria-expanded="true" aria-controls="defaultAccordionOne">
                                            Lihat Chat <div class="icons"><svg> ... </svg></div>
                                        </div>
                                    </section>
                                </div>

                                <div id="defaultAccordionOne" class="collapse" aria-labelledby="..." data-parent="#toggleAccordion">
                                    <div class="card-body" style="height: 250px; overflow-y: scroll;">
                                        <div class="inner-chat-tugas">
                                            <button class="btn btn-primary btn-block" type="button" disabled>
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                Loading...
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer" style="background: #fff;">
                                    <input type="hidden" name="kode_tugas" value="<?= $tugas->kode_tugas; ?>">
                                    <textarea class="form-control" name="text" placeholder="Tulis komentar / chat" aria-label="Tulis komentar / chat" rows="1" wrap="hard"></textarea>
                                    <button id="chat_tugas" class="btn btn-primary d-flex ml-auto mt-2" type="button">Kirim</button>
                                </div>
                            </div>
                        </div>
                        <a href="<?= base_url('siswa/tugas'); ?>" class="btn btn-primary mt-3">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row layout-top-spacing">
            <div class="col-lg-4 layout-spacing">
                <div class="widget shadow p-3">
                    <div class="widget-heading">
                        <h5>Tugas Saya</h5>
                    </div>
                    <?php if (!empty($tugas_siswa)) : ?>
                        <?php if ($tugas_siswa->date_send == null) : ?>
                            <p>Tugas Belum Dikerjakan. Segera dikerjakan sebelum <?= $tugas->due_date; ?></p>
                            <a href="javasript:void(0)" class="btn btn-primary btn-kerjakan" data-tugas="<?= encrypt_url($tugas->kode_tugas); ?>" data-siswa="<?= encrypt_url(session()->get('id')); ?>" data-toggle="modal" data-target="#kerjakan_tugas">Kerjakan</a>
                        <?php else : ?>
                            <table cellpadding="5">
                                <tr>
                                    <th>Status</th>
                                    <td>:
                                        <?php if ($tugas_siswa->is_telat == 1) : ?>
                                            <span class="badge badge-danger">Terlambat</span>
                                        <?php else : ?>
                                            <span class="badge badge-success">Sukses</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nilai</th>
                                    <td>:
                                        <?php if ($tugas_siswa->nilai === null) : ?>
                                            Belum dinilai
                                        <?php else : ?>
                                            <span class="text-primary"><?= $tugas_siswa->nilai; ?>/100 Point </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                            <table class="mt-2">
                                <tr>
                                    <th>Catatan Guru</th>
                                </tr>
                            </table>
                            <?php if (!$tugas_siswa->catatan_guru) : ?>
                                <p>Tidak ada</p>
                            <?php else : ?>
                                <p><?= $tugas_siswa->catatan_guru; ?></p>
                            <?php endif; ?>
                            <?php if ($tugas_siswa->nilai == null) : ?>
                                <a href="javasript:void(0)" class="btn btn-primary mt-3 btn-kerjakan" data-tugas="<?= encrypt_url($tugas->id_tugas); ?>" data-siswa="<?= encrypt_url(session()->get('id')); ?>" data-toggle="modal" data-target="#kerjakan_tugas">Edit</a>
                            <?php endif; ?>
                            <a href="javasript:void(0)" class="btn btn-primary mt-3 btn-kerjakan ml-2" data-tugas="<?= encrypt_url($tugas->id_tugas); ?>" data-siswa="<?= encrypt_url(session()->get('id')); ?>" data-toggle="modal" data-target="#lihat_tugas">Lihat</a>
                        <?php endif; ?>
                    <?php else : ?>
                        <p>Anda tidak bisa mengerjakan tugas ini dikarenakan akun anda terdaftar setelah tugas ini dibuat.</p>
                    <?php endif; ?>
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

<?php if ($tugas_siswa != null) : ?>
    <!-- MODAL -->
    <!-- Modal Kerjakan Tugas -->
    <div class="modal fade" id="kerjakan_tugas" tabindex="-1" role="dialog" aria-labelledby="kerjakan_tugasLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="<?= base_url('siswa/kumpulkan'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="kerjakan_tugasLabel">Tugas Saya</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            x
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="kode_tugas" value="<?= $tugas_siswa->tugas; ?>" class="form-control" required>
                        <input type="hidden" name="id_siswa" value="<?= $tugas_siswa->siswa; ?>" class="form-control" required>
                        <div class="form-group">
                            <label for="">Text</label>
                            <textarea class="form-control" name="text_siswa" id="text_siswa" cols="30" rows="5" wrap="hard"><?= $tugas_siswa->text_siswa; ?></textarea>
                        </div>
                        <div class="custom-file-container" data-upload-id="fileMateri">
                            <label>Upload File <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                            <label class="custom-file-container__custom-file file_materi">
                                <input type="file" class="custom-file-container__custom-file__custom-file-input" name="file_siswa[]" multiple>
                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                            </label>
                            <div class="custom-file-container__image-preview"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" value="reset" class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal lihat Tugas -->
    <div class="modal fade" id="lihat_tugas" tabindex="-1" role="dialog" aria-labelledby="lihat_tugasLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lihat_tugasLabel">Jawaban Saya</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>
                <div class="modal-body">
                    <p style="white-space: pre-line;">
                        <?= $tugas_siswa->text_siswa; ?>
                    </p>
                    <?php if ($tugas_siswa->file_siswa !== null) : ?>
                        <div class="row">
                            <?php $file_siswa = $filemodel->getAllByKode($tugas_siswa->file_siswa); ?>
                            <?php foreach ($file_siswa as $fs) : ?>
                                <div class="col-lg-3 mt-2">
                                    <a href="<?= base_url('download/file/') . '/' . $fs->nama_file; ?>">
                                        <div class="card component-card_4">
                                            <div class="card-body" style="padding: 2px;">
                                                <div class="text-center">
                                                    <?php
                                                    $berkas = base_url('assets/app-assets/file/') . '/' . $fs->nama_file;
                                                    $ekstensi = pathinfo($berkas, PATHINFO_EXTENSION);
                                                    if ($ekstensi == 'jpg' || $ekstensi == 'JPG' || $ekstensi == 'jpeg' || $ekstensi == 'JPEG' || $ekstensi == 'png' || $ekstensi == 'PNG') : ?>
                                                        <img src="<?= base_url('assets/app-assets/file/') . '/' . $fs->nama_file; ?>" style="height: 90px;">
                                                    <?php elseif ($ekstensi == 'mp4' || $ekstensi == '3gp' || $ekstensi == 'mov' || $ekstensi == 'wmp') : ?>
                                                        <video src="<?= base_url('assets/app-assets/file/') . '/' . $fs->nama_file; ?>" style="height: 90px;"></video>
                                                    <?php else : ?>
                                                        <img src=" <?= base_url('assets/app-assets/img/'); ?>/file.png" style="height: 90px;">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="text-center">
                                                    <p><?= $ekstensi; ?></p>
                                                    <p style="margin-top: -10px;"><?= ukuran_file('./assets/app-assets/file/' . $fs->nama_file); ?></p>
                                                    <p style="margin-top: -10px;"><?= $fs->nama_file; ?> </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="reset" value="reset" class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                </div>
            </div>

        </div>
    </div>
<?php endif; ?>
<script>
    <?= session()->getFlashdata('pesan'); ?>

    $(document).ready(function() {
        $("#chat_tugas").click(function() {
            var e = $("textarea[name=text]").val(),
                a = $("input[name=kode_tugas]").val();
            $.ajax({
                type: "POST",
                data: {
                    chat_tugas: e,
                    kode_tugas: a
                },
                async: !0,
                url: "<?= base_url('siswa/chat_tugas') ?>",
                success: function(e) {
                    $("textarea[name=text]").val("")
                }
            })
        }), setInterval(() => {
            var e = $("input[name=kode_tugas]").val();
            $.ajax({
                type: "POST",
                data: {
                    kode_tugas: e
                },
                url: "<?= base_url('siswa/get_chat_tugas') ?>",
                success: function(e) {
                    $(".inner-chat-tugas").html(e)
                }
            })
        }, 5e3);
        new FileUploadWithPreview("fileMateri"), new FileUploadWithPreview("videoMateri"), new FileUploadWithPreview("e_fileMateri"), new FileUploadWithPreview("e_videoMateri")
    });
</script>


<?= $this->endSection(); ?>