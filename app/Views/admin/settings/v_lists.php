<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <?php foreach ($settings as $key => $value) { ?>
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Data Profil Instansi</h6>
                </div>
                <div class="swal" data-swal="<?= session()->getFlashdata('success') ?>"></div>
                <div class="card-body">
                    <form role="form" action="<?= base_url('admin/settings/update'); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group col-sm-12">
                                    <label>Pemerintah</label>
                                    <input class="form-control" type="text" name="aplikasi" value="<?= $value['aplikasi']; ?>" required>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Nama Instansi</label>
                                    <input class="form-control" type="text" name="instansi" value="<?= $value['instansi']; ?>" required>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>URL Website</label>
                                    <input class="form-control" type="text" name="website" value="<?= $value['website']; ?>" required>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Alamat</label>
                                    <input class="form-control" type="text" name="alamat" value="<?= $value['alamat']; ?>" required>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Telfon</label>
                                    <input class="form-control" type="text" name="telfon" value="<?= $value['telfon']; ?>" required>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Email</label>
                                    <input class="form-control" type="text" name="email" value="<?= $value['email']; ?>" required>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Keyword</label>
                                    <textarea rows="2" class="form-control" type="text" name="keyword"><?= $value['keyword']; ?></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group col-sm-12">
                                    <label>Deskripsi Singkat</label>
                                    <textarea rows="4" class="form-control" type="text" name="deskripsi"><?= $value['deskripsi']; ?></textarea>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Script Google Maps</label>
                                    <textarea rows="4" class="form-control" type="text" name="maps"><?= $value['maps']; ?></textarea>
                                </div>
                                <div class="form-group col-sm-12">
                                    <img id="blah" src=<?= base_url('./media/settings/' . $value['logo']); ?> class="img-fluid bg-gradient-primary" width="500" />
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Logo</label>
                                    <input type="file" name="logo" class="form-control tambah" id="file" onchange="readURL(this);" accept=".png, .jpg, .jpeg" />
                                </div>
                                <div class="form-group col-sm-12 card-action">
                                    <button type="submit" class="btn btn-primary btn-sm"> <i class="fas fa-paper-plane"></i> Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
</div>


<!-- /.container-fluid -->