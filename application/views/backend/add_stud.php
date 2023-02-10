<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Add Stud</title>
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
                    <h3 class="text-center text-primary">Add Stud</h3>  
                    <form id="formStud" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="text-danger">
                            <?php
                            if ($this->session->flashdata('error_message')) {
                                echo $this->session->flashdata('error_message') . '<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <div class="input-group my-3">
                            <label class="control-label col-md-2">Member Name/Kennel</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" placeholder="Member Name/Kennel" name="mem_name" value="<?php echo set_value('mem_name'); ?>">
                            </div>
                            <div class="col-md-1 text-end">
                                <button id="buttonMemberSearch" class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
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
                        <div class="input-group mb-3">
                            <label for="stu_sire_id" class="control-label col-md-2">Sire</label>
                            <div class="col-md-10">
                                <?php
                                    $i = 0;
                                    $pil = [];
                                    foreach ($sire as $row) {
                                        if ($sireStat[$i])
                                            $pil[$row->id] = $row->name;
                                        $i++;
                                    }
                                    echo form_dropdown('stu_sire_id', $pil, set_value('stu_sire_id'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="can_a_s" class="control-label col-md-2">Search Dam</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" placeholder="Dam Name" name="can_a_s" value="<?= set_value('can_a_s'); ?>">
                            </div>
                            <div class="col-md-1 text-end">
                                <button id="buttonDamSearch" class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="stu_dam_id" class="control-label col-md-2">Dam Name</label>
                            <div class="col-md-10">
                                <?php
                                    $i = 0;
                                    $opt = [];
                                    foreach ($dam as $row) {
                                        if ($damStat[$i])
                                            $opt[$row->id] = $row->name;
                                        $i++;
                                    }
                                    echo form_dropdown('stu_dam_id', $opt, set_value('stu_dam_id'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-md-12 text-center">Stud Photo</label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreview" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment_stud" id="imageInput" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-md-12 text-center">Sire Photo</label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreviewSire" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment_sire" id="imageInputSire" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-md-12 text-center">Dam Photo</label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreviewDam" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment_dam" id="imageInputDam" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="stu_stud_date" class="control-label col-md-2">Stud Date</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Stud Date" id="stu_stud_date" name="stu_stud_date" value="<?= set_value('stu_stud_date'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="text-center">
                            <button id="buttonSubmit" class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>backend/Studs'">Back</button>
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
            $(id).datepicker({
                dateFormat: 'dd-mm-yy'
            });
            $(id).readOnly = true;
        }
        setDatePicker('#stu_stud_date');

        $('#buttonMemberSearch').on("click", function(e) {
            e.preventDefault();
            $('#formStud').attr('action', "<?= base_url(); ?>backend/Studs/search_member").submit();
        });

        $('#can_member_id').on("change", function(){
            $('#formStud').attr('action', "<?= base_url(); ?>backend/Studs/search_sire").submit();
        });

        $('#buttonDamSearch').on("click", function(e) {
            e.preventDefault();
            $('#formStud').attr('action', "<?= base_url(); ?>backend/Studs/search_dam").submit();
        });

        $('#buttonSubmit').on("click", function(e) {
            e.preventDefault();
            $('#formStud').attr('action', "<?= base_url(); ?>backend/Studs/validate_add").submit();
        });

        $(document).ready(function() {
            const imageInput = document.querySelector("#imageInput");
            imageInput.addEventListener("change", function() {
                const reader = new FileReader();
                reader.addEventListener("load", () => {
                    document.querySelector("#imgPreview").src = reader.result
                })
                reader.readAsDataURL(this.files[0])
            })

            const imageInputSire = document.querySelector("#imageInputSire");
            imageInputSire.addEventListener("change", function() {
                const reader = new FileReader();
                reader.addEventListener("load", () => {
                    document.querySelector("#imgPreviewSire").src = reader.result
                })
                reader.readAsDataURL(this.files[0])
            })
        
            const imageInputDam = document.querySelector("#imageInputDam");
            imageInputDam.addEventListener("change", function() {
                const reader = new FileReader();
                reader.addEventListener("load", () => {
                    document.querySelector("#imgPreviewDam").src = reader.result
                })
                reader.readAsDataURL(this.files[0])
            })
        });
    </script>
</body>

</html>