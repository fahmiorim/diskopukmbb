<div class="body-bg">
    <div class="container content ">
        <?php
        $numOfCols = 4;
        $rowCount = 0;
        $bootstrapColWidth = 12 / $numOfCols;
        foreach ($pegawai as $key => $value) {
            if ($rowCount % $numOfCols == 0) { ?> <div class="row margin-bottom-30"> <?php }
                                                                                    $rowCount++; ?>
                <div class="col-lg-<?php echo $bootstrapColWidth; ?>">
                    <div class="service-item first-service wow fadeInUp">
                        <img class="img-responsive margin-bottom-20" style="border-radius: 50px;" src="<?= base_url() ?>/media/kepegawaian/<?= $value['foto']; ?>" alt="">
                        <div class="text-center">
                            <h5><?= $value['jabatan']; ?></h5>
                            <h4><?= $value['nama']; ?></h4>
                        </div>
                    </div>
                </div>
                <?php
                if ($rowCount % $numOfCols == 0) { ?>
                </div> <?php }
                } ?>
    </div>
</div>