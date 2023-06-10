<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title><?= lang("ord_detail"); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>

<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <h3 class="text-center text-warning mb-5"><?= lang("ord_detail"); ?></h3>
        <div class="d-flex align-items-center justify-content-center">
            <figure class="w-50">
                <h4 class="text-warning">Invoice: <?= $order->ord_invoice ?></h4>
                <p><?= lang("ord_date"); ?>: <?= date('d-m-Y H:i:s', strtotime($order->ord_created_at)) ?></p>
                <?php if($order->ord_stat_id != $this->config->item('order_cancelled') && $order->ord_stat_id != $this->config->item('order_not_paid') &&  $order->ord_stat_id != $this->config->item('order_failed')){
                    echo '<p>'.lang('ord_pay_date').': '.date('d-m-Y H:i:s', strtotime($order->ord_pay_date)).'</p>';
                } ?>
                <span><?= lang("pro_name"); ?>: </span>
                <span class="text-warning mb-5"><?= $order->pro_name ?></span>
                <br>
                <div class="text-center">
                    <?php if ($order->pro_photo != '-' &&  $order->pro_photo != null) { ?>
                        <img src="<?= base_url('uploads/products/' . $order->pro_photo) ?>" class="figure-img img-fluid rounded mt-3" style="max-height:150px;" alt="product">
                    <?php } else { ?>
                        <img src="<?= base_url('assets/img/product.jpg') ?>" class="figure-img img-fluid rounded mt-3" style="max-height:150px;" alt="product">
                    <?php } ?>
                </div>
                <p><?= lang('ord_quantity'); ?>: <?= $order->ord_quantity ?></p>
                <p><?= lang('ord_total_price'); ?>: Rp <?= number_format($order->ord_total_price,0,",",".") ?></p>
                <p><?= lang('ord_stat'); ?>: <?= $order->ord_stat_name ?></p>
                <?php
                if($order->ord_stat_id == $this->config->item('order_not_paid') || $order->ord_stat_id == $this->config->item('order_failed')){
                    echo '<span class="text-danger h5">'.lang('ord_due_date').':</span><span class="h5"> '.date('d-m-Y H:i:s', strtotime($order->ord_pay_due_date)).'</span>';
                }
                else if($order->ord_stat_id == $this->config->item('order_rejected')){
                    echo '<span>'.lang('common_reason').':</span><span class="text-danger"> '.$order->ord_reject_note.'</span>';
                }
                else if($order->ord_stat_id == $this->config->item('order_completed')){
                    echo '<p class="mt-3">'.lang('ord_completed_date').': '.date('d-m-Y H:i:s', strtotime($order->ord_completed_date)).'</p>';
                }
                else if($order->ord_stat_id == $this->config->item('order_arrived')){
                    echo '<p class="mt-3">'.lang('ord_arrived_date').': '.date('d-m-Y H:i:s', strtotime($order->ord_arrived_date)).'</p>';
                }
                else if($order->ord_stat_id == $this->config->item('order_complained')){
                    echo '<p class="mt-3 mb-5">'.lang('ord_complained_date').': '.date('d-m-Y H:i:s', strtotime($order->ord_completed_date)).'</p>';
                    if($order->com_photo != '-' && $order->com_photo != null){
                        echo '<p>'.lang('ord_complain_photo').': </p>';
                        echo '<img src="'.base_url('uploads/complain/'.$order->com_photo).'" class="figure-img img-fluid rounded mb-3" style="max-height:150px;" alt="proof">';
                    }
                    echo '<br>';
                    echo '<span>'.lang('ord_complain_desc').': </span>';
                    echo '<span>'.$order->com_desc.'</span>';
                }
                ?>
                <div class="text-center mt-5">
                    <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>marketplace/Orders'"><?= lang("common_back"); ?></button>
                </div>
            </figure>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script>
        function payment(id) {
            window.location = "<?= base_url(); ?>marketplace/Products/product_payment/" + id + "/" + $('#quantity').val();
        }
        $(document).ready(function() {
            var quantity = 0;
            var stock = document.getElementById("stock").value;
            $('.quantity-right-plus').click(function(e) {

                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // Increment
                if (quantity < stock) {
                    $('#quantity').val(quantity + 1);
                }
            });

            $('.quantity-left-minus').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // Decrement
                if (quantity > 1) {
                    $('#quantity').val(quantity - 1);
                }
            });

            $('#quantity').on("input", function() {
                var quantity = parseInt($('#quantity').val());
                
                if (quantity < 0 ) {
                    $('#quantity').val(1);
                }
                else if(quantity > stock){
                    $('#quantity').val(stock);
                }
            });

            $('#quantity').change(function() {
                if(!$('#quantity').val()){
                    $('#quantity').val(0);
                }
                $('#quantity').val("" + parseInt($('#quantity').val()));
            });
        });
    </script>
</body>

</html>