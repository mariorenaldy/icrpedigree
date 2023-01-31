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
                <div class="col-md-3">
                    <img src="<?= base_url('assets/img/ICR_jersey.png') ?>" class="img-fluid img-thumbnail">
                </div>    
                <div class="col-md-6 text-center">                          
                    <form class="form-horizontal" action="<?php echo base_url(); ?>frontend/Members/validate_login" method="post">
                        <div class="text-success">
                            <?php		
                                if ($this->session->flashdata('pro') && $this->session->flashdata('pro') == true){
                                    echo 'Register berhasil.<br/>Silakan hubungi ICR admin untuk mendapatkan approval.<br/>';
                                }
                                else if ($this->session->flashdata('pro') && $this->session->flashdata('pro') == false){
                                    echo 'Register berhasil.<br/>Gunakan email sebagai username & no. hp sebagai password.<br/>';
                                }
                            ?>
                        </div>
                        <div class="text-danger">
                            <?php		
                            if ($this->session->flashdata('login_error')){
                                echo $this->session->flashdata('login_error').'<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <div class="input-group my-3">
                            <div class="col-md-1"></div>  
                            <label for="username" class="control-label col-md-3"><span class="input-group-addon"><i class="fa fa-tag"></i> Username:</span></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text" id="username" name="username" placeholder="Nama pengguna" value="<?= set_value('username'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-md-1"></div> 
                            <label for="username" class="control-label col-md-3"><span class="input-group-addon"><i class="fa fa-lock"></i></span> Password:</label>
                            <div class="col-md-7">
                                <input class="form-control" type="password" id="password" name="password" placeholder="Kata Sandi">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-md-4"></div>
                            <div class="col-md-5 text-start">
                                <button class="btn btn-primary btn-lg" type="submit">Login</button>
                                <button class="btn btn-danger btn-lg" type="button" onclick="window.location = '<?= base_url() ?>frontend/Members/register'">Daftar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <img src="<?= base_url('assets/img/ICR_jersey.png') ?>" class="img-fluid img-thumbnail">
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