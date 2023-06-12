<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= lang("stud_list"); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_member'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <div class="container">
    <div class="row">            
            <div class="col-sm-12">                          
                <h3 class="text-center text-warning"><?= lang("stud_list"); ?></h3>
                <div class="search-container my-3">
                    <form id="formStud" action="<?= base_url().'frontend/Studs/search'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-3 me-1">
                                <input type="text" class="form-control" placeholder="<?= lang("stud_name"); ?>" name="keywords" value="<?= $keywords ?>">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="<?= lang("stud_date"); ?>" name="date" id="date" autocomplete="off" value="<?= $date ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="<?= lang("stud_search"); ?>"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row my-3">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-warning" onclick="add()" data-toggle="tooltip" data-placement="top" title="<?= lang("stud_report"); ?>"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <?= $this->pagination->create_links(); ?>
                <div class="row mb-1">
                    <div class="col-sm-2 text-center"><b><?= lang("common_photo"); ?></b></div>
                    <div class="col-sm-2 text-center"><b><?= lang("common_male"); ?></b></div>
                    <div class="col-sm-2 text-center"><b><?= lang("common_female"); ?></b></div>
                    <div class="col-sm-2"><b><?= lang("common_date"); ?></b></div>
                    <div class="col-sm-2"><b>Status</b></div>
                </div>
                <?php
                    $i = 0; 
                    foreach ($stud AS $s){ ?>
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
                            <?php echo $s->stat_name; 
                            if ($s->stu_stat == $this->config->item('rejected')){
                                $site_lang = $this->input->cookie('site_lang');
                                if ($site_lang == 'indonesia') {
                                    echo '<br/>Alasan: ';
                                }
                                else{
                                    echo '<br/>Reason: ';
                                }
                                if ($s->stu_app_note)
                                    echo $s->stu_app_note;
                                else
                                    echo '-'; 
                            } ?>
                        </div>
                    </div>
                <?php
                        $i++; 
                    } ?>
                <br/>
                <?= $this->pagination->create_links(); ?>
            </div>                           
        </div> 
    </div>
    <div class="modal fade text-dark" id="message-modal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= lang("common_notice"); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-success">
                    <?php if ($this->session->flashdata('add_success')){ ?>
                        <div class="row">
                            <div class="col-12"><?= lang("stud_add_success"); ?></div>
                        </div>
                    <?php } ?>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                </div>
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
        function setDatePicker(id) {
            $(id).datepicker({ dateFormat: 'dd-mm-yy' });
            $(id).readOnly = true;
        }
        setDatePicker('#date');
        function add(){
            window.location = "<?= base_url(); ?>frontend/Studs/add";
        }
        $(document).ready(function () {
            $('#keywords').on("change", function(){
                $('#formStud').attr('action', "<?= base_url(); ?>frontend/Studs/search").submit();
            });

            <?php		
                if ($this->session->flashdata('add_success')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>
            
            <?php if ($this->session->flashdata('error_message')){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });

        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>