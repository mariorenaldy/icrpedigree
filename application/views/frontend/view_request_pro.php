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
                                $site_lang = $this->input->cookie('site_lang');
                                if ($site_lang == 'indonesia') {
                                    echo '<br/>Alasan: ';
                                }
                                else{
                                    echo '<br/>Reason: ';
                                }
                                if ($req->req_app_note)
                                    echo $req->req_app_note;
                                else
                                    echo '-'; 
                            } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12"><?= lang('common_payment_method'); ?>: <?= $req->pay_name ?></div>
                    </div>
                    <?php if($req->req_pay_id == $this->config->item('upload_proof')){ ?>
                    <div class="row mb-2">
                        <div class="col-sm-2"><?= lang('common_photo_proof'); ?>: </div>
                        <div class="col-sm-5">
                            <?php 
                                if ($req->req_pay_photo && $req->req_pay_photo != '-'){
                            ?>
                                <img width="15%" src="<?= base_url().'uploads/payment/'.$req->req_pay_photo ?>" alt="payment" id="new_proof<?= $req->req_id ?>" onclick="display('new_proof<?= $req->req_id ?>')">
                            <?php } else { ?>
                                <img width="15%" src="<?= base_url().'assets/img/proof.jpg' ?>" alt="payment" id="new_proof<?= $req->req_id ?>" onclick="display('new_proof<?= $req->req_id ?>')">
                            <?php } ?>
                        </div>
                    </div>
                    <?php }
                    else if($req->req_pay_id == $this->config->item('doku')){ ?>
                    <div class="row mb">
                        <div class="col-sm-5">DOKU Invoice: <?= $req->req_pay_invoice ?></div>
                    </div>
                    <?php }?>
                    <?php if ($req->req_stat == $this->config->item('not_paid')){ ?>
                    <button type="button" class="btn btn-success mb-1" onclick="pay('<?= $req->req_pay_invoice;?>')" data-toggle="tooltip" data-placement="top" title="<?= lang("common_pay"); ?>"><i class="fa-solid fa-money-bill-1"></i></button>
                    <button type="button" class="btn btn-danger mb-1" onclick="confirm(<?= $req->req_id ?>)" data-toggle="tooltip" data-placement="top" title="<?= lang("common_cancel_payment"); ?>"><i class="fa-solid fa-xmark"></i></button>
                    <?php } ?>
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
                        <div class="col-sm-5"><?= $req->req_old_mail_address ?></div>
                        <div class="col-sm-5"><?= $req->req_mail_address ?></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-2"><?= lang('mem_certificate_address'); ?></div>
                        <div class="col-sm-5"><?= $req->req_old_address ?></div>
                        <div class="col-sm-5"><?= $req->req_address ?></div>
                    </div>      
                    <div class="row mb-1">
                        <div class="col-sm-2"><?= lang('mem_number'); ?></div>
                        <div class="col-sm-5"><?= $req->req_old_hp ?></div>
                        <div class="col-sm-5"><?= $req->req_hp ?></div>
                    </div>      
                    <div class="row mb-1">
                        <div class="col-sm-2"><?= lang('common_city/regency'); ?></div>
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
                                <?php 
                                    if ($req->req_old_kennel_photo && $req->req_old_kennel_photo != '-'){
                                ?>
                                    <img width="15%" src="<?= base_url().'uploads/kennels/'.$req->req_old_kennel_photo ?>" alt="member" id="new_member<?= $req->req_id ?>" onclick="display('new_member<?= $req->req_id ?>')">
                                <?php } else { ?>
                                    <img width="15%" src="<?= base_url().'assets/img/avatar.jpg' ?>" alt="member" id="new_member<?= $req->req_id ?>" onclick="display('new_member<?= $req->req_id ?>')">
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-2"><?= lang('mem_kennel_name'); ?></div>
                        <div class="col-sm-5"><?= $req->ken_name ?></div>
                        <div class="col-sm-5"><?= $req->req_kennel_name ?></div>
                    </div>     
                    <div class="row mb-1">
                        <div class="col-sm-2"><?= lang('mem_kennel_format'); ?></div>
                        <div class="col-sm-5"><?= $req->old_kennel_type ?></div>
                        <div class="col-sm-5"><?= $req->new_kennel_type ?></div>
                    </div>
            <?php 
                    $i++;
                } ?>
        </div>
        <div class="modal fade text-dark" id="confirm-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= lang("common_confirm"); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5><?= lang("mem_pro_confirm_cancel"); ?></h5>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" onclick="cancel()"><?= lang("common_yes"); ?></button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="resetId()"><?= lang("common_no"); ?></button>
                    </div>
                </div>
            </div>
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
    function pay(inv){
        window.location = "<?= base_url(); ?>frontend/Payment/checkout/Requestpro/"+200000+"/"+inv;
    }

    function confirm(id){
        cancelId = id;
        $('#confirm-modal').modal('show');
    }
    let cancelId = null;
    function resetId(){
        cancelId = null;
    }
    function cancel(){
        window.location = "<?= base_url(); ?>frontend/Requestpro/cancel/"+cancelId;
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
            if ($this->session->flashdata('become_pro')){ ?>
                $('#message-modal').modal('show');
        <?php } ?>
    });
</script>
</html>

