 <!-- Four Columns -->
 <div class="container content">
     <div class="col-md-9">
         <div class="box-shadow margin-bottom-30">
             <div class="heading-headline">
                 <h4 style="color: #fff;">GALERI VIDEO</h4>
             </div>

             <div class="row  margin-bottom-30">
                 <div class="col-sm-12 sm-margin-bottom-30">
                     <div class="wow zoomIn responsive-video">
                         <?php
                            $url = $videodetail['url'];
                            parse_str(parse_url($url, PHP_URL_QUERY), $url);
                            $id = $url['v'];  ?>
                         <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $id; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                     </div>
                 </div>
             </div>
             <h3><b><?= $videodetail['judul']; ?></b></h3>
             <br>
             <p><?= $videodetail['deskripsi']; ?></p>
         </div>
     </div>
 </div>

 <!-- End Four Columns -->