<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Stud Log</title>
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
                <h3 class="text-center text-primary">Stud Log</h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Last Modified</th>
                                <th width="20%">Photo</th>
                                <th width="20%">Sire</th>
                                <th width="20%">Dam</th>
                                <th>Stud Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($stud AS $r){ ?>
                                    <tr>
                                        <td><span class="text-nowrap"><?= $r->log_date; ?></span><br/>(<?= $r->use_username; ?>)</td>
                                        <td>
                                            <?php
                                                if ($r->log_photo && $r->log_photo != '-'){
                                                    echo '<img src="'.base_url().'uploads/stud/'.$r->log_photo.'" class="img-fluid img-thumbnail" alt="kennel" id="stud'.$r->log_stu_id.'" onclick="display(\'stud'.$r->log_stu_id.'\')">';
                                                } 
                                                else {
                                                    echo '<img src="'.base_url().'assets/img/'.$this->config->item('canine_img').'" class="img-fluid img-thumbnail" alt="kennel" id="stud'.$r->log_stu_id.'" onclick="display(\'stud'.$r->log_stu_id.'\')">';
                                                }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                        <?php
                                            if ($r->log_sire_photo && $r->log_sire_photo != '-'){
                                                echo '<img src="'.base_url().'uploads/stud/'.$r->log_sire_photo.'" class="img-fluid img-thumbnail" alt="kennel" id="sire'.$r->log_stu_id.'" onclick="display(\'sire'.$r->log_stu_id.'\')">';
                                            } 
                                            else {
                                                echo '<img src="'.base_url().'assets/img/'.$this->config->item('canine_img').'" class="img-fluid img-thumbnail" alt="kennel" id="sire'.$r->log_stu_id.'" onclick="display(\'sire'.$r->log_stu_id.'\')">';
                                            }
                                            ?>
                                            <br/><?= $r->sire; ?>
                                        </td>
                                        <td class="text-center">
                                        <?php
                                            if ($r->log_dam_photo && $r->log_dam_photo != '-'){
                                                echo '<img src="'.base_url().'uploads/stud/'.$r->log_dam_photo.'" class="img-fluid img-thumbnail" alt="kennel" id="dam'.$r->log_stu_id.'" onclick="display(\'dam'.$r->log_stu_id.'\')">';
                                            } 
                                            else {
                                                echo '<img src="'.base_url().'assets/img/'.$this->config->item('canine_img').'" class="img-fluid img-thumbnail" alt="kennel" id="dam'.$r->log_stu_id.'" onclick="display(\'dam'.$r->log_stu_id.'\')">';
                                            }
                                            ?>
                                            <br/><?= $r->dam; ?>
                                        </td>
                                        <td><span class="text-nowrap"><?= $r->log_stud_date; ?></span></td>
                                        <td><?= $r->stat_name; ?></td>
                                    </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button class="btn btn-primary" type="button" onclick="window.location = '<?= base_url() ?>backend/Studs'"><i class="fa fa-arrow-left"></i></button>
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