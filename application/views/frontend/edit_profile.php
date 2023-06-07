<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?= lang('mem_edit_kennel'); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link href="<?= base_url(); ?>assets/css/cropper.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/crop-modal-styles.css" rel="stylesheet" />
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_member'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <div class="container">
            <div class="row">            
                <div class="col-sm-12 align-items-center">                          
                    <h3 class="text-center text-warning"><?= lang('mem_edit_kennel'); ?></h3> 
                        <form id="mainForm" class="form-horizontal" action="<?= base_url(); ?>frontend/Requestmember/validate_edit" method="post" enctype="multipart/form-data">
                            <div class="input-group mb-3">
                                <label for="mem_ktp" class="control-label col-sm-2"><?= lang('mem_id_card_number'); ?></label>
                                <div class="col-sm-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="number" placeholder="<?= lang('mem_id_card_number'); ?>" name="mem_ktp" value="<?= $member->mem_ktp; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="number" placeholder="<?= lang('mem_id_card_number'); ?>" name="mem_ktp" value="<?= set_value('mem_ktp'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_name" class="control-label col-sm-2"><?= lang('mem_name'); ?></label>
                                <div class="col-sm-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="<?= lang('mem_name'); ?>" name="mem_name" value="<?= $member->mem_name; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="<?= lang('mem_name'); ?>" name="mem_name" value="<?= set_value('mem_name'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_mail_address" class="control-label col-sm-2"><?= lang('mem_mailing_address'); ?></label>
                                <div class="col-sm-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="<?= lang('mem_mailing_address'); ?>" name="mem_mail_address" value="<?= $member->mem_mail_address; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="<?= lang('mem_mailing_address'); ?>" name="mem_mail_address" value="<?= set_value('mem_mail_address'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_address" class="control-label col-sm-2"><?= lang('mem_certificate_address'); ?></label>
                                <div class="col-sm-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="<?= lang('mem_certificate_address'); ?>" name="mem_address" value="<?= $member->mem_address; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="<?= lang('mem_certificate_address'); ?>" name="mem_address" value="<?= set_value('mem_address'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_hp" class="control-label col-sm-2"><?= lang('mem_number'); ?></label>
                                <div class="col-sm-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="number" placeholder="<?= lang('mem_number'); ?>" name="mem_hp" value="<?= $member->mem_hp; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="number" placeholder="<?= lang('mem_number'); ?>" name="mem_hp" value="<?= set_value('mem_hp'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_kota" class="control-label col-sm-2"><?= lang('mem_city'); ?></label>
                                <div class="col-sm-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="<?= lang('mem_city'); ?>" name="mem_kota" value="<?= $member->mem_kota; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="<?= lang('mem_city'); ?>" name="mem_kota" value="<?= set_value('mem_kota'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_kode_pos" class="control-label col-sm-2"><?= lang('mem_postal_code'); ?></label>
                                <div class="col-sm-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="number" placeholder="<?= lang('mem_postal_code'); ?>" name="mem_kode_pos" value="<?= $member->mem_kode_pos; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="number" placeholder="<?= lang('mem_postal_code'); ?>" name="mem_kode_pos" value="<?= set_value('mem_kode_pos'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_email" class="control-label col-sm-2">email</label>
                                <div class="col-sm-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="email" name="mem_email" value="<?= $member->mem_email; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="email" name="mem_email" value="<?= set_value('mem_email'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <hr />
                            <div class="input-group mb-3 gap-3">
                                <label for="imageInputLogo" class="control-label col-sm-12 text-center"><?= lang('mem_kennel_photo'); ?></label>
                                <div class="col-sm-12 text-center">
                                    <?php 
                                        if (!$mode){ 
                                            if ($member->ken_photo && $member->ken_photo != '-'){
                                    ?>
                                        <img id="imgPreviewLogo" width="15%" src="<?= base_url().'uploads/kennels/'.$member->ken_photo ?>">
                                    <?php } else { ?>
                                        <img id="imgPreviewLogo" width="15%" src="<?= base_url().'assets/img/avatar.jpg' ?>">
                                    <?php } 
                                    } else { ?>
                                        <img id="imgPreviewLogo" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                    <?php } ?>
                                    <input type="file" class="upload" id="imageInputLogo" onclick="resetImage('logo')"/>
                                    <input type="hidden" name="attachment_logo" id="attachment_logo">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="ken_name" class="control-label col-sm-2"><?= lang('mem_kennel_name'); ?></label>
                                <div class="col-sm-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="<?= lang('mem_kennel_name'); ?>" name="ken_name" value="<?= $member->ken_name; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="<?= lang('mem_kennel_name'); ?>" name="ken_name" value="<?= set_value('ken_name'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_ktp" class="control-label col-sm-2"><?= lang('mem_kennel_format'); ?></label>
                                <?php
                                    foreach ($kennelType as $row) {
                                        $pil[$row->ken_type_id] = $row->ken_type_name;
                                    }
                                    if (!$mode)
                                        echo form_dropdown('ken_type_id', $pil, $member->ken_type_id, 'class="form-control", id="ken_type_id"');
                                    else
                                        echo form_dropdown('ken_type_id', $pil, set_value('ken_type_id'), 'class="form-control", id="ken_type_id"');
                                ?>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary" type="button" id="saveBtn"><?= lang('common_save'); ?></button>
                                <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>frontend/Requestmember'"><?= lang('common_back'); ?></button>
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
                                    <div class="col-sm-8">
                                        <img src="" id="sample_image" />
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="preview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="crop" class="btn btn-primary">Crop</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel-btn"><?= lang('common_cancel'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade text-dark" id="confirm-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Konfirmasi Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4"><?= lang('mem_id_card_number'); ?></div>
                                <div class="col">: <span id="confirm-ktp_number"></span></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><?= lang('mem_name'); ?></div>
                                <div class="col">: <span id="confirm-ktp_name"></span></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><?= lang('mem_mailing_address'); ?></div>
                                <div class="col">: <span id="confirm-mail_address"></span></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><?= lang('mem_certificate_address'); ?></div>
                                <div class="col">: <span id="confirm-certificate_address"></span></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><?= lang('mem_number'); ?></div>
                                <div class="col">: <span id="confirm-phone_number"></span></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><?= lang('mem_city'); ?></div>
                                <div class="col">: <span id="confirm-city"></span></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><?= lang('mem_postal_code'); ?></div>
                                <div class="col">: <span id="confirm-postal_code"></span></div>
                            </div>
                            <div class="row">
                                <div class="col-4">email</div>
                                <div class="col">: <span id="confirm-email"></span></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><?= lang('mem_kennel_photo'); ?></div>
                                <div class="col-auto pe-0">:</div>
                                <div class="col"><img id="confirm-foto" width="50%"/></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><?= lang('mem_kennel_name'); ?></div>
                                <div class="col">: <span id="confirm-kennel_name"></span></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><?= lang('mem_kennel_format'); ?></div>
                                <div class="col">: <span id="confirm-canine_name_format"></span></div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-primary" id="submitBtn"><?= lang('common_yes'); ?></button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= lang('common_no'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade text-dark" id="error-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?= lang('common_error_message'); ?></h5>
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
            <?php $this->load->view('frontend/layout/footer'); ?>
        </div>
    </main>
    <script src="<?= base_url(); ?>assets/js/cropper.min.js"></script>
    <script>
        const imageInputLogo = document.querySelector("#imageInputLogo");
        var croppingImage = null;

        var resetImage = function(input) {
            imageInputLogo.value = null;
        };

        $(document).ready(function(){
            var $modal = $('#modal');
            var previewLogo = document.getElementById('imgPreviewLogo');
            var modalImage = document.getElementById('sample_image');
            var cropper;

            imageInputLogo.addEventListener("change", function(event) {
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
                        previewLogo.src = base64data;
                        $('#attachment_logo').val(base64data);
                        $modal.modal('hide');
                    };
                });
            });

            $('#cancel-btn').click(function() {
                resetImage(croppingImage);
            });

            let saveBtn = $("#saveBtn");
            saveBtn.click(function(){
                $('#confirm-ktp_number').text($('input[name="mem_ktp"]').val());
                $('#confirm-ktp_name').text($('input[name="mem_name"]').val());
                $('#confirm-mail_address').text($('input[name="mem_mail_address"]').val());
                $('#confirm-certificate_address').text($('input[name="mem_address"]').val());
                $('#confirm-phone_number').text($('input[name="mem_hp"]').val());
                $('#confirm-city').text($('input[name="mem_kota"]').val());
                $('#confirm-postal_code').text($('input[name="mem_kode_pos"]').val());
                $('#confirm-email').text($('input[name="mem_email"]').val());
                $('#confirm-foto').attr("src",  $('#imgPreviewLogo').attr("src"));
                $('#confirm-kennel_name').text($('input[name="ken_name"]').val());
                $('#confirm-canine_name_format').text($('#ken_type_id option:selected').text());
                $('#confirm-modal').modal('show');
            });

            let submitBtn = $("#submitBtn");
            submitBtn.click(function(){
                submitBtn.prop('disabled', true);
                $('#mainForm').submit();
            });

            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>
</html>