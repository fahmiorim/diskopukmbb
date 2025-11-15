<div class="slideshow">
    <div class="container margin-bottom-20">
        <div id="layerslider" style="width: 100%; height: 370px;">
            <?php foreach ($slider as $key => $value) { ?>
                <div class="ls-slide" style="slidedirection: right; transition2d: 92,93,105; ">
                    <img src="<?= base_url() ?>/media/slideshow/<?= $value['gambar']; ?>" class="ls-bg" alt="Slide background" />
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Owl Carousel v3 -->
<div class="container">
    <div class="owl-carousel-style-v2 margin-bottom-30">
        <div class="owl-slider-v3 margin-bottom-10">
            <?php foreach ($link as $key => $value) { ?>
                <div class="item">
                    <a href="<?= $value['link_url']; ?>" target="blank"><img class="img-responsive" src="<?= base_url() ?>/media/link/<?= $value['gambar']; ?>" style="width: 60%; height: auto;" alt=""></a>
                    <div class="caption">
                        <p><a href="<?= $value['link_url']; ?>" target="blank"><?= $value['nama']; ?></a></p>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- End Owl Carousel v3 -->

        <div class="ticker-container">
            <div class="ticker-caption">
                <p>News Flash</p>
                <span></span>
            </div>
            <ul>
                <?php foreach ($newsflash as $key => $value) { ?>
                    <div>
                        <li><a href="berita/detail/<?= $value['judul_seo']; ?>" target="blank"><?= $value['judul']; ?></a></li>
                    </div>
                <?php } ?>
            </ul>
        </div>
    </div>

    <!-- Tab Content -->
    <div class="col-md-8">
        <div class="wow fadeInUp">
            <div class="tag-box tag-box-v2 box-shadow shadow-effect-1">
                <div class="tab-content">
                    <div class="featured_title text-white" style="margin-bottom: 10px;">
                        <!-- featured_title -->
                        <h4 style="color: #005267;">BERITA KEGIATAN</h4> <a href="<?= base_url() ?>/berita" class="view_button">LIHAT ARSIP</a>
                    </div>
                    <div class="tab-pane fade in active" id="tab-v4-a1">
                        <div class="row">
                            <div class="col-sm-7">
                                <?php foreach ($kegiatan as $key => $value) { ?>
                                    <!-- Blog Grid -->
                                    <div class="blog-grid sm-margin-bottom-40">
                                        <img class="img-responsive" src="<?= base_url() ?>/media/berita/<?= $value['gambar']; ?>" width="100%" style="height: 225px;" alt="">
                                        <h3><a href="berita/detail/<?= $value['judul_seo']; ?>"><?= $value['judul']; ?></a></h3>
                                        <div class="by-author">
                                            <span><?= format_indo($value['tanggal']); ?> /</span>
                                            <strong>dibaca <?= $value['dilihat']; ?>x</strong>
                                        </div>
                                        <p class="text-justify"><?= substr(strip_tags($value['isi_berita']), 0, 170) ?>...</p>
                                        <a class="view_button" href="<?= base_url() ?>/berita/detail/<?= $value['judul_seo']; ?>">Read More</a>
                                    </div>
                                    <!-- End Blog Grid -->
                                <?php } ?>
                            </div>
                            <div class="col-sm-5">
                                <?php foreach ($kegiatanthumb as $key => $value) { ?>
                                    <!-- Blog Thumb -->
                                    <div class="blog-thumb margin-bottom-10">
                                        <div class="blog-thumb-hover">
                                            <img src="<?= base_url() ?>/media/berita/<?= $value['gambar']; ?>" alt="">
                                            <a class="hover-grad" href="<?= base_url() ?>/berita/detail/<?= $value['judul_seo']; ?>"><i class="fa fa-photo"></i></a>
                                        </div>
                                        <div class="blog-thumb-desc">
                                            <h3><a href="<?= base_url() ?>/berita/detail/<?= $value['judul_seo']; ?>"><?= substr(strip_tags($value['judul']), 0, 50) ?>...</a></h3>
                                            <div class="by-author">
                                                <span><?= $value['tanggal']; ?> /</span>
                                                <strong>dibaca <?= $value['dilihat']; ?>x</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Blog Thumb -->
                                <?php } ?>
                            </div>
                        </div>
                        <!--/end row-->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Tab Content -->
    </div>
    <!-- End Tab v4 -->

    <!-- Latest Shots -->
    <div class="col-md-4 ">
        <!-- <div class="testimonials-v6 testimonials-wrap">
            <div class="row ">
                <div class="testimonials-info rounded-bottom">
                    <img class="rounded-x" src="<?= base_url() ?>/frontend/assets/img/logodiskoukm.jpg" alt="">
                    <div class="testimonials-desc">
                        <h5 class="margin-bottom-10">diskopukmbatubara</h5>
                        <span>902 Followers</span>
                    </div>
                    <div class="HeaderCta">
                        <button class="btn btn-primary btn-sm" type="button">View Profil</button>
                    </div>
                    <div class="col-md-12">

                    </div>
                </div>
            </div>
        </div>
        <div class="margin-bottom-30">
            <div id="myCarousel" class="carousel slide carousel-v1">
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="<?= base_url() ?>/frontend/assets/img/fotoig4.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="<?= base_url() ?>/frontend/assets/img/fotoig2.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="<?= base_url() ?>/frontend/assets/img/fotoig3.jpg" alt="">
                    </div>
                </div>

                <div class="carousel-arrow">
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div> -->

        <div class="elfsight-app-5911c250-dd28-45ed-8d0a-9c79e510f59a img-responsive"></div>
    </div>
    <!--/col-md-4-->

    <!--E-magazine -->
    <div class="col-md-8">
        <div class="wow fadeInUp">
            <div class="box-shadow margin-bottom-30">
                <div class="owl-carousel-v1 owl-work-v1">
                    <div class="headline-magazine">
                        <h2 class="pull-left">E-Magazine</h2>
                        <div class="owl-navigation">
                            <div class="customNavigation">
                                <a class="owl-btn prev-v2"><i class="fa fa-angle-left"></i></a>
                                <a class="owl-btn next-v2"><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                        <!--/navigation-->
                    </div>
                    <div class="owl-recent-works-v1">
                        <?php foreach ($magazine as $key => $value) { ?>
                            <div class="item">
                                <a href="<?= base_url() ?>/berita/emagazine_detail/<?= $value['judul_seo']; ?>">
                                    <em class="overflow-hidden margin-bottom-10">
                                        <img class="img-responsive" style="height: 300px;" src="<?= base_url() ?>/media/emagazine/<?= $value['cover']; ?>" alt="">
                                    </em>
                                    <div class="text-center margin-bottom-10">
                                        <h5><b><?= $value['judul']; ?></b></h5>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Thumb v3 -->
    <div class="col-md-4">
        <div class="wow fadeInRight">
            <?php foreach ($banner as $key => $value) { ?>
                <!-- <div class="item active"> -->
                <div class="item <?php echo ($key == 0) ? "active" : ""; ?> ">
                    <a href="<?= base_url($value['url']) ?>"><img class="img-responsive" width="100%" style="height: 460px;" src="<?= base_url() ?>/media/banner/<?= $value['gambar']; ?>" alt=""></a>
                </div>
            <?php } ?>
        </div>
        <!-- End Blog Thumb v3 -->
    </div>



    <div class="col-md-8 ">
        <div class="wow fadeInUp">
            <div class="box-shadow margin-bottom-30">

                <div class="owl-carousel-v1 owl-work-v1">
                    <div class="headline-magazine">
                        <h2 class="pull-left">EDU KOPERASI & UMKM</h2>
                        <div class="owl-navigation">
                            <div class="customNavigation">
                                <a class="owl-btn prev-v2"><i class="fa fa-angle-left"></i></a>
                                <a class="owl-btn next-v2"><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                        <!--/navigation-->
                    </div>
                    <div class="owl-recent-works-v1 team-v3 margin-bottom-10">
                        <?php foreach ($eduukm as $key => $value) { ?>
                            <div class="item ">
                                <div class="team-img">
                                    <img class="img-responsive" src="<?= base_url() ?>/media/eduukm/<?= $value['gambar']; ?>" style="border-radius: 10px; width: 220px; height: 220px;overflow: hidden; position: relative;" alt="">
                                    <div class="team-hover">
                                        <a href="<?= base_url() ?>/edu/ukm_detail/<?= $value['judul_seo']; ?>">
                                            <span><?= $value['judul'] ?></span>
                                            <small><?= $value['deskripsi'] ?></small>
                                            <ul class="list-inline team-social-v3">
                                                <button class="btn-u btn-u-sm rounded btn-u-yellow" type="button">View More</button>
                                            </ul>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="owl-carousel-v1 owl-work-v1">
                    <div class="owl-recent-works-v1 team-v3">
                        <?php foreach ($edukop as $key => $value) { ?>
                            <div class="item ">
                                <div class="team-img">
                                    <img class="img-responsive" src="<?= base_url() ?>/media/eduukm/<?= $value['gambar']; ?>" style="border-radius: 10px; width: 220px; height: 220px;overflow: hidden; position: relative;" alt="">
                                    <div class="team-hover">
                                        <a href="<?= base_url() ?>/edu/koperasi_detail/<?= $value['judul_seo']; ?>">
                                            <span><?= $value['judul'] ?></span>
                                            <small><?= $value['deskripsi'] ?></small>
                                            <ul class="list-inline team-social-v3">
                                                <button class="btn-u btn-u-sm rounded btn-u-yellow" type="button">View More</button>
                                            </ul>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Blog Thumb v3 -->
    <div class="col-md-4">
        <div class="wow fadeInRight">
            <div class="tag-box tag-box-v2 box-shadow shadow-effect-1" style="background: linear-gradient( 90deg, rgba(0,77,149,255) 0%, rgba(2,103,185,255) 100%, rgba(0,77,149,255) 100% );">
                <a href="<?= base_url() ?>/informasi/pengumuman">
                    <h2 class="title-v4" style="color: #fff;">PENGUMUMAN</h2>
                </a>
                <?php foreach ($pengumuman as $key => $value) { ?>
                    <hr class="hr-xs">
                    <div class="blog-thumb-v3">
                        <h3><a href="<?= base_url() ?>/informasi/pengumuman_detail/<?= $value['id']; ?>"><?= $value['judul']; ?></a></h3>
                    </div>

                <?php } ?>
            </div>
        </div>
        <!-- End Blog Thumb v3 -->
    </div>

    <div class="container margin-bottom-30">
        <div class="featured_slider kedeputian">
            <!--Start featured_slider -->
            <div class="featured_title text-white" style="margin-bottom: 10px;">
                <!-- featured_title -->
                <h4 style="color: #fff !important;">INFO PELATIHAN</h4>
                <a href="/pelatihan" class="view_button">LIHAT ARSIP</a>
            </div><!-- // featured_title -->
            <div class="row">

                <?php foreach ($pelatihan as $key => $value) { ?>
                    <a href="<?= base_url() ?>/pelatihan/detail/<?= $value['training_title_seo'] ?>" style="color: #fff;font-family: 'Raleway', sans-serif;
">
                        <div class="col-md-3 text-white">
                            <?= $value['training_title'] ?><br>
                            <small><?= format_indo($value['start_date']) ?> s/d <br>
                                <?= format_indo($value['finish_date']) ?></small><br>
                            <small>Kategori : <span style=" line-height: 2;"><?= $value['training_name'] ?></span></small><br>
                    </a>
                    <br>
                    <?php
                    $tgl_now = date("Y-m-d");
                    if ($tgl_now > $value['finish_date']) {
                        echo '<button class="btn-danger btn-sm" disable>Pelatihan Berakhir</button>';
                    } else {
                        echo '<button class="btn-success btn-sm">Pelatihan Aktif</button>';
                    } ?>
            </div>

        <?php } ?>

        </div><!-- // featured_posts_slider -->
    </div>
    <!--End featured_slider -->
</div>

<!-- Latest Shots -->
<div class="container">
    <div class="col-md-6 ">
        <div class="box-shadow margin-bottom-40">
            <div class="featured_title text-white" style="margin-bottom: 10px;">
                <!-- featured_title -->
                <h4 style="color: #005267;">GALERI FOTO</h4> <a href="<?= base_url() ?>/galeri/foto" class="view_button">LIHAT ARSIP</a>
            </div>
            <!-- // featured_title -->
            <div class="margin-bottom-3">
                <div id="myCarousel-2" class="carousel slide carousel-v1">
                    <div class="carousel-inner">
                        <?php foreach ($galeri as $key => $value) { ?>
                            <!-- <div class="item active"> -->
                            <div class="item <?php echo ($key == 0) ? "active" : ""; ?> ">
                                <a href="<?= base_url('galeri/foto_detail/' . $value['id_galeri']) ?>"><img class=" img-responsive img-fluid" width="100%" style="height: 320px;" src="<?= base_url() ?>/media/galeri/<?= $value['gambar']; ?>" alt=""></a>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="carousel-arrow">
                        <a class="left carousel-control" href="#myCarousel-2" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right carousel-control" href="#myCarousel-2" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/col-md-4-->

    <!--Video -->
    <div class="col-md-6 ">
        <div class="box-shadow">
            <div class="featured_title text-white" style="margin-bottom: 10px;">
                <!-- featured_title -->
                <h4 style="color: #005267;">GALERI VIDEO</h4> <a href="<?= base_url() ?>/galeri/video" class="view_button">LIHAT ARSIP</a>
            </div>
            <!-- // featured_title -->
            <div class="margin-bottom-3">
                <div id="myCarousel-3" class="carousel slide carousel-v1">
                    <div class="carousel-inner">
                        <?php foreach ($video as $key => $value) { ?>
                            <div class="item <?php echo ($key == 0) ? "active" : ""; ?> ">
                                <div class="responsive-video margin-bottom-30">
                                    <?php
                                    $url = $value['url'];
                                    parse_str(parse_url($url, PHP_URL_QUERY), $url);
                                    $id = $url['v'];  ?>
                                    <a href="<?= base_url('galeri/video_detail/' . $value['id']) ?>" rel="gallery1" title="Image1">
                                        <span><img src="https://img.youtube.com/vi/<?php echo $id; ?>/hqdefault.jpg" width="100%"></span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="carousel-arrow">
                        <a class="left carousel-control" href="#myCarousel-3" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right carousel-control" href="#myCarousel-3" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/col-md-4-->
</div>
<!--End Video-->


<div id="modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php foreach ($popup as $key => $value) { ?>
                <div class="modal-body">
                    <img style="width: 100%;" src="<?= base_url() ?>/media/popup/<?= $value['gambar']; ?>">
                </div>
            <?php } ?>
        </div>
    </div>
</div>