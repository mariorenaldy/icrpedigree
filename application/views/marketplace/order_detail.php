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
            <h6>Delivery Address: <?= $order->ord_address ?></h6>
            <h6>Shipping Type: <?= $order->ord_shipping ?></h6>
            <h6>Order Date: <?= $order->ord_date ?></h6>
            <h6>Pay Date: <?= $order->ord_pay_date ?></h6>
            <h6>Pay Due Date: <?= $order->ord_pay_due_date ?></h6>
            <h6>Arrived Date: <?= $order->ord_arrived_date ?></h6>
            <h6>Completed Date: <?= $order->ord_completed_date ?></h6>
            <h6>Reject Note: <?= $order->ord_reject_note ?></h6>
            <h6>Status: <?= $order->ord_stat_name ?></h6>
            <table class="table table-light table-bordered table-hover table-striped mt-3">
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                </tr>
                <?php 
                $total = 0;
                foreach($items as $itm):
                    $subtotal = $itm->itm_subtotal;
                    $total += $subtotal; 
                ?>

                <tr>
                    <td><?= $itm->itm_id; ?></td>
                    <td><?= $itm->pro_name; ?></td>
                    <td><?= $itm->itm_quantity; ?></td>
                    <td align="right">Rp <?= number_format($itm->pro_price,0,",","."); ?></td>
                    <td align="right">Rp <?= number_format($subtotal,0,",",".") ?></td>
                </tr>
                <?php endforeach; ?>

                <tr>
                    <td colspan="4" align="right">Shipping Cost (<?= $order->ord_shipping ?>)</td>
                    <td align="right">Rp <?= number_format($order->ord_shipping_cost,0,",",".") ?></td>
                </tr>

                <tr>
                    <td colspan="4" align="right">Grand Total</td>
                    <td align="right">Rp <?= number_format($order->ord_total_price,0,",",".") ?></td>
                </tr>
            </table>
            <a href="<?= base_url(); ?>marketplace/Orders/"><div class="btn btn-sm btn-primary">Back</div></a>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>

</html>