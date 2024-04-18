<?= $this->extend('template/app'); ?>
<?= $this->section('content'); ?>
<?= $this->include('template/sidebar/siswa'); ?>

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-spacing">
            <!-- Content -->
            <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">
                <div class="user-profile layout-spacing">
                    <div class="widget-content widget-content-area">
                        <div class="d-flex justify-content-between">
                            <h3 class="">My Profile</h3>
                            <a href="javascript:void(0);" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3">
                                    <path d="M12 20h9"></path>
                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                </svg></a>
                        </div>
                        <div class="text-center user-info">
                            <img src="<?= base_url('assets/app-assets/user/') . '/' . $siswa->avatar; ?>" class="img-user" alt="avatar" style="width: 125px; height: 125px;">
                            <p class=""><?= $siswa->nama_siswa; ?></p>
                        </div>
                        <div class="user-info-list" style="margin-top: -10px;">
                            <div class="text-center">
                                <p>Peserta Ujian-CBT</p>
                                <ul class="contacts-block list-unstyled" style="margin-top: -5px;">
                                    <li class="contacts-block__item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg><br><?= date('d-M-Y', $siswa->date_created); ?>
                                    </li>
                                    <li class="contacts-block__item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg><br><?= $siswa->email; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

                <div class="skills layout-spacing ">
                    <div class="widget-content widget-content-area">
                        <h3 class="">Update Profile</h3>
                        <form action="<?= base_url('siswa/edit_profile'); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="nama_siswa" id="nama_siswa" value="<?= $siswa->nama_siswa; ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" id="email" value="<?= $siswa->email; ?>" class="form-control" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Foto</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="avatar" id="customFile" accept=".jpg, .png, .jpeg" onchange="previewImg()">
                                    <input type="hidden" name="gambar_lama" value="<?= $siswa->avatar; ?>">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Save</button>
                        </form>
                    </div>
                </div>

                <div class="skills layout-spacing">
                    <div class="widget-content widget-content-area">
                        <h3 class="">Password</h3>
                        <form action="<?= base_url('siswa/edit_password'); ?>" method="post">
                            <div class="form-group">
                                <label for="">Current Password</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">New Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
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

    function previewImg() {
        var e = document.querySelector("#customFile");
        const t = document.querySelector(".custom-file-label"),
            o = document.querySelector(".img-user");
        t.textContent = e.files[0].name;
        const n = new FileReader;
        n.readAsDataURL(e.files[0]), n.onload = function(e) {
            o.src = e.target.result
        }
    }
</script>

<?= $this->endSection(); ?>