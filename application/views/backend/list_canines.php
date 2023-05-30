<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Canine Photo List</title>
    <?php $this->load->view('templates/head'); ?>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/backend-modal.css" />
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
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
                <h3 class="text-center text-primary">Canine Photo List</h3>
                <div class="search-container my-3 sticky-top">
                    <form action="<?= base_url().'backend/Canines/search_list'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="After" name="after" id="after" autocomplete="off" value="<?= $after ?>">
                            </div>
                            <div class="col-md-3 ms-1">
                                <input type="text" class="form-control" placeholder="Before" name="before" id="before" autocomplete="off" value="<?= $before ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Search Canine"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <?= $this->pagination->create_links(); ?>
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $counter = 0;
                                $len = count($canine);
                                $pads = 3 - $len % 3; 
                                foreach ($canine AS $c){ 
                                    if ($counter % 3 == 0){ 
                                        echo '<tr>'; 
                                    } ?>
                                    <td align="center" width="30%">
                                        <?php if ($c->can_photo && $c->can_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/canine/'.$c->can_photo) ?>" class="img-fluid img-thumbnail canine-img" alt="canine" id="myImg<?= $c->can_id ?>" onclick="display('myImg<?= $c->can_id ?>')">
                                        <?php } else{ ?>
                                            <img src="<?= base_url().'assets/img/'.$this->config->item('canine_img') ?>" class="img-fluid img-thumbnail canine-img" alt="canine" id="myImg<?= $c->can_id ?>" onclick="display('myImg<?= $c->can_id ?>')">
                                        <?php } ?>
                                        <br/>
                                        <button type="button" class="btn btn-info mb-1" onclick="detail(<?= $c->can_id ?>)" data-toggle="tooltip" data-placement="top" title="Canine Detail">
                                            <?= $c->can_a_s; ?><?php if ($c->can_rip) echo '<div class="text-danger"><b>----- RIP -----<b></div>'; ?>
                                        </button>
                                    </td>
                            <?php 
                                    $counter++; 
                                    if ($counter % 3 == 0){ 
                                        echo '</tr>';
                                    } 
                                } ?>
                        </tbody>
                    </table>
                    <br/>
                    <?= $this->pagination->create_links(); ?>
                </div>
            </div>                           
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script>
        function setDatePicker(id) {
            $(id).datepicker({ dateFormat: 'dd-mm-yy' });
            $(id).readOnly = true;
        }
        setDatePicker('#after');
        setDatePicker('#before');

        function detail(id){
            window.location = "<?= base_url(); ?>backend/Canines/view_detail/"+id;
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