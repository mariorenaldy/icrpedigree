<?php 
$mode = [];
$bir_stu_id = null;
?>
<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Request Pengubahan Data Lahir</title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_member'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <header class="d-flex flex-column align-items-center">
            <h2 class="fw-bold">Request Pengubahan Data Lahir</h2>
        </header>
        <div class="container">
            <div class="row">            
                <div class="col-md-12 align-items-center">                          
                    <form class="form-horizontal" action="<?= base_url(); ?>frontend/Births/validate_edit" method="post" enctype="multipart/form-data">
                        <?php if (!$mode){ ?>
                            <input type="hidden" name="bir_stu_id" value="<?= $bir_stu_id ?>" />
                        <?php } else { ?>
                            <input type="hidden" name="bir_stu_id" value="<?= set_value('bir_stu_id') ?>" />
                        <?php } ?>
                        <div class="text-danger">
                            <?php		
                            if ($this->session->flashdata('error_message')){
                                echo $this->session->flashdata('error_message').'<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-md-12 text-center">Foto Dam</label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreview" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment_dam" id="imageInput" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="bir_male" class="control-label col-md-2">Jumlah Jantan</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Jumlah Jantan" name="bir_male" value="<?= set_value('bir_male'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="bir_female" class="control-label col-md-2">Jumlah Betina</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Jumlah Betina" name="bir_female" value="<?= set_value('bir_female'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="bir_date_of_birth" class="control-label col-md-2">Tanggal Lahir</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Tanggal Lahir" id="bir_date_of_birth" name="bir_date_of_birth" value="<?= set_value('bir_date_of_birth'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>frontend/Births'">Kembali</button>
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
        setDatePicker('#bir_date_of_birth');

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

