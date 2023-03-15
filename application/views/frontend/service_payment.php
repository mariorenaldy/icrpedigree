<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Payment</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>

<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <figure class="figure w-25">
            <?php if ($services->ser_photo != '-' &&  $services->ser_photo != null){ ?>
                <img src="<?= base_url('uploads/services/'.$services->ser_photo) ?>" class="figure-img img-fluid rounded" style="max-height:300px;" alt="service">
            <?php } else{ ?>
                <img src="<?= base_url('assets/img/service.jpg') ?>" class="figure-img img-fluid rounded" style="max-height:300px;" alt="service">
            <?php } ?>
            <h3 class="text-warning"><?= $services->ser_name ?></h3>
            <figcaption class="figure-caption"><?= $services->ser_desc ?></figcaption>
            <p><?= $services->ser_price ?></p>
        </figure>
        <form id="mainForm" class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="text-danger">
                <?php
                if ($this->session->flashdata('error_message')) {
                    echo $this->session->flashdata('error_message') . '<br/>';
                }
                echo validation_errors();
                ?>
            </div>
            <div class="input-group mb-3">
                <label for="mem_address" class="control-label col-sm-2">Alamat</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" placeholder="Alamat" name="address" value="<?= set_value('address'); ?>">
                </div>
            </div>
            <div class="input-group mb-3">
                <label for="mem_ktp" class="control-label col-sm-2">Pilih Pengiriman</label>
                <?php
                $options = array(
                    'instan'         => 'Instan',
                    'same_day'         => 'Same Day',
                    'next_day'         => 'Next Day',
                    'reguler'           => 'Reguler'
                );
                echo form_dropdown('ken_type_id', $options, set_value('ken_type_id'), 'class="form-control", id="ken_type_id"');
                ?>
            </div>
            <div class="input-group mb-3">
                <label for="mem_ktp" class="control-label col-sm-2">Pilih Kurir</label>
                <?php
                $options = array(
                    'JNE'         => 'JNE',
                    'J&T'         => 'J&T',
                    'SiCepat'         => 'SiCepat'
                );
                echo form_dropdown('ken_type_id', $options, set_value('ken_type_id'), 'class="form-control", id="ken_type_id"');
                ?>
            </div>
            <div class="input-group mb-3">
                <label for="mem_ktp" class="control-label col-sm-2">Pilih Pembayaran</label>
                <?php
                $options = array(
                    'BCA'         => 'BCA',
                    'BNI'         => 'BNI',
                    'BRI'         => 'BRI'
                );
                echo form_dropdown('ken_type_id', $options, set_value('ken_type_id'), 'class="form-control", id="ken_type_id"');
                ?>
            </div>
            <div class="text-center">
                <button class="btn btn-primary" type="button" id="checkout-button">Bayar</button>
                <button class="btn btn-danger" type="button" onclick="back(<?= $services->ser_id ?>)">Kembali</button>
            </div>
        </form>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script src="https://sandbox.doku.com/jokul-checkout-js/v1/jokul-checkout-1.0.0.js"></script>
    <script type="text/javascript">
        var checkoutButton = document.getElementById('checkout-button');
        checkoutButton.addEventListener('click', function () {
            let amount = <?= $services->ser_price ?>;
            $.ajax({
                url: "<?= base_url() ?>frontend/Marketplace/checkout",
                method: 'post',
                data: {amount: amount},
                success: function(response){
                    if(response.status == 'success'){
                        loadJokulCheckout(response.url);
                    }else if(response.status == 'error'){
                        alert("HTTP code: " + response.code + "\n" + response.message);
                    }
                }
            });
        });

        function back(id){
            window.location = "<?= base_url(); ?>frontend/Marketplace/service_detail/"+id;
        }
    </script>
</body>

</html>