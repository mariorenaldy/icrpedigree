<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Reject Certificate Request</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/cropper.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/crop-modal-styles.css" rel="stylesheet" />
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <main class="container">
        <?php $this->load->view('templates/header'); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-items-center">
                    <h3 class="text-center text-primary">Reject Certificate Request</h3>  
                    <form id="formRequest" class="form-horizontal" action="<?= base_url(); ?>backend/Requestcertificate/validate_reject" method="post" enctype="multipart/form-data">
                        <div class="mb-1">
                            <?php if (!$mode){ ?>
                                <input type="hidden" name="req_id" value="<?= $req->req_id ?>">
                            <?php } else { ?>
                                <input type="hidden" name="req_id" value="<?= set_value('req_id'); ?>">
                            <?php } ?>
                            <span class="d-inline-block" style="width: 150px;">Request ID</span>
                            <span><?= $req->req_id ?></span>
                        </div>
                        <div class="mb-1">
                            <span class="d-inline-block" style="width: 150px;">Request Date</span>
                            <span><?= $req->req_created_at ?></span>
                        </div>
                        <div class="mb-1">
                            <span class="d-inline-block" style="width: 150px;">Member</span>
                            <span><?= $req->mem_name ?></span>
                        </div>
                        <div class="mb-1">
                            <span class="d-inline-block" style="width: 150px;">Dog's Name</span>
                            <span><?= $req->can_a_s ?></span>
                        </div>
                        <div class="mb-1">
                            <span class="d-inline-block" style="width: 150px;">Status</span>
                            <span><?= $req->cert_stat_name ?></span>
                        </div>
                        <hr/>
                        <label class="checkbox-inline"><input type="checkbox" name="dropdown_reason" value="1" <?php if (!$mode) echo 'checked'; else echo set_checkbox('dropdown_reason', '1'); ?> /> Use reason from dropdown</label>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Reason</label>
                            <div class="col-md-10">
                                <?php
                                foreach ($reasons as $reason) {
                                    $pil[$reason->rej_name] = $reason->rej_name;
                                }
                                if (!$mode)
                                    echo form_dropdown('req_reject', $pil, $req->req_reject_note, 'class="form-control", id="req_reject_note"');
                                else
                                    echo form_dropdown('req_reject', $pil, set_value('req_reject_note'), 'class="form-control", id="req_reject_note"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Other Reason</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Other Reason" name="req_reject_note" value="<?php echo set_value('req_reject_note'); ?>">
                            </div>
                        </div>
                        <div class="text-center">
                            <button id="buttonSubmit" class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>backend/Requestcertificate'">Back</button>
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
    <script src="<?= base_url(); ?>assets/js/cropper.min.js"></script>
    <script>
        $('#buttonSubmit').on("click", function(e){
            e.preventDefault();
            warning();
        });

        function warning(){
            var proceed = confirm("Confirm reject request?");
            if (proceed){
                $('#formRequest').attr('action', "<?= base_url(); ?>backend/Requestcertificate/validate_reject").submit();
            }
        }

        $(document).ready(function(){
            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>

</html>