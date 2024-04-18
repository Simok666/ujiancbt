<?= $this->extend('template/app'); ?>
<?= $this->section('content'); ?>
<?= $this->include('template/sidebar/admin'); ?>

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <a href="javascript:void(0);" class="btn btn-primary tambah-essay" style="position: fixed; right: -10px; top: 50%; z-index: 9999;">Tambah Soal</a>
    <div class="layout-px-spacing">
        <form action="<?= base_url('app/tambah_essay_'); ?>" method="POST" enctype="multipart/form-data">
            <div class="row layout-top-spacing">
                <div class="col-lg-12 layout-spacing">
                    <div class="widget shadow p-3">
                        <div class="widget-heading">
                            <h5 class="">Ujian Essay</h5>
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
            <div class="row">
                <div class="col-lg-12 layout-spacing">
                    <div class="widget shadow p-3">
                        <div class="widget-heading">
                            <h5 class="">Soal Ujian</h5>
                        </div>
                        <div id="soal_essay">
                            <div class="isi_soal">
                                <div class="form-group">
                                    <label for="">Soal No. 1</label><br>
                                    <textarea class="summernote" name="soal[]" cols="30" rows="5" wrap="hard"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary d-flex ml-auto">Submit</button>
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


<script>
    <?= session()->getFlashdata('pesan'); ?>

    $(document).ready(function() {

        var no_soal = 2
        $('.tambah-essay').click(function() {
            const essay = `
            <div class="isi_soal mt-2">
                <div class="form-group">
                    <label for="">Soal No. ` + no_soal + `</label><br>
                    <textarea class="summernote" name="soal[]" cols="30" rows="5" wrap="hard"></textarea>
                </div>
                <a href="javascript:void(0);" class="btn btn-danger hapus-pg">Hapus</a>
            </div>
           `;

            $('#soal_essay').append(essay);
            no_soal++;
        });

        function uploadImage(e, a) {
            var o = new FormData;
            o.append("image", e), $.ajax({
                url: "<?= base_url('app/upload_summernote') ?>",
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
                url: "<?= base_url('app/delete_image') ?>",
                cache: !1,
                success: function(e) {
                    console.log(e)
                }
            })
        }
        $("#soal_essay").on("click", ".isi_soal a", function() {
            $(this).parents(".isi_soal").remove(), --no_soal
        }), setInterval(() => {
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
            })
        }, 1e3);

    })
</script>


<?= $this->endSection(); ?>