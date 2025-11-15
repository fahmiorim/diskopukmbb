<div class="container content">
    <div class="row magazine-page">
        <?php foreach ($detail as $key => $value) { ?>
            <div class="col-md-8 isiberita">
                <div class="wow fadeInUp">
                    <div class="tag-box tag-box-v2 box-shadow shadow-effect-1 ">
                        <!-- News v3 -->
                        <div class="news-v3 bg-color-white margin-bottom-30">
                            <img class="img-responsive gambarisiberita" src="<?= base_url() ?>/media/pelatihan/<?= $value['gambar']; ?>" width="100%" alt="">
                            <div class='news-v3-in'>
                                <h3><strong><?= $value['training_title']; ?></strong></h3>
                            </div>
                            <div class="row">
                                <label class="col-md-3">Jenis Pelatihan</label>
                                <label class="col-md-6">: <?= $value['training_name'] ?></label>
                            </div>
                            <div class="row">
                                <label class="col-md-3">Tempat Pelaksanaan</label>
                                <label class="col-md-6">: <?= $value['place'] ?></label>
                            </div>
                            <div class="row">
                                <label class="col-md-3">Tanggal Pelaksanaan</label>
                                <label class="col-md-6">: <?= format_indo($value['start_date']) ?> s/d <?= format_indo($value['finish_date']) ?></label>
                            </div>
                            <div class="row">
                                <label class="col-md-3">Kab/Kota Kegiatan</label>
                                <label class="col-md-6">: Kabupaten Batu Bara</label>
                            </div>
                            <div class="row">
                                <label class="col-md-3">Provinsi</label>
                                <label class="col-md-6">: Sumatera Utara</label>
                            </div>
                            <div class="row">
                                <label class="col-md-3">Status</label>
                                <label class="col-md-6">: <?php
                                                            $tgl_now = date("Y-m-d");
                                                            if ($tgl_now > $value['finish_date']) {
                                                                echo 'Pelatihan Berakhir';
                                                            } else {
                                                                if ($tgl_now < $value['start_date']) {
                                                                    echo 'Pelatihan Akan Segera di mulai';
                                                                } else {
                                                                    echo 'Pelatihan Berlangsung';
                                                                }
                                                            }

                                                            ?></label>
                            </div>
                        </div>
                        <hr class="hr-xs">
                        <ul class="social-icons">
                            <div class="fb-share-button" data-href="<?= base_url() ?>/berita/detail/<?= $value['training_title_seo']; ?>" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
                        </ul>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="swal" data-swal="<?= session()->getFlashdata('success') ?>"></div>

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
                            <h5><a href="<?= base_url() ?>/informasi/pengumuman_detail/<?= $value['judul_seo']; ?>" target="blank"><?= $value['judul']; ?></a></h5>
                        </div>

                    <?php } ?>
                </div>
            </div>
            <!-- End Blog Thumb v3 -->
        </div>
    </div>
</div>