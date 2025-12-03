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
                    <?php if (session()->has('errors')) : ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach (session('errors') as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif ?>

                    <!-- form start-->
                    <form role="form" action="<?= base_url('admin/berita/kegiatan_save'); ?>" method="post" enctype="multipart/form-data" id="kegiatanForm">
                        <?= csrf_field() ?>
                        <div class="form-group col-sm-10">
                            <label>Judul Kegiatan <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="judul" value="<?= old('judul'); ?>" required 
                                   minlength="5" maxlength="255" 
                                   oninvalid="this.setCustomValidity('Judul harus diisi (5-255 karakter)')"
                                   oninput="this.setCustomValidity('')">
                            <small class="form-text text-muted">Minimal 5 karakter, maksimal 255 karakter</small>
                        </div>
                        <div class="form-group col-sm-11">
                            <label>Isi Kegiatan <span class="text-danger">*</span></label>
                            <textarea name="isi_berita" id="editor" required 
                                     oninvalid="this.setCustomValidity('Isi berita tidak boleh kosong')"
                                     oninput="this.setCustomValidity('')"><?= old('isi_berita'); ?></textarea>
                        </div>
                        <div class="form-group col-sm-8">
                            <label>Gambar <small class="text-muted">(Opsional)</small></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="gambar" name="gambar" 
                                       accept="image/*" 
                                       onchange="previewImage(this)">
                                <label class="custom-file-label" for="gambar">Pilih file gambar</label>
                                <small class="form-text text-muted">Format: JPG, JPEG, PNG (Maks. 2MB)</small>
                            </div>
                            <div class="mt-2">
                                <img id="imagePreview" src="#" alt="Preview Gambar" style="max-width: 100%; max-height: 200px; display: none;">
                            </div>
                        </div>
                        <br>
                        <div class="card-action col-sm-3">
                            <button type="submit" class="btn btn-primary btn-sm" id="btnSubmit">
                                <i class="fas fa-paper-plane"></i> Simpan
                            </button>
                            <a href="<?= base_url('admin/berita/kegiatan') ?>" class="btn btn-danger btn-sm">
                                <i class="fa fa-reply"></i> Batal
                            </a>
                        </div>
                        
                        <script>
                        // Preview gambar sebelum diupload
                        function previewImage(input) {
                            const preview = document.getElementById('imagePreview');
                            const fileLabel = document.querySelector('.custom-file-label');
                            
                            if (input.files && input.files[0]) {
                                const file = input.files[0];
                                const fileSize = file.size / 1024 / 1024; // in MB
                                
                                // Validasi ukuran file (maks 2MB)
                                if (fileSize > 2) {
                                    alert('Ukuran gambar tidak boleh lebih dari 2MB');
                                    input.value = '';
                                    preview.style.display = 'none';
                                    fileLabel.textContent = 'Pilih file gambar';
                                    return;
                                }
                                
                                // Validasi tipe file
                                if (!file.type.match('image.*')) {
                                    alert('Hanya file gambar yang diizinkan');
                                    input.value = '';
                                    preview.style.display = 'none';
                                    fileLabel.textContent = 'Pilih file gambar';
                                    return;
                                }
                                
                                const reader = new FileReader();
                                
                                reader.onload = function(e) {
                                    preview.src = e.target.result;
                                    preview.style.display = 'block';
                                }
                                
                                reader.readAsDataURL(file);
                                fileLabel.textContent = file.name;
                            } else {
                                preview.style.display = 'none';
                                fileLabel.textContent = 'Pilih file gambar';
                            }
                        }
                        
                        // Submit form dengan loading state
                        document.getElementById('kegiatanForm').addEventListener('submit', function(e) {
                            const btn = document.getElementById('btnSubmit');
                            btn.disabled = true;
                            btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';
                        });
                        </script>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->