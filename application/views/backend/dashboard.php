<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Dashboard</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                           
                <h3 class="text-center text-primary">Dashboard</h3>
            </div>
            <div class="col-md-12">                           
                <div class="text-success text-center">
                <?php		
                    if ($this->session->flashdata('edit_password')){
                        echo 'Password has been edited<br/>';
                    }
                    if ($this->session->flashdata('edit_pp')){
                        echo 'PP has been changed<br/>';
                    }
                ?>
                </div>
            </div>                     
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
    <?php $this->load->view('templates/script'); ?>
</body>
</html>