<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Change PP</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
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
                    <h3 class="text-center text-primary">Change PP</h3>  
                    <form id="formCanine" class="form-horizontal" action="<?= base_url(); ?>backend/Users/validate_update_pp" method="post" enctype="multipart/form-data">
                        <div class="row mb-2">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-2">Username</div>
                            <div class="col-sm-4">: <?= $user->use_username ?></div>
                        </div>
                        <div class="input-group mt-3 mb-3 gap-3">
                            <div class="col-md-12 text-center">
                                <?php 
                                    if (!$mode){ 
                                        if ($user->use_photo && $user->use_photo != '-'){
                                ?>
                                    <img id="imgPreview" width="15%" src="<?= base_url().'uploads/users/'.$user->use_photo ?>">
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
                        <input type="hidden" name="use_id" value="<?= $user->use_id ?>" />
                        <div class="text-center">
                            <button id="buttonSubmit" class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>backend/Users'">Back</button>
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
                        previewImg.src = base64data;
                        $('#attachment').val(base64data);
                        $modal.modal('hide');
                    };
                });
            });

            $('#cancel-btn').click(function() {
                resetImage();
            });

            <?php		
                if ($this->session->flashdata('approve')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>

</html>