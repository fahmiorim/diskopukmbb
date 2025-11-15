 <!-- Four Columns -->
 <div class="container content">
     <div class="box-shadow margin-bottom-30">
         <div class=" heading-headline">
             <h4 style="color: #fff;">GALERI VIDEO</h4>
         </div>

         <div class="row  margin-bottom-30">
             <?php foreach ($video as $key => $value) { ?>
                 <div class="col-sm-4 sm-margin-bottom-30">
                     <div class="wow zoomIn">
                         <a href="video_detail" rel="gallery1" class="fancybox img-hover-v1" title="Image 1">
                             <?php
                                $url = $value['url'];
                                parse_str(parse_url($url, PHP_URL_QUERY), $url);
                                $id = $url['v'];  ?>
                             <a href="<?= base_url('galeri/video_detail/' . $value['id']) ?>" rel="gallery1" title="<?= $value['judul'] ?>">
                                 <span><img src="https://img.youtube.com/vi/<?php echo $id; ?>/hqdefault.jpg" width="100%"></span>
                             </a>
                     </div>
                     <div class="text-judul margin-bottom-50">
                         <div class="text-center">
                             <h5><b><?= $value['judul'] ?></b></h5>
                         </div>
                     </div>
                 </div>
             <?php } ?>

         </div>

         <!-- Pagination -->
         <div class="text-center">
             <ul class="pagination rounded-4x">
                 <?php if ($pager) : ?>
                     <?php $pagi_path = '/galeri/video/'; ?>
                     <?php $pager->setPath($pagi_path); ?>
                     <?= $pager->links() ?>
                 <?php endif ?>
             </ul>
         </div>
         <!-- End Pagination -->
     </div>
 </div>

 <!-- End Four Columns -->