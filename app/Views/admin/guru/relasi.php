<?= $this->extend('template/app'); ?>
<?= $this->section('content'); ?>
<?= $this->include('template/sidebar/admin'); ?>

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">
            <div class="col-lg-6 layout-spacing">
                <div class="widget shadow p-3">
                    <div class="widget-heading text-center">
                        <h5 class="text-center">Relasi Operator - Kelas</h5>
                        <form action="" method="POST">
                            <table class="table table-bordered mt-2">
                                <thead>
                                    <tr>
                                        <th>Kelas</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($kelas as $kel) :  ?>
                                        <tr>
                                            <td><?= $kel->nama_kelas; ?></td>
                                            <td>
                                                <label class="new-control new-checkbox checkbox-primary">
                                                    <input type="checkbox" class="new-control-input check-kelas" <?= check_kelas(encrypt_url($guru->id_guru), $kel->id_kelas); ?> data-id_guru="<?= encrypt_url($guru->id_guru); ?>" data-id_kelas="<?= $kel->id_kelas; ?>">
                                                    <span class="new-control-indicator"></span> Mengajar
                                                </label>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="widget shadow p-3">
                    <div class="widget-heading text-center">
                        <h5 class="text-center">Relasi Operator - Kategori</h5>
                        <form action="" method="POST">
                            <table class="table table-bordered mt-2">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($mapel as $m) :  ?>
                                        <tr>
                                            <td><?= $m->nama_mapel; ?></td>
                                            <td>
                                                <label class="new-control new-checkbox checkbox-primary">
                                                    <input type="checkbox" class="new-control-input check-mapel" <?= check_mapel(encrypt_url($guru->id_guru), $m->id_mapel); ?> data-id_guru="<?= encrypt_url($guru->id_guru); ?>" data-id_mapel="<?= $m->id_mapel; ?>">
                                                    <span class="new-control-indicator"></span> Mengajar
                                                </label>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </form>
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

    $(document).ready(function() {
        // CHECK GURU KELAS
        $('.check-kelas').on('click', function() {
            const id_guru = $(this).data('id_guru');
            const id_kelas = $(this).data('id_kelas');

            $.ajax({
                type: 'post',
                data: {
                    id_guru: id_guru,
                    id_kelas: id_kelas
                },
                async: true,
                url: "<?= base_url('app/guru_kelas') ?>",
                success: function() {
                    location.reload();
                }
            });
        });
        // END CHECK GURU KELAS

        // CHECK GURU MAPEL
        $('.check-mapel').on('click', function() {
            const id_guru = $(this).data('id_guru');
            const id_mapel = $(this).data('id_mapel');

            $.ajax({
                type: 'post',
                data: {
                    id_guru: id_guru,
                    id_mapel: id_mapel
                },
                async: true,
                url: "<?= base_url('app/guru_mapel') ?>",
                success: function() {
                    location.reload();
                }
            });
        });
        // END CHECK GURU MAPEL
    });
</script>

<?= $this->endSection(); ?>