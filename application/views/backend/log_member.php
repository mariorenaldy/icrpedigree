<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Kennel Log</title>
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
                <h3 class="text-center text-primary">Kennel Log</h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Last Modified</th>
                                <th>Kennel</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Mail Address</th>
                                <th>Certificate Address</th>
                                <th>City</th>
                                <th>Postal Code</th>
                                <th>KTP</th>
                                <th>email</th>
                                <th>Type</th>
                                <th>Payment Date</th>
                                <th>Kennel Photo</th>
                                <th>Canine Name Format</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 0;  
                                foreach ($member AS $m){ ?>
                                    <tr>
                                        <td><span class="text-nowrap"><?= $m->log_date; ?></span><br/>(<?= $m->user; ?>)</td>
                                        <td><?= $kennel[$i]->log_kennel_name; ?></td>
                                        <td><?= $m->log_name; ?></td>
                                        <td><?= $m->log_hp; ?></td>
                                        <td><?= $m->log_address; ?></td>
                                        <td><?= $m->log_mail_address; ?></td>
                                        <td><?= $m->log_kota; ?></td>
                                        <td><?= $m->log_kode_pos; ?></td>
                                        <td><?= $m->log_ktp; ?></td>
                                        <td><?= $m->log_email; ?></td>
                                        <td><?php if ($m->log_mem_type == $this->config->item('pro_member')) 
                                                echo 'Pro<br/>'.$m->app_user.' (<span class="text-nowrap">'.$m->log_app_date.'</span>)';
                                            else 
                                                echo 'Free'; 
                                            ?></td>
                                        <td><span class="text-nowrap"><?= $m->log_payment_date; ?></span></td>
                                        <td>
                                            <?php
                                                if ($kennel[$i]->log_kennel_photo && $kennel[$i]->log_kennel_photo != '-'){
                                                    echo '<img src="'.base_url().'uploads/kennels/'.$kennel[$i]->log_kennel_photo.'" class="img-fluid img-thumbnail" alt="kennel" id="myImg'.$kennel[$i]->log_id.'" onclick="display(\'myImg'.$kennel[$i]->log_id.'\')">';
                                                } 
                                                else {
                                                    echo '<img src="'.base_url().'assets/img/'.$this->config->item('canine_img').'" class="img-fluid img-thumbnail" alt="kennel" id="myImg'.$kennel[$i]->log_id.'" onclick="display(\'myImg'.$kennel[$i]->log_id.'\')">';
                                                }
                                            ?>
                                        </td>
                                        <td><?= $kennel[$i]->ken_type_name; ?></td>
                                        <td><?= $m->stat_name; ?></td>
                                    </tr>
                                    <?php $i++; 
                                }?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button class="btn btn-primary" type="button" onclick="window.location = '<?= base_url() ?>backend/Members'"><i class="fa fa-arrow-left"></i></button>
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