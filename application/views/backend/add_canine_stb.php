<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Add Canine</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>assets/css/jquery-ui.min.css" rel="stylesheet" />
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <main class="container">
        <?php $this->load->view('templates/header'); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-items-center">
                    <h3 class="text-center text-primary">Add Canine</h3>  
                    <form id="formCanine" class="form-horizontal" action="<?= base_url(); ?>backend/Requestexport/validate_add" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Member</label>
                            <label class="control-label col-md-2"><?= $req->mem_name; ?></label>
                        </div>
                        <div class="input-group mb-5">
                            <label class="control-label col-md-2">Kennel</label>
                            <label class="control-label col-md-2"><?= $req->ken_name; ?></label>
                        </div>
                        <hr/>
                        <div class="input-group mt-3 mb-3 gap-3">
                            <label class="control-label col-md-12 text-center">Canine Photo</label>
                            <div class="col-md-12 text-center">
                                <img width="15%" src="<?= base_url('uploads/canine/'.$req->req_can_photo) ?>">
                            </div>
                        </div>
                        <div class="input-group mt-3 mb-3 gap-3">
                            <label class="control-label col-md-12 text-center">Stambum Photo</label>
                            <div class="col-md-12 text-center">
                                <img width="15%" src="<?= base_url('uploads/export/'.$req->req_stb_photo) ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Name</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Name" name="can_a_s" value="<?php echo set_value('can_a_s'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Current Registration Number</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Current Registration Number" name="can_reg_number" value="<?php echo set_value('can_reg_number'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">ICR Number</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="ICR Number" name="can_icr_number" value="<?php echo set_value('can_icr_number'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Microchip Number</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Microchip Number" name="can_chip_number" value="<?php echo set_value('can_chip_number'); ?>" maxlength="15" oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/(\..*?)\..*/g, '$1');">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Breed</label>
                            <div class="col-md-10">
                                <?php
                                foreach ($trah as $row) {
                                    $pil[$row->tra_name] = $row->tra_name;
                                }
                                echo form_dropdown('can_breed', $pil, set_value('can_breed'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Gender</label>
                            <div class="col-md-10">
                                <?php
                                $gender['MALE'] = 'MALE';
                                $gender['FEMALE'] = 'FEMALE';
                                echo form_dropdown('can_gender', $gender, set_value('can_gender'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Color</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Warna" name="can_color" value="<?php echo set_value('can_color'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Date of Birth</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Date of Birth" id="can_date_of_birth" name="can_date_of_birth" value="<?php echo set_value('can_date_of_birth'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="password" class="control-label col-md-2">Note </label>
                            <div class="col-md-10">
                                <textarea class="form-control" rows="10" name="can_note"><?= set_value('can_note') ?></textarea>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="checkbox-inline"><input type="checkbox" name="remove" value="1" <?php echo set_checkbox('remove', '1'); ?> /> Remove kennel name</label>
                        </div>
                        <div class="text-center">
                            <input type="hidden" name="req_id" value="<?= $req->req_id; ?>">
                            <button id="buttonSubmit" class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>backend/Canines'">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="error-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-danger">
                        <?php if ($this->session->flashdata('error_message')){ ?>
                            <div class="row">
                                <div class="col-12"><?= $this->session->flashdata('error_message') ?></div>
                            </div>
                        <?php } ?>
                        <?php if (validation_errors()){ ?>
                            <div class="row">
                                <?= validation_errors() ?>
                            </div>
                        <?php } ?>
                        <div id="error-row" class="row" style="display: none;">
                            <div id="error-col" class="col-12"></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                    </div>
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
        setDatePicker('#can_date_of_birth');

        $(document).ready(function(){
            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>

</html>