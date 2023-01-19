<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Add Kennel</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <main class="container">
        <?php $this->load->view('templates/header'); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-items-center">
                    <h3 class="text-center text-primary">Add Kennel</h3>  
                    <form class="form-horizontal" action="<?php echo base_url(); ?>backend/Members/validate_add" method="post" enctype="multipart/form-data">
                        <div class="text-danger">
                            <?php
                            if ($this->session->flashdata('error_message')) {
                                echo $this->session->flashdata('error_message') . '<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <!-- <div class="input-group mb-3 gap-3">
                            <label for="imageInput" class="control-label col-md-12 text-center">KTP Photo</label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreview" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment_member" id="imageInput" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div> -->
                        <div class="input-group mb-3">
                            <label for="mem_ktp" class="control-label col-md-2">KTP Number</label>
                            <div class="col-md-10">
                                <input class="form-control" type="number" placeholder="KTP Number" name="mem_ktp" value="<?= set_value('mem_ktp'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_name" class="control-label col-md-2">KTP Name</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="KTP Name" name="mem_name" value="<?= set_value('mem_name'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_address" class="control-label col-md-2">KTP Address</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="KTP Address" name="mem_address" value="<?= set_value('mem_address'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_mail_address" class="control-label col-md-2">Mail Address</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Mail Address" name="mem_mail_address" value="<?= set_value('mem_mail_address'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_hp" class="control-label col-md-2">Phone Number</label>
                            <div class="col-md-10">
                                <input class="form-control" type="number" placeholder="Phone Number" name="mem_hp" value="<?= set_value('mem_hp'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_kota" class="control-label col-md-2">City</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="City" name="mem_kota" value="<?= set_value('mem_kota'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_kode_pos" class="control-label col-md-2">Postal Code</label>
                            <div class="col-md-10">
                                <input class="form-control" type="number" placeholder="Postal Code" name="mem_kode_pos" value="<?= set_value('mem_kode_pos'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_email" class="control-label col-md-2">email</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="email" name="mem_email" value="<?= set_value('mem_email'); ?>">
                            </div>
                        </div>
                        <hr />
                        <div class="input-group mb-3 gap-3">
                            <label for="imageInputPP" class="control-label col-md-12 text-center">PP</label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreviewPP" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment_pp" id="imageInputPP" />
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_username" class="control-label col-md-2">Username</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Username" name="mem_username" value="<?= set_value('mem_username'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="password" class="control-label col-md-2">Password</label>
                            <div class="col-md-10">
                                <input class="form-control" type="password" placeholder="Password" name="password" value="<?= set_value('password'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="repass" class="control-label col-md-2">Confirmation Password</label>
                            <div class="col-md-10">
                                <input class="form-control" type="password" placeholder="Confirmation Password" name="repass" value="<?= set_value('repass'); ?>">
                            </div>
                        </div>
                        <hr />
                        <div class="input-group mb-3 gap-3">
                            <label for="imageInputLogo" class="control-label col-md-12 text-center">Kennel Photo</label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreviewLogo" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment_logo" id="imageInputLogo" />
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="ken_name" class="control-label col-md-2">Kennel Name</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Nama Kennel" name="ken_name" value="<?= set_value('ken_name'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_ktp" class="control-label col-md-2">Canine Name Format</label>
                            <?php
                                foreach ($kennelType as $row) {
                                    $pil[$row->ken_type_id] = $row->ken_type_name;
                                }
                                echo form_dropdown('ken_type_id', $pil, set_value('ken_type_id'), 'class="form-control"');
                            ?>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>backend/Members'">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php $this->load->view('templates/footer'); ?>
    </main>
    <?php $this->load->view('templates/script'); ?>
    <script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function(){
            // const imageInput = document.querySelector("#imageInput");
            // imageInput.addEventListener("change", function() {
            //     const reader = new FileReader();
            //     reader.addEventListener("load", () => {
            //         document.querySelector("#imgPreview").src = reader.result
            //     })
            //     reader.readAsDataURL(this.files[0])
            // })

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