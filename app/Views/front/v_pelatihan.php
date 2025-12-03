<!-- Three Columns -->
<div class="container content">
    <div class="tag-box tag-box-v7 text-justify">
        <?php
        $numOfCols = 4;
        $rowCount = 0;
        $bootstrapColWidth = 12 / $numOfCols;
        foreach ($pelatihan as $row) {
            if ($rowCount % $numOfCols == 0) { ?> <div class="row  margin-bottom-30"> <?php }
                                                                                    $rowCount++; ?>
                <div class="col-sm-<?php echo $bootstrapColWidth; ?> sm-margin-bottom-30">
                    <a href="<?= base_url() ?>/pelatihan/detail/<?= $row['training_title_seo']; ?>" rel="gallery1" class="fancybox img-hover-v1" title="<?= $row['training_title']; ?>">
                        <span><img class="img-responsive" src="<?= base_url() ?>/media/pelatihan/<?= $row['gambar']; ?>"></span>

                        <div class="text-center">
                            <h5><b><?= $row['training_title']; ?></b></h5>
                    </a>
                    <small><?= format_indo($row['start_date']) ?> s/d <br>
                        <?= format_indo($row['finish_date']) ?></small><br>
                    <small>Kategori : <span style=" line-height: 2;"><?= $row['training_name'] ?></span></small><br>
                    <?php
                    $tgl_now = date("Y-m-d");
                    if ($tgl_now > $row['finish_date']) {
                        echo '<button class="btn-danger btn-sm" disable>Pelatihan Berakhir</button>';
                    } else {
                        echo '<button class="btn-success btn-sm">Pelatihan Aktif</button>';
                    } ?>
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
            <?php $pagi_path = '/pelatihan'; ?>
            <?php $pager->setPath($pagi_path); ?>
            <?= $pager->links() ?>
        <?php endif ?>
    </ul>
</div>
<!-- End Pagination -->


</div>
</div>
<!-- End Three Columns -->