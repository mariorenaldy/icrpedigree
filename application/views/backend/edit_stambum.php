<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Edit Stambum</title>
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
                    <h3 class="text-center text-primary">Edit Stambum</h3>  
                    <form id="formStambum" class="form-horizontal" action="<?= base_url(); ?>backend/Stambum/validate_edit_stambum" method="post" enctype="multipart/form-data">
                        <div class="text-danger">
                            <?php
                            if ($this->session->flashdata('error_message')) {
                                echo $this->session->flashdata('error_message') . '<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <div class="input-group mb-5">
                            <label class="control-label col-md-2">Kennel</label>
                            <div class="col-md-10">
                                <?php
                                    if (!$mode)
                                        echo form_dropdown('stb_kennel_id', $kennel, $stambum->stb_kennel_id, 'class="form-control"');
                                    else
                                        echo form_dropdown('stb_kennel_id', $kennel, set_value('stb_kennel_id'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <hr/>
                        <div class="input-group mt-3 mb-3 gap-3">
                            <label class="control-label col-md-12 text-center">Stambum Photo</label>
                            <div class="col-md-12 text-center">
                                <?php 
                                    if (!$mode){ 
                                        if ($stambum->stb_photo && $stambum->stb_photo != '-'){
                                ?>
                                    <img id="imgPreview" width="15%" src="<?= base_url().'uploads/stambum/'.$stambum->stb_photo ?>">
                                <?php } else { ?>
                                    <img id="imgPreview" width="15%" src="<?= base_url().'assets/img/avatar.jpg' ?>">
                                <?php } 
                                } else { ?>
                                    <img id="imgPreview" width="15%" src="<?= base_url().'assets/img/avatar.jpg' ?>">
                                <?php } ?>
                                <input type="file" class="upload" name="attachment" id="imageInput" accept="image/jpeg, image/png, image/jpg" />
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Name</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input type="hidden" name="stb_id" value="<?= $stambum->stb_id ?>">
                                    <input class="form-control" type="text" placeholder="Name" name="stb_a_s" value="<?= $stambum->stb_a_s ?>">
                                <?php } else { ?>
                                    <input type="hidden" name="stb_id" value="<?= set_value('stb_id'); ?>">
                                    <input class="form-control" type="text" placeholder="Name" name="stb_a_s" value="<?= set_value('stb_a_s'); ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Breed</label>
                            <div class="col-md-10">
                                <?php
                                foreach ($trah as $row) {
                                    $pil[$row->tra_name] = $row->tra_name;
                                }
                                if (!$mode)
                                    echo form_dropdown('stb_breed', $pil, $stambum->stb_breed, 'class="form-control"');
                                else
                                    echo form_dropdown('stb_breed', $pil, set_value('stb_breed'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Gender</label>
                            <div class="col-md-10">
                                <?php
                                $gender['MALE'] = 'MALE';
                                $gender['FEMALE'] = 'FEMALE';
                                if (!$mode)
                                    echo form_dropdown('stb_gender', $gender, $stambum->stb_gender, 'class="form-control"');
                                else
                                    echo form_dropdown('stb_gender', $gender, set_value('stb_gender'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Color</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Warna" name="stb_color" value="<?= $stambum->stb_color; ?>">
                                <?php } else { ?>
                                    <input class="form-control" type="text" placeholder="Warna" name="stb_color" value="<?= set_value('stb_color'); ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Date of Birth</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Date of Birth" id="stb_date_of_birth" name="stb_date_of_birth" value="<?= $stambum->stb_date_of_birth; ?>" autocomplete="off">
                                <?php } else { ?>
                                    <input class="form-control" type="text" placeholder="Date of Birth" id="stb_date_of_birth" name="stb_date_of_birth" value="<?= set_value('stb_date_of_birth'); ?>" autocomplete="off">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="password" class="control-label col-md-2">Note </label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <textarea class="form-control" rows="10" name="stb_note"><?= $stambum->stb_note ?></textarea>
                                <?php } else { ?>
                                    <textarea class="form-control" rows="10" name="stb_note"><?= set_value('stb_note') ?></textarea>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="text-center">
                            <button id="buttonSubmit" class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>backend/Stambum'">Back</button>
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
            $(id).datepicker({
                dateFormat: 'dd-mm-yy'
            });
            $(id).readOnly = true;
        }
        setDatePicker('#stb_date_of_birth');

        $('#buttonSubmit').on("click", function(e){
            e.preventDefault();
            $('#formStambum').attr('action', "<?= base_url(); ?>backend/Stambum/validate_edit_stambum").submit();
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

            const dropDown = document.querySelector("#stb_member_id");
            dropDown.addEventListener("change", function() {
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