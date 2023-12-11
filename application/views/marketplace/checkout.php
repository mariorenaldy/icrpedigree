<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Checkout</title>
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
                    <h3>Input <?= lang("common_address"); ?> <?= lang("common_and"); ?> <?= lang("ord_delivery_type"); ?></h3>

                    <form method="post" id="dataForm">
                        <div class="form-group">
                            <label><?= lang("common_province"); ?></label>
                            <select class="form-control" name="province" id="province">
                            </select>
                        </div>
                        <div class="form-group">
                            <label><?= lang("common_city/regency"); ?></label>
                            <select class="form-control" name="city" id="city">
                            </select>
                        </div>
                        <div class="form-group">
                            <label><?= lang("common_full_address"); ?></label>
                            <input class="form-control" type="text" name="address" placeholder="<?= lang("common_full_address"); ?>" required>
                        </div>
                        <div class="form-group">
                            <label><?= lang("ord_shipping"); ?></label>
                            <select class="form-control" name="shipping" id="shipping">
                                <option value="">--<?= lang("ord_select_shipping"); ?>--</option>
                                <option idShip="1" value="jne">JNE</option>
                                <option idShip="2" value="tiki">TIKI</option>
                                <option idShip="3" value="pos">POS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><?= lang("ord_shipping_type"); ?></label>
                            <select class="form-control" name="shipping_type" id="shipping_type">
                            </select>
                        </div><br>
                        <?php 
                            $grand_total = 0;
                            $totalWeight = 0;
                            if($cart = $this->cart->contents()){
                                foreach($cart as $item){
                                    $grand_total = $grand_total + $item['subtotal'];
                                    $totalWeight = $totalWeight + ($item['weight']*$item['qty']);
                                }
                                echo "<h6>".lang("ord_total_weight").": <span id='totalWeight'>".number_format($totalWeight, 0, ',', '.')." gram</span></h6>";
                                echo "<h6>".lang("ord_total_price").": Rp <span id='totalPrice'>".number_format($grand_total,0,",",".")."</span></h6>";
                            ?>
                        <h6><?= lang("ord_shipping_cost"); ?>: Rp <span id='shippingCost'>0</span></h6>
                        <input type='hidden' name='shippingCost'/> 
                        <div class="btn btn-sm btn-success" style="pointer-events: none;">
                            <h5>Grand Total: Rp <span id='totalPayment'><?= number_format($grand_total,0,",",".")?></h5>
                            <input type='hidden' name='totalPayment'/> 
                        </div><br><br>
                        <button id="checkout-button" type="button" class="btn btn-primary mt-3"><?= lang("common_pay"); ?></button>
                    </form>
                    <?php 
                    } else{
                        echo "<h5>".lang("ord_cart_still_empty");
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
                            <div class="col-12" id="errorMesage"></div>
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
        var checkoutButton = document.getElementById('checkout-button');
        checkoutButton.addEventListener('click', function () {
            if(!$('select[name=province]').find(":selected").val()){
                $('#errorMesage').html("Please select the province to deliver to");
                $('#error-modal').modal('show');
            }
            else if(!$('select[name=city]').find(":selected").val()){
                $('#errorMesage').html("Please select the city to deliver to");
                $('#error-modal').modal('show');
            }
            else if(!$('input[name=address]').val()){
                $('#errorMesage').html("Please input the address to deliver to");
                $('#error-modal').modal('show');
            }
            else if(!$('select[name=shipping]').val()){
                $('#errorMesage').html("Please select a shipping service");
                $('#error-modal').modal('show');
            }
            else if(!$('select[name=shipping_type]').val()){
                $('#errorMesage').html("Please select a shipping type");
                $('#error-modal').modal('show');
            }
            else{
                $(this).attr("disabled", "disabled");
                let amount = $('input[name="totalPayment"]').val();
                let city = $('select[name="city"]').find(":selected").val();
                let address = $('input[name="address"]').val();
                let shipping = $('select[name="shipping"]').find(":selected").attr('idShip');
                let shippingType = $('select[name="shipping_type"]').find(":selected").val();
                let shippingCost = $('input[name="shippingCost"]').val();
                $.ajax({
                    url: "<?= base_url() ?>marketplace/Payment/saveOrder",
                    method: 'post',
                    data: {amount: amount, city: city, address: address, shipping: shipping, shippingType: shippingType, shippingCost: shippingCost},
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
            }
        });

        $(document).ready(function(){
            $('select[name=shipping_type]').attr('disabled', 'disabled');
            $('select[name=shipping]').attr('disabled', 'disabled');
            $('select[name=city]').attr('disabled', 'disabled');
            
            $.ajax({
                url: "<?= base_url() ?>marketplace/Shipping/getProvince",
                method: 'get',
                success: function(response){
                    if (response.includes("Error")) {
                        $('#errorMesage').html(response.slice(6));
                        $('#error-modal').modal('show');
                    }
                    else{
                        $("select[name=province]").html(response);
                    }
                }
            });
        });

        $("select[name=province]").on("change", function(){
            $("select[name=shipping_type]").empty();
            $('select[name=shipping_type]').attr('disabled', 'disabled');
            $('#shippingCost').text(0);
            $("#shipping").val('');
            $('select[name=shipping]').attr('disabled', 'disabled');
            $('#totalPayment').text(0);
            var provinceID = $(this).find(":selected").val();
            $.ajax({
                url: "<?= base_url() ?>marketplace/Shipping/getCity",
                method: 'post',
                data: 'provinceID='+provinceID,
                success: function(response){
                    if (response.includes("Error")) {
                        $('#errorMesage').html(response.slice(6));
                        $('#error-modal').modal('show');
                    }
                    else{
                        $("select[name=city]").html(response);
                    }
                }
            });

            if(!$(this).find(":selected").val()){
                $('select[name=city]').attr('disabled', 'disabled');
            }
            else{
                $('select[name=city]').removeAttr('disabled');
            }
        });

        $("select[name=city]").on("change", function(){
            $("select[name=shipping_type]").empty();
            $('select[name=shipping_type]').attr('disabled', 'disabled');
            $('#shippingCost').text(0);
            $("#shipping").val('');
            $('#totalPayment').text(0);

            if(!$(this).find(":selected").val()){
                $('select[name=shipping]').attr('disabled', 'disabled');
            }
            else{
                $('select[name=shipping]').removeAttr('disabled');
            }
        });

        $("select[name=shipping]").on("change", function(){
            $("select[name=shipping_type]").empty();
            $('#shippingCost').text(0);
            $('#totalPayment').text(0);
            var cityID = $("select[name=city]").find(":selected").val();
            var weight = <?= $totalWeight; ?>;
            var shipping = $("select[name=shipping]").find(":selected").val();
            $.ajax({
                url: "<?= base_url() ?>marketplace/Shipping/getCost",
                method: 'post',
                data: {cityID: cityID, weight: weight, shipping: shipping},
                success: function(response){
                    if (response.includes("Error")) {
                        if(response.includes("Weight tidak boleh lebih dari 30KG atau 30.000 gram")){
                            $('#errorMesage').html("<?= lang("pro_weight_exceed"); ?>");
                        }
                        else{
                            $('#errorMesage').html(response.slice(6));
                        }
                        $('#error-modal').modal('show');
                    }
                    else{
                        $("select[name=shipping_type]").html(response);
                    }
                }
            });

            if(!$(this).find(":selected").val()){
                $('select[name=shipping_type]').attr('disabled', 'disabled');
            }
            else{
                $('select[name=shipping_type]').removeAttr('disabled');
            }
        });

        var totalPrice = $("#totalPrice").text();

        function numberWithPeriods(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    
        $("select[name=shipping_type]").on("change", function(){
            var shippingCostElement = document.getElementById('shippingCost');
            var shippingCost = parseInt($("select[name=shipping_type]").find('option:selected').attr("cost"));
            shippingCostElement.innerHTML = numberWithPeriods(shippingCost);
            $('input[name="shippingCost"]').val(shippingCost);

            var totalPayment = shippingCost + <?php echo json_encode($grand_total); ?>;
            $('#totalPayment').text(numberWithPeriods(totalPayment));
            $('input[name="totalPayment"]').val(totalPayment);
        });
    </script>
</body>

</html>