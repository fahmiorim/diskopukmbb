<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <!-- Default Card Example -->
            <div class="card mb-4">
                <div class="card-header">
                    <?= $title ?> <?= $perizinan['judul'] ?>
                </div>
                <div class="card-body">
                    <!-- form start-->
                    <?php
                    $request = \Config\Services::request(); { ?>
                        <form role="form" action="<?= base_url('admin/' . $menu . '/save_izin/' .  $request->uri->getSegment(4)); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group col-sm-10">
                                <label>Judul</label>
                                <input class="form-control" type="text" name="judul" value="<?= old('judul'); ?>">
                            </div>
                            <div class="form-group col-sm-11">
                                <label>Deskripsi</label>
                                <textarea name="isi_halaman" id="editor"><?= old('isi_halaman'); ?></textarea>
                            </div>
                            <div class="form-group col-sm-8">
                                <label>Gambar</label>
                                <input type="file" class="form-control" name="gambar">
                            </div>
                            <br>
                            <div class="card-action col-sm-3">
                                <button type="submit" class="btn btn-primary btn-sm "> <i class="fas fa-paper-plane"></i> Simpan</button>

                                <a href="<?= base_url('admin/' . $menu . '/list_izin/'  .  $request->uri->getSegment(4)) ?>" class="btn btn-danger btn-sm"> <i class="fa fa-reply"></i> Cancel</a>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->