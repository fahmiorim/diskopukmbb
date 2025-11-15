<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <!-- Default Card Example -->
            <div class="card mb-4">
                <div class="card-header">
                    <?= $title ?>
                </div>
                <div class="card-body">
                    <!-- form start-->
                    <form role="form" action="<?= base_url('admin/profile/update/' . $profile['id']); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group col-sm-4">
                            <label>Urutan</label>
                            <input class="form-control" type="text" name="urutan" value="<?= $profile['urutan'] ?>" required>
                        </div>
                        <div class="form-group col-sm-10">
                            <label>Judul profile</label>
                            <input class="form-control" type="text" name="judul" value="<?= $profile['judul'] ?>" required>
                        </div>
                        <div class="form-group col-sm-12">
                            <label>Isi profile</label>
                            <textarea name="isi_halaman" id="editor" required><?= $profile['isi_halaman'] ?></textarea>
                        </div>
                        <div class="form-group col-sm-8">
                            <label>Gambar</label><br>
                            <img src="<?= base_url('media/profile/' . $profile['gambar']); ?>" width="300px">
                        </div>
                        <div class="form-group col-sm-8">
                            <label>Ganti Gambar</label>
                            <input type="file" class="form-control" name="gambar">
                        </div>
                        <br>
                        <div class="card-action col-sm-3 ">
                            <button type="submit" class="btn btn-primary btn-sm "> <i class="fas fa-paper-plane"></i> Update</button>
                            <a href="<?= base_url('admin/profile/menu') ?>" class="btn btn-danger btn-sm"> <i class="fa fa-reply"></i> Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->