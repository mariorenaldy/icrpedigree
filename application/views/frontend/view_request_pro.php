<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>List Laporan Menjadi Pro</title>
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
            <h3 class="text-center text-warning">List Laporan Menjadi Pro</h3>
            <?php $i = 0; 
                foreach($request AS $req){ 
                    if ($i)
                        echo '<br/><hr class="req-separator"/>'; 
            ?>
                    <div class="row">
                        <div class="col date"><?= $req->req_date ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">Status: <?= $req->stat_name ?></div>
                    </div>
                    <br/>
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
        <div class="modal fade text-dark" id="message-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pemberitahuan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-success">
                            <?php if ($this->session->flashdata('become_pro')){ ?>
                                <div class="row">
                                    <div class="col-12">Lapor Menjadi Pro berhasil disimpan.<br/>Hubungi admin untuk mendapatkan approval.</div>
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

