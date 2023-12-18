<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Request Microchip Log</title>
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
                <h3 class="text-center text-primary">Request Microchip Log</h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Last Modified</th>
                                <th>ID</th>
                                <th>Member</th>
                                <th>Dog's Name</th>
                                <th>Appointment Date</th>
                                <th>Status</th>
                                <th>Payment Method</th>
                                <th>DOKU Invoice</th>
                                <th>Payment Proof</th>
                                <th>Reject Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($request AS $r){ ?>
                                    <tr>
                                        <td><span class="text-nowrap"><?= $r->log_date; ?></span><br/>(<?= $r->user; ?>)</td>
                                        <td><?= $r->log_req_id; ?></td>
                                        <td><?= $r->mem_name; ?></td>
                                        <td><?= $r->can_a_s; ?></td>
                                        <td><?= $r->log_datetime; ?></td>
                                        <td><?= $r->micro_stat_name; ?></td>
                                        <td><?= $r->pay_name; ?></td>
                                        <td><?= $r->log_pay_invoice; ?></td>
                                        <td>
                                            <?php
                                                if ($r->log_pay_photo && $r->log_pay_photo != '-'){
                                                    echo '<img src="'.base_url().'uploads/payment/'.$r->log_pay_photo.'" class="img-fluid img-thumbnail" alt="payment" id="myImg'.$r->log_req_id.'" onclick="display(\'myImg'.$r->log_req_id.'\')" style="max-height:100px;">';
                                                }
                                            ?>
                                        </td>
                                        <td><?= $r->log_reject_note; ?></td>
                                    </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div> 
            <div class="col-md-12 text-center">
                <button class="btn btn-primary" type="button" onclick="window.location = '<?= base_url() ?>backend/Requestmicrochip'"><i class="fa fa-arrow-left"></i></button>
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