<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List Pacak</title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_member'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <div class="container mt-5" style="margin-bottom: 10vh;">
    <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center">List Pacak</h3>
                <div class="text-success mb-3">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'Pacak berhasil disimpan<br/>';
                        }
                    ?>
                </div>
                <div class="search-container">
                    <form action="<?= base_url().'frontend/Studs/search'?>" method="post">
                        <div class="input-group my-3">
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Tanggal Pacak" name="keywords" id="keywords" autocomplete="off" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-light"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-light" onclick="add()"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-md-2"><b>Foto</b></div>
                    <div class="col-md-2"><b>Sire</b></div>
                    <div class="col-md-2"><b>Dam</b></div>
                    <div class="col-md-2"><b>Tanggal</b></div>
                    <div class="col-md-2"><b>Status</b></div>
                    <div class="col-md-2"></div>
                </div>
                <?php
                    $i = 0; 
                    foreach ($stud AS $s){ ?>
                    <div class="row">
                        <div class="col-md-2 mb-1">
                            <img src="<?= base_url('uploads/stud/'.$s->stu_photo) ?>" class="img-fluid img-thumbnail" alt="Stud">
                        </div>
                        <div class="col-md-2 mb-1">
                            <img src="<?= base_url('uploads/stud/'.$s->stu_sire_photo) ?>" class="img-fluid img-thumbnail" alt="Sire">
                            <br/><?= $s->sire_a_s ?>
                        </div>
                        <div class="col-md-2 mb-1">
                            <img src="<?= base_url('uploads/stud/'.$s->stu_dam_photo) ?>" class="img-fluid img-thumbnail" alt="Dam">
                            <br/><?= $s->dam_a_s ?>
                        </div>
                        <div class="col-md-2">
                            <?= $s->stu_stud_date; ?>
                        </div>
                        <div class="col-md-2">
                            <?= $s->stat_name; ?>
                        </div>
                        <div class="col-md-2">
                            <?php if ($s->stu_stat == 1 && !$birth[$i] && $dam[$i] == "Female"){ ?>
                                <button type="button" class="btn btn-primary" onclick="addBirth(<?= $s->stu_id ?>)"><i class="fa fa-plus"></i> Lahir</button>
                            <?php } ?>
                            <!-- <button type="button" class="btn btn-success" onclick="approve(<?= $s->stu_id ?>)"><i class="fa fa-check"></i></button>
                            <button type="button" class="btn btn-danger" onclick="reject(<?= $s->stu_id ?>)"><i class="fa fa-close"></i></button> -->
                        </div>
                    </div>
                <?php
                        $i++; 
                    } ?>
            </div>                           
        </div> 
    </div>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script>
        function setDatePicker(id) {
            $(id).datepicker({ dateFormat: 'dd-mm-yy' });
            $(id).readOnly = true;
        }
        setDatePicker('#keywords');
        function add(){
            window.location = "<?= base_url(); ?>frontend/Studs/add";
        }
        function addBirth(studId){
            window.location = "<?= base_url(); ?>frontend/Births/add/"+studId;
        }
    </script>
</body>
</html>