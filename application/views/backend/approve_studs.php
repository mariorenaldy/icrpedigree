<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Approve Stud</title>
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
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
                <h3>Approve Stud</h3>
                <div class="search-container">
                    <form action="/action_page.php">
                        <input type="text" placeholder="Tanggal Pacak" name="keywords" id="keywords" autocomplete="off">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-2"><b>Foto</b></div>
                    <div class="col-md-2"><b>Sire</b></div>
                    <div class="col-md-2"><b>Dam</b></div>
                    <div class="col-md-2"><b>Tanggal</b></div>
                    <div class="col-md-2"></div>
                </div>
                <?php foreach ($stud AS $s){ ?>
                    <div class="row">
                        <div class="col-md-2">
                            <img src="<?= base_url('uploads/stud/'.$s->stu_photo) ?>" class="img-fluid img-thumbnail" alt="Stud">
                        </div>
                        <div class="col-md-2">
                            <img src="<?= base_url('uploads/stud/'.$s->stu_sire_photo) ?>" class="img-fluid img-thumbnail" alt="Sire">
                        </div>
                        <div class="col-md-2">
                            <img src="<?= base_url('uploads/stud/'.$s->stu_dam_photo) ?>" class="img-fluid img-thumbnail" alt="Dam">
                        </div>
                        <div class="col-md-2">
                            <?= $s->stu_stud_date; ?>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success" onclick="approve($s->stud_id)"><i class="fa fa-check"></i></button>
                            <button type="button" class="btn btn-danger" onclick="reject($s->stud_id)"><i class="fa fa-close"></i></button>
                        </div>
                    </div>
                <?php } ?>
            </div>                           
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
<script src="<?= base_url(); ?>assets/js/jquery-3.6.1.min.js"></script>
<script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
<script>
    function setDatePicker(id) {
        $(id).datepicker({ dateFormat: 'dd-mm-yy' });
        $(id).readOnly = true;
    }
    setDatePicker('#keywords');
</script>
</body>
</html>