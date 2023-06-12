<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Approve Update Birth</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/backend-modal.css" rel="stylesheet" />
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
                <h3 class="text-center text-primary">Approve Update Birth</h3>
                <div class="search-container">
                    <form action="<?= base_url().'backend/Requestupdatebirth/search'?>" method="post">
                        <div class="input-group my-3">
                            <div class="col-md-3 me-1">
                                <input type="text" class="form-control" placeholder="Name" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Date of Birth" name="date" id="date" autocomplete="off" value="<?= set_value('date') ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="Cari Lahir"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th width="15%"><b>Old Photo</b></th>
                                <th width="15%"><b>New Photo</b></th>
                                <th><b>Old DOB</b></th>
                                <th><b>New DOB</b></th>
                                <th><b>Old Male</b></th>
                                <th><b>New Male</b></th>
                                <th><b>Old Female</b></th>
                                <th><b>New Female</b></th>
                                </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($req AS $r){ ?>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-success" onclick='approve(<?= $r->req_id; ?>)' data-toggle="tooltip" data-placement="top" title="Accept Update Birth"><i class="fa fa-check"></i></button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick='reject(<?= $r->req_id; ?>)' data-toggle="tooltip" data-placement="top" title="Reject Update Birth"><i class="fa fa-close"></i></button>
                                    </td>
                                    <td>
                                        <?php if ($r->req_old_dam_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/births/'.$r->req_old_dam_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="oldImg<?= $r->req_id ?>" onclick="display('oldImg<?= $r->req_id ?>')">
                                        <?php } else{ ?>
                                            <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine" id="oldImg<?= $r->req_id ?>" onclick="display('oldImg<?= $r->req_id ?>')">
                                        <?php } ?><br/><?= $r->can_a_s; ?>
                                    </td>
                                    <td>
                                        <?php if ($r->req_dam_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/births/'.$r->req_dam_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="newImg<?= $r->req_id ?>" onclick="display('newImg<?= $r->req_id ?>')">
                                        <?php } else{ ?>
                                            <?php if ($r->req_old_dam_photo != '-'){ ?>
                                                <img src="<?= base_url('uploads/births/'.$r->req_old_dam_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="newImg<?= $r->req_id ?>" onclick="display('newImg<?= $r->req_id ?>')">
                                            <?php } else{ ?>
                                                <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine" id="newImg<?= $r->req_id ?>" onclick="display('newImg<?= $r->req_id ?>')">
                                            <?php } ?>
                                        <?php } ?><br/><?= $r->can_a_s; ?>
                                    </td>
                                    <td class="text-nowrap">
                                        <?= $r->req_old_date_of_birth; ?>
                                    </td>
                                    <td class="text-nowrap">
                                        <?= $r->req_date_of_birth; ?>
                                    </td>
                                    <td align="right">
                                        <?= $r->req_old_male; ?>
                                    </td>
                                    <td align="right">
                                        <?= $r->req_male; ?>
                                    </td>
                                    <td align="right">
                                        <?= $r->req_old_female; ?>
                                    </td>
                                    <td align="right">
                                        <?= $r->req_female; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>                           
        </div>
        <div class="modal fade text-dark" id="error-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-danger">
                        <?php if ($this->session->flashdata('error_message')){ ?>
                            <div class="row">
                                <div class="col-12"><?= $this->session->flashdata('error_message') ?></div>
                            </div>
                        <?php } ?>
                        <?php if (validation_errors()){ ?>
                            <div class="row">
                                <?= validation_errors() ?>
                            </div>
                        <?php } ?>
                        <?php if ($this->session->flashdata('reject')){ ?>
                            <div class="row">
                                <div class="col-12">Update Birth has been rejected</div>
                            </div>
                        <?php } ?>
                        <div id="error-row" class="row" style="display: none;">
                            <div id="error-col" class="col-12"></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="message-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Notification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-success">
                            <?php if ($this->session->flashdata('approve')){ ?>
                                <div class="row">
                                    <div class="col-12">Update Birth has been approved</div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('templates/footer'); ?>   
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script>
        function setDatePicker(id) {
            $(id).datepicker({ dateFormat: 'dd-mm-yy' });
            $(id).readOnly = true;
        }
        setDatePicker('#date');

        function approve(id){
            var proceed = confirm("Approve Update Birth?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Requestupdatebirth/approve/"+id;
            }
        }
        function reject(id, nama){
            var proceed = window.prompt("Reject Update Birth?", "");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Requestupdatebirth/reject/"+id+"/"+encodeURI(proceed);
            }
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
            $('#keywords').on("change", function(){
                $('#formBirth').attr('action', "<?= base_url(); ?>backend/Requestupdatebirth/search").submit();
            });

            <?php		
                if ($this->session->flashdata('approve')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>

            <?php if ($this->session->flashdata('error_message') || validation_errors() || $this->session->flashdata('reject')){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });

        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>