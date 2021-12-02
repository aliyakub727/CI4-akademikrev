<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Suzuran</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <!-- Divider -->
        <!-- role admin -->
        <?php if (in_groups('admin')) : ?>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/admin/landing_page/<?= user_id() ?>">
                    <i class="fas fa-plus-circle"></i>
                    <span>Edit Landingpage</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/admin/sliderku/<?= user_id(); ?>">
                    <i class="fas fa-plus-circle"></i>
                    <span>Edit Sliderku</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/admin/fasilitas/<?= user_id(); ?>">
                    <i class="fas fa-plus-circle"></i>
                    <span>Edit Fasilitas</span>
                </a>
            </li>
            <li class="nav-item">
                <?php if (empty($admin)) { ?>
                    <a class="nav-link" href="<?= base_url(); ?>/Admin/lengkapi/<?= user_id(); ?>">
                        <i class="fas fa-user"></i>
                        <span>My Profile</span>
                    </a>
                <?php } else { ?>
                    <a class="nav-link" href="<?= base_url(); ?>/Admin/profile/<?= user_id(); ?>">
                        <i class="fas fa-user"></i>
                        <span>My Profile</span>
                    </a>
                <?php } ?>
            </li>
        <?php endif ?>
        <!-- role operator -->
        <?php if (in_groups('operator')) : ?>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Interface
            </div>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/Operator/datasiswa/<?= user_id(); ?>">
                    <i class="fas fa-plus-circle"></i>
                    <span>Data Siswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/Operator/dataguru/<?= user_id(); ?>">
                    <i class="fas fa-plus-circle"></i>
                    <span>Guru</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/Operator/masterdatapelajaran/<?= user_id(); ?>">
                    <i class="fas fa-plus-circle"></i>
                    <span>Set Kelas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/Operator/datajadwal/<?= user_id(); ?>">
                    <i class="fas fa-plus-circle"></i>
                    <span>Set Jadwal</span>
                </a>
            </li>
            <li class="nav-item">
                <?php if (empty($cek)) { ?>
                    <a class="nav-link" href="<?= base_url(); ?>/Operator/lengkapi/<?= user_id(); ?>">
                        <i class="fas fa-user"></i>
                        <span>My Profile</span>
                    </a>
                <?php } else { ?>
                    <a class="nav-link" href="<?= base_url(); ?>/Operator/profile/<?= user_id(); ?>">
                        <i class="fas fa-user"></i>
                        <span>My Profile</span>
                    </a>
                <?php } ?>
            </li>
        <?php endif; ?>

        <!-- role guru -->

        <?php if (in_groups('guru')) : ?>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Interface
            </div>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/Guru/tambahnilai/<?= user_id(); ?>">
                    <i class="fas fa-plus-circle"></i>
                    <span>Input Nilai</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/home/error">
                    <i class="fas fa-plus-circle"></i>
                    <span>Input absensi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/home/error">
                    <i class="fas fa-book-reader"></i>
                    <span>Review Nilai</span>
                </a>
            </li>
            <li class="nav-item">
                <?php if (empty($guru)) { ?>
                    <a class="nav-link" href="<?= base_url(); ?>/Guru/lengkapi/<?= user_id(); ?>">
                        <i class="fas fa-user"></i>
                        <span>My Profile</span>
                    </a>
                <?php } else { ?>
                    <a class="nav-link" href="<?= base_url(); ?>/Guru/profile/<?= user_id(); ?>">
                        <i class="fas fa-user"></i>
                        <span>My Profile</span>
                    </a>
                <?php } ?>
            </li>
        <?php endif; ?>

        <!-- role Siswa -->

        <?php if (in_groups('siswa')) : ?>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Interface
            </div>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/Siswa/jadwal/<?= $idkelas->id_kelas ?>">
                    <i class="fas fa-book-reader"></i>
                    <span>jadwal Matapelajaran</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/home/error">
                    <i class="fas fa-book-reader"></i>
                    <span>Raport Nilai</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/home/error">
                    <i class="fas fa-book-reader"></i>
                    <span>Laporan raport </span>
                </a>
            </li>
            <li class="nav-item">
                <?php if (empty($siswa)) { ?>
                    <a class="nav-link" href="<?= base_url(); ?>/Siswa/lengkapi/<?= user_id(); ?>">
                        <i class="fas fa-user"></i>
                        <span>My Profile</span>
                    </a>
                <?php } else { ?>
                    <a class="nav-link" href="<?= base_url(); ?>/Siswa/profile/<?= user_id(); ?>">
                        <i class="fas fa-user"></i>
                        <span>My Profile</span>
                    </a>
                <?php } ?>
            </li>
        <?php endif; ?>

        <!-- Role Kepala Sekolah -->

        <?php if (in_groups('kepalasekolah')) : ?>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Interface
            </div>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/home/error">
                    <i class="fas fa-book-reader"></i>
                    <span>Laporan Raport siswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/home/error">
                    <i class="fas fa-book-reader"></i>
                    <span>Laporan absensi siswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/kepalasekolah/datasiswa/<?= user_id(); ?>">
                    <i class="fas fa-book-reader"></i>
                    <span>Laporan data siswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/kepalasekolah/dataguru/<?= user_id(); ?>">
                    <i class="fas fa-book-reader"></i>
                    <span>Laporan data guru</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/home/error">
                    <i class="fas fa-book-reader"></i>
                    <span>Laporan Data pelajaran</span>
                </a>
            </li>
            <li class="nav-item">
                <?php if (empty($kepsek)) { ?>
                    <a class="nav-link" href="<?= base_url(); ?>/Kepalasekolah/lengkapi/<?= user_id(); ?>">
                        <i class="fas fa-user"></i>
                        <span>My Profile</span>
                    </a>
                <?php } else { ?>
                    <a class="nav-link" href="<?= base_url(); ?>/Kepalasekolah/profile/<?= user_id(); ?>">
                        <i class="fas fa-user"></i>
                        <span>My Profile</span>
                    </a>
                <?php } ?>
            </li>
        <?php endif; ?>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            internal
        </div>

        <!-- role operator -->
        <?php if (in_groups('operator')) : ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseone" aria-expanded="true" aria-controls="collapseone">
                    <i class="fas fa-bars"></i>
                    <span>Data Tambahan</span>
                </a>
                <div id="collapseone" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Ditambahkan:</h6>
                        <a class="collapse-item" href="<?= base_url(); ?>/operator/datamapel/<?= user_id(); ?>">Mata Pelajaran</a>
                        <a class="collapse-item" href="<?= base_url(); ?>/operator/datajurusan/<?= user_id(); ?>">Jurusan</a>
                        <a class="collapse-item" href="<?= base_url(); ?>/operator/datatahunajaran/<?= user_id(); ?>">tahun ajaran</a>
                        <a class="collapse-item" href="<?= base_url(); ?>/operator/datakelas/<?= user_id(); ?>">Kelas</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-bars"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Laporan-Laporan:</h6>
                        <a class="collapse-item" href="<?= base_url(); ?>/operator/laporansiswa/<?= user_id(); ?>">Data Siswa</a>
                        <a class="collapse-item" href="<?= base_url(); ?>/operator/laporanguru/<?= user_id(); ?>">Data Guru</a>
                        <a class="collapse-item" href="<?= base_url(); ?>/operator/laporanmapel/<?= user_id(); ?>">Data pelajaran</a>
                    </div>
                </div>
            </li>
        <?php endif; ?>

        <!-- role guru -->

        <?php if (in_groups('guru')) : ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-bars"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">laporan-laporan:</h6>
                        <a class="collapse-item" href="<?= base_url(); ?>/home/error">Nilai</a>
                        <a class="collapse-item" href="<?= base_url(); ?>/home/error">Absensi</a>
                    </div>
                </div>
            </li>
        <?php endif; ?>

        <?php if (in_groups('admin')) : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/admin/dataakun/<?= user_id(); ?>">
                    <i class="fas fa-cog"></i>
                    <span>Kelola Akun</span>
                </a>
            </li>
        <?php endif; ?>

        <li class="nav-item">
            <a class="nav-link" href="/logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>


    </ul>
    <!-- End of Sidebar -->