<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= lang('stud_choose'); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_member'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <div class="container">
    <div class="row">            
            <div class="col-sm-12">                          
                <h3 class="text-center text-warning"><?= lang('stud_choose'); ?></h3>
                <div class="row mb-1">
                    <div class="col-sm-2 text-center"><b><?= lang('common_photo'); ?></b></div>
                    <div class="col-sm-2 text-center"><b><?= lang('common_male'); ?></b></div>
                    <div class="col-sm-2 text-center"><b><?= lang('common_female'); ?></b></div>
                    <div class="col-sm-2"><b><?= lang('common_date'); ?></b></div>
                    <div class="col-sm-2"></div>
                </div>
                <?php
                    $i = 0; 
                    foreach ($stud AS $s){ 
                        if (!$birth[$i] && $stat[$i]){
                ?>
                        <div class="row">
                            <div class="col-sm-2 mb-1 text-center">
                                <img src="<?= base_url('uploads/stud/'.$s->stu_photo) ?>" class="img-fluid img-thumbnail" alt="Stud">
                            </div>
                            <div class="col-sm-2 mb-1 text-center">
                                <img src="<?= base_url('uploads/stud/'.$s->stu_sire_photo) ?>" class="img-fluid img-thumbnail" alt="Sire">
                                <br/><?= $s->sire_a_s ?>
                            </div>
                            <div class="col-sm-2 mb-1 text-center">
                                <img src="<?= base_url('uploads/stud/'.$s->stu_dam_photo) ?>" class="img-fluid img-thumbnail" alt="Dam">
                                <br/><?= $s->dam_a_s ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $s->stu_stud_date; ?>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-primary" onclick="addBirth(<?= $s->stu_id ?>)" data-toggle="tooltip" data-placement="top" title="<?= lang('stud_choose'); ?>"><i class="fa fa-check"></i></button>
                            </div>
                        </div>
                <?php
                        }
                        $i++; 
                    } ?>
            </div>                           
        </div> 
    </div>
    <div class="modal fade text-dark" id="error-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= lang("common_error_message"); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-danger">
                        <?php if ($this->session->flashdata('error_message')){ ?>
                            <div class="row">
                                <div class="col-12"><?= $this->session->flashdata('error_message') ?></div>
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
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script>
        function addBirth(studId){
            window.location = "<?= base_url(); ?>frontend/Births/add/"+studId;
        }
        $(document).ready(function(){
            <?php if ($this->session->flashdata('error_message')){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>
</html>