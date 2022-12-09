<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Login</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>

    <main class="container" id="beranda-main">
        <article class="row align-items-center justify-content-around">
            <div class="col-5 mb-5">
                <header>
                    <h2 id="article-heading" class="fw-bold">Pastikan anjing kesayangan anda tersertifikasi</h2>
                </header>
                <p id="article-paragraph">Kami siap melayani!</p>
                <a href="#contact" id="article-button" class="btn text-decoration-none text-reset">Hubungi Kami</a>
            </div>

            <aside class="col-md-auto">
                <figure>
                    <img src="<?= base_url('assets/img/icr_logo.png') ?>" class="center-block text-center" style="width: 30vw;">
                </figure>
            </aside>
        </article>
    </main>
    
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>