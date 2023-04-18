<!DOCTYPE html>
<html class="min-vh-100">
<head>
<title><?= lang('common_rules'); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <div class="container">
        <h3 class="text-center text-warning mb-3"><?= lang('common_rules'); ?></h3>
        <?php foreach ($rules AS $r){ ?>
            <div class="row">
                <div class="col-12"><h5 class="text-warning"><?= $r->ru_title ?></h5></div>
            </div>
            <div class="row mb-5">
                <div class="col-12"><?= $r->ru_desc ?></div>
            </div>
        <?php } ?> 
        </div>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
</html>