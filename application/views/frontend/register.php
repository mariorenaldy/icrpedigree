<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Register</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <header class="d-flex flex-column align-items-center">
            <h2 class="fw-bold">Register</h2>
        </header>
        <div class="container">
            <div class="row">            
                <div class="col-md-12 align-items-center">                          
                    <form class="form-horizontal" action="<?php echo base_url(); ?>frontend/Members/validate_register" method="post" enctype="multipart/form-data">
                        <div class="text-danger">
                            <?php		
                            if ($this->session->flashdata('error_message')){
                                echo $this->session->flashdata('error_message').'<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <div>Foto KTP</div>
                            <img id="imgPreview" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                            <input type="file" class="upload" name="attachment_member" id="imageInput" accept="image/jpeg, image/png, image/jpg" />
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_ktp" class="control-label col-md-2">No. KTP</label>
                            <div class="col-md-10">
                                <input class="form-control" type="number" placeholder="No. KTP" name="mem_ktp" value="<?php echo set_value('mem_ktp'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_name" class="control-label col-md-2">Nama Sesuai KTP</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Nama Sesuai KTP" name="mem_name" value="<?php echo set_value('mem_name'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_address" class="control-label col-md-2">Alamat Sesuai KTP</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Alamat Sesuai KTP" name="mem_address" value="<?php echo set_value('mem_address'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_mail_address" class="control-label col-md-2">Alamat Surat Menyurat</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Alamat Surat Menyurat" name="mem_mail_address" value="<?php echo set_value('mem_mail_address'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_hp" class="control-label col-md-2">No. Telp</label>
                            <div class="col-md-10">
                                <input class="form-control" type="number" placeholder="No. Telp" name="mem_hp" value="<?php echo set_value('mem_hp'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_kota" class="control-label col-md-2">Kota</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Kota" name="mem_kota" value="<?php echo set_value('mem_kota'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_kode_pos" class="control-label col-md-2">Kode Pos</label>
                            <div class="col-md-10">
                                <input class="form-control" type="number" placeholder="Kode Pos" name="mem_kode_pos" value="<?php echo set_value('mem_kode_pos'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_email" class="control-label col-md-2">email</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="email" name="mem_email" value="<?php echo set_value('mem_email'); ?>">
                            </div>
                        </div>
                        <hr/>
                        <div class="input-group mb-3 gap-3">
                            <div>PP</div>
                            <img id="imgPreviewPP" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                            <input type="file" class="upload" name="attachment_pp" id="imageInputPP"/>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_username" class="control-label col-md-2">Username</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Username" name="mem_username" value="<?php echo set_value('mem_username'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="password" class="control-label col-md-2">Password</label>
                            <div class="col-md-10">
                                <input class="form-control" type="password" placeholder="Password" name="password" value="<?php echo set_value('password'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="repass" class="control-label col-md-2">Konfirmasi Password</label>
                            <div class="col-md-10">
                                <input class="form-control" type="password" placeholder="Konfirmasi Password" name="repass" value="<?php echo set_value('repass'); ?>">
                            </div>
                        </div>
                        <hr/>
                        <div class="input-group mb-3 gap-3">
                            <div>Foto Kennel</div>
                            <img id="imgPreviewLogo" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                            <input type="file" class="upload" name="attachment_logo" id="imageInputLogo"/>
                        </div>
                        <div class="input-group mb-3">
                            <label for="ken_name" class="control-label col-md-2">Nama Kennel</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Nama Kennel" name="ken_name" value="<?php echo set_value('ken_name'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_ktp" class="control-label col-md-2">Format Penamaan Canine</label>
                            <?php
                                foreach($kennelType as $row){
                                    $pil[$row->ken_type_id] = $row->ken_type_name;
                                }
                                echo form_dropdown('ken_type_id', $pil, set_value('ken_type_id'), 'class="form-control"');
                            ?>
                        </div>
                        <button class="btn btn-primary btn-lg" type="submit">Register</button>
                        <button class="btn btn-danger btn-lg" type="button" onclick="window.location = '<?= base_url() ?>frontend/Members'">Kembali</button>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script>
        $(document).ready(function(){
            const imageInput = document.querySelector("#imageInput");
            imageInput.addEventListener("change", function() {
                const reader = new FileReader();
                reader.addEventListener("load", () => {
                    document.querySelector("#imgPreview").src = reader.result
                })
                reader.readAsDataURL(this.files[0])
            })

            const imageInputPP = document.querySelector("#imageInputPP");
            imageInputPP.addEventListener("change", function() {
                const reader = new FileReader();
                reader.addEventListener("load", () => {
                    document.querySelector("#imgPreviewPP").src = reader.result
                })
                reader.readAsDataURL(this.files[0])
            })

            const imageInputLogo = document.querySelector("#imageInputLogo");
            imageInputLogo.addEventListener("change", function() {
                const reader = new FileReader();
                reader.addEventListener("load", () => {
                    document.querySelector("#imgPreviewLogo").src = reader.result
                })
                reader.readAsDataURL(this.files[0])
            })
        });
    </script>
</body>
</html>

