<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Request Microchip List</title>
    <?php $this->load->view('templates/head'); ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/datatables.min.css" />
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
                <h3 class="text-center text-primary">Request Microchip List</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('approve_success')){
                            echo 'Microchip request has been approved<br/>';
                        }
                        if ($this->session->flashdata('delete_success')){
                            echo 'Microchip request has been deleted<br/>';
                        }
                        if ($this->session->flashdata('complete_success')){
                            echo 'Microchip request has been set to implanted<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('delete_message')){
                            echo $this->session->flashdata('delete_message').'<br/>';
                        }
                    ?>
                </div>
                <div class="search-container my-3">
                    <form action="<?= base_url().'backend/Requestmicrochip/search_list'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Invoice/Product's name" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Search Request"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" onclick="add()" data-toggle="tooltip" data-placement="top" title="Add Request"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="no-sort"></th>
                                <th class="no-sort"></th>
                                <th class="no-sort"></th>
                                <th>ID</th>
                                <th>Member</th>
                                <th>Dog's Name</th>
                                <th class="no-sort">Dog's Photo</th>
                                <th>Appointment Date</th>
                                <th>Payment Proof</th>
                                <th>Status</th>
                                <th>Reject Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($req AS $r){ ?>
                                <tr>
                                    <td class="text-center">
                                        <?php if ($r->req_stat_id == $this->config->item('processed')){ ?>
                                            <button type="button" class="btn btn-success mb-1" onclick='approve(<?= $r->req_id; ?>)' data-toggle="tooltip" data-placement="top" title="Approve Appointment"><i class="fa fa-check"></i></button>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($r->req_stat_id == $this->config->item('processed')){ ?>
                                            <button type="button" class="btn btn-danger mb-1" onclick="reject(<?= $r->req_id ?>)" data-toggle="tooltip" data-placement="top" title="Reject Appointment"><i class="fa fa-xmark"></i></button>
                                        <?php } ?>
                                        <?php if ($r->req_stat_id == $this->config->item('accepted')){ ?>
                                            <button type="button" class="btn btn-primary mb-1" onclick='complete(<?= $r->req_id; ?>)' data-toggle="tooltip" data-placement="top" title="Complete Request"><i class="fa fa-check"></i></button>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                                            <button type="button" class="btn btn-dark mb-1" onclick="log(<?= $r->req_id ?>)" data-toggle="tooltip" data-placement="top" title="Request Log"><i class="fa fa-history"></i></button>
                                        <?php } ?>
                                    </td>
                                    <td><?= $r->req_id; ?></td>
                                    <td><?= $r->mem_name; ?></td>
                                    <td><?= $r->can_a_s; ?></td>
                                    <td>
                                        <?php if ($r->can_photo && $r->can_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/canine/'.$r->can_photo) ?>" class="img-fluid img-thumbnail" alt="dog" id="myImg<?= $r->req_id ?>" onclick="display('myImg<?= $r->req_id ?>')" style="max-height:100px;">
                                        <?php } else{ ?>
                                            <img src="<?= base_url().'assets/img/Dog.svg' ?>" class="img-fluid img-thumbnail" alt="dog" id="myImg<?= $r->req_id ?>" onclick="display('myImg<?= $r->req_id ?>')" style="max-height:100px;">
                                        <?php } ?>
                                    </td>
                                    <td class="text-nowrap"><?= $r->req_datetime; ?></td>
                                    <td>
                                        <?php if ($r->req_pay_photo && $r->req_pay_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/payment/'.$r->req_pay_photo) ?>" class="img-fluid img-thumbnail" alt="payment" id="myPay<?= $r->req_id ?>" onclick="display('myPay<?= $r->req_id ?>')" style="max-height:100px;">
                                        <?php } ?>
                                    </td>
                                    <td><?= $r->micro_stat_name; ?></td>
                                    <td><?= $r->req_reject_note; ?></td>
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
        function approve(id){
            var proceed = confirm("Approve request with ID "+id+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Requestmicrochip/approve/"+id;
            }
        }
        function reject(id){
            window.location = "<?= base_url(); ?>backend/Requestmicrochip/reject/"+id;
        }
        function complete(id){
            window.location = "<?= base_url(); ?>backend/Requestmicrochip/complete/"+id;
        }
        function log(id){
            window.location = "<?= base_url(); ?>backend/Requestmicrochip/log/"+id;
        }

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

        $(document).ready(function () {
            $('#datatable').DataTable({searching: false, info: false, "ordering": true, order: [[5, 'desc']], dom: 'lpftrip',
                columnDefs: [{
                    orderable: false,
                    targets: "no-sort"
                }]
            });
        });

        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script>
</body>
</html>