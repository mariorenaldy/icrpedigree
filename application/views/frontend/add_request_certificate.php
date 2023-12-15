<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title><?= lang("can_req_cert"); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link href="<?= base_url(); ?>assets/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/cropper.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/crop-modal-styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_member'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <div class="container">
            <h3 class="text-center text-warning"><?= lang("can_req_cert"); ?></h3>
            <div class="row">            
                <div class="col-sm-12 align-items-center">                          
                    <form id="mainForm" class="form-horizontal" action="<?= base_url(); ?>frontend/Requestcertificate/validate_add" method="post" enctype="multipart/form-data">
                        <div class="mb-1">
                            <?php if (!$mode){ ?>
                                <input type="hidden" name="can_id" value="<?= $canine->can_id ?>">
                            <?php } else { ?>
                                <input type="hidden" name="can_id" value="<?= set_value('can_id'); ?>">
                            <?php } ?>
                            <span class="d-inline-block" style="width: 200px;"><?= lang("can_dog_name"); ?></span>
                            <span><?= $canine->can_a_s ?></span>
                        </div>
                        <div class="input-group mb-3">
                            <label for="com_desc" class="d-inline-block" style="width: 200px;"><?= lang("can_cert_desc"); ?></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" placeholder="<?= lang("can_cert_desc"); ?>" name="req_desc" value="<?= set_value('req_desc'); ?>" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label" style="width: 200px;"><?= lang("common_city/regency"); ?></label>
                            <div class="col-sm-10">
                                <select id="req_city_select" name="req_city_select" placeholder="<?= lang("common_city/regency"); ?>" class="form-control col-sm-10">
                                    <option value=""><?= lang("common_city/regency"); ?></option>
                                    <?= $cityOptions; ?>
                                </select>
                            </div>
                            <input type="hidden" name="req_city" id="req_city" value="<?= set_value('req_city'); ?>">
                        </div>
                        <div class="input-group mb-3">
                            <label for="req_address" class="control-label" style="width: 200px;"><?= lang("common_full_address"); ?></label>
                            <div class="col-sm-10"> 
                                <input class="form-control" type="text" placeholder="<?= lang("common_full_address"); ?>" name="req_address" value="<?= set_value('req_address'); ?>">
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="button" id="saveBtn"><?= lang("common_save"); ?></button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>frontend/Canines'"><?= lang("common_back"); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crop Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <img src="" id="sample_image" />
                                </div>
                                <div class="col-md-4">
                                    <div class="preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="crop" class="btn btn-primary">Crop</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel-btn"><?= lang("common_cancel"); ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="confirm-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= lang("common_data_confirmation"); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4"><?= lang("can_cert_desc"); ?></div>
                            <div class="col">: <span id="confirm-deskripsi"></span></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><?= lang("common_city/regency"); ?></div>
                            <div class="col">: <span id="confirm-kota"></span></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><?= lang("common_full_address"); ?></div>
                            <div class="col">: <span id="confirm-address"></span></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" id="submitBtn"><?= lang("common_yes"); ?></button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= lang("common_no"); ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="error-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= lang("common_error_message"); ?></h5>
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
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/cropper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            var $select = $('#req_city_select').selectize({
                sortField: 'text',
                onChange: function(value) {
                    $('#req_city').val(value);
                }
            });

            let saveBtn = $("#saveBtn");
            saveBtn.click(function(){
                $('#confirm-deskripsi').text($('textarea[name="req_desc"]').val());
                $('#confirm-kota').text($('#req_city_select option:selected').text());
                $('#confirm-address').text($('input[name="req_address"]').val());

                $('#confirm-modal').modal('show');
            });

            let submitBtn = $("#submitBtn");
            submitBtn.click(function(){
                submitBtn.prop('disabled', true);
                $('#mainForm').submit();
            });

            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>
</html>

