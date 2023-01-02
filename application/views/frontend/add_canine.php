<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Tambah Canine</title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_member'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <header class="d-flex flex-column align-items-center">
            <h2 class="fw-bold text-warning">Tambah Canine</h2>
        </header>
        <div class="container">
            <div class="row">            
                <div class="col-md-12 align-items-center">                          
                    <form class="form-horizontal" action="<?= base_url(); ?>frontend/Canines/validate_add" method="post" enctype="multipart/form-data">
                        <div class="text-danger">
                            <?php		
                            if ($this->session->flashdata('error_message')){
                                echo $this->session->flashdata('error_message').'<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="stu_dam_id" class="control-label col-md-12 text-center">Foto</label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreview" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="attachment" id="imageInput" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_name" class="control-label col-md-2">Nama</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Nama" name="can_a_s" value="<?= set_value('can_a_s'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_address" class="control-label col-md-2">No. Registrasi</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="No. Registrasi" name="can_reg_number" value="<?= set_value('can_reg_number'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_hp" class="control-label col-md-2">Trah</label>
                            <div class="col-md-10">
                                <?php
                                    foreach($trah as $row){
                                        $pil[$row->tra_name] = $row->tra_name;
                                    }
                                    echo form_dropdown('can_breed', $pil, set_value('can_breed'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_hp" class="control-label col-md-2">Jenis Kelamin</label>
                            <div class="col-md-10">
                                <?php
                                    $gender['Male'] = 'Male';
                                    $gender['Female'] = 'Female';
                                    echo form_dropdown('can_gender', $gender, set_value('can_gender'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_mail_address" class="control-label col-md-2">Warna</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Warna" name="can_color" value="<?= set_value('can_color'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_mail_address" class="control-label col-md-2">Tanggal Lahir</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Tanggal Lahir" id="can_date_of_birth" name="can_date_of_birth" value="<?= set_value('can_date_of_birth'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_hp" class="control-label col-md-2">Kennel</label>
                            <div class="col-md-10">
                                <?php
                                    $ken = [];
                                    foreach($kennel as $row){
                                        $ken[$row->ken_id] = $row->ken_name;
                                    }
                                    echo form_dropdown('can_kennel_id', $ken, set_value('can_kennel_id'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
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
        function setDatePicker(id) {
            $(id).datepicker({ dateFormat: 'dd-mm-yy' });
            $(id).readOnly = true;
        }
        setDatePicker('#can_date_of_birth');

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

