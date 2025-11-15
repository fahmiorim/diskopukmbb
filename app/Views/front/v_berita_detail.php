<div class="container content">
    <div class="row magazine-page">
        <?php foreach ($detail as $key => $value) { ?>
            <div class="col-md-8 isiberita">
                <div class="wow fadeInUp">
                    <div class="tag-box tag-box-v2 box-shadow shadow-effect-1 ">
                        <!-- News v3 -->
                        <div class="news-v3 bg-color-white margin-bottom-30">
                            <img class="img-responsive gambarisiberita" src="<?= base_url() ?>/media/berita/<?= $value['gambar']; ?>" width="100%" alt="">
                            <div class='news-v3-in'>
                                <h3><strong><?= $value['judul']; ?></strong></h3>
                            </div>
                            <div class="by-author">
                                <strong><i class="fa fa-pencil-square-o"></i> <?= $value['user']; ?></strong>
                                <span>&nbsp;/ <i class="fa fa-calendar"></i> <?= format_indo($value['tanggal']); ?></span>
                                <span>&nbsp;/ <i class="fa fa-eye"></i> dibaca <?= $value['dilihat']; ?>x</span>
                            </div>
                            <p><?= $value['isi_berita']; ?></p>
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
                        <h2 class="title-v4" style="color: #fff;">TERPOPULER</h2>
                        <?php foreach ($populer as $key => $value) { ?>
                            <div class="blog-thumb-v3">
                                <small>Di Baca <?= $value['dilihat']; ?> x</small>
                                <h5><a href="<?= base_url() ?>/berita/detail/<?= $value['judul_seo']; ?>"><?= $value['judul']; ?></a></h5>
                            </div>
                            <hr class="hr-xs">
                        <?php } ?>

                    </div>
                </div>
            </div>
            <!-- End Blog Thumb v3 -->
        </div>

        <div class="col-md-4">
            <div class="wow fadeInRight">
                <div class="box-shadow margin-bottom-30">
                    <div class="featured_title text-white" style="margin-bottom: 10px;">
                        <!-- featured_title -->
                        <h4 style="color: #005267;">BERITA LAINNYA</h4> <a href="<?= base_url() ?>/berita"></a>
                    </div>
                    <div class="blog-thumb">
                        <div class="blog-thumb margin-bottom-10">
                            <?php foreach ($berita as $key => $value) { ?>
                                <div class="blog-thumb-hover">
                                    <img src="<?= base_url() ?>/media/berita/<?= $value['gambar']; ?>" style="width: 90px; height:70px">
                                    <a class="hover-grad" href="<?= base_url() ?>/berita/detail/<?= $value['judul_seo']; ?>"></a>
                                </div>
                                <div class="blog-thumb-desc">
                                    <h3><a href="<?= base_url() ?>/berita/detail/<?= $value['judul_seo']; ?>"><?= substr(strip_tags($value['judul']), 0, 53) ?>...</a></h3>
                                    <ul class="blog-thumb-info">
                                        <li><i class="glyphicon glyphicon-calendar"></i> <?= format_indo($value['tanggal']); ?> </li>
                                    </ul>
                                </div>
                                <hr class="hr-xs">
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>