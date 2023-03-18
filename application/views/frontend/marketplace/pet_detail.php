<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Pet</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>

<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <figure class="figure w-50">
            <?php if ($pets->pet_photo != '-' &&  $pets->pet_photo != null){ ?>
                <img src="<?= base_url('uploads/pets/'.$pets->pet_photo) ?>" class="figure-img img-fluid rounded" style="max-height:500px;" alt="pet">
            <?php } else{ ?>
                <img src="<?= base_url('assets/img/pet.jpg') ?>" class="figure-img img-fluid rounded" style="max-height:500px;" alt="pet">
            <?php } ?>
            <h3 class="text-warning"><?= $pets->pet_name ?></h3>
            <figcaption class="figure-caption"><?= $pets->pet_desc ?></figcaption>
            <p><?= $pets->pet_price ?></p>
            <button type="button" class="btn btn-primary" onclick="payment(<?= $pets->pet_id ?>)">Beli</button>
            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>frontend/Marketplace/pets'">Kembali</button>
        </figure>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script>
        function payment(id){
            window.location = "<?= base_url(); ?>frontend/marketplace/Pets/pet_payment/"+id;
        }
    </script>
</body>

</html>