<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Approve Canine</title>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
</head>
<body>
<?php
    if (!$this->session->userdata('use_username')){
        echo '<script type="text/javascript">';
        echo 'window.location = "'.base_url().'backend/Users/login";';
        echo '</script>';
    }
?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3>Approve Canine</h3>
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

                <?php foreach ($canine AS $c){ ?>
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
                            <button type="button" class="btn btn-success" onclick="approve($c->can_id)"><i class="fa fa-check"></i></button>
                            <button type="button" class="btn btn-danger" onclick="reject($c->can_id)"><i class="fa fa-close"></i></button>
                        </div>
                    </div>
                <?php } ?>
            </div>                           
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
<script src="<?php echo base_url(); ?>assets/js/jquery-3.6.1.slim.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>