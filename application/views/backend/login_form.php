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
                    <div class="text-danger">
                        <?php		
                        if ($this->session->flashdata('login_error')){
                            echo $this->session->flashdata('login_error').'<br/>';
                        }
                        echo validation_errors().'<br/>';
                        ?>
                    </div>
                    <div class="input-group mb-3">
                        <label for="username" class="control-label col-md-2">Username: </label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username'); ?>" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="password" class="control-label col-md-2">Password: </label>
                        <div class="col-md-6">
                            <input class="form-control" type="password" id="password" name="password" placeholder="Kata Sandi">
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
        <?php $this->load->view('templates/footer'); ?>      
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script>
        $(document).ready(function(){
            $('#username').focus();
        });
    </script>
</body>
</html>