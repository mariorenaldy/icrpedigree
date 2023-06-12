<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Approve Stud</title>
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
                <h3 class="text-center text-primary">Approve Stud</h3>
                <div class="search-container my-3">
                    <form id="formStud" action="<?= base_url().'backend/Studs/search_approve'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-3 me-1">
                                <input type="text" class="form-control" placeholder="Name" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Stud date" name="date" id="date" autocomplete="off" value="<?= set_value('date') ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Search Stud"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="1%"></th>
                                <th width="1%"></th>
                                <th width="25%">Photo</th>
                                <th width="25%">Sire</th>
                                <th width="25%">Dam</th>
                                <th>Date<th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i = 0; 
                            foreach ($stud AS $s){ ?>
                            <tr>
                                <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                                    <td>
                                        <button type="button" class="btn btn-success" onclick="approve(<?= $s->stu_id ?>)" data-toggle="tooltip" data-placement="top" title="Approve"><i class="fa fa-check"></i></button>
                                    </td>
                                    <td>    
                                        <button type="button" class="btn btn-danger" onclick="reject(<?= $s->stu_id ?>)" data-toggle="tooltip" data-placement="top" title="Reject"><i class="fa fa-close"></i></button>
                                    </td>
                                <?php } else { ?>
                                    <td></td>
                                    <td></td>
                                <?php } ?>
                                <td align="center">
                                    <img src="<?= base_url('uploads/stud/'.$s->stu_photo) ?>" class="img-fluid img-thumbnail" alt="Stud" id="stud<?= $s->stu_id ?>" onclick="display('stud<?= $s->stu_id ?>')">
                                </td>
                                <td align="center">
                                    <img src="<?= base_url('uploads/stud/'.$s->stu_sire_photo) ?>" class="img-fluid img-thumbnail" alt="Sire" id="sire<?= $s->stu_id ?>" onclick="display('sire<?= $s->stu_id ?>')">
                                    <br/><a class="text-decoration-none" href="<?= base_url() ?>backend/Canines/view_detail/<?= $s->stu_sire_id ?>"><?= $s->sire_a_s ?></a>
                                </td>
                                <td align="center">
                                    <img src="<?= base_url('uploads/stud/'.$s->stu_dam_photo) ?>" class="img-fluid img-thumbnail" alt="Dam" id="dam<?= $s->stu_id ?>" onclick="display('dam<?= $s->stu_id ?>')">
                                    <br/><a class="text-decoration-none" href="<?= base_url() ?>backend/Canines/view_detail/<?= $s->stu_dam_id ?>"><?= $s->dam_a_s ?></a>
                                </td>
                                <td class="text-nowrap">
                                    <?= $s->stu_stud_date; ?>
                                </td>
                            </tr>
                        <?php
                            $i++; 
                        } ?>
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
                                <div class="col-12">Stud has been rejected</div>
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
                                    <div class="col-12">Stud has been approved</div>
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
            var proceed = confirm("Approve stud?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Studs/approve/"+id;
            }
        }
        function reject(id){
            var proceed = window.prompt("Reject stud?", "");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Studs/reject/"+id+"/"+encodeURI(proceed);
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
                $('#formStud').attr('action', "<?= base_url(); ?>backend/Studs/search_approve").submit();
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