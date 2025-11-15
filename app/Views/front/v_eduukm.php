 <!-- Four Columns -->
 <div class="container content">
     <div class="box-shadow margin-bottom-30">
         <div class="heading-headline">
             <h4 style="color: #fff;"><?= $title ?></h4>
         </div>
         <div class="row margin-bottom-30 ">
             <?php foreach ($eduukm as $key => $value) { ?>
                 <div class="col-sm-4 sm-margin-bottom-50">
                     <a href="<?= base_url('edu/ukm_detail/' . $value['judul_seo']) ?>" rel="gallery2" class="fancybox img-hover-v1" title="<?= $value['judul'] ?>">
                         <span><img class="wow pulse img-responsive img-center" src="<?= base_url() ?>/media/eduukm/<?= $value['gambar']; ?>" alt="" style="border-radius: 10px; width: 220px; height: 220px;overflow: hidden; position: relative; border: 5px solid #ddd;"></span>
                     </a>
                     <div class="text-center">
                         <h5><b><?= $value['judul']; ?></b></h5>
                     </div>
                 </div>
             <?php } ?>
         </div>
         <!-- Pagination -->
         <div class="text-center">
             <ul class="pagination rounded-4x">
                 <?php if ($pager) : ?>
                     <?php $pagi_path = '/edu/ukm/'; ?>
                     <?php $pager->setPath($pagi_path); ?>
                     <?= $pager->links() ?>
                 <?php endif ?>
             </ul>
         </div>
         <!-- End Pagination -->
     </div>
 </div>
 <!-- End Four Columns -->