<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Birth List</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/backend-modal.css" rel="stylesheet" />
    <!-- <link href="<?= base_url(); ?>assets/css/datatables.min.css" rel="stylesheet" /> -->
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
                <h3 class="text-center text-primary">Birth List</h3>
                <div class="search-container my-3">
                    <form id="formBirth" action="<?= base_url().'backend/Births/search'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-3 me-1">
                                <input type="text" class="form-control" placeholder="Name" name="keywords" value="<?= $keywords ?>">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Date of Birth" name="date" id="date" autocomplete="off" value="<?= $date ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Search Birth"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" onclick="add()" data-toggle="tooltip" data-placement="top" title="Add Birth"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <?= $this->pagination->create_links(); ?>
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th width="1%"></th>
                                <th width="1%"></th>
                                <th width="15%">Stud Photo</th>
                                <th width="15%">Sire</th>
                                <th width="15%">Dam</th>
                                <th width="15%">Birth Photo</th>
                                <th>Male</th>
                                <th>Female</th>
                                <th>Date of Birth</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i = 0; 
                            foreach ($birth AS $b){ ?>
                                <tr>
                                    <td>
                                        <?php if (!$stambum[$i]){ ?>
                                            <button type="button" class="btn btn-success mb-1" onclick="edit(<?= $b->bir_id ?>)" data-toggle="tooltip" data-placement="top" title="Edit Birth"><i class="fa fa-edit"></i></button>
                                            <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                                            <button type="button" class="btn btn-danger mb-1" onclick="del(<?= $b->bir_id ?>)" data-toggle="tooltip" data-placement="top" title="Delete Birth"><i class="fa fa-trash"></i></button>
                                            <?php } 
                                        } ?>
                                    </td>
                                    <td class="text-nowrap">
                                        <?php if ($stat[$i]){ 
                                            if ($stb_date[$i]){ ?>
                                            <button type="button" class="btn btn-warning mb-1" onclick="addMoreStambum(<?= $b->bir_id ?>)" data-toggle="tooltip" data-placement="top" title="Add Puppy"><i class="fa fa-plus"></i></button>
                                            <?php echo '<br/>'.$stb_date[$i].'<br/>'; 
                                        } else { ?>
                                            <button type="button" class="btn btn-warning mb-1" onclick="addStambum(<?= $b->bir_id ?>)" data-toggle="tooltip" data-placement="top" title="Add Puppy"><i class="fa fa-plus"></i></button>
                                        <?php }
                                        }
                                            if ($this->session->userdata('use_type_id') == $this->config->item('super')){ 
                                                if ($stb_date[$i]){ ?>
                                                    <button type="button" class="btn btn-primary mb-1" onclick="complete(<?= $b->bir_id ?>)" data-toggle="tooltip" data-placement="top" title="Complete Birth"><i class="fa fa-check"></i></button>
                                            <?php } ?>
                                            <button type="button" class="btn btn-dark mb-1" onclick="log(<?= $b->bir_id ?>)" data-toggle="tooltip" data-placement="top" title="Birth Log"><i class="fa fa-history"></i></button>
                                        <?php } ?>
                                    </td>
                                    <td align="center">
                                        <img src="<?= base_url('uploads/stud/'.$b->stu_photo) ?>" class="img-fluid img-thumbnail" alt="Stud" id="stud<?= $b->bir_id ?>" onclick="display('stud<?= $b->bir_id ?>')"><br/><?= $b->stu_stud_date; ?>
                                    </td>
                                    <td align="center">
                                        <img src="<?= base_url('uploads/stud/'.$b->stu_sire_photo) ?>" class="img-fluid img-thumbnail" alt="Sire" id="sire<?= $b->bir_id ?>" onclick="display('sire<?= $b->bir_id ?>')">
                                        <br/><a class="text-decoration-none" href="<?= base_url() ?>backend/Canines/view_detail/<?= $b->sire_id ?>"><?= $b->sire ?></a>
                                    </td>
                                    <td align="center">
                                        <img src="<?= base_url('uploads/stud/'.$b->stu_dam_photo) ?>" class="img-fluid img-thumbnail" alt="Dam" id="dam<?= $b->bir_id ?>" onclick="display('dam<?= $b->bir_id ?>')">
                                        <br/><a class="text-decoration-none" href="<?= base_url() ?>backend/Canines/view_detail/<?= $b->dam_id ?>"><?= $b->dam ?></a>
                                    </td>
                                    <td align="center">
                                        <img src="<?= base_url('uploads/births/'.$b->bir_dam_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="myImg<?= $b->bir_id ?>" onclick="display('myImg<?= $b->bir_id ?>')">
                                    </td>
                                    <td align="right">
                                        <?= $b->bir_male; ?>
                                    </td>
                                    <td align="right">
                                        <?= $b->bir_female; ?>
                                    </td>
                                    <td class="text-nowrap">
                                        <?= $b->bir_date_of_birth; ?>
                                    </td>
                                    <td>
                                        <?= $b->stat_name.'<br/>'.$b->use_username.' (<span class="text-nowrap">'.$b->bir_app_date.'</span>)'; ?>
                                    </td>
                                </tr>
                        <?php   
                                $i++;
                        } ?>
                        </tbody>
                    </table>
                    <br/>
                    <?= $this->pagination->create_links(); ?>
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
                        <?php if ($this->session->flashdata('delete_message')){ ?>
                            <div class="row">
                                <div class="col-12"><?= $this->session->flashdata('delete_message') ?></div>
                            </div>
                        <?php } ?>
                        <?php if (validation_errors()){ ?>
                            <div class="row">
                                <?= validation_errors() ?>
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
                            <?php if ($this->session->flashdata('add_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Birth has been saved</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('edit_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Birth has been edited</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('delete_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Birth has been deleted</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('complete_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Birth has been completed</div>
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
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script>
        function setDatePicker(id) {
            $(id).datepicker({ dateFormat: 'dd-mm-yy' });
            $(id).readOnly = true;
        }
        setDatePicker('#date');

        function add(){
            window.location = "<?= base_url(); ?>backend/Studs";
        }
        function addStambum(birthId){
            window.location = "<?= base_url(); ?>backend/Stambums/add/"+birthId;
        }
        function addMoreStambum(birthId){
            window.location = "<?= base_url(); ?>backend/Stambums/add_more/"+birthId;
        }
        function edit(id){
            window.location = "<?= base_url(); ?>backend/Births/edit/"+id;
        }
        function del(id){
            var proceed = window.prompt("Delete birth?", "");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Births/delete/"+id+"/"+encodeURI(proceed);
            }
        }
        function complete(id){
            var proceed = confirm("Complete birth?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Births/complete/"+id;
            }
        }
        function log(id){
            window.location = "<?= base_url(); ?>backend/Births/log/"+id;
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
                $('#formBirth').attr('action', "<?= base_url(); ?>backend/Births/search").submit();
            });

            // $('#datatable').DataTable({searching: false, info: false, "ordering": false, dom: 'lpftrip',
            // });

            <?php		
                if ($this->session->flashdata('add_success') || $this->session->flashdata('edit_success') ||
                    $this->session->flashdata('delete_success') || $this->session->flashdata('complete_success')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>

            <?php if ($this->session->flashdata('delete_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });

        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
    <!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script> -->
</body>
</html>