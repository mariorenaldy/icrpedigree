<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Pet Log</title>
    <?php $this->load->view('templates/head'); ?>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/backend-modal.css" />
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
                <h3 class="text-center text-primary">Pet Log</h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Last Modified</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($pet AS $p){ ?>
                                    <tr>
                                        <td><span class="text-nowrap"><?= $p->log_pet_updated_at; ?></span><br/>(<?= $p->user; ?>)</td>
                                        <td>
                                            <?php
                                                if ($p->log_pet_photo && $p->log_pet_photo != '-'){
                                                    echo '<img src="'.base_url().'uploads/pets/'.$p->log_pet_photo.'" class="img-fluid img-thumbnail" alt="pet" id="myImg'.$p->log_pet_id.'" onclick="display(\'myImg'.$p->log_pet_id.'\')" style="max-height:100px;">';
                                                } 
                                                else {
                                                    echo '<img src="'.base_url().'assets/img/pet.jpg'.'" class="img-fluid img-thumbnail" alt="pet" id="myImg'.$p->log_pet_id.'" onclick="display(\'myImg'.$p->log_pet_id.'\')" style="max-height:100px;">';
                                                }
                                            ?>
                                        </td>
                                        <td><?= $p->log_pet_name; ?></td>
                                        <td><?= $p->log_pet_price; ?></td>
                                        <td><?= $p->log_pet_desc; ?></td>
                                        <td><?= $p->stat_name; ?></td>
                                    </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div> 
            <div class="col-md-12 text-center">
                <button class="btn btn-primary" type="button" onclick="window.location = '<?= base_url() ?>marketplace/Pets/listPets'"><i class="fa fa-arrow-left"></i></button>
            </div>                      
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
    <?php $this->load->view('templates/script'); ?>
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