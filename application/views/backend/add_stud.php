<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Pacak</title>
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
            <h2 class="fw-bold">Tambah Pacak</h2>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-items-center">
                    <form id="formStud" class="form-horizontal" method="post" enctype="multipart/form-data">
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
                                <input class="form-control" type="number" placeholder="ID Member" id="stu_member_id" name="stu_member_id" value="<?php echo set_value('stu_member_id'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="stu_sire_id" class="control-label col-md-2">Sire</label>
                            <div class="col-md-10">
                                <!-- <?php
                                        $i = 0;
                                        $pil = [];
                                        foreach ($sire as $row) {
                                            if ($sireStat[$i])
                                                $pil[$row->id] = $row->name;
                                            $i++;
                                        }
                                        echo form_dropdown('stu_sire_id', $pil, set_value('stu_sire_id'), 'class="form-control"');
                                        ?> -->
                                <select id="siredrop" name="stu_sire_id" class="form-control"></select>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="can_a_s" class="control-label col-md-2">Nama Dam</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" placeholder="Nama Dam" name="can_a_s" value="<?= set_value('can_a_s'); ?>">
                            </div>
                            <div class="col-md-1 text-end">
                                <button id="buttonSearch" class="btn btn-primary btn-lg" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="stu_dam_id" class="control-label col-md-2">Dam</label>
                            <div class="col-md-10">
                                <!-- <?php
                                        $i = 0;
                                        $opt = [];
                                        foreach ($dam as $row) {
                                            if ($damStat[$i])
                                                $opt[$row->id] = $row->name;
                                            $i++;
                                        }
                                        echo form_dropdown('stu_dam_id', $opt, set_value('stu_dam_id'), 'class="form-control"');
                                        ?> -->
                                <select id="damdrop" name="stu_dam_id" class="form-control"></select>
                            </div>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-md-12 text-center">Foto Pacak</label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreview" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment_stud" id="imageInput" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-md-12 text-center">Foto Sire</label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreviewSire" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment_sire" id="imageInputSire" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-md-12 text-center">Foto Dam</label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreviewDam" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment_dam" id="imageInputDam" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="stu_stud_date" class="control-label col-md-2">Tanggal Pacak</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Tanggal Pacak" id="stu_stud_date" name="stu_stud_date" value="<?= set_value('stu_stud_date'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="text-center">
                            <button id="buttonSubmit" class="btn btn-primary btn-lg" type="submit">Simpan</button>
                            <button class="btn btn-danger btn-lg" type="button" onclick="window.location = '<?= base_url() ?>backend/Studs'">Kembali</button>
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
        setDatePicker('#stu_stud_date');

        $('#buttonSearch').on("click", function(e) {
            e.preventDefault();
            $('#formStud').attr('action', "<?= base_url(); ?>backend/Studs/search_dam").submit();
        });

        $('#buttonSubmit').on("click", function(e) {
            e.preventDefault();
            $('#formStud').attr('action', "<?= base_url(); ?>backend/Studs/validate_add").submit();
        });

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

        $(document).ready(function() {
            const imageInput = document.querySelector("#imageInputSire");
            imageInput.addEventListener("change", function() {
                const reader = new FileReader();
                reader.addEventListener("load", () => {
                    document.querySelector("#imgPreviewSire").src = reader.result
                })
                reader.readAsDataURL(this.files[0])
            })
        });

        $(document).ready(function() {
            const imageInput = document.querySelector("#imageInputDam");
            imageInput.addEventListener("change", function() {
                const reader = new FileReader();
                reader.addEventListener("load", () => {
                    document.querySelector("#imgPreviewDam").src = reader.result
                })
                reader.readAsDataURL(this.files[0])
            })
        });
    </script>
</body>

</html>