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
        <h3 class="text-center text-warning mb-5"><?= lang("ord_detail"); ?></h3>
        <figure class="figure w-50">
            <?php if ($products->pro_photo != '-' &&  $products->pro_photo != null){ ?>
                <img src="<?= base_url('uploads/products/'.$products->pro_photo) ?>" class="figure-img img-fluid rounded" style="max-height:300px;" alt="product">
            <?php } else{ ?>
                <img src="<?= base_url('assets/img/product.jpg') ?>" class="figure-img img-fluid rounded" style="max-height:300px;" alt="product">
            <?php } ?>
            <h4 class="text-warning"><?= $products->pro_name ?></h4>
            <p><?= lang("pro_price"); ?>: Rp <?= number_format($products->pro_price,0,",",".") ?></p>
            <p><?= lang("ord_quantity"); ?>: <?= $this->uri->segment(5); ?></p>
            <p class="h5 text-warning"><?= lang("ord_total_price"); ?>: Rp <?= number_format($products->pro_price * $this->uri->segment(5),0,",","."); ?></p>
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
            <div class="text-center mb-4">
                <button class="btn btn-primary" type="button" id="checkout-button"><?= lang("common_pay"); ?></button>
                <button class="btn btn-danger" type="button" onclick="back(<?= $products->pro_id ?>)"><?= lang("common_back"); ?></button>
            </div>
        </form>
        <div class="modal fade text-dark" id="error-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= lang("common_error_message"); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-danger">
                        <div class="row">
                            <div class="col-12"><?= lang("ord_save_failed"); ?></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script src="https://sandbox.doku.com/jokul-checkout-js/v1/jokul-checkout-1.0.0.js"></script>
    <script type="text/javascript">
        var checkoutButton = document.getElementById('checkout-button');
        checkoutButton.addEventListener('click', function () {
            $(this).attr("disabled", "disabled");
            let amount = <?= $products->pro_price * $this->uri->segment(5) ?>;
            let quantity = <?= $this->uri->segment(5) ?>;
            let pro_id = <?= $products->pro_id ?>;
            $.ajax({
                url: "<?= base_url() ?>marketplace/Payment/saveOrder",
                method: 'post',
                data: {amount: amount, pro_id: pro_id, quantity: quantity},
                success: function(response){
                    if(response != 'failed'){
                        let inv = response;
                        $.ajax({
                            url: "<?= base_url() ?>marketplace/Payment/checkout",
                            method: 'post',
                            data: {amount: amount, inv: inv},
                            success: function(response){
                                if(response.status == 'success'){
                                    // loadJokulCheckout(response.url);
                                    window.location.href = response.url;
                                    $('#checkout-button').removeAttr("disabled");
                                }else if(response.status == 'error'){
                                    alert("HTTP code: " + response.code + "\n" + response.message);
                                    $('#checkout-button').removeAttr("disabled");
                                }
                            }
                        });
                    }
                    else{
                        $('#error-modal').modal('show');
                        $('#checkout-button').removeAttr("disabled");
                    }
                }
            });
        });

        function back(id){
            window.location = "<?= base_url(); ?>marketplace/Products/product_detail/"+id;
        }
    </script>
</body>

</html>