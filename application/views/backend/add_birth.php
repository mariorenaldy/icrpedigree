<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Add Birth</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <main class="container">
        <?php $this->load->view('templates/header'); ?>
        <div class="container">
            <div class="row">            
                <div class="col-md-12 align-items-center">
                    <h3 class="text-center text-primary">Add Birth</h3>                         
                    <form id="formBirth" class="form-horizontal" action="<?= base_url(); ?>backend/Births/validate_add" method="post" enctype="multipart/form-data">
                        <?php if (!$mode){ ?>
                            <input type="hidden" name="bir_stu_id" value="<?= $bir_stu_id ?>" />
                        <?php } else { ?>
                            <input type="hidden" name="bir_stu_id" value="<?= set_value('bir_stu_id') ?>" />
                        <?php } ?>
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
                            <label for="stu_dam_id" class="control-label col-md-12 text-center">Dam Photo</label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreview" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment_dam" id="imageInput" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="bir_male" class="control-label col-md-2">Male</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Jumlah Jantan" name="bir_male" value="<?= set_value('bir_male'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="bir_female" class="control-label col-md-2">Female</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Jumlah Betina" name="bir_female" value="<?= set_value('bir_female'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="bir_date_of_birth" class="control-label col-md-2">Date of Birth</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Date of Birth" id="bir_date_of_birth" name="bir_date_of_birth" value="<?= set_value('bir_date_of_birth'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="text-center">
                            <button id="buttonSubmit" class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>backend/Births'">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php $this->load->view('templates/footer'); ?>
    </main>
    <?php $this->load->view('templates/script'); ?>
    <script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script>
        function setDatePicker(id) {
            $(id).datepicker({ dateFormat: 'dd-mm-yy' });
            $(id).readOnly = true;
        }
        setDatePicker('#bir_date_of_birth');

        $('#buttonSearch').on("click", function(e){
            e.preventDefault();
            $('#formBirth').attr('action', "<?= base_url(); ?>backend/Births/search_member").submit();
        });

        $('#buttonSubmit').on("click", function(e){
            e.preventDefault();
            $('#formBirth').attr('action', "<?= base_url(); ?>backend/Births/validate_add").submit();
        });

        $(document).ready(function(){
            const imageInput = document.querySelector("#imageInput");
            imageInput.addEventListener("change", function() {
                const reader = new FileReader();
                reader.addEventListener("load", () => {
                    document.querySelector("#imgPreview").src = reader.result
                })
                reader.readAsDataURL(this.files[0])
            })
        });
    </script>
</body>
</html>

