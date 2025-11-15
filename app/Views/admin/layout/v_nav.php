        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <?php
            $request = \Config\Services::request(); { ?>
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin/home') ?>">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Administrator</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item <?= ($request->uri->getSegment(2) == 'home') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= base_url('admin/home') ?>">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Menu Website
                </div>

                <!-- Menu profile -->
                <li class="nav-item <?= ($request->uri->getSegment(2) == 'profile') ? 'active' : ''; ?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfile" aria-expanded="true" aria-controls="collapseProfile">
                        <i class="fa fa-sitemap"></i>
                        <span>Menu Profile</span>
                    </a>
                    <div id="collapseProfile" class="collapse <?= ($request->uri->getSegment(2) == 'profile') ? 'show' : ''; ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?= ($request->uri->getSegment(3) == 'kepegawaian' || $request->uri->getSegment(3) == 'kepegawaian_tambah' || $request->uri->getSegment(3) == 'kepegawaian_edit') ? 'active' : ''; ?>" href="<?= base_url('admin/profile/kepegawaian') ?>">Kepegawaian</a>
                            <a class="collapse-item <?= ($request->uri->getSegment(3) == 'menu' || $request->uri->getSegment(3) == 'tambah' || $request->uri->getSegment(3) == 'edit') ? 'active' : ''; ?>" href="<?= base_url('admin/profile/menu') ?>">Profile</a>
                        </div>
                    </div>
                </li>
                <!-- End profile-->

                <!-- Menu Sahabat UMKM -->
                <li class="nav-item <?= ($request->uri->getSegment(2) == 'umkm') ? 'active' : ''; ?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUMKM" aria-expanded="true" aria-controls="collapseUMKM">
                        <i class="fa fa fa-smile"></i>
                        <span>Sahabat UKM</span>
                    </a>
                    <div id="collapseUMKM" class="collapse <?= ($request->uri->getSegment(2) == 'umkm') ? 'show' : ''; ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?= ($request->uri->getSegment(3) == 'data' || $request->uri->getSegment(3) == 'data_tambah' || $request->uri->getSegment(3) == 'data_edit') ? 'active' : ''; ?>" href="<?= base_url('admin/umkm/data') ?>">Data UKM</a>
                            <a class="collapse-item <?= ($request->uri->getSegment(3) == 'perizinan' || $request->uri->getSegment(3) == 'perizinan_tambah' || $request->uri->getSegment(3) == 'perizinan_edit' || $request->uri->getSegment(3) == 'list_izin' || $request->uri->getSegment(3) == 'tambah_izin') ? 'active' : ''; ?>" href="<?= base_url('admin/umkm/perizinan') ?>">Perizinan</a>
                            <a class="collapse-item <?= ($request->uri->getSegment(3) == 'bantuan' || $request->uri->getSegment(3) == 'bantuan_tambah' || $request->uri->getSegment(3) == 'bantuan_edit') ? 'active' : ''; ?>" href="<?= base_url('admin/umkm/bantuan') ?>">Bantuan</a>
                            <a class="collapse-item <?= ($request->uri->getSegment(3) == 'edu' || $request->uri->getSegment(3) == 'tambah_edu' || $request->uri->getSegment(3) == 'edit_edu') ? 'active' : ''; ?>" href="<?= base_url('admin/umkm/edu') ?>">Edu UKM</a>
                        </div>
                    </div>
                </li>
                <!-- Menu Sahabat UMKM -->


                <!-- Menu Mitra Koperasi -->
                <li class="nav-item <?= ($request->uri->getSegment(2) == 'koperasi') ? 'active' : ''; ?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKOPERASI" aria-expanded="true" aria-controls="collapseKOPERASI">
                        <i class="fa fa-users"></i>
                        <span>Mitra Koperasi</span>
                    </a>
                    <div id="collapseKOPERASI" class="collapse <?= ($request->uri->getSegment(2) == 'koperasi') ? 'show' : ''; ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?= ($request->uri->getSegment(3) == 'data' || $request->uri->getSegment(3) == 'data_tambah' || $request->uri->getSegment(3) == 'data_edit') ? 'active' : ''; ?>" href="<?= base_url('admin/koperasi/data') ?>">Data Koperasi</a>
                            <a class="collapse-item <?= ($request->uri->getSegment(3) == 'perizinan' || $request->uri->getSegment(3) == 'perizinan_tambah' || $request->uri->getSegment(3) == 'perizinan_edit') ? 'active' : ''; ?>" href="<?= base_url('admin/koperasi/perizinan') ?>">Perizinan</a>
                            <a class="collapse-item <?= ($request->uri->getSegment(3) == 'bantuan' || $request->uri->getSegment(3) == 'bantuan_tambah' || $request->uri->getSegment(3) == 'bantuan_edit') ? 'active' : ''; ?>" href="<?= base_url('admin/koperasi/bantuan') ?>">Bantuan</a>
                            <a class="collapse-item <?= ($request->uri->getSegment(3) == 'edu' || $request->uri->getSegment(3) == 'tambah_edu' || $request->uri->getSegment(3) == 'edit_edu') ? 'active' : ''; ?>" href="<?= base_url('admin/koperasi/edu') ?>">Edu Koperasi</a>
                        </div>
                    </div>
                </li>
                <!-- End Mitra Koperasi -->


                <!-- Menu Berita -->
                <li class="nav-item <?= ($request->uri->getSegment(2) == 'berita') ? 'active' : ''; ?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBerita" aria-expanded="true" aria-controls="collapseBerita">
                        <i class="fa fa fa-newspaper"></i>
                        <span>Berita</span>
                    </a>
                    <div id="collapseBerita" class="collapse <?= ($request->uri->getSegment(2) == 'berita') ? 'show' : ''; ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?= ($request->uri->getSegment(3) == 'kegiatan' || $request->uri->getSegment(3) == 'kegiatan_tambah' || $request->uri->getSegment(3) == 'kegiatan_edit') ? 'active' : ''; ?>" href="<?= base_url('admin/berita/kegiatan') ?>">Kegiatan</a>
                            <a class="collapse-item <?= ($request->uri->getSegment(3) == 'emagazine' || $request->uri->getSegment(3) == 'emagazine_tambah' || $request->uri->getSegment(3) == 'emagazine_edit') ? 'active' : ''; ?>" href="<?= base_url('admin/berita/emagazine') ?>">E-Magazine</a>
                        </div>
                    </div>
                </li>
                <!-- End Berita-->

                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item <?= ($request->uri->getSegment(2) == 'informasi' || $request->uri->getSegment(2) == 'pelatihan') ? 'active' : ''; ?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fa fa fa-bullhorn"></i>
                        <span>Informasi</span>
                    </a>
                    <div id="collapseUtilities" class="collapse <?= ($request->uri->getSegment(2) == 'informasi' || $request->uri->getSegment(2) == 'pendaftar' || $request->uri->getSegment(2) == 'pelatihan') ? 'show' : ''; ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?= ($request->uri->getSegment(2) == 'pelatihan' || $request->uri->getSegment(3) == 'tambah' || $request->uri->getSegment(3) == 'edit') ? 'active' : ''; ?>" href="<?= base_url('admin/pelatihan') ?>">Pelatihan</a>
                            <a class="collapse-item <?= ($request->uri->getSegment(3) == 'pengumuman' || $request->uri->getSegment(3) == 'pengumuman_tambah' || $request->uri->getSegment(3) == 'pengumuman_edit' || $request->uri->getSegment(3) == 'lihat') ? 'active' : ''; ?>" href="<?= base_url('admin/informasi/pengumuman') ?>">Pengumuman</a>
                            <a class="collapse-item <?= ($request->uri->getSegment(3) == 'peraturan') ? 'active' : ''; ?>" href="<?= base_url('admin/informasi/peraturan') ?>">Peraturan</a>
                            <a class="collapse-item <?= ($request->uri->getSegment(3) == 'download') ? 'active' : ''; ?>" href="<?= base_url('admin/informasi/download') ?>">File Download</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item <?= ($request->uri->getSegment(2) == 'slideshow' || $request->uri->getSegment(2) ==  'galeri' || $request->uri->getSegment(2) ==  'banner' || $request->uri->getSegment(2) ==  'video') ? 'active' : ''; ?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Galeri</span>
                    </a>
                    <div id="collapsePages" class="collapse <?= ($request->uri->getSegment(2) == 'slideshow' || $request->uri->getSegment(2) ==  'galeri' || $request->uri->getSegment(2) ==  'banner' || $request->uri->getSegment(2) ==  'popup' || $request->uri->getSegment(2) ==  'video') ? 'show' : ''; ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?= ($request->uri->getSegment(2) == 'slideshow') ? 'active' : ''; ?>" href="<?= base_url('admin/slideshow') ?>">Slideshow</a>
                            <a class="collapse-item <?= ($request->uri->getSegment(2) == 'galeri') ? 'active' : ''; ?>" href="<?= base_url('admin/galeri') ?>">Foto</a>
                            <a class="collapse-item <?= ($request->uri->getSegment(2) == 'banner') ? 'active' : ''; ?>" href="<?= base_url('admin/banner') ?>">Banner</a>
                            <a class="collapse-item <?= ($request->uri->getSegment(2) == 'popup') ? 'active' : ''; ?>" href="<?= base_url('admin/popup') ?>">Pop UP</a>
                            <a class="collapse-item <?= ($request->uri->getSegment(2) == 'video') ? 'active' : ''; ?>" href="<?= base_url('admin/video') ?>">Video</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Charts -->
                <li class="nav-item <?= ($request->uri->getSegment(2) == 'link') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= base_url('admin/link') ?>">
                        <i class="fa fa-globe"></i>
                        <span>Link</span></a>
                </li>

                <!-- Nav Item - Charts -->
                <li class="nav-item <?= ($request->uri->getSegment(2) == 'user') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= base_url('admin/user') ?>">
                        <i class="fa fa-user-circle"></i>
                        <span>User</span></a>
                </li>

                <!-- Nav Item - Charts -->
                <li class="nav-item <?= ($request->uri->getSegment(2) == 'settings') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= base_url('admin/settings') ?>">
                        <i class="fa fa-cogs"></i>
                        <span>Settings</span></a>
                </li>

                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>
            <?php } ?>
        </ul>
        <!-- End of Sidebar -->