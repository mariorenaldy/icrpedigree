<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= lang("pedigree_title"); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/backend-modal.css" />
</head>
<body class="text-white text-break">
<?php $this->load->view('frontend/layout/header'); ?> 
<?php $this->load->view('frontend/layout/navbar'); ?>
    <div class="container">
        <div id="myModal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" id="modalImg">
        </div>
        <div class="row">            
            <div class="col-sm-12">                          
                <h3 class="text-center text-warning"><?= lang("pedigree_title"); ?></h3>
                <div class="search-container mb-5">
                    <form action="<?= base_url().'frontend/Pedigree/search_canine'?>" method="post">
                        <div class="input-group my-3">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" placeholder="<?= lang('pedigree_search_placeholder_free'); ?>" name="keywords" value="<?= $keywords ?>">
                            </div>
                            <div class="col-sm-1 ms-1">
                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="<?= lang('can_search'); ?>"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <?= $this->pagination->create_links(); ?>
                <div class="row mb-1 fs-5">
                    <div class="col-sm-2"><b><?= lang("can_photo"); ?></b></div>
                    <div class="col-sm-3"><b><?= lang("can_icr"); ?></b></div>
                    <div class="col-sm-3"><b><?= lang("can_chip"); ?></b></div>
                    <div class="col-sm-4"><b><?= lang("can_name"); ?></b></div>
                </div>
                <?php foreach ($canines AS $c){ ?>
                    <div class="row fs-5">
                        <div class="col-sm-2 mb-1">
                            <?php if ($c->can_photo != '-'){ ?>
                                <img src="<?= base_url('uploads/canine/'.$c->can_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="myImg<?= $c->can_id ?>" onclick="display('myImg<?= $c->can_id ?>')">
                            <?php } else{ ?>
                                <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine" alt="canine" id="myImg<?= $c->can_id ?>" onclick="display('myImg<?= $c->can_id ?>')">
                            <?php } ?>
                        </div>
                        <div class="col-sm-3">
                            <?php if ($c->can_icr_number) 
                                echo $c->can_icr_number; 
                            else 
                                echo $c->can_reg_number; 
                            ?>
                        </div>
                        <div class="col-sm-3">
                            <?= $c->can_chip_number; ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $c->can_a_s; ?>
                        </div>
                    </div>
                <?php } ?>
                <br/>
                <?= $this->pagination->create_links(); ?>
            </div>                           
        </div> 
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