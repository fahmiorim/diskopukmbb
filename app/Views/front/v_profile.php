<div class="container content">
    <div class="row magazine-page">
        <?php foreach ($profiles as $key => $value) { ?>
            <div class="col-md-8 isiberita">
                <div class="wow fadeInUp">
                    <div class="tag-box tag-box-v2 box-shadow shadow-effect-1 ">
                        <!-- News v3 -->
                        <div class="news-v3 bg-color-white margin-bottom-30">
                            <img class="img-responsive gambarisiberita" src="<?= base_url() ?>/media/profile/<?= $value['gambar']; ?>" width="100%" alt="">
                            <div class='news-v3-in'>
                                <h3><strong><?= $value['judul']; ?></strong></h3>
                            </div>
                            <p><?= $value['isi_halaman']; ?></p>
                        </div>
                        <hr class="hr-xs">
                        <ul class="social-icons">
                            <div class="fb-share-button" data-href="<?= base_url() ?>/berita/detail/<?= $value['judul_seo']; ?>" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
                        </ul>
                    </div>
                </div>
            </div>
        <?php } ?>

        <!-- Blog Thumb v3 -->
        <div class="col-md-4">
            <div class="wow fadeInRight">
                <div class="tag-box tag-box-v2 box-shadow shadow-effect-1" style="background: linear-gradient( 90deg, rgba(0,77,149,255) 0%, rgba(2,103,185,255) 100%, rgba(0,77,149,255) 100% );">
                    <div class="margin-bottom-30">
                        <a href="<?= base_url() ?>/berita">
                            <h2 class="title-v4" style="color: #fff;">BERITA TERPOPULER</h2>
                        </a>
                        <?php foreach ($populer as $key => $value) { ?>
                            <hr class="hr-xs">
                            <div class="blog-thumb-v3">
                                <small><?= format_indo($value['tanggal']); ?> / Di Baca <?= $value['dilihat']; ?> x</small>
                                <h5><a href="<?= base_url() ?>/berita/detail/<?= $value['judul_seo']; ?>"><?= $value['judul']; ?></a></h5>

                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <!-- End Blog Thumb v3 -->
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
                            <h5><a href="<?= base_url() ?>/informasi/pengumuman_detail/<?= $value['id']; ?>" target="blank"><?= $value['judul']; ?></a></h5>
                        </div>

                    <?php } ?>
                </div>
            </div>
            <!-- End Blog Thumb v3 -->
        </div>

    </div>
</div>