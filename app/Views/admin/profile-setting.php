<?= $this->extend('template/app'); ?>
<?= $this->section('content'); ?>
<?= $this->include('template/sidebar/admin'); ?>

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
                            <img src="<?= base_url('assets/app-assets/user/') . '/' . $admin->avatar; ?>" class="img-user" alt="avatar" style="width: 125px; height: 125px;">
                            <p class=""><?= $admin->nama_admin; ?></p>
                            <p style="margin-top: -15px;">Admin</p>
                        </div>
                        <div class="user-info-list" style="margin-top: -20px;">
                            <div class="text-center">
                                <ul class="contacts-block list-unstyled">
                                    <li class="contacts-block__item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg><br><?= date('d-M-Y', $admin->date_created); ?>
                                    </li>
                                    <li class="contacts-block__item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg><br><?= $admin->email; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="education layout-spacing ">
                    <div class="widget-content widget-content-area">
                        <h3 class="">SMTP Email</h3>
                        <form action="<?= base_url('app/smtp_mail'); ?>" method="post">
                            <div class="form-group">
                                <label for="">SMTP HOST</label>
                                <input type="hidden" name="id_mail" value="<?= $smtp->id_mail; ?>" class="form-control" required>
                                <input type="text" name="smtp_host" value="<?= $smtp->smtp_host; ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">SMTP USER</label>
                                <input type="text" name="smtp_user" value="<?= $smtp->smtp_user; ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">SMTP PASSWORD</label>
                                <input type="text" name="smtp_pass" value="<?= $smtp->smtp_pass; ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">SMTP PORT</label>
                                <input type="number" name="smtp_port" value="<?= $smtp->smtp_port; ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">SMTP CRYPTO</label>
                                <input type="text" name="smtp_crypto" value="<?= $smtp->smtp_crypto; ?>" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

                <div class="skills layout-spacing ">
                    <div class="widget-content widget-content-area">
                        <h3 class="">Update Profile</h3>
                        <form action="<?= base_url('app/edit_profile'); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="nama_admin" id="nama_admin" value="<?= $admin->nama_admin; ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" id="email" value="<?= $admin->email; ?>" class="form-control" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Foto</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="avatar" id="customFile" accept=".jpg, .png, .jpeg" onchange="previewImg()">
                                    <input type="hidden" name="gambar_lama" value="<?= $admin->avatar; ?>">
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
                        <form action="<?= base_url('app/edit_password'); ?>" method="post">
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

                <div class="education layout-spacing ">
                    <div class="widget-content widget-content-area">
                        <h3 class="">Notif Email Settings</h3>
                        <p>Jika server terasa berat setiap kali mengirimkan email, anda bisa menonaktifkannya dengan settingan berikut : </p>
                        <form action="<?= base_url('app/setting_email'); ?>" method="post">
                            <div class="form-group">
                                <label>Tambah Akun Oleh Admin</label>
                                <div class="n-chk">
                                    <label class="new-control new-radio radio-classic-primary">
                                        <input type="hidden" name="id_mail" value="<?= $smtp->id_mail; ?>" class="form-control" required>
                                        <input type="radio" class="new-control-input" name="notif_akun" value="1" <?= ($smtp->notif_akun == 1) ? 'checked' : ''; ?>>
                                        <span class="new-control-indicator"></span>On
                                    </label>
                                </div>
                                <div class="n-chk">
                                    <label class="new-control new-radio radio-classic-danger">
                                        <input type="radio" class="new-control-input" name="notif_akun" value="0" <?= ($smtp->notif_akun == 0) ? 'checked' : ''; ?>>
                                        <span class="new-control-indicator"></span>OF
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Notif Materi</label>
                                <div class="n-chk">
                                    <label class="new-control new-radio radio-classic-primary">
                                        <input type="radio" class="new-control-input" name="notif_materi" value="1" <?= ($smtp->notif_materi == 1) ? 'checked' : ''; ?>>
                                        <span class="new-control-indicator"></span>On
                                    </label>
                                </div>
                                <div class="n-chk">
                                    <label class="new-control new-radio radio-classic-danger">
                                        <input type="radio" class="new-control-input" name="notif_materi" value="0" <?= ($smtp->notif_materi == 0) ? 'checked' : ''; ?>>
                                        <span class="new-control-indicator"></span>OF
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Notif Ujian</label>
                                <div class="n-chk">
                                    <label class="new-control new-radio radio-classic-primary">
                                        <input type="radio" class="new-control-input" name="notif_ujian" value="1" <?= ($smtp->notif_ujian == 1) ? 'checked' : ''; ?>>
                                        <span class="new-control-indicator"></span>On
                                    </label>
                                </div>
                                <div class="n-chk">
                                    <label class="new-control new-radio radio-classic-danger">
                                        <input type="radio" class="new-control-input" name="notif_ujian" value="0" <?= ($smtp->notif_ujian == 0) ? 'checked' : ''; ?>>
                                        <span class="new-control-indicator"></span>OF
                                    </label>
                                </div>
                            </div>
                            <hr style="margin-top: -13px;">
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
        const gambar = document.querySelector('#customFile');
        const gambarLable = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-user');

        gambarLable.textContent = gambar.files[0].name;

        const filegambar = new FileReader();
        filegambar.readAsDataURL(gambar.files[0]);

        filegambar.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

<?= $this->endSection(); ?>