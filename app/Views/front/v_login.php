<?= $this->extend('templates/auth_template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?= $title ?? 'Selamat Datang' ?></h1>
                        </div>

                        <?php if (session()->getFlashdata('success')) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('success') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('error') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('login/cek_login') ?>" method="post" class="user" id="loginForm">
                            <?= csrf_field() ?>
                            
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control form-control-user <?= isset($validation) && $validation->hasError('username') ? 'is-invalid' : '' ?>" 
                                    id="username" value="<?= old('username') ?>" placeholder="Masukkan username" autofocus>
                                <?php if (isset($validation) && $validation->hasError('username')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('username') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <div class="d-flex justify-content-between">
                                    <label for="password">Password</label>
                                    <a href="<?= base_url('forgot-password') ?>">Lupa Password?</a>
                                </div>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control form-control-user <?= isset($validation) && $validation->hasError('password') ? 'is-invalid' : '' ?>" 
                                        id="password" placeholder="Masukkan password">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                    <?php if (isset($validation) && $validation->hasError('password')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('password') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" id="remember" name="remember" value="1">
                                    <label class="custom-control-label" for="remember">Ingat Saya</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                <i class="fas fa-sign-in-alt fa-fw"></i> Masuk
                            </button>
                        </form>

                        <hr>
                        
                        <div class="text-center">
                            <a class="small" href="<?= base_url('register') ?>">Belum punya akun? Daftar!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const password = document.getElementById('password');
        const icon = this.querySelector('i');
        
        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            password.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    // Auto-hide alerts after 5 seconds
    window.setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 5000);

    // Form validation
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();
        
        if (!username || !password) {
            e.preventDefault();
            alert('Username dan password harus diisi');
            return false;
        }
        
        return true;
    });
</script>
<?= $this->endSection() ?>

</html>