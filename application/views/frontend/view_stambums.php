<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= lang("can_puppy_list"); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/backend-modal.css" />
</head>
<body class="text-white text-break">
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImg">
</div>
<?php $this->load->view('frontend/layout/header_member'); ?> 
<?php $this->load->view('frontend/layout/navbar'); ?>
    <div class="container">
        <div class="row">            
            <div class="col-sm-12">                          
                <h3 class="text-center text-warning"><?= lang("can_puppy_list"); ?></h3>
                <div class="search-container">
                    <form action="<?= base_url().'frontend/Stambums/search'?>" method="post">
                        <div class="input-group my-3">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="<?= lang("common_name"); ?>" name="keywords" value="<?= $keywords ?>">
                            </div>
                            <div class="col-sm-1 ms-1">
                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="<?= lang("can_search_puppy"); ?>"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row my-3">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-warning" onclick="add()" data-toggle="tooltip" data-placement="top" title="<?= lang("can_report_puppy"); ?>"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <?= $this->pagination->create_links(); ?>
                <div class="row mb-1">
                    <div class="col-sm-2"><b><?= lang("common_photo"); ?></b></div>
                    <div class="col-sm-2"><b><?= lang("common_name"); ?></b></div>
                    <div class="col-sm-1 text-nowrap"><b><?= lang("common_desc"); ?></b></div>
                    <div class="col-sm-2"><b><?= lang("common_dob"); ?></b></div>
                    <div class="col-sm-2"><b>Kennel</b></div>
                    <div class="col-sm-2"><b>Status</b></div>
                    <div class="col-sm-1"></div>
                </div>
                <?php foreach ($stambum AS $r){ ?>
                    <div class="row">
                        <div class="col-sm-2 mb-1">
                            <img src="<?= base_url('uploads/canine/'.$r->stb_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="myImg<?= $r->stb_id ?>" onclick="display('myImg<?= $r->stb_id ?>')">
                        </div>
                        <div class="col-sm-2">
                            <?php echo $r->stb_a_s; ?>
                        </div>
                        <div class="col-sm-1">
                            <?php 
                                echo $r->stb_breed.'<br/>';
                                echo $r->stb_gender; 
                            ?>
                        </div>
                        <div class="col-sm-2">
                            <?php echo $r->stb_date_of_birth; ?>
                        </div>
                        <div class="col-sm-2">
                            <?= $r->mem_name.' ('.$r->ken_name.')'; ?>
                        </div>
                        <div class="col-sm-2">
                            <?php echo $r->stat_name; 
                            if ($r->stb_stat == $this->config->item('rejected')){
                                $site_lang = $this->input->cookie('site_lang');
                                if ($site_lang == 'indonesia') {
                                    echo '<br/>Alasan: ';
                                }
                                else{
                                    echo '<br/>Reason: ';
                                }
                                if ($r->stb_app_note)
                                    echo $r->stb_app_note;
                                else
                                    echo '-'; 
                            } ?>
                        </div>
                        <div class="col-sm-1 mb-1">
                            <?php if ($r->stb_stat == $this->config->item('rejected')){ ?>
                                <img src="<?= base_url('uploads/payment/'.$r->stb_pay_photo) ?>" class="d-none img-fluid img-thumbnail" alt="payment" id="myProof<?= $r->stb_id ?>">
                                <button type="button" class="btn btn-light mb-1" onclick="display('myProof<?= $r->stb_id ?>')" data-toggle="tooltip" data-placement="top" title="<?= lang("common_see_proof"); ?>"><i class="fa fa-receipt"></i></button>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <br/>
                <?= $this->pagination->create_links(); ?>
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
                                    <div class="col-12"><?= lang("can_report_puppy_success"); ?></div>
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
    <script>
        function add(){
            window.location = "<?= base_url(); ?>frontend/Births/view_approved";
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

        $(document).ready(function(){
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