<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Tambah Canine Generasi Pertama</title>
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
            <h3 class="text-center text-warning">Tambah Canine Generasi Pertama</h3>
            <div class="row">            
                <div class="col-sm-12 align-items-center">                          
                    <form id="mainForm" class="form-horizontal" action="<?= base_url(); ?>frontend/Canines/validate_add" method="post" enctype="multipart/form-data">
                        <div class="text-danger">
                            <?php		
                            if ($this->session->flashdata('error_message')){
                                echo $this->session->flashdata('error_message').'<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <div class="input-group my-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-sm-12 text-center">Foto Canine</label>
                            <div class="col-sm-12 text-center">
                                <img id="imgPreview" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" id="imageInput" accept="image/jpeg, image/png, image/jpg" onclick="resetImage()"/>
                                <input type="hidden" name="attachment" id="attachment">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_name" class="control-label col-sm-2">Nama</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Nama" name="can_a_s" value="<?= set_value('can_a_s'); ?>">
                            </div>
                        </div>
                        <!-- <div class="input-group mb-3">
                            <label for="mem_address" class="control-label col-sm-2">No. Registrasi</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="No. Registrasi" name="can_reg_number" value="<?= set_value('can_reg_number'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-sm-2">No. ICR</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="No. ICR" name="can_icr_number" value="<?php echo set_value('can_icr_number'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-sm-2">No. Microchip</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="No. Microchip" name="can_chip_number" value="<?php echo set_value('can_chip_number'); ?>">
                            </div>
                        </div> -->
                        <div class="input-group mb-3">
                            <label for="mem_hp" class="control-label col-sm-2">Trah</label>
                            <div class="col-sm-10">
                                <?php
                                    foreach($trah as $row){
                                        $pil[$row->tra_name] = $row->tra_name;
                                    }
                                    echo form_dropdown('can_breed', $pil, set_value('can_breed'), 'class="form-control", id="can_breed"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_hp" class="control-label col-sm-2">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <?php
                                    $gender['MALE'] = 'MALE';
                                    $gender['FEMALE'] = 'FEMALE';
                                    echo form_dropdown('can_gender', $gender, set_value('can_gender'), 'class="form-control", id="can_gender"');
                                ?>
                            </div>
                        </div>
                        <!-- <div class="input-group mb-3">
                            <label for="mem_mail_address" class="control-label col-sm-2">Warna</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Warna" name="can_color" value="<?= set_value('can_color'); ?>">
                            </div>
                        </div> -->
                        <div class="input-group mb-3">
                            <label for="mem_mail_address" class="control-label col-sm-2">Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Tanggal Lahir" id="can_date_of_birth" name="can_date_of_birth" value="<?= set_value('can_date_of_birth'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_hp" class="control-label col-sm-2">Kennel</label>
                            <div class="col-sm-10">
                                <?php
                                    $ken = [];
                                    foreach($kennel as $row){
                                        $ken[$row->ken_id] = $row->ken_name;
                                    }
                                    echo form_dropdown('can_kennel_id', $ken, set_value('can_kennel_id'), 'class="form-control", id="can_kennel_id"');
                                ?>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="button" id="saveBtn">Simpan</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>frontend/Canines'">Kembali</button>
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
                        <div class="col-4">Foto Canine</div>
                        <div class="col-auto pe-0">:</div>
                        <div class="col"><img id="confirm-foto" width="50%"/></div>
                    </div>
                    <div class="row">
                        <div class="col-4">Nama</div>
                        <div class="col">: <span id="confirm-nama"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-4">Trah</div>
                        <div class="col">: <span id="confirm-trah"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-4">Jenis Kelamin</div>
                        <div class="col">: <span id="confirm-jenis_kelamin"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-4">Tanggal Lahir</div>
                        <div class="col">: <span id="confirm-tanggal_lahir"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-4">Kennel</div>
                        <div class="col">: <span id="confirm-kennel"></span></div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" id="submitBtn">Ya</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
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
        setDatePicker('#can_date_of_birth');

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
                $('#confirm-nama').text($('input[name="can_a_s"]').val());
                $('#confirm-trah').text($('#can_breed option:selected').text());
                $('#confirm-jenis_kelamin').text($('#can_gender option:selected').text());
                $('#confirm-tanggal_lahir').text($('input[name="can_date_of_birth"]').val());
                $('#confirm-kennel').text($('#can_kennel_id option:selected').text());

                $('#confirm-modal').modal('show');
            });

            let submitBtn = $("#submitBtn");
            submitBtn.click(function(){
                submitBtn.prop('disabled', true);
                $('#mainForm').submit();
            });

        });
    </script>
</body>
</html>

