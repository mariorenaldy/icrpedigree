<!DOCTYPE html>
<html class="min-vh-100">
<head>
<title>Berita</title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link href="<?= base_url(); ?>assets/css/backend-modal.css" rel="stylesheet" />
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <div class="container">
        <div id="myModal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" id="modalImg">
        </div>
        <h3 class="text-center text-warning mb-3">Berita</h3>
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
                    <div class="col text-warning fs-5 mb-2"><?= $r->title ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-12 mb-2">
                        <?php if ($r->type == $this->config->item('stud')){ ?>
                            <img width="15%" src="<?= base_url().'uploads/stud/'.$r->photo ?>" id="stud<?= $r->news_id ?>" onclick="display('stud<?= $r->news_id ?>')">
                        <?php } else if ($r->type == $this->config->item('birth')){ ?>
                            <img width="15%" src="<?= base_url().'uploads/births/'.$r->photo ?>" id="birth<?= $r->news_id ?>" onclick="display('birth<?= $r->news_id ?>')">
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col"><?= $r->description ?></div>
                </div>
        <?php 
                $i++;
            } ?> 
        </div>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script>
        var modal = document.getElementById("myModal");
        function display(id){
            var img = document.getElementById(id);
            var modalImg = document.getElementById("modalImg");
            modal.style.display = "block";
            modalImg.src = img.src;
        }

        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
            modal.style.display = "none";
        }
    </script>
</body>
</html>