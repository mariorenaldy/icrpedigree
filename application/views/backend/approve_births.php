<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Approve Birth</title>
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
                <h3 class="text-center text-primary">Approve Birth</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('approve')){
                            echo 'Birth has been approved<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('error_message')){
                            echo $this->session->flashdata('error_message').'<br/>';
                        }
                        if ($this->session->flashdata('reject')){
                            echo 'Birth has been rejected<br/>';
                        }
                    ?>
                </div>
                <div class="search-container my-3">
                    <form id="formBirth" action="<?= base_url().'backend/Births/search_approve'?>" method="post">
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
                <div class="row mb-1">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><b>Photo</b></div>
                    <div class="col-md-2"><b>Date of Birth</b></div>
                    <div class="col-md-1" align="center"><b>Male</b></div>
                    <div class="col-md-1" align="center"><b>Female</b></div>
                </div>
                <?php foreach ($birth AS $b){ ?>
                    <div class="row">
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success" onclick='approve(<?= $b->bir_id ?>)' data-toggle="tooltip" data-placement="top" title="Approve Birth"><i class="fa fa-check"></i></button>
                            <button type="button" class="btn btn-danger" onclick='reject(<?= $b->bir_id ?>)' data-toggle="tooltip" data-placement="top" title="Reject Birth"><i class="fa fa-close"></i></button>
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
                    </div>
                <?php } ?>
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

        function approve(id){
            var proceed = confirm("Approve birth?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Births/approve/"+id;
            }
        }
        function reject(id){
            var proceed = confirm("Reject birth?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Births/reject/"+id;
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
                $('#formBirth').attr('action', "<?= base_url(); ?>backend/Births/search_approve").submit();
            });
        });
    </script>
</body>
</html>