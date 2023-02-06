<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Edit Birth</title>
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
                    <h3 class="text-center text-primary">Edit Birth</h3>                         
                    <form id="formBirth" class="form-horizontal" action="<?= base_url(); ?>backend/Births/validate_edit" method="post" enctype="multipart/form-data">
                        <?php if (!$mode){ ?>
                            <input type="hidden" name="bir_id" value="<?= $birth->bir_id ?>" />
                        <?php } else { ?>
                            <input type="hidden" name="bir_id" value="<?= set_value('bir_id') ?>" />
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
                            <label for="stu_dam_id" class="control-label col-md-12 text-center">Dam Photo</label>
                            <div class="col-md-12 text-center">
                                <?php 
                                    if (!$mode){ 
                                        if ($birth->bir_dam_photo && $birth->bir_dam_photo != '-'){
                                ?>
                                    <img id="imgPreview" width="15%" src="<?= base_url().'uploads/births/'.$birth->bir_dam_photo ?>">
                                <?php } else { ?>
                                    <img id="imgPreview" width="15%" src="<?= base_url().'assets/img/avatar.jpg' ?>">
                                    <?php } 
                                } else { ?>
                                    <img id="imgPreview" width="15%" src="<?= base_url().'assets/img/avatar.jpg' ?>">
                                <?php } ?>
                                <input type="file" class="upload" name="attachment_dam" id="imageInput" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="bir_male" class="control-label col-md-2">Male</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Jumlah Jantan" name="bir_male" value="<?= $birth->bir_male ?>">
                                <?php } else { ?>
                                    <input class="form-control" type="text" placeholder="Jumlah Jantan" name="bir_male" value="<?= set_value('bir_male'); ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="bir_female" class="control-label col-md-2">Female</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Jumlah Betina" name="bir_female" value="<?= $birth->bir_female ?>">
                                <?php } else { ?>
                                    <input class="form-control" type="text" placeholder="Jumlah Betina" name="bir_female" value="<?= set_value('bir_female'); ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="bir_date_of_birth" class="control-label col-md-2">Date of Birth</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Date of Birth" id="bir_date_of_birth" name="bir_date_of_birth" value="<?= $birth->bir_date_of_birth ?>" autocomplete="off">
                                <?php } else { ?>    
                                    <input class="form-control" type="text" placeholder="Date of Birth" id="bir_date_of_birth" name="bir_date_of_birth" value="<?= set_value('bir_date_of_birth'); ?>" autocomplete="off">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="text-center">
                            <button id="buttonSubmit" class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>backend/Births'">Back</button>
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

