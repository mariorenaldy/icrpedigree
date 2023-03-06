<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Marketplace</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <h3 class="text-center text-warning">Marketplace</h3>
        <div class="text-dark" id="productsContainer">
            <div class="row m-5">
                <div class="card col m-5">
                    <img src="<?= base_url('assets/img/product.jpg') ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Products</h5>
                        <a href="<?= base_url(); ?>frontend/Marketplace/products" class="btn btn-primary stretched-link">Detail</a>
                    </div>
                </div>
                <div class="card col m-5">
                    <img src="<?= base_url('assets/img/service.jpg') ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Services</h5>
                        <a href="<?= base_url(); ?>frontend/Marketplace/services" class="btn btn-primary stretched-link">Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
</html>