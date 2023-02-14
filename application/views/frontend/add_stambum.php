<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Tambah Anak</title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_member'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <div class="container">
            <h3 class="text-center text-warning">Tambah Anak</h3>
            <div class="row">            
                <div class="col-sm-12 align-items-center">                          
                    <form id="formCanine" class="form-horizontal" action="<?= base_url(); ?>frontend/Stambums/validate_add" method="post" enctype="multipart/form-data">
                        <div class="text-danger">
                            <?php		
                            if ($this->session->flashdata('error_message')){
                                echo $this->session->flashdata('error_message').'<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <label class="checkbox-inline"><input type="checkbox" name="reg_member" value="1" <?php if (!$mode) echo 'checked'; else echo set_checkbox('reg_member', '1'); ?> /> Member</label>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Member</label>
                            <div class="col-md-10">
                                <?php
                                    $mem = [];
                                    foreach($member as $row){
                                        $mem[$row->mem_id] = $row->mem_name;
                                    }
                                    echo form_dropdown('stb_member_id', $mem, set_value('stb_member_id'), 'class="form-control", id="stb_member_id"');
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
                                    echo form_dropdown('stb_kennel_id', $ken, $kennel_id, 'class="form-control"');
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
                        <div class="input-group my-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-sm-12 text-center">Foto Canine</label>
                            <div class="col-sm-12 text-center">
                                <img id="imgPreview" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment" id="imageInput" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_name" class="control-label col-sm-2">Nama</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Nama" name="stb_a_s" value="<?= set_value('stb_a_s'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_hp" class="control-label col-sm-2">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <?php
                                    $gender['MALE'] = 'MALE';
                                    $gender['FEMALE'] = 'FEMALE';
                                    echo form_dropdown('stb_gender', $gender, set_value('stb_gender'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <input type="hidden" name="stb_bir_id" value="<?php if (!$mode) echo $birth->bir_id; else echo set_value('stb_bir_id'); ?>"/>
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>frontend/Canines'">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script>
        $('#stb_member_id').on("change", function(){
            $('#formCanine').attr('action', "<?= base_url(); ?>frontend/Stambums/search_kennel").submit();
        });

        $(document).ready(function(){
            const imageInput = document.querySelector("#imageInput");
            imageInput.addEventListener("change", function() {
                const reader = new FileReader();
                reader.addEventListener("load", () => {
                    document.querySelector("#imgPreview").src = reader.result
                })
                reader.readAsDataURL(this.files[0])
            })
        });
    </script>
</body>
</html>

