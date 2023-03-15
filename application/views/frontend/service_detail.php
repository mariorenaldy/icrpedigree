<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Service</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>

<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <figure class="figure w-50">
            <?php if ($services->ser_photo != '-' &&  $services->ser_photo != null){ ?>
                <img src="<?= base_url('uploads/services/'.$services->ser_photo) ?>" class="figure-img img-fluid rounded" style="max-height:500px;" alt="service">
            <?php } else{ ?>
                <img src="<?= base_url('assets/img/service.jpg') ?>" class="figure-img img-fluid rounded" style="max-height:500px;" alt="service">
            <?php } ?>
            <h3 class="text-warning"><?= $services->ser_name ?></h3>
            <figcaption class="figure-caption"><?= $services->ser_desc ?></figcaption>
            <p><?= $services->ser_price ?></p>
            <button type="button" class="btn btn-primary" onclick="payment(<?= $services->ser_id ?>)">Sewa</button>
            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>frontend/Marketplace/services'">Kembali</button>
        </figure>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script>
        function payment(id){
            window.location = "<?= base_url(); ?>frontend/Marketplace/service_payment/"+id;
        }
    </script>
</body>

</html>