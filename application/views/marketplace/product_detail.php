<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title><?= lang("pro_detail"); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>

<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <figure class="figure w-50">
            <?php if ($products->pro_photo != '-' &&  $products->pro_photo != null) { ?>
                <img src="<?= base_url('uploads/products/' . $products->pro_photo) ?>" class="figure-img img-fluid rounded" style="max-height:500px;" alt="product">
            <?php } else { ?>
                <img src="<?= base_url('assets/img/product.jpg') ?>" class="figure-img img-fluid rounded" style="max-height:500px;" alt="product">
            <?php } ?>
            <h4 class="text-warning"><?= $products->pro_name ?></h4>
            <p class="mb-5"><?= $products->pro_desc ?></p>
            <h5 class="text-warning mb-4">Rp <?= number_format($products->pro_price,0,",",".") ?></h5>
            <div class="col-3 mb-5">
                <div class="input-group mb-3">
                    <span class="input-group-btn">
                        <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus" data-field="">
                            <span class="fa fa-minus"></span>
                        </button>
                    </span>
                    <input type="hidden" id="stock" name="stock" value="<?= $products->pro_stock; ?>">
                    <input type="number" id="quantity" name="quantity" class="form-control input-number text-center" value="1" min="1" max="100" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
                    <span class="input-group-btn">
                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                            <span class="fa fa-plus"></span>
                        </button>
                    </span>
                </div>
            </div>
            <button type="button" class="btn btn-primary" onclick="payment(<?= $products->pro_id ?>)"><?= lang("common_buy"); ?></button>
            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>marketplace/Products'"><?= lang("common_back"); ?></button>
        </figure>
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