<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Approve Update Kennel</title>
    <?php $this->load->view('templates/head'); ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/backend-modal.css" />
</head>
<body>
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImg">
    </div>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center text-primary">Approve Update Kennel</h3>
                <div class="search-container sticky-top">
                    <form action="<?= base_url().'backend/Requestmember/search'?>" method="post">
                        <div class="input-group my-3">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Name/Kennel" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-sm-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Cari Kennel"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php $i = 0; 
                foreach($request AS $req){ 
                    if ($i)
                        echo '<br/><hr class="req-separator"/>'; 
            ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                                <button type="button" class="btn btn-success" onclick='approve(<?= $req->req_id; ?>, "<?= $req->mem_name; ?>")' data-toggle="tooltip" data-placement="top" title="Accept Update Kennel"><i class="fa fa-check"></i></button>
                                <button type="button" class="btn btn-danger" onclick='reject(<?= $req->req_id; ?>, "<?= $req->mem_name; ?>")' data-toggle="tooltip" data-placement="top" title="Reject Update Kennel"><i class="fa fa-close"></i></button>
                            <?php } ?>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col date"><?= $req->req_date ?></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-2">No. KTP</div>
                        <div class="col-sm-5"><?= $req->req_old_ktp ?></div>
                        <div class="col-sm-5"><?= $req->req_ktp ?></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-2">Nama Sesuai KTP</div>
                        <div class="col-sm-5"><?= $req->req_old_name ?></div>
                        <div class="col-sm-5"><?= $req->req_name ?></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-2">Alamat Surat Menyurat</div>
                        <div class="col-sm-5"><?= $req->req_old_address ?></div>
                        <div class="col-sm-5"><?= $req->req_address ?></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-2">Alamat yang Tertera di Sertifikat</div>
                        <div class="col-sm-5"><?= $req->req_old_mail_address ?></div>
                        <div class="col-sm-5"><?= $req->req_mail_address ?></div>
                    </div>      
                    <div class="row mb-1">
                        <div class="col-sm-2">No. HP WA Aktif</div>
                        <div class="col-sm-5"><?= $req->req_old_hp ?></div>
                        <div class="col-sm-5"><?= $req->req_hp ?></div>
                    </div>      
                    <div class="row mb-1">
                        <div class="col-sm-2">Kota</div>
                        <div class="col-sm-5"><?= $req->req_old_kota ?></div>
                        <div class="col-sm-5"><?= $req->req_kota ?></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-2">Kode Pos</div>
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
                        <div class="col-sm-2">Nama Kennel</div>
                        <div class="col-sm-5"><?= $req->req_kennel_name ?></div>
                        <div class="col-sm-5"><?= $req->req_kennel_name ?></div>
                    </div>     
                    <div class="row mb-1">
                        <div class="col-sm-2">Format Penamaan Anjing</div>
                        <div class="col-sm-5"><?= $req->ken_type_name ?></div>
                        <div class="col-sm-5"><?= $req->ken_type_name ?></div>
                    </div>
            <?php 
                    $i++;
                } ?>
        </div>
        <div class="modal fade text-dark" id="error-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-danger">
                        <?php if ($this->session->flashdata('error_message')){ ?>
                            <div class="row">
                                <div class="col-12"><?= $this->session->flashdata('error_message') ?></div>
                            </div>
                        <?php } ?>
                        <?php if (validation_errors()){ ?>
                            <div class="row">
                                <?= validation_errors() ?>
                            </div>
                        <?php } ?>
                        <?php if ($this->session->flashdata('reject')){ ?>
                            <div class="row">
                                <div class="col-12">Update kennel has been rejected</div>
                            </div>
                        <?php } ?>
                        <div id="error-row" class="row" style="display: none;">
                            <div id="error-col" class="col-12"></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="message-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Notification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-success">
                            <?php if ($this->session->flashdata('approve')){ ?>
                                <div class="row">
                                    <div class="col-12">Update kennel has been approved</div>
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
        <?php $this->load->view('templates/footer'); ?>   
    </div>
    <?php $this->load->view('templates/script'); ?>
</body>
<script>
    function approve(id, nama){
        var proceed = confirm("Approve "+nama+" ?");
        if (proceed){             
            window.location = "<?= base_url(); ?>backend/Requestmember/approve/"+id;
        }
    }
    function reject(id, nama){
        var proceed = window.prompt("Reject "+nama+" ?", "");
        if (proceed){             
            window.location = "<?= base_url(); ?>backend/Requestmember/reject/"+id+"/"+encodeURI(proceed);
        }
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

    $(document).ready(function () {
            <?php		
                if ($this->session->flashdata('approve')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>

            <?php if ($this->session->flashdata('error_message') || validation_errors() || $this->session->flashdata('reject')){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
</script>
</html>

