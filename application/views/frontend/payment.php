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
            <img src="<?= base_url('assets/img/product.jpg') ?>" class="figure-img img-fluid rounded" alt="...">
            <h3 class="text-warning">PEDIGREE POUCH</h3>
            <figcaption class="figure-caption">RAW FOOD</figcaption>
            <p>6000</p>
        </figure>
        <form id="mainForm" class="form-horizontal" action="<?php echo base_url(); ?>frontend/Members/validate_register" method="post" enctype="multipart/form-data">
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
                // foreach ($kennelType as $row) {
                //     $pil[$row->ken_type_id] = $row->ken_type_name;
                // }
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
                // foreach ($kennelType as $row) {
                //     $pil[$row->ken_type_id] = $row->ken_type_name;
                // }
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
                // foreach ($kennelType as $row) {
                //     $pil[$row->ken_type_id] = $row->ken_type_name;
                // }
                $options = array(
                    'BCA'         => 'BCA',
                    'BNI'         => 'BNI',
                    'BRI'         => 'BRI'
                );
                echo form_dropdown('ken_type_id', $options, set_value('ken_type_id'), 'class="form-control", id="ken_type_id"');
                ?>
            </div>
            <div class="text-center">
                <button class="btn btn-primary" type="button" id="registerBtn" onclick="window.location = '<?= base_url() ?>frontend/Marketplace/demo'">Bayar</button>
                <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>frontend/Marketplace/product_detail'">Kembali</button>
            </div>
        </form>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>

</html>