<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Edit Kennel</title>
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
                    <h3 class="text-center text-primary">Edit Kennel</h3> 
                    <form class="form-horizontal" action="<?= base_url(); ?>backend/Members/validate_edit" method="post" enctype="multipart/form-data">
                        <div class="text-danger">
                            <?php
                            if ($this->session->flashdata('error_message')) {
                                echo $this->session->flashdata('error_message') . '<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <div class="input-group my-3">
                            <label for="imageInput" class="control-label col-md-2">Type</label>
                            <div class="col-md-10">
                            <?php
                                $type[$this->config->item('free_member')] = 'Free'; 
                                $type[$this->config->item('pro_member')] = 'Pro'; 
                                if (!$mode)
                                    echo form_dropdown('mem_type', $type, $member->mem_type, 'class="form-control", id="mem_type"');
                                else
                                    echo form_dropdown('mem_type', $type, set_value('mem_type'), 'class="form-control", id="mem_type"');
                            ?>
                            </div>
                        </div>
                        <div id="freeForm" <?php if ((!$mode && $member->mem_type == $this->config->item('pro_member')) || ($mode && set_value('mem_type') == $this->config->item('pro_member'))){ ?>style="display: none"<?php } ?>>
                            <div class="input-group mb-3">
                                <label for="mem_name" class="control-label col-md-2">Name</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="Name" name="name" value="<?= $member->mem_name; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="Name" name="name" value="<?= set_value('name'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_hp" class="control-label col-md-2">Phone Number</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="number" placeholder="Phone Number" name="hp" value="<?= $member->mem_hp; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="number" placeholder="Phone Number" name="hp" value="<?= set_value('hp'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_email" class="control-label col-md-2">email</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="email" name="email" value="<?= $member->mem_email; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="email" name="email" value="<?= set_value('email'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div id="proForm" <?php if ((!$mode && $member->mem_type == $this->config->item('free_member')) || ($mode && set_value('mem_type') == $this->config->item('free_member'))){ ?>style="display: none"<?php } ?>>
                            <div class="input-group mb-3">
                                <label for="mem_ktp" class="control-label col-md-2">KTP Number</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input type="hidden" name="mem_id" value="<?= $member->mem_id; ?>">
                                        <input type="hidden" name="ken_id" value="<?= $member->ken_id; ?>">
                                        <input class="form-control" type="number" placeholder="KTP Number" name="mem_ktp" value="<?= $member->mem_ktp; ?>">
                                    <?php } else { ?>
                                        <input type="hidden" name="mem_id" value="<?= set_value('mem_id'); ?>">
                                        <input type="hidden" name="ken_id" value="<?= set_value('ken_id'); ?>">
                                        <input class="form-control" type="number" placeholder="KTP Number" name="mem_ktp" value="<?= set_value('mem_ktp'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_name" class="control-label col-md-2">KTP Name</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="KTP Name" name="mem_name" value="<?= $member->mem_name; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="KTP Name" name="mem_name" value="<?= set_value('mem_name'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_address" class="control-label col-md-2">Mail Address</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="Mail Address" name="mem_address" value="<?= $member->mem_address; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="Mail Address" name="mem_address" value="<?= set_value('mem_address'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_mail_address" class="control-label col-md-2">Certificate Address</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="Certificate Address" name="mem_mail_address" value="<?= $member->mem_mail_address; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="Certificate Address" name="mem_mail_address" value="<?= set_value('mem_mail_address'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_hp" class="control-label col-md-2">Phone Number</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="number" placeholder="Phone Number" name="mem_hp" value="<?= $member->mem_hp; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="number" placeholder="Phone Number" name="mem_hp" value="<?= set_value('mem_hp'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_kota" class="control-label col-md-2">City</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="City" name="mem_kota" value="<?= $member->mem_kota; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="City" name="mem_kota" value="<?= set_value('mem_kota'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_kode_pos" class="control-label col-md-2">Postal Code</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="number" placeholder="Postal Code" name="mem_kode_pos" value="<?= $member->mem_kode_pos; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="number" placeholder="Postal Code" name="mem_kode_pos" value="<?= set_value('mem_kode_pos'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_email" class="control-label col-md-2">email</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="email" name="mem_email" value="<?= $member->mem_email; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="email" name="mem_email" value="<?= set_value('mem_email'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <hr />
                            <div class="input-group mb-3 gap-3">
                                <label for="imageInputPP" class="control-label col-md-12 text-center">PP</label>
                                <div class="col-md-12 text-center">
                                <?php 
                                    if (!$mode){ 
                                        if ($member->mem_pp && $member->mem_pp != '-'){
                                    ?>
                                        <img id="imgPreviewPP" width="15%" src="<?= base_url().'uploads/members/'.$member->mem_pp ?>">
                                    <?php } else { ?>
                                        <img id="imgPreviewPP" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                    <?php } 
                                    } else { ?>
                                        <img id="imgPreviewPP" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                    <?php } ?>
                                    <input type="file" class="upload" name="attachment_pp" id="imageInputPP" />
                                </div>
                            </div>
                            <hr />
                            <div class="input-group mb-3 gap-3">
                                <label for="imageInputLogo" class="control-label col-md-12 text-center">Kennel Photo</label>
                                <div class="col-md-12 text-center">
                                    <?php 
                                        if (!$mode){ 
                                            if ($member->ken_photo && $member->ken_photo != '-'){
                                    ?>
                                        <img id="imgPreviewLogo" width="15%" src="<?= base_url().'uploads/kennels/'.$member->ken_photo ?>">
                                    <?php } else { ?>
                                        <img id="imgPreviewLogo" width="15%" src="<?= base_url().'assets/img/avatar.jpg' ?>">
                                    <?php } 
                                    } else { ?>
                                        <img id="imgPreviewLogo" width="15%" src="<?= base_url('assets/img/avatar.jpg') ?>">
                                    <?php } ?>
                                    <input type="file" class="upload" name="attachment_logo" id="imageInputLogo" />
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="ken_name" class="control-label col-md-2">Kennel Name</label>
                                <div class="col-md-10">
                                    <?php if (!$mode){ ?>
                                        <input class="form-control" type="text" placeholder="Nama Kennel" name="ken_name" value="<?= $member->ken_name; ?>">
                                    <?php } else { ?>
                                        <input class="form-control" type="text" placeholder="Nama Kennel" name="ken_name" value="<?= set_value('ken_name'); ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="mem_ktp" class="control-label col-md-2">Canine Name Format</label>
                                <?php
                                    foreach ($kennelType as $row) {
                                        $pil[$row->ken_type_id] = $row->ken_type_name;
                                    }
                                    if (!$mode)
                                        echo form_dropdown('ken_type_id', $pil, $member->ken_type_id, 'class="form-control"');
                                    else
                                        echo form_dropdown('ken_type_id', $pil, set_value('ken_type_id'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>backend/Members'">Back</button>
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
        $('#mem_type').on("change", function(){
            mem_type = $('#mem_type').val();
            if (mem_type == <?= $this->config->item('free_member') ?>){
                $('#proForm').hide();
                $('#freeForm').show();
            }
            else{
                $('#freeForm').hide();
                $('#proForm').show();   
            }
        });

        $(document).ready(function(){
            const imageInputPP = document.querySelector("#imageInputPP");
            imageInputPP.addEventListener("change", function() {
                const reader = new FileReader();
                reader.addEventListener("load", () => {
                    document.querySelector("#imgPreviewPP").src = reader.result
                })
                reader.readAsDataURL(this.files[0])
            })

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