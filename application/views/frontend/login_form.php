<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <div class="container">
            <h3 class="text-center text-warning">Login</h3>
            <div class="row">   
                <div class="col-sm-3">
                    <!-- <img src="<?= base_url('assets/img/ICR_jersey.png') ?>" class="img-fluid img-thumbnail"> -->
                </div>    
                <div class="col-sm-6 text-center">                          
                    <form class="form-horizontal" action="<?php echo base_url(); ?>frontend/Members/validate_login" method="post">
                        <div class="text-success">
                            <?php		
                                
                            ?>
                        </div>
                        <div class="input-group my-3">
                            <div class="col-sm-1"></div>  
                            <label for="username" class="control-label col-sm-3"><span class="input-group-addon"><i class="fa fa-tag"></i> Username:</span></label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" id="username" name="username" placeholder="Nama pengguna" value="<?= set_value('username'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-sm-1"></div> 
                            <label for="username" class="control-label col-sm-3"><span class="input-group-addon"><i class="fa fa-lock"></i></span> Password:</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="password" id="password" name="password" placeholder="Kata Sandi">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-5 text-start">
                                <button class="btn btn-primary btn-lg" type="submit">Login</button>
                                <button class="btn btn-danger btn-lg" type="button" onclick="window.location = '<?= base_url() ?>frontend/Members/register'">Daftar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-3">
                    <!-- <img src="<?= base_url('assets/img/ICR_jersey.png') ?>" class="img-fluid img-thumbnail"> -->
                </div>                  
            </div>
            <div class="modal fade text-dark" id="error-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pesan Kesalahan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-danger">
                            <?php if ($this->session->flashdata('login_error')){ ?>
                                <div class="row">
                                    <div class="col-12"><?= $this->session->flashdata('login_error') ?></div>
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
        </div>
        <div class="modal fade text-dark" id="message-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pemberitahuan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-success">
                            <?php if ($this->session->flashdata('pro')){ ?>
                                <div class="row">
                                    <div class="col-12">Register berhasil.<br/>Silakan hubungi ICR admin untuk mendapatkan approval.</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('free')){ ?>
                                <div class="row">
                                    <div class="col-12">Register berhasil.<br/>Username: <?= $this->session->flashdata('user') ?><br/>Password: no. hp</div>
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
            $('#username').focus();

            <?php if ($this->session->flashdata('login_error') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>

            <?php if ($this->session->flashdata('pro') || $this->session->flashdata('free')){ ?>
                $('#message-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>
</html>