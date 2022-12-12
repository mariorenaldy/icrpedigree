<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List Anjing</title>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
<!-- <?php
    if (!$this->session->userdata('use_username')){
        echo '<script type="text/javascript">';
        echo 'window.location = "'.base_url().'backend/Users/login";';
        echo '</script>';
    }
?> -->
<?php $this->load->view('frontend/layout/header'); ?>  
<?php $this->load->view('frontend/layout/navbar'); ?>
    <div class="container mt-5" style="margin-bottom: 10vh;">
        
        <!-- <?php $this->load->view('templates/header'); ?>   -->
        <div class="row">            
            <div class="col-md-12">                          
                <h3>List Anjing</h3>
                <div class="search-container">
                    <form action="/action_page.php">
                        <input type="text" placeholder="No. ICR/Nama" name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                
                <div class="row">
                    <div class="col-md-4"><b>Foto</b></div>
                    <div class="col-md-3"><b>Nomor ICR</b></div>
                    <div class="col-md-3"><b>Nama</b></div>
                    <div class="col-md-2"></div>
                </div>

                <?php foreach ($canines AS $c){ ?>
                    <div class="row">
                        <div class="col-md-4">
                            <?php if ($c->can_photo != '-'){ ?>
                                <img src="<?= base_url('uploads/canine/'.$c->can_photo) ?>" class="img-fluid img-thumbnail" alt="canine">
                            <?php } else{ ?>
                                <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine">
                            <?php } ?>
                        </div>
                        <div class="col-md-3">
                            <?php echo $c->can_icr_number; ?>
                        </div>
                        <div class="col-md-3">
                            <?php echo $c->can_a_s; ?>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-light"><i class="fa fa-bars" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-light"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-light"><i class="fa fa-file-o" aria-hidden="true"></i></button>
                        </div>
                    </div>
                <?php } ?>
            </div>                           
        </div> 
    </div>
    <?php $this->load->view('frontend/layout/footer'); ?>
<script src="<?php echo base_url(); ?>assets/js/jquery-3.6.1.slim.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>