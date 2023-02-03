<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Stambum List</title>
    <?php $this->load->view('templates/head'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datatables.min.css" />
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
                <h3 class="text-center text-primary">Stambum List</h3>
                <div class="text-success">
                    <?php
                        if ($this->session->flashdata('edit_success')){
                            echo 'Stambum has been edited<br/>';
                        }
                        if ($this->session->flashdata('delete_success')){
                            echo 'Stambum has been deleted<br/>';
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
                <div class="search-container my-3">
                    <form action="<?= base_url().'backend/Stambum/search'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Name" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="no-sort">Photo</th>
                                <th>Name</th>
                                <th class="no-sort">Breed</th>
                                <th class="no-sort">Gender</th>
                                <th class="no-sort">Color</th>
                                <th class="no-sort">Date of Birth</th>
                                <th class="no-sort">Kennel</th>
                                <th class="no-sort">Owner</th>
                                <th class="no-sort">Note</th>
                                <th class="no-sort">Status</th>
                                <th style="display: none;"></th>
                                <th style="display: none;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stambum AS $s){ ?>
                                <tr>
                                    <td>
                                        <?php if ($s->stb_photo && $s->stb_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/stambum/'.$s->stb_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="myImg<?= $s->stb_id ?>" onclick="display('myImg<?= $s->stb_id ?>')">
                                        <?php } else{ ?>
                                            <img src="<?= base_url().'assets/img/'.$this->config->item('canine_img') ?>" class="img-fluid img-thumbnail" alt="canine" id="myImg<?= $s->stb_id ?>" onclick="display('myImg<?= $s->stb_id ?>')">
                                        <?php } ?>
                                    </td>
                                    <td><?= $s->stb_a_s; ?></td>
                                    <td><?= $s->stb_breed; ?></td>
                                    <td><?= $s->stb_gender; ?></td>
                                    <td><?= $s->stb_color; ?></td>
                                    <td class="text-nowrap"><?= $s->stb_date_of_birth; ?></td>
                                    <td><?= $s->ken_name; ?></td>
                                    <td><?= $s->mem_name; ?></td>
                                    <td><?= $s->stb_note; ?></td>
                                    <td><?= $s->stat_name.'<br/>'.$s->use_name.' (<span class="text-nowrap">'.$s->stb_app_date.'</span>)'; ?></td>
                                    <td><button type="button" class="btn btn-success mb-1" onclick="edit(<?= $s->stb_id ?>)" data-toggle="tooltip" data-placement="top" title="Edit Stambum"><i class="fa fa-edit"></i></button></td>
                                    <td><button type="button" class="btn btn-danger mb-1" onclick="del(<?= $s->stb_id ?>, '<?= $s->stb_a_s ?>')" data-toggle="tooltip" data-placement="top" title="Delete Stambum"><i class="fa fa-close"></i></button></td>
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
        function edit(id){
            window.location = "<?= base_url(); ?>backend/Stambum/edit_stambum/"+id;
        }
        function del(id, nama){
            var proceed = confirm("Delete "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Stambum/delete/"+id;
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

        $(document).ready(function () {
            $('#datatable').DataTable({searching: false, info: false, "ordering": true, order: [[1, 'asc']],
                columnDefs: [{
                    orderable: false,
                    targets: "no-sort"
                }]
            });
        });
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script>
</body>
</html>