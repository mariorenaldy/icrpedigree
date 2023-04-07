<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Approve Change Canine Data</title>
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
                <h3 class="text-center text-primary">Approve Change Canine Data</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('approve')){
                            echo 'Change canine data has been approved<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('error_message')){
                            echo $this->session->flashdata('error_message').'<br/>';
                        }
                        if ($this->session->flashdata('reject')){
                            echo 'Change canine data has been rejected<br/>';
                        }
                    ?>
                </div>
                <div class="search-container sticky-top">
                    <form action="<?= base_url().'backend/Requestupdatecanine/search'?>" method="post">
                        <div class="input-group my-3">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Canine Name" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-sm-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Search Canine"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Name</th>
                                <th width="15%">Old Photo</th>
                                <th width="15%">New Photo</th>
                                <th>Owner</th>
                                <th>RIP?</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($req AS $r){ ?>
                                <tr>
                                    <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                                        <td>
                                            <button type="button" class="btn btn-success" onclick='approve(<?= $r->req_id; ?>, "<?= $r->can_a_s; ?>")' data-toggle="tooltip" data-placement="top" title="Accept Change Canine Ownership"><i class="fa fa-check"></i></button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" onclick='reject(<?= $r->req_id; ?>, "<?= $r->can_a_s; ?>")' data-toggle="tooltip" data-placement="top" title="Reject Change Canine Ownership"><i class="fa fa-close"></i></button>
                                        </td>
                                    <?php } else { ?>
                                        <td></td>
                                        <td></td>
                                    <?php } ?>
                                    <td>
                                        <?= $r->can_a_s; ?>
                                    </td>
                                    <td>
                                        <?php if ($r->req_old_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/canine/'.$r->req_old_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="oldCan<?= $r->req_id ?>" onclick="display('oldCan<?= $r->req_id ?>')">
                                        <?php } else{ ?>
                                            <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine" id="oldCan<?= $r->req_id ?>" onclick="display('oldCan<?= $r->req_id ?>')">
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($r->req_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/canine/'.$r->req_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="newCan<?= $r->req_id ?>" onclick="display('newCan<?= $r->req_id ?>')">
                                        <?php } else{ ?>
                                            <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine" id="oldCan<?= $r->req_id ?>" onclick="display('oldCan<?= $r->req_id ?>')">
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?= $r->mem_name.' ('.$r->ken_name.')'; ?>
                                    </td>
                                    <td>
                                        <?php if ($r->req_rip) echo '<i class="fa fa-check"></i>'; ?>
                                    </td>
                                    <td>
                                        <?= $r->req_date; ?>
                                    </td>
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
        function approve(id, nama){
            var proceed = confirm("Approve "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Requestupdatecanine/approve/"+id;
            }
        }
        function reject(id, nama){
            var proceed = window.prompt("Reject "+nama+" ?", "");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Requestupdatecanine/reject/"+id+"/"+encodeURI(proceed);
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