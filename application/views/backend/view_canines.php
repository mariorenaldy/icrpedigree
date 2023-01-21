<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Canine List</title>
    <?php $this->load->view('templates/head'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datatables.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/backend-modal.css" />
</head>
<body>
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
    </div>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center text-primary">Canine List</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'Canine has been saved<br/>';
                        }
                        if ($this->session->flashdata('edit_success')){
                            echo 'Canine has been edited<br/>';
                        }
                        if ($this->session->flashdata('edit_pedigree_success')){
                            echo 'Pedigree has been edited<br/>';
                        }
                        if ($this->session->flashdata('delete_success')){
                            echo 'Canine has been deleted<br/>';
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
                    <form action="<?= base_url().'backend/Canines/search'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="ICR number/Chip number/Name" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" onclick="add()"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
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
                                <th style="display: none;"></th>
                                <th style="display: none;"></th>
                                <th style="display: none;"></th>
                                <th style="display: none;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($canine AS $c){ ?>
                                <tr>
                                    <td>
                                        <?php if ($c->can_photo && $c->can_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/canine/'.$c->can_photo) ?>" id="myImg" class="img-fluid img-thumbnail" alt="canine">
                                        <?php } else{ ?>
                                            <img src="<?= base_url().'assets/img/'.$this->config->item('canine_img') ?>" id="myImg" class="img-fluid img-thumbnail" alt="canine">
                                        <?php } ?>
                                    </td>
                                    <td><?= $c->can_reg_number; ?></td>
                                    <td><?= $c->can_icr_number; ?></td>
                                    <td><?= $c->can_chip_number; ?></td>
                                    <td><?= $c->can_a_s; ?></td>
                                    <td><?= $c->can_breed; ?></td>
                                    <td><?= $c->can_gender; ?></td>
                                    <td><?= $c->can_color; ?></td>
                                    <td class="text-nowrap"><?= $c->can_date_of_birth; ?></td>
                                    <td><?= $c->ken_name; ?></td>
                                    <td><?= $c->mem_name; ?></td>
                                    <td><?= $c->can_note; ?></td>
                                    <td class="text-nowrap"><?= $c->can_reg_date; ?></td>
                                    <td><?= $c->stat_name.'<br/>'.$c->use_name.' (<span class="text-nowrap">'.$c->can_app_date.'</span>)'; ?></td>
                                    <td><button type="button" class="btn btn-success mb-1" onclick="edit(<?= $c->can_id ?>)" data-toggle="tooltip" data-placement="top" title="Edit Canine"><i class="fa fa-edit"></i></button></td>
                                    <td><button type="button" class="btn btn-warning mb-1" onclick="pedigree(<?= $c->can_id ?>)" data-toggle="tooltip" data-placement="top" title="Edit Pedigree"><i class="fa fa-edit"></i></button></td>
                                    <td><button type="button" class="btn btn-danger mb-1" onclick="del(<?= $c->can_id ?>, '<?= $c->can_a_s ?>')" data-toggle="tooltip" data-placement="top" title="Delete Canine"><i class="fa fa-close"></i></button></td>
                                    <td><button type="button" class="btn btn-primary mb-1" onclick="print(<?= $c->can_id; ?>)"><i class="fa fa-print"></i> (<?= $c->can_print; ?>)</button></td>
                                    <td><button type="button" class="btn btn-info mb-1" onclick="detail(<?= $c->can_id ?>)" data-toggle="tooltip" data-placement="top" title="Canine Detail"><i class="fa fa-file-o"></i></button></td>
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

        //modal script
        var modal = document.getElementById("myModal");

        // Get the image and insert it inside the modal
        var img = document.getElementById("myImg");
        var modalImg = document.getElementById("img01");
        img.onclick = function(){
            modal.style.display = "block";
            modalImg.src = this.src;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        $(document).ready(function () {
            $('#datatable').DataTable({searching: false, info: false, "ordering": true, order: [[4, 'asc']],
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