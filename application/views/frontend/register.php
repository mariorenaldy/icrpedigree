<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Register</title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link href="<?= base_url(); ?>assets/css/cropper.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/crop-modal-styles.css" rel="stylesheet" />
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <div class="container">
            <h2 class="text-center text-warning">Register</h2>
            <div class="row">            
                <div class="col-sm-12 align-items-center">                          
                    <form id="mainForm" class="form-horizontal" action="<?php echo base_url(); ?>frontend/Members/validate_register" method="post" enctype="multipart/form-data">
                        <div class="text-danger">
                            <?php		
                            if ($this->session->flashdata('error_message')){
                                echo $this->session->flashdata('error_message').'<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <div class="input-group my-3">
                            <label for="imageInput" class="control-label col-sm-2">Tipe Membership</label>
                            <div class="col-sm-10">
                            <?php
                                $type[$this->config->item('free_member')] = 'Free'; 
                                $type[$this->config->item('pro_member')] = 'Pro'; 
                                echo form_dropdown('mem_type', $type, set_value('mem_type'), 'class="form-control", id="mem_type"');
                            ?>
                            </div>
                        </div>
                        <div id="freeForm" <?php if (set_value('mem_type') == $this->config->item('pro_member')){ ?>style="display: none"<?php } ?>>
                            <div class="input-group mb-3">
                                <label for="mem_name" class="control-label col-sm-2">Nama Sesuai KTP</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Nama Sesuai KTP" name="name" value="<?= set_value('name'); ?>">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_hp" class="control-label col-sm-2">No. HP WA Aktif</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="number" placeholder="No. HP WA Aktif" name="hp" value="<?= set_value('hp'); ?>">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_email" class="control-label col-sm-2">email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="email" name="email" value="<?= set_value('email'); ?>">
                                </div>
                            </div>
                        </div>
                        <div id="proForm" <?php if (set_value('mem_type') == $this->config->item('free_member')){ ?>style="display: none"<?php } ?>>
                            <div class="input-group mb-3">
                                <label for="mem_ktp" class="control-label col-sm-2">No. KTP</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="number" placeholder="No. KTP" name="mem_ktp" value="<?= set_value('mem_ktp'); ?>">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_name" class="control-label col-sm-2">Nama Sesuai KTP</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Nama Sesuai KTP" name="mem_name" value="<?= set_value('mem_name'); ?>">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_address" class="control-label col-sm-2">Alamat Surat Menyurat</label>
                                <div class="col-sm-10"> 
                                    <input class="form-control" type="text" placeholder="Alamat Surat Menyurat" name="mem_address" value="<?= set_value('mem_address'); ?>">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_mail_address" class="control-label col-sm-2">Alamat yang Tertera di Sertifikat</label>
                                <div class="col-sm-10 gap-1">
                                    <label class="checkbox-inline"><input type="checkbox" name="same" value="1" <?php echo set_checkbox('same', '1'); ?> /> Sama dengan alamat surat menyurat</label>
                                    <input class="form-control" type="text" placeholder="Alamat yang Tertera di Sertifikat" name="mem_mail_address" value="<?= set_value('mem_mail_address'); ?>">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_hp" class="control-label col-sm-2">No. HP WA Aktif</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="number" placeholder="No. HP WA Aktif" name="mem_hp" value="<?= set_value('mem_hp'); ?>">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_kota" class="control-label col-sm-2">Kota</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Kota" name="mem_kota" value="<?= set_value('mem_kota'); ?>">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_kode_pos" class="control-label col-sm-2">Kode Pos</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="number" placeholder="Kode Pos" name="mem_kode_pos" value="<?= set_value('mem_kode_pos'); ?>">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_email" class="control-label col-sm-2">email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="email" name="mem_email" value="<?= set_value('mem_email'); ?>">
                                </div>
                            </div>
                            <hr/>
                            <div class="input-group mb-3 gap-3">
                                <label for="imageInputPP" class="control-label col-sm-12 text-center">PP</label>
                                <div class="col-sm-12 text-center">
                                    <img id="imgPreviewPP" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                    <input type="file" class="upload" id="imageInputPP" onclick="resetImage('pp')"/>
                                    <input type="hidden" name="attachment_pp" id="attachment_pp">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_username" class="control-label col-sm-2">Username</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Username" name="mem_username" value="<?= set_value('mem_username'); ?>">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="password" class="control-label col-sm-2">Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="password" placeholder="Password" name="password" value="<?= set_value('password'); ?>">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="repass" class="control-label col-sm-2">Konfirmasi Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="password" placeholder="Konfirmasi Password" name="repass" value="<?= set_value('repass'); ?>">
                                </div>
                            </div>
                            <hr/>
                            <div class="input-group mb-3 gap-3">
                                <label for="imageInputLogo" class="control-label col-sm-12 text-center">Foto Kennel</label>
                                <div class="col-sm-12 text-center">
                                    <img id="imgPreviewLogo" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                    <input type="file" class="upload" id="imageInputLogo" onclick="resetImage('logo')"/>
                                    <input type="hidden" name="attachment_logo" id="attachment_logo">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="ken_name" class="control-label col-sm-2">Nama Kennel</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Nama Kennel" name="ken_name" value="<?= set_value('ken_name'); ?>">
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_ktp" class="control-label col-sm-2">Format Penamaan Canine</label>
                                <?php
                                    foreach($kennelType as $row){
                                        $pil[$row->ken_type_id] = $row->ken_type_name;
                                    }
                                    echo form_dropdown('ken_type_id', $pil, set_value('ken_type_id'), 'class="form-control", id="ken_type_id"');
                                ?>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary btn-lg" type="button" id="registerBtn">Register</button>
                            <button class="btn btn-danger btn-lg" type="button" onclick="window.location = '<?= base_url() ?>frontend/Members'">Kembali</button>
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
                    <div id=freeContainer <?php if (set_value('mem_type') == $this->config->item('pro_member')){ ?>style="display: none"<?php } ?>>
                        <div class="row">
                            <div class="col-4">Tipe Membership</div>
                            <div class="col confirm-type"></div>
                        </div>
                        <div class="row">
                            <div class="col-4">Nama Sesuai KTP</div>
                            <div class="col confirm-name"></div>
                        </div>
                        <div class="row">
                            <div class="col-4">No. HP WA Aktif</div>
                            <div class="col confirm-number"></div>
                        </div>
                        <div class="row">
                            <div class="col-4">email</div>
                            <div class="col confirm-email"></div>
                        </div>
                    </div>
                    <div id=proContainer <?php if (set_value('mem_type') == $this->config->item('free_member')){ ?>style="display: none"<?php } ?>>
                        <div class="row">
                            <div class="col-6">Tipe Membership</div>
                            <div class="col confirm-type"></div>
                        </div>
                        <div class="row">
                            <div class="col-6">No. KTP</div>
                            <div class="col" id="confirm-ktp"></div>
                        </div>
                        <div class="row">
                            <div class="col-6">Nama Sesuai KTP</div>
                            <div class="col confirm-name"></div>
                        </div>
                        <div class="row">
                            <div class="col-6">Alamat Surat Menyurat</div>
                            <div class="col" id="confirm-address"></div>
                        </div>
                        <div class="row">
                            <div class="col-6">Alamat yang Tertera di Sertifikat</div>
                            <div class="col" id="confirm-mail_address"></div>
                        </div>
                        <div class="row">
                            <div class="col-6">No. HP WA Aktif</div>
                            <div class="col confirm-number"></div>
                        </div>
                        <div class="row">
                            <div class="col-6">Kota</div>
                            <div class="col" id="confirm-kota"></div>
                        </div>
                        <div class="row">
                            <div class="col-6">Kode Pos</div>
                            <div class="col" id="confirm-kode_pos"></div>
                        </div>
                        <div class="row">
                            <div class="col-6">email</div>
                            <div class="col confirm-email"></div>
                        </div>
                        <div class="row">
                            <div class="col-6">PP</div>
                            <div class="col-auto">:</div>
                            <div class="col"><img id="confirm-pp" width="50%"/></div>
                        </div>
                        <div class="row">
                            <div class="col-6">Username</div>
                            <div class="col" id="confirm-username"></div>
                        </div>
                        <div class="row">
                            <div class="col-6">Foto Kennel</div>
                            <div class="col-auto">:</div>
                            <div class="col"><img id="confirm-logo" width="50%"/></div>
                        </div>
                        <div class="row">
                            <div class="col-6">Nama Kennel</div>
                            <div class="col" id="confirm-ken_name"></div>
                        </div>
                        <div class="row">
                            <div class="col-6">Format Penamaan Canine</div>
                            <div class="col" id="confirm-ken_type"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submitBtn">Yes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </div>
                </div>
            </div>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script src="<?= base_url(); ?>assets/js/cropper.min.js"></script>
    <script>
        $('#mem_type').on("change", function(){
            mem_type = $('#mem_type').val();
            if (mem_type == <?= $this->config->item('free_member') ?>){
                $('#proForm').hide();
                $('#freeForm').show();

                $('#proContainer').hide();
                $('#freeContainer').show();
            }
            else{
                $('#freeForm').hide();
                $('#proForm').show();   

                $('#freeContainer').hide();
                $('#proContainer').show();  
            }
        });

        const imageInputPP = document.querySelector("#imageInputPP");
        const imageInputLogo = document.querySelector("#imageInputLogo");
        var croppingImage = null;

        var resetImage = function(input) {
            if(input === "pp"){
                imageInputPP.value = null;
            }
            else if(input === "logo"){
                imageInputLogo.value = null;
            }
        };

        $(document).ready(function(){
            var $modal = $('#modal');
            var previewPP = document.getElementById('imgPreviewPP');
            var previewLogo = document.getElementById('imgPreviewLogo');
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
                    viewMode: 3,
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
                        $modal.modal('hide');
                    };
                });
            });

            $('#cancel-btn').click(function() {
                resetImage(croppingImage);
            });
        });

        let registerBtn = $("#registerBtn");
        registerBtn.click(function(){
            $('.confirm-type').text(': ' + $('#mem_type option:selected').text());
            if ($('#mem_type').val() == <?= $this->config->item('free_member') ?>){
                $('.confirm-name').text(': ' + $('input[name="name"]').val());
                $('.confirm-number').text(': ' + $('input[name="hp"]').val());
                $('.confirm-email').text(': ' + $('input[name="email"]').val());
            }
            else{
                $('.confirm-name').text(': ' + $('input[name="mem_name"]').val());
                $('.confirm-number').text(': ' + $('input[name="mem_hp"]').val());
                $('.confirm-email').text(': ' + $('input[name="mem_email"]').val());

                $('#confirm-ktp').text(': ' + $('input[name="mem_ktp"]').val());
                $('#confirm-address').text(': ' + $('input[name="mem_address"]').val());

                if($('input[name="same"]').is(":checked")){
                    $('#confirm-mail_address').text(': ' + $('input[name="mem_address"]').val());
                }
                else{
                    $('#confirm-mail_address').text(': ' + $('input[name="mem_mail_address"]').val());
                }

                $('#confirm-kota').text(': ' + $('input[name="mem_kota"]').val());
                $('#confirm-kode_pos').text(': ' + $('input[name="mem_kode_pos"]').val());
                $('#confirm-pp').attr("src",  $('#imgPreviewPP').attr("src"));
                $('#confirm-username').text(': ' + $('input[name="mem_username"]').val());
                $('#confirm-logo').attr("src",  $('#imgPreviewLogo').attr("src"));
                $('#confirm-ken_name').text(': ' + $('input[name="ken_name"]').val());
                $('#confirm-ken_type').text(': ' + $('#ken_type_id option:selected').text());
            }

            $('#confirm-modal').modal('show');
        });

        let submitBtn = $("#submitBtn");
        submitBtn.click(function(){
            submitBtn.prop('disabled', true);
            $('#mainForm').submit();
        });
    </script>
</body>
</html>

