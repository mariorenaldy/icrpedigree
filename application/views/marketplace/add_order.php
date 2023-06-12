<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Add Order</title>
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
                    <h3 class="text-center text-primary">Add Order</h3>  
                    <form id="formOrder" class="form-horizontal" action="<?= base_url(); ?>marketplace/Orders/validate_add" method="post" enctype="multipart/form-data">
                        <div class="input-group my-3">
                            <label class="control-label col-md-2">Member Name/Kennel</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" placeholder="Member Name/Kennel" name="mem_name" id="mem_name" value="<?php echo set_value('mem_name'); ?>">
                            </div>
                            <div class="col-md-1 text-end">
                                <button id="memSearch" class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Member</label>
                            <div class="col-md-10">
                                <?php
                                    $mem = [];
                                    foreach($member as $row){
                                        $mem[$row->mem_id] = $row->mem_name;
                                    }
                                    echo form_dropdown('ord_mem_id', $mem, set_value('ord_mem_id'), 'class="form-control", id="ord_mem_id"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group my-3">
                            <label class="control-label col-md-2">Product's Name</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" placeholder="Product's Name" id="pro_name" name="pro_name" value="<?php echo set_value('pro_name'); ?>">
                            </div>
                            <div class="col-md-1 text-end">
                                <button id="proSearch" class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Product</label>
                            <div class="col-md-10">
                                <?php
                                    $pro = [];
                                    foreach($product as $row){
                                        $pro[$row->pro_id] = $row->pro_name;
                                    }
                                    echo form_dropdown('ord_pro_id', $pro, set_value('ord_pro_id'), 'class="form-control", id="ord_pro_id"');
                                ?>
                            </div>
                        </div>
                        <hr/>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Invoice</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Invoice" name="ord_invoice" value="<?= set_value('ord_invoice'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Quantity</label>
                            <div class="col-md-10">
                                <input class="form-control" type="number" placeholder="Quantity" name="ord_quantity" value="<?= set_value('ord_quantity'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Total Price</label>
                            <div class="col-md-10">
                                <input class="form-control" type="number" placeholder="Total Price" name="ord_total_price" value="<?= set_value('ord_total_price'); ?>">
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
                                    echo form_dropdown('ord_stat_id', $stat, set_value('ord_stat_id'), 'class="form-control", id="ord_stat_id"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Payment Date</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Payment Date" id="ord_pay_date" name="ord_pay_date" value="<?= set_value('ord_pay_date'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Payment Due Date</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Payment Date" id="ord_pay_due_date" name="ord_pay_due_date" value="<?= set_value('ord_pay_due_date'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Arrived Date</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Arrived Date" id="ord_arrived_date" name="ord_arrived_date" value="<?= set_value('ord_arrived_date'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Completed Date</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Completed Date" id="ord_completed_date" name="ord_completed_date" value="<?= set_value('ord_completed_date'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="password" class="control-label col-md-2">Reject Note</label>
                            <div class="col-md-10">
                                <textarea class="form-control" rows="10" placeholder="Reject Note" name="ord_reject_note"><?= set_value('ord_reject_note') ?></textarea>
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
            $('#formOrder').attr('action', "<?= base_url(); ?>marketplace/Orders/validate_add").submit();
        });

        $(document).ready(function(){
            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>

            $('#memSearch').on("click", function(e){
            e.preventDefault();
            let mem_name = $('#mem_name').val();
            $.ajax({
                url: "<?= base_url() ?>marketplace/Orders/search_member",
                method: 'post',
                data: {mem_name: mem_name},
                success: function(response){
                    if(response){
                        let memDropdown = $('#ord_mem_id')
                        memDropdown.empty();
                        
                        let result = JSON.parse(response);
                        let newOptions = [];
                        $.each(result, function(value, text) {
                            newOptions[text.mem_id] = text.mem_name;
                        });

                        $.each(newOptions, function(value, text) {
                            if(text !== undefined){
                                memDropdown.append("<option value='"+value+"'>"+text+"</option>");
                            }
                        });
                    }
                    else{
                        $('#error-modal').modal('show');
                    }
                }
            });
        });

        $('#proSearch').on("click", function(e){
            e.preventDefault();
            let pro_name = $('#pro_name').val();
            console.log(pro_name);
            $.ajax({
                url: "<?= base_url() ?>marketplace/Orders/search_product",
                method: 'post',
                data: {pro_name: pro_name},
                success: function(response){
                    if(response){
                        let proDropdown = $('#ord_pro_id')
                        proDropdown.empty();
                        
                        let result = JSON.parse(response);
                        let newOptions = [];
                        $.each(result, function(value, text) {
                            newOptions[text.pro_id] = text.pro_name;
                        });

                        $.each(newOptions, function(value, text) {
                            if(text !== undefined){
                                proDropdown.append("<option value='"+value+"'>"+text+"</option>");
                            }
                        });
                    }
                    else{
                        $('#error-modal').modal('show');
                    }
                },
                error: function(jqxhr, status, exception) {
                    alert('Exception:', exception);
                }
            });
        });
        });
    </script>
</body>

</html>