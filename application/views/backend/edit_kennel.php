<?php 
$member = []; 
$kennelType = []; 
$pil = [];
?>
<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Edit Kennel</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <main class="container">
        <?php $this->load->view('templates/header'); ?>
        <header class="d-flex flex-column align-items-center">                        
            <h2 class="fw-bold">Edit Kennel</h2>
        </header>
        <div class="container">
            <div class="row">            
                <div class="col-md-12 align-items-center">                          
                    <form id="formKennel" class="form-horizontal" action="<?php echo base_url(); ?>backend/Kennels/validate_add" method="post" enctype="multipart/form-data">
                        <div class="text-danger">
                            <?php		
                            if ($this->session->flashdata('error_message')){
                                echo $this->session->flashdata('error_message').'<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <div class="input-group my-3">
                            <label class="control-label col-md-2">Member Name</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" placeholder="Member Name" name="mem_name" value="<?php echo set_value('mem_name'); ?>">
                            </div>
                            <div class="col-md-1 text-end">
                                <button id="buttonSearch" class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Member</label>
                            <div class="col-md-10">
                                <?php
                                    $i = 0;
                                    $mem = [];
                                    foreach($member as $row){
                                        $mem[$row->mem_id] = $row->mem_name;
                                    }
                                    echo form_dropdown('can_member_id', $mem, set_value('can_member_id'), 'class="form-control", id="can_member_id"');
                                ?>
                            </div>
                        </div>
                        <hr/>
                        <div class="input-group mb-3 gap-3">
                            <label for="imageInputLogo" class="control-label col-md-12 text-center">Kennel Photo</label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreviewLogo" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment_logo" id="imageInputLogo"/>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="ken_name" class="control-label col-md-2">Kennel Name</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Kennel Name" name="ken_name" value="<?= set_value('ken_name'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_ktp" class="control-label col-md-2">Formatted Name</label>
                            <?php
                                foreach($kennelType as $row){
                                    $pil[$row->ken_type_id] = $row->ken_type_name;
                                }
                                echo form_dropdown('ken_type_id', $pil, set_value('ken_type_id'), 'class="form-control"');
                            ?>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary btn-lg" type="submit">Save</button>
                            <button class="btn btn-danger btn-lg" type="button" onclick="window.location = '<?= base_url() ?>frontend/Kennels'">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php $this->load->view('templates/script'); ?>
    <script>
        $('#buttonSearch').on("click", function(e){
            e.preventDefault();
            $('#formKennel').attr('action', "<?= base_url(); ?>backend/Kennels/search_member").submit();
        });

        $('#buttonSubmit').on("click", function(e){
            e.preventDefault();
            $('#formKennel').attr('action', "<?= base_url(); ?>backend/Kennels/validate_add").submit();
        });

        $(document).ready(function(){
            const imageInputLogo = document.querySelector("#imageInputLogo");
            imageInputLogo.addEventListener("change", function() {
                const reader = new FileReader();
                reader.addEventListener("load", () => {
                    document.querySelector("#imgPreviewLogo").src = reader.result
                })
                reader.readAsDataURL(this.files[0])
            })
        });
    </script>
</body>
</html>

