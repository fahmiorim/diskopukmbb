<?php 
helper('form'); // Load the form helper
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('admin/profile/menu') ?>" class="btn btn-secondary">
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
                        echo '<li>' . $error . '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo $errors;
                }
            ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Profile</h6>
        </div>
        <div class="card-body">
            <form id="formTambah" action="<?= base_url('admin/profile/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="judul">Judul Profile <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= session('errors.judul') ? 'is-invalid' : '' ?>" 
                                   id="judul" name="judul" value="<?= old('judul') ?>" required>
                            <?php if (session('errors.judul')): ?>
                                <div class="invalid-feedback">
                                    <?= session('errors.judul') ?>
                                </div>
                            <?php endif; ?>
                            <small class="form-text text-muted">Masukkan judul profile yang akan ditampilkan</small>
                        </div>

                        <div class="form-group">
                            <label for="isi_halaman">Isi Halaman <span class="text-danger">*</span></label>
                            <textarea name="isi_halaman" id="editor" class="form-control <?= session('errors.isi_halaman') ? 'is-invalid' : '' ?>" 
                                     rows="10"><?= old('isi_halaman') ?></textarea>
                            <?php if (session('errors.isi_halaman')): ?>
                                <div class="invalid-feedback">
                                    <?= session('errors.isi_halaman') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="urutan">Urutan Tampil <span class="text-danger">*</span></label>
                            <input type="number" class="form-control <?= session('errors.urutan') ? 'is-invalid' : '' ?>" 
                                   id="urutan" name="urutan" value="<?= old('urutan', 0) ?>" min="0" required>
                            <?php if (session('errors.urutan')): ?>
                                <div class="invalid-feedback">
                                    <?= session('errors.urutan') ?>
                                </div>
                            <?php endif; ?>
                            <small class="form-text text-muted">Urutan penampilan di halaman (angka terkecil ditampilkan pertama)</small>
                        </div>

                        <div class="form-group">
                            <label for="gambar">Gambar Utama</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input <?= session('errors.gambar') ? 'is-invalid' : '' ?>" 
                                       id="gambar" name="gambar" accept="image/*" onchange="previewImage(this)">
                                <label class="custom-file-label" for="gambar">Pilih gambar...</label>
                                <?php if (session('errors.gambar')): ?>
                                    <div class="invalid-feedback">
                                        <?= session('errors.gambar') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <small class="form-text text-muted">Format: JPG, PNG, JPEG (Maks. 2MB)</small>
                            
                            <!-- Image Preview -->
                            <div class="mt-3 text-center" id="imagePreviewContainer" style="display: none;">
                                <div class="card">
                                    <div class="card-body p-2">
                                        <img id="imagePreview" src="#" alt="Preview Gambar" class="img-fluid rounded">
                                        <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeImage()">
                                            <i class="fas fa-trash-alt mr-1"></i> Hapus Gambar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('admin/profile/menu') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary" id="btnSubmit">
                                <i class="fas fa-save mr-1"></i> Simpan Data
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- CKEditor 4.25.1 LTS -->
<script src="https://cdn.ckeditor.com/4.25.1/full/ckeditor.js"></script>

<script>
    // Initialize CKEditor
    CKEDITOR.replace('isi_halaman', {
        height: 300,
        filebrowserUploadUrl: '<?= base_url('admin/upload/ckeditor') ?>',
        filebrowserUploadMethod: 'form',
        toolbar: [
            { name: 'document', items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates'] },
            { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
            { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt'] },
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'] },
            { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe'] },
            { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
            { name: 'colors', items: ['TextColor', 'BGColor'] },
            { name: 'tools', items: ['Maximize', 'ShowBlocks'] },
            { name: 'about', items: ['About'] }
        ]
    });

    // Image preview function
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const previewContainer = document.getElementById('imagePreviewContainer');
        const file = input.files[0];
        const maxSize = 2 * 1024 * 1024; // 2MB in bytes
        
        // Check file size
        if (file && file.size > maxSize) {
            Swal.fire({
                icon: 'error',
                title: 'Ukuran file terlalu besar',
                text: 'Ukuran file melebihi 2MB. Silakan pilih file yang lebih kecil.',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Mengerti'
            });
            input.value = '';
            previewContainer.style.display = 'none';
            return;
        }
        
        // Check file type
        const fileType = file.type;
        const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!validImageTypes.includes(fileType)) {
            Swal.fire({
                icon: 'error',
                title: 'Format file tidak didukung',
                text: 'Hanya file JPG, JPEG, dan PNG yang diizinkan.',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Mengerti'
            });
            input.value = '';
            previewContainer.style.display = 'none';
            return;
        }
        
        // Show preview
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
            
            // Update file input label
            const fileName = input.files[0].name;
            const label = input.nextElementSibling;
            label.textContent = fileName;
        }
        
        reader.readAsDataURL(file);
    }
    
    // Remove image function
    function removeImage() {
        const input = document.getElementById('gambar');
        const previewContainer = document.getElementById('imagePreviewContainer');
        const label = document.querySelector('.custom-file-label');
        
        input.value = '';
        previewContainer.style.display = 'none';
        label.textContent = 'Pilih gambar...';
    }
    
    // Form submission handler
    document.getElementById('formTambah').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('btnSubmit');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';
    });
</script>