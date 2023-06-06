<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title><?= lang("owner_report"); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/cropper.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/crop-modal-styles.css" rel="stylesheet" />
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_member'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <div class="container">
            <h3 class="text-center text-warning"><?= lang("owner_report"); ?></h3>  
            <div class="row">            
                <div class="col-sm-12 align-items-center">                          
                    <form id="formCanine" class="form-horizontal" action="<?= base_url(); ?>frontend/Requestownershipcanine/validate" method="post">
                        <div class="row mb-2">
                            <div class="col-sm-2"><?= lang("common_dog_name"); ?></div>
                            <div class="col-sm-4">: <?= $canine->can_a_s ?></div>
                        </div>
                        <hr/>
                        <div class="row mb-2">
                            <div class="col-sm-12"><?= lang("owner_new"); ?>:</div>
                        </div>
                        <label class="checkbox-inline"><input type="checkbox" name="reg_member" value="1" <?php if (!$mode) echo 'checked'; else echo set_checkbox('reg_member', '1'); ?> /> Member</label>
                        <div class="input-group my-3">
                            <label class="control-label col-sm-2">Member/Kennel</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" placeholder="Member/Kennel" name="mem_name" value="<?= set_value('mem_name'); ?>">
                            </div>
                            <div class="col-sm-1 text-end">
                                <button id="buttonSearch" class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-sm-2">Member</label>
                            <div class="col-sm-10">
                                <?php
                                    $mem = [];
                                    foreach($member as $row){
                                        $mem[$row->mem_id] = $row->mem_name;
                                    }
                                    echo form_dropdown('can_member_id', $mem, set_value('can_member_id'), 'class="form-control", id="can_member_id"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-5">
                            <label class="control-label col-sm-2">Kennel</label>
                            <div class="col-sm-10">
                                <?php
                                    $ken = [];
                                    foreach($kennel as $row){
                                        $ken[$row->ken_id] = $row->ken_name;
                                    }
                                    echo form_dropdown('can_kennel_id', $ken, $kennel_id, 'class="form-control", id="can_kennel_id"');
                                ?>
                            </div>
                        </div>
                        <hr/>
                        <div class="input-group mb-3">
                            <label for="mem_name" class="control-label col-sm-2"><?= lang("common_name"); ?></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="<?= lang("common_name"); ?>" name="name" value="<?= set_value('name'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_hp" class="control-label col-sm-2"><?= lang("mem_phone_number"); ?></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" placeholder="<?= lang("mem_phone_number"); ?>" name="hp" value="<?= set_value('hp'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_email" class="control-label col-sm-2">email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="email" name="email" value="<?= set_value('email'); ?>">
                            </div>
                        </div>
                        <hr/>
                        <div class="input-group mt-3 mb-3 gap-3">
                            <label class="control-label col-sm-12 text-center"><?= lang("owner_old_stambum_photo"); ?></label>
                            <div class="col-sm-12 text-center">
                                <img id="imgPreviewStb" width="15%" src="<?= base_url().'assets/img/avatar.jpg' ?>">
                                <input type="file" class="upload" id="imageInputStb" accept="image/jpeg, image/png, image/jpg" onclick="resetImage('stb')"/>
                                <input type="hidden" name="attachment_stb" id="attachment_stb">
                            </div>
                        </div>
                        <div class="input-group mt-3 mb-3 gap-3">
                            <label class="control-label col-sm-12 text-center"><?= lang("owner_new_dog_photo"); ?></label>
                            <div class="col-sm-12 text-center">
                                <img id="imgPreviewCanine" width="15%" src="<?= base_url().'assets/img/avatar.jpg' ?>">
                                <input type="file" class="upload" id="imageInputCanine" accept="image/jpeg, image/png, image/jpg" onclick="resetImage('canine')"/>
                                <input type="hidden" name="attachment_canine" id="attachment_canine">
                            </div>
                        </div>
                        <input type="hidden" name="can_id" value="<?php if (!$mode) echo $canine->can_id; else echo set_value('can_id'); ?>"/>
                        <div class="text-center">
                            <button id="buttonSubmit" class="btn btn-primary" type="button"><?= lang("common_save"); ?></button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>frontend/Canines'"><?= lang("common_back"); ?></button>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel-btn"><?= lang("common_cancel"); ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="confirm-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= lang("common_data_confirmation"); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-1">
                            <div class="col-4"><?= lang("owner_old_stambum_photo"); ?></div>
                            <div class="col-auto pe-0">:</div>
                            <div class="col"><img id="confirm-foto_stb" width="50%"/></div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4"><?= lang("owner_new_dog_photo"); ?></div>
                            <div class="col-auto pe-0">:</div>
                            <div class="col"><img id="confirm-foto_canine" width="50%"/></div>
                        </div>
                        <div id="memberContainer" style="display: none;">
                            <div class="row">
                                <div class="col-4">Member</div>
                                <div class="col">: <span id="confirm-member"></span></div>
                            </div>
                            <div class="row">
                                <div class="col-4">Kennel</div>
                                <div class="col">: <span id="confirm-kennel"></span></div>
                            </div>
                        </div>
                        <div id="notMemberContainer" style="display: none;">
                            <div class="row">
                                <div class="col-4">Name</div>
                                <div class="col">: <span id="confirm-name"></span></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><?= lang("mem_phone_number"); ?></div>
                                <div class="col">: <span id="confirm-phone_number"></span></div>
                            </div>
                            <div class="row">
                                <div class="col-4">email</div>
                                <div class="col">: <span id="confirm-email"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" id="submitBtn"><?= lang("common_yes"); ?></button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= lang("common_no"); ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="error-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= lang("common_error_message"); ?></h5>
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
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/cropper.min.js"></script>
    <script>
        $('#buttonSearch').on("click", function(e){
            e.preventDefault();
            $('#formCanine').attr('action', "<?= base_url(); ?>frontend/Requestownershipcanine/search_member").submit();
        });

        $('#can_member_id').on("change", function(){
            $('#formCanine').attr('action', "<?= base_url(); ?>frontend/Requestownershipcanine/search_kennel").submit();
        });

        const imageInputStb = document.querySelector("#imageInputStb");
        const imageInputCanine = document.querySelector("#imageInputCanine");
        var croppingImage = null;

        var resetImage = function(input) {
            if(input === "stb"){
                imageInputStb.value = null;
            }
            else if(input === "canine"){
                imageInputCanine.value = null;
            }
        };

        $(document).ready(function(){
            var $modal = $('#modal');
            var previewStb = document.getElementById('imgPreviewStb');
            var previewCanine = document.getElementById('imgPreviewCanine');
            var modalImage = document.getElementById('sample_image');
            var latestImage = null;
            var cropper;

            imageInputStb.addEventListener("change", function(event) {
                croppingImage = "stb";
                showModalImg(event);
            })

            imageInputCanine.addEventListener("change", function(event) {
                croppingImage = "canine";
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
                        if (croppingImage === "stb"){
                            previewStb.src = base64data;
                            $('#attachment_stb').val(base64data);
                        }
                        else if (croppingImage === "canine"){
                            previewCanine.src = base64data;
                            $('#attachment_canine').val(base64data);
                        }
                        $modal.modal('hide');
                    };
                });
            });

            $('#cancel-btn').click(function() {
                resetImage(croppingImage);
            });

            let saveBtn = $("#buttonSubmit");
            saveBtn.click(function(){
                if($('input[name="reg_member"]').is(":checked")){
                    $('#memberContainer').show();
                    $('#notMemberContainer').hide();
                    $('#confirm-member').text($('#can_member_id option:selected').text());
                    $('#confirm-kennel').text($('#can_kennel_id option:selected').text());
                }
                else{
                    $('#memberContainer').hide();
                    $('#notMemberContainer').show();
                    $('#confirm-name').text($('input[name="name"]').val());
                    $('#confirm-phone_number').text($('input[name="hp"]').val());
                    $('#confirm-email').text($('input[name="email"]').val());
                }

                $('#confirm-foto_stb').attr("src",  $('#imgPreviewStb').attr("src"));
                $('#confirm-foto_canine').attr("src",  $('#imgPreviewCanine').attr("src"));
                $('#confirm-modal').modal('show');
            });

            let submitBtn = $("#submitBtn");
            submitBtn.click(function(){
                submitBtn.prop('disabled', true);
                $('#formCanine').attr('action', "<?= base_url(); ?>frontend/Requestownershipcanine/validate").submit();
            });

            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>

</html>