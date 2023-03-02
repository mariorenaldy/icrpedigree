<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Product</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>

<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <figure class="figure w-25">
            <img src="<?= base_url('assets/img/product.jpg') ?>" class="figure-img img-fluid rounded" alt="...">
            <h3 class="text-warning">PEDIGREE POUCH</h3>
            <figcaption class="figure-caption">RAW FOOD</figcaption>
            <p>6000</p>
            <a href="#" class="btn btn-primary">Beli</a>
        </figure>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>

</html>