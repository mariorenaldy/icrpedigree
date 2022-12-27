<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Lahir</title>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
</head>

<body>
    <?php
    if (!$this->session->userdata('use_username')) {
        echo '<script type="text/javascript">';
        echo 'window.location = "' . base_url() . 'backend/Users/login";';
        echo '</script>';
    }
    ?>
    <main class="container">
        <?php $this->load->view('templates/header'); ?>
        <header class="d-flex flex-column align-items-center">
            <h2 class="fw-bold">Tambah Lahir</h2>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-items-center">
                    <form class="form-horizontal" action="<?= base_url(); ?>frontend/Births/validate_add" method="post" enctype="multipart/form-data">
                        <!-- <?php if (!$mode) { ?>
                            <input type="hidden" name="bir_stu_id" value="<?= $bir_stu_id ?>" />
                        <?php } else { ?>
                            <input type="hidden" name="bir_stu_id" value="<?= set_value('bir_stu_id') ?>" />
                        <?php } ?> -->
                        <div class="text-danger">
                            <?php
                            if ($this->session->flashdata('error_message')) {
                                echo $this->session->flashdata('error_message') . '<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">ID Member</label>
                            <div class="col-md-10">
                                <input class="form-control" type="number" placeholder="ID Member" id="bir_member_id" name="bir_member_id" value="<?php echo set_value('bir_member_id'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="bir_stu_id" class="control-label col-md-2">Pacak</label>
                            <div class="col-md-10">
                                <select id="studdrop" name="bir_stu_id" class="form-control"></select>
                            </div>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label class="control-label col-md-12 text-center">Foto Lahir</label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreview" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment_dam" id="imageInput" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Nama</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Nama" name="bir_a_s" value="<?php echo set_value('bir_a_s'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Trah</label>
                            <div class="col-md-10">
                                <!-- <?php
                                foreach ($trah as $row) {
                                    $pil[$row->tra_name] = $row->tra_name;
                                }
                                echo form_dropdown('bir_breed', $pil, set_value('bir_breed'), 'class="form-control"');
                                ?> -->
                                <select id="bir_breed" name="bir_breed" class="form-control"></select>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Jenis Kelamin</label>
                            <div class="col-md-10">
                                <!-- <?php
                                $gender['Male'] = 'Male';
                                $gender['Female'] = 'Female';
                                echo form_dropdown('bir_gender', $gender, set_value('bir_gender'), 'class="form-control"');
                                ?> -->
                                <select id="bir_gender" name="bir_gender" class="form-control"></select>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Warna</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Warna" name="bir_color" value="<?php echo set_value('bir_color'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="bir_date_of_birth" class="control-label col-md-2">Tanggal Lahir</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Tanggal Lahir" id="bir_date_of_birth" name="bir_date_of_birth" value="<?= set_value('bir_date_of_birth'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Kennel</label>
                            <div class="col-md-10">
                                <select id="kendrop" name="bir_kennel_id" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label class="control-label col-md-12 text-center">Foto Dam</label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreview" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment_dam" id="imageInput" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary btn-lg" type="submit">Simpan</button>
                            <button class="btn btn-danger btn-lg" type="button" onclick="window.location = '<?= base_url() ?>frontend/Births'">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php $this->load->view('templates/footer'); ?>
    </main>
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery-3.6.1.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script>
        function setDatePicker(id) {
            $(id).datepicker({
                dateFormat: 'dd-mm-yy'
            });
            $(id).readOnly = true;
        }
        setDatePicker('#bir_date_of_birth');

        $(document).ready(function() {
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