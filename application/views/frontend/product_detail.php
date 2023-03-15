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
        <figure class="figure w-50">
            <?php if ($products->pro_photo != '-' &&  $products->pro_photo != null){ ?>
                <img src="<?= base_url('uploads/products/'.$products->pro_photo) ?>" class="figure-img img-fluid rounded" style="max-height:500px;" alt="product">
            <?php } else{ ?>
                <img src="<?= base_url('assets/img/product.jpg') ?>" class="figure-img img-fluid rounded" style="max-height:500px;" alt="product">
            <?php } ?>
            <h3 class="text-warning"><?= $products->pro_name ?></h3>
            <figcaption class="figure-caption"><?= $products->pro_desc ?></figcaption>
            <p><?= $products->pro_price ?></p>
            <button type="button" class="btn btn-primary" onclick="payment(<?= $products->pro_id ?>)">Beli</button>
            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>frontend/Marketplace/products'">Kembali</button>
        </figure>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script>
        function payment(id){
            window.location = "<?= base_url(); ?>frontend/Marketplace/product_payment/"+id;
        }
    </script>
</body>

</html>