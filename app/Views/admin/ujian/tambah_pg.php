<?= $this->extend('template/app'); ?>
<?= $this->section('content'); ?>
<?= $this->include('template/sidebar/admin'); ?>

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <a href="javascript:void(0);" class="btn btn-primary tambah-pg" style="position: fixed; right: -10px; top: 50%; z-index: 9999;">Tambah Soal</a>
    <div class="layout-px-spacing">
        <form action="<?= base_url('app/tambah_pg_'); ?>" method="POST" enctype="multipart/form-data">
            <div class="row layout-top-spacing">
                <div class="col-lg-12 layout-spacing">
                    <div class="widget shadow p-3">
                        <div class="widget-heading">
                            <h5 class="">Ujian Pilihan Ganda</h5>
                            <a href="javascript:void(0);" class="btn btn-primary my-2" data-toggle="modal" data-target="#excel_ujian">Import Excel</a>
                            <div class="row mt-2">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Nama Ujian / Quiz</label>
                                        <input type="text" name="nama_ujian" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Kelas</label>
                                        <select class="form-control" name="kelas" id="mapel_materi" required>
                                            <option value="">Pilih</option>
                                            <?php foreach ($guru_kelas as $gk) : ?>
                                                <option value="<?= $gk->id_kelas; ?>"><?= $gk->nama_kelas; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Kategori</label>
                                        <select class="form-control" name="mapel" id="mapel_materi" required>
                                            <option value="">Pilih</option>
                                            <?php foreach ($guru_mapel as $gm) : ?>
                                                <option value="<?= $gm->id_mapel; ?>"><?= $gm->nama_mapel; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Waktu Ujian</label>
                                        <div class="input-group">
                                            <input type="number" name="waktu_ujian" class="form-control" required>
                                            <div class="input-group-append">
                                                <button type="button" class="btn" style="background-color: #cacaca;">Menit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row layout-top-spacing">
                <div class="col-lg-12 layout-spacing">
                    <div class="widget shadow p-3">
                        <div class="widget-heading">
                            <h5 class="">Soal Ujian</h5>
                        </div>
                        <div id="soal_pg">
                            <div class="isi_soal">
                                <div class="form-group">
                                    <label for="">Soal No. 1</label>
                                    <textarea name="nama_soal[]" cols="30" rows="2" class="summernote" wrap="hard" required></textarea>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Pilihan A</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">A</span>
                                                </div>
                                                <textarea name="pg_1[]" class="form-control summernote-img" cols="30" rows="10"></textarea>
                                                <!-- <input type="text" name="pg_1[]" class="form-control summernote-img" placeholder="Opsi A" autocomplete="off"> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Pilihan B</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">B</span>
                                                </div>
                                                <textarea name="pg_2[]" class="form-control summernote-img" cols="30" rows="10"></textarea>
                                                <!-- <input type="text" name="pg_2[]" class="form-control summernote-img" placeholder="Opsi B" autocomplete="off"> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Pilihan C</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">C</span>
                                                </div>
                                                <textarea name="pg_3[]" class="form-control summernote-img" cols="30" rows="10"></textarea>
                                                <!-- <input type="text" name="pg_3[]" class="form-control summernote-img" placeholder="Opsi C" autocomplete="off"> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Pilihan D</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">D</span>
                                                </div>
                                                <textarea name="pg_4[]" class="form-control summernote-img" cols="30" rows="10"></textarea>
                                                <!-- <input type="text" name="pg_4[]" class="form-control summernote-img" placeholder="Opsi D" autocomplete="off"> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Pilihan E</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">E</span>
                                                </div>
                                                <textarea name="pg_5[]" class="form-control summernote-img" cols="30" rows="10"></textarea>
                                                <!-- <input type="text" name="pg_5[]" class="form-control summernote-img" placeholder="Opsi E" autocomplete="off"> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Jawaban</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon5">
                                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <input type="text" name="jawaban[]" class="form-control" placeholder="Contoh : A" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Pembahasan / Keterangan No. 1</label>
                                    <textarea name="pembahasan[]" cols="30" rows="2" class="summernote" wrap="hard" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
