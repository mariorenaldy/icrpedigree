<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Add Canine</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <main class="container">
        <?php $this->load->view('templates/header'); ?>
        <header class="d-flex flex-column align-items-center">
            <h2 class="fw-bold">Add Canine</h2>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-items-center">
                    <form id="formCanine" class="form-horizontal" action="<?php echo base_url(); ?>backend/Canines/validate_add" method="post" enctype="multipart/form-data">
                        <div class="text-danger">
                            <?php
                            if ($this->session->flashdata('error_message')) {
                                echo $this->session->flashdata('error_message') . '<br/>';
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
                        <div class="input-group mb-5">
                            <label class="control-label col-md-2">Kennel</label>
                            <div class="col-md-10">
                                <?php
                                    $i = 0;
                                    $ken = [];
                                    foreach($kennel as $row){
                                        $ken[$row->ken_id] = $row->ken_name;
                                    }
                                    echo form_dropdown('can_kennel_id', $mem, set_value('can_kennel_id'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <hr/>
                        <div class="input-group mt-3 mb-3 gap-3">
                            <label class="control-label col-md-12 text-center">Photo</label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreview" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment" id="imageInput" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Name</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Name" name="can_a_s" value="<?php echo set_value('can_a_s'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">No. Registration</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="No. Registration" name="can_reg_number" value="<?php echo set_value('can_reg_number'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Breed</label>
                            <div class="col-md-10">
                                <?php
                                foreach ($trah as $row) {
                                    $pil[$row->tra_name] = $row->tra_name;
                                }
                                echo form_dropdown('can_breed', $pil, set_value('can_breed'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Gender</label>
                            <div class="col-md-10">
                                <?php
                                $gender['Male'] = 'Male';
                                $gender['Female'] = 'Female';
                                echo form_dropdown('can_gender', $gender, set_value('can_gender'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Color</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Warna" name="can_color" value="<?php echo set_value('can_color'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Date of Birth</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Date of Birth" id="can_date_of_birth" name="can_date_of_birth" value="<?php echo set_value('can_date_of_birth'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="text-center">
                            <button id="buttonSubmit" class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>backend/Canines'">Back</button>
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
        setDatePicker('#can_date_of_birth');

        $('#buttonSearch').on("click", function(e){
            e.preventDefault();
            $('#formCanine').attr('action', "<?= base_url(); ?>backend/Canines/search_member").submit();
        });

        $('#can_member_id').on("change", function(){
            $('#formCanine').attr('action', "<?= base_url(); ?>backend/Canines/search_kennel").submit();
        });

        $('#buttonSubmit').on("click", function(e){
            e.preventDefault();
            $('#formCanine').attr('action', "<?= base_url(); ?>backend/Canines/validate_add").submit();
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

            const dropDown = document.querySelector("#can_member_id");
            dropDown.addEventListener("change", function() {
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