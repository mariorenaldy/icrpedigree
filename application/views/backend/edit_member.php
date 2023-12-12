<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Edit Kennel</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/cropper.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/crop-modal-styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <main class="container">
        <?php $this->load->view('templates/header'); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-items-center">
                    <h3 class="text-center text-primary">Edit Kennel</h3> 
                    <form class="form-horizontal" action="<?= base_url(); ?>backend/Members/validate_edit" method="post" enctype="multipart/form-data">
                        <div class="input-group my-3">
                            <label for="imageInput" class="control-label col-md-2">Type</label>
                            <div class="col-md-10">
                            <?php
                                $type[$this->config->item('free_member')] = 'Free'; 
                                $type[$this->config->item('pro_member')] = 'Pro'; 
                                if (!$mode)
                                    echo form_dropdown('mem_type', $type, $member->mem_type, 'class="form-control", id="mem_type"');
                                else
                                    echo form_dropdown('mem_type', $type, set_value('mem_type'), 'class="form-control", id="mem_type"');
                            ?>
                            </div>
                        </div>
                        <div id="freeForm" <?php if ((!$mode && $member->mem_type == $this->config->item('pro_member')) || ($mode && set_value('mem_type') == $this->config->item('pro_member'))){ ?>style="display: none"<?php } ?>>
                            <div class="input-group mb-3">
                                <label for="mem_name" class="control-label col-md-2">Name</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="Name" name="name" value="<?= $member->mem_name; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="Name" name="name" value="<?= set_value('name'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_hp" class="control-label col-md-2">Phone Number</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="number" placeholder="Phone Number" name="hp" value="<?= $member->mem_hp; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="number" placeholder="Phone Number" name="hp" value="<?= set_value('hp'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_email" class="control-label col-md-2">email</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="email" name="email" value="<?= $member->mem_email; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="email" name="email" value="<?= set_value('email'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div id="proForm" <?php if ((!$mode && $member->mem_type == $this->config->item('free_member')) || ($mode && set_value('mem_type') == $this->config->item('free_member'))){ ?>style="display: none"<?php } ?>>
                            <div class="input-group mb-3">
                                <label for="mem_ktp" class="control-label col-md-2">KTP Number</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input type="hidden" name="mem_id" value="<?= $member->mem_id; ?>">
                                        <input type="hidden" name="ken_id" value="<?= $member->ken_id; ?>">
                                        <input class="form-control" type="number" placeholder="KTP Number" name="mem_ktp" value="<?= $member->mem_ktp; ?>">
                                    <?php } else { ?>
                                        <input type="hidden" name="mem_id" value="<?= set_value('mem_id'); ?>">
                                        <input type="hidden" name="ken_id" value="<?= set_value('ken_id'); ?>">
                                        <input class="form-control" type="number" placeholder="KTP Number" name="mem_ktp" value="<?= set_value('mem_ktp'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_name" class="control-label col-md-2">KTP Name</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="KTP Name" name="mem_name" value="<?= $member->mem_name; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="KTP Name" name="mem_name" value="<?= set_value('mem_name'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_mail_address" class="control-label col-md-2">Mail Address</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="Mail Address" name="mem_mail_address" value="<?= $member->mem_mail_address; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="Mail Address" name="mem_mail_address" value="<?= set_value('mem_mail_address'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_address" class="control-label col-md-2">Address</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="Address" name="mem_address" value="<?= $member->mem_address; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="Address" name="mem_address" value="<?= set_value('mem_address'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_hp" class="control-label col-md-2">Phone Number</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="number" placeholder="Phone Number" name="mem_hp" value="<?= $member->mem_hp; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="number" placeholder="Phone Number" name="mem_hp" value="<?= set_value('mem_hp'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label class="control-label col-sm-2">City/Regency</label>
                                <div class="col-sm-10">
                                    <select id="mem_kota_select" name="mem_kota_select" placeholder="City/Regency" class="form-control">
                                        <?= $cityOptions; ?>
                                    </select>
                                    <input type="hidden" name="mem_kota" id="mem_kota" value="<?= set_value('mem_kota'); ?>">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_kode_pos" class="control-label col-md-2">Postal Code</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="number" placeholder="Postal Code" name="mem_kode_pos" value="<?= $member->mem_kode_pos; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="number" placeholder="Postal Code" name="mem_kode_pos" value="<?= set_value('mem_kode_pos'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_email" class="control-label col-md-2">email</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="email" name="mem_email" value="<?= $member->mem_email; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="email" name="mem_email" value="<?= set_value('mem_email'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <hr />
                            <div class="input-group mb-3 gap-3">
                                <label for="imageInputPP" class="control-label col-md-12 text-center">PP</label>
                                <div class="col-md-12 text-center">
                                <?php 
                                    if (!$mode){ 
                                        if ($member->mem_pp && $member->mem_pp != '-'){
                                    ?>
                                        <img id="imgPreviewPP" width="15%" src="<?= base_url().'uploads/members/'.$member->mem_pp ?>">
                                    <?php } else { ?>
                                        <img id="imgPreviewPP" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                    <?php } 
                                    } else { ?>
                                        <img id="imgPreviewPP" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                    <?php } ?>
                                    <input type="file" class="upload" id="imageInputPP" onclick="resetImage('pp')"/>
                                    <input type="hidden" name="attachment_pp" id="attachment_pp">
                                </div>
                            </div>
                            <hr />
                            <div class="input-group mb-3 gap-3">
                                <label for="imageInputLogo" class="control-label col-md-12 text-center">Kennel Photo</label>
                                <div class="col-md-12 text-center">
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
                                <label for="ken_name" class="control-label col-md-2">Kennel Name</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="Nama Kennel" name="ken_name" value="<?= $member->ken_name; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="Nama Kennel" name="ken_name" value="<?= set_value('ken_name'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_ktp" class="control-label col-md-2">Canine Name Format</label>
                                <?php
                                    foreach ($kennelType as $row) {
                                        $pil[$row->ken_type_id] = $row->ken_type_name;
                                    }
                                    if (!$mode)
                                        echo form_dropdown('ken_type_id', $pil, $member->ken_type_id, 'class="form-control"');
                                    else
                                        echo form_dropdown('ken_type_id', $pil, set_value('ken_type_id'), 'class="form-control"');
                                ?>
                            </div>
                            <hr />
                            <div class="input-group mb-5 gap-3">
                                <label for="imageInputProof" class="control-label col-md-12 text-center">Payment Proof</label>
                                <div class="col-md-12 text-center">
                                    <?php 
                                        if (!$mode){ 
                                            if ($member->mem_pay_photo && $member->mem_pay_photo != '-'){
                                    ?>
                                        <img id="imgPreviewProof" width="15%" src="<?= base_url().'uploads/payment/'.$member->mem_pay_photo ?>">
                                    <?php } else { ?>
                                        <img id="imgPreviewProof" width="15%" src="<?= base_url().'assets/img/proof.jpg' ?>">
                                    <?php } 
                                    } else { ?>
                                        <img id="imgPreviewProof" width="15%" src="<?= base_url('assets/img/proof.jpg') ?>">
                                    <?php } ?>
                                    <input type="file" class="upload" id="imageInputProof" onclick="resetImage('proof')"/>
                                    <input type="hidden" name="attachment_proof" id="attachment_proof">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>backend/Members'">Back</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <script>
        $('#mem_type').on("change", function(){
            mem_type = $('#mem_type').val();
            if (mem_type == <?= $this->config->item('free_member') ?>){
                $('#proForm').hide();
                $('#freeForm').show();
            }
            else{
                $('#freeForm').hide();
                $('#proForm').show();   
            }
        });

        const imageInputPP = document.querySelector("#imageInputPP");
        const imageInputLogo = document.querySelector("#imageInputLogo");
        const imageInputProof = document.querySelector("#imageInputProof");
        var croppingImage = null;

        var resetImage = function(input) {
            if(input === "pp"){
                imageInputPP.value = null;
            }
            else if(input === "logo"){
                imageInputLogo.value = null;
            }
            else if(input === "proof"){
                imageInputProof.value = null;
            }
        };

        var cityValue;

        $(document).ready(function(){
            var $select = $('#mem_kota_select').selectize({
                sortField: 'text',
                onChange: function(value) {
                    cityValue = value;
                    $('#mem_kota').val(value);
                }
            });

            var selectize = $select[0].selectize;

            <?php if (!$mode){ ?>
                selectize.setValue("<?= $member->mem_kota; ?>");
            <?php } else { ?>
                selectize.setValue($('#mem_kota').val());
            <?php } ?>
            
            var $modal = $('#modal');
            var previewPP = document.getElementById('imgPreviewPP');
            var previewLogo = document.getElementById('imgPreviewLogo');
            var previewProof = document.getElementById('imgPreviewProof');
            var modalImage = document.getElementById('sample_image');
            var cropper;

            imageInputPP.addEventListener("change", function(event) {
                croppingImage = "pp";
                showModalImg(event);
            })

            imageInputLogo.addEventListener("change", function(event) {
                croppingImage = "logo";
                showModalImg(event);
            })

            imageInputProof.addEventListener("change", function(event) {
                croppingImage = "proof";
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
                        if(croppingImage === "pp"){
                            previewPP.src = base64data;
                            $('#attachment_pp').val(base64data);
                        }
                        else if(croppingImage === "logo"){
                            previewLogo.src = base64data;
                            $('#attachment_logo').val(base64data);
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

            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>
</html>