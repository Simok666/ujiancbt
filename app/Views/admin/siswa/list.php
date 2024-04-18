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
                        <div class="col-lg-12">
                            <div class="widget-heading">
                                <h5 class="">Peserta</h5>
                                <a href="javascript:void(0)" class="btn btn-primary mt-3" data-toggle="modal" data-target="#tambah_siswa">Tambah Peserta</a>
                                <!-- <a href="javascript:void(0)" class="btn btn-primary mt-3 ml-2" data-toggle="modal" data-target="#import_siswa">Import Exel</a> -->
                            </div>
                            <div class="table-responsive">
                                <table id="datatable-table" class="table text-center text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No Key</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Kelas</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($siswa as $s) : ?>
                                            <tr>
                                                <td><?= $s->no_induk_siswa; ?></td>
                                                <td><?= $s->nama_siswa; ?></td>
                                                <td><?= $s->email; ?></td>
                                                <td><?= $s->nama_kelas; ?></td>
                                                <td>
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#edit_siswa" data-siswa="<?= encrypt_url($s->id_siswa); ?>" class="btn btn-primary edit-siswa">
                                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                                        </svg>
                                                    </a>
                                                    <a href="<?= base_url('app/hapus_siswa/') . '/' . encrypt_url($s->id_siswa); ?>" class="btn btn-danger btn-hapus">
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
<div class="modal fade" id="tambah_siswa" tabindex="-1" role="dialog" aria-labelledby="tambah_siswaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= base_url('app/tambah_siswa'); ?>" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambah_siswaLabel">Tambah Peserta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>
                <div class="modal-body">
                    <a href="javascript:void(0)" class="btn btn-success mb-3 tambah-baris-siswa">tambah baris</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No Key</th>
                                <th>Nama</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Kelas</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-siswa">
                            <tr>
                                <td><input type="text" name="nis[]" required style="border: none; background: transparent; width: 100%; height: 100%;"></td>
                                <td><input type="text" name="nama_siswa[]" required style="border: none; background: transparent; width: 100%; height: 100%;"></td>
                                <td>
                                    <select name="jenis_kelamin[]" required style="border: none; background: transparent; width: 100%; height: 100%;">
                                        <option value="">pilih</option>
                                        <option value="Laki - Laki">Laki - Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </td>
                                <td><input type="text" name="email[]" required style="border: none; background: transparent; width: 100%; height: 100%;"></td>
                                <td>
                                    <select name="kelas[]" required style="border: none; background: transparent; width: 100%; height: 100%;">
                                        <option value="">pilih</option>
                                        <?php foreach ($kelas as $kel) : ?>
                                            <option value="<?= $kel->id_kelas; ?>"><?= $kel->nama_kelas; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
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
<div class="modal fade" id="edit_siswa" tabindex="-1" role="dialog" aria-labelledby="edit_siswaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('app/edit_siswa_'); ?>" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_siswaLabel">Edit Peserta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama peserta</label>
                        <input type="hidden" name="id_siswa" id="id_siswa" class="form-control">
                        <input type="text" name="nama_siswa" id="nama_siswa" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control">
                            <option value="">pilih</option>
                            <?php foreach ($kelas as $kel) : ?>
                                <option value="<?= $kel->id_kelas; ?>"><?= $kel->nama_kelas; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Active</label>
                        <select name="active" id="active" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Status Member</label>
                        <select name="status_member" id="status_member" class="form-control">
                            <option value="1">On</option>
                            <option value="0">Off</option>
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

<!-- Modal IMport -->
<div class="modal fade" id="import_siswa" tabindex="-1" role="dialog" aria-labelledby="import_siswaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('app/import_siswa'); ?>" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="import_siswaLabel">Import Siswa Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Download Template</label>
                        <br>
                        <a href="<?= base_url('download/template_excel'); ?>" class="btn btn-primary">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                <polyline points="8 17 12 21 16 17"></polyline>
                                <line x1="12" y1="12" x2="12" y2="21"></line>
                                <path d="M20.88 18.09A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.29"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="form-group">
                        <label for="">File Excel</label>
                        <div class="custom-file mb-4">
                            <input type="file" name="file_excel" class="custom-file-input" id="customFile" accept=".xls, .xlsx, .csv">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
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
<!-- END MODAL -->

<script>
    <?= session()->getFlashdata('pesan'); ?>

    $(document).ready(function() {
        // SISWA
        $('.tambah-baris-siswa').click(function() {
            const siswa = `
            <tr>
                <td><input type="text" name="nis[]" required style="border: none; background: transparent; width: 100%; height: 100%;"></td>
                <td><input type="text" name="nama_siswa[]" required style="border: none; background: transparent; width: 100%; height: 100%;"></td>
                <td>
                    <select name="jenis_kelamin[]" required style="border: none; background: transparent; width: 100%; height: 100%;">
                        <option value="">pilih</option>
                        <option value="Laki - Laki">Laki - Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </td>
                <td><input type="text" name="email[]" required style="border: none; background: transparent; width: 100%; height: 100%;"></td>
                <td>
                    <select name="kelas[]" required style="border: none; background: transparent; width: 100%; height: 100%;">
                        <option value="">pilih</option>
                        <?php foreach ($kelas as $kel) : ?>
                            <option value="<?= $kel->id_kelas; ?>"><?= $kel->nama_kelas; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <button class="btn btn-danger">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                    </button>
                </td>
            </tr>
           `;

            $('#tbody-siswa').append(siswa)
        });

        $('#tbody-siswa').on('click', 'tr td button', function() {
            $(this).parents('tr').remove();
        });

        $('.edit-siswa').click(function() {
            const id_siswa = $(this).data('siswa');
            $.ajax({
                type: 'POST',
                data: {
                    id_siswa: id_siswa
                },
                dataType: 'JSON',
                async: true,
                url: "<?= base_url('app/edit_siswa') ?>",
                success: function(data) {
                    $.each(data, function(id_siswa, nama_siswa, email, kelas, is_active, status_member) {
                        $("#id_siswa").val(data.id_siswa);
                        $("#nama_siswa").val(data.nama_siswa);
                        $("#email").val(data.email);
                        $("#kelas").val(data.kelas);
                        $("#active").val(data.is_active);
                        $("#status_member").val(data.status_member);
                    });
                }
            });
        });
        // END SISWA
    })
</script>

<?= $this->endSection(); ?>