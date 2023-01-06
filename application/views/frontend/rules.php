<!DOCTYPE html>
<html class="min-vh-100">
<head>
<title>Rules</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <div class="container">
        <h3 class="text-center text-warning mb-3">Rules</h3>
        <?php foreach ($rules AS $r){ ?>
            <div class="row">
                <div class="col"><?= $r->ru_title ?></div>
            </div>
            <div class="row mb-5">
                <div class="col"><?= $r->ru_desc ?></div>
            </div>
        <?php } ?> 
        </div>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
</html>