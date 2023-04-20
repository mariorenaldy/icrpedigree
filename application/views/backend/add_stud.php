<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Add Stud</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>assets/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/cropper.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/crop-modal-styles.css" rel="stylesheet" />
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
                                <input type="file" class="upload" id="imageInput" accept="image/jpeg, image/png, image/jpg" onclick="resetImage('stud')"/>
                                <input type="hidden" name="attachment_stud" id="attachment_stud">
                            </div>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-md-12 text-center">Sire Photo</label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreviewSire" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" id="imageInputSire" accept="image/jpeg, image/png, image/jpg" onclick="resetImage('sire')"/>
                                <input type="hidden" name="attachment_sire" id="attachment_sire">
                            </div>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-md-12 text-center">Dam Photo</label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreviewDam" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" id="imageInputDam" accept="image/jpeg, image/png, image/jpg" onclick="resetImage('dam')"/>
                                <input type="hidden" name="attachment_dam" id="attachment_dam">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="stu_stud_date" class="control-label col-md-2">Stud Date</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Stud Date" id="stu_stud_date" name="stu_stud_date" value="<?= set_value('stu_stud_date'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="hidden" id="mode" name="mode" value="<?= $mode ?>" />
                            <button id="buttonSubmit" class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>backend/Studs'">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crop Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <img src="" id="sample_image" />
                                </div>
                                <div class="col-md-4">
                                    <div class="preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="crop" class="btn btn-primary">Crop</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel-btn">Batal</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="error-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-danger">
                        <?php if ($this->session->flashdata('error_message')){ ?>
                            <div class="row">
                                <div class="col-12"><?= $this->session->flashdata('error_message') ?></div>
                            </div>
                        <?php } ?>
                        <?php if (validation_errors()){ ?>
                            <div class="row">
                                <?= validation_errors() ?>
                            </div>
                        <?php } ?>
                        <div id="error-row" class="row" style="display: none;">
                            <div id="error-col" class="col-12"></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('templates/footer'); ?>
    </main>
    <?php $this->load->view('templates/script'); ?>
    <script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/cropper.min.js"></script>
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

        const imageInput = document.querySelector("#imageInput");
        const imageInputSire = document.querySelector("#imageInputSire");
        const imageInputDam = document.querySelector("#imageInputDam");
        var croppingImage = null;

        var resetImage = function(input) {
            if(input === "stud"){
                imageInput.value = null;
            }
            else if(input === "sire"){
                imageInputSire.value = null;
            }
            else if(input === "dam"){
                imageInputDam.value = null;
            }
        };

        $(document).ready(function(){
            var $modal = $('#modal');
            var previewStud = document.getElementById('imgPreview');
            var previewSire = document.getElementById('imgPreviewSire');
            var previewDam = document.getElementById('imgPreviewDam');
            var modalImage = document.getElementById('sample_image');
            var latestImage = null;
            var cropper;

            imageInput.addEventListener("change", function(event) {
                croppingImage = "stud";
                showModalImg(event);
            })

            imageInputSire.addEventListener("change", function(event) {
                croppingImage = "sire";
                showModalImg(event);
            })

            imageInputDam.addEventListener("change", function(event) {
                croppingImage = "dam";
                showModalImg(event);
            })

            function showModalImg(event) {
                var files = event.target.files;
                var done = function(url) {
                    modalImage.src = url;
                    $modal.modal('show');
                };
                if (files && files.length > 0) {
                    reader = new FileReader();
                    reader.onload = function(event) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(files[0]);
                }
            }

            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(modalImage, {
                    aspectRatio: <?= $this->config->item('img_width_ratio') ?>/<?= $this->config->item('img_height_ratio') ?>,
                    viewMode: <?= $this->config->item('mode') ?>,
                    preview: '.preview'
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });

            $('#crop').click(function() {
                canvas = cropper.getCroppedCanvas({
                    width: <?= $this->config->item('img_width') ?>,
                    height: <?= $this->config->item('img_height') ?>
                });
                canvas.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        base64data = reader.result;
                        if(croppingImage === "stud"){
                            previewStud.src = base64data;
                            $('#attachment_stud').val(base64data);
                        }
                        else if(croppingImage === "sire"){
                            previewSire.src = base64data;
                            $('#attachment_sire').val(base64data);
                        }
                        else if(croppingImage === "dam"){
                            previewDam.src = base64data;
                            $('#attachment_dam').val(base64data);
                        }
                        $modal.modal('hide');
                    };
                });
            });

            $('#cancel-btn').click(function() {
                resetImage(croppingImage);
            });

            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>

            <?php if (isset($warning)){ ?>
                var proceed = confirm("<?php 
                    foreach ($warning AS $r){
                        echo $r.'\n';
                    }
                    echo 'Proceed?';
                ?>");
                if (proceed){
                    $('#mode').val(1);
                }
                else{
                    window.location = '<?= base_url() ?>backend/Studs';
                }
            <?php } ?>
        });
    </script>
</body>

</html>