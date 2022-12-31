<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Request Pengubahan Data Lahir</title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_non_paid'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <header class="d-flex flex-column align-items-center">
            <h2 class="fw-bold">Request Pengubahan Data Lahir</h2>
        </header>
        <div class="container">
            <div class="row">            
                <div class="col-md-12 align-items-center">                          
                    <form class="form-horizontal" action="<?= base_url(); ?>frontend/Births/validate_edit" method="post" enctype="multipart/form-data">
                        <!-- <?php if (!$mode){ ?>
                            <input type="hidden" name="bir_stu_id" value="<?= $bir_stu_id ?>" />
                        <?php } else { ?>
                            <input type="hidden" name="bir_stu_id" value="<?= set_value('bir_stu_id') ?>" />
                        <?php } ?> -->
                        <div class="text-danger">
                            <?php		
                            if ($this->session->flashdata('error_message')){
                                echo $this->session->flashdata('error_message').'<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <div class="input-group mb-3 gap-3">
                            <label for="bir_photo" class="control-label col-md-12 text-center">Foto Lahir</label>
                            <div class="col-md-12 text-center">
                                <img id="imgPreview" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                <input type="file" class="upload" name="bir_photo" id="imageInput" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="bir_a_s" class="control-label col-md-2">Nama</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Nama" name="bir_a_s" value="<?= set_value('bir_a_s'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="bir_breed" class="control-label col-md-2">Breed</label>
                            <div class="col-md-10">
                                <!-- <?php
                                    foreach($trah as $row){
                                        $pil[$row->tra_name] = $row->tra_name;
                                    }
                                    echo form_dropdown('can_breed', $pil, set_value('bir_breed'), 'class="form-control"');
                                ?> -->
                                <select id="bir_breed" name="bir_breed" class="form-control"></select>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="bir_gender" class="control-label col-md-2">Jenis Kelamin</label>
                            <div class="col-md-10">
                                <?php
                                    $gender['Male'] = 'Male';
                                    $gender['Female'] = 'Female';
                                    echo form_dropdown('bir_gender', $gender, set_value('bir_gender'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="bir_color" class="control-label col-md-2">Warna</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Warna" name="bir_color" value="<?= set_value('bir_color'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="bir_date_of_birth" class="control-label col-md-2">Tanggal Lahir</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Tanggal Lahir" id="bir_date_of_birth" name="bir_date_of_birth" value="<?= set_value('bir_date_of_birth'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="bir_member_id" class="control-label col-md-2">Breeder</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Breeder" name="bir_member_id" value="<?= set_value('bir_member_id'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="bir_kennel_id" class="control-label col-md-2">Kennel</label>
                            <div class="col-md-10">
                                <!-- <?php
                                    $ken = [];
                                    foreach($kennel as $row){
                                        $ken[$row->ken_id] = $row->ken_name;
                                    }
                                    echo form_dropdown('bir_kennel_id', $ken, set_value('bir_kennel_id'), 'class="form-control"');
                                ?> -->
                                <select id="bir_kennel_id" name="bir_kennel_id" class="form-control"></select>
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

