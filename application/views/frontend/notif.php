<!DOCTYPE html>
<html class="min-vh-100">
<head>
<title><?= lang('common_notif'); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_non_paid'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <div class="container">
        <h3 class="text-center text-warning mb-3"><?= lang('common_notif'); ?></h3>
        <?php
            echo $this->pagination->create_links();

            $i = 0; 
            foreach ($notif AS $r){ 
                if ($i > 0)
                    echo '<hr class="req-separator"/>';
            ?>
                <div class="row">
                    <div class="col date"><?= $r->date ?></div>
                </div>
                <div class="row">
                    <div class="col text-warning fs-5"><?= $r->title ?></div>
                </div>
                <div class="row">
                    <div class="col"><?= $r->description.".<br/>".$r->note ?></div>
                </div>
        <?php 
                $i++;
            }
            
            echo '<br>';
            echo $this->pagination->create_links();
        ?> 
        </div>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
</html>