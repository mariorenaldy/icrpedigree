<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Edit Password</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
<?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">  
                <h3 class="text-center text-primary">Edit Password</h3>  
                <form class="form-horizontal" action="<?= base_url(); ?>backend/Users/validate_update" method="post">
                    <div class="input-group mb-3">
                        <label for="mem_name" class="control-label col-md-2">Username</label>
                        <div class="col-md-10"><?= $user->use_username; ?></div>
                        <input type="hidden" name="use_id" value="<?= $user->use_id; ?>">
                    </div>
                    <div class="input-group mb-3">
                        <label for="mem_name" class="control-label col-md-2">Password</label>
                        <div class="col-md-10">
                            <input class="form-control" type="password" placeholder="Password" name="password" value="<?= set_value('password'); ?>">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="mem_name" class="control-label col-md-2">New Password</label>
                        <div class="col-md-10">
                            <input class="form-control" type="password" placeholder="New Password" name="newpass" value="<?= set_value('newpass'); ?>">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="mem_name" class="control-label col-md-2">Confirmation Password</label>
                        <div class="col-md-10">
                            <input class="form-control" type="password" placeholder="Confirmation Password" name="repass" value="<?= set_value('repass'); ?>">
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>backend/Users'">Back</button>
                    </div>
                </form>
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
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script>
        $(document).ready(function () {
            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>
</html>

