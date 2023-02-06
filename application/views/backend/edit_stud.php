<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Edit Stud</title>
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
                    <h3 class="text-center text-primary">Edit Stud</h3>  
                    <form id="formStud" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="text-danger">
                            <?php
                            if ($this->session->flashdata('error_message')) {
                                echo $this->session->flashdata('error_message') . '<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Member</label>
                            <label class="control-label col-md-10"><?= $member->mem_name ?></label>
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
                                    if (!$mode)
                                        echo form_dropdown('stu_sire_id', $pil, $stud->stu_sire_id, 'class="form-control"');
                                    else
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
                                    if (!$mode)
                                        echo form_dropdown('stu_dam_id', $opt, $stud->stu_dam_id, 'class="form-control"');
                                    else
                                        echo form_dropdown('stu_dam_id', $opt, set_value('stu_dam_id'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-md-12 text-center">Stud Photo</label>
                            <div class="col-md-12 text-center">
                                <?php 
                                    if (!$mode){ 
                                        if ($stud->stu_photo){
                                ?>
                                    <img id="imgPreview" width="15%" src="<?= base_url().'uploads/stud/'.$stud->stu_photo ?>">
                                <?php } else { ?>
                                    <img id="imgPreview" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <?php } 
                                } else { ?>
                                    <img id="imgPreview" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <?php } ?>
                                <input type="file" class="upload" name="attachment_stud" id="imageInput" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-md-12 text-center">Sire Photo</label>
                            <div class="col-md-12 text-center">
                                <?php 
                                    if (!$mode){ 
                                        if ($stud->stu_sire_photo){
                                ?>
                                    <img id="imgPreviewSire" width="15%" src="<?= base_url().'uploads/stud/'.$stud->stu_sire_photo ?>">
                                <?php } else { ?>
                                    <img id="imgPreviewSire" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <?php } 
                                } else { ?>
                                    <img id="imgPreviewSire" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <?php } ?>
                                <input type="file" class="upload" name="attachment_sire" id="imageInputSire" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-md-12 text-center">Dam Photo</label>
                            <div class="col-md-12 text-center">
                                <?php 
                                    if (!$mode){ 
                                        if ($stud->stu_dam_photo){
                                ?>
                                    <img id="imgPreviewDam" width="15%" src="<?= base_url().'uploads/stud/'.$stud->stu_dam_photo ?>">
                                <?php } else { ?>
                                    <img id="imgPreviewDam" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <?php } 
                                } else { ?>
                                    <img id="imgPreviewDam" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <?php } ?>
                                <input type="file" class="upload" name="attachment_dam" id="imageInputDam" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="stu_stud_date" class="control-label col-md-2">Stud Date</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input type="hidden" name="stu_id" value="<?= $stud->stu_id ?>"> 
                                    <input type="hidden" name="can_member_id" value="<?= $stud->stu_member_id ?>"> 
                                    <input class="form-control" type="text" placeholder="Stud Date" id="stu_stud_date" name="stu_stud_date" value="<?= $stud->stu_stud_date ?>" autocomplete="off">
                                <?php } else { ?>
                                    <input type="hidden" name="stu_id" value="<?= set_value('stu_id') ?>"> 
                                    <input type="hidden" name="can_member_id" value="<?= set_value('can_member_id') ?>"> 
                                    <input class="form-control" type="text" placeholder="Stud Date" id="stu_stud_date" name="stu_stud_date" value="<?= set_value('stu_stud_date'); ?>" autocomplete="off">
                                <?php } ?>
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

        $('#can_member_id').on("change", function(){
            $('#formStud').attr('action', "<?= base_url(); ?>backend/Studs/search_sire_update").submit();
        });

        $('#buttonDamSearch').on("click", function(e) {
            e.preventDefault();
            $('#formStud').attr('action', "<?= base_url(); ?>backend/Studs/search_dam_update").submit();
        });

        $('#buttonSubmit').on("click", function(e) {
            e.preventDefault();
            $('#formStud').attr('action', "<?= base_url(); ?>backend/Studs/validate_edit").submit();
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