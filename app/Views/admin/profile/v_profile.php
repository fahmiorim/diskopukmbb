<?= $this->extend('admin/layout/v_wrapper'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-4">
            <!-- Profile Image -->
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <img class="img-profile rounded-circle mb-3" 
                         src="<?= base_url('public/media/profile/' . ($user['foto'] ?? 'default.png')); ?>" 
                         alt="Profile" 
                         style="width: 150px; height: 150px; object-fit: cover;">
                    <h4 class="mb-1"><?= $user['nama_lengkap'] ?? 'Nama Pengguna'; ?></h4>
                    <p class="text-muted mb-3"><?= $user['jabatan'] ?? 'Jabatan'; ?></p>
                    <div class="d-flex justify-content-center">
                        <a href="#" class="btn btn-primary btn-circle mx-1">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-info btn-circle mx-1">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-circle mx-1">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-linkedin btn-circle mx-1">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-primary btn-block">
                        <i class="fas fa-upload fa-sm text-white-50"></i> Ganti Foto
                    </a>
                </div>
            </div>

            <!-- About Me Box -->
            <div class="card shadow-sm mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tentang Saya</h6>
                </div>
                <div class="card-body">
                    <strong><i class="fas fa-book mr-2"></i> Pendidikan</strong>
                    <p class="text-muted mb-3">
                        <?= $user['pendidikan'] ?? 'Belum diisi'; ?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-map-marker-alt mr-2"></i> Alamat</strong>
                    <p class="text-muted mb-3">
                        <?= $user['alamat'] ?? 'Belum diisi'; ?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-phone-alt mr-2"></i> Telepon</strong>
                    <p class="text-muted mb-3">
                        <?= $user['no_hp'] ?? 'Belum diisi'; ?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-envelope mr-2"></i> Email</strong>
                    <p class="text-muted">
                        <?= $user['email'] ?? 'Belum diisi'; ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Profil</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/profile/update'); ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id" value="<?= $user['id'] ?? ''; ?>">
                        
                        <div class="form-group row">
                            <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" 
                                       value="<?= $user['nama_lengkap'] ?? ''; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?= $user['email'] ?? ''; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="no_hp" class="col-sm-3 col-form-label">No. HP</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="no_hp" name="no_hp" 
                                       value="<?= $user['no_hp'] ?? ''; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= $user['alamat'] ?? ''; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="jabatan" name="jabatan">
                                    <option value="">-- Pilih Jabatan --</option>
                                    <?php if (!empty($jabatan)): ?>
                                        <?php foreach ($jabatan as $j): ?>
                                            <option value="<?= $j['id']; ?>" <?= (isset($user['jabatan_id']) && $user['jabatan_id'] == $j['id']) ? 'selected' : ''; ?>>
                                                <?= $j['nama_jabatan']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="foto" class="col-sm-3 col-form-label">Foto Profil</label>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto" name="foto">
                                    <label class="custom-file-label" for="foto">Pilih file</label>
                                </div>
                                <small class="form-text text-muted">Ukuran maksimal 2MB. Format: JPG, JPEG, PNG</small>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <a href="<?= base_url('admin/dashboard'); ?>" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card shadow-sm">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ganti Password</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/profile/change_password'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id" value="<?= $user['id'] ?? ''; ?>">
                        
                        <div class="form-group row">
                            <label for="password_lama" class="col-sm-4 col-form-label">Password Lama</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password_lama" name="password_lama" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="password_baru" class="col-sm-4 col-form-label">Password Baru</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password_baru" name="password_baru" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="konfirmasi_password" class="col-sm-4 col-form-label">Konfirmasi Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-key"></i> Ganti Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    // Menampilkan nama file yang dipilih pada input file
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = document.getElementById("foto").files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
    
    // Validasi form
    $(document).ready(function() {
        // Validasi form edit profil
        $('form').on('submit', function(e) {
            var passwordBaru = $('#password_baru').val();
            var konfirmasiPassword = $('#konfirmasi_password').val();
            
            if (passwordBaru !== '' || konfirmasiPassword !== '') {
                if (passwordBaru !== konfirmasiPassword) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Konfirmasi password tidak cocok!',
                    });
                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>
