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
                                <th>Nama</th>
                                <th> : <?= $siswa->nama_siswa; ?></th>
                            </tr>
                            <tr>
                                <th>Waktu Kirim</th>
                                <th> : <?= date('d-M-Y H:i', $tugas_siswa->date_send); ?></th>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <th> :
                                    <?php if ($tugas_siswa->is_telat == 1) : ?>
                                        <span class="text-danger">Terlambat</span>
                                    <?php else : ?>
                                        <span class="text-success">Sukses</span>
                                    <?php endif; ?>
                                </th>
                            </tr>
                        </table>
                        <hr>
                        <p style="white-space: pre-line;"><?= $tugas_siswa->text_siswa; ?></p>
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
                        <form action="<?= base_url('guru/nilai_tugas'); ?>" method="POST">
                            <div class="row">
                                <div class="col-lg mt-2">
                                    <textarea class="form-control" name="catatan_guru" placeholder="Tuliskan Catatan Untuk Siswa (Oposional)" rows="3"></textarea>
                                </div>
                                <div class="col-lg mt-2">
                                    <input type="hidden" name="tugas" value="<?= $tugas_siswa->tugas; ?>">
                                    <input type="hidden" name="siswa" value="<?= $tugas_siswa->siswa; ?>">
                                    <input type="number" class="form-control" name="nilai" placeholder="masukkan nilai" aria-label="masukkan nilai">
                                    <button type="submit" class="btn btn-primary d-flex ml-auto mt-2" type="button">Kirim</button>
                                </div>
                            </div>
                        </form>
                        <a href="javascript:void(0)" class="btn btn-primary mt-3" onclick="history.back(-1)">Kembali</a>
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
</script>

<?= $this->endSection(); ?>