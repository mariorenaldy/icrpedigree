<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?= lang("birth_edit"); ?></title>
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
            <h3 class="text-center text-warning"><?= lang("birth_edit"); ?></h3>                         
                <form id="mainForm" class="form-horizontal" action="<?= base_url(); ?>frontend/Requestupdatebirth/validate" method="post" enctype="multipart/form-data">
                    <?php if (!$mode){ ?>
                        <input type="hidden" name="bir_id" value="<?= $birth->bir_id ?>" />
                    <?php } else { ?>
                        <input type="hidden" name="bir_id" value="<?= set_value('bir_id') ?>" />
                    <?php } ?>
                    <div class="text-danger">
                        <?php		
                        if ($this->session->flashdata('error_message')){
                            echo $this->session->flashdata('error_message').'<br/>';
                        }
                        echo validation_errors();
                        ?>
                    </div>
                    <div class="input-group mb-3 gap-3">
                        <label for="stu_dam_id" class="control-label col-md-12 text-center"><?= lang("birth_photo_breastfed"); ?></label>
                        <div class="col-md-12 text-center">
                            <?php 
                                if (!$mode){ 
                                    if ($birth->bir_dam_photo && $birth->bir_dam_photo != '-'){
                            ?>
                                <img id="imgPreview" width="15%" src="<?= base_url().'uploads/births/'.$birth->bir_dam_photo ?>">
                            <?php } else { ?>
                                <img id="imgPreview" width="15%" src="<?= base_url().'assets/img/avatar.jpg' ?>">
                                <?php } 
                            } else { ?>
                                <img id="imgPreview" width="15%" src="<?= base_url().'assets/img/avatar.jpg' ?>">
                            <?php } ?>
                            <input type="file" class="upload" id="imageInput" accept="image/jpeg, image/png, image/jpg"  onclick="resetImage()"/>
                            <input type="hidden" name="attachment_dam" id="attachment">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="bir_male" class="control-label col-md-2"><?= lang("birth_living_males"); ?></label>
                        <div class="col-md-10">
                            <?php if (!$mode){ ?>
                                <input class="form-control" type="text" placeholder="<?= lang("birth_living_males"); ?>" name="bir_male" value="<?= $birth->bir_male ?>">
                            <?php } else { ?>
                                <input class="form-control" type="text" placeholder="<?= lang("birth_living_males"); ?>" name="bir_male" value="<?= set_value('bir_male'); ?>">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="bir_female" class="control-label col-md-2"><?= lang("birth_living_females"); ?></label>
                        <div class="col-md-10">
                            <?php if (!$mode){ ?>
                                <input class="form-control" type="text" placeholder="<?= lang("birth_living_females"); ?>" name="bir_female" value="<?= $birth->bir_female ?>">
                            <?php } else { ?>
                                <input class="form-control" type="text" placeholder="<?= lang("birth_living_females"); ?>" name="bir_female" value="<?= set_value('bir_female'); ?>">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="bir_date_of_birth" class="control-label col-md-2"><?= lang("common_dob"); ?></label>
                        <div class="col-md-10">
                            <?php if (!$mode){ ?>
                                <input class="form-control" type="text" placeholder="<?= lang("common_dob"); ?>" id="bir_date_of_birth" name="bir_date_of_birth" value="<?= $birth->bir_date_of_birth ?>" autocomplete="off">
                            <?php } else { ?>    
                                <input class="form-control" type="text" placeholder="<?= lang("common_dob"); ?>" id="bir_date_of_birth" name="bir_date_of_birth" value="<?= set_value('bir_date_of_birth'); ?>" autocomplete="off">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="button" id="saveBtn"><?= lang("common_save"); ?></button>
                        <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>frontend/Requestupdatebirth'"><?= lang("common_back"); ?></button>
                    </div>
                </form>
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
                            <div class="col-4"><?= lang("birth_photo_breastfed"); ?></div>
                            <div class="col-auto pe-0">:</div>
                            <div class="col"><img id="confirm-foto_dam" width="50%"/></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><?= lang("birth_living_males"); ?></div>
                            <div class="col">: <span id="confirm-jumlah_jantan"></span></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><?= lang("birth_living_females"); ?></div>
                            <div class="col">: <span id="confirm-jumlah_betina"></span></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><?= lang("common_dob"); ?></div>
                            <div class="col">: <span id="confirm-tanggal_lahir"></span></div>
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
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/cropper.min.js"></script>
    <script>
        function setDatePicker(id) {
            $(id).datepicker({ dateFormat: 'dd-mm-yy' });
            $(id).readOnly = true;
        }
        setDatePicker('#bir_date_of_birth');

        const imageInput = document.querySelector("#imageInput");
        var resetImage = function() {
            imageInput.value = null;
        };

        $(document).ready(function(){
            var $modal = $('#modal');
            var previewImg = document.getElementById('imgPreview');
            var modalImage = document.getElementById('sample_image');
            var latestImage = null;
            var cropper;

            imageInput.addEventListener("change", function(event) {
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
                        previewImg.src = base64data;
                        $('#attachment').val(base64data);
                        $modal.modal('hide');
                    };
                });
            });

            $('#cancel-btn').click(function() {
                resetImage();
            });

            let saveBtn = $("#saveBtn");
            saveBtn.click(function(){
                if ($('input[name="bir_male"]').val() == 0 && $('input[name="bir_female"]').val() == 0){
                    $('#error-col').html('Jumlah jantan & betina tidak boleh 0');
                    $('#error-row').show();
                    $('#error-modal').modal('show');
                }
                else{
                    $('#confirm-jumlah_jantan').text($('input[name="bir_male"]').val());
                    $('#confirm-jumlah_betina').text($('input[name="bir_female"]').val());
                    $('#confirm-foto_dam').attr("src",  $('#imgPreview').attr("src"));
                    $('#confirm-tanggal_lahir').text($('input[name="bir_date_of_birth"]').val());

                    $('#confirm-modal').modal('show');
                }
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

