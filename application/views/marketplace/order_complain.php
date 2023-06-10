<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title><?= lang("ord_complain"); ?></title>
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
            <h3 class="text-center text-warning"><?= lang("ord_complain"); ?></h3>
            <div class="row">            
                <div class="col-sm-12 align-items-center">                          
                    <form id="mainForm" class="form-horizontal" action="<?= base_url(); ?>marketplace/Orders/validate_complain" method="post" enctype="multipart/form-data">
                    <div class="mb-1">
                            <?php if (!$mode){ ?>
                                <input type="hidden" name="ord_id" value="<?= $order->ord_id ?>">
                            <?php } else { ?>
                                <input type="hidden" name="ord_id" value="<?= set_value('ord_id'); ?>">
                            <?php } ?>
                            <span class="d-inline-block" style="width: 200px;">Invoice</span>
                            <span><?= $order->ord_invoice ?></span>
                        </div>
                        <div class="mb-1">
                            <span class="d-inline-block" style="width: 200px;">Date</span>
                            <span><?= $order->ord_created_at ?></span>
                        </div>
                        <div class="mb-1">
                            <span class="d-inline-block" style="width: 200px;">Payment Date</span>
                            <span><?= $order->ord_pay_date ?></span>
                        </div>
                        <div class="mb-1">
                            <span class="d-inline-block" style="width: 200px;">Product's Name</span>
                            <span><?= $order->pro_name ?></span>
                        </div>
                        <div class="mb-1">
                            <span class="d-inline-block" style="width: 200px;">Quantity</span>
                            <span><?= $order->ord_quantity ?></span>
                        </div>
                        <div class="mb-1">
                            <span class="d-inline-block" style="width: 200px;">Total Price</span>
                            <span><?= $order->ord_total_price ?></span>
                        </div>
                        <div class="input-group mt-3 mb-3 gap-3">
                            <label class="control-label col-md-12 text-center"><?= lang("ord_complain_photo_if"); ?></label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreview" width="15%" src="<?= base_url('assets/img/proof.jpg') ?>">
                                <input type="file" class="upload" id="imageInput" accept="image/jpeg, image/png, image/jpg" onclick="resetImage()"/>
                                <input type="hidden" name="attachment" id="attachment">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="com_desc" class="d-inline-block" style="width: 200px;"><?= lang("ord_complain_desc"); ?></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" placeholder="<?= lang("ord_complain_desc"); ?>" name="com_desc" value="<?= set_value('com_desc'); ?>" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="button" id="saveBtn"><?= lang("common_save"); ?></button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>marketplace/Orders'"><?= lang("common_back"); ?></button>
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
                            <div class="col-4"><?= lang("ord_complain_photo"); ?></div>
                            <div class="col-auto pe-0">:</div>
                            <div class="col"><img id="confirm-foto" width="50%"/></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><?= lang("ord_complain_desc"); ?></div>
                            <div class="col">: <span id="confirm-deskripsi"></span></div>
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
        const imageInput = document.querySelector("#imageInput");
        var resetImage = function() {
            imageInput.value = null;
        };

        $(document).ready(function(){
            var $modal = $('#modal');
            var image = document.getElementById('imgPreview');
            var modalImage = document.getElementById('sample_image');
            var latestImage = null;
            var cropper;

            imageInput.addEventListener("change", function(event) {

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
            })

            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(modalImage, {
                    aspectRatio: <?= $this->config->item('img_height_ratio') ?>/<?= $this->config->item('img_height_ratio') ?>,
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
                        image.src = base64data;
                        latestImage = base64data;
                        $('#attachment').val(latestImage);
                        $modal.modal('hide');
                    };
                });
            });

            $('#cancel-btn').click(function(event) {
                resetImage();
            });

            let saveBtn = $("#saveBtn");
            saveBtn.click(function(){
                $('#confirm-foto').attr("src",  $('#imgPreview').attr("src"));
                $('#confirm-deskripsi').text($('textarea[name="com_desc"]').val());

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

