<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Lapor Pacak</title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
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
                        <div class="text-danger">
                            <?php		
                            if ($this->session->flashdata('error_message')){
                                echo $this->session->flashdata('error_message').'<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <div class="input-group my-3">
                            <label for="stu_sire_id" class="control-label col-sm-2">Sire</label>
                            <div class="col-sm-10">
                                <?php
                                    $i = 0;
                                    $pil = [];
                                    foreach($sire as $row){
                                        // if ($sireStat[$i])
                                            $pil[$row->id] = $row->name;
                                        $i++;
                                    }
                                    echo form_dropdown('stu_sire_id', $pil, set_value('stu_sire_id'), 'class="form-control"');
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
                                    echo form_dropdown('stu_dam_id', $opt, set_value('stu_dam_id'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-sm-12 text-center">Foto Pacak</label>
                            <div class="col-sm-12 text-center">
                                <img id="imgPreview" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment_stud" id="imageInput" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-sm-12 text-center">Foto Sire</label>
                            <div class="col-sm-12 text-center">
                                <img id="imgPreviewSire" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment_sire" id="imageInputSire" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-sm-12 text-center">Foto Dam</label>
                            <div class="col-sm-12 text-center">
                                <img id="imgPreviewDam" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment_dam" id="imageInputDam" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="stu_stud_date" class="control-label col-sm-2">Tanggal Pacak</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Tanggal Pacak" id="stu_stud_date" name="stu_stud_date" value="<?= set_value('stu_stud_date'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="text-center">
                            <button id="buttonSubmit" class="btn btn-primary" type="submit">Simpan</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>frontend/Studs'">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
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

        $('#buttonSubmit').on("click", function(e){
            e.preventDefault();
            $('#formStud').attr('action', "<?= base_url(); ?>frontend/Studs/validate_add").submit();
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
        
            const imageInputSire = document.querySelector("#imageInputSire");
            imageInputSire.addEventListener("change", function() {
                const reader = new FileReader();
                reader.addEventListener("load", () => {
                    document.querySelector("#imgPreviewSire").src = reader.result
                })
                reader.readAsDataURL(this.files[0])
            })
        
            const imageInputDam = document.querySelector("#imageInputDam");
            imageInputDam.addEventListener("change", function() {
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

