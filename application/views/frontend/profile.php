<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Profile</title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link href="<?= base_url('assets/css/cropper.min.css') ?>" rel="stylesheet" />
    <script src="<?= base_url(); ?>assets/js/cropper.min.js"></script>
    <link href="<?= base_url() . 'assets/css/pp-styles.css' ?>" rel="stylesheet" />
</head>

<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_non_paid'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <div class="container">
            <h3 class="text-center text-warning">Profile</h3>
            <div class="text-success">
                <?php		
                    if ($this->session->flashdata('edit_profile')){
                        echo 'Edit Profile berhasil.<br/>Silakan hubungi ICR admin untuk mendapatkan approval.<br/>';
                    }
                    if ($this->session->flashdata('change_pp')) {
                        echo 'PP berhasil diubah.<br/>';
                    }
                ?>
            </div>
            <div class="text-danger">
                <?php
                if ($this->session->flashdata('error_message')) {
                    echo $this->session->flashdata('error_message').'<br/>';
                }
                echo validation_errors();
                ?>
            </div>
            <form method="post">
                <div class="row mb-2">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 profilepic text-center">
                        <div class="d-inline-block" style="position: relative;">
                            <img src="<?php if ($member->mem_pp != '-') echo base_url().'uploads/members/'.$member->mem_pp; else echo base_url().'assets/img/avatar.jpg'; ?>" class="img-fluid img-thumbnail profile profilepic__image" alt="PP">
                            <div class="profilepic__content">
                                <span class="profilepic__icon"><i class="fa-solid fa-file-image"></i></span>
                                <span class="profilepic__text">Ubah PP</span>
                            </div>
                            <input type="file" class="upload" name="attachment_pp" id="my_file" style="display: none;" onclick="reset(event)" />
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 edit-buttons text-center" style="display: none;">
                        <button class="btn btn-primary" type="button" id="submit_btn">Simpan</button>
                        <button class="btn btn-danger" type="button" onclick="revert()">Batal</button>
                    </div>
                </div>
            </form>
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">No. KTP</div>
                <div class="col-sm-8"><?= $member->mem_ktp ?></div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">Nama Sesuai KTP</div>
                <div class="col-sm-8"><?= $member->mem_name ?></div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">Alamat Surat Menyurat</div>
                <div class="col-sm-8"><?= $member->mem_address ?></div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">Alamat yang Tertera di Sertifikat</div>
                <div class="col-sm-8"><?= $member->mem_mail_address ?></div>
            </div>      
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">No. HP WA Aktif</div>
                <div class="col-sm-8"><?= $member->mem_hp ?></div>
            </div>      
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">Kota</div>
                <div class="col-sm-8"><?= $member->mem_kota ?></div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">Kode Pos</div>
                <div class="col-sm-8"><?= $member->mem_kode_pos ?></div>
            </div>     
            <div class="row mb-1">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">email</div>
                <div class="col-sm-8"><?= $member->mem_email ?></div>
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
<script>
    var imageOri = document.querySelector(".profilepic__image").src;
    var editBtns = document.querySelector(".edit-buttons");
    var image = document.querySelector(".profilepic__image");
    var base64data = null;

    document.querySelector('.profilepic').addEventListener('click', function() {
        document.querySelector('.profilepic input').click();
    });
    var loadFile = function() {
        editBtns.style.display = "inline";
        image.src = base64data;
    };
    var reset = function(event) {
        event.target.value = null;
    };
    var revert = function() {
        editBtns.style.display = "none";
        image.src = imageOri;
    };

    $(document).ready(function() {

        var $modal = $('#modal');

        var image = document.getElementById('sample_image');

        var cropper;

        $('#my_file').change(function(event) {
            var files = event.target.files;

            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };

            if (files && files.length > 0) {
                reader = new FileReader();
                reader.onload = function(event) {
                    done(reader.result);
                };
                reader.readAsDataURL(files[0]);
            }
        });

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
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
                width: 400,
                height: 400
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    base64data = reader.result;
                    loadFile();
                    $modal.modal('hide');
                };
            });
        });

        $('#submit_btn').click(function() {
            if (base64data != null) {
                $.ajax({
                    url: '<?= base_url(); ?>frontend/Members/change_pp',
                    method: 'POST',
                    data: {
                        uploaded_image: base64data
                    },
                    success: function(data) {
                        window.location.href = "<?= base_url(); ?>frontend/Members/profile";
                    }
                });
            }
        });
    });
</script>
</html>

