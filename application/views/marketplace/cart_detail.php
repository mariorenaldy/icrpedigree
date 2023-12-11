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
        <table class="table table-light table-bordered table-striped table-hover">
            <tr>
                <th>No.</th>
                <th><?= lang("pro_name"); ?></th>
                <th><?= lang("pro_quantity"); ?></th>
                <th><?= lang("pro_weight"); ?></th>
                <th><?= lang("pro_price"); ?></th>
                <th>Subtotal</th>
            </tr>
            <?php 
            $no=1;
            $totalWeight=0;
            foreach($this->cart->contents() as $items):?>
                <?php $totalWeight = $totalWeight+($items['qty']*$items['weight']);?>
                <tr>
                    <td><?= $no++;?></td>
                    <td><?= $items['name'];?></td>
                    <td><?= $items['qty'];?></td>
                    <td align="right"><?= $items['qty']*$items['weight'];?> gram</td>
                    <td align="right">Rp <?= number_format($items['price'],0,",",".") ?></td>
                    <td align="right">Rp <?= number_format($items['subtotal'],0,",",".") ?></td>
                </tr>
            <?php endforeach ?>
                <tr>
                    <td colspan="3" align="right">Total <?= lang("pro_weight"); ?></td>
                    <td align="right"><?= $totalWeight ?> gram</td>
                    <td align="right"><?= lang("pro_total_price"); ?></td>
                    <td align="right">Rp <?= number_format($this->cart->total(),0,",",".") ?></td>
                </tr>
        </table>

        <a href=""></a>
        <div align="right">
            <button type="button" class="fw-normal btn btn-sm btn-danger" onclick="clear_cart()"><?= lang("pro_empty_cart"); ?></button>
            <button type="button" class="fw-normal btn btn-sm btn-primary" onclick="market()"><?= lang("pro_continue_shopping"); ?></button>
            <button type="button" class="fw-normal btn btn-sm btn-success" onclick="checkout()"><?= lang("pro_checkout"); ?></button>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script>
        function clear_cart(){
            window.location = "<?= base_url(); ?>marketplace/Products/clear_cart/";
        }
        function market(){
            window.location = "<?= base_url(); ?>marketplace/Products/";
        }
        function checkout(){
            window.location = "<?= base_url(); ?>marketplace/Products/checkout/";
        }
    </script>
</body>

</html>