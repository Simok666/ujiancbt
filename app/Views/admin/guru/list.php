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
                                <h5 class="">Operator</h5>
                                <a href="javascript:void(0)" class="btn btn-primary mt-3" data-toggle="modal" data-target="#tambah_guru">Tambah Operator</a>
                                <!-- <a href="javascript:void(0)" class="btn btn-primary mt-3 ml-2" data-toggle="modal" data-target="#import_guru">Import Exel</a> -->
                            </div>
                            <div class="table-responsive" style="overflow-x: scroll;">
                                <table id="datatable-table" class="table text-center text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($guru as $g) : ?>
                                            <tr>
                                                <td><?= $g->nama_guru; ?></td>
                                                <td><?= $g->email; ?></td>
                                                <td>
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#edit_guru" data-guru="<?= encrypt_url($g->id_guru); ?>" class="btn btn-primary edit-guru">
                                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                                        </svg>
                                                    </a>
                                                    <a href="<?= base_url('app/hapus_guru/') . '/' . encrypt_url($g->id_guru); ?>" class="btn btn-danger btn-hapus">
                                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <line x1="15" y1="9" x2="9" y2="15"></line>
                                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <img src="<?= base_url('assets/app-assets/img/'); ?>/teacher.svg" class="align-middle" alt="">
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
<!-- Modal Tambah -->
<div class="modal fade" id="tambah_guru" tabindex="-1" role="dialog" aria-labelledby="tambah_guruLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= base_url('app/tambah_guru'); ?>" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambah_guruLabel">Tambah operator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>
                <div class="modal-body">
                    <a href="javascript:void(0)" class="btn btn-success mb-3 tambah-baris-guru">tambah baris</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-guru">
                            <tr>
                                <td><input type="text" name="nama_guru[]" required style="border: none; background: transparent; width: 100%; height: 100%;"></td>
                                <td><input type="text" name="email[]" required style="border: none; background: transparent; width: 100%; height: 100%;"></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="reset" value="reset" class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal edit -->
<div class="modal fade" id="edit_guru" tabindex="-1" role="dialog" aria-labelledby="edit_guruLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('app/edit_guru_'); ?>" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_guruLabel">Edit operator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama operator</label>
                        <input type="hidden" name="id_guru" id="id_guru" class="form-control">
                        <input type="text" name="nama_guru" id="nama_guru" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Active</label>
                        <select name="active" id="active" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
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


<script>
    <?= session()->getFlashdata('pesan'); ?>

    $(document).ready(function() {
        // GURU
        $('.tambah-baris-guru').click(function() {
            const guru = `
            <tr>
                <td><input type="text" name="nama_guru[]" required style="border: none; background: transparent; width: 100%; height: 100%;"></td>
                <td><input type="text" name="email[]" required style="border: none; background: transparent; width: 100%; height: 100%;"></td>
                <td>
                    <button class="btn btn-danger">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                    </button>
                </td>
            </tr>
           `;

            $('#tbody-guru').append(guru)
        });

        $('#tbody-guru').on('click', 'tr td button', function() {
            $(this).parents('tr').remove();
        });

        $('.edit-guru').click(function() {
            const id_guru = $(this).data('guru');
            $.ajax({
                type: 'POST',
                data: {
                    id_guru: id_guru
                },
                dataType: 'JSON',
                async: true,
                url: "<?= base_url('app/edit_guru') ?>",
                success: function(data) {
                    $.each(data, function(id_guru, nama_guru, email, is_active) {
                        $("#id_guru").val(data.id_guru);
                        $("#nama_guru").val(data.nama_guru);
                        $("#email").val(data.email);
                        $("#active").val(data.is_active);
                    });
                }
            });
        });
        // END GURU
    })
</script>

<?= $this->endSection(); ?>