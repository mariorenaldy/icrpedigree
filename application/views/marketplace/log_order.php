<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Order Log</title>
    <?php $this->load->view('templates/head'); ?>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/backend-modal.css" />
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
                <h3 class="text-center text-primary">Order Log</h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Last Modified</th>
                                <th>Member</th>
                                <th>Invoice</th>
                                <th>City/Regency</th>
                                <th>Full Address</th>
                                <th>Shipping Service</th>
                                <th>Shipping Type</th>
                                <th>Grand Total (Rp)</th>
                                <th>Status</th>
                                <th>Reject Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($order AS $o){ ?>
                                    <tr>
                                        <td><span class="text-nowrap"><?= $o->log_date; ?></span><br/>(<?= $o->user; ?>)</td>
                                        <td><?= $o->mem_name; ?></td>
                                        <td><?= $o->log_invoice; ?></td>
                                        <td><?= $o->city_name; ?></td>
                                        <td><?= $o->log_address; ?></td>
                                        <td><?= $o->ship_name; ?></td>
                                        <td><?= $o->log_shipping_type; ?></td>
                                        <td><?= number_format($o->log_total_price,0,",","."); ?></td>
                                        <td><?= $o->ord_stat_name; ?></td>
                                        <td><?= $o->log_reject_note; ?></td>
                                    </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div> 
            <div class="col-md-12 text-center">
                <button class="btn btn-primary" type="button" onclick="window.location = '<?= base_url() ?>marketplace/Orders/listOrders'"><i class="fa fa-arrow-left"></i></button>
            </div>                      
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script>
        var modal = document.getElementById("myModal");
        function display(id){
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
</body>
</html>