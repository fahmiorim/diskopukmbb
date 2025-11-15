<div class="container content">
    <div class="d-flex flex-row row">
        <div class="d-flex flex-column col-md-8">
            <div class="magazine-news">
                <?php
                $numOfCols = 2;
                $rowCount = 0;
                $bootstrapColWidth = 12 / $numOfCols;
                foreach ($pengumuman as $key => $value) {
                    if ($rowCount % $numOfCols == 0) { ?> <div class="row margin-bottom-10"> <?php }
                                                                                            $rowCount++; ?>
                        <div class="col-md-<?php echo $bootstrapColWidth; ?>">
                            <div class="wow fadeInUp">
                                <div class="box-shadow margin-bottom-20 ">
                                    <div class="magazine-news-img">
                                        <a href="<?= base_url() ?>/informasi/pengumuman_detail/<?= $value['id']; ?>" rel="gallery2" class="fancybox img-hover-v1">
                                            <span><img class="img-responsive" src="<?= base_url() ?>/media/pengumuman/<?= $value['gambar']; ?>" alt=""></span>
                                        </a>
                                    </div>
                                    <h3><a href="<?= base_url() ?>/informasi/pengumuman_detail/<?= $value['id']; ?>"><?= $value['judul']; ?></a></h3>
                                    <div class="by-author">
                                        <strong><?= $value['user']; ?></strong>
                                        <span>/ <?= format_indo($value['tanggal']); ?></span>
                                    </div>
                                    <p><?= substr(strip_tags($value['judul']), 0, 230) ?>...</p>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($rowCount % $numOfCols == 0) { ?>

                        </div> <?php }
                        } ?>
            </div>

            <!-- Pagination -->
            <div class="text-center">
                <ul class="pagination rounded-4x">
                    <?php if ($pager) : ?>
                        <?php $pagi_path = '/informasi/pengumuman/'; ?>
                        <?php $pager->setPath($pagi_path); ?>
                        <?= $pager->links() ?>
                    <?php endif ?>
                </ul>
            </div>
            <!-- End Pagination -->
        </div>


        <!-- Blog Thumb v3 -->
        <div class="col-md-4">
            <div class="wow fadeInRight">
                <div class="tag-box tag-box-v2 box-shadow shadow-effect-1" style="background: linear-gradient( 90deg, rgba(0,77,149,255) 0%, rgba(2,103,185,255) 100%, rgba(0,77,149,255) 100% );">
                    <h2 class="title-v4" style="color: #fff;">PERATURAN</h2>
                    <?php foreach ($peraturan as $key => $value) { ?>
                        <hr class="hr-xs">
                        <div class="blog-thumb-v3">
                            <h3><a href="<?= base_url() ?>/media/peraturan/<?= $value['file']; ?>" target="blank"><?= $value['judul']; ?></a></h3>
                        </div>

                    <?php } ?>
                </div>
            </div>
            <!-- End Blog Thumb v3 -->
        </div>
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