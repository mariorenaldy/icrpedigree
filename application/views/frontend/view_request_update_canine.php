<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= lang('can_report_change_photo_rip_list'); ?></title>
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
                <h3 class="text-center text-warning"><?= lang('can_report_change_photo_rip_list'); ?></h3>
                <div class="search-container sticky-top">
                    <form action="<?= base_url().'frontend/Requestupdatecanine/search'?>" method="post">
                        <div class="input-group my-3">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="<?= lang('common_dog_name'); ?>" name="keywords" value="<?= $keywords ?>">
                            </div>
                            <div class="col-sm-1 ms-1">
                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="<?= lang('can_search'); ?>"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row my-3">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-warning" onclick="add()" data-toggle="tooltip" data-placement="top" title="<?= lang('can_report_change_photo_rip'); ?>"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <?= $this->pagination->create_links(); ?>
                <div class="row mb-1">
                    <div class="col-sm-2"><b><?= lang('common_name'); ?></b></div>
                    <div class="col-sm-1"><b><?= lang('can_old_photo'); ?></b></div>
                    <div class="col-sm-1"><b><?= lang('can_new_photo'); ?></b></div>
                    <div class="col-sm-2"><b>Owner</b></div>
                    <div class="col-sm-2"><b><?= lang('common_date'); ?></b></div>
                    <div class="col-sm-1"><b>RIP?</b></div>
                    <div class="col-sm-2"><b>Status</b></div>
                </div>
                <?php foreach ($req AS $r){ ?>
                    <div class="row">
                        <div class="col-sm-2">
                            <?= $r->can_a_s; ?>
                        </div>
                        <div class="col-sm-1 mb-1">
                            <?php if ($r->req_old_photo != '-'){ ?>
                                <img src="<?= base_url('uploads/canine/'.$r->req_old_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="oldImg<?= $r->req_id ?>" onclick="display('oldImg<?= $r->req_id ?>')">
                            <?php } else{ ?>
                                <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine" id="oldImg<?= $r->req_id ?>" onclick="display('oldImg<?= $r->req_id ?>')">
                            <?php } ?>
                        </div>
                        <div class="col-sm-1 mb-1">
                            <?php if ($r->req_photo != '-'){ ?>
                                <img src="<?= base_url('uploads/canine/'.$r->req_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="newImg<?= $r->req_id ?>" onclick="display('newImg<?= $r->req_id ?>')">
                            <?php } else{ ?>
                                <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine" id="newImg<?= $r->req_id ?>" onclick="display('newImg<?= $r->req_id ?>')">
                            <?php } ?>
                        </div>
                        <div class="col-sm-2">
                            <?= $r->mem_name.' ('.$r->ken_name.')'; ?>
                        </div>
                        <div class="col-sm-2">
                            <?= $r->req_date; ?>
                        </div>
                        <div class="col-sm-1">
                            <?php if ($r->req_rip) echo '<i class="fa fa-check"></i>'; ?>
                        </div>
                        <div class="col-sm-2">
                            <?php echo $r->stat_name; 
                            if ($r->req_stat == $this->config->item('rejected')){
                                echo '<br/>Alasan: ';
                                if ($r->req_app_note)
                                    echo $r->req_app_note;
                                else
                                    echo '-'; 
                            } ?>
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
                            <h5 class="modal-title"><?= lang('common_notice'); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-success">
                            <?php if ($this->session->flashdata('add_success')){ ?>
                                <div class="row">
                                    <div class="col-12"><?= lang('can_report_change_photo_rip_success'); ?></div>
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
    </div>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script>
        function add(){
            window.location = "<?= base_url(); ?>frontend/Canines/";
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
        });
    </script>
</body>
</html>