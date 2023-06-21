<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Login</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">       
            <div class="col-md-3"></div>     
            <div class="col-md-6">  
                <h3 class="text-center text-primary">Login</h3>                        
                <form class="form-horizontal" action="<?= base_url(); ?>backend/Users/validate_login" method="post">
                    <div class="input-group mb-3">
                        <label for="username" class="control-label col-md-2">Username: </label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username'); ?>" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="password" class="control-label col-md-2">Password: </label>
                        <div class="col-md-6">
                            <input class="form-control" type="password" id="password" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="col-md-2"></div>
                        <div class="col-md-6">
                            <button class="btn btn-primary btn-lg" type="submit">Login</button>
                        </div>
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
        $(document).ready(function(){
            $('#username').focus();

            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>
</html>