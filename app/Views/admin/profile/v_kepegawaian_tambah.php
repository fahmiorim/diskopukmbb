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
                    <form role="form" action="<?= base_url('admin/profile/kepegawaian_save'); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group col-md-12 text-center">
                                    <img id="blah" src=<?= base_url('./media/no_image.jpg'); ?> class="" width="300" height="250" />
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Foto</label>
                                    <input type="file" name="foto" value="<?= old('nip'); ?>" class="form-control tambah" id="file" onchange="readURL(this);" accept=".png, .jpg, .jpeg" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">NIP</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="nip" value="<?= old('nip'); ?>">
                                    </div>
                                </div>
                                <div class=" form-group row">
                                    <label class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="nama" value="<?= old('nama'); ?>">
                                    </div>
                                </div>
                                <div class=" form-group row">
                                    <label class="col-sm-2 col-form-label">Jabatan</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="jabatan" value="<?= old('jabatan'); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Gologan</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" type="text" name="golongan" required>
                                            <option selected>Pilih Golongan</option>
                                            <option value="I/A">I/A</option>
                                            <option value="I/B">I/B</option>
                                            <option value="I/C">I/C</option>
                                            <option value="I/D">I/D</option>
                                            <option value="II/A">II/A</option>
                                            <option value="II/B">II/B</option>
                                            <option value="II/C">II/C</option>
                                            <option value="II/D">II/D</option>
                                            <option value="III/A">II/A</option>
                                            <option value="III/B">II/B</option>
                                            <option value="III/C">II/C</option>
                                            <option value="III/D">II/D</option>
                                            <option value="IV/A">IV/A</option>
                                            <option value="IV/B">IV/B</option>
                                            <option value="IV/C">IV/C</option>
                                            <option value="IV/D">IV/D</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" type="text" name="status" required>
                                            <option selected>Pilih Status</option>
                                            <option value="Aktif">Aktif</option>
                                            <option value="Tidak Aktif">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Urutan</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" name="urutan" value="<?= old('urutan'); ?>">
                                    </div>
                                </div>
                                <div class="form-group float-right">
                                    <button type="submit" class="btn btn-primary btn-sm "> <i class="fas fa-paper-plane"></i> Simpan</button>
                                    <a href="<?= base_url('admin/profile/kepegawaian') ?>" class="btn btn-danger btn-sm"> <i class="fa fa-reply"></i> Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->