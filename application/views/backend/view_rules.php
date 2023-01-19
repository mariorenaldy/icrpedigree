<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Rules List</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                         
                <h3 class="text-center text-primary">Rules List</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'Rule has been saved<br/>';
                        }
                        if ($this->session->flashdata('update_success')){
                            echo 'Rule has been updated<br/>';
                        }
                        if ($this->session->flashdata('delete_success')){
                            echo 'Rule has been deleted<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('delete_error')){
                            echo $this->session->flashdata('delete_error').'<br/>';
                        }
                    ?>
                </div>
                <form action="<?= base_url().'backend/Rules/add' ?>" method="post" class="my-3">	
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                </form>
                <div class="row mb-1">
                    <div class="col-md-3"><b>Title</b></div>
                    <div class="col-md-7"><b>Rule</b></div>
                    <div class="col-md-2"></div>
                </div>
                <?php foreach ($rules AS $r){ ?>
                    <div class="row">
                        <div class="col-md-3">
                            <?= $r->ru_title; ?>
                        </div>
                        <div class="col-md-7 mb-1">
                            <?= $r->ru_desc; ?>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success" onclick='update(<?= $r->ru_rule_id; ?>)'><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger" onclick='del(<?= $r->ru_rule_id; ?>)'><i class="fa fa-close"></i></button>    
                        </div>
                    </div>
                <?php } ?>
            </div>                           
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script>
        function update(id){
            window.location = "<?= base_url(); ?>backend/Rules/edit/"+id;
        }
        function del(id){
            var proceed = confirm("Hapus rule?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Rules/delete/"+id;
            }
        }
    </script>
</body>
</html>