<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title><?= lang('mem_change_password'); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_non_paid'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <div class="container">
        <h3 class="text-center text-warning"><?= lang('mem_change_password'); ?></h3>
            <div class="row">            
                <div class="col-sm-12 align-items-center">                          
                    <form class="form-horizontal" action="<?= base_url(); ?>frontend/Members/validate_edit_password" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <label for="mem_name" class="control-label col-sm-2">Username</label>
                            <div class="col-sm-10"><?= $this->session->userdata('username'); ?></div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_name" class="control-label col-sm-2">Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" placeholder="Password" name="password" value="<?= set_value('password'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_name" class="control-label col-sm-2"><?= lang('mem_new_password'); ?></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" placeholder="<?= lang('mem_new_password'); ?>" name="newpass" value="<?= set_value('newpass'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_name" class="control-label col-sm-2"><?= lang('mem_confirm_password'); ?></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" placeholder="<?= lang('mem_confirm_password'); ?>" name="repass" value="<?= set_value('repass'); ?>">
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit"><?= lang('common_save'); ?></button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>frontend/Members'"><?= lang('common_back'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="error-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= lang('common_error_message'); ?></h5>
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
        <div class="modal fade text-dark" id="message-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?= lang('common_notice'); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-success">
                            <?php if ($this->session->flashdata('edit_password')){ ?>
                                <div class="row">
                                    <div class="col-12"><?= lang('mem_change_password_success'); ?></div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script>
        $(document).ready(function(){
            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
            <?php		
                if ($this->session->flashdata('edit_password')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>
</html>

