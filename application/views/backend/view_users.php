<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>User List</title>
    <?php $this->load->view('templates/head'); ?>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/backend-modal.css" />
</head>
<body>
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImg">
    </div>
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
                        if ($this->session->flashdata('edit_type')){
                            echo 'User type has been edited<br/>';
                        }
                        if ($this->session->flashdata('edit_pp')){
                            echo 'PP has been changed<br/>';
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
                <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                    <div class="row my-3">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary" onclick="add()"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                <?php } ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="1%"></th>
                                <th width="1%"></th>
                                <th width="15%">PP</th>
                                <th>Username</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users AS $u){ ?>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-success mb-1" onclick="update_password(<?= $u->use_id ?>)" data-toggle="tooltip" data-placement="top" title="Edit Password"><i class="fa fa-pencil"></i></button>
                                        <button type="button" class="btn btn-warning mb-1" onclick="update_pp(<?= $u->use_id ?>)" data-toggle="tooltip" data-placement="top" title="Change PP"><i class="fa fa-image"></i></button>
                                    </td>
                                    <td>
                                        <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                                        <button type="button" class="btn btn-primary" onclick="update_type(<?= $u->use_id ?>, '<?= $u->use_username ?>')" data-toggle="tooltip" data-placement="top" title="Edit User Type"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger" onclick="del(<?= $u->use_id ?>, '<?= $u->use_username ?>')" data-toggle="tooltip" data-placement="top" title="Delete User"><i class="fa fa-trash"></i></button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($u->use_photo && $u->use_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/users/'.$u->use_photo) ?>" class="img-fluid img-thumbnail" alt="user" id="myImg<?= $u->use_id ?>" onclick="display('myImg<?= $u->use_id ?>')">
                                        <?php } else{ ?>
                                            <img src="<?= base_url().'assets/img/'.$this->config->item('default_img') ?>" class="img-fluid img-thumbnail" alt="user" id="myImg<?= $u->use_id ?>" onclick="display('myImg<?= $u->use_id ?>')">
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?= $u->use_username; ?>
                                    </td>
                                    <td>
                                        <?= $u->user_type_name; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
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
        function update_pp(id){
            window.location = "<?= base_url(); ?>backend/Users/update_pp/"+id;
        }
        function update_type(id){
            window.location = "<?= base_url(); ?>backend/Users/update_type/"+id;
        }
        function del(id, nama){
            var proceed = confirm("Delete "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Users/delete/"+id;
            }
        }

        var modal = document.getElementById("myModal");
        function display(id){
            var img = document.getElementById(id);
            var modalImg = document.getElementById("modalImg");
            modal.style.display = "block";
            modalImg.src = img.src;
        }

        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
            modal.style.display = "none";
        }
    </script>
</body>
</html>