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
                        <h5 class=""><?= $materi->nama_materi; ?></h5>
                        <table class="mt-3">
                            <tr>
                                <th>Operator</th>
                                <th> : <?= $guru->nama_guru; ?></th>
                            </tr>
                            <tr>
                                <th>Kelas</th>
                                <th> : <?= $materi->nama_kelas; ?></th>
                            </tr>
                            <tr>
                                <th>Waktu & Tanggal</th>
                                <th> : <?= date('d-M-Y H:i', $materi->date_created); ?></th>
                            </tr>
                        </table>
                        <hr>
                        <p style="white-space: pre-line;"><?= $materi->text_materi; ?></p>
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
                                                        <p style="margin-top: -10px;"><?= ukuran_file('./assets/app-assets/file' . '/' . $f->nama_file); ?></p>
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
                                        <div class="inner-chat-materi">
                                            <button class="btn btn-primary btn-block" type="button" disabled>
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                Loading...
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer" style="background: #fff;">
                                    <input type="hidden" name="kode_materi" value="<?= $materi->kode_materi; ?>">
                                    <textarea class="form-control" name="text" placeholder="Tulis komentar / chat" aria-label="Tulis komentar / chat" rows="1" wrap="hard"></textarea>
                                    <button id="chat_materi" class="btn btn-primary mt-2 d-flex ml-auto" type="button">Kirim</button>
                                </div>
                            </div>
                        </div>
                        <a href="<?= base_url('guru/materi'); ?>" class="btn btn-primary mt-3">Kembali</a>
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

    function get_chat_materi() {
        setInterval(() => {
            var a = $("input[name=kode_materi]").val();
            $.ajax({
                type: "POST",
                data: {
                    kode_materi: a
                },
                url: "<?= base_url('guru/get_chat_materi') ?>",
                success: function(a) {
                    $(".inner-chat-materi").html(a)
                }
            })
        }, 5e3)
    }
    $("#chat_materi").click(function() {
        var a = $("textarea[name=text]").val(),
            t = $("input[name=kode_materi]").val();
        $.ajax({
            type: "POST",
            data: {
                chat_materi: a,
                kode_materi: t
            },
            async: !0,
            url: "<?= base_url('guru/chat_materi') ?>",
            success: function(a) {
                $("textarea[name=text]").val("")
            }
        })
    }), get_chat_materi();
</script>

<?= $this->endSection(); ?>