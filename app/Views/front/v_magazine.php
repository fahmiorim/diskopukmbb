<!-- Three Columns -->
<div class="container content">
    <div class="tag-box tag-box-v7 text-justify">
        <?php
        $numOfCols = 4;
        $rowCount = 0;
        $bootstrapColWidth = 12 / $numOfCols;
        foreach ($magazine as $row) {
            if ($rowCount % $numOfCols == 0) { ?> <div class="row  margin-bottom-30"> <?php }
                                                                                    $rowCount++; ?>
                <div class="col-sm-<?php echo $bootstrapColWidth; ?> sm-margin-bottom-30">
                    <a href="<?= base_url() ?>/berita/emagazine_detail/<?= $row['judul_seo']; ?>" rel="gallery1" class="fancybox img-hover-v1" title="<?= $row['judul']; ?>">
                        <span><img class="img-responsive" style="height: 340px;" src="<?= base_url() ?>/public/media/emagazine/<?= $row['cover']; ?>"></span>
                    </a>
                    <div class="text-center">
                        <h5><b><?= $row['judul']; ?></b></h5>
                    </div>
                </div>
                <?php
                if ($rowCount % $numOfCols == 0) { ?>
                </div> <?php }
                } ?>
    </div>
    <!--Pegination Centered-->
    <!-- Pagination -->
    <div class="text-center">
        <ul class="pagination rounded-4x">
            <?php if ($pager) : ?>
                <?php $pagi_path = '/berita/emagazine/'; ?>
                <?php $pager->setPath($pagi_path); ?>
                <?= $pager->links() ?>
            <?php endif ?>
        </ul>
    </div>
    <!-- End Pagination -->


</div>
</div>
<!-- End Three Columns -->