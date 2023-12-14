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
            <h3 class="text-center text-warning mb-5"><?= lang("can_add_puppy"); ?></h3>
            <div class="row">
                <div class="col-sm-3"><?= lang("can_num_males_born"); ?></div>
                <div class="col">: <?= $birth->bir_male; ?></div>
            </div>
            <div class="row">
                <div class="col-sm-3"><?= lang("can_num_females_born"); ?></div>
                <div class="col">: <?= $birth->bir_female; ?></div>
            </div>
            <div class="row">
                <label for="stb_count" class="col-sm-3"><?= lang("can_num_dogs_register"); ?></label>
                <div class="col-sm-9">
                    <input class="form-control" type="number" placeholder="<?= lang("can_num_dogs_register"); ?>" name="stb_count" value="<?= set_value('stb_count'); ?>" id="stb_count" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
                </div>
            </div>
            <div class="row">            
                <div class="col-sm-12 align-items-center">                          
                    <form id="formCanine" class="form-horizontal mt-3" action="<?= base_url(); ?>frontend/Stambums/validate_add" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="stb_bir_id" value="<?php if (!$mode) echo $birth->bir_id; else echo set_value('stb_bir_id'); ?>"/>
                        <input type="hidden" name="count" id="count"/>
                    </form>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary" type="button" id="saveBtn"><?= lang("common_save"); ?></button>
                <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>frontend/Births/view_approved'"><?= lang("common_back"); ?></button>
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
                    <div class="modal-body" id="confirm-body">
                        <div class="row">
                            <div class="col-4"><?= lang("can_num_dogs"); ?></div>
                            <div class="col">: 0</div>
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
        var croppingImage = null;
        var canNum = null;

        var resetImage = function() {
            $(this).val(null);
        };

        var previewProof;

        var stbCount;

        $("#stb_count").on("change", function(){
            $("#formCanine").empty();
            $("#confirm-body").empty();
            var i = 1;
            <?php $i = 1; ?>
            count = parseInt($(this).val());
            stbCount = count+1;
            if(count > 0){
                $("#confirm-body").append(
                '<div class="row">'+
                    '<div class="col-4"><?= lang("can_num_dogs"); ?></div>'+
                    '<div class="col">: '+count+'</div>'+
                '</div>'
                );
            }
            else{
                $("#confirm-body").append(
                '<div class="row">'+
                    '<div class="col-4"><?= lang("can_num_dogs"); ?></div>'+
                    '<div class="col">: 0</div>'+
                '</div>'
                );
            }
            for (i = 1; i < stbCount; ++i) {
                $("#formCanine").append(
                '<hr>'+
                '<p class="text-center"><?= lang("can_dog"); ?> #'+i+'</p>'+
                '<div class="input-group my-3 gap-3">'+
                    '<label class="control-label col-sm-12 text-center text-danger"><?= lang("can_full_body"); ?></label>'+
                    '<div class="col-sm-12 text-center">'+
                        '<img id="imgPreview'+i+'" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">'+
                        '<input type="file" class="upload" canNum="'+i+'" id="imageInput'+i+'" accept="image/jpeg, image/png, image/jpg" onclick="resetImage()"/>'+
                        '<input type="hidden" name="attachment'+i+'" id="attachment'+i+'">'+
                    '</div>'+
                '</div>'+
                '<div class="input-group mb-3">'+
                    '<label class="control-label col-sm-2"><?= lang("can_name"); ?></label>'+
                    '<div class="col-sm-10">'+
                        '<input class="form-control" type="text" placeholder="<?= lang("can_name"); ?>" name="stb_a_s'+i+'">'+
                    '</div>'+
                '</div>'+
                '<div class="input-group mb-3">'+
                    '<label class="control-label col-sm-2"><?= lang("can_gender"); ?></label>'+
                    '<div class="col-sm-10">'+
                        '<select class="form-control" name="stb_gender'+i+'" id="stb_gender'+i+'" value="<?= set_value('stb_gender'.$i) ?>">'+
                            '<option value="MALE">MALE</option>'+
                            '<option value="FEMALE">FEMALE</option>'+
                        '</select>'+
                    '</div>'+
                '</div>'
                <?php $i++; ?>
                );

                $("#imageInput"+i).on("change", function(){
                    croppingImage = "canine";
                    canNum = event.target.getAttribute("canNum");
                    ratio = <?= $this->config->item('img_width_ratio') ?>/<?= $this->config->item('img_height_ratio') ?>;
                    showModalImg(event);
                });

                $("#confirm-body").append(
                '<hr style="background-color: red; height: 1px; border: 0;">'+
                '<div class="row">'+
                    '<div class="col-4"><?= lang("can_dog"); ?> #'+i+'</div>'+
                '</div>'+
                '<div class="row">'+
                    '<div class="col-4"><?= lang("can_can_photo"); ?></div>'+
                    '<div class="col-auto pe-0">:</div>'+
                    '<div class="col"><img id="confirm-foto'+i+'" width="50%"/></div>'+
                '</div>'+
                '<div class="row">'+
                    '<div class="col-4"><?= lang("can_name"); ?></div>'+
                    '<div class="col">: <span id="confirm-nama'+i+'"></span></div>'+
                '</div>'+
                '<div class="row">'+
                    '<div class="col-4"><?= lang("can_gender"); ?></div>'+
                    '<div class="col">: <span id="confirm-jenis_kelamin'+i+'"></span></div>'+
                '</div>'
                );
            }

            $("#formCanine").append('<input type="hidden" name="stb_bir_id" value="<?php if (!$mode) echo $birth->bir_id; else echo set_value('stb_bir_id'); ?>"/>');
            $("#formCanine").append('<input type="hidden" name="count" id="count"/>');
            $("#count").val(count);
            var price = (150000 * count).toLocaleString('id-ID');
            if(stbCount > 1){
                $("#formCanine").append(
                '<hr>'+
                '<div class="input-group mb-3">'+
                    '<label for="payment_method" class="control-label col-sm-2"><?= lang("common_payment_method"); ?></label>'+
                    '<div class="col-sm-10">'+
                        '<div class="form-check">'+
                            '<input class="form-check-input" type="radio" name="payment_method" id="upload-proof" value="upload-proof" typeText="Manual Transfer">'+
                            '<label class="form-check-label" for="upload-proof"><?= lang("common_upload_proof"); ?><br>BCA: XXXXXXXXXX<br>Rp. '+price+'</label>'+
                        '</div>'+
                        '<div class="form-check">'+
                            '<input class="form-check-input" type="radio" name="payment_method" id="doku" value="doku" typeText="DOKU">'+
                            '<label class="form-check-label" for="doku">Payment Gateway DOKU</label>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="input-proof input-group my-3 gap-3 mt-5 mb-5">'+
                    '<label class="control-label col-sm-12 text-center"><?= lang("common_photo_proof"); ?></label>'+
                    '<div class="col-sm-12 text-center">'+
                        '<img id="imgPreviewProof" width="15%" src="<?= base_url('assets/img/proof.jpg') ?>">'+
                        '<input type="file" class="upload" id="imageInputProof" accept="image/jpeg, image/png, image/jpg" onclick="resetImage()"/>'+
                        '<input type="hidden" name="attachment_proof" id="attachment_proof">'+
                    '</div>'+
                '</div>'
                );

                $("#confirm-body").append(
                '<hr style="background-color: red; height: 1px; border: 0;">'+
                '<div class="row">'+
                    '<div class="col-4"><?= lang("common_payment_method"); ?></div>'+
                    '<div class="col">: <span id="confirm-payment_method"></span></div>'+
                '</div>'+
                '<div class="row input-proof">'+
                    '<div class="col-4"><?= lang("common_photo_proof"); ?></div>'+
                    '<div class="col-auto pe-0">:</div>'+
                    '<div class="col"><img id="confirm-proof" width="50%"/></div>'+
                '</div>'
                );
            }

            const imageInputProof = document.querySelector("#imageInputProof");
            previewProof = document.getElementById('imgPreviewProof');

            imageInputProof.addEventListener("change", function(event) {
                croppingImage = "proof";
                ratio = <?= $this->config->item('img_height_ratio') ?>/<?= $this->config->item('img_height_ratio') ?>;
                showModalImg(event);
            })

            $('.input-proof').hide();

            $('input[type=radio][name=payment_method]').change(function() {
                if (this.value == 'upload-proof') {
                    $('.input-proof').show();
                }
                else if (this.value == 'doku') {
                    $('.input-proof').hide();
                }
            });
        });

        var maxCount = <?= $birth->bir_male + $birth->bir_female; ?>

        $('#stb_count').on("input", function() {
            var stb_count = parseInt($('#stb_count').val());
            
            if (stb_count < 0 ) {
                $('#stb_count').val(0);
            }
            else if(stb_count > maxCount){
                $('#stb_count').val(maxCount);
            }
        });

        let submitBtn = $("#submitBtn");
        submitBtn.click(function(){
            submitBtn.prop('disabled', true);
            $('#formCanine').submit();
        });

        let saveBtn = $("#saveBtn");
        saveBtn.click(function(){
            if(stbCount < 2){

            }
            else{
                var j = 1;
                for (j = 1; j < stbCount; ++j) {
                    $('#confirm-foto'+j).attr("src",  $('#imgPreview'+j).attr("src"));
                    var stb_name = 'stb_a_s'+j
                    $('#confirm-nama'+j).text($('input[name="'+stb_name+'"]').val());
                    $('#confirm-jenis_kelamin'+j).text($('#stb_gender'+j+' option:selected').text());
                }
                $('#confirm-payment_method').text($('input[name=payment_method]:checked').attr("typeText"));
                $('#confirm-proof').attr("src",  $('#imgPreviewProof').attr("src"));
            }
            $('#confirm-modal').modal('show');
        });

        var $modal = $('#modal');
        var modalImage = document.getElementById('sample_image');
        var latestImage = null;
        var cropper;
        var ratio = <?= $this->config->item('img_width_ratio') ?>/<?= $this->config->item('img_height_ratio') ?>;

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
                        $('#imgPreview'+canNum).attr("src",base64data);
                        $('#attachment'+canNum).val(base64data);
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

        $(document).ready(function(){
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

