<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Birth Log</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/backend-modal.css" rel="stylesheet" />
    <!-- <link href="<?= base_url(); ?>assets/css/datatables.min.css" rel="stylesheet" /> -->
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
                <h3 class="text-center text-primary">Birth Log</h3>
                <div class="search-container my-3">
                    <form id="formBirth" action="<?= base_url().'backend/Births/search_all'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-3 me-1">
                                <input type="text" class="form-control" placeholder="Name" name="keywords" value="<?= $keywords ?>">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Date of Birth" name="date" id="date" autocomplete="off" value="<?= $date ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Search Birth"><i class="fa fa-search"></i></button>
                            </div>
                            <label for="type" class="col-md-1 my-2 text-center">Type: </label>
                            <div class="col-md-2 my-1 text-end">
                                <?php
                                    $types[$this->config->item('accepted')] = 'Active';
                                    $types[$this->config->item('all')] = 'All';  
                                    $types[$this->config->item('completed')] = 'Complete';
                                    echo form_dropdown('type', $types, $type, 'class="form-control", id="type"');
                            ?>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" onclick="add()" data-toggle="tooltip" data-placement="top" title="Add Birth"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <?= $this->pagination->create_links(); ?>
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th width="15%">Stud Photo</th>
                                <th width="15%">Sire</th>
                                <th width="15%">Dam</th>
                                <th width="15%">Birth Photo</th>
                                <th>Male</th>
                                <th>Female</th>
                                <th>Date of Birth</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach ($birth AS $b){ ?>
                                <tr>
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
                                    <td>
                                        <?= $b->stat_name; ?>
                                    </td>
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
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script>
        function setDatePicker(id) {
            $(id).datepicker({ dateFormat: 'dd-mm-yy' });
            $(id).readOnly = true;
        }
        setDatePicker('#date');

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
            $('#keywords').on("change", function(){
                $('#formBirth').attr('action', "<?= base_url(); ?>backend/Births/search_all").submit();
            });

            $('#type').on("change", function(){
                $('#formBirth').attr('action', "<?= base_url(); ?>backend/Births/search_all").submit();
            });

            // $('#datatable').DataTable({searching: false, info: false, "ordering": false, dom: 'lpftrip',
            // });
        });

        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
    <!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script> -->
</body>
</html>