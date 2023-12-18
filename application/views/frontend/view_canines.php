<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= lang("can_my_dogs"); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/backend-modal.css" />
</head>
<body class="text-white text-break">
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImg">
</div>
<?php $this->load->view('frontend/layout/header_non_paid'); ?> 
<?php $this->load->view('frontend/layout/navbar'); ?>
    <div class="container">
        <div class="row">     
            <div class="col-sm-12">                          
                <h3 class="text-center text-warning"><?= lang("can_my_dogs"); ?></h3>
                <div class="search-container">
                    <form action="<?= base_url().'frontend/Canines/search'?>" method="post">
                        <div class="input-group my-3">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="No. ICR/Nama" name="keywords" value="<?= $keywords ?>">
                            </div>
                            <div class="col-sm-1 ms-1">
                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="<?= lang("can_search"); ?>"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row my-3">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-warning" onclick="add()" data-toggle="tooltip" data-placement="top" title="<?= lang("can_add"); ?>"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <?php if ($this->session->userdata('mem_type') == '1'){ ?>
                <div class="row my-3">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-success" onclick="list_edit_owner()" data-toggle="tooltip" data-placement="top" title="<?= lang("owner_report_list"); ?>"><?= lang('owner_report_list'); ?></button>
                        <button type="button" class="btn btn-light" onclick="list_edit_canine()" data-toggle="tooltip" data-placement="top" title="<?= lang("can_report_change_photo_rip_list"); ?>"><?= lang('can_report_change_photo_rip_list'); ?></button>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-warning" onclick="list_req_cert()" data-toggle="tooltip" data-placement="top" title="<?= lang("can_req_cert_list"); ?>"><?= lang('can_req_cert_list'); ?></button>
                        <button type="button" class="btn btn-danger" onclick="list_req_micro()" data-toggle="tooltip" data-placement="top" title="<?= lang("can_req_micro_list"); ?>"><?= lang('can_req_micro_list'); ?></button>
                    </div>
                </div>
                <?php }; ?>
                <?= $this->pagination->create_links(); ?>
                <div class="row mb-1">
                    <div class="col-sm-2"><b><?= lang("can_photo"); ?></b></div>
                    <div class="col-sm-2"><b><?= lang("can_name"); ?></b></div>
                    <div class="col-sm-2"><b><?= lang("can_desc"); ?></b></div>
                    <div class="col-sm-2"><b><?= lang("can_kennel"); ?></b></div>
                    <div class="col-sm-1"><b>Status</b></div>
                    <div class="col-sm-2"></div>
                </div>
                <?php foreach ($canines AS $c){ ?>
                    <div class="row mb-5">
                        <div class="col-sm-2 mb-1">
                            <?php if ($c->can_photo != '-'){ ?>
                                <img src="<?= base_url('uploads/canine/'.$c->can_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="myImg<?= $c->can_id ?>" onclick="display('myImg<?= $c->can_id ?>')">
                            <?php } else{ ?>
                                <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine" id="myImg<?= $c->can_id ?>" onclick="display('myImg<?= $c->can_id ?>')">
                            <?php } ?>
                        </div>
                        <div class="col-sm-2">
                            <?php 
                                echo $c->can_a_s.'<br/>'; 
                                if ($c->can_icr_number) 
                                    echo $c->can_icr_number; 
                                else 
                                    echo $c->can_reg_number;
                                echo '<br>';
                                if ($c->can_rip) 
                                    echo 'RIP'; 
                            ?>
                        </div>
                        <div class="col-sm-2">
                            <?php 
                                echo $c->can_breed.'<br/>';
                                echo $c->can_gender.'<br/>';
                                echo $c->can_color; 
                            ?>
                        </div>
                        <div class="col-sm-2">
                            <?= $c->mem_name.' ('.$c->ken_name.')'; ?>
                        </div>
                        <div class="col-sm-1">
                            <?php echo $c->stat_name; 
                            if ($c->can_stat == $this->config->item('rejected')){
                                $site_lang = $this->input->cookie('site_lang');
                                if ($site_lang == 'indonesia') {
                                    echo '<br/>Alasan: ';
                                }
                                else{
                                    echo '<br/>Reason: ';
                                }
                                if ($c->can_app_note)
                                    echo $c->can_app_note;
                                else
                                    echo '-'; 
                            } ?>
                        </div>
                        <div class="col-sm-2">
                            <?php if ($c->can_stat == $this->config->item('accepted')){ ?>
                            <button type="button" class="btn btn-info mb-1" onclick="detail(<?= $c->can_id ?>)" data-toggle="tooltip" data-placement="top" title="<?= lang("can_detail"); ?>"><i class="fa fa-dog"></i></button>
                            <button type="button" class="btn btn-primary mb-1" onclick="pedigree(<?= $c->can_id ?>)" data-toggle="tooltip" data-placement="top" title="Pedigree"><i class="fas fa-book-open"></i></button>
                            <button type="button" class="btn btn-success mb-1" onclick="edit_owner(<?= $c->can_id ?>)" data-toggle="tooltip" data-placement="top" title="<?= lang("can_change_owner"); ?>"><i class="fa fa-edit" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-light mb-1" onclick="edit_canine(<?= $c->can_id ?>)" data-bs-toggle="modal" data-placement="top" title="<?= lang("can_change_dog_data"); ?>"><i class="fa fa-pencil"></i></button>
                            <button type="button" class="btn btn-warning mb-1" onclick="certificate(<?= $c->can_id ?>)" data-toggle="tooltip" data-placement="top" title="<?= lang("can_req_cert"); ?>"><i class="fa fa-file-lines"></i></button>
                            <button type="button" class="btn btn-danger mb-1" onclick="microchip(<?= $c->can_id ?>)" data-toggle="tooltip" data-placement="top" title="<?= lang("can_req_micro"); ?>"><i class="fa fa-microchip"></i></button>
                            <?php } ?>
                            <?php if ($c->can_stat == $this->config->item('not_paid')){ ?>
                            <button type="button" class="btn btn-success mb-1" onclick="pay('<?= $c->can_pay_invoice;?>')" data-toggle="tooltip" data-placement="top" title="<?= lang("common_pay"); ?>"><i class="fa-solid fa-money-bill-1"></i></button>
                            <button type="button" class="btn btn-danger mb-1" onclick="confirm(<?= $c->can_id ?>)" data-toggle="tooltip" data-placement="top" title="<?= lang("common_cancel_payment"); ?>"><i class="fa-solid fa-xmark"></i></button>
                            <?php } ?>
                            <?php if ($c->can_stat == $this->config->item('rejected') && $c->pay_name == $this->config->item('upload_proof')){ ?>
                                <img src="<?= base_url('uploads/payment/'.$c->can_pay_photo) ?>" class="d-none img-fluid img-thumbnail" alt="payment" id="myProof<?= $c->can_id ?>">
                                <button type="button" class="btn btn-light mb-1" onclick="display('myProof<?= $c->can_id ?>')" data-toggle="tooltip" data-placement="top" title="<?= lang("common_see_proof"); ?>"><i class="fa fa-receipt"></i></button>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <br>
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
                                    <div class="col-12"><?= lang("can_add_success"); ?></div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('cancel_success')){ ?>
                                <div class="row">
                                    <div class="col-12"><?= lang("can_cancel_success"); ?></div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('req_cert_success')){ ?>
                                <div class="row">
                                    <div class="col-12"><?= lang("can_req_cert_success"); ?></div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('req_micro_success')){ ?>
                                <div class="row">
                                    <div class="col-12"><?= lang("can_req_micro_success"); ?></div>
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
        <div class="modal fade text-dark" id="confirm-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= lang("common_confirm"); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5><?= lang("can_confirm_cancel"); ?></h5>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" onclick="cancel()"><?= lang("common_yes"); ?></button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="resetId()"><?= lang("common_no"); ?></button>
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
        function pay(inv){
            window.location = "<?= base_url(); ?>frontend/Payment/checkout/Canines/"+150000+"/"+inv;
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
            window.location = "<?= base_url(); ?>frontend/Canines/cancel/"+cancelId;
        }
        function add(){
            window.location = "<?= base_url(); ?>frontend/Canines/add";
        }
        function detail(id){
            window.location = "<?= base_url(); ?>frontend/Canines/view_detail/"+id;
        }
        function pedigree(id){
            window.location = "<?= base_url(); ?>frontend/Certificate/index/"+id;
        }
        function edit_owner(id){
            window.location = "<?= base_url(); ?>frontend/Requestownershipcanine/add/"+id;
        }
        function edit_canine(id){
            window.location = "<?= base_url(); ?>frontend/Requestupdatecanine/add/"+id;
        }
        function list_edit_owner(){
            window.location = "<?= base_url(); ?>frontend/Requestownershipcanine";
        }
        function list_edit_canine(){
            window.location = "<?= base_url(); ?>frontend/Requestupdatecanine";
        }
        function list_req_cert(){
            window.location = "<?= base_url(); ?>frontend/Requestcertificate";
        }
        function list_req_micro(){
            window.location = "<?= base_url(); ?>frontend/Requestmicrochip";
        }
        function certificate(id){
            window.location = "<?= base_url(); ?>frontend/Requestcertificate/add/"+id;
        }
        function microchip(id){
            window.location = "<?= base_url(); ?>frontend/Requestmicrochip/add/"+id;
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

            <?php		
                if ($this->session->flashdata('cancel_success')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>

            <?php		
                if ($this->session->flashdata('req_cert_success')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>

            <?php		
                if ($this->session->flashdata('req_micro_success')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>

            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
        
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>