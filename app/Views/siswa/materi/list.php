<?= $this->extend('template/app'); ?>
<?= $this->section('content'); ?>
<?= $this->include('template/sidebar/siswa'); ?>

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 layout-spacing">
                <div class="widget shadow p-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="widget-heading">
                                <h5 class="">Materi</h5>
                            </div>
                            <div class="table-responsive" style="overflow-x: scroll;">
                                <table id="datatable-table" class="table text-center text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Kategori</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($materi as $m) : ?>
                                            <tr>
                                                <td><?= $m->nama_materi; ?></td>
                                                <td><?= $m->nama_mapel; ?></td>
                                                <td>
                                                    <a href="<?= base_url('siswa/lihat_materi/') . '/' . encrypt_url($m->kode_materi); ?>" class="btn btn-primary">Lihat</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <img src="<?= base_url('assets/app-assets/img/'); ?>/materi.svg" class="align-middle" alt="">
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
<script>
    <?= session()->getFlashdata('pesan'); ?>
</script>

<?= $this->endSection(); ?>