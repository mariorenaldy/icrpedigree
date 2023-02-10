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
        <?php
            $i = 0; 
            foreach ($news AS $r){ 
                if ($i > 0)
                    echo '<hr/>';
            ?>
                <div class="row">
                    <div class="col date"><?= $r->date ?></div>
                </div>
                <div class="row">
                    <div class="col text-warning fs-5"><?= $r->title ?></div>
                </div>
                <div class="row">
                    <div class="col"><?= $r->description ?></div>
                </div>
        <?php 
                $i++;
            } ?> 
        </div>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
</html>