<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <!-- Default Card Example -->
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
                </div>
                <div class="card-body">
                    <?php if (session()->has('errors')) : ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach (session('errors') as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif ?>

                    <form action="<?= base_url('admin/' . $menu . '/data_save') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Koperasi <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name_koperasi" value="<?= old('name_koperasi') ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">ID Number <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="id_number" 
                                       value="<?= old('id_number') ?>" 
                                       pattern="[A-Za-z0-9]+" 
                                       title="Hanya huruf dan angka yang diperbolehkan" 
                                       required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="address_koperasi" required><?= old('address_koperasi') ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kecamatan <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="districts_city_name" value="<?= old('districts_city_name') ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nomor Telepon</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone_number" value="<?= old('phone_number') ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" value="<?= old('email') ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIB</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nib_koperasi" 
                                       value="<?= old('nib_koperasi') ?>"
                                       pattern="[0-9]+"
                                       title="Hanya angka yang diperbolehkan">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NPWP</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="npwp_koperasi" value="<?= old('npwp_koperasi') ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <a href="<?= base_url('admin/' . $menu . '/data') ?>" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
