<?php 
$pil = [];
$kennelType = [];
?>
<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Pengubahan Data Kennel</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_member'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <header class="d-flex flex-column align-items-center">
            <h2 class="fw-bold text-warning">Pengubahan Data Kennel</h2>
        </header>
        <div class="container">
            <div class="row">            
                <div class="col-md-12 align-items-center">                          
                    <form class="form-horizontal" action="<?php echo base_url(); ?>frontend/Kennels/validate_add" method="post" enctype="multipart/form-data">
                        <div class="text-danger">
                            <?php		
                            if ($this->session->flashdata('error_message')){
                                echo $this->session->flashdata('error_message').'<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="imageInputLogo" class="control-label col-md-12 text-center">Foto Kennel</label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreviewLogo" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment_logo" id="imageInputLogo"/>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="ken_name" class="control-label col-md-2">Nama Kennel</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Nama Kennel" name="ken_name" value="<?= set_value('ken_name'); ?>">
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
                        <div class="text-center">
                            <button class="btn btn-primary btn-lg" type="submit">Simpan</button>
                            <button class="btn btn-danger btn-lg" type="button" onclick="window.location = '<?= base_url() ?>frontend/Kennels'">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script>
        $(document).ready(function(){
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

