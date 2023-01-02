<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Marketplace</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>

    <main class="container">
        <header class="d-flex flex-column align-items-center">
            <h2 class="fw-bold text-warning">Marketplace</h2>
        </header>
        <aside class="col-md-auto text-center my-3">
            <figure>
                <img src="<?= base_url('assets/img/Dog.svg') ?>" class="center-block text-center" style="width: 20vw;">
            </figure>
            <h1 class="text-warning">Under Heavy Construction</h1>
        </aside>
    </main>
    
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
</html>

