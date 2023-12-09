<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Edit Order</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/cropper.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/crop-modal-styles.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/jquery-ui-timepicker-addon.min.css" rel="stylesheet" />
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <main class="container">
        <?php $this->load->view('templates/header'); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-items-center">
                    <h3 class="text-center text-primary">Edit Order</h3>  
                    <form id="formOrder" class="form-horizontal" action="<?= base_url(); ?>marketplace/Orders/validate_edit" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Member</label>
                            <div class="col-md-10">
                                <?= $order->mem_name; ?>
                            </div>
                        </div>
                        <hr/>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Invoice</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input type="hidden" name="ord_id" value="<?= $order->ord_id ?>">
                                    <input class="form-control" type="text" placeholder="Invoice" name="ord_invoice" value="<?= $order->ord_invoice ?>">
                                <?php } else { ?>
                                    <input type="hidden" name="ord_id" value="<?= set_value('ord_id'); ?>">
                                    <input class="form-control" type="text" placeholder="Invoice" name="ord_invoice" value="<?= set_value('ord_invoice'); ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Total Price</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="number" placeholder="Total Price" name="ord_total_price" value="<?= $order->ord_total_price; ?>">
                                <?php } else { ?>
                                    <input class="form-control" type="number" placeholder="Total Price" name="ord_total_price" value="<?= set_value('ord_total_price'); ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Status</label>
                            <div class="col-md-10">
                                <?php
                                    $stat = [];
                                    foreach($status as $row){
                                        $stat[$row->ord_stat_id] = $row->ord_stat_name;
                                    }
                                    if (!$mode)
                                        echo form_dropdown('ord_stat_id', $stat, $order->ord_stat_id, 'class="form-control", id="ord_stat_id"');
                                    else
                                        echo form_dropdown('ord_stat_id', $stat, set_value('ord_stat_id'), 'class="form-control", id="ord_stat_id"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Payment Date</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Payment Date" id="ord_pay_date" name="ord_pay_date" value="<?= $order->ord_pay_date; ?>" autocomplete="off">
                                <?php } else { ?>
                                    <input class="form-control" type="text" placeholder="Payment Date" id="ord_pay_date" name="ord_pay_date" value="<?= set_value('ord_pay_date'); ?>" autocomplete="off">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Payment Due Date</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Payment Due Date" id="ord_pay_due_date" name="ord_pay_due_date" value="<?= $order->ord_pay_due_date; ?>" autocomplete="off">
                                <?php } else { ?>
                                    <input class="form-control" type="text" placeholder="Payment Date" id="ord_pay_due_date" name="ord_pay_due_date" value="<?= set_value('ord_pay_due_date'); ?>" autocomplete="off">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Arrived Date</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Arrived Date" id="ord_arrived_date" name="ord_arrived_date" value="<?= $order->ord_arrived_date; ?>" autocomplete="off">
                                <?php } else { ?>
                                    <input class="form-control" type="text" placeholder="Arrived Date" id="ord_arrived_date" name="ord_arrived_date" value="<?= set_value('ord_arrived_date'); ?>" autocomplete="off">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Completed Date</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Completed Date" id="ord_completed_date" name="ord_completed_date" value="<?= $order->ord_completed_date; ?>" autocomplete="off">
                                <?php } else { ?>
                                    <input class="form-control" type="text" placeholder="Completed Date" id="ord_completed_date" name="ord_completed_date" value="<?= set_value('ord_completed_date'); ?>" autocomplete="off">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="password" class="control-label col-md-2">Reject Note</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <textarea class="form-control" rows="10" placeholder="Reject Note" name="ord_reject_note"><?= $order->ord_reject_note ?></textarea>
                                <?php } else { ?>
                                    <textarea class="form-control" rows="10" placeholder="Reject Note" name="ord_reject_note"><?= set_value('ord_reject_note') ?></textarea>
                                <?php } ?>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel-btn">Batal</button>
                    </div>
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
    <script src="<?= base_url(); ?>assets/js/jquery-ui-timepicker-addon.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/cropper.min.js"></script>
    <script>
        function setDatePicker(id) {
            $(id).datetimepicker({
                dateFormat: 'dd-mm-yy'
            });
            $(id).readOnly = true;
        }
        setDatePicker('#ord_pay_date');
        setDatePicker('#ord_pay_due_date');
        setDatePicker('#ord_arrived_date');
        setDatePicker('#ord_completed_date');

        $('#buttonSubmit').on("click", function(e){
            e.preventDefault();
            $('#formOrder').attr('action', "<?= base_url(); ?>marketplace/Orders/validate_edit").submit();
        });

        $(document).ready(function(){
            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>

</html>