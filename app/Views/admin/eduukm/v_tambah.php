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
                    <form role="form" action="<?= base_url('admin/eduukm/save'); ?>" method="post" enctype="multipart/form-data" id="eduForm">
                        <?= csrf_field() ?>
                        <div class="form-group col-sm-10">
                            <label>Judul <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="judul" value="<?= old('judul'); ?>" 
                                   required minlength="5" maxlength="255"
                                   oninvalid="this.setCustomValidity('Judul harus diisi (5-255 karakter)')"
                                   oninput="this.setCustomValidity('')">
                            <small class="form-text text-muted">Minimal 5 karakter, maksimal 255 karakter</small>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Jenis <span class="text-danger">*</span></label>
                            <select class="custom-select" name="jenis" id="jenis" required
                                    oninvalid="this.setCustomValidity('Silakan pilih jenis edukasi')"
                                    oninput="this.setCustomValidity('')">
                                <option value="" disabled selected>Pilih Jenis</option>
                                <option value="baca" <?= old('jenis') == 'baca' ? 'selected' : '' ?>>Bahan Baca</option>
                                <option value="video" <?= old('jenis') == 'video' ? 'selected' : '' ?>>Video</option>
                                <option value="elearning" <?= old('jenis') == 'elearning' ? 'selected' : '' ?>>E-learning</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-10" id="link">
                            <label>Link <span id="linkRequired" class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">https://</span>
                                </div>
                                <input class="form-control" type="url" name="link" id="linkInput" 
                                       value="<?= old('link'); ?>"
                                       oninvalid="this.setCustomValidity('Harap masukkan URL yang valid')"
                                       oninput="this.setCustomValidity('')">
                            </div>
                            <small class="form-text text-muted">Contoh: youtube.com/xxxx atau drive.google.com/xxxx</small>
                        </div>
                        
                        <div class="form-group col-sm-10" id="file">
                            <label>File <span id="fileRequired" class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="fileInput" name="filebaca"
                                       accept=".pdf,.doc,.docx,.ppt,.pptx">
                                <label class="custom-file-label" for="fileInput">Pilih file (PDF, DOC, PPT)</label>
                                <small class="form-text text-muted">Maksimal 10MB</small>
                            </div>
                            <div class="mt-2">
                                <div id="filePreview" class="d-none">
                                    <i class="far fa-file-pdf fa-2x text-danger" id="fileIcon"></i>
                                    <span id="fileName"></span>
                                    <button type="button" class="btn btn-sm btn-outline-danger" id="removeFile">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-11">
                            <label>Deskripsi Singkat <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="deskripsi" rows="3" required
                                     oninvalid="this.setCustomValidity('Deskripsi singkat harus diisi')"
                                     oninput="this.setCustomValidity('')"><?= old('deskripsi'); ?></textarea>
                            <small class="form-text text-muted">Deskripsi singkat yang akan ditampilkan di halaman daftar</small>
                        </div>
                        
                        <div class="form-group col-sm-11">
                            <label>Materi Lengkap <span class="text-danger">*</span></label>
                            <textarea name="materi" id="editor" required
                                     oninvalid="this.setCustomValidity('Materi tidak boleh kosong')"
                                     oninput="this.setCustomValidity('')"><?= old('materi'); ?></textarea>
                        </div>
                        <div class="form-group col-sm-8">
                            <label>Gambar Utama <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="gambar" name="gambar" 
                                       accept="image/*" required
                                       onchange="previewImage(this)">
                                <label class="custom-file-label" for="gambar">Pilih gambar</label>
                                <small class="form-text text-muted">Format: JPG, JPEG, PNG (Maks. 2MB, Rasio 16:9 direkomendasikan)</small>
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
                            <a href="<?= base_url('admin/eduukm') ?>" class="btn btn-danger btn-sm">
                                <i class="fa fa-reply"></i> Batal
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script>
    // Inisialisasi
    $(document).ready(function() {
        // Sembunyikan semua input file/link terlebih dahulu
        $("#file").hide();
        $("#link").hide();
        
        // Tampilkan input yang sesuai saat halaman dimuat (jika ada nilai old)
        toggleInputs('<?= old('jenis') ?>');
        
        // Handle perubahan jenis
        $('#jenis').on('change', function() {
            const value = $(this).val();
            toggleInputs(value);
        });
        
        // Preview gambar
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const fileLabel = $('.custom-file-label[for="gambar"]');
            
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const fileSize = file.size / 1024 / 1024; // in MB
                
                // Validasi ukuran file (maks 2MB)
                if (fileSize > 2) {
                    alert('Ukuran gambar tidak boleh lebih dari 2MB');
                    input.value = '';
                    preview.style.display = 'none';
                    fileLabel.text('Pilih gambar');
                    return;
                }
                
                // Validasi tipe file
                if (!file.type.match('image.*')) {
                    alert('Hanya file gambar yang diizinkan');
                    input.value = '';
                    preview.style.display = 'none';
                    fileLabel.text('Pilih gambar');
                    return;
                }
                
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                
                reader.readAsDataURL(file);
                fileLabel.text(file.name);
            } else {
                preview.style.display = 'none';
                fileLabel.text('Pilih gambar');
            }
        }
        
        // Toggle input berdasarkan jenis
        function toggleInputs(jenis) {
            if (jenis === 'baca') {
                $("#file").show();
                $("#link").hide();
                $("#fileInput").prop('required', true);
                $("#linkInput").prop('required', false);
                $("#fileRequired").show();
                $("#linkRequired").hide();
            } else if (jenis === 'video' || jenis === 'elearning') {
                $("#file").hide();
                $("#link").show();
                $("#fileInput").prop('required', false);
                $("#linkInput").prop('required', true);
                $("#fileRequired").hide();
                $("#linkRequired").show();
            } else {
                $("#file").hide();
                $("#link").hide();
                $("#fileInput").prop('required', false);
                $("#linkInput").prop('required', false);
                $("#fileRequired").hide();
                $("#linkRequired").hide();
            }
        }
        
        // Preview file
        $('#fileInput').on('change', function() {
            const file = this.files[0];
            if (file) {
                const fileName = file.name;
                const fileExt = fileName.split('.').pop().toLowerCase();
                const filePreview = $('#filePreview');
                const fileIcon = $('#fileIcon');
                
                // Set icon berdasarkan tipe file
                if (fileExt === 'pdf') {
                    fileIcon.removeClass().addClass('far fa-file-pdf fa-2x text-danger');
                } else if (['doc', 'docx'].includes(fileExt)) {
                    fileIcon.removeClass().addClass('far fa-file-word fa-2x text-primary');
                } else if (['ppt', 'pptx'].includes(fileExt)) {
                    fileIcon.removeClass().addClass('far fa-file-powerpoint fa-2x text-warning');
                } else {
                    fileIcon.removeClass().addClass('far fa-file-alt fa-2x text-secondary');
                }
                
                // Tampilkan preview
                $('#fileName').text(fileName);
                filePreview.removeClass('d-none');
            }
        });
        
        // Hapus file
        $('#removeFile').on('click', function() {
            $('#fileInput').val('');
            $('#filePreview').addClass('d-none');
        });
        
        // Submit form dengan loading state
        $('#eduForm').on('submit', function() {
            const btn = $('#btnSubmit');
            btn.prop('disabled', true);
            btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...');
        });
    });
</script>