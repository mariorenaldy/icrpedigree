<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Profile</title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link href="<?= base_url().'assets/css/pp-styles.css' ?>" rel="stylesheet" />
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_non_paid'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <div class="container">
            <h3 class="text-center text-warning">Profile</h3>
            <div class="text-success">
                <?php		
                    if ($this->session->flashdata('edit_profile')){
                        echo 'Edit Profile berhasil.<br/>Silakan hubungi ICR admin untuk mendapatkan approval.<br/>';
                    }
                    if ($this->session->flashdata('change_pp')) {
                        echo 'PP berhasil diubah.<br/>';
                    }
                ?>
            </div>
            <div class="text-danger">
                <?php
                if ($this->session->flashdata('error_message')) {
                    echo $this->session->flashdata('error_message').'<br/>';
                }
                echo validation_errors();
                ?>
            </div>
            <form action="<?= base_url(); ?>frontend/Members/change_pp" method="post" enctype="multipart/form-data">
                <div class="row mb-2">            
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 profilepic text-center">
                        <div class="d-inline-block" style="position: relative;">
                            <img src="<?php if ($member->mem_pp != '-') echo base_url().'uploads/members/'.$member->mem_pp; else echo base_url().'assets/img/avatar.jpg'; ?>" class="img-fluid img-thumbnail profile profilepic__image" alt="PP">
                            <div class="profilepic__content">
                                <span class="profilepic__icon"><i class="fa-solid fa-file-image"></i></span>
                                <span class="profilepic__text">Ubah PP</span>
                            </div>
                            <input type="file" class="upload" name="attachment_pp" id="my_file" style="display: none;" onchange="loadFile(event)" onclick="reset(event)"/>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 edit-buttons text-center" style="display: none;">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <button class="btn btn-danger" type="button" onclick="revert()">Batal</button>
                    </div>
                </div>
            </form>
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">No. KTP</div>
                <div class="col-sm-8"><?= $member->mem_ktp ?></div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">Nama Sesuai KTP</div>
                <div class="col-sm-8"><?= $member->mem_name ?></div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">Alamat Surat Menyurat</div>
                <div class="col-sm-8"><?= $member->mem_address ?></div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">Alamat yang Tertera di Sertifikat</div>
                <div class="col-sm-8"><?= $member->mem_mail_address ?></div>
            </div>      
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">No. HP WA Aktif</div>
                <div class="col-sm-8"><?= $member->mem_hp ?></div>
            </div>      
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">Kota</div>
                <div class="col-sm-8"><?= $member->mem_kota ?></div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">Kode Pos</div>
                <div class="col-sm-8"><?= $member->mem_kode_pos ?></div>
            </div>     
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">email</div>
                <div class="col-sm-8"><?= $member->mem_email ?></div>
            </div>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
<script>
    var imageOri = document.querySelector(".profilepic__image").src;
    var editBtns = document.querySelector(".edit-buttons");

    document.querySelector('.profilepic').addEventListener('click', function() {
        document.querySelector('.profilepic input').click();
    });
    var loadFile = function(event) {
        editBtns.style.display = "inline";
        var image = document.querySelector(".profilepic__image");
        image.src = URL.createObjectURL(event.target.files[0]);
    };
    var reset = function(event) {
        event.target.value = null;
    };
    var revert = function() {
        editBtns.style.display = "none";
        var image = document.querySelector(".profilepic__image");
        image.src = imageOri;
    };
</script>
</html>

