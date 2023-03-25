<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Birth List</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/backend-modal.css" rel="stylesheet" />
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
                <h3 class="text-center text-primary">Birth List</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'Birth has been saved<br/>';
                        }
                        if ($this->session->flashdata('edit_success')){
                            echo 'Birth has been edited<br/>';
                        }
                        if ($this->session->flashdata('delete')){
                            echo 'Birth has been deleted<br/>';
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
                    <form id="formBirth" action="<?= base_url().'backend/Births/search'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-3 me-1">
                                <input type="text" class="form-control" placeholder="Name" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Date of Birth" name="date" id="date" autocomplete="off" value="<?= set_value('date') ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Search Birth"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" onclick="add()" data-toggle="tooltip" data-placement="top" title="Add Birth"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="1%"></th>
                                <th width="1%"></th>
                                <th width="15%">Stud Photo</th>
                                <th width="15%">Sire</th>
                                <th width="15%">Dam</th>
                                <th width="15%">Birth Photo</th>
                                <th>Male</th>
                                <th>Female</th>
                                <th>Date of Birth<th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i = 0; 
                            foreach ($birth AS $b){
                                if ($stambum_stat[$i]){ ?>
                                <tr>
                                    <td>
                                        <?php if (!$stambum[$i]){ ?>
                                            <button type="button" class="btn btn-success mb-1" onclick="edit(<?= $b->bir_id ?>)" data-toggle="tooltip" data-placement="top" title="Edit Birth"><i class="fa fa-edit"></i></button>
                                            <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                                            <button type="button" class="btn btn-danger mb-1" onclick="del(<?= $b->bir_id ?>)" data-toggle="tooltip" data-placement="top" title="Delete Birth"><i class="fa fa-trash"></i></button>
                                            <?php } 
                                        } ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning mb-1" onclick="addStambum(<?= $b->bir_id ?>)" data-toggle="tooltip" data-placement="top" title="Add Puppy"><i class="fa fa-plus"></i></button>
                                        <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                                            <button type="button" class="btn btn-dark mb-1" onclick="log(<?= $b->bir_id ?>)" data-toggle="tooltip" data-placement="top" title="Birth Log"><i class="fa fa-history"></i></button>
                                        <?php } ?>
                                    </td>
                                    <td align="center">
                                        <img src="<?= base_url('uploads/stud/'.$b->stu_photo) ?>" class="img-fluid img-thumbnail" alt="Stud" id="stud<?= $b->bir_id ?>" onclick="display('stud<?= $b->bir_id ?>')"><br/><?= $b->stu_stud_date; ?>
                                    </td>
                                    <td align="center">
                                        <img src="<?= base_url('uploads/stud/'.$b->stu_sire_photo) ?>" class="img-fluid img-thumbnail" alt="Sire" id="sire<?= $b->bir_id ?>" onclick="display('sire<?= $b->bir_id ?>')">
                                        <br/><a class="text-decoration-none" href="<?= base_url() ?>backend/Canines/view_detail/<?= $b->sire_id ?>"><?= $b->sire ?></a>
                                    </td>
                                    <td align="center">
                                        <img src="<?= base_url('uploads/stud/'.$b->stu_dam_photo) ?>" class="img-fluid img-thumbnail" alt="Dam" id="dam<?= $b->bir_id ?>" onclick="display('dam<?= $b->bir_id ?>')">
                                        <br/><a class="text-decoration-none" href="<?= base_url() ?>backend/Canines/view_detail/<?= $b->dam_id ?>"><?= $b->dam ?></a>
                                    </td>
                                    <td align="center">
                                        <img src="<?= base_url('uploads/births/'.$b->bir_dam_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="myImg<?= $b->bir_id ?>" onclick="display('myImg<?= $b->bir_id ?>')">
                                    </td>
                                    <td align="right">
                                        <?= $b->bir_male; ?>
                                    </td>
                                    <td align="right">
                                        <?= $b->bir_female; ?>
                                    </td>
                                    <td class="text-nowrap">
                                        <?= $b->bir_date_of_birth; ?>
                                    </td>
                                </tr>
                        <?php   }
                                $i++;
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script>
        function setDatePicker(id) {
            $(id).datepicker({ dateFormat: 'dd-mm-yy' });
            $(id).readOnly = true;
        }
        setDatePicker('#date');

        function add(){
            window.location = "<?= base_url(); ?>backend/Studs";
        }
        function addStambum(birthId){
            window.location = "<?= base_url(); ?>backend/Stambums/add/"+birthId;
        }
        function edit(id){
            window.location = "<?= base_url(); ?>backend/Births/edit/"+id;
        }
        function del(id){
            var proceed = confirm("Delete birth?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Births/delete/"+id;
            }
        }
        function log(id){
            window.location = "<?= base_url(); ?>backend/Births/log/"+id;
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

        <?php if ($this->session->flashdata('telp') && $this->session->flashdata('mesg')){ ?>
			mesg = window.encodeURIComponent("<?= $this->session->flashdata('mesg') ?>");
			wa = "https://wa.me/" + <?= $this->session->flashdata('telp') ?> + "?text=" + mesg;
			window.open(wa, "_blank");
	    <?php } ?>

        $(document).ready(function () {
            $('#keywords').on("change", function(){
                $('#formBirth').attr('action', "<?= base_url(); ?>backend/Births/search").submit();
            });
        });
    </script>
</body>
</html>