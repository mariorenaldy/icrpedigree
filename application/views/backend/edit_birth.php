<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Edit Birth</title>
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
                    <h3 class="text-center text-primary">Edit Birth</h3>                         
                    <form id="formBirth" class="form-horizontal" action="<?= base_url(); ?>backend/Births/validate_edit" method="post" enctype="multipart/form-data">
                        <?php if (!$mode){ ?>
                            <input type="hidden" name="bir_id" value="<?= $birth->bir_id ?>" />
                        <?php } else { ?>
                            <input type="hidden" name="bir_id" value="<?= set_value('bir_id') ?>" />
                        <?php } ?>
                        <div class="input-group mb-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-md-12 text-center">Photo</label>
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
                            <label for="bir_male" class="control-label col-md-2">Male</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Jumlah Jantan" name="bir_male" value="<?= $birth->bir_male ?>">
                                <?php } else { ?>
                                    <input class="form-control" type="text" placeholder="Jumlah Jantan" name="bir_male" value="<?= set_value('bir_male'); ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="bir_female" class="control-label col-md-2">Female</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Jumlah Betina" name="bir_female" value="<?= $birth->bir_female ?>">
                                <?php } else { ?>
                                    <input class="form-control" type="text" placeholder="Jumlah Betina" name="bir_female" value="<?= set_value('bir_female'); ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="bir_date_of_birth" class="control-label col-md-2">Date of Birth</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Date of Birth" id="bir_date_of_birth" name="bir_date_of_birth" value="<?= $birth->bir_date_of_birth ?>" autocomplete="off">
                                <?php } else { ?>    
                                    <input class="form-control" type="text" placeholder="Date of Birth" id="bir_date_of_birth" name="bir_date_of_birth" value="<?= set_value('bir_date_of_birth'); ?>" autocomplete="off">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="hidden" id="mode" name="mode" value="<?= $mode ?>" />
                            <button id="buttonSubmit" class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>backend/Births'">Back</button>
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
                    window.location = '<?= base_url() ?>backend/Births';
                }
            <?php } ?>
        });
    </script>
</body>
</html>

