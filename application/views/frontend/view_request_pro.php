<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title><?= lang('mem_become_pro_list'); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/backend-modal.css" />
</head>
<body class="text-white text-break">
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImg">
    </div>
    <?php $this->load->view('frontend/layout/header'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <div class="container">
            <h3 class="text-center text-warning"><?= lang('mem_become_pro_list'); ?></h3>
            <?php $i = 0; 
                foreach($request AS $req){ 
                    if ($i)
                        echo '<br/><hr class="req-separator"/>'; 
            ?>
                    <div class="row">
                        <div class="col date"><?= $req->req_date ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">Status: 
                            <?php echo $req->stat_name; 
                            if ($req->req_stat == $this->config->item('rejected')){
                                echo '<br/>Alasan: ';
                                if ($req->req_app_note)
                                    echo $req->req_app_note;
                                else
                                    echo '-'; 
                            } ?>
                        </div>
                    </div>
                    <br/>
                    <div class="row mb-1">
                        <div class="col-sm-2"><?= lang('mem_id_card_number'); ?></div>
                        <div class="col-sm-5"><?= $req->req_old_ktp ?></div>
                        <div class="col-sm-5"><?= $req->req_ktp ?></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-2"><?= lang('mem_name'); ?></div>
                        <div class="col-sm-5"><?= $req->req_old_name ?></div>
                        <div class="col-sm-5"><?= $req->req_name ?></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-2"><?= lang('mem_mailing_address'); ?></div>
                        <div class="col-sm-5"><?= $req->req_old_address ?></div>
                        <div class="col-sm-5"><?= $req->req_address ?></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-2"><?= lang('mem_certificate_address'); ?></div>
                        <div class="col-sm-5"><?= $req->req_old_mail_address ?></div>
                        <div class="col-sm-5"><?= $req->req_mail_address ?></div>
                    </div>      
                    <div class="row mb-1">
                        <div class="col-sm-2"><?= lang('mem_number'); ?></div>
                        <div class="col-sm-5"><?= $req->req_old_hp ?></div>
                        <div class="col-sm-5"><?= $req->req_hp ?></div>
                    </div>      
                    <div class="row mb-1">
                        <div class="col-sm-2"><?= lang('mem_city'); ?></div>
                        <div class="col-sm-5"><?= $req->req_old_kota ?></div>
                        <div class="col-sm-5"><?= $req->req_kota ?></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-2"><?= lang('mem_postal_code'); ?></div>
                        <div class="col-sm-5"><?= $req->req_old_kode_pos ?></div>
                        <div class="col-sm-5"><?= $req->req_kode_pos ?></div>
                    </div>     
                    <div class="row mb-1">
                        <div class="col-sm-2">email</div>
                        <div class="col-sm-5"><?= $req->req_old_email ?></div>
                        <div class="col-sm-5"><?= $req->req_email ?></div>
                    </div>
                    <hr/>
                    <div class="row mb-2">
                        <div class="col-sm-2">Logo</div>
                        <div class="col-sm-5">
                            <?php 
                                if ($req->req_old_kennel_photo && $req->req_old_kennel_photo != '-'){
                            ?>
                                <img width="15%" src="<?= base_url().'uploads/kennels/'.$req->req_old_kennel_photo ?>" alt="member" id="old_member<?= $req->req_id ?>" onclick="display('old_member<?= $req->req_id ?>')">
                            <?php } else { ?>
                                <img width="15%" src="<?= base_url().'assets/img/avatar.jpg' ?>" alt="member" id="old_member<?= $req->req_id ?>" onclick="display('old_member<?= $req->req_id ?>')">
                            <?php } ?>
                        </div>
                        <div class="col-sm-5">
                            <?php 
                                if ($req->req_kennel_photo && $req->req_kennel_photo != '-'){
                            ?>
                                <img width="15%" src="<?= base_url().'uploads/kennels/'.$req->req_kennel_photo ?>" alt="member" id="new_member<?= $req->req_id ?>" onclick="display('new_member<?= $req->req_id ?>')">
                            <?php } else { ?>
                                <img width="15%" src="<?= base_url().'assets/img/avatar.jpg' ?>" alt="member" id="new_member<?= $req->req_id ?>" onclick="display('new_member<?= $req->req_id ?>')">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-2"><?= lang('mem_kennel_name'); ?></div>
                        <div class="col-sm-5"><?= $req->req_kennel_name ?></div>
                        <div class="col-sm-5"><?= $req->req_kennel_name ?></div>
                    </div>     
                    <div class="row mb-1">
                        <div class="col-sm-2"><?= lang('mem_kennel_format'); ?></div>
                        <div class="col-sm-5"><?= $req->ken_type_name ?></div>
                        <div class="col-sm-5"><?= $req->ken_type_name ?></div>
                    </div>
            <?php 
                    $i++;
                } ?>
        </div>
        <div class="modal fade text-dark" id="message-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?= lang('common_notice'); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-success">
                            <?php if ($this->session->flashdata('become_pro')){ ?>
                                <div class="row">
                                    <div class="col-12"><?= lang('mem_become_pro_success'); ?><br/><?= lang('mem_contact_admin'); ?></div>
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
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
<script>
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
            if ($this->session->flashdata('become_pro')){ ?>
                $('#message-modal').modal('show');
        <?php } ?>
    });
</script>
</html>

