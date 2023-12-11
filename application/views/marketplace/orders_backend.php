<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Order List</title>
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
                <h3 class="text-center text-primary">Order List</h3>
                <div class="text-success">
                    <?php
                    if ($this->session->flashdata('add_success')) {
                        echo 'Order has been saved<br/>';
                    }
                    if ($this->session->flashdata('edit_success')) {
                        echo 'Order has been edited<br/>';
                    }
                    if ($this->session->flashdata('delete_success')) {
                        echo 'Order has been deleted<br/>';
                    }
                    if ($this->session->flashdata('deliver_success')) {
                        echo 'Order has been delivered<br/>';
                    }
                    if ($this->session->flashdata('arrive_success')) {
                        echo 'Order has set to arrived<br/>';
                    }
                    if ($this->session->flashdata('reject_success')) {
                        echo 'Order has been rejected<br/>';
                    }
                    ?>
                </div>
                <div class="text-danger">
                    <?php
                    if ($this->session->flashdata('delete_message')) {
                        echo $this->session->flashdata('delete_message') . '<br/>';
                    }
                    ?>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" onclick="add()" data-toggle="tooltip" data-placement="top" title="Add Order"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="no-sort"></th>
                                <th class="no-sort"></th>
                                <th class="no-sort"></th>
                                <th class="no-sort"></th>
                                <th class="no-sort"></th>
                                <th>Invoice</th>
                                <th class="no-sort">Member</th>
                                <th class="no-sort">Full Address</th>
                                <th>Shipping Service</th>
                                <th>Grand Total</th>
                                <th>Order Date</th>
                                <th class="no-sort">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $o) { ?>
                                <tr>
                                    <td class="text-center">
                                        <?php if ($o->ord_stat_id == $this->config->item('order_paid')) { ?>
                                            <button type="button" class="btn btn-primary mb-1" onclick="deliver(<?= $o->ord_id ?>, '<?= $o->ord_invoice ?>')" data-toggle="tooltip" data-placement="top" title="Deliver Order"><i class="fa fa-truck"></i></button>
                                        <?php } else if ($o->ord_stat_id == $this->config->item('order_delivered')) { ?>
                                            <button type="button" class="btn btn-primary mb-1" onclick="arrive(<?= $o->ord_id ?>, '<?= $o->ord_invoice ?>')" data-toggle="tooltip" data-placement="top" title="Order Arrived"><i class="fa fa-check"></i></button>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($o->ord_stat_id == $this->config->item('order_paid') || $o->ord_stat_id == $this->config->item('order_delivered')) { ?>
                                            <button type="button" class="btn btn-danger mb-1" onclick="reject(<?= $o->ord_id ?>, '<?= $o->ord_invoice ?>')" data-toggle="tooltip" data-placement="top" title="Reject Order"><i class="fa fa-xmark"></i></button>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success mb-1" onclick="edit(<?= $o->ord_id ?>)" data-toggle="tooltip" data-placement="top" title="Edit Order"><i class="fa fa-edit"></i></button>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')) { ?>
                                            <button type="button" class="btn btn-dark mb-1" onclick="log(<?= $o->ord_id ?>)" data-toggle="tooltip" data-placement="top" title="Order Log"><i class="fa fa-history"></i></button>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-info mb-1" onclick="detail(<?= $o->ord_id ?>)" data-toggle="tooltip" data-placement="top" title="Order Detail"><i class="fa-solid fa-list"></i></button>
                                    </td>
                                    <td><?= $o->ord_invoice; ?></td>
                                    <td><?= $o->mem_name; ?></td>
                                    <td><?= $o->ord_address; ?></td>
                                    <td><?= $o->ship_name." (".$o->ord_shipping_type.")"; ?></td>
                                    <td><?php echo 'Rp '.number_format($o->ord_total_price,0,",",".").'<br/>'; ?></td>
                                    <td class="text-nowrap"><?= $o->ord_date; ?></td>
                                    <td><?= $o->ord_stat_name; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php $this->load->view('templates/footer'); ?>
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script>
        function add() {
            window.location = "<?= base_url(); ?>marketplace/Orders/add";
        }

        function edit(id) {
            window.location = "<?= base_url(); ?>marketplace/Orders/edit/" + id;
        }
        // function reject(id, inv){
        //     var proceed = window.prompt("Reject "+inv+" ?", "");
        //     if (proceed){
        //         window.location = "<?= base_url(); ?>marketplace/Orders/reject/"+id+"/"+encodeURIComponent(proceed);
        //     }
        // }
        function reject(id, inv) {
            window.location = "<?= base_url(); ?>marketplace/Orders/reject/" + id;
        }
        function detail(id, inv) {
            window.location = "<?= base_url(); ?>marketplace/Orders/order_detail/" + id;
        }

        function deliver(id, inv) {
            var proceed = confirm("Set " + inv + " status as delivered ?");
            if (proceed) {
                window.location = "<?= base_url(); ?>marketplace/Orders/deliver/" + id;
            }
        }

        function arrive(id, inv) {
            var proceed = confirm("Set " + inv + " status as arrived ?");
            if (proceed) {
                window.location = "<?= base_url(); ?>marketplace/Orders/arrive/" + id;
            }
        }

        function log(id) {
            window.location = "<?= base_url(); ?>marketplace/Orders/log/" + id;
        }

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

        $(document).ready(function() {
            $('#datatable').DataTable({
                "lengthChange": false,
                searching: true,
                info: false,
                "ordering": true,
                order: [
                    [6, 'desc']
                ],
                dom: 'lpftrip',
                columnDefs: [{
                    orderable: false,
                    targets: "no-sort"
                }]
            });
        });

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script>
</body>

</html>