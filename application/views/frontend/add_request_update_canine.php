<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Lapor Ubah Foto & RIP</title>
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
            <h3 class="text-center text-warning">Lapor Ubah Foto & RIP</h3>  
            <form id="formCanine" class="form-horizontal" action="<?= base_url(); ?>frontend/Requestupdatecanine/validate" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-2">Nama Anjing</div>
                    <div class="col-sm-4">: <?= $canine->can_a_s ?></div>
                </div>
                <div class="input-group mt-3 mb-3 gap-3">
                    <label class="control-label col-sm-12 text-center">Foto</label>
                    <div class="col-sm-12 text-center">
                        <?php 
                            if (!$mode){ 
                                if ($canine->can_photo && $canine->can_photo != '-'){
                        ?>
                            <img id="imgPreview" width="15%" src="<?= base_url().'uploads/canine/'.$canine->can_photo ?>">
                        <?php } else { ?>
                            <img id="imgPreview" width="15%" src="<?= base_url().'assets/img/avatar.jpg' ?>">
                        <?php } 
                        } else { ?>
                            <img id="imgPreview" width="15%" src="<?= base_url().'assets/img/avatar.jpg' ?>">
                        <?php } ?>
                        <input type="file" class="upload" id="imageInput" accept="image/jpeg, image/png, image/jpg" onclick="resetImage()"/>
                        <input type="hidden" name="attachment" id="attachment">
                    </div>
                </div>
                <div class="input-group">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <label class="checkbox-inline"><input type="checkbox" name="can_rip" value="1" <?php if ($canine->can_rip) echo 'checked'; else echo set_checkbox('can_rip', '1'); ?> id="can_rip"/> RIP?</label>
                        <input type="hidden" name="can_id" value="<?php if (!$mode) echo $canine->can_id; else echo set_value('can_id'); ?>">
                    </div>
                </div>
                <div class="text-center">
                    <button id="buttonSubmit" class="btn btn-primary" type="button">Save</button>
                    <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>frontend/Requestupdatecanine'">Back</button>
                </div>   
            </form>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel-btn">Batal</button>
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
                            <div class="col-4">Foto</div>
                            <div class="col-auto pe-0">:</div>
                            <div class="col"><img id="confirm-foto" width="50%"/></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">RIP?</div>
                            <div class="col">: <span id="confirm-rip"></span></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" id="submitBtn">Ya</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="error-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pesan Kesalahan</h5>
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
            $(id).datepicker({
                dateFormat: 'dd-mm-yy'
            });
            $(id).readOnly = true;
        }
        setDatePicker('#can_date_of_birth');

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

            let saveBtn = $("#buttonSubmit");
            saveBtn.click(function(){
                $('#confirm-foto').attr("src",  $('#imgPreview').attr("src"));
                rip = $( "input:checked" ).length;
                if (rip > 0)
                    $('#confirm-rip').text('Ya');
                else
                    $('#confirm-rip').text('Tidak');
                $('#confirm-modal').modal('show');
            });

            let submitBtn = $("#submitBtn");
            submitBtn.click(function(){
                submitBtn.prop('disabled', true);
                $('#formCanine').submit();
            });

            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>

</html>