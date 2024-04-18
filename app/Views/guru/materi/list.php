<?= $this->extend('template/app'); ?>
<?= $this->section('content'); ?>
<?= $this->include('template/sidebar/guru'); ?>

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 layout-spacing">
                <div class="widget shadow p-3">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="widget-heading">
                                <h5 class="">Materi</h5>
                                <a href="javascript:void(0)" class="btn btn-primary mt-3" data-toggle="modal" data-target="#tambah_materi">Tambah Materi</a>
                            </div>
                            <div class="table-responsive">
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
                                        <?php foreach ($materi as $m) : ?>
                                            <tr>
                                                <td><?= $m->nama_materi; ?></td>
                                                <td>
                                                    <?= $m->nama_mapel; ?>
                                                </td>
                                                <td>
                                                    <?= $m->nama_kelas; ?>
                                                </td>
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
                                                            <a class="dropdown-item" href="<?= base_url('guru/lihat_materi/') . '/' . encrypt_url($m->id_materi) . '/' . encrypt_url(session()->get('id')); ?>">Lihat</a>
                                                            <a class="dropdown-item edit_materi" href="javascript:void(0);" data-materi="<?= encrypt_url($m->id_materi); ?>" data-toggle="modal" data-target="#edit_materi">Edit</a>
                                                            <a class="dropdown-item btn-hapus" href="<?= base_url('guru/hapus_materi/') . '/' . encrypt_url($m->kode_materi) . '/' . encrypt_url(session()->get('id')); ?>">Delete</a>
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

<!-- MODAL -->
<!-- Modal Tambah -->
<div class="modal fade" id="tambah_materi" tabindex="-1" role="dialog" aria-labelledby="tambah_materiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= base_url('guru/tambah_materi'); ?>" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambah_materiLabel">Tambah materi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="kode_materi" value="<?= random_string('alnum', 8); ?>" class="form-control" required>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Nama Materi</label>
                                <input type="text" name="nama_materi" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Kategori</label>
                                <select class="form-control" name="mapel" id="mapel_materi">
                                    <option value="">Pilih</option>
                                    <?php foreach ($guru_mapel as $gm) : ?>
                                        <option value="<?= $gm->id_mapel; ?>"><?= $gm->nama_mapel; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select class="form-control" name="kelas" id="mapel_materi">
                                    <option value="">Pilih</option>
                                    <?php foreach ($guru_kelas as $gk) : ?>
                                        <option value="<?= $gk->id_kelas; ?>"><?= $gk->nama_kelas; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Text</label>
                        <textarea class="form-control summernote" name="text_materi" id="text_materi" cols="30" rows="5" wrap="hard"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="custom-file-container" data-upload-id="fileMateri">
                                <label>Upload File <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                <label class="custom-file-container__custom-file file_materi">
                                    <input type="file" class="custom-file-container__custom-file__custom-file-input" name="file_materi[]" multiple>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                </label>
                                <div class="custom-file-container__image-preview"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="custom-file-container" data-upload-id="videoMateri">
                                <label>Upload Video <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                <label class="custom-file-container__custom-file file_materi">
                                    <input type="file" class="custom-file-container__custom-file__custom-file-input" name="video_materi[]" multiple>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                </label>
                                <div class="custom-file-container__image-preview"></div>
                            </div>
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

