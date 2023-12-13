<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title><?= lang("can_add"); ?></title>
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
            <h3 class="text-center text-warning"><?= lang("can_add"); ?></h3>
            <div class="row">            
                <div class="col-sm-12 align-items-center">                          
                    <form id="mainForm" class="form-horizontal" action="<?= base_url(); ?>frontend/Canines/validate_add" method="post" enctype="multipart/form-data">
                        <div class="input-group my-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-sm-12 text-center text-danger"><b><?= lang("can_full_body"); ?></b></label>
                            <div class="col-sm-12 text-center">
                                <img id="imgPreview" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" id="imageInput" accept="image/jpeg, image/png, image/jpg" onclick="resetImage('canine')"/>
                                <input type="hidden" name="attachment" id="attachment">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="can_name" class="control-label col-sm-2"><?= lang("can_name"); ?></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="<?= lang('can_name'); ?>" name="can_a_s" value="<?= set_value('can_a_s'); ?>" maxlength="30">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="can_breed" class="control-label col-sm-2"><?= lang("can_breed"); ?></label>
                            <div class="col-sm-10">
                                <?php
                                    $pil = [];
                                    foreach($trah as $row){
                                        $pil[$row->tra_name] = $row->tra_name;
                                    }
                                    echo form_dropdown('can_breed', $pil, set_value('can_breed'), 'class="form-control", id="can_breed"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="can_gender" class="control-label col-sm-2"><?= lang("can_gender"); ?></label>
                            <div class="col-sm-10">
                                <?php
                                    $gender['MALE'] = 'MALE';
                                    $gender['FEMALE'] = 'FEMALE';
                                    echo form_dropdown('can_gender', $gender, set_value('can_gender'), 'class="form-control", id="can_gender"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="can_date_of_birth" class="control-label col-sm-2"><?= lang("can_dob"); ?></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="<?= lang('can_dob'); ?>" name="can_date_of_birth" id="can_date_of_birth" value="<?= set_value('can_date_of_birth'); ?>" readonly>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="can_kennel_id" class="control-label col-sm-2">Kennel</label>
                            <div class="col-sm-10">
                                <?php
                                    $ken = [];
                                    foreach($kennel as $row){
                                        $ken[$row->ken_id] = $row->ken_name;
                                    }
                                    echo form_dropdown('can_kennel_id', $ken, set_value('can_kennel_id'), 'class="form-control", id="can_kennel_id"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="payment_method" class="control-label col-sm-2"><?= lang("common_payment_method"); ?></label>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="upload-proof" value="upload-proof" typeText="Manual Transfer">
                                    <label class="form-check-label" for="upload-proof">
                                        <?= lang("common_upload_proof"); ?>
                                        <br>BCA: XXXXXXXXXX<br>Rp. 150.000
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="doku" value="doku" typeText="DOKU">
                                    <label class="form-check-label" for="doku">
                                        Payment Gateway DOKU
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="input-proof input-group my-3 gap-3 mt-5 mb-5">
                            <label for="stu_dam_id" class="control-label col-sm-12 text-center"><?= lang("common_photo_proof"); ?></label>
                            <div class="col-sm-12 text-center">
                                <img id="imgPreviewProof" width="15%" src="<?= base_url('assets/img/proof.jpg') ?>">
                                <input type="file" class="upload" id="imageInputProof" accept="image/jpeg, image/png, image/jpg" onclick="resetImage('proof')"/>
                                <input type="hidden" name="attachment_proof" id="attachment_proof">
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="button" id="saveBtn"><?= lang("common_save"); ?></button>
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
                        <div class="row">
                            <div class="col-4"><?= lang("can_full_body"); ?></div>
                            <div class="col-auto pe-0">:</div>
                            <div class="col"><img id="confirm-foto" width="50%"/></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><?= lang("common_name"); ?></div>
                            <div class="col">: <span id="confirm-nama"></span></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><?= lang("can_breed"); ?></div>
                            <div class="col">: <span id="confirm-trah"></span></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><?= lang("can_gender"); ?></div>
                            <div class="col">: <span id="confirm-jenis_kelamin"></span></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><?= lang("common_dob"); ?></div>
                            <div class="col">: <span id="confirm-tanggal_lahir"></span></div>
                        </div>
                        <div class="row">
                            <div class="col-4">Kennel</div>
                            <div class="col">: <span id="confirm-kennel"></span></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><?= lang("common_payment_method"); ?></div>
                            <div class="col">: <span id="confirm-payment_method"></span></div>
                        </div>
                        <div class="row input-proof">
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
        function setDatePicker(id) {
            $(id).datepicker({ dateFormat: 'dd-mm-yy' });
            $(id).readOnly = true;
        }
        setDatePicker('#can_date_of_birth');

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
        
        $('input[type=radio][name=payment_method]').change(function() {
            if (this.value == 'upload-proof') {
                $('.input-proof').show();
            }
            else if (this.value == 'doku') {
                $('.input-proof').hide();
            }
        });

        $(document).ready(function(){
            $('.input-proof').hide();

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
                $('#confirm-nama').text($('input[name="can_a_s"]').val());
                $('#confirm-trah').text($('#can_breed option:selected').text());
                $('#confirm-jenis_kelamin').text($('#can_gender option:selected').text());
                $('#confirm-tanggal_lahir').text($('input[name="can_date_of_birth"]').val());
                $('#confirm-kennel').text($('#can_kennel_id option:selected').text());
                $('#confirm-payment_method').text($('input[name=payment_method]:checked').attr("typeText"));
                $('#confirm-proof').attr("src",  $('#imgPreviewProof').attr("src"));

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

