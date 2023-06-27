<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title><?= lang("can_add_puppy"); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link href="<?= base_url(); ?>assets/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/cropper.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/crop-modal-styles.css" rel="stylesheet" />
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_member'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <div class="container">
            <h3 class="text-center text-warning"><?= lang("can_add_puppy"); ?></h3>
            <div class="row">            
                <div class="col-sm-12 align-items-center">                          
                    <form id="formCanine" class="form-horizontal" action="<?= base_url(); ?>frontend/Stambums/validate_add" method="post" enctype="multipart/form-data">
                        <div class="input-group my-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-sm-12 text-center text-danger"><?= lang("can_full_body"); ?></label>
                            <div class="col-sm-12 text-center">
                                <img id="imgPreview" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" id="imageInput" accept="image/jpeg, image/png, image/jpg" onclick="resetImage('canine')"/>
                                <input type="hidden" name="attachment" id="attachment">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_name" class="control-label col-sm-2"><?= lang("can_name"); ?></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="<?= lang("can_name"); ?>" name="stb_a_s" value="<?= set_value('stb_a_s'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_hp" class="control-label col-sm-2"><?= lang("can_gender"); ?></label>
                            <div class="col-sm-10">
                                <?php
                                    $gender['MALE'] = 'MALE';
                                    $gender['FEMALE'] = 'FEMALE';
                                    echo form_dropdown('stb_gender', $gender, set_value('stb_gender'), 'class="form-control", id="stb_gender"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group my-3 gap-3 mt-5 mb-5">
                            <label for="stu_dam_id" class="control-label col-sm-12 text-center"><?= lang("common_photo_proof"); ?><br>Rp. 150.000</label>
                            <div class="col-sm-12 text-center">
                                <img id="imgPreviewProof" width="15%" src="<?= base_url('assets/img/proof.jpg') ?>">
                                <input type="file" class="upload" id="imageInputProof" accept="image/jpeg, image/png, image/jpg" onclick="resetImage('proof')"/>
                                <input type="hidden" name="attachment_proof" id="attachment_proof">
                            </div>
                        </div>
                        <input type="hidden" name="stb_bir_id" value="<?php if (!$mode) echo $birth->bir_id; else echo set_value('stb_bir_id'); ?>"/>
                        <div class="text-center">
                            <button class="btn btn-primary" type="button" id="saveBtn"><?= lang("common_save"); ?></button>
                            <button class="btn btn-danger" type="button" onclick="warning()"><?= lang("common_back"); ?></button>
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
                        <div class="row">
                            <div class="col-4"><?= lang("can_can_photo"); ?></div>
                            <div class="col-auto pe-0">:</div>
                            <div class="col"><img id="confirm-foto" width="50%"/></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><?= lang("can_name"); ?></div>
                            <div class="col">: <span id="confirm-nama"></span></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><?= lang("can_gender"); ?></div>
                            <div class="col">: <span id="confirm-jenis_kelamin"></span></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><?= lang("common_photo_proof"); ?></div>
                            <div class="col-auto pe-0">:</div>
                            <div class="col"><img id="confirm-proof" width="50%"/></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" id="submitBtn"><?= lang("common_yes"); ?></button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= lang("common_no"); ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="message-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?= lang("common_notice"); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-success">
                            <?php if ($this->session->flashdata('add_success')){ ?>
                                <div class="row">
                                    <div class="col-12"><?= lang("can_add_puppy_success"); ?></div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                        </div>
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
        function warning(){
            let site_lang = getCookie("site_lang");
            proceed = null;
            if(site_lang == "indonesia"){
                proceed = confirm("Simpan lapor anak?");
            }
            else{
                proceed = confirm("Save puppy report?");
            }

            if (proceed){
                window.location = '<?= base_url() ?>frontend/Stambums/force_complete/<?php if (!$mode) echo $birth->bir_id; else echo set_value('stb_bir_id'); ?>';
            }
            else{  
                window.location = '<?= base_url() ?>frontend/Stambums/cancel_all/<?php if (!$mode) echo $birth->bir_id; else echo set_value('stb_bir_id'); ?>';
            }
        }

        function getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for(let i = 0; i <ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        const imageInput = document.querySelector("#imageInput");
        const imageInputProof = document.querySelector("#imageInputProof");
        var croppingImage = null;

        var resetImage = function(input) {
            if(input === "canine"){
                imageInput.value = null;
            }
            else if(input === "proof"){
                imageInputProof.value = null;
            }
        };

        $(document).ready(function(){
            var $modal = $('#modal');
            var preview = document.getElementById('imgPreview');
            var previewProof = document.getElementById('imgPreviewProof');
            var modalImage = document.getElementById('sample_image');
            var latestImage = null;
            var cropper;
            var ratio = <?= $this->config->item('img_width_ratio') ?>/<?= $this->config->item('img_height_ratio') ?>;

            imageInput.addEventListener("change", function(event) {
                croppingImage = "canine";
                ratio = <?= $this->config->item('img_width_ratio') ?>/<?= $this->config->item('img_height_ratio') ?>;
                showModalImg(event);
            })

            imageInputProof.addEventListener("change", function(event) {
                croppingImage = "proof";
                ratio = <?= $this->config->item('img_height_ratio') ?>/<?= $this->config->item('img_height_ratio') ?>;
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
                    aspectRatio: ratio,
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
                        if(croppingImage === "canine"){
                            preview.src = base64data;
                            $('#attachment').val(base64data);
                        }
                        else if(croppingImage === "proof"){
                            previewProof.src = base64data;
                            $('#attachment_proof').val(base64data);
                        }
                        $modal.modal('hide');
                    };
                });
            });

            $('#cancel-btn').click(function() {
                resetImage(croppingImage);
            });

            let saveBtn = $("#saveBtn");
            saveBtn.click(function(){
                $('#confirm-foto').attr("src",  $('#imgPreview').attr("src"));
                $('#confirm-nama').text($('input[name="stb_a_s"]').val());
                $('#confirm-jenis_kelamin').text($('#stb_gender option:selected').text());
                $('#confirm-proof').attr("src",  $('#imgPreviewProof').attr("src"));

                $('#confirm-modal').modal('show');
            });

            let submitBtn = $("#submitBtn");
            submitBtn.click(function(){
                submitBtn.prop('disabled', true);
                $('#formCanine').submit();
            });

            <?php		
                if ($this->session->flashdata('add_success')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>

            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>
</html>

