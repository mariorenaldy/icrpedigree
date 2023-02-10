<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Stud List</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center text-primary">Stud List</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'Stud has been saved<br/>';
                        }
                        if ($this->session->flashdata('edit_success')){
                            echo 'Stud has been edited<br/>';
                        }
                        if ($this->session->flashdata('delete')){
                            echo 'Stud has been deleted<br/>';
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
                    <form id="formStud" action="<?= base_url().'backend/Studs/search'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Stud date" name="keywords" id="keywords" autocomplete="off" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Search Stud"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" onclick="add()" data-toggle="tooltip" data-placement="top" title="Add Stud"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><b>Photo</b></div>
                    <div class="col-md-2"><b>Sire</b></div>
                    <div class="col-md-2"><b>Dam</b></div>
                    <div class="col-md-2"><b>Date</b></div>
                    <div class="col-md-2"><b>Status</b></div>
                </div>
                <?php
                    $i = 0; 
                    foreach ($stud AS $s){ ?>
                    <div class="row">
                        <div class="col-md-2">
                            <?php if (!$birth[$i]){ ?>
                                <button type="button" class="btn btn-success mb-1" onclick="edit(<?= $s->stu_id ?>)" data-toggle="tooltip" data-placement="top" title="Edit Stud"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-danger mb-1" onclick="del(<?= $s->stu_id ?>)" data-toggle="tooltip" data-placement="top" title="Delete Stud"><i class="fa fa-trash"></i></button><br/>
                                <button type="button" class="btn btn-warning mb-1" onclick="addBirth(<?= $s->stu_id ?>)" data-toggle="tooltip" data-placement="top" title="Add Birth"><i class="fa fa-plus"></i></button>
                            <?php } ?>
                        </div>
                        <div class="col-md-2 mb-1 text-center">
                            <img src="<?= base_url('uploads/stud/'.$s->stu_photo) ?>" class="img-fluid img-thumbnail" alt="Stud">
                        </div>
                        <div class="col-md-2 mb-1 text-center">
                            <img src="<?= base_url('uploads/stud/'.$s->stu_sire_photo) ?>" class="img-fluid img-thumbnail" alt="Sire">
                            <br/><?= $s->sire_a_s ?>
                        </div>
                        <div class="col-md-2 mb-1 text-center">
                            <img src="<?= base_url('uploads/stud/'.$s->stu_dam_photo) ?>" class="img-fluid img-thumbnail" alt="Dam">
                            <br/><?= $s->dam_a_s ?>
                        </div>
                        <div class="col-md-2">
                            <?= $s->stu_stud_date; ?>
                        </div>
                        <div class="col-md-2">
                            <?= $s->stat_name.'<br/>'.$s->use_name.' (<span class="text-nowrap">'.$s->stu_app_date.'</span>)'; ?>
                        </div>
                    </div>
                <?php
                    $i++; 
                } ?>
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
        setDatePicker('#keywords');
        function add(){
            window.location = "<?= base_url(); ?>backend/Studs/add";
        }
        function addBirth(studId){
            window.location = "<?= base_url(); ?>backend/Births/add/"+studId;
        }
        function edit(id){
            window.location = "<?= base_url(); ?>backend/Studs/edit/"+id;
        }
        function del(id){
            var proceed = confirm("Delete stud?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Studs/delete/"+id;
            }
        }
        <?php if ($this->session->flashdata('telp') && $this->session->flashdata('mesg')){ ?>
			mesg = window.encodeURIComponent("<?= $this->session->flashdata('mesg') ?>");
			wa = "https://wa.me/" + <?= $this->session->flashdata('telp') ?> + "?text=" + mesg;
			window.open(wa, "_blank");
	    <?php } ?>
        $(document).ready(function () {
            $('#keywords').on("change", function(){
                $('#formStud').attr('action', "<?= base_url(); ?>backend/Studs/search").submit();
            });
        });
    </script>
</body>
</html>