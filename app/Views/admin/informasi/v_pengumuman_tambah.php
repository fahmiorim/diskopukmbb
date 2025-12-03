<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('admin/informasi/pengumuman') ?>" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Daftar
        </a>
    </div>

    <?php if (session()->has('errors')) : ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-plus-circle mr-2"></i> Form Tambah Pengumuman
                    </h6>
                </div>
                <div class="card-body">
                    <form role="form" action="<?= base_url('admin/informasi/pengumuman_save'); ?>" method="post" enctype="multipart/form-data" id="pengumumanForm">
                        <?= csrf_field() ?>
                        
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Informasi Dasar -->
                                <div class="card mb-4">
                                    <div class="card-header bg-light py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            <i class="fas fa-info-circle mr-2"></i> Informasi Dasar
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Judul Pengumuman <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   name="judul" 
                                                   class="form-control" 
                                                   value="<?= old('judul'); ?>" 
                                                   required
                                                   minlength="5"
                                                   maxlength="200"
                                                   oninvalid="this.setCustomValidity('Judul pengumuman harus diisi (5-200 karakter)')"
                                                   oninput="this.setCustomValidity('')">
                                            <small class="form-text text-muted">Masukkan judul pengumuman yang jelas dan informatif</small>
                                        </div>

                                        <div class="form-group">
                                            <label>Gambar Utama</label>
                                            <div class="custom-file">
                                                <input type="file" 
                                                       class="custom-file-input" 
                                                       id="gambar" 
                                                       name="gambar" 
                                                       accept="image/*"
                                                       onchange="previewImage(this, 'previewGambar')">
                                                <label class="custom-file-label" for="gambar">Pilih gambar (Maks. 2MB)</label>
                                            </div>
                                            <small class="form-text text-muted">Format: JPG, JPEG, PNG. Ukuran maksimal 2MB</small>
                                            
                                            <!-- Preview Gambar -->
                                            <div class="mt-3 text-center">
                                                <div class="img-preview-container" style="max-width: 100%; height: 200px; overflow: hidden; border: 2px dashed #ddd; border-radius: 5px;">
                                                    <img id="previewGambar" src="#" alt="Preview Gambar" style="width: 100%; height: 100%; object-fit: contain; display: none;">
                                                    <div id="noImage" class="h-100 d-flex flex-column align-items-center justify-content-center">
                                                        <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                                        <p class="text-muted mb-0">Preview Gambar</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Deskripsi <span class="text-danger">*</span></label>
                                            <textarea name="deskripsi" id="editor" required><?= old('deskripsi'); ?></textarea>
                                            <small class="form-text text-muted">Deskripsi lengkap pengumuman</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <!-- Pengaturan Tambahan -->
                                <div class="card mb-4">
                                    <div class="card-header bg-light py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            <i class="fas fa-cog mr-2"></i> Pengaturan
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status" required>
                                                <option value="publish" <?= old('status') == 'publish' ? 'selected' : '' ?>>Publish</option>
                                                <option value="draft" <?= old('status') == 'draft' ? 'selected' : '' ?>>Draft</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Tanggal Terbit</label>
                                            <input type="datetime-local" 
                                                   class="form-control" 
                                                   name="tanggal_terbit" 
                                                   value="<?= old('tanggal_terbit', date('Y-m-d\TH:i')) ?>"
                                                   required>
                                        </div>
                                        
                                        <hr class="my-4">
                                        
                                        <div class="form-group">
                                            <label>Tampilkan Formulir Pendaftaran</label>
                                            <select class="form-control" id="tampilkanForm" name="form" required>
                                                <option value="no" <?= old('form') == 'no' ? 'selected' : '' ?>>Tidak Tampilkan</option>
                                                <option value="yes" <?= old('form') == 'yes' ? 'selected' : '' ?>>Tampilkan Formulir</option>
                                            </select>
                                            <small class="form-text text-muted">Pilih apakah akan menampilkan formulir pendaftaran</small>
                                        </div>
                        <br>
                                        
                                        <!-- Formulir Pendaftaran (Awalnya Disembunyikan) -->
                                        <div id="formPengaturan" style="display: <?= old('form') == 'yes' ? 'block' : 'none' ?>;">
                                            <div class="form-group">
                                                <label>Judul Formulir <span class="text-danger">*</span></label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       name="form_judul" 
                                                       value="<?= old('form_judul', 'Formulir Pendaftaran') ?>"
                                                       <?= old('form') == 'yes' ? 'required' : '' ?>>
                                                <small class="form-text text-muted">Judul yang akan ditampilkan di atas formulir</small>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Batas Waktu Pendaftaran <span class="text-danger">*</span></label>
                                                <input type="datetime-local" 
                                                       class="form-control" 
                                                       name="batas_pendaftaran" 
                                                       value="<?= old('batas_pendaftaran') ?>"
                                                       <?= old('form') == 'yes' ? 'required' : '' ?>>
                                                <small class="form-text text-muted">Batas akhir pendaftaran</small>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Kuota Peserta</label>
                                                <input type="number" 
                                                       class="form-control" 
                                                       name="kuota_peserta" 
                                                       min="0"
                                                       value="<?= old('kuota_peserta', '0') ?>">
                                                <small class="form-text text-muted">Kosongkan atau isi 0 untuk tidak terbatas</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Tombol Aksi -->
                                <div class="card">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary btn-block" id="btnSimpan">
                                            <i class="fas fa-save mr-1"></i> Simpan Pengumuman
                                        </button>
                                        <button type="submit" name="draft" value="1" class="btn btn-outline-secondary btn-block mt-2">
                                            <i class="fas fa-file-alt mr-1"></i> Simpan Sebagai Draft
                                        </button>
                                        <a href="<?= base_url('admin/informasi/pengumuman') ?>" class="btn btn-outline-danger btn-block mt-2">
                                            <i class="fas fa-times mr-1"></i> Batal
                                        </a>
                                    </div>
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
// Toggle tampilan form pengaturan
$('#tampilkanForm').on('change', function() {
    if ($(this).val() === 'yes') {
        $('#formPengaturan').slideDown();
        $('#formPengaturan input, #formPengaturan select, #formPengaturan textarea').prop('required', true);
    } else {
        $('#formPengaturan').slideUp();
        $('#formPengaturan input, #formPengaturan select, #formPengaturan textarea').prop('required', false);
    }
});

