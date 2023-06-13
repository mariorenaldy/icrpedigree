<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= lang("can_req_cert_list"); ?></title>
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
                <h3 class="text-center text-warning mb-5"><?= lang("can_req_cert_list"); ?></h3>
                <?= $this->pagination->create_links(); ?>
                <div class="row mb-3">
                    <div class="col"><b><?= lang("can_dog_name"); ?></b></div>
                    <div class="col"><b><?= lang("can_cert_date"); ?></b></div>
                    <div class="col"><b><?= lang("can_cert_desc"); ?></b></div>
                    <div class="col"><b><?= lang("can_cert_arrived_date"); ?></b></div>
                    <div class="col"><b>Status</b></div>
                    <div class="col"><b>Tanggal Komplain</b></div>
                    <div class="col"><b>Deskripsi Komplain</b></div>
                    <div class="col"><b>Foto Komplain</b></div>
                    <div class="col"></div>
                </div>
                <?php foreach ($requests AS $r){ ?>
                    <div class="row mb-5">
                        <div class="col">
                            <?php echo $r->can_a_s.'<br/>'; ?>
                        </div>
                        <div class="col">
                            <?php echo $r->req_created_at.'<br/>'; ?>
                        </div>
                        <div class="col">
                            <?php echo $r->req_desc.'<br/>'; ?>
                        </div>
                        <div class="col">
                            <?php echo $r->req_arrived_date.'<br/>'; ?>
                        </div>
                        <div class="col">
                            <?php echo $r->cert_stat_name; 
                            if ($r->req_stat_id == $this->config->item('cert_rejected')){
                                $site_lang = $this->input->cookie('site_lang');
                                if ($site_lang == 'indonesia') {
                                    echo '<br/>Alasan: ';
                                }
                                else{
                                    echo '<br/>Reason: ';
                                }
                                if ($r->req_reject_note)
                                    echo $r->req_reject_note;
                                else
                                    echo '-'; 
                            } ?>
                        </div>
                        <div class="col">
                            <?php echo $r->com_created_at.'<br/>'; ?>
                        </div>
                        <div class="col">
                            <?php echo $r->com_desc.'<br/>'; ?>
                        </div>
                        <div class="col">
                            <?php if ($r->com_photo && $r->com_photo != '-') { ?>
                                <img src="<?= base_url('uploads/complain/' . $r->com_photo) ?>" class="img-fluid img-thumbnail" alt="proof" id="myCom<?= $r->req_id ?>" onclick="display('myCom<?= $r->req_id ?>')" style="max-height:100px;">
                            <?php } ?>
                        </div>
                        <div class="col">
                            <?php if ($r->req_stat_id == $this->config->item('cert_processed')){ ?>
                            <button type="button" class="btn btn-danger mb-1" onclick="confirm(<?= $r->req_id ?>)" data-toggle="tooltip" data-placement="top" title="<?= lang("can_cancel_req"); ?>"><i class="fa-solid fa-xmark"></i></button>
                            <?php } ?>
                            <?php if ($r->req_stat_id == $this->config->item('cert_arrived')){ ?>
                            <button type="button" class="btn btn-primary mb-1" onclick="accept('<?= $r->req_id;?>')" data-toggle="tooltip" data-placement="top" title="<?= lang("can_req_cert_accepted"); ?>"><i class="fa-solid fa-check"></i></button>
                            <button type="button" class="btn btn-danger mb-1" onclick="complain('<?= $r->req_id;?>')" data-toggle="tooltip" data-placement="top" title="<?= lang("can_req_complain"); ?>"><i class="fa-solid fa-file-pen"></i></button>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <br>
                <?= $this->pagination->create_links(); ?>  
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
                        <h5><?= lang("can_confirm_cancel_req"); ?></h5>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" onclick="cancel(<?= $r->req_id ?>)"><?= lang("common_yes"); ?></button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="resetId()"><?= lang("common_no"); ?></button>
                    </div>
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
                                    <div class="col-12"><?= lang("can_cert_add_success"); ?></div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('cancel_success')){ ?>
                                <div class="row">
                                    <div class="col-12"><?= lang("can_cert_cancel_success"); ?></div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('accept_success')){ ?>
                                <div class="row">
                                    <div class="col-12"><?= lang("can_cert_accept_success"); ?></div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('complain_success')){ ?>
                                <div class="row">
                                    <div class="col-12"><?= lang("can_cert_complain_success"); ?></div>
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
        let cancelId = null;
        function resetId(){
            cancelId = null;
        }
        function cancel(){
            window.location = "<?= base_url(); ?>frontend/Requestcertificate/cancel/"+cancelId;
        }
        function confirm(id){
            cancelId = id;
            $('#confirm-modal').modal('show');
        }
        function accept(id){
            window.location = "<?= base_url(); ?>frontend/Requestcertificate/accept/"+id;
        }
        function complain(id){
            window.location = "<?= base_url(); ?>frontend/Requestcertificate/complain/"+id;
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
                if ($this->session->flashdata('accept_success')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>

            <?php		
                if ($this->session->flashdata('complain_success')){ ?>
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