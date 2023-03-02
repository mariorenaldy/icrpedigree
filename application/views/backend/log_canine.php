<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Canine Log</title>
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
                <h3 class="text-center text-primary">Canine Log</h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Last Modified</th>
                                <th>Photo</th>
                                <th>Current Reg. Number</th>
                                <th>ICR Number</th>
                                <th>Chip Number</th>
                                <th>Name</th>
                                <th>Breed</th>
                                <th>Gender</th>
                                <th>Color</th>
                                <th>Date of Birth</th>
                                <th>Kennel</th>
                                <th>Owner</th>
                                <th>RIP?</th>
                                <th>Note</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($canine AS $r){ ?>
                                    <tr>
                                        <td><span class="text-nowrap"><?= $r->log_date; ?></span><br/>(<?= $r->user; ?>)</td>
                                        <td>
                                            <?php
                                                if ($r->log_photo && $r->log_photo != '-'){
                                                    echo '<img src="'.base_url().'uploads/canine/'.$r->log_photo.'" class="img-fluid img-thumbnail" alt="canine" id="myImg'.$r->log_canine_id.'" onclick="display(\'myImg'.$r->log_canine_id.'\')">';
                                                } 
                                                else {
                                                    echo '<img src="'.base_url().'assets/img/'.$this->config->item('canine_img').'" class="img-fluid img-thumbnail" alt="canine" id="myImg'.$r->log_canine_id.'" onclick="display(\'myImg'.$r->log_canine_id.'\')">';
                                                }
                                            ?>
                                        </td>
                                        <td><?= $r->log_reg_number; ?></td>
                                        <td><?= $r->log_icr_number; ?></td>
                                        <td><?= $r->log_chip_number; ?></td>
                                        <td><?= $r->log_a_s; ?></td>
                                        <td><?= $r->log_breed; ?></td>
                                        <td><?= $r->log_gender; ?></td>
                                        <td><?= $r->log_color; ?></td>
                                        <td><?= $r->log_date_of_birth; ?></td>
                                        <td><?= $r->ken_name; ?></td>
                                        <td><?= $r->mem_name; ?></td>
                                        <td><?php if ($r->log_rip) echo '<i class="fa fa-check"></i>'; ?></td>
                                        <td><?= $r->log_note; ?></td>
                                        <td><?= $r->stat_name; ?></td>
                                    </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
                <br/>
                <h3 class="text-center text-primary">Pedigree Log</h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Last Modified</th>
                                <th>Sire</th>
                                <th>Dam</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 0;  
                                foreach ($ped AS $r){ ?>
                                    <tr>
                                        <td><span class="text-nowrap"><?= $r->log_date; ?></span><br/>(<?= $r->use_username; ?>)</td>
                                        <td><?= $sire[$i]->can_a_s; ?></td>
                                        <td><?= $dam[$i]->can_a_s; ?></td>
                                    </tr>
                                    <?php $i++; 
                                }?>
                        </tbody>
                    </table>
                </div>
            </div> 
            <div class="col-md-12 text-center">
                <button class="btn btn-primary" type="button" onclick="window.location = '<?= base_url() ?>backend/Canines'"><i class="fa fa-arrow-left"></i></button>
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