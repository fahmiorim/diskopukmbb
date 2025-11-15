 <!-- Four Columns -->
 <div class="container content">
     <div class="box-shadow margin-bottom-30">
         <div class="heading-headline">
             <h4 style="color: #fff;">ALBUM GALERI FOTO</h4>
         </div>
         <div class="row margin-bottom-30 ">
             <?php foreach ($galeri as $key => $value) { ?>
                 <div class="col-sm-4 sm-margin-bottom-50">
                     <a href="<?= base_url('galeri/foto_detail/' . $value['id_galeri']) ?>" rel="gallery2" class="fancybox img-hover-v1" title="Image 1">
                         <span><img class="wow pulse img-responsive img-center" src="<?= base_url() ?>/media/galeri/<?= $value['gambar']; ?>" alt="" style="height:220px; width:100%; border: 5px solid #ddd;"></span>
                     </a>
                     <div class="text-center">
                         <h5><b><?= $value['judul']; ?></b></h5>
                         <ul class="list-unstyled list-inline blog-info" style="margin-top: 8px;">
                             <li style="color:#333"><i class="fa fa-calendar "></i> <?= format_indo($value['tanggal']); ?></li>
                             <li style="color:#333"><i class="fa fa-image"></i> 0 Foto</li>
                         </ul>
                     </div>
                 </div>
             <?php } ?>
         </div>
         <!-- Pagination -->
         <div class="text-center">
             <ul class="pagination rounded-4x">
                 <?php if ($pager) : ?>
                     <?php $pagi_path = '/galeri/foto/'; ?>
                     <?php $pager->setPath($pagi_path); ?>
                     <?= $pager->links() ?>
                 <?php endif ?>
             </ul>
         </div>
         <!-- End Pagination -->
     </div>
 </div>
 <!-- End Four Columns -->