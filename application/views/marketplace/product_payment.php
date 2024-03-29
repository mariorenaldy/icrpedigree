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
            <?php if ($products->pro_photo != '-' &&  $products->pro_photo != null){ ?>
                <img src="<?= base_url('uploads/products/'.$products->pro_photo) ?>" class="figure-img img-fluid rounded" style="max-height:300px;" alt="product">
            <?php } else{ ?>
                <img src="<?= base_url('assets/img/product.jpg') ?>" class="figure-img img-fluid rounded" style="max-height:300px;" alt="product">
            <?php } ?>
            <h3 class="text-warning"><?= $products->pro_name ?></h3>
            <figcaption class="figure-caption"><?= $products->pro_desc ?></figcaption>
            <p>Harga Satuan: <?= $products->pro_price ?></p>
            <p>Jumlah Pembelian: <?= $this->uri->segment(5); ?></p>
            <p class="h5 text-warning">Total Harga: <?= $products->pro_price * $this->uri->segment(5); ?></p>
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
            <div class="text-center">
                <button class="btn btn-primary" type="button" id="checkout-button">Bayar</button>
                <button class="btn btn-danger" type="button" onclick="back(<?= $products->pro_id ?>)">Kembali</button>
            </div>
        </form>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script src="https://sandbox.doku.com/jokul-checkout-js/v1/jokul-checkout-1.0.0.js"></script>
    <script type="text/javascript">
        var checkoutButton = document.getElementById('checkout-button');
        checkoutButton.addEventListener('click', function () {
            if(!$('input[name="address"]').val()){
                alert("Alamat belum diisi!");
            }
            else{
                let amount = <?= $products->pro_price * $this->uri->segment(5) ?>;
                $.ajax({
                    url: "<?= base_url() ?>marketplace/Payment/checkout",
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
            }
        });

        function back(id){
            window.location = "<?= base_url(); ?>marketplace/Products/product_detail/"+id;
        }
    </script>
</body>

</html>