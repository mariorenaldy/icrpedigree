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
        <header class="d-flex flex-column align-items-center">
            <h2 class="fw-bold">Login</h2>
        </header>
        <div class="container">
            <div class="row">            
                <div class="col-md-6 col-md-offset-3">                          
                    <form class="form-horizontal" action="<?php echo base_url(); ?>frontend/Members/validate_login" method="post">
                        <div class="text-danger">
                            <?php		
                            if ($this->session->flashdata('login_error')){
                                echo $this->session->flashdata('login_error').'<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <div class="input-group mb-3">
                            <label for="username" class="control-label col-md-1"><span class="input-group-addon"><i class="fa fa-tag"></i></span></label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" id="username" name="username" placeholder="Nama pengguna" value="<?php echo set_value('username'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                        <label for="username" class="control-label col-md-1"><span class="input-group-addon"><i class="fa fa-lock"></i></span></label>
                            <div class="col-md-6">
                                <input class="form-control" type="password" id="password" name="password" placeholder="Kata Sandi">
                            </div>
                        </div>
                        <button class="btn btn-primary btn-lg" type="submit">Login</button>
                        <button class="btn btn-danger btn-lg" type="button" onclick="window.location = '<?= base_url() ?>frontend/Members/register'">Daftar</button>
                    </form>
                </div>                           
            </div>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>      
    <script>
        $(document).ready(function(){
            $('#username').focus();
        });
    </script>
</body>
</html>