<!-- Modal edit -->
<div class="modal fade" id="edit_materi" tabindex="-1" role="dialog" aria-labelledby="edit_materiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= base_url('guru/edit_materi_'); ?>" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_materiLabel">Edit materi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="e_kode_materi" class="form-control" required>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Nama Materi</label>
                                <input type="text" name="e_nama_materi" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Kategori</label>
                                <select class="form-control" name="e_mapel" id="e_mapel">
                                    <option value="">Pilih</option>
                                    <?php foreach ($guru_mapel as $gm) : ?>
                                        <option value="<?= $gm->id_mapel; ?>"><?= $gm->nama_mapel; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select class="form-control" name="e_kelas" id="e_mape">
                                    <option value="">Pilih</option>
                                    <?php foreach ($guru_kelas as $gk) : ?>
                                        <option value="<?= $gk->id_kelas; ?>"><?= $gk->nama_kelas; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Text</label>
                        <textarea class="form-control summernote" name="e_text_materi" id="e_text_materi" cols="30" rows="5" wrap="hard">
                            <div class="isi-teks-materi"></div>
                        </textarea>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="custom-file-container" data-upload-id="e_fileMateri">
                                <label>Upload File <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                <label class="custom-file-container__custom-file file_materi">
                                    <input type="file" class="custom-file-container__custom-file__custom-file-input" name="e_file_materi[]" multiple>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                </label>
                                <div class="custom-file-container__image-preview"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="custom-file-container" data-upload-id="e_videoMateri">
                                <label>Upload Video <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                <label class="custom-file-container__custom-file file_materi">
                                    <input type="file" class="custom-file-container__custom-file__custom-file-input" name="e_video_materi[]" multiple>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                </label>
                                <div class="custom-file-container__image-preview"></div>
                            </div>
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

<script>
    <?= session()->getFlashdata('pesan'); ?>

    $(document).ready(function() {

        function uploadImage(e, a) {
            var o = new FormData;
            o.append("image", e), $.ajax({
                url: "<?= base_url('guru/upload_summernote') ?>",
                cache: !1,
                contentType: !1,
                processData: !1,
                data: o,
                type: "POST",
                success: function(e) {
                    $(a).summernote("insertImage", e)
                },
                error: function(e) {
                    console.log(e)
                }
            })
        }

        function deleteImage(e) {
            $.ajax({
                data: {
                    src: e
                },
                type: "POST",
                url: "<?= base_url('guru/delete_image') ?>",
                cache: !1,
                success: function(e) {
                    console.log(e)
                }
            })
        }
        $(".summernote").summernote({
            placeholder: "Hello stand alone ui",
            tabsize: 2,
            height: 120,
            toolbar: [
                ["style", ["style"]],
                ["font", ["bold", "underline", "clear"]],
                ["color", ["color"]],
                ["para", ["ul", "ol", "paragraph"]],
                ["table", ["table"]],
                ["insert", ["link", "picture", "video"]],
                ["view", ["fullscreen", "help"]]
            ],
            callbacks: {
                onImageUpload: function(e, a = this) {
                    uploadImage(e[0], a)
                },
                onMediaDelete: function(e) {
                    deleteImage(e[0].src)
                }
            }
        });
        // MATERI
        $('.file_materi').click(function() {
            swal({
                title: 'Perhatian!',
                text: 'pastikan anda sudah mengatur maksimal upload di php.ini',
                type: 'warning',
                padding: '2em'
            })
        });
        $(".edit_materi").click(function() {
            var e = $(this).data("materi");
            $.ajax({
                type: "POST",
                data: {
                    id_materi: e
                },
                dataType: "JSON",
                async: !0,
                url: "<?= base_url('guru/edit_materi') ?>",
                success: function(d) {
                    $.each(d, function(e, a, i, t, l, n, r) {
                        $("input[name=e_kode_materi]").val(d.kode_materi), $("input[name=e_nama_materi]").val(d.nama_materi), $("select[name=e_mapel]").val(d.mapel), $("select[name=e_kelas]").val(d.kelas), $(".isi-teks-materi").html(d.text_materi)
                    })
                }
            })
        });
        var oneUpload = new FileUploadWithPreview("fileMateri"),
            secondUpload = new FileUploadWithPreview("videoMateri"),
            oneUpload = new FileUploadWithPreview("e_fileMateri"),
            secondUpload = new FileUploadWithPreview("e_videoMateri");
    })
</script>

<?= $this->endSection(); ?>