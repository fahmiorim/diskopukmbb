<?php 
helper('form'); // Load the form helper
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('admin/profile/kepegawaian') ?>" class="btn btn-secondary">
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
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Pegawai</h6>
                </div>
                <div class="card-body">
                    <form id="formTambah" action="<?= base_url('admin/profile/kepegawaian_save') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group text-center mb-4">
                                    <img id="imagePreview" src="<?= base_url('media/no_image.jpg') ?>" class="img-fluid rounded border" style="max-width: 300px; height: auto;" alt="Preview Gambar" />
                                </div>
                                <div class="form-group">
                                    <label for="foto">Foto <small class="text-muted">(Maks. 2MB, format: JPG/PNG)</small></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="foto" name="foto" accept="image/jpeg,image/png" onchange="previewImage(this)">
                                        <label class="custom-file-label" for="foto">Pilih file...</label>
                                        <small class="form-text text-muted">Ukuran maksimal 2MB. Format: JPG/PNG</small>
                                    </div>
                                </div>
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
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="<?= base_url('admin/profile/kepegawaian') ?>" class="btn btn-secondary">
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

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Image preview function
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const file = input.files[0];
        const fileSize = file ? file.size / 1024 / 1024 : 0; // in MB
        
        // Validate file size (max 2MB)
        if (fileSize > 2) {
            Swal.fire({
                icon: 'error',
                title: 'Ukuran file terlalu besar',
                text: 'Ukuran file maksimal 2MB',
                confirmButtonColor: '#3085d6',
            });
            input.value = '';
            preview.src = '<?= base_url('media/no_image.jpg') ?>';
            document.querySelector('.custom-file-label').textContent = 'Pilih file...';
            return;
        }

        // Update file label
        if (file) {
            document.querySelector('.custom-file-label').textContent = file.name;
            
            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        } else {
            preview.src = '<?= base_url('media/no_image.jpg') ?>';
            document.querySelector('.custom-file-label').textContent = 'Pilih file...';
        }
    }

    // Form submission with loading state
    document.getElementById('formTambah').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('btnSubmit');
        const loadingIndicator = document.getElementById('loadingIndicator');
        
        // Show loading state
        submitBtn.disabled = true;
        loadingIndicator.classList.remove('d-none');
        
        // You can add additional form validation here if needed
        
        // If validation passes, the form will submit
        // If there are errors, the page will reload with error messages
    });

    // Show success message if there is one
    <?php if (session()->getFlashdata('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?= session()->getFlashdata('success') ?>',
            confirmButtonColor: '#3085d6',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url('admin/profile/kepegawaian') ?>';
            }
        });
    <?php endif; ?>
</script>