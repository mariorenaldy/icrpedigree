<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Add Puppy</title>
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
                    <h3 class="text-center text-primary">Add Puppy</h3>  
                    <form id="formCanine" class="form-horizontal" action="<?php echo base_url(); ?>backend/Stambums/validate_add" method="post" enctype="multipart/form-data">
                        <label class="checkbox-inline"><input type="checkbox" name="reg_member" value="1" <?php if (!$mode) echo 'checked'; else echo set_checkbox('reg_member', '1'); ?> /> Member</label>
                        <div class="input-group my-3">
                            <label class="control-label col-md-2">Member Name/Kennel</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" placeholder="Member Name/Kennel" id="mem_name" name="mem_name" value="<?php echo set_value('mem_name'); ?>">
                            </div>
                            <div class="col-md-1 text-end">
                                <button id="buttonSearch" class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Member</label>
                            <div class="col-md-10">
                                <?php
                                    $mem = [];
                                    foreach($member as $row){
                                        $mem[$row->mem_id] = $row->mem_name;
                                    }
                                    echo form_dropdown('stb_member_id', $mem, null, 'class="form-control", id="stb_member_id"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-5">
                            <label class="control-label col-md-2">Kennel</label>
                            <div class="col-md-10">
                                <?php
                                    $ken = [];
                                    foreach($kennel as $row){
                                        $ken[$row->ken_id] = $row->ken_name;
                                    }
                                    echo form_dropdown('stb_kennel_id', $ken, $kennel_id, 'class="form-control", id="stb_kennel_id"');
                                ?>
                            </div>
                        </div>
                        <hr/>
                        <div class="input-group mb-3">
                            <label for="mem_name" class="control-label col-md-2">Name</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Name" name="name" value="<?= set_value('name'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_hp" class="control-label col-md-2">Phone Number</label>
                            <div class="col-md-10">
                                <input class="form-control" type="number" placeholder="Phone Number" name="hp" value="<?= set_value('hp'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_email" class="control-label col-md-2">email</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="email" name="email" value="<?= set_value('email'); ?>">
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-2">Number of males born</div>
                            <div class="col-md-10">: <?= $birth->bir_male; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Number of females born</div>
                            <div class="col-md-10">: <?= $birth->bir_female; ?></div>
                        </div>
                        <div class="row">
                            <label for="stb_count" class="col-sm-2">Number of dogs to be registered</label>
                            <div class="col-md-10">
                                <input class="form-control" type="number" placeholder="Number of dogs to be registered" name="stb_count" id="stb_count" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
                            </div>
                        </div>
                        <div id="can-input-body">
                        </div>
                        <input type="hidden" id="stb_bir_id" name="stb_bir_id" value="<?php if (!$mode) echo $birth->bir_id; else echo set_value('stb_bir_id'); ?>"/>
                        <div class="text-center">
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
        <div class="modal fade text-dark" id="message-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Notification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-success">
                            <?php if ($this->session->flashdata('add_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Puppies has been saved</div>
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
        $('#buttonSearch').on("click", function(e){
            e.preventDefault();
            $('#formCanine').attr('action', "<?= base_url(); ?>backend/Stambums/search_member").submit();
        });

        $('#stb_member_id').on("change", function(){
            // $('#formCanine').attr('action', "<?= base_url(); ?>backend/Stambums/search_kennel").submit();
            let stb_member_id = $('#stb_member_id').val();
            $.ajax({
                url: "<?= base_url() ?>backend/Stambums/search_kennel",
                method: 'post',
                data: {stb_member_id: stb_member_id},
                success: function(response){
                    if(response){
                        let kenDropdown = $('#stb_kennel_id')
                        kenDropdown.empty();
                        
                        let result = JSON.parse(response);
                        let newOptions = [];
                        $.each(result, function(value, text) {
                            newOptions[text.ken_id] = text.ken_name;
                        });

                        $.each(newOptions, function(value, text) {
                            if(text !== undefined){
                                kenDropdown.append("<option value='"+value+"'>"+text+"</option>");
                            }
                        });
                    }
                    else{
                        $('#error-modal').modal('show');
                    }
                }
            });
        });

        $('#buttonSubmit').on("click", function(e){
            e.preventDefault();
            $('#formCanine').attr('action', "<?= base_url(); ?>backend/Stambums/validate_add").submit();
        });

        var croppingImage = null;
        var canNum = null;

        var resetImage = function() {
            $(this).val(null);
        };

        var stbCount;

        $("#stb_count").on("change", function(){
            $("#can-input-body").empty();
            var i = 1;
            <?php $i = 1; ?>
            count = parseInt($(this).val());
            stbCount = count+1;
            for (i = 1; i < stbCount; ++i) {
                $("#can-input-body").append(
                '<hr>'+
                '<p class="text-center">Dog #'+i+'</p>'+
                '<div class="input-group my-3 gap-3">'+
                    '<label class="control-label col-sm-12 text-center text-danger">Full Body Dog Photo</label>'+
                    '<div class="col-sm-12 text-center">'+
                        '<img id="imgPreview'+i+'" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">'+
                        '<input type="file" class="upload" canNum="'+i+'" id="imageInput'+i+'" accept="image/jpeg, image/png, image/jpg" onclick="resetImage()"/>'+
                        '<input type="hidden" name="attachment'+i+'" id="attachment'+i+'">'+
                    '</div>'+
                '</div>'+
                '<div class="input-group mb-3">'+
                    '<label class="control-label col-sm-2">Name</label>'+
                    '<div class="col-sm-10">'+
                        '<input class="form-control" type="text" placeholder="Name" name="stb_a_s'+i+'">'+
                    '</div>'+
                '</div>'+
                '<div class="input-group mb-3">'+
                    '<label class="control-label col-sm-2">Gender</label>'+
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
            }

            $("#can-input-body").append('<input type="hidden" name="count" id="count"/>');
            $("#count").val(count);
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
                    $modal.modal('hide');
                };
            });
        });

        $('#cancel-btn').click(function() {
            resetImage(croppingImage);
        });

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