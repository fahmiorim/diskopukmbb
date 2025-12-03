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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Data Profile</h6>
        </div>
        <div class="card-body">
            <form id="formEdit" action="<?= base_url('admin/profile/update/' . $profile['id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="old_gambar" value="<?= $profile['gambar'] ?>">
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="judul">Judul Profile <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= session('errors.judul') ? 'is-invalid' : '' ?>" 
                                   id="judul" name="judul" value="<?= old('judul', $profile['judul']) ?>" required>
                            <?php if (session('errors.judul')): ?>
                                <div class="invalid-feedback">
                                    <?= esc(session('errors.judul')) ?>
                                </div>
                            <?php endif; ?>
                            <small class="form-text text-muted">Masukkan judul profile yang akan ditampilkan</small>
                        </div>

                        <div class="form-group">
                            <label for="isi_halaman">Isi Halaman <span class="text-danger">*</span></label>
                            <textarea name="isi_halaman" id="editor" class="form-control <?= session('errors.isi_halaman') ? 'is-invalid' : '' ?>" 
                                     rows="10" required><?= old('isi_halaman', $profile['isi_halaman']) ?></textarea>
                            <?php if (session('errors.isi_halaman')): ?>
                                <div class="invalid-feedback">
                                    <?= esc(session('errors.isi_halaman')) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="urutan">Urutan Tampil <span class="text-danger">*</span></label>
                            <input type="number" class="form-control <?= session('errors.urutan') ? 'is-invalid' : '' ?>" 
                                   id="urutan" name="urutan" value="<?= old('urutan', $profile['urutan']) ?>" min="0" required>
                            <?php if (session('errors.urutan')): ?>
                                <div class="invalid-feedback">
                                    <?= esc(session('errors.urutan')) ?>
                                </div>
                            <?php endif; ?>
                            <small class="form-text text-muted">Urutan penampilan di halaman (angka terkecil ditampilkan pertama)</small>
                        </div>

                        <div class="form-group">
                            <label>Gambar Saat Ini</label>
                            <?php if (!empty($profile['gambar'])): ?>
                                <div class="mb-3">
                                    <img src="<?= base_url('media/profile/' . $profile['gambar']) ?>" 
                                         class="img-fluid rounded border" alt="Gambar Saat Ini" style="max-height: 200px;">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="hapus_gambar" id="hapusGambar" value="1">
                                        <label class="form-check-label text-danger" for="hapusGambar">
                                            Hapus gambar ini
                                        </label>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-info">Tidak ada gambar</div>
                            <?php endif; ?>

                            <label for="gambar">Ganti Gambar</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input <?= session('errors.gambar') ? 'is-invalid' : '' ?>" 
                                       id="gambar" name="gambar" accept="image/*" onchange="previewImage(this, 'imagePreview')">
                                <label class="custom-file-label" for="gambar">Pilih gambar baru...</label>
                                <?php if (session('errors.gambar')): ?>
                                    <div class="invalid-feedback">
                                        <?= esc(session('errors.gambar')) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <small class="form-text text-muted">Format: JPG, PNG, JPEG (Maks. 2MB)</small>
                            
                            <!-- Image Preview -->
                            <div class="mt-3 text-center" id="imagePreviewContainer" style="display: none;">
                                <div class="card">
                                    <div class="card-body p-2">
                                        <img id="imagePreview" src="#" alt="Preview Gambar" class="img-fluid rounded">
                                        <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeImage('gambar')">
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
                            <div>
                                <button type="button" class="btn btn-outline-danger mr-2" onclick="confirmDelete(<?= $profile['id'] ?>, '<?= esc(htmlspecialchars($profile['judul'])) ?>')">
                                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                                </button>
                                <button type="submit" class="btn btn-primary" id="btnUpdate">
                                    <i class="fas fa-save mr-1"></i> Perbarui Data
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Delete Form -->
            <?= form_open('', ['id' => 'form-delete', 'class' => 'd-none']) ?>
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="DELETE">
            <?= form_close() ?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- CKEditor 4.25.1 LTS -->
<script src="https://cdn.ckeditor.com/4.25.1/full/ckeditor.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
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
        const fileType = file?.type;
        const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (file && !validImageTypes.includes(fileType)) {
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
        if (file) {
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
        } else {
            previewContainer.style.display = 'none';
        }
    }
    
    // Remove image function
    function removeImage(inputId) {
        const input = document.getElementById(inputId);
        const previewContainer = document.getElementById('imagePreviewContainer');
        const label = input.nextElementSibling;
        
        input.value = '';
        previewContainer.style.display = 'none';
        label.textContent = 'Pilih gambar...';
    }
    
    // Form submission handler
    document.getElementById('formEdit').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('btnUpdate');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';
    });

    // Delete confirmation
    function confirmDelete(id, title) {
        Swal.fire({
            title: 'Hapus Data',
            html: `Apakah Anda yakin ingin menghapus <strong>${title}</strong>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('form-delete');
                form.action = `<?= base_url('admin/profile/delete/') ?>${id}`;
                form.submit();
            }
        });
    }

    // Toggle hapus gambar checkbox
    document.getElementById('hapusGambar')?.addEventListener('change', function() {
        const fileInput = document.getElementById('gambar');
        fileInput.disabled = this.checked;
        if (this.checked) {
            fileInput.value = '';
            document.getElementById('imagePreviewContainer').style.display = 'none';
        }
    });
</script>