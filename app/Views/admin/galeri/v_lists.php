<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#tambah">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Album</span>
                </a>
            </button>
        </div>
        <?php if (session()->has('errors')) : ?>
            <div class="alert alert-danger mx-3 mt-3">
                <ul class="mb-0">
                    <?php foreach (session('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>
        <div class="swal" data-swal="<?= session()->getFlashdata('success') ?>"></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Album</th>
                            <th>Cover Album</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Album</th>
                            <th>Cover Album</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no = 1;
                        foreach ($galeri as $key => $value) { ?>
                            <tr>
                                <td class="align-middle"><?= $no++; ?></td>
                                <td class="align-middle"><?= esc($value['judul']); ?></td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center">
                                        <div class="img-preview" style="width: 150px; height: 100px; overflow: hidden; border-radius: 5px;">
                                            <?php if (!empty($value['gambar']) && file_exists('./media/galeri/' . $value['gambar'])): ?>
                                                <img src="<?= base_url('media/galeri/' . $value['gambar']) ?>" 
                                                     alt="<?= esc($value['judul']) ?>" 
                                                     style="width: 100%; height: 100%; object-fit: cover;">
                                            <?php else: ?>
                                                <div class="bg-light d-flex align-items-center justify-content-center h-100">
                                                    <i class="fas fa-image fa-2x text-muted"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <?php 
                                    $fotoCount = 0;
                                    if (isset($fotoCounts[$value['id_galeri']])) {
                                        $fotoCount = $fotoCounts[$value['id_galeri']];
                                    }
                                    ?>
                                    <span class="badge badge-pill badge-primary"><?= $fotoCount ?> Foto</span>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex flex-column flex-md-row gap-1">
                                        <a href="<?= base_url('admin/galeri/foto/' . $value['id_galeri']) ?>" 
                                           class="btn btn-primary btn-sm mb-1 mb-md-0" 
                                           title="Kelola Foto">
                                            <i class="fas fa-images"></i>
                                        </a>
                                        <button type="button" 
                                                title="Edit Album" 
                                                data-toggle="modal" 
                                                data-target="#edit<?= $value['id_galeri']; ?>" 
                                                class="btn btn-warning btn-sm text-white mb-1 mb-md-0">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" 
                                                title="Hapus Album" 
                                                class="btn btn-danger btn-sm" 
                                                onclick="confirmDelete(<?= $value['id_galeri'] ?>, '<?= addslashes($value['judul']) ?>')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal Tambah -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle"></i> Tambah Album Galeri
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?= base_url('admin/galeri/tambah'); ?>" method="post" enctype="multipart/form-data" id="tambahGaleriForm">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Judul Album <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="judul" 
                                       class="form-control" 
                                       value="<?= old('judul'); ?>" 
                                       required
                                       minlength="3"
                                       maxlength="100"
                                       oninvalid="this.setCustomValidity('Judul album harus diisi (3-100 karakter)')"
                                       oninput="this.setCustomValidity('')">
                                <small class="form-text text-muted">Minimal 3 karakter, maksimal 100 karakter</small>
                            </div>
                            
                            <div class="form-group">
                                <label>Cover Album <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file" 
                                           class="custom-file-input" 
                                           id="gambar" 
                                           name="gambar" 
                                           accept="image/*" 
                                           required
                                           onchange="previewImage(this, 'previewTambah')">
                                    <label class="custom-file-label" for="gambar">Pilih gambar</label>
                                    <small class="form-text text-muted">Format: JPG, JPEG, PNG (Maks. 2MB)</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <div class="img-preview-container" style="max-width: 100%; height: 200px; overflow: hidden; border: 2px dashed #ddd; border-radius: 5px;">
                                    <img id="previewTambah" src="#" alt="Preview Gambar" style="width: 100%; height: 100%; object-fit: contain; display: none;">
                                    <div id="noImageTambah" class="h-100 d-flex flex-column align-items-center justify-content-center">
                                        <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                        <p class="text-muted mb-0">Preview Gambar</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btnSimpanGaleri">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Tambah -->

<!-- Modal Edit -->
<?php foreach ($galeri as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id_galeri']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                            Edit Galeri</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <!-- form start-->
                    <form role="form" action="<?= base_url('admin/galeri/edit/' . $value['id_galeri']); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="form-group col-sm-12">
                            <label>Judul galeri</label>
                            <input class="form-control" type="text" name="judul" placeholder="Judul galeri" value="<?= $value['judul']; ?>">
                        </div>
                        <div class="form-group col-sm-12">
                            <label>Gambar</label>
                            <input type="file" name="gambar" class="form-control" id="gambar" onchange="readURL(this);" accept=".png, .jpg, .jpeg" />
                        </div>
                        <div class="form-group col-md-6">
                            <img id="blah" src=<?= base_url('./media/galeri/' . $value['gambar']); ?> class="" width="280" height="150" />
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-primary btn-sm"> <i class="fas fa-paper-plane"></i> Simpan</button>
                            <a href="<?= base_url('admin/galeri') ?>" class="btn btn-danger btn-sm"> <i class="fa fa-reply"></i> Kembali</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal Edit -->

<!-- Modal Hapus -->
<?php foreach ($galeri as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_galeri'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h5 class="modal-title ">
                        <span class="fw-mediumbold">
                            Hapus Galeri</span>
                    </h5>
                </div>
                <div class="modal-body text-center">
                    <!-- form start-->
                    <h3 style=" font-size: 20px; font-weight: 600;">Udah yakin mau ko hapus data ini?</h3>
                    <br>
                    <div class="swal-footer no-bd">
                        <a href="<?= base_url('admin/galeri/delete/' . $value['id_galeri']) ?>" type="button" class="btn btn-success">Gasss!!!</a></button>
                        <a href="<?= base_url('admin/galeri') ?>" type="button" class="btn btn-danger">Gak Jadi</a></button>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal Hapus -->