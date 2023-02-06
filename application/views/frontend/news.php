<!DOCTYPE html>
<html class="min-vh-100">
<head>
<title>News</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <div class="container">
        <h3 class="text-center text-warning mb-3">News</h3>
        <?php foreach ($news AS $r){ ?>
            <div class="row">
                <div class="col"><?= $r->date ?></div>
            </div>
            <div class="row">
                <div class="col"><?= $r->title ?></div>
            </div>
            <div class="row">
                <div class="col"><?= $r->description ?></div>
            </div>
            <hr/>
        <?php } ?> 
        </div>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
</html>