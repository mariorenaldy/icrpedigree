<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Birth List</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
</head>
<body>
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
                    <form action="<?= base_url().'backend/Births/search'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Date of Birth" name="keywords" id="keywords" autocomplete="off" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" onclick="add()"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-md-2"><b>Photo</b></div>
                    <div class="col-md-2"><b>Date of Birth</b></div>
                    <div class="col-md-1" align="center"><b>Male</b></div>
                    <div class="col-md-1" align="center"><b>Female</b></div>
                    <div class="col-md-2"><b>Status</b></div>
                    <div class="col-md-2"></div>
                </div>
                <?php foreach ($birth AS $b){ ?>
                    <div class="row">
                        <div class="col-md-2 mb-1">
                            <img src="<?= base_url('uploads/births/'.$b->bir_dam_photo) ?>" class="img-fluid img-thumbnail" alt="canine">
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
                            <?= $b->stat_name; ?>
                        </div>
                        <div class="col-md-2">
                            <!-- <button type="button" class="btn btn-success" onclick='approve(<?= $b->bir_id ?>, "<?= $b->bir_a_s ?>")'><i class="fa fa-check"></i></button>
                            <button type="button" class="btn btn-danger" onclick='reject(<?= $b->bir_id ?>, "<?= $b->bir_a_s ?>")'><i class="fa fa-close"></i></button> -->
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
        function add(){
            window.location = "<?= base_url(); ?>backend/Studs";
        }
    </script>
</body>
</html>