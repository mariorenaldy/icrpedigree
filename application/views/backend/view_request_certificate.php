<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Request Certificate List</title>
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
                <h3 class="text-center text-primary">Request Certificate List</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'Certificate request has been saved<br/>';
                        }
                        if ($this->session->flashdata('edit_success')){
                            echo 'Certificate request has been edited<br/>';
                        }
                        if ($this->session->flashdata('delete_success')){
                            echo 'Certificate request has been deleted<br/>';
                        }
                        if ($this->session->flashdata('deliver_success')){
                            echo 'Certificate request has been delivered<br/>';
                        }
                        if ($this->session->flashdata('arrive_success')){
                            echo 'Certificate request has been set to arrived<br/>';
                        }
                        if ($this->session->flashdata('reject_success')){
                            echo 'Certificate request has been rejected<br/>';
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
                                <th class="no-sort"></th>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Member</th>
                                <th>Dog's Name</th>
                                <th class="no-sort">Dog's Photo</th>
                                <th>Request Reason</th>
                                <th>Status</th>
                                <th>Arrived Date</th>
                                <th>Reject Reason</th>
                                <th>Complain Photo</th>
                                <th>Complain Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($req AS $r){ ?>
                                <tr>
                                    <td class="text-center">
                                        <?php if ($r->req_stat_id == $this->config->item('cert_processed')){ ?>
                                            <button type="button" class="btn btn-primary mb-1" onclick="deliver(<?= $r->req_id ?>)" data-toggle="tooltip" data-placement="top" title="Deliver Certificate"><i class="fa fa-truck"></i></button>
                                        <?php } else if ($r->req_stat_id == $this->config->item('cert_delivered')){ ?>
                                            <button type="button" class="btn btn-primary mb-1" onclick="arrive(<?= $r->req_id ?>)" data-toggle="tooltip" data-placement="top" title="Certificate Arrived"><i class="fa fa-check"></i></button>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($r->req_stat_id == $this->config->item('cert_processed') || $r->req_stat_id == $this->config->item('cert_delivered')){ ?>
                                            <button type="button" class="btn btn-danger mb-1" onclick="reject(<?= $r->req_id ?>)" data-toggle="tooltip" data-placement="top" title="Reject Request"><i class="fa fa-xmark"></i></button>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success mb-1" onclick="edit(<?= $r->req_id ?>)" data-toggle="tooltip" data-placement="top" title="Edit Request"><i class="fa fa-edit"></i></button>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                                            <button type="button" class="btn btn-dark mb-1" onclick="log(<?= $r->req_id ?>)" data-toggle="tooltip" data-placement="top" title="Request Log"><i class="fa fa-history"></i></button>
                                        <?php } ?>
                                    </td>
                                    <td><?= $r->req_id; ?></td>
                                    <td class="text-nowrap"><?= $r->req_created_at; ?></td>
                                    <td><?= $r->mem_name; ?></td>
                                    <td><?= $r->can_a_s; ?></td>
                                    <td>
                                        <?php if ($r->can_photo && $r->can_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/canine/'.$r->can_photo) ?>" class="img-fluid img-thumbnail" alt="dog" id="myImg<?= $r->req_id ?>" onclick="display('myImg<?= $r->req_id ?>')" style="max-height:100px;">
                                        <?php } else{ ?>
                                            <img src="<?= base_url().'assets/img/Dog.svg' ?>" class="img-fluid img-thumbnail" alt="dog" id="myImg<?= $r->req_id ?>" onclick="display('myImg<?= $r->req_id ?>')" style="max-height:100px;">
                                        <?php } ?>
                                    </td>
                                    <td><?= $r->req_desc; ?></td>
                                    <td><?= $r->cert_stat_name; ?></td>
                                    <td><?= $r->req_arrived_date; ?></td>
                                    <td><?= $r->req_reject_note; ?></td>
                                    <td>
                                        <?php if ($r->com_photo && $r->com_photo != '-') { ?>
                                            <img src="<?= base_url('uploads/complain/' . $r->com_photo) ?>" class="img-fluid img-thumbnail" alt="proof" id="myCom<?= $r->req_id ?>" onclick="display('myCom<?= $r->req_id ?>')" style="max-height:100px;">
                                        <?php } ?>
                                    </td>
                                    <td><?= $r->com_desc; ?></td>
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
        function add(){
            window.location = "<?= base_url(); ?>backend/Requestcertificate/add";
        }
        function edit(id){
            window.location = "<?= base_url(); ?>backend/Requestcertificate/edit/"+id;
        }
        function reject(id, inv){
            window.location = "<?= base_url(); ?>backend/Requestcertificate/reject/"+id;
        }
        function deliver(id){
            var proceed = confirm("Set request with ID "+id+" as delivered ?");
            if (proceed){
                window.location = "<?= base_url(); ?>backend/Requestcertificate/deliver/"+id;
            }
        }
        function arrive(id){
            var proceed = confirm("Set request with ID "+id+" as arrived ?");
            if (proceed){
                window.location = "<?= base_url(); ?>backend/Requestcertificate/arrive/"+id;
            }
        }
        function log(id){
            window.location = "<?= base_url(); ?>backend/Requestcertificate/log/"+id;
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

        $(document).ready(function() {
            $('#datatable').DataTable({
                "lengthChange": false,
                searching: true,
                info: false,
                "ordering": true,
                order: [
                    [4, 'desc']
                ],
                dom: 'lpftrip',
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