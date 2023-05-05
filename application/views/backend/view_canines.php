<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Canine List</title>
    <?php $this->load->view('templates/head'); ?>
    <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/css/datatables.min.css" /> -->
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
                <h3 class="text-center text-primary">Canine List</h3>
                <div class="search-container my-3 sticky-top">
                    <form action="<?= base_url().'backend/Canines/search'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="ICR number/Chip number/Name/Kennel" name="keywords" value="<?= $keywords ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Search Canine"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    <!-- </form> -->
                </div>
                <!-- <form action="<?= base_url().'backend/Canines/search'?>" method="post"> -->
                    <div class="input-group">
                        <label class="col-md-1">Sort by: </label>
                        <div class="col-md-2">
                            <?php
                                $pil['can_app_date2'] = 'Date';
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
                <div class="row my-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" onclick="add()" data-toggle="tooltip" data-placement="top" title="Add Canine"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <?= $this->pagination->create_links(); ?>
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="no-sort"></th>
                                <th class="no-sort"></th>
                                <th class="no-sort"></th>
                                <th class="no-sort">Photo</th>
                                <th class="no-sort">Current Reg. Number</th>
                                <th>ICR Number</th>
                                <th>Chip Number</th>
                                <th>Name</th>
                                <th class="no-sort">Breed</th>
                                <th class="no-sort">Gender</th>
                                <th class="no-sort">Color</th>
                                <th class="no-sort">Date of Birth</th>
                                <th class="no-sort">Kennel</th>
                                <th class="no-sort">Owner</th>
                                <th class="no-sort">Note</th>
                                <th class="no-sort">Reg. Date</th>
                                <th class="no-sort">Status</th>
                                <th style="display: none;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($canine AS $c){ ?>
                                <tr>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success mb-1" onclick="edit(<?= $c->can_id ?>)" data-toggle="tooltip" data-placement="top" title="Edit Canine"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-warning mb-1" onclick="pedigree(<?= $c->can_id ?>)" data-toggle="tooltip" data-placement="top" title="Edit Pedigree"><i class="fa fa-edit"></i></button>
                                        <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                                        <button type="button" class="btn btn-danger mb-1" onclick="del(<?= $c->can_id ?>, '<?= $c->can_a_s ?>')" data-toggle="tooltip" data-placement="top" title="Delete Canine"><i class="fa fa-trash"></i></button>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-info mb-1" onclick="detail(<?= $c->can_id ?>)" data-toggle="tooltip" data-placement="top" title="Canine Detail"><i class="fa fa-file"></i></button>
                                        <button type="button" class="btn btn-secondary mb-1" onclick="note(<?= $c->can_id ?>)" data-toggle="tooltip" data-placement="top" title="Canine Note"><i class="fa fa-list"></i></button>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary mb-1" onclick="print(<?= $c->can_id; ?>)" data-toggle="tooltip" data-placement="top" title="Print Certificate"><i class="fa fa-print"></i> (<?= $c->can_print; ?>)</button>
                                        <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                                            <button type="button" class="btn btn-dark mb-1" onclick="log(<?= $c->can_id ?>)" data-toggle="tooltip" data-placement="top" title="Canine Log"><i class="fa fa-history"></i></button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($c->can_photo && $c->can_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/canine/'.$c->can_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="myImg<?= $c->can_id ?>" onclick="display('myImg<?= $c->can_id ?>')">
                                        <?php } else{ ?>
                                            <img src="<?= base_url().'assets/img/'.$this->config->item('canine_img') ?>" class="img-fluid img-thumbnail" alt="canine" id="myImg<?= $c->can_id ?>" onclick="display('myImg<?= $c->can_id ?>')">
                                        <?php } ?>
                                    </td>
                                    <td><?= $c->can_reg_number; ?></td>
                                    <td><?= $c->can_icr_number; ?></td>
                                    <td><?= $c->can_chip_number; ?></td>
                                    <td><?= $c->can_a_s; ?><?php if ($c->can_rip) echo '<div class="text-danger"><b>----- RIP -----<b></div>'; ?></td>
                                    <td><?= $c->can_breed; ?></td>
                                    <td><?= $c->can_gender; ?></td>
                                    <td><?= $c->can_color; ?></td>
                                    <td class="text-nowrap"><?= $c->can_date_of_birth; ?></td>
                                    <td><?= $c->ken_name; ?></td>
                                    <td><?= $c->mem_name; ?></td>
                                    <td><?= $c->can_note; ?></td>
                                    <td class="text-nowrap"><?= $c->can_reg_date; ?></td>
                                    <td><?= $c->stat_name.'<br/>'.$c->use_username.' (<span class="text-nowrap">'.$c->can_app_date.'</span>)'; ?></td>
                                    <td style="display: none;"><?= $c->can_app_date2; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <br/>
                    <?= $this->pagination->create_links(); ?>
                </div>
            </div>                           
        </div> 
        <div class="modal fade text-dark" id="error-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-danger">
                        <?php if ($this->session->flashdata('error_message')){ ?>
                            <div class="row">
                                <div class="col-12"><?= $this->session->flashdata('error_message') ?></div>
                            </div>
                        <?php } ?>
                        <?php if (validation_errors()){ ?>
                            <div class="row">
                                <?= validation_errors() ?>
                            </div>
                        <?php } ?>
                        <div id="error-row" class="row" style="display: none;">
                            <div id="error-col" class="col-12"></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="message-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Notification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-success">
                            <?php if ($this->session->flashdata('add_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Canine has been saved</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('edit_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Canine has been edited</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('edit_pedigree_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Pedigree has been edited</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('delete_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Canine has been deleted</div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                        </div>
                    </div>
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
        function edit(id){
            window.location = "<?= base_url(); ?>backend/Canines/edit_canine/"+id;
        }
        function pedigree(id){
            window.location = "<?= base_url(); ?>backend/Canines/edit_pedigree/"+id;
        }
        function del(id, nama){
            var proceed = confirm("Delete "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Canines/delete/"+id;
            }
        }
        function print(id){
            window.location = "<?= base_url(); ?>backend/Certificate/front/"+id;
        }
        function detail(id){
            window.location = "<?= base_url(); ?>backend/Canines/view_detail/"+id;
        }
        function log(id){
            window.location = "<?= base_url(); ?>backend/Canines/log/"+id;
        }
        function note(id){
            window.location = "<?= base_url(); ?>backend/Caninenote/index/"+id;
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

        $(document).ready(function () {
        //     $('#datatable').DataTable({searching: false, info: false, "ordering": true, order: [[17, 'desc']], dom: 'lpftrip',
        //         columnDefs: [{
        //             orderable: false,
        //             targets: "no-sort"
        //         }]
        //     });
            <?php		
                if ($this->session->flashdata('add_success') || $this->session->flashdata('edit_success') ||
                    $this->session->flashdata('edit_pedigree_success') || $this->session->flashdata('delete_success')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>

            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
    </script>
    <!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script> -->
</body>
</html>