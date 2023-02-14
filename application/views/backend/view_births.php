<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Birth List</title>
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
                <h3 class="text-center text-primary">Birth List</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'Birth has been saved<br/>';
                        }
                        if ($this->session->flashdata('edit_success')){
                            echo 'Birth has been edited<br/>';
                        }
                        if ($this->session->flashdata('delete')){
                            echo 'Birth has been deleted<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('error_message')){
                            echo $this->session->flashdata('error_message').'<br/>';
                        }
                    ?>
                </div>
                <div class="search-container my-3">
                    <form id="formBirth" action="<?= base_url().'backend/Births/search'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Date of Birth" name="keywords" id="keywords" autocomplete="off" value="<?= set_value('keywords') ?>">
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
                <div class="row mb-1">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><b>Photo</b></div>
                    <div class="col-md-2"><b>Date of Birth</b></div>
                    <div class="col-md-1" align="center"><b>Male</b></div>
                    <div class="col-md-1" align="center"><b>Female</b></div>
                    <div class="col-md-2"><b>Status</b></div>
                </div>
                <?php
                    $i = 0; 
                    foreach ($birth AS $b){ ?>
                    <div class="row">
                        <div class="col-md-2">
                            <?php if (!$stambum[$i]){ ?>
                                <button type="button" class="btn btn-success mb-1" onclick="edit(<?= $b->bir_id ?>)" data-toggle="tooltip" data-placement="top" title="Edit Birth"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-danger mb-1" onclick="del(<?= $b->bir_id ?>)" data-toggle="tooltip" data-placement="top" title="Delete Birth"><i class="fa fa-trash"></i></button><br/>
                            <?php } 
                                if ($stambum_stat[$i]){ ?>
                                <button type="button" class="btn btn-warning mb-1" onclick="addStambum(<?= $b->bir_id ?>)" data-toggle="tooltip" data-placement="top" title="Add Child Registration"><i class="fa fa-plus"></i></button>
                            <?php } ?>
                        </div>
                        <div class="col-md-2 mb-1">
                            <img src="<?= base_url('uploads/births/'.$b->bir_dam_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="myImg<?= $b->bir_id ?>" onclick="display('myImg<?= $b->bir_id ?>')">
                        </div>
                        <div class="col-md-2">
                            <?= $b->bir_date_of_birth; ?>
                        </div>
                        <div class="col-md-1" align="right">
                            <?= $b->bir_male; ?>
                        </div>
                        <div class="col-md-1" align="right">
                            <?= $b->bir_female; ?>
                        </div>
                        <div class="col-md-2">
                            <?= $b->stat_name.'<br/>'.$b->use_name.' (<span class="text-nowrap">'.$b->bir_app_date.'</span>)'; ?>
                        </div>
                    </div>
                <?php $i++;
                } ?>
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
        setDatePicker('#keywords');

        function add(){
            window.location = "<?= base_url(); ?>backend/Studs";
        }
        function addStambum(birthId){
            window.location = "<?= base_url(); ?>backend/Stambums/add/"+birthId;
        }
        function edit(id){
            window.location = "<?= base_url(); ?>backend/Births/edit/"+id;
        }
        function del(id){
            var proceed = confirm("Delete birth?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Births/delete/"+id;
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
                $('#formBirth').attr('action', "<?= base_url(); ?>backend/Births/search").submit();
            });
        });
    </script>
</body>
</html>