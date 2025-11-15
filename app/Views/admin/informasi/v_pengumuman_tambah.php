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
                    <form role="form" action="<?= base_url('admin/informasi/pengumuman_save'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group col-sm-10">
                            <label>Judul</label>
                            <input class="form-control" type="text" name="judul" value="<?= old('judul'); ?>">
                        </div>
                        <div class="form-group col-sm-8">
                            <label>Gambar</label>
                            <input type="file" class="form-control" name="gambar">
                        </div>
                        <div class="form-group col-sm-11">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" id="editor"><?= old('deskripsi'); ?></textarea>
                        </div>
                        <br>
                        <div class="form-group col-sm-3">
                            <label>Tampilkan Formulir Pendaftaran</label>
                            <select class="form-control" id="business_website" name="form" role="button">
                                <option value="no">Jangan</option>
                                <option value="yes">Tampilkan</option>
                            </select>
                        </div>
                        <div id="form_judul" class="form-group col-sm-10">
                            <label>Judul Formulir</label>
                            <input class="form-control" type="text" name="form_judul">
                        </div>
                        <div id="form_batas" class="form-group col-sm-3">
                            <label>Batas Waktu pendaftaran</label>
                            <input class="form-control" type="date" name="batas_pendaftaran">
                        </div>
                        <div class="card-action col-sm-3">
                            <button type="submit" class="btn btn-primary btn-sm "> <i class="fas fa-paper-plane"></i> Simpan</button>
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
    $("#form_judul").hide();
    $("#form_batas").hide();
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