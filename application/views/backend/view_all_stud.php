<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Stud Log</title>
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
                <h3 class="text-center text-primary">Stud Log</h3>
                <div class="search-container my-3 sticky-top">
                    <form id="formStud" action="<?= base_url().'backend/Studs/search_all'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-3 me-1">
                                <input type="text" class="form-control" placeholder="Name" name="keywords" value="<?= $keywords ?>">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Stud date" name="date" id="date" autocomplete="off" value="<?= $date ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Search Stud"><i class="fa fa-search"></i></button>
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
                        <button type="button" class="btn btn-primary" onclick="add()" data-toggle="tooltip" data-placement="top" title="Add Stud"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <?= $this->pagination->create_links(); ?>
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th width="20%">Photo</th>
                                <th width="20%">Sire</th>
                                <th width="20%">Dam</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($stud AS $s){ ?>
                            <tr>
                                <td align="center">
                                    <img src="<?= base_url('uploads/stud/'.$s->stu_photo) ?>" class="img-fluid img-thumbnail" alt="Stud" id="stud<?= $s->stu_id ?>" onclick="display('stud<?= $s->stu_id ?>')">
                                </td>
                                <td align="center">
                                    <img src="<?= base_url('uploads/stud/'.$s->stu_sire_photo) ?>" class="img-fluid img-thumbnail" alt="Sire" id="sire<?= $s->stu_id ?>" onclick="display('sire<?= $s->stu_id ?>')">
                                    <br/><a class="text-decoration-none" href="<?= base_url() ?>backend/Canines/view_detail/<?= $s->stu_sire_id ?>"><?= $s->sire_a_s ?></a>
                                </td>
                                <td align="center">
                                    <img src="<?= base_url('uploads/stud/'.$s->stu_dam_photo) ?>" class="img-fluid img-thumbnail" alt="Dam" id="dam<?= $s->stu_id ?>" onclick="display('dam<?= $s->stu_id ?>')">
                                    <br/><a class="text-decoration-none" href="<?= base_url() ?>backend/Canines/view_detail/<?= $s->stu_dam_id ?>"><?= $s->dam_a_s ?></a>
                                </td>
                                <td class="text-nowrap">
                                    <?= $s->stu_stud_date; ?>
                                </td>
                                <td>
                                    <?= $s->stat_name; ?>
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
    <script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
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
                $('#formStud').attr('action', "<?= base_url(); ?>backend/Studs/search_all").submit();
            });

            $('#type').on("change", function(){
                $('#formStud').attr('action', "<?= base_url(); ?>backend/Studs/search_all").submit();
            });

            // $('#datatable').DataTable({searching: false, info: false, "ordering": false, dom: 'lpftrip',
            // });
        });
    </script>
    <!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script> -->
</body>
</html>