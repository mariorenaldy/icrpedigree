<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Reject Order</title>
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
                    <h3 class="text-center text-primary">Reject Order</h3>  
                    <form id="formOrder" class="form-horizontal" action="<?= base_url(); ?>marketplace/Orders/validate_reject" method="post" enctype="multipart/form-data">
                        <div class="mb-1">
                            <?php if (!$mode){ ?>
                                <input type="hidden" name="ord_id" value="<?= $order->ord_id ?>">
                            <?php } else { ?>
                                <input type="hidden" name="ord_id" value="<?= set_value('ord_id'); ?>">
                            <?php } ?>
                            <span class="d-inline-block" style="width: 150px;">Invoice</span>
                            <span><?= $order->ord_invoice ?></span>
                        </div>
                        <div class="mb-1">
                            <span class="d-inline-block" style="width: 150px;">Member</span>
                            <span><?= $order->mem_name ?></span>
                        </div>
                        <div class="mb-1">
                            <span class="d-inline-block" style="width: 150px;">Date</span>
                            <span><?= $order->ord_created_at ?></span>
                        </div>
                        <div class="mb-1">
                            <span class="d-inline-block" style="width: 150px;">Payment Date</span>
                            <span><?= $order->ord_pay_date ?></span>
                        </div>
                        <div class="mb-1">
                            <span class="d-inline-block" style="width: 150px;">Product's Name</span>
                            <span><?= $order->pro_name ?></span>
                        </div>
                        <div class="mb-1">
                            <span class="d-inline-block" style="width: 150px;">Quantity</span>
                            <span><?= $order->ord_quantity ?></span>
                        </div>
                        <div class="mb-1">
                            <span class="d-inline-block" style="width: 150px;">Total Price</span>
                            <span><?= $order->ord_total_price ?></span>
                        </div>
                        <div class="mb-1">
                            <span class="d-inline-block" style="width: 150px;">Status</span>
                            <span><?= $order->ord_stat_name ?></span>
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
                                    echo form_dropdown('ord_reject', $pil, $order->ord_reject_note, 'class="form-control", id="ord_reject_note"');
                                else
                                    echo form_dropdown('ord_reject', $pil, set_value('ord_reject_note'), 'class="form-control", id="ord_reject_note"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Other Reason</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Other Reason" name="ord_reject_note" value="<?php echo set_value('ord_reject_note'); ?>">
                            </div>
                        </div>
                        <div class="text-center">
                            <button id="buttonSubmit" class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>marketplace/Orders/listOrders'">Back</button>
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
            var proceed = confirm("Confirm reject order?");
            if (proceed){
                $('#formOrder').attr('action', "<?= base_url(); ?>marketplace/Orders/validate_reject").submit();
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