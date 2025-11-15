<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title><?= $title ?? 'Login' ?> - DISKOP UKM Kabupaten Batu Bara</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('media/settings/icon.png') ?>">
    
    <!-- Custom fonts for this template-->
    <link href="<?= base_url('template/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <!-- Custom styles for this template-->
    <link href="<?= base_url('template/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    
    <!-- Custom styles -->
    <style>
        .bg-login {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }
        .btn-google {
            color: #fff;
            background-color: #ea4335;
            border-color: #ea4335;
        }
        .btn-google:hover {
            color: #fff;
            background-color: #e12717;
            border-color: #d62516;
        }
        .btn-facebook {
            color: #fff;
            background-color: #3b5998;
            border-color: #3b5998;
        }
        .btn-facebook:hover {
            color: #fff;
            background-color: #2d4373;
            border-color: #2a3f6b;
        }
    </style>
    
    <?= $this->renderSection('styles') ?>
</head>

<body class="bg-gradient-primary">
    <?= $this->renderSection('content') ?>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('template/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('template/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('template/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
    
    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('template/js/sb-admin-2.min.js') ?>"></script>
    
    <?= $this->renderSection('scripts') ?>
</body>

</html>
