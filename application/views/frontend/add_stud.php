<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Lapor Pacak</title>
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
            <h3 class="text-center text-warning">Lapor Pacak</h3>
            <div class="row">            
                <div class="col-sm-12 align-items-center">                          
                    <form id="formStud" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="input-group my-3">
                            <label for="stu_sire_id" class="control-label col-sm-2">Sire</label>
                            <div class="col-sm-10">
                                <?php
                                    $i = 0;
                                    $pil = [];
                                    foreach($sire as $row){
                                        if ($sireStat[$i])
                                            $pil[$row->id] = $row->name;
                                        $i++;
                                    }
                                    echo form_dropdown('stu_sire_id', $pil, set_value('stu_sire_id'), 'class="form-control", id="stu_sire_id"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="can_a_s" class="control-label col-sm-2">Cari Dam</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" placeholder="Nama Dam" name="can_a_s" value="<?= set_value('can_a_s'); ?>">
                            </div>
                            <div class="col-sm-1 text-end">
                                <button id="buttonSearch" class="btn btn-warning" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="stu_dam_id" class="control-label col-sm-2">Nama Dam</label>
                            <div class="col-sm-10">
                                <?php
                                    $i = 0;
                                    $opt = [];
                                    foreach($dam as $row){
                                        if ($damStat[$i])
                                            $opt[$row->id] = $row->name;
                                        $i++;
                                    }
                                    echo form_dropdown('stu_dam_id', $opt, set_value('stu_dam_id'), 'class="form-control", id="stu_dam_id"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-sm-12 text-center">Foto Pacak</label>
                            <div class="col-sm-12 text-center">
                                <img id="imgPreview" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" id="imageInput" accept="image/jpeg, image/png, image/jpg" onclick="resetImage('stud')"/>
                                <input type="hidden" name="attachment_stud" id="attachment_stud">
                            </div>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-sm-12 text-center">Foto Sire</label>
                            <div class="col-sm-12 text-center">
                                <img id="imgPreviewSire" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" id="imageInputSire" accept="image/jpeg, image/png, image/jpg" onclick="resetImage('sire')"/>
                                <input type="hidden" name="attachment_sire" id="attachment_sire">
                            </div>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-sm-12 text-center">Foto Dam</label>
                            <div class="col-sm-12 text-center">
                                <img id="imgPreviewDam" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" id="imageInputDam" accept="image/jpeg, image/png, image/jpg" onclick="resetImage('dam')"/>
                                <input type="hidden" name="attachment_dam" id="attachment_dam">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="stu_stud_date" class="control-label col-sm-2">Tanggal Pacak</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Tanggal Pacak" id="stu_stud_date" name="stu_stud_date" value="<?= set_value('stu_stud_date'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="text-center">
                            <button id="buttonSubmit" class="btn btn-primary" type="button">Simpan</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>frontend/Studs'">Kembali</button>
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
        <div class="modal fade text-dark" id="confirm-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">Sire</div>
                            <div class="col">: <span id="confirm-sire"></span></div>
                        </div>
                        <div class="row">
                            <div class="col-4">Dam</div>
                            <div class="col">: <span id="confirm-dam"></span></div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4">Foto Pacak</div>
                            <div class="col-auto pe-0">:</div>
                            <div class="col"><img id="confirm-foto_pacak" width="50%"/></div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4">Foto Sire</div>
                            <div class="col-auto pe-0">:</div>
                            <div class="col"><img id="confirm-foto_sire" width="50%"/></div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4">Foto Dam</div>
                            <div class="col-auto pe-0">:</div>
                            <div class="col"><img id="confirm-foto_dam" width="50%"/></div>
                        </div>
                        <div class="row">
                            <div class="col-4">Tanggal Pacak</div>
                            <div class="col">: <span id="confirm-tanggal_pacak"></span></div>
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
            $(id).datepicker({ dateFormat: 'dd-mm-yy' });
            $(id).readOnly = true;
        }
        setDatePicker('#stu_stud_date');

        $('#buttonSearch').on("click", function(e){
            e.preventDefault();
            $('#formStud').attr('action', "<?= base_url(); ?>frontend/Studs/search_dam").submit();
        });

        const imageInput = document.querySelector("#imageInput");
        const imageInputSire = document.querySelector("#imageInputSire");
        const imageInputDam = document.querySelector("#imageInputDam");
        var croppingImage = null;

        var resetImage = function(input) {
            if(input === "stud"){
                imageInput.value = null;
            }
            else if(input === "sire"){
                imageInputSire.value = null;
            }
            else if(input === "dam"){
                imageInputDam.value = null;
            }
        };

        $(document).ready(function(){
            var $modal = $('#modal');
            var previewStud = document.getElementById('imgPreview');
            var previewSire = document.getElementById('imgPreviewSire');
            var previewDam = document.getElementById('imgPreviewDam');
            var modalImage = document.getElementById('sample_image');
            var latestImage = null;
            var cropper;

            imageInput.addEventListener("change", function(event) {
                croppingImage = "stud";
                showModalImg(event);
            })

            imageInputSire.addEventListener("change", function(event) {
                croppingImage = "sire";
                showModalImg(event);
            })

            imageInputDam.addEventListener("change", function(event) {
                croppingImage = "dam";
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
                        if(croppingImage === "stud"){
                            previewStud.src = base64data;
                            $('#attachment_stud').val(base64data);
                        }
                        else if(croppingImage === "sire"){
                            previewSire.src = base64data;
                            $('#attachment_sire').val(base64data);
                        }
                        else if(croppingImage === "dam"){
                            previewDam.src = base64data;
                            $('#attachment_dam').val(base64data);
                        }
                        $modal.modal('hide');
                    };
                });
            });

            $('#cancel-btn').click(function() {
                resetImage(croppingImage);
            });

            let saveBtn = $("#buttonSubmit");
            saveBtn.click(function(){
                $('#confirm-sire').text($('#stu_sire_id option:selected').text());
                $('#confirm-dam').text($('#stu_dam_id option:selected').text());
                $('#confirm-foto_pacak').attr("src",  $('#imgPreview').attr("src"));
                $('#confirm-foto_sire').attr("src",  $('#imgPreviewSire').attr("src"));
                $('#confirm-foto_dam').attr("src",  $('#imgPreviewDam').attr("src"));
                $('#confirm-tanggal_pacak').text($('input[name="stu_stud_date"]').val());

                $('#confirm-modal').modal('show');
            });

            let submitBtn = $("#submitBtn");
            submitBtn.click(function(){
                submitBtn.prop('disabled', true);
                $('#formStud').attr('action', "<?= base_url(); ?>frontend/Studs/validate_add").submit();
            });

            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>
</html>