// Preview gambar
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const noImage = document.getElementById('noImage');
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const fileSize = file.size / 1024 / 1024; // in MB
        
        // Validasi ukuran file (maks 2MB)
        if (fileSize > 2) {
            Swal.fire({
                icon: 'error',
                title: 'Ukuran file terlalu besar',
                text: 'Ukuran gambar tidak boleh lebih dari 2MB',
                confirmButtonText: 'OK'
            });
            input.value = '';
            preview.style.display = 'none';
            if (noImage) noImage.style.display = 'flex';
            return;
        }
        
        // Validasi tipe file
        if (!file.type.match('image.*')) {
            Swal.fire({
                icon: 'error',
                title: 'Format file tidak didukung',
                text: 'Hanya file gambar yang diizinkan',
                confirmButtonText: 'OK'
            });
            input.value = '';
            preview.style.display = 'none';
            if (noImage) noImage.style.display = 'flex';
            return;
        }
        
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            if (noImage) noImage.style.display = 'none';
        }
        
        reader.readAsDataURL(file);
        
        // Update label nama file
        const fileName = input.files[0].name;
        const label = input.nextElementSibling;
        if (label && label.tagName === 'LABEL') {
            label.textContent = fileName;
        }
    } else {
        preview.style.display = 'none';
        if (noImage) noImage.style.display = 'flex';
        
        const label = input.nextElementSibling;
        if (label && label.tagName === 'LABEL') {
            label.textContent = 'Pilih gambar';
        }
    }
}

// Inisialisasi CKEditor
ClassicEditor
    .create(document.querySelector('#editor'), {
        toolbar: {
            items: [
                'heading', '|',
                'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', '|',
                'bulletedList', 'numberedList', '|',
                'alignment', '|',
                'indent', 'outdent', '|',
                'link', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                'undo', 'redo'
            ]
        },
        language: 'id',
        image: {
            toolbar: [
                'imageTextAlternative',
                'imageStyle:inline',
                'imageStyle:block',
                'imageStyle:side',
                'linkImage'
            ]
        },
        table: {
            contentToolbar: [
                'tableColumn',
                'tableRow',
                'mergeTableCells',
                'tableCellProperties',
                'tableProperties'
            ]
        }
    })
    .then(editor => {
        window.editor = editor;
    })
    .catch(error => {
        console.error(error);
    });

// Submit form dengan loading state
$('#pengumumanForm').on('submit', function() {
    const btn = $('#btnSimpan');
    btn.prop('disabled', true);
    btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...');
});
</script>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>

<!-- Custom CSS -->
<style>
.ck-editor__editable {
    min-height: 300px;
}

/* Style untuk preview gambar */
.img-preview-container {
    position: relative;
    background-color: #f8f9fa;
    border-radius: 5px;
    overflow: hidden;
}

.img-preview-container img {
    transition: all 0.3s ease;
}

.img-preview-container:hover img {
    transform: scale(1.05);
}

/* Style untuk custom file input */
.custom-file-label::after {
    content: "Pilih File";
}

/* Style untuk card */
.card {
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    margin-bottom: 1.5rem;
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

/* Style untuk form group */
.form-group {
    margin-bottom: 1.25rem;
}

/* Style untuk tombol */
.btn {
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn i {
    margin-right: 0.25rem;
}

/* Responsif */
@media (max-width: 768px) {
    .ck-editor__editable {
        min-height: 250px;
    }
    
    .card-body {
        padding: 1rem;
    }
}
</style>