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
                    <form role="form" action="<?= base_url('admin/' . $menu . '/edu_update/' . $eduedit['id']); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group col-sm-10">
                            <label>Judul</label>
                            <input class="form-control" type="text" name="judul" value="<?= $eduedit['judul']; ?>">
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Jenis</label>
                            <select class="custom-select" role="button" name="jenis" id="jenis">
                                <option disabled selected>Pilih</option>
                                <option value="baca" <?php if ("baca" == $eduedit['jenis']) echo "selected" ?>>Bahan Baca</option>
                                <option value="video" <?php if ("video" == $eduedit['jenis']) echo "selected" ?>>Video</option>
                                <option value="elearning" <?php if ("elearning" == $eduedit['jenis']) echo "selected" ?>>E-learning</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-10" id="link">
                            <label>Link</label>
                            <input class="form-control" type="text" name="link" value="<?= $eduedit['link']; ?>">
                        </div>
                        <div class="form-group col-sm-10" id="file">
                            <label>File</label>
                            <input class="form-control" type="file" name="filebaca">
                        </div>
                        <div class="form-group col-sm-11">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi"><?= $eduedit['deskripsi']; ?></textarea>
                        </div>
                        <div class="form-group col-sm-11">
                            <label>Materi</label>
                            <textarea name="materi" id="editor"><?= $eduedit['materi']; ?></textarea>
                        </div>
                        <div class="form-group col-sm-8">
                            <label>Gambar</label>
                            <input type="file" class="form-control" name="gambar">
                        </div>
                        <br>
                        <div class="card-action col-sm-3">
                            <button type="submit" class="btn btn-primary btn-sm "> <i class="fas fa-paper-plane"></i> Simpan</button>
                            <a href="<?= base_url('admin/' . $menu . '/edu') ?>" class="btn btn-danger btn-sm"> <i class="fa fa-reply"></i> Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script>
    $("#file").hide();
    $("#link").hide();
    $('#jenis').on('change', function() {
        var value = $(this).val();
        if (value == "elearning") {
            $("#file").hide();
            $("#link").show();
        } else if (value == "video") {
            $("#file").hide();
            $("#link").show();
        } else {
            $("#file").show();
            $("#link").hide();
        }
    });
</script>