<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Add User</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
<?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">  
                <h3 class="text-center text-primary">Add User</h3>  
                <form class="form-horizontal" action="<?= base_url(); ?>backend/Users/validate_add" method="post">
                    <div class="text-danger">
                        <?php	
                        if ($this->session->flashdata('error_message')){
                            echo $this->session->flashdata('error_message').'<br/>';
                        }
                        echo validation_errors();
                        ?>
                    </div>
                    <div class="input-group mb-3">
                        <label for="mem_name" class="control-label col-md-2">Username</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" placeholder="Username" name="username" value="<?= set_value('username'); ?>">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label class="control-label col-md-2">User Type</label>
                        <div class="col-md-10">
                            <?php
                            foreach ($type as $row) {
                                $pil[$row->user_type_id] = $row->user_type_name;
                            }
                            echo form_dropdown('use_type_id', $pil, set_value('use_type_id'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="mem_name" class="control-label col-md-2">Password</label>
                        <div class="col-md-10">
                            <input class="form-control" type="password" placeholder="Password" name="password" value="<?= set_value('password'); ?>">
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
        <?php $this->load->view('templates/footer'); ?>      
    </div>
    <?php $this->load->view('templates/script'); ?>
</body>
</html>

