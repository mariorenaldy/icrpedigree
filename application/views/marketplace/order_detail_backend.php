<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Order Detail</title>
    <?php $this->load->view('templates/head'); ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/datatables.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/backend-modal.css" />
    <style>
        .dataTables_filter {
            text-align: left !important;
        }
    </style>
</head>

<body>
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImg">
    </div>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <h3 class="text-center text-primary">Order Detail</h3>
                    <div class="btn btn-success mb-3">Invoice: <?= $order->ord_invoice ?></div>
                    <h6>Member Name: <?= $order->mem_name ?></h6>
                    <h6>Delivery Address: <?= $order->ord_address ?></h6>
                    <h6>Shipping Type: <?= $order->ord_shipping ?></h6>
                    <h6>Order Date: <?= $order->ord_date ?></h6>
                    <h6>Pay Date: <?= $order->ord_pay_date ?></h6>
                    <h6>Pay Due Date: <?= $order->ord_pay_due_date ?></h6>
                    <h6>Arrived Date: <?= $order->ord_arrived_date ?></h6>
                    <h6>Completed Date: <?= $order->ord_completed_date ?></h6>
                    <h6>Reject Note: <?= $order->ord_reject_note ?></h6>
                    <h6>Complain Description: <?= $order->com_desc; ?></h6>
                    <h6>Complain Photo: </h6>
                    <?php if ($order->com_photo && $order->com_photo != '-') { ?>
                        <img src="<?= base_url('uploads/complain/' . $order->com_photo) ?>" class="img-fluid img-thumbnail" alt="proof" id="myCom<?= $order->ord_id ?>" onclick="display('myCom<?= $order->ord_id ?>')" style="max-height:100px;">
                    <?php } ?>
                    <h6>Status: <?= $order->ord_stat_name ?></h6>
                    <table class="table table-bordered table-hover table-striped mt-3">
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
                    <a href="<?= base_url(); ?>marketplace/Orders/listOrders"><div class="btn btn-sm btn-primary">Back</div></a>
                </div>
            </div>
        </div>
        <?php $this->load->view('templates/footer'); ?>
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script>
        var modal = document.getElementById("myModal");

        function display(id) {
            var img = document.getElementById(id);
            var modalImg = document.getElementById("modalImg");
            modal.style.display = "block";
            modalImg.src = img.src;
        }

        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
            modal.style.display = "none";
        }
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script>
</body>

</html>