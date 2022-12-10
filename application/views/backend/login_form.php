<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">                          
                <form class="form-horizontal" action="<?php echo base_url(); ?>backend/Users/validate_login" method="post">
                    <h3>Login</h3>
                    <div class="text-danger">
                        <?php		
                        if ($this->session->flashdata('login_error')){
                            echo $this->session->flashdata('login_error').'<br/>';
                        }
                        echo validation_errors();
                        ?>
                    </div>

                    <div class="form-group input-group">
                        <label class="control-label col-sm-4">Username: </label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="username" name="username" placeholder="Nama pengguna" value="<?php echo set_value('username'); ?>">
                        </div>
                    </div>

                    <div class="form-group input-group">
                        <label class="control-label col-sm-4">Password: </label>
                        <div class="col-sm-8">
                            <input class="form-control" type="password" id="password" name="password" placeholder="Kata Sandi">
                        </div>
                    </div>

                    <div class="form-group input-group">
                        <button class="btn btn-primary btn-lg" type="submit">Login</button>
                    </div>
                </form>
            </div>                           
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
<script src="<?php echo base_url(); ?>assets/js/jquery-3.6.1.slim.min.js"></script>
<script>
    $(document).ready(function(){
        $('#username').focus();
    });
</script>
</body>
</html>