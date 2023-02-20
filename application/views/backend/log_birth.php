<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Birth Log</title>
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
                <h3 class="text-center text-primary">Birth Log</h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Last Modified</th>
                                <th>Photo</th>
                                <th>Date of Birth</th>
                                <th>Male</th>
                                <th>Female</th>
                                <th>Kennel</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($birth AS $r){ ?>
                                    <tr>
                                        <td><span class="text-nowrap"><?= $r->log_date; ?></span><br/>(<?= $r->use_name; ?>)</td>
                                        <td align="center">
                                            <?php
                                                if ($r->log_dam_photo && $r->log_dam_photo != '-'){
                                                    echo '<img src="'.base_url().'uploads/births/'.$r->log_dam_photo.'" class="img-fluid img-thumbnail" alt="canine" id="myImg'.$r->log_bir_id.'" onclick="display(\'myImg'.$r->log_bir_id.'\')">';
                                                } 
                                                else {
                                                    echo '<img src="'.base_url().'assets/img/'.$this->config->item('canine_img').'" class="img-fluid img-thumbnail" alt="canine" id="myImg'.$r->log_bir_id.'" onclick="display(\'myImg'.$r->log_bir_id.'\')">';
                                                }
                                            ?>
                                            <br/><?= $r->can_a_s; ?>
                                        </td>
                                        <td class="text-nowrap"><?= $r->log_date_of_birth; ?></td>
                                        <td align="right"><?= $r->log_male; ?></td>
                                        <td align="right"><?= $r->log_female; ?></td>
                                        <td><?= $r->ken_name; ?></td>
                                        <td><?= $r->stat_name; ?></td>
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