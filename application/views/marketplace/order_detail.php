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
        <div class="container-fluid">
            <div class="btn btn-success mb-3">Invoice: <?= $order->ord_invoice ?></div>
            <h6><?= lang("common_city/regency"); ?>: <?= $order->city_name ?></h6>
            <h6><?= lang("common_full_address"); ?>: <?= $order->ord_address ?></h6>
            <h6><?= lang("ord_shipping"); ?>: <?= $order->ship_name ?></h6>
            <h6><?= lang("ord_shipping_type"); ?>: <?= $order->ord_shipping_type ?></h6>
            <h6><?= lang("ord_date"); ?>: <?= $order->ord_date ?></h6>
            <h6><?= lang("ord_pay_date"); ?>: <?= $order->ord_pay_date ?></h6>
            <h6><?= lang("ord_due_date"); ?>: <?= $order->ord_pay_due_date ?></h6>
            <h6><?= lang("ord_arrived_date"); ?>: <?= $order->ord_arrived_date ?></h6>
            <h6><?= lang("ord_completed_date"); ?>: <?= $order->ord_completed_date ?></h6>
            <h6><?= lang("ord_reject_note"); ?>: <?= $order->ord_reject_note ?></h6>
            <h6><?= lang("ord_complain_desc"); ?>: <?= $order->com_desc; ?></h6>
            <h6><?= lang("ord_complain_photo"); ?>: </h6>
            <?php if ($order->com_photo && $order->com_photo != '-') { ?>
                <img src="<?= base_url('uploads/complain/' . $order->com_photo) ?>" class="img-fluid img-thumbnail" alt="proof" id="myCom<?= $order->ord_id ?>" onclick="display('myCom<?= $order->ord_id ?>')" style="max-height:100px;">
            <?php } ?>
            <h6>Status: <?= $order->ord_stat_name ?></h6>
            <table class="table table-light table-bordered table-hover table-striped mt-3">
                <tr>
                    <th>No.</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th><?= lang("pro_weight"); ?></th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                </tr>
                <?php 
                $totalWeight=0;
                $total = 0;
                $no = 1;
                foreach($items as $itm):
                    $totalWeight = $totalWeight+($itm->itm_quantity*$itm->pro_weight);
                    $subtotal = $itm->itm_subtotal;
                    $total += $subtotal; 
                ?>

                <tr>
                    <td><?php echo $no; $no++; ?></td>
                    <td><?= $itm->pro_name; ?></td>
                    <td><?= $itm->itm_quantity; ?></td>
                    <td align="right"><?= $itm->itm_quantity*$itm->pro_weight;?> gram</td>
                    <td align="right">Rp <?= number_format($itm->pro_price,0,",","."); ?></td>
                    <td align="right">Rp <?= number_format($subtotal,0,",",".") ?></td>
                </tr>
                <?php endforeach; ?>

                <tr>
                    <td colspan="3" align="right">Total <?= lang("pro_weight"); ?></td>
                    <td align="right"><?= $totalWeight ?> gram</td>
                    <td align="right">Total Price</td>
                    <td align="right">Rp <?= number_format($total,0,",",".") ?></td>
                </tr>

                <tr>
                    <td colspan="5" align="right">Shipping Cost</td>
                    <td align="right">Rp <?= number_format($order->ord_shipping_cost,0,",",".") ?></td>
                </tr>

                <tr>
                    <td colspan="5" align="right">Grand Total</td>
                    <td align="right">Rp <?= number_format($order->ord_total_price,0,",",".") ?></td>
                </tr>
            </table>
            <a href="<?= base_url(); ?>marketplace/Orders/"><div class="btn btn-sm btn-primary">Back</div></a>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>

</html>