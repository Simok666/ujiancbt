<?= $this->extend('template/app'); ?>
<?= $this->section('content'); ?>
<?= $this->include('template/sidebar/guru'); ?>

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
                                                        <p style="margin-top: -10px;"><?= ukuran_file('./assets/app-assets/file/' . '/' . $f->nama_file); ?></p>
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
                        <a href="javascript:vod(0)" class="btn btn-primary mt-3" onclick="history.back(-1)">Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row layout-top-spacing">
            <div class="col-lg-12 layout-spacing">
                <div class="widget shadow p-3">
                    <div class="widget-heading">
                        <h5>Tugas Siswa</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-group list-group-media">
                                <li class="list-group-item">Belum Mengumpulkan</li>
                                <?php foreach ($tugas_siswa as $ts) : ?>
                                    <?php if ($ts->date_send == null) : ?>
                                        <li class="list-group-item list-group-item-action">
                                            <div class="media">
                                                <div class="mr-3">
                                                    <img alt="avatar" src="<?= base_url('assets/app-assets/user/') . '/' . $ts->avatar; ?>" class="img-fluid rounded-circle">
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="tx-inverse"><?= $ts->nama_siswa; ?></h6>
                                                    <p class="mg-b-0">belum mengumpulkan</p>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-group list-group-media">
                                <li class="list-group-item">Sudah Mengumpulkan</li>
                                <?php foreach ($tugas_siswa as $ts) : ?>
                                    <?php if ($ts->date_send != null) : ?>
                                        <a href="<?= base_url('guru/tugas_siswa/') . '/' . encrypt_url($ts->tugas) . '/' . encrypt_url($ts->siswa); ?>">
                                            <li class="list-group-item list-group-item-action">
                                                <div class="media">
                                                    <div class="mr-3">
                                                        <img alt="avatar" src="<?= base_url('assets/app-assets/user/') . '/' . $ts->avatar; ?>" class="img-fluid rounded-circle">
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="tx-inverse"><?= $ts->nama_siswa; ?></h6>
                                                        <p class="mg-b-0">
                                                            <?php if ($ts->nilai === null) : ?>
                                                                <?php if ($ts->is_telat == 1) : ?>
                                                                    <span class="text-danger">Terlambat | </span>
                                                                <?php else : ?>
                                                                    <span class="text-success">Sukses | </span>
                                                                <?php endif; ?>
                                                                belum dinilai
                                                            <?php else : ?>
                                                                <?php if ($ts->is_telat == 1) : ?>
                                                                    <span class="text-danger">Terlambat | </span>
                                                                <?php else : ?>
                                                                    <span class="text-success">Sukses | </span>
                                                                <?php endif; ?>
                                                                <?= $ts->nilai; ?>/100
                                                            <?php endif; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-wrapper">
        <div class="footer-section f-section-1">
            <p class="">Copyright © 2021 <a target="_blank" href="http://bit.ly/demo-abdul" class="text-primary">Abduloh Malela</a></p>
        </div>
        <div class="footer-section f-section-2">
            <p class="">CBT-MALELA v2</p>
        </div>
    </div>
</div>
<!--  END CONTENT AREA  -->

<script>
    <?= session()->getFlashdata('pesan'); ?>

    $(document).ready(function() {
        $("#chat_tugas").click(function() {
            var a = $("textarea[name=text]").val(),
                t = $("input[name=kode_tugas]").val();
            $.ajax({
                type: "POST",
                data: {
                    chat_tugas: a,
                    kode_tugas: t
                },
                async: !0,
                url: "<?= base_url('guru/chat_tugas') ?>",
                success: function(a) {
                    $("textarea[name=text]").val("")
                }
            })
        }), setInterval(() => {
            $.ajax({
                type: "POST",
                data: {
                    kode_tugas: "<?= $tugas->kode_tugas; ?>"
                },
                url: "<?= base_url('guru/get_chat_tugas') ?>",
                success: function(a) {
                    $(".inner-chat-tugas").html(a)
                }
            })
        }, 5e3)
    });
</script>

<?= $this->endSection(); ?>