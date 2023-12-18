<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Add Request Microchip</title>
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
                    <h3 class="text-center text-primary">Add Request Microchip</h3>  
                    <form id="formRequest" class="form-horizontal" action="<?= base_url(); ?>backend/Requestmicrochip/validate_add" method="post" enctype="multipart/form-data">
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
                                    echo form_dropdown('req_mem_id', $mem, set_value('req_mem_id'), 'class="form-control", id="req_mem_id"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Dog</label>
                            <div class="col-md-10">
                                <?php
                                    $can = [];
                                    foreach($canine as $row){
                                        $can[$row->can_id] = $row->can_a_s;
                                    }
                                    echo form_dropdown('req_can_id', $can, set_value('req_can_id'), 'class="form-control", id="req_can_id"');
                                ?>
                            </div>
                        </div>
                        <hr/>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Appointment Date</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Appointment Date" id="req_datetime" name="req_datetime" value="<?= set_value('req_datetime'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Status</label>
                            <div class="col-md-10">
                                <?php
                                    $stat = [];
                                    foreach($status as $row){
                                        $stat[$row->micro_stat_id] = $row->micro_stat_name;
                                    }
                                    echo form_dropdown('req_stat_id', $stat, set_value('req_stat_id'), 'class="form-control", id="req_stat_id"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Reject Reason</label>
                            <div class="col-md-10">
                                <textarea class="form-control" rows="10" placeholder="Reject Reason" name="req_reject_note"><?= set_value('req_reject_note') ?></textarea>
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
    <script src="<?= base_url(); ?>assets/js/jquery-ui-timepicker-addon.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/cropper.min.js"></script>
    <script>
        function setDatePicker(id) {
            $(id).datetimepicker({
                dateFormat: 'dd-mm-yy'
            });
            $(id).readOnly = true;
        }
        setDatePicker('#req_datetime');

        $('#buttonSubmit').on("click", function(e){
            e.preventDefault();
            $('#formRequest').attr('action', "<?= base_url(); ?>backend/Requestmicrochip/validate_add").submit();
        });
        var initial = true;
        $(document).ready(function(){
            if($('#req_mem_id').val()){
                searchDog();
            }
            
            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>

            $('#memSearch').on("click", function(e){
                e.preventDefault();
                let mem_name = $('#mem_name').val();
                $.ajax({
                    url: "<?= base_url() ?>backend/Requestmicrochip/search_member",
                    method: 'post',
                    data: {mem_name: mem_name},
                    success: function(response){
                        if(response){
                            let memDropdown = $('#req_mem_id')
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

                            searchDog();
                        }
                        else{
                            $('#error-modal').modal('show');
                        }
                    }
                });
            });

            $('#req_mem_id').on("change", function(){
                searchDog();
            });

            function searchDog(){
                let mem_id = $('#req_mem_id').val();
                $.ajax({
                    url: "<?= base_url() ?>backend/Requestmicrochip/search_dog",
                    method: 'post',
                    data: {mem_id: mem_id},
                    success: function(response){
                        if(response){
                            let result = JSON.parse(response);
                            if (result === undefined || result.length == 0) {
                                let dogDropdown = $('#req_can_id')
                                dogDropdown.empty();
                                dogDropdown.append("<option value=''>No dogs found</option>");
                            }
                            else{
                                let dogDropdown = $('#req_can_id')
                                dogDropdown.empty();
                                
                                let newOptions = [];
                                $.each(result, function(value, text) {
                                    newOptions[text.can_id] = text.can_a_s;
                                });
    
                                $.each(newOptions, function(value, text) {
                                    if(text !== undefined){
                                        dogDropdown.append("<option value='"+value+"'>"+text+"</option>");
                                    }
                                });
                            }

                            if(initial){
                                var dogVal;
                                <?php if(set_value('req_can_id')){ ?>
                                    dogVal = <?= set_value('req_can_id'); ?>;
                                    $('#req_can_id [value="'+dogVal+'"]').prop('selected', true);
                                    initial = false;
                                <?php } ?>
                            }
                        }
                        else{
                            $('#error-modal').modal('show');
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>