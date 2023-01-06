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
                <h3 class="text-center text-primary">User List</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'User has been saved<br/>';
                        }
                        if ($this->session->flashdata('edit_password')){
                            echo 'Password has been edited<br/>';
                        }
                        if ($this->session->flashdata('delete')){
                            echo 'User has been deleted<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('error_message')){
                            echo $this->session->flashdata('error_message').'<br/>';
                        }
                    ?>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" onclick="add()"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-md-2"><b>Username</b></div>
                    <div class="col-md-2"></div>
                </div>
                <?php foreach ($users AS $u){ ?>
                    <div class="row">
                        <div class="col-md-2">
                            <?= $u->use_username; ?>
                        </div>
                        <div class="col-md-2 mb-1">
                            <button type="button" class="btn btn-success" onclick="update_password(<?= $u->use_id ?>)"><i class="fa fa-pencil"></i></button>
                            <button type="button" class="btn btn-danger" onclick="del(<?= $u->use_id ?>, '<?= $u->use_username ?>')"><i class="fa fa-close"></i></button>
                        </div>
                    </div>
                <?php } ?>
            </div>                           
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script>
        function add(){
            window.location = "<?= base_url(); ?>backend/Users/add";
        }
        function update_password(id){
            window.location = "<?= base_url(); ?>backend/Users/update_password/"+id;
        }
        function del(id, nama){
            var proceed = confirm("Delete "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Users/delete/"+id;
            }
        }
    </script>
</body>
</html>