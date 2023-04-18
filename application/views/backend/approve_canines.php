<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Approve Canine</title>
    <?php $this->load->view('templates/head'); ?>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/backend-modal.css" />
    <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/css/datatables.min.css" type="text/css" /> -->
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
                <h3 class="text-center text-primary">Approve Canine</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('approve')){
                            echo 'Canine has been approved<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('error_message')){
                            echo $this->session->flashdata('error_message').'<br/>';
                        }
                        if ($this->session->flashdata('reject')){
                            echo 'Canine has been rejected<br/>';
                        }
                    ?>
                </div>
                <div class="search-container my-3 sticky-top">
                    <form action="<?= base_url().'backend/Canines/search_approve'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Name/Kennel" name="keywords" value="<?= $keywords ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Search Canine"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    <!-- </form> -->
                </div>
                <!-- <form action="<?= base_url().'backend/Canines/search_approve'?>" method="post"> -->
                    <div class="input-group">
                        <label class="col-md-1">Sort by: </label>
                        <div class="col-md-2">
                            <?php
                                $pil['can_date'] = 'Date';
                                $pil['can_date_of_birth2'] = 'Date of Birth';
                                $pil['can_breed'] = 'Breed';
                                $pil['can_gender'] = 'Gender';
                                echo form_dropdown('sort_by', $pil, $sort_by, 'class="form-control"'); 
                            ?>
                        </div>
                        <div class="col-md-1 ms-1">
                            <?php
                                $pil2['desc'] = 'Desc';
                                $pil2['asc'] = 'Asc';
                                echo form_dropdown('sort_type', $pil2, $sort_type, 'class="form-control"'); 
                            ?>
                        </div>
                        <div class="col-md-1 ms-1">
                            <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sort Canine"><i class="fa fa-sort"></i></button>
                        </div>
                    </div>
                </form>
                <?= $this->pagination->create_links(); ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="no-sort"></th>
                                <th class="no-sort"></th>
                                <th class="no-sort">Photo</th>
                                <th class="no-sort">Name</th>
                                <th>Breed</th>
                                <th>Gender</th>
                                <th>Date of Birth</th>
                                <th>Kennel</th>
                                <th class="no-sort">Owner</th>
                                <th class="no-sort">Reg. Date</th>
                                <th style="display: none;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($canine AS $c){ ?>
                                <tr>
                                    <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                                        <td><button type="button" class="btn btn-success" onclick='approve(<?= $c->can_id; ?>, "<?= $c->can_a_s; ?>")' data-toggle="tooltip" data-placement="top" title="Accept Canine"><i class="fa fa-check"></i></button></td>
                                        <td><button type="button" class="btn btn-danger" onclick='reject(<?= $c->can_id; ?>, "<?= $c->can_a_s; ?>")' data-toggle="tooltip" data-placement="top" title="Reject Canine"><i class="fa fa-close"></i></button></td>
                                    <?php } else { ?>
                                        <td></td>
                                        <td></td>
                                    <?php } ?>
                                    <td>
                                        <?php if ($c->can_photo && $c->can_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/canine/'.$c->can_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="myImg<?= $c->can_id ?>" onclick="display('myImg<?= $c->can_id ?>')">
                                        <?php } else{ ?>
                                            <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine" id="myImg<?= $c->can_id ?>" onclick="display('myImg<?= $c->can_id ?>')">
                                        <?php } ?>
                                    </td>
                                    <td><?= $c->can_a_s; ?></td>
                                    <td><?= $c->can_breed; ?></td>
                                    <td><?= $c->can_gender; ?></td>
                                    <td class="text-nowrap"><?= $c->can_date_of_birth; ?></td>
                                    <td><?= $c->ken_name; ?></td>
                                    <td><?= $c->mem_name; ?></td>
                                    <td class="text-nowrap"><?= $c->can_reg_date; ?></td>
                                    <td style="display: none;"><?= $c->can_reg_date2; ?></td>
                                </tr>
                            <?php } ?>
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
    <script>
        function approve(id, nama){
            var proceed = confirm("Approve "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Canines/approve_canine/"+id;
            }
        }
        function reject(id, nama){
            var proceed = window.prompt("Reject "+nama+" ?", "");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Canines/reject_canine/"+id+"/"+encodeURI(proceed);
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

        // $(document).ready(function () {
        //     $('#datatable').DataTable({searching: false, info: false, "ordering": true, order: [[10, 'desc']], dom: 'lpftrip',
        //         columnDefs: [{
        //             orderable: false,
        //             targets: "no-sort"
        //         }]
        //     });
        // });
    </script>
    <!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script> -->
</body>
</html>