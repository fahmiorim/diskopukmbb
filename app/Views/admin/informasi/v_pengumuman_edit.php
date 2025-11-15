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
                    <form role="form" action="<?= base_url('admin/informasi/pengumuman_update/' . $pengumuman['id']); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group col-sm-10">
                            <label>Judul</label>
                            <input class="form-control" type="text" name="judul" value="<?= $pengumuman['judul'] ?>" required>
                        </div>
                        <div class="form-group col-sm-8">
                            <label>Ganti Gambar</label>
                            <input type="file" class="form-control" name="gambar">
                        </div>
                        <div class="form-group col-sm-12">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" id="editor" required><?= $pengumuman['deskripsi'] ?></textarea>
                        </div>

                        <div class="form-group col-sm-3">
                            <label>Tampilkan Formulir Pendaftaran</label>
                            <select class="form-control" id="business_website" name="form" role="button">
                                <option value="no">Jangan</option>
                                <option value="yes" <?php if ($pengumuman['form'] == "yes") echo "selected" ?>>Tampilkan</option>
                            </select>
                        </div>
                        <div id="form_judul" class="form-group col-sm-10">
                            <label>Judul Formulir</label>
                            <input class="form-control" type="text" name="form_judul" value="<?= $pengumuman['form_judul'] ?>">
                        </div>
                        <div id="form_batas" class="form-group col-sm-3">
                            <label>Batas Waktu pendaftaran</label>
                            <input class="form-control" type="date" name="batas_pendaftaran" value="<?= $pengumuman['batas_pendaftaran'] ?>">
                        </div>

                        <br>
                        <div class="card-action col-sm-3 ">
                            <button type="submit" class="btn btn-primary btn-sm "> <i class="fas fa-paper-plane"></i> Update</button>
                            <a href="<?= base_url('admin/informasi/pengumuman') ?>" class="btn btn-danger btn-sm"> <i class="fa fa-reply"></i> Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script>
    // $("#form_judul").hide();
    // $("#form_batas").hide();

    $('#business_website').on('change', function() {
        var value = $(this).val();
        if (value == "no") {
            $("#form_judul").hide();
            $("#form_batas").hide();
        } else if (value == "yes") {
            $("#form_judul").show();
            $("#form_batas").show();
        }
    });
</script>