<div class="modal fade" id="excel_ujian" tabindex="-1" role="dialog" aria-labelledby="excel_ujianLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= base_url('app/excel_pg'); ?>" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="excel_ujianLabel">Import Soal via Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-2">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Nama Ujian / Quiz</label>
                                <input type="text" name="e_nama_ujian" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select class="form-control" name="e_kelas" id="mapel_materi" required>
                                    <option value="">Pilih</option>
                                    <?php foreach ($guru_kelas as $gk) : ?>
                                        <option value="<?= $gk->id_kelas; ?>"><?= $gk->nama_kelas; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Kategori</label>
                                <select class="form-control" name="e_mapel" id="mapel_materi" required>
                                    <option value="">Pilih</option>
                                    <?php foreach ($guru_mapel as $gm) : ?>
                                        <option value="<?= $gm->id_mapel; ?>"><?= $gm->nama_mapel; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Waktu Ujian</label>
                                <div class="input-group">
                                    <input type="number" name="e_waktu_ujian" class="form-control" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn" style="background-color: #cacaca;">Menit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">File Excel</label><br>
                                <input type="file" name="excel" accept=".xls, .xlsx">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="">Template</label><br>
                            <a href="<?= base_url('download/excel_pg'); ?>" class="btn btn-success">Download Template</a>
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
            var l = new FormData;
            l.append("image", e), $.ajax({
                url: "<?= base_url('app/upload_summernote') ?>",
                cache: !1,
                contentType: !1,
                processData: !1,
                data: l,
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
                url: "<?= base_url('app/delete_image') ?>",
                cache: !1,
                success: function(e) {
                    console.log(e)
                }
            })
        }
        setInterval(() => {
            $(".summernote").summernote({
                // placeholder: "Hello stand alone ui",
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
            })
        }, 1e3);
        setInterval(() => {
            $(".summernote-img").summernote({
                // placeholder: "Hello stand alone ui",
                tabsize: 2,
                width: 340,
                height: 120,
                toolbar: [
                    ["insert", ["picture"]],
                ],
                callbacks: {
                    onImageUpload: function(e, a = this) {
                        uploadImage(e[0], a)
                    },
                    onMediaDelete: function(e) {
                        deleteImage(e[0].src)
                    }
                }
            })
        }, 1e3);

        // TAMBAH SOAL PG
        // SISWA
        var no_soal = 2;
        $('.tambah-pg').click(function() {
            const pg = `
            <div class="isi_soal">
            <hr>
                <div class="form-group">
                    <label for="">Soal No . ` + no_soal + `</label>
                    <textarea name="nama_soal[]" cols="30" rows="2" class="summernote" wrap="hard" required></textarea>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Pilihan A</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5">A</span>
                                </div>
                                <textarea name="pg_1[]" class="form-control summernote-img" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Pilihan B</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5">B</span>
                                </div>
                                <textarea name="pg_2[]" class="form-control summernote-img" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Pilihan C</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5">C</span>
                                </div>
                                <textarea name="pg_3[]" class="form-control summernote-img" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Pilihan D</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5">D</span>
                                </div>
                                <textarea name="pg_4[]" class="form-control summernote-img" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Pilihan E</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5">E</span>
                                </div>
                                <textarea name="pg_5[]" class="form-control summernote-img" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Jawaban</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    </span>
                                </div>
                                <input type="text" name="jawaban[]" class="form-control" placeholder="Contoh : A" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Pembahasan / Keterangan No. ` + no_soal + `</label>
                    <textarea name="pembahasan[]" cols="30" rows="2" class="summernote" wrap="hard" required></textarea>
                </div>
                <a href="javascript:void(0);" class="btn btn-danger hapus-pg">Hapus</a>
            </div>
           `;

            $('#soal_pg').append(pg);
            no_soal++;
        });
        $("#soal_pg").on("click", ".isi_soal a", function() {
            $(this).parents(".isi_soal").remove(), --no_soal
        });

    })
</script>


<?= $this->endSection(); ?>