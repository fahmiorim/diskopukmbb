<div class="container content">
    <div class="row magazine-page">
        <?php foreach ($ukm_detail as $key => $value) { ?>
            <div class="col-md-8 isiberita">
                <div class="wow fadeInUp">
                    <div class="tag-box tag-box-v2 box-shadow shadow-effect-1 ">
                        <!-- News v3 -->
                        <div class="news-v3 bg-color-white margin-bottom-30">
                            <img class="img-responsive" src="<?= base_url() ?>/media/eduukm/<?= $value['gambar']; ?>" width="auto" style=" border-radius: 10px;overflow: hidden; position: relative; border: 5px solid #ddd;" alt="">
                            <div class='news-v3-in'>
                                <h1><strong><?= $value['judul']; ?></strong></h1>
                            </div>
                            <p><?= $value['deskripsi']; ?></p>
                            <h3>Materi :</h3>
                            <p><?= $value['materi']; ?></p>




                            <?php
                            if ($value['link'] == "") { ?>
                                <iframe src="<?= base_url() ?>/media/eduukm/<?= $value['file'] ?>" height="600" width="100%"></iframe>
                            <?php }

                            if ($value['link'] == "https://edukukm.kemenkopukm.go.id/page/signup") { ?>
                                <div class="text-center">
                                    <a href="<?= $value['link'] ?>" class="btn btn-primary btn-sm"> <i class="fa fa-paper-plane"></i> Ikuti</a>
                                </div>
                            <?php  } ?>



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
                        <h2 class="title-v4" style="color: #fff;">BERITA TERPOPULER</h2>
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

    </div>
</div>