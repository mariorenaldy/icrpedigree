<!DOCTYPE html>
<html class="min-vh-100">
<head>
<title>Notification</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <div class="container">
        <h3 class="text-center text-warning mb-3">Notification</h3>
        <?php $i = 0;
        foreach ($notif AS $r){
            if($i > 0) { ?>
                <hr/>
            <?php } ?>
            <div class="row">
                <div class="col" style="font-size: 0.9em; color:#BEBEBE;"><?= $r->date ?></div>
            </div>
            <div class="row">
                <div class="col fw-bold"><?= $r->title ?></div>
            </div>
            <div class="row">
                <div class="col"><?= $r->description ?></div>
            </div>
            <?php $i++;
        } ?>
    </div>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
</html>