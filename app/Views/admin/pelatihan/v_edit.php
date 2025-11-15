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

                    <form role="form" action="<?= base_url('admin/pelatihan/update/' . $pelatihan['training_id']); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-2">Jenis Pelatihan</label>
                            <div class="col-sm-8">
                                <select class="custom-select" role="button" name="training_id" value="<?= old('training_id'); ?>">
                                    <option value="<?= $pelatihan['training_category_id']; ?>" selected><?= $pelatihan['training_name']; ?></option>
                                    <?php foreach ($category as $key => $value) { ?>
                                        <option value="<?= $value['training_category_id'] ?>"><?= $value['training_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-2">Judul Pelatihan</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="training_title" value="<?= $pelatihan['training_title']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-2">Tanggal Pelaksanaan</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" name="start_date" value="<?= $pelatihan['start_date']; ?>">
                            </div>
                            <div class="col text-center col-sm-2">Sampai dengan</div>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" name="finish_date" value="<?= $pelatihan['finish_date']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Tempat Pelaksanaan</label>
                            <div class="col-md-8">
                                <input class="form-control" name="place" value="<?= $pelatihan['place']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Gambar</label>
                            <div class="col-md-8">
                                <input type="file" class="form-control" name="gambar">
                            </div>
                        </div>
                        <br>
                        <div class="card-action col-sm-3">
                            <button type="submit" class="btn btn-primary btn-sm "> <i class="fas fa-paper-plane"></i> Simpan</button>
                            <a href="<?= base_url('admin/pelatihan') ?>" class="btn btn-danger btn-sm"> <i class="fa fa-reply"></i> Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->