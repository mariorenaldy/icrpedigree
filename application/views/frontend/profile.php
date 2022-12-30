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
        <header class="d-flex flex-column align-items-center">
            <h2 class="fw-bold">Profile</h2>
        </header>
        <div class="container">
            <div class="row mb-1">            
                <div class="col-md-3">Foto KTP</div>
                <div class="col-md-2">
                    <img src="<?= base_url('uploads/members/'.$member->mem_photo) ?>" class="img-fluid img-thumbnail" alt="KTP">
                </div>
            </div>
            <div class="row mb-1">            
                <div class="col-md-3">PP</div>
                <div class="col-md-2">
                    <img src="<?= base_url('uploads/members/'.$member->mem_pp) ?>" class="img-fluid img-thumbnail" alt="KTP">
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

