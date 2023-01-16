<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Canine List</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?php echo base_url(); ?>assets/css/backend-modal.css" rel="stylesheet"/>
</head>
<body>
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
    </div>
    
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center">Canine List</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'Canine has been saved<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('error_message')){
                            echo $this->session->flashdata('error_message').'<br/>';
                        }
                    ?>
                </div>
                <div class="search-container my-3">
                    <form action="<?= base_url().'backend/Canines/search'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="ICR number/Name" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" onclick="add()"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>ICR Number</th>
                                <th>Name</th>
                                <th>Kennel</th>
                                <th>Owner</th>
                                <th>Status</th>
                                <th></th>
                                <th>id</th>
                                <th>reg_number</th>
                                <th>breed</th>
                                <th>gender</th>
                                <th>color</th>
                                <th>date_of_birth</th>
                                <th>chip_number</th>
                                <th>reg_date</th>
                                <th>desc</th>
                                <th>stat</th>
                                <th>note</th>
                                <th>print</th>
                                <th>app_stat</th>
                                <th>app_user</th>
                                <th>app_date</th>
                                <th>app_note</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($canine AS $c){ ?>
                                <tr>
                                    <td>
                                        <?php if ($c->can_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/canine/'.$c->can_photo) ?>" id="myImg" class="img-fluid img-thumbnail" alt="canine">
                                        <?php } else{ ?>
                                            <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" id="myImg" class="img-fluid img-thumbnail" alt="canine">
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?= $c->can_icr_number; ?>
                                    </td>
                                    <td>
                                        <?= $c->can_a_s; ?>
                                    </td>
                                    <td>
                                        <?= $c->ken_name; ?>
                                    </td>
                                    <td>
                                        <?= $c->mem_name; ?>
                                    </td>
                                    <td>
                                        <?= $c->stat_name; ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick='print(<?= $c->can_id; ?>)'><i class="fa fa-print"></i></button>
                                    </td>
                                    <td>
                                        <?= $c->can_id; ?>
                                    </td>
                                    <td>
                                        <?= $c->can_reg_number; ?>
                                    </td>
                                    <td><?= $c->can_breed; ?></td>
                                    <td><?= $c->can_gender; ?></td>
                                    <td><?= $c->can_color; ?></td>
                                    <td><?= $c->can_date_of_birth; ?></td>
                                    <td><?= $c->can_chip_number; ?></td>
                                    <td><?= $c->can_reg_date; ?></td>
                                    <td><?= $c->can_desc; ?></td>
                                    <td><?= $c->can_stat; ?></td>
                                    <td><?= $c->can_note; ?></td>
                                    <td><?= $c->can_print; ?></td>
                                    <td><?= $c->can_app_stat; ?></td>
                                    <td><?= $c->can_app_user; ?></td>
                                    <td><?= $c->can_app_date; ?></td>
                                    <td><?= $c->can_app_note; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>                           
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script>
        function add(){
            window.location = "<?= base_url(); ?>backend/Canines/add";
        }
        function print(id){
            window.location = "<?= base_url(); ?>backend/Certificate/front/"+id;
        }

        //modal script
        var modal = document.getElementById("myModal");

        // Get the image and insert it inside the modal
        var img = document.getElementById("myImg");
        var modalImg = document.getElementById("img01");
        img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }
    </script>
</body>
</html>