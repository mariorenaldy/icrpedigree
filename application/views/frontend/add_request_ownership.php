<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Lapor Ubah Pemilik</title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_member'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <div class="container">
            <h3 class="text-center text-warning">Lapor Ubah Pemilik</h3>  
            <div class="row">            
                <div class="col-sm-12 align-items-center">                          
                    <form id="formCanine" class="form-horizontal" action="<?= base_url(); ?>frontend/Requestownershipcanine/validate" method="post">
                        <div class="text-danger">
                            <?php
                            if ($this->session->flashdata('error_message')) {
                                echo $this->session->flashdata('error_message') . '<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-2">Nama Anjing</div>
                            <div class="col-sm-4">: <?= $canine->can_a_s ?></div>
                        </div>
                        <hr/>
                        <label class="checkbox-inline"><input type="checkbox" name="reg_member" value="1" <?php if (!$mode) echo 'checked'; else echo set_checkbox('reg_member', '1'); ?> /> Member</label>
                        <div class="input-group my-3">
                            <label class="control-label col-sm-2">Member/Kennel</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" placeholder="Member/Kennel" name="mem_name" value="<?= set_value('mem_name'); ?>">
                            </div>
                            <div class="col-sm-1 text-end">
                                <button id="buttonSearch" class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-sm-2">Member</label>
                            <div class="col-sm-10">
                                <?php
                                    $mem = [];
                                    foreach($member as $row){
                                        $mem[$row->mem_id] = $row->mem_name;
                                    }
                                    echo form_dropdown('can_member_id', $mem, set_value('can_member_id'), 'class="form-control", id="can_member_id"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-5">
                            <label class="control-label col-sm-2">Kennel</label>
                            <div class="col-sm-10">
                                <?php
                                    $ken = [];
                                    foreach($kennel as $row){
                                        $ken[$row->ken_id] = $row->ken_name;
                                    }
                                    echo form_dropdown('can_kennel_id', $ken, $kennel_id, 'class="form-control", id="can_kennel_id"');
                                ?>
                            </div>
                        </div>
                        <hr/>
                        <div class="input-group mb-3">
                            <label for="mem_name" class="control-label col-sm-2">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Name" name="name" value="<?= set_value('name'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_hp" class="control-label col-sm-2">Phone Number</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" placeholder="Phone Number" name="hp" value="<?= set_value('hp'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_email" class="control-label col-sm-2">email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="email" name="email" value="<?= set_value('email'); ?>">
                            </div>
                        </div>
                        <input type="hidden" name="can_id" value="<?php if (!$mode) echo $canine->can_id; else echo set_value('can_id'); ?>"/>
                        <div class="text-center">
                            <button id="buttonSubmit" class="btn btn-primary" type="button">Simpan</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>frontend/Requestownershipcanine'">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="confirm-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="memberContainer" style="display: none;">
                            <div class="row">
                                <div class="col-4">Member</div>
                                <div class="col">: <span id="confirm-member"></span></div>
                            </div>
                            <div class="row">
                                <div class="col-4">Kennel</div>
                                <div class="col">: <span id="confirm-kennel"></span></div>
                            </div>
                        </div>
                        <div id="notMemberContainer" style="display: none;">
                            <div class="row">
                                <div class="col-4">Name</div>
                                <div class="col">: <span id="confirm-name"></span></div>
                            </div>
                            <div class="row">
                                <div class="col-4">Phone Number</div>
                                <div class="col">: <span id="confirm-phone_number"></span></div>
                            </div>
                            <div class="row">
                                <div class="col-4">email</div>
                                <div class="col">: <span id="confirm-email"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" id="submitBtn">Ya</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script>
        $('#buttonSearch').on("click", function(e){
            e.preventDefault();
            $('#formCanine').attr('action', "<?= base_url(); ?>frontend/Requestownershipcanine/search_member").submit();
        });

        $('#can_member_id').on("change", function(){
            $('#formCanine').attr('action', "<?= base_url(); ?>frontend/Requestownershipcanine/search_kennel").submit();
        });

        $(document).ready(function(){
            let saveBtn = $("#buttonSubmit");
            saveBtn.click(function(){
                if($('input[name="reg_member"]').is(":checked")){
                    $('#memberContainer').show();
                    $('#notMemberContainer').hide();
                    $('#confirm-member').text($('#can_member_id option:selected').text());
                    $('#confirm-kennel').text($('#can_kennel_id option:selected').text());
                }
                else{
                    $('#memberContainer').hide();
                    $('#notMemberContainer').show();
                    $('#confirm-name').text($('input[name="name"]').val());
                    $('#confirm-phone_number').text($('input[name="hp"]').val());
                    $('#confirm-email').text($('input[name="email"]').val());
                }

                $('#confirm-modal').modal('show');
            });

            let submitBtn = $("#submitBtn");
            submitBtn.click(function(){
                submitBtn.prop('disabled', true);
                $('#formCanine').attr('action', "<?= base_url(); ?>frontend/Requestownershipcanine/validate").submit();
            });
        });
    </script>
</body>

</html>