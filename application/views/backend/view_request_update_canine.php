<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Approve Change Canine Photo</title>
    <?php $this->load->view('templates/head'); ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/backend-modal.css" />
</head>
<body>
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImg">
</div>
<?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center text-primary">Approve Change Canine Photo</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('approve')){
                            echo 'Change canine photo has been approved<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('error_message')){
                            echo $this->session->flashdata('error_message').'<br/>';
                        }
                        if ($this->session->flashdata('reject')){
                            echo 'Change canine photo has been rejected<br/>';
                        }
                    ?>
                </div>
                <div class="search-container">
                    <form action="<?= base_url().'frontend/Requestupdatecanine/search'?>" method="post">
                        <div class="input-group my-3">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Canine Name" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-sm-1 ms-1">
                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Search Canine"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2"><b>Name</b></div>
                    <div class="col-sm-2"><b>Old Photo</b></div>
                    <div class="col-sm-2"><b>New Foto</b></div>
                    <div class="col-sm-2"><b>Owner</b></div>
                    <div class="col-sm-2"><b>Kennel</b></div>
                </div>
                <?php foreach ($req AS $r){ ?>
                    <div class="row">
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-success" onclick='approve(<?= $r->req_id; ?>, "<?= $r->can_a_s; ?>")' data-toggle="tooltip" data-placement="top" title="Accept Change Canine Ownership"><i class="fa fa-check"></i></button>
                            <button type="button" class="btn btn-danger" onclick='reject(<?= $r->req_id; ?>, "<?= $r->can_a_s; ?>")' data-toggle="tooltip" data-placement="top" title="Reject Change Canine Ownership"><i class="fa fa-close"></i></button>
                        </div>
                        <div class="col-sm-2">
                            <?= $r->can_a_s; ?>
                        </div>
                        <div class="col-sm-2 mb-1">
                            <?php if ($r->req_old_photo != '-'){ ?>
                                <img src="<?= base_url('uploads/canine/'.$r->req_old_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="oldCan<?= $r->req_id ?>" onclick="display('oldCan<?= $r->req_id ?>')">
                            <?php } else{ ?>
                                <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine" id="oldCan<?= $r->req_id ?>" onclick="display('oldCan<?= $r->req_id ?>')">
                            <?php } ?>
                        </div>
                        <div class="col-sm-2 mb-1">
                            <img src="<?= base_url('uploads/canine/'.$r->req_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="newCan<?= $r->req_id ?>" onclick="display('newCan<?= $r->req_id ?>')">
                        </div>
                        <div class="col-sm-2">
                            <?= $r->mem_name; ?>
                        </div>
                        <div class="col-sm-2">
                            <?= $r->ken_name; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>                           
        </div> 
        <?php $this->load->view('templates/footer'); ?>   
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script>
        function approve(id, nama){
            var proceed = confirm("Approve "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Requestupdatecanine/approve/"+id;
            }
        }
        function reject(id, nama){
            var proceed = confirm("Reject "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Requestupdatecanine/reject/"+id;
            }
        }

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