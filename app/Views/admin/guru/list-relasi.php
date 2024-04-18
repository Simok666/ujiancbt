<?= $this->extend('template/app'); ?>
<?= $this->section('content'); ?>
<?= $this->include('template/sidebar/admin'); ?>

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 layout-spacing">
                <div class="widget shadow p-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="widget-heading text-center">
                                <h5 class="text-center">Relasi Operator</h5>
                                <form action="<?= base_url('guru_kelas'); ?>" method="POST">
                                    <table class="table table-bordered mt-2">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($guru as $g) :  ?>
                                                <tr>
                                                    <td><?= $g->nama_guru; ?></td>
                                                    <td>
                                                        <a href="<?= base_url('app/atur_relasi/') . '/' . encrypt_url($g->id_guru); ?>" class="btn btn-primary">Relasikan</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <img src="<?= base_url('assets/app-assets/img/'); ?>/relation.svg" class="align-middle" alt="">
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

<?= $this->endSection(); ?>