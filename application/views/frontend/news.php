<!DOCTYPE html>
<html class="min-vh-100">
<head>
<title><?= lang('common_news'); ?></title>
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
        <h3 class="text-center text-warning mb-3"><?= lang('common_news'); ?></h3>
        <?php 
            echo $this->pagination->create_links();

            $i = 0; 
            foreach ($news AS $r){ 
                if ($i > 0)
                    echo '<hr class="req-separator"/>';
        ?>
                <div class="row">
                    <div class="col date"><?= $r->date ?></div>
                </div>
                <div class="row">
                    <div class="col text-warning fs-5 mb-2"><?= $r->title ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-2 mb-2">
                        <?php if ($r->type == $this->config->item('stud')){ ?>
                            <img src="<?= base_url().'uploads/stud/'.$r->photo ?>" class="img-fluid img-thumbnail" id="stud<?= $r->news_id ?>" onclick="display('stud<?= $r->news_id ?>')">
                        <?php } else if ($r->type == $this->config->item('birth')){ ?>
                            <img src="<?= base_url().'uploads/births/'.$r->photo ?>" class="img-fluid img-thumbnail" id="birth<?= $r->news_id ?>" onclick="display('birth<?= $r->news_id ?>')">
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col"><?= $r->description ?></div>
                </div>
        <?php 
                $i++;
            } 
            
            echo '<br>';
            echo $this->pagination->create_links();
        ?> 
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