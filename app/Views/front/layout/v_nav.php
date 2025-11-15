<div class="container">
    <!-- Logo -->
    <a class="logo" href="<?= base_url() ?>">
        <img src="<?= base_url('./media/settings/' . $settings['logo']); ?>" style="width:230px" alt="Logo">
    </a>
    <!-- End Logo -->

    <!-- Toggle get grouped for better mobile display -->
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="fa fa-bars"></span>
    </button>
    <!-- End Toggle -->
</div>
<!--/end container-->

<div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
    <div class="container">
        <ul class="nav navbar-nav">
            <!-- Home -->
            <li><a href="<?= base_url() ?>">Beranda</a></li>
            <!-- End Home -->

            <!-- PROFIL -->
            <li class="dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                    PROFIL
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?= base_url('profile/struktur_organisasi') ?>">Struktur Organisasi</a></li>
                    <li><a href="<?= base_url('profile/kepegawaian') ?>">Kepegawaian</a></li>
                    <?php foreach ($profile as $key => $value) { ?>
                        <li><a href="<?= base_url() ?>/profile/detail/<?= $value['judul_seo']; ?>"><?= $value['judul']; ?></a></li>
                    <?php } ?>
                </ul>
            </li>
            <!-- End PROFIL -->


            <!-- SAHABAT UMKM -->
            <li class="dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                    SAHABAT UKM
                </a>
                <ul class="dropdown-menu">
                    <li><a href="http://umkm.depkop.go.id/" target="blank">Data UKM</a></li>
                    <li class="dropdown-submenu">
                        <a href="javascript:void(0);">Perizinan</a>
                        <ul class="dropdown-menu">
                            <?php foreach ($umkm as $key => $value) { ?>
                                <li><a href="<?= base_url() ?>/perizinan/detail/<?= $value['judul_seo']; ?>"><?= $value['judul']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li><a href="#">Info Bantuan</a></li>
                    <li><a href="<?= base_url() ?>/edu/ukm">EDU UKM</a></li>
                </ul>
            </li>
            <!-- End SAHABAT UMKM -->



            <!-- MITRA KOPERASI -->
            <li class="dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                    MITRA KOPERASI
                </a>
                <ul class="dropdown-menu">
                    <li><a href="http://nik.depkop.go.id/" target="blank">Data KOPERASI</a></li>
                    <li class="dropdown-submenu">
                        <a href="javascript:void(0);">Perizinan</a>
                        <ul class="dropdown-menu">
                            <?php foreach ($koperasi as $key => $value) { ?>
                                <li><a href="<?= base_url() ?>/perizinan/detail/<?= $value['judul_seo']; ?>"><?= $value['judul']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li><a href="#">Info Bantuan</a></li>
                    <li><a href="<?= base_url() ?>/edu/koperasi">EDU KOP</a></li>
                </ul>
            </li>
            <!-- End MITRA KOPERASI -->

            <!-- Berita -->
            <li class="dropdown">
                <a href="<?= base_url('berita') ?> " class="dropdown-toggle" data-toggle="dropdown">
                    Berita
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?= base_url('berita') ?>">Kegiatan</a></li>
                    <li><a href="<?= base_url('berita/emagazine') ?>">E-Magazine</a></li>
                </ul>
            </li>
            <!-- End Berita -->

            <!-- Informasi -->
            <li class="dropdown">
                <a href="<?= base_url('berita') ?> " class="dropdown-toggle" data-toggle="dropdown">
                    Informasi
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?= base_url('pelatihan') ?>">Pelatihan</a></li>
                    <li><a href="<?= base_url('informasi/pengumuman') ?>">Pengumuman</a></li>
                    <li><a href="<?= base_url('informasi/peraturan') ?>">Peraturan</a></li>
                    <li><a href="<?= base_url('informasi/download') ?>">File Download</a></li>
                </ul>
            </li>
            <!-- End Berita -->

            <!-- galeri -->
            <li class="dropdown">
                <a href="<?= base_url('galeri') ?> " class="dropdown-toggle" data-toggle="dropdown">
                    Galeri
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?= base_url('galeri/foto') ?>">Foto</a></li>
                    <li><a href="<?= base_url('galeri/video') ?>">Video</a></li>
                </ul>
            </li>
            <!-- End Berita -->

        </ul>
    </div>
    <!--/end container-->
</div>
<!--/navbar-collapse-->
</div>
<!--=== End Header ===-->