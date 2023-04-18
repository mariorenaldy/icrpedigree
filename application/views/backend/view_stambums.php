<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Puppy List</title>
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
                <h3 class="text-center text-primary">Puppy List</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'Puppy has been saved<br/>';
                        }
                        if ($this->session->flashdata('delete_success')){
                            echo 'Puppy has been deleted<br/>';
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
                <div class="search-container my-3 sticky-top">
                    <form action="<?= base_url().'backend/Stambums/search'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Name/Kennel" name="keywords" value="<?= $keywords ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    <!-- </form> -->
                </div>
                <!-- <form action="<?= base_url().'backend/Stambums/search'?>" method="post"> -->
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
                        <button type="button" class="btn btn-primary" onclick="add()"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <?= $this->pagination->create_links(); ?>
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="no-sort"></th>
                                <th class="no-sort"></th>
                                <th class="no-sort" style="width: 10%">Photo</th>
                                <th>Name</th>
                                <th class="no-sort">Breed</th>
                                <th class="no-sort">Gender</th>
                                <th class="no-sort">Date of Birth</th>
                                <th class="no-sort">Kennel</th>
                                <th class="no-sort">Owner</th>
                                <th class="no-sort">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stambum AS $r){ ?>
                                <tr>
                                    <td>
                                        <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                                        <button type="button" class="btn btn-danger mb-1" onclick="del(<?= $r->stb_id ?>, '<?= $r->stb_a_s ?>')" data-toggle="tooltip" data-placement="top" title="Delete Puppy"><i class="fa fa-trash"></i></button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                                            <button type="button" class="btn btn-dark mb-1" onclick="log(<?= $r->stb_id ?>)" data-toggle="tooltip" data-placement="top" title="Puppy Log"><i class="fa fa-history"></i></button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($r->stb_photo && $r->stb_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/canine/'.$r->stb_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="myImg<?= $r->stb_id ?>" onclick="display('myImg<?= $r->stb_id ?>')">
                                        <?php } else{ ?>
                                            <img src="<?= base_url().'assets/img/'.$this->config->item('canine_img') ?>" class="img-fluid img-thumbnail" alt="canine" id="myImg<?= $r->stb_id ?>" onclick="display('myImg<?= $r->stb_id ?>')">
                                        <?php } ?>
                                    </td>
                                    <td><?= $r->stb_a_s; ?></td>
                                    <td><?= $r->stb_breed; ?></td>
                                    <td><?= $r->stb_gender; ?></td>
                                    <td class="text-nowrap"><?= $r->stb_date_of_birth; ?></td>
                                    <td><?= $r->ken_name; ?></td>
                                    <td><?= $r->mem_name; ?></td>
                                    <td><?= $r->stat_name.'<br/>'.$r->use_username.' (<span class="text-nowrap">'.$r->stb_app_date.'</span>)'; ?></td>
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
        function add(){
            window.location = "<?= base_url(); ?>backend/Births";
        }
        function del(id, nama){
            var proceed = confirm("Delete "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Stambums/delete/"+id;
            }
        }
        function log(id){
            window.location = "<?= base_url(); ?>backend/Stambums/log/"+id;
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
        //     $('#datatable').DataTable({searching: false, info: false, "ordering": true, order: [[2, 'asc']], dom: 'lpftrip',
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