<!-- Four Columns -->
<div class="container content">
    <div class="box-shadow">
        <div class="heading-headline">
            <h4 style="color: #fff;"><?= $fotojudul['judul'] ?></h4>
        </div>
        <div class="row margin-bottom-30">
            <?php foreach ($fotodetail as $key => $value) { ?>
                <div class="col-sm-3 sm-margin-bottom-30">
                    <a href="<?= base_url() ?>/media/galeri/<?= $value['gambar']; ?>" rel="gallery2" class="fancybox img-hover-v1" title="Image 1">
                        <span><img class="wow pulse img-responsive" src="<?= base_url() ?>/media/galeri/<?= $value['gambar']; ?>" alt="" style="height:220px; width:100%"></span>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- End Four Columns -->


<!-- Four Columns -->
<div class="container content margin-bottom-30">
    <div class="box-shadow">
        <div class="heading-headline">
            <h4 style="color: #fff;">ALBUM FOTO LAINNYA</h4>
        </div>
        <div class="row  margin-bottom-30">
            <?php foreach ($album as $key => $value) { ?>
                <div class="col-sm-3 sm-margin-bottom-30">
                    <a href="<?= base_url('galeri/foto_detail/' . $value['id_galeri']) ?>" rel="gallery2" class="fancybox img-hover-v1" title="Image 1">
                        <span><img class="wow pulse img-responsive" src="<?= base_url() ?>/media/galeri/<?= $value['gambar']; ?>" alt="" style="height:160px; width:100%"></span>
                    </a>
                    <div class="text-center">
                        <h5><b><?= $value['judul']; ?></b></h5>
                        <ul class="list-unstyled list-inline blog-info" style="margin-top: 8px;">
                            <li style="color:#333"><i class="fa fa-calendar"></i> <?= format_indo($value['tanggal']); ?></li>
                            <li style="color:#333"><i class="fa fa-image"></i> 0 Foto</li>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- End Four Columns -->