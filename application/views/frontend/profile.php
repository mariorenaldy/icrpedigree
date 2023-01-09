<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Profile</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_non_paid'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <div class="container">
            <h3 class="text-center text-warning">Profile <?php if ($this->session->userdata('mem_stat') == '1') ?><!-- <button type="button" class="btn btn-warning" onclick="window.location = '<?= base_url() ?>frontend/Members/edit_profile'">Edit</button> --></h3>
            <div class="text-success">
                <?php		
                    if ($this->session->flashdata('edit_profile')){
                        echo 'Edit Profile berhasil.<br/>Silakan hubungi ICR admin untuk mendapatkan approval.<br/>';
                    }
                ?>
            </div>
            <div class="row mb-1 mt-3">            
                <div class="col-md-3">Foto KTP</div>
                <div class="col-md-2">
                    <img src="<?php if ($member->mem_photo != '-') echo base_url().'uploads/members/'.$member->mem_photo; else echo base_url().'assets/img/avatar.jpg'; ?>" class="img-fluid img-thumbnail" alt="KTP">
                </div>
            </div>
            <div class="row mb-1">            
                <div class="col-md-3">PP</div>
                <div class="col-md-2">
                    <img src="<?php if ($member->mem_pp != '-') echo base_url().'uploads/members/'.$member->mem_pp; else echo base_url().'assets/img/avatar.jpg'; ?>" class="img-fluid img-thumbnail" alt="KTP">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3">No. KTP</div>
                <div class="col-md-9"><?= $member->mem_ktp ?></div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3">Nama Sesuai KTP</div>
                <div class="col-md-9"><?= $member->mem_name ?></div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3">Alamat Sesuai KTP</div>
                <div class="col-md-9"><?= $member->mem_address ?></div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3">Alamat Surat Menyurat</div>
                <div class="col-md-9"><?= $member->mem_mail_address ?></div>
            </div>      
            <div class="row mb-1">
                <div class="col-md-3">No. Telp</div>
                <div class="col-md-9"><?= $member->mem_hp ?></div>
            </div>      
            <div class="row mb-1">
                <div class="col-md-3">Kota</div>
                <div class="col-md-9"><?= $member->mem_kota ?></div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3">Kode Pos</div>
                <div class="col-md-9"><?= $member->mem_kode_pos ?></div>
            </div>     
            <div class="row mb-1">
                <div class="col-md-3">email</div>
                <div class="col-md-9"><?= $member->mem_email ?></div>
            </div>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
</html>

