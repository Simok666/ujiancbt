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
                        <div class="col-lg-7">
                            <div class="widget-heading">
                                <h5 class="">Ujian / Quiz</h5>
                                <a href="javascript:void(0)" class="btn btn-primary mt-3" data-toggle="modal" data-target="#tambah_ujian">Tambah</a>
                            </div>
                            <div class="table-responsive" style="overflow-x: scroll;">
                                <table id="datatable-table" class="table text-center text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Kategori</th>
                                            <th>Kelas</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ujian as $u) : ?>
                                            <tr>
                                                <td><?= $u->nama_ujian; ?></td>
                                                <td><?= $u->nama_mapel; ?></td>
                                                <td><?= $u->nama_kelas; ?></td>
                                                <td>
                                                    <div class="dropdown custom-dropdown">
                                                        <a class="dropdown-toggle btn btn-primary" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                                                <line x1="3" y1="18" x2="21" y2="18"></line>
                                                            </svg>
                                                        </a>

                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                            <?php if ($u->jenis_ujian == 1) : ?>
                                                                <a class="dropdown-item" href="<?= base_url('app/lihat_essay/') . '/' . encrypt_url($u->kode_ujian) . '/' . encrypt_url(session()->get('id')); ?>">Lihat</a>
                                                            <?php else : ?>
                                                                <a class="dropdown-item" href="<?= base_url('app/lihat_ujian/') . '/' . encrypt_url($u->kode_ujian) . '/' . encrypt_url(session()->get('id')); ?>">Lihat</a>
                                                            <?php endif; ?>
                                                            <a class="dropdown-item btn-unpublish" href="<?= base_url('app/publish_ujian/') . '/' . encrypt_url($u->kode_ujian) . '/' . encrypt_url(session()->get('id')); ?>"><?= ($u->publish == 1) ? 'Unpublish' : 'Publish' ?></a>
                                                            <a class="dropdown-item btn-hapus" href="<?= base_url('app/hapus_ujian/') . '/' . encrypt_url($u->kode_ujian) . '/' . encrypt_url(session()->get('id')); ?>">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <img src="<?= base_url('assets/app-assets/img/'); ?>/ujian.svg" class="align-middle" style="vertical-align: middle;" alt="">
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

<!-- MODAL -->

<div class="modal fade" id="tambah_ujian" tabindex="-1" role="dialog" aria-labelledby="tambah_ujianLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambah_ujianLabel">Tambah Tugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>
                <div class="modal-body text-center">
                    <a href="<?= base_url('app/tambah_pg'); ?>" class="btn btn-primary">Pilihan Ganda</a>
                    <a href="<?= base_url('app/tambah_essay'); ?>" class="btn btn-primary ml-2">Essay</a>
                </div>
                <div class="modal-footer">
                    <button type="reset" value="reset" class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    <?= session()->getFlashdata('pesan'); ?>
</script>

<?= $this->endSection(); ?>