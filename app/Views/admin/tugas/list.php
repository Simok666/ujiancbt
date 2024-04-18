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
                                <h5 class="">Tugas</h5>
                                <a href="javascript:void(0)" class="btn btn-primary mt-3" data-toggle="modal" data-target="#tambah_tugas">Tambah Tugas</a>
                            </div>
                            <div class="table-responsive" style="overflow-x: scroll;">
                                <table id="datatable-table" class="table text-center text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Mapel</th>
                                            <th>Kelas</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tugas as $t) : ?>
                                            <tr>
                                                <td><?= $t->nama_tugas; ?></td>
                                                <td>
                                                    <?= $t->nama_mapel; ?>
                                                </td>
                                                <td>
                                                    <?= $t->nama_kelas; ?>
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
                                                            <a class="dropdown-item" href="<?= base_url('guru/lihat_tugas/') . '/' . encrypt_url($t->kode_tugas) . '/' . encrypt_url(session()->get('id')); ?>">Lihat</a>
                                                            <a class="dropdown-item btn_edit_tugas" href="javascript:void(0);" data-tugas="<?= encrypt_url($t->id_tugas); ?>" data-toggle="modal" data-target="#edit_tugas">Edit</a>
                                                            <a class="dropdown-item btn-hapus" href="<?= base_url('guru/hapus_tugas/') . '/' . encrypt_url($t->kode_tugas) . '/' . encrypt_url(session()->get('id')); ?>">Delete</a>
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
                            <img src="<?= base_url('assets/app-assets/img/'); ?>/tugas.svg" class="align-middle" style="vertical-align: middle;" alt="">
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

<!-- MODAL -->
<!-- Modal Tambah -->
<div class="modal fade" id="tambah_tugas" tabindex="-1" role="dialog" aria-labelledby="tambah_tugasLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= base_url('guru/tambah_tugas'); ?>" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambah_tugasLabel">Tambah Tugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="kode_tugas" value="<?= random_string('alnum', 8); ?>" class="form-control" required>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Nama Tugas</label>
                                <input type="text" name="nama_tugas" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Mapel</label>
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
                        <textarea class="form-control summernote" name="deskripsi" id="deskripsi" cols="30" rows="5" wrap="hard"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Due Date</label>
                        <div class="row">
                            <div class="col-lg-6"><input type="date" class="form-control" name="tgl"></div>
                            <div class="col-lg-6"><input type="time" class="form-control" name="jam"></div>
                        </div>
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
<!-- Modal Edit -->
<div class="modal fade" id="edit_tugas" tabindex="-1" role="dialog" aria-labelledby="edit_tugasLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= base_url('guru/edit_tugas_'); ?>" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_tugasLabel">Edit Tugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Nama Tugas</label>
                                <input type="hidden" name="e_kode_tugas" class="form-control" required>
                                <input type="text" name="e_nama_tugas" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Mapel</label>
                                <select class="form-control" name="e_mapel" id="mapel_materi">
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
                                <select class="form-control" name="e_kelas" id="mapel_materi">
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
                        <textarea class="form-control summernote" name="e_deskripsi" id="deskripsi" cols="30" rows="5" wrap="hard">
                            <div class="isi-teks-tugas"></div>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Due Date</label>
                        <div class="row">
                            <div class="col-lg-6"><input type="date" class="form-control" name="e_tgl"></div>
                            <div class="col-lg-6"><input type="time" class="form-control" name="e_jam"></div>
                        </div>
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
                    var t;
                    e = e[0], t = a, (a = new FormData).append("image", e), $.ajax({
                        url: "<?= base_url('guru/upload_summernote') ?>",
                        cache: !1,
                        contentType: !1,
                        processData: !1,
                        data: a,
                        type: "POST",
                        success: function(e) {
                            $(t).summernote("insertImage", e)
                        },
                        error: function(e) {
                            console.log(e)
                        }
                    })
                },
                onMediaDelete: function(e) {
                    e = e[0].src, $.ajax({
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
            }
        }), $("#chat_tugas").click(function() {
            var e = $("textarea[name=text]").val(),
                a = $("input[name=kode_tugas]").val();
            $.ajax({
                type: "POST",
                data: {
                    chat_tugas: e,
                    kode_tugas: a
                },
                async: !0,
                url: "<?= base_url('ajax/chat_tugas') ?>",
                success: function(e) {
                    $("textarea[name=text]").val("")
                }
            })
        }), $(".btn_edit_tugas").click(function() {
            var e = $(this).data("tugas");
            $.ajax({
                type: "POST",
                data: {
                    id_tugas: e
                },
                dataType: "JSON",
                async: !0,
                url: "<?= base_url('guru/edit_tugas') ?>",
                success: function(r) {
                    $.each(r, function(e, a, t, n, l, s, u, i) {
                        $("input[name=e_kode_tugas]").val(r.kode_tugas), $("input[name=e_nama_tugas]").val(r.nama_tugas), $("select[name=e_mapel]").val(r.mapel), $("select[name=e_kelas]").val(r.kelas), $(".isi-teks-tugas").html(r.deskripsi);
                        var o = r.due_date.substring(0, 10);
                        $("input[name=e_tgl]").val(o);
                        o = r.due_date.substring(11, 16);
                        $("input[name=e_jam]").val(o)
                    })
                }
            })
        });
        new FileUploadWithPreview("fileMateri"), new FileUploadWithPreview("videoMateri"), new FileUploadWithPreview("e_fileMateri"), new FileUploadWithPreview("e_videoMateri")
    });
</script>

<?= $this->endSection(); ?>