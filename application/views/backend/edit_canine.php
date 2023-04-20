<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Edit Canine</title>
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
                    <h3 class="text-center text-primary">Edit Canine</h3>  
                    <form id="formCanine" class="form-horizontal" action="<?= base_url(); ?>backend/Canines/validate_edit_canine" method="post" enctype="multipart/form-data">
                        <div class="input-group my-3">
                            <label class="control-label col-md-2">Member Name/Kennel</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" placeholder="Member Name/Kennel" name="mem_name" value="<?= set_value('mem_name'); ?>">
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
                                    if (!$mode)
                                        echo form_dropdown('can_member_id', $mem, $canine->can_member_id, 'class="form-control", id="can_member_id"');
                                    else
                                        echo form_dropdown('can_member_id', $mem, set_value('can_member_id'), 'class="form-control", id="can_member_id"');
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
                                    if (!$mode)
                                        echo form_dropdown('can_kennel_id', $ken, $canine->can_kennel_id, 'class="form-control"');
                                    else
                                        echo form_dropdown('can_kennel_id', $ken, set_value('can_kennel_id'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <hr/>
                        <div class="input-group mt-3 mb-3 gap-3">
                            <label class="control-label col-md-12 text-center">Canine Photo</label>
                            <div class="col-md-12 text-center">
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
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Name</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input type="hidden" name="can_id" value="<?= $canine->can_id ?>">
                                    <input class="form-control" type="text" placeholder="Name" name="can_a_s" value="<?= $canine->can_a_s ?>">
                                <?php } else { ?>
                                    <input type="hidden" name="can_id" value="<?= set_value('can_id'); ?>">
                                    <input class="form-control" type="text" placeholder="Name" name="can_a_s" value="<?= set_value('can_a_s'); ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Current Registration Number</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Current Registration Number" name="can_reg_number" value="<?= $canine->can_reg_number; ?>">
                                <?php } else { ?>
                                    <input class="form-control" type="text" placeholder="Current Registration Number" name="can_reg_number" value="<?= set_value('can_reg_number'); ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">ICR Number</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="ICR Number" name="can_icr_number" value="<?= $canine->can_icr_number; ?>">
                                <?php } else { ?>
                                    <input class="form-control" type="text" placeholder="ICR Number" name="can_icr_number" value="<?= set_value('can_icr_number'); ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Microchip Number</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Microchip Number" name="can_chip_number" value="<?= $canine->can_chip_number; ?>" maxlength="15" oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                <?php } else { ?>
                                    <input class="form-control" type="text" placeholder="Microchip Number" name="can_chip_number" value="<?= set_value('can_chip_number'); ?>" maxlength="15" oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Breed</label>
                            <div class="col-md-10">
                                <?php
                                foreach ($trah as $row) {
                                    $pil[$row->tra_name] = $row->tra_name;
                                }
                                if (!$mode)
                                    echo form_dropdown('can_breed', $pil, $canine->can_breed, 'class="form-control"');
                                else
                                    echo form_dropdown('can_breed', $pil, set_value('can_breed'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Gender</label>
                            <div class="col-md-10">
                                <?php
                                $gender['MALE'] = 'MALE';
                                $gender['FEMALE'] = 'FEMALE';
                                if (!$mode)
                                    echo form_dropdown('can_gender', $gender, $canine->can_gender, 'class="form-control"');
                                else
                                    echo form_dropdown('can_gender', $gender, set_value('can_gender'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Color</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Warna" name="can_color" value="<?= $canine->can_color; ?>">
                                <?php } else { ?>
                                    <input class="form-control" type="text" placeholder="Warna" name="can_color" value="<?= set_value('can_color'); ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Date of Birth</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Date of Birth" id="can_date_of_birth" name="can_date_of_birth" value="<?= $canine->can_date_of_birth; ?>" autocomplete="off">
                                <?php } else { ?>
                                    <input class="form-control" type="text" placeholder="Date of Birth" id="can_date_of_birth" name="can_date_of_birth" value="<?= set_value('can_date_of_birth'); ?>" autocomplete="off">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <label class="checkbox-inline"><input type="checkbox" name="can_rip" value="1" <?php if ($canine->can_rip) echo 'checked'; else echo set_checkbox('can_rip', '1'); ?> id="can_rip"/> RIP?</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="password" class="control-label col-md-2">Note </label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <textarea class="form-control" rows="10" name="can_note"><?= $canine->can_note ?></textarea>
                                <?php } else { ?>
                                    <textarea class="form-control" rows="10" name="can_note"><?= set_value('can_note') ?></textarea>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="text-center">
                            <button id="buttonSubmit" class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>backend/Canines'">Back</button>
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
            $(id).datepicker({
                dateFormat: 'dd-mm-yy'
            });
            $(id).readOnly = true;
        }
        setDatePicker('#can_date_of_birth');

        $('#buttonSearch').on("click", function(e){
            e.preventDefault();
            $('#formCanine').attr('action', "<?= base_url(); ?>backend/Canines/search_member_update").submit();
        });

        $('#can_member_id').on("change", function(){
            $('#formCanine').attr('action', "<?= base_url(); ?>backend/Canines/search_kennel_update").submit();
        });

        $('#buttonSubmit').on("click", function(e){
            e.preventDefault();
            $('#formCanine').attr('action', "<?= base_url(); ?>backend/Canines/validate_edit_canine").submit();
        });

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
        });
    </script>
</body>

</html>