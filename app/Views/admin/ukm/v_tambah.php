<?php 
helper('form'); // Load the form helper
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('admin/ukm') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <?php 
                $errors = session()->getFlashdata('error');
                if (is_array($errors)) {
                    echo '<ul class="mb-0">';
                    foreach ($errors as $error) {
                        echo '<li>' . esc($error) . '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo esc($errors);
                }
            ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data UKM</h6>
                </div>
                <div class="card-body">
                    <form id="formTambah" action="<?= base_url('admin/ukm/save') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_umkm">Nama UMKM <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?= session('errors.name_umkm') ? 'is-invalid' : '' ?>" 
                                           id="name_umkm" name="name_umkm" value="<?= old('name_umkm', '') ?>" required>
                                    <?php if (session('errors.name_umkm')): ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.name_umkm') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="id_number">ID UMKM</label>
                                    <input type="text" class="form-control" id="id_number" name="id_number" 
                                           value="<?= old('id_number', '') ?>">
                                </div>

                                <div class="form-group">
                                    <label for="owner_name">Nama Pemilik <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?= session('errors.owner_name') ? 'is-invalid' : '' ?>" 
                                           id="owner_name" name="owner_name" value="<?= old('owner_name', '') ?>" required>
                                    <?php if (session('errors.owner_name')): ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.owner_name') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="phone">No. Telepon <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control <?= session('errors.phone') ? 'is-invalid' : '' ?>" 
                                           id="phone" name="phone" value="<?= old('phone', '') ?>" required>
                                    <?php if (session('errors.phone')): ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.phone') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address_umkm">Alamat UMKM <span class="text-danger">*</span></label>
                                    <textarea class="form-control <?= session('errors.address_umkm') ? 'is-invalid' : '' ?>" 
                                              id="address_umkm" name="address_umkm" rows="3" required><?= old('address_umkm', '') ?></textarea>
                                    <?php if (session('errors.address_umkm')): ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.address_umkm') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
                                    <select class="form-control <?= session('errors.kecamatan') ? 'is-invalid' : '' ?>" 
                                            id="kecamatan" name="kecamatan" required>
                                        <option value="">-- Pilih Kecamatan --</option>
                                        <?php foreach ($kecamatan as $kec): ?>
                                            <option value="<?= $kec['id'] ?>" <?= old('kecamatan') == $kec['id'] ? 'selected' : '' ?>>
                                                <?= esc($kec['nama_kecamatan']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (session('errors.kecamatan')): ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.kecamatan') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="gambar">Gambar UMKM</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input <?= session('errors.gambar') ? 'is-invalid' : '' ?>" 
                                               id="gambar" name="gambar" onchange="previewImage(this)">
                                        <label class="custom-file-label" for="gambar">Pilih file...</label>
                                        <small class="form-text text-muted">Format: JPG/PNG, maksimal 2MB</small>
                                        <?php if (session('errors.gambar')): ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.gambar') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mt-2 text-center">
                                        <img id="imagePreview" src="<?= base_url('media/no_image.jpg') ?>" 
                                             class="img-fluid rounded border" style="max-height: 150px;" alt="Preview Gambar">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Kecamatan <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="districts_city_name" value="<?= old('districts_city_name'); ?>" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Nomor Telepon <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="phone_number" value="<?= old('phone_number'); ?>" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" value="<?= old('email'); ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>NIB</label>
                            <input class="form-control" type="text" name="nib_umkm" value="<?= old('nib_umkm'); ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>NPWP</label>
                            <input class="form-control" type="text" name="npwp_umkm" value="<?= old('npwp_umkm'); ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>ID Number <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="id_number" value="<?= old('id_number'); ?>" required>
                        </div>
                        <br>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="<?= base_url('admin/ukm') ?>" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary" id="btnSubmit">
                                        <i class="fas fa-save mr-1"></i> Simpan Data
                                        <span id="loadingIndicator" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    </button>
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