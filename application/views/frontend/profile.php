<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title><?= lang("profile_title"); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link href="<?= base_url().'assets/css/pp-styles.css' ?>" rel="stylesheet" />
    <link href="<?= base_url().'assets/css/cropper.min.css' ?>" rel="stylesheet" />
    <link href="<?= base_url().'assets/css/crop-modal-styles.css' ?>" rel="stylesheet" />
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_non_paid'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <div class="container">
            <h3 class="text-center text-warning"><?= lang("profile_title"); ?></h3>
            <form action="<?= base_url(); ?>frontend/Members/change_pp" method="post" enctype="multipart/form-data">
                <div class="row mb-2">            
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 profilepic text-center">
                        <div class="d-inline-block" style="position: relative;">
                            <img src="<?php if ($member->mem_pp != '-') echo base_url().'uploads/members/'.$member->mem_pp; else echo base_url().'assets/img/avatar.jpg'; ?>" class="img-fluid img-thumbnail profile profilepic__image" alt="PP">
                            <div class="profilepic__content">
                                <span class="profilepic__icon"><i class="fa-solid fa-file-image"></i></span>
                                <span class="profilepic__text"><?= lang("profile_change_pp"); ?></span>
                            </div>
                            <input type="file" class="upload" id="my_file" style="display: none;" onclick="resetImage(event)"/>
                            <input type="hidden" name="attachment_pp" id="attachment_pp">
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 edit-buttons text-center" style="display: none;">
                        <button class="btn btn-primary" type="submit"><?= lang("profile_save"); ?></button>
                        <button class="btn btn-danger" type="button" onclick="revert()"><?= lang("profile_cancel"); ?></button>
                    </div>
                </div>
            </form>
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3"><?= lang("profile_id_card_number"); ?></div>
                <div class="col-sm-8"><?= $member->mem_ktp ?></div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3"><?= lang("profile_name"); ?></div>
                <div class="col-sm-8"><?= $member->mem_name ?></div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3"><?= lang("profile_mailing_address"); ?></div>
                <div class="col-sm-8"><?= $member->mem_address ?></div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3"><?= lang("profile_certificate_address"); ?></div>
                <div class="col-sm-8"><?= $member->mem_mail_address ?></div>
            </div>      
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3"><?= lang("profile_number"); ?></div>
                <div class="col-sm-8"><?= $member->mem_hp ?></div>
            </div>      
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3"><?= lang("profile_city"); ?></div>
                <div class="col-sm-8"><?= $member->mem_kota ?></div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3"><?= lang("profile_postal_code"); ?></div>
                <div class="col-sm-8"><?= $member->mem_kode_pos ?></div>
            </div>     
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3"><?= lang("profile_email"); ?></div>
                <div class="col-sm-8"><?= $member->mem_email ?></div>
            </div>
            <hr/>
            <div class="row mb-2">
                <div class="col-md-12 text-center">
                    <?php 
                        if ($member->ken_photo && $member->ken_photo != '-'){
                    ?>
                        <img id="imgPreviewLogo" width="15%" src="<?= base_url().'uploads/kennels/'.$member->ken_photo ?>">
                    <?php } else { ?>
                        <img id="imgPreviewLogo" width="15%" src="<?= base_url().'assets/img/avatar.jpg' ?>">
                    <?php } ?>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3"><?= lang("profile_kennel_name"); ?></div>
                <div class="col-sm-8"><?= $member->ken_name ?></div>
            </div>     
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3"><?= lang("profile_kennel_format"); ?></div>
                <div class="col-sm-8"><?= $kennel->ken_type_name ?></div>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= lang("profile_cancel"); ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="error-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= lang("profile_error_message");?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-danger">
                        <?php if ($this->session->flashdata('error_message')){ ?>
                            <div class="row">
                                <div class="col-12"><?= $this->session->flashdata('error_message') ?></div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="message-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?= lang("profile_notice");?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-success">
                            <?php if ($this->session->flashdata('change_pp')){ ?>
                                <div class="row">
                                    <div class="col-12"><?= lang("profile_change_pp_success");?></div>
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
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
<script src="<?= base_url(); ?>assets/js/cropper.min.js"></script>
<script>
    var image = document.querySelector(".profilepic__image");
    var imageOri = image.src;
    var base64data = null;
    var editBtns = document.querySelector(".edit-buttons");
    document.querySelector('.profilepic').addEventListener('click', function() {
        document.querySelector('.profilepic input').click();
    });
    var loadFile = function() {
        image.src = base64data;
        $('#attachment_pp').val(base64data);
    };
    var reset = function(event) {
        event.target.value = null;
        base64data = null;
    };
    var revert = function() {
        editBtns.style.display = "none";
        image.src = imageOri;
    };

    $(document).ready(function() {
        var $modal = $('#modal');
        var image = document.getElementById('sample_image');
        var cropper;
        
        $('#my_file').change(function(event) {
            var files = event.target.files;
            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };
            if (files && files.length > 0) {
                reader = new FileReader();
                reader.onload = function(event) {
                    done(reader.result);
                };
                reader.readAsDataURL(files[0]);
            }
        });

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: <?= $this->config->item('mode') ?>,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $('#crop').click(function() {
            canvas = cropper.getCroppedCanvas({
                width: <?= $this->config->item('pp') ?>,
                height: <?= $this->config->item('pp') ?>
            });
            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    base64data = reader.result;
                    loadFile();
                    editBtns.style.display = "block";
                    $modal.modal('hide');
                };
            });
        });

        <?php if ($this->session->flashdata('error_message')){ ?>
            $('#error-modal').modal('show');
        <?php } ?>
        <?php		
            if ($this->session->flashdata('change_pp')){ ?>
                $('#message-modal').modal('show');
        <?php } ?>
    });
</script>
</html>

