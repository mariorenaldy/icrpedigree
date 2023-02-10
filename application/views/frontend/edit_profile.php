<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Edit Profile</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_non_paid'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <header class="d-flex flex-column align-items-center">
            <h2 class="fw-bold text-warning">Edit Profile</h2>
        </header>
        <div class="container">
            <div class="row">            
                <div class="col-sm-12 align-items-center">                          
                    <form class="form-horizontal" action="<?php echo base_url(); ?>frontend/Members/update" method="post" enctype="multipart/form-data">
                        <div class="text-danger">
                            <?php		
                            if ($this->session->flashdata('error_message')){
                                echo $this->session->flashdata('error_message').'<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
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
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Alamat yang Tertera di Sertifikat" name="mem_mail_address" value="<?= set_value('mem_mail_address'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_hp" class="control-label col-sm-2">No. HP WA Aktif</label>
                            <div class="col-sm-10 gap-1">
                                <label class="checkbox-inline"><input type="checkbox" name="same" value="1" <?php echo set_checkbox('same', '1'); ?> /> Sama dengan alamat surat menyurat</label>
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
                        <div class="text-center">
                            <button class="btn btn-primary btn-lg" type="submit">Simpan</button>
                            <button class="btn btn-danger btn-lg" type="button" onclick="window.location = '<?= base_url() ?>frontend/Members/profile'">Kembali</button>
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

