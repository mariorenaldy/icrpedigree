<!DOCTYPE html>
<html class="min-vh-100">
<head>
<title>Rules</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <header class="d-flex flex-column align-items-center">
            <h2 class="fw-bold text-warning">Rules</h2>
        </header>
        <?php foreach ($rules AS $r){ ?>
            <div class="row">
                <div class="col"><?= $r->ru_title ?></div>
            </div>
            <div class="row mb-5">
                <div class="col"><?= $r->ru_desc ?></div>
            </div>
        <?php } ?> 
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
</html>