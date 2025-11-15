<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS Link -->
    <link rel="stylesheet" href="<?= base_url() ?>/frontend/comming/css/vendor/bootstrap.min.css">

    <!-- Theme CSS Link -->
    <link rel="stylesheet" href="<?= base_url() ?>/frontend/comming/css/main.css">

    <link rel="shortcut icon" href="<?= base_url('/media/settings/favicon.png'); ?>">

    <title>DISKOPUKM BATU BARA</title>
</head>

<body>
    <section class="main" style="background-image: url(<?= base_url() ?>/frontend/comming/src/images/bg.jpg);">
        <!-- Header Starts Here -->
        <header class="container">
            <nav>
                <div class="logo">
                    <a href="<?= base_url() ?>">
                        <img src="<?= base_url() ?>/frontend/comming/src/images/logo.png">
                    </a>
                </div>
            </nav>
        </header>
        <!-- Header Ends Here -->

        <!-- News Letter Starts Here -->
        <section class="newsletter-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <h5 class="has-line">Coming Soon</h5>
                        <h1>Kami Akan Kembali Dengan Sesuatu Yang Menarik.</h1>
                        <a href="<?= base_url() ?>"> <button type="button" class="btn btn-primary btn-lg">Kembali</button></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- News Letter Ends Here -->

        <!-- Only Mobile View Starts Here -->
        <section class="xs-bg d-md-none d-lg-none">
            <img src="<?= base_url() ?>/frontend/comming/src/images/xs.jpg" alt="img" class="img-fluid w-100">
        </section>
        <!-- Only Mobile View Ends Here -->
    </section>
</body>

</html>