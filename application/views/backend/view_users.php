<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>User List</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center">User List</h3>
                <!-- <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'User has been saved<br/>';
                        }
                    ?>
                </div> -->
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('error_message')){
                            echo $this->session->flashdata('error_message').'<br/>';
                        }
                    ?>
                </div>
                <div class="search-container my-3">
                    <form action="<?= base_url().'backend/Users/search'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-6">    
                                <input type="text" class="form-control" placeholder="Name" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" onclick="add()"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-md-2"><b>Photo</b></div>
                    <div class="col-md-2"><b>Name</b></div>
                    <div class="col-md-2"><b>Access</b></div>
                    <div class="col-md-2"></div>
                </div>
                <?php foreach ($user AS $u){ ?>
                    <div class="row">
                        <div class="col-md-2 mb-1">
                            <img src="<?= base_url($u->use_photo) ?>" class="img-fluid img-thumbnail" alt="Photo">
                        </div>
                        <div class="col-md-2">
                            <?= $u->use_name; ?>
                        </div>
                        <div class="col-md-2">
                            <?php 
                            if ($u->use_akses == 1) {
                                echo 'Super Admin';
                            }
                            else if ($u->use_akses == 2) {
                                echo 'Admin';
                            }
                            else{
                                echo 'Employee';
                            }
                            ?>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary" onclick="update_user()"><i class="fa fa-pencil"></i></button>
                        </div>
                    </div>
                <?php } ?>
            </div>                           
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script>
        // function add(){
        //     window.location = "<?= base_url(); ?>backend/Users/add";
        // }
    </script>
</body>
</html>