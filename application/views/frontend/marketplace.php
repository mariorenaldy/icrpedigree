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
        <div class="search-container">
            <form action="<?= base_url().'frontend/Marketplace/search'?>" method="post">
                <div class="input-group my-3 d-flex justify-content-center">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Nama Produk" name="keywords" value="<?= set_value('keywords') ?>">
                    </div>
                    <div class="col-sm-1 ms-1">
                        <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Cari Produk"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="text-dark" id="productsContainer">
            <div class="row m-5">
                <div class="card col m-5">
                    <img src="<?= base_url('assets/img/product.jpg') ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">PEDIGREE POUCH</h5>
                        <p class="card-text">RAW FOOD</p>
                        <p class="card-text">6000</p>
                        <a href="<?= base_url(); ?>frontend/Marketplace/product" class="btn btn-primary stretched-link">Detail</a>
                    </div>
                </div>
                <div class="card col m-5">
                    <img src="<?= base_url('assets/img/product.jpg') ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">PEDIGREE POUCH</h5>
                        <p class="card-text">RAW FOOD</p>
                        <p class="card-text">6000</p>
                        <a href="<?= base_url(); ?>frontend/Marketplace/product" class="btn btn-primary stretched-link">Detail</a>
                    </div>
                </div>
                <div class="card col m-5">
                    <img src="<?= base_url('assets/img/product.jpg') ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">PEDIGREE POUCH</h5>
                        <p class="card-text">RAW FOOD</p>
                        <p class="card-text">6000</p>
                        <a href="<?= base_url(); ?>frontend/Marketplace/product" class="btn btn-primary stretched-link">Detail</a>
                    </div>
                </div>
            </div>
            <div class="row m-5">
                <div class="card col m-5">
                    <img src="<?= base_url('assets/img/product.jpg') ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">PEDIGREE POUCH</h5>
                        <p class="card-text">RAW FOOD</p>
                        <p class="card-text">6000</p>
                        <a href="<?= base_url(); ?>frontend/Marketplace/product" class="btn btn-primary stretched-link">Detail</a>
                    </div>
                </div>
                <div class="card col m-5">
                    <img src="<?= base_url('assets/img/product.jpg') ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">PEDIGREE POUCH</h5>
                        <p class="card-text">RAW FOOD</p>
                        <p class="card-text">6000</p>
                        <a href="<?= base_url(); ?>frontend/Marketplace/product" class="btn btn-primary stretched-link">Detail</a>
                    </div>
                </div>
                <div class="card col m-5">
                    <img src="<?= base_url('assets/img/product.jpg') ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">PEDIGREE POUCH</h5>
                        <p class="card-text">RAW FOOD</p>
                        <p class="card-text">6000</p>
                        <a href="<?= base_url(); ?>frontend/Marketplace/product" class="btn btn-primary stretched-link">Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
</html>