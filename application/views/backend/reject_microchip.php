<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Reject Microchip Request</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/cropper.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/crop-modal-styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/backend-modal.css" />
</head>
<body>
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImg">
    </div>
    <?php $this->load->view('templates/redirect'); ?>
    <main class="container">
        <?php $this->load->view('templates/header'); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-items-center">
                    <h3 class="text-center text-primary">Reject Microchip Request</h3>  
                    <form id="formRequest" class="form-horizontal" action="<?= base_url(); ?>backend/Requestmicrochip/validate_reject" method="post" enctype="multipart/form-data">
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
                            <span class="d-inline-block" style="width: 150px;">Appointment Date</span>
                            <span><?= $req->req_datetime ?></span>
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
                            <span class="d-inline-block" style="width: 150px;">Payment Proof</span>
                            <?php if ($req->req_pay_photo && $req->req_pay_photo != '-'){ ?>
                                <img src="<?= base_url('uploads/payment/'.$req->req_pay_photo) ?>" class="img-fluid img-thumbnail" alt="payment" id="myPay<?= $req->req_id ?>" onclick="display('myPay<?= $req->req_id ?>')" style="max-height:100px;">
                            <?php } ?>
                        </div>
                        <div class="mb-1">
                            <span class="d-inline-block" style="width: 150px;">Status</span>
                            <span><?= $req->stat_name ?></span>
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
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>backend/Requestmicrochip'">Back</button>
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
        var modal = document.getElementById("myModal");
        function display(id){
            var img = document.getElementById(id);
            var modalImg = document.getElementById("modalImg");
            modal.style.display = "block";
            modalImg.src = img.src;
        }

        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
            modal.style.display = "none";
        }

        $('#buttonSubmit').on("click", function(e){
            e.preventDefault();
            warning();
        });

        function warning(){
            var proceed = confirm("Confirm reject request?");
            if (proceed){
                $('#formRequest').attr('action', "<?= base_url(); ?>backend/Requestmicrochip/validate_reject").submit();
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