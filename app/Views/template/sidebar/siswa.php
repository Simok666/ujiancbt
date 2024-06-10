        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">

            <nav id="sidebar">
                <div class="profile-info">
                    <figure class="user-cover-image"></figure>
                    <div class="user-info">
                        <img src="<?= base_url('assets/app-assets/user/') . '/' . $siswa->avatar; ?>" alt="avatar" class="bg-white">
                        <h6 class=""><?= $siswa->nama_siswa; ?></h6>
                        <p class="">Kelas <?= $siswa->nama_kelas; ?></p>
                    </div>
                </div>
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu">
                        <a href="https://wa.me/085603220708?text=Halo%20saya%20ingin%20upgrade%20akun%20saya%20" target="_blank" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span>Upgrade Class</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu <?= $dashboard['menu']; ?>">
                        <a href="<?= base_url('siswa'); ?>" aria-expanded="<?= $dashboard['expanded']; ?>" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay">
                                    <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
                                    <polygon points="12 15 17 21 7 21 12 15"></polygon>
                                </svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu menu-heading">
                        <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg><span>PESERTA MENU</span></div>
                    </li>

                    <!-- <?php //if ($siswa->status_member == '1'): ?> -->
                    <li class="menu sidebar-materi <?= $menu_materi['menu']; ?>">
                        <a href="<?= base_url('siswa/materi'); ?>" aria-expanded="<?= $menu_materi['expanded']; ?>" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                </svg>
                                <span>Materi</span>
                            </div>
                        </a>
                    </li>
                    <!-- <?php //endif; ?> -->

                    <li class="menu <?= $menu_ujian['menu']; ?>">
                        <a href="<?= base_url('siswa/ujian'); ?>" aria-expanded="<?= $menu_ujian['expanded']; ?>" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                </svg>
                                <span>Ujian</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu menu-heading">
                        <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg><span>USER MENU</span></div>
                    </li>
                    <li class="menu <?= $menu_profile['menu']; ?>">
                        <a href="<?= base_url('siswa/profile'); ?>" aria-expanded="<?= $menu_profile['expanded']; ?>" class="dropdown-toggle">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span>Profile</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="<?= base_url('auth/logout'); ?>" aria-expanded="false" class="dropdown-toggle logout">
                            <div class="">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span>Logout</span>
                            </div>
                        </a>
                    </li>
                </ul>

            </nav>

        </div>
        <!--  END SIDEBAR  -->
<script>
    <?php if ($siswa->kelas == '7') : ?>
        $(".sidebar-materi").on("click", function(a) {
            a.preventDefault();
            url = "https://wa.me/085603220708?text=Halo%20saya%20ingin%20upgrade%20akun%20saya%20";
            swal({
                icon: "error",
                title: "Ups...",
                text: "Akun anda masih trial",
                type: "warning",
                showCancelButton: !0,
                cancelButtonText: "Nanti dulu",
                confirmButtonText: "Upgrade premium",
                padding: "2em"
                // footer: '<a href="https://wa.me/085603220708?text=Halo%20saya%20ingin%20upgrade%20akun%20saya%20" target="_blank">Upgrade ke premium jika ingin membuka fitur ini</a>'
            }).then((result) => {
            if (result.value){
                // console.log(url);
                window.open(url, '_blank');
            }
        })
        });
    <?php endif; ?>
</script>