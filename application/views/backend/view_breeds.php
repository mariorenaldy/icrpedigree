<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Breed List</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center text-primary">Breed List</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'Breed has been saved<br/>';
                        }
                        if ($this->session->flashdata('edit_success')){
                            echo 'Breed has been edited<br/>';
                        }
                        if ($this->session->flashdata('delete')){
                            echo 'Breed has been deactivated<br/>';
                        }
                        if ($this->session->flashdata('activate')){
                            echo 'Breed has been activated<br/>';
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
                                <th>Breed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($breeds AS $r){ ?>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-success mb-1" onclick="update(<?= $r->tra_id ?>)" data-toggle="tooltip" data-placement="top" title="Edit Breed"><i class="fa fa-pencil"></i></button>
                                    </td>
                                    <td>
                                        <?php 
                                            if ($this->session->userdata('use_type_id') == $this->config->item('super')){ 
                                                if (!$r->tra_stat){ ?>
                                                    <button type="button" class="btn btn-primary mb-1" onclick="activate(<?= $r->tra_id ?>, '<?= $r->tra_name ?>')" data-toggle="tooltip" data-placement="top" title="Activate Breed"><i class="fa fa-check"></i></button>
                                        <?php } else { ?>
                                                    <button type="button" class="btn btn-danger mb-1" onclick="del(<?= $r->tra_id ?>, '<?= $r->tra_name ?>')" data-toggle="tooltip" data-placement="top" title="Delete Breed"><i class="fa fa-trash"></i></button>
                                        <?php }
                                        } ?>
                                    </td>
                                    <td>
                                        <?= $r->tra_name; ?>
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
            window.location = "<?= base_url(); ?>backend/Breeds/add";
        }
        function update(id){
            window.location = "<?= base_url(); ?>backend/Breeds/edit/"+id;
        }
        function del(id, nama){
            var proceed = confirm("Delete "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Breeds/delete/"+id;
            }
        }
        function activate(id, nama){
            var proceed = confirm("Activate "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Breeds/activate/"+id;
            }
        }
    </script>
</body>
</html>