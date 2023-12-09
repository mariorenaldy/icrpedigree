<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title><?= lang("pro_cart"); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>

<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h3>Input Alamat dan Jenis Pengiriman</h3>

                    <form method="post">
                        <div class="form-group">
                            <label>Alamat Pengiriman</label>
                            <input class="form-control" type="text" name="address" placeholder="Alamat Pengiriman" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Pengiriman</label>
                            <select class="form-control" name="shipping" id="shipping">
                                <option value="Reguler">Reguler</option>
                                <option value="Ekonomi">Ekonomi</option>
                            </select>
                        </div><br>
                        <?php 
                            $grand_total = 0;
                            if($cart = $this->cart->contents()){
                                foreach($cart as $item){
                                    $grand_total = $grand_total + $item['subtotal'];
                                }
                                echo "<h6>Total Harga: Rp <span id='totalPrice'>".number_format($grand_total,0,",",".")."</span></h6>";
                            ?>
                        <h6>Ongkos Kirim: Rp <span id='shippingCost'></span></h6>
                        <input type='hidden' name='shippingCost'/> 
                        <div class="btn btn-sm btn-success" style="pointer-events: none;">
                            <h5>Total Belanja: Rp <span id='totalPayment'></h5>
                            <input type='hidden' name='totalPayment'/> 
                        </div><br><br>
                        <button id="checkout-button" type="button" class="btn btn-primary mt-3"><?= lang("common_pay"); ?></button>
                    </form>
                    <?php 
                    } else{
                        echo "<h5>Keranjang Belanja Anda Masih Kosong";
                    }
                    ?>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
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
    <script type="text/javascript">
        var totalPrice = $("#totalPrice").text();
        $("#shipping").on("change",function() {
            var shippingSelect = document.getElementById('shipping');
            var shippingCostElement = document.getElementById('shippingCost');
            var shippingCost = 13000;
            if (shippingSelect.value == "Reguler") {
                shippingCostElement.innerHTML = numberWithPeriods(13000);
                shippingCost = 13000;
                $('input[name="shippingCost"]').val(shippingCost);
            } else if (shippingSelect.value == "Ekonomi") {
                shippingCostElement.innerHTML = numberWithPeriods(12000);
                shippingCost = 12000;
                $('input[name="shippingCost"]').val(shippingCost);
            }

            var totalPayment = shippingCost + <?php echo json_encode($grand_total); ?>;
            $('#totalPayment').text(numberWithPeriods(totalPayment));
            $('input[name="totalPayment"]').val(totalPayment);
        }).change();

        function numberWithPeriods(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        var checkoutButton = document.getElementById('checkout-button');
        checkoutButton.addEventListener('click', function () {
            $(this).attr("disabled", "disabled");
            let amount = $('input[name="totalPayment"]').val();
            let address = $('input[name="address"]').val();
            let shipping = $('select[name="shipping"]').find(":selected").val();
            let shippingCost = $('input[name="shippingCost"]').val();
            $.ajax({
                url: "<?= base_url() ?>marketplace/Payment/saveOrder",
                method: 'post',
                data: {amount: amount, address: address, shipping: shipping, shippingCost: shippingCost},
                success: function(response){
                    if(response != 'failed'){
                        let inv = response;
                        $.ajax({
                            url: "<?= base_url() ?>marketplace/Payment/checkout",
                            method: 'post',
                            data: {amount: amount, inv: inv},
                            success: function(response){
                                if(response.status == 'success'){
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
    </script>
</body>

</html>