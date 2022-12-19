<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rules Management</title>
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
</head>
<body>
<?php
    if (!$this->session->userdata('use_username')){
        echo '<script type="text/javascript">';
        echo 'window.location = "'.base_url().'backend/Users/login";';
        echo '</script>';
    }
?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                         
                <h3>Rules Management</h3><div class="text-success">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'Rule berhasil disimpan<br/>';
                        }
                        if ($this->session->flashdata('update_success')){
                            echo 'Rule berhasil diubah<br/>';
                        }
                        if ($this->session->flashdata('delete_success')){
                            echo 'Rule berhasil dihapus<br/>';
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
                <form action="<?= base_url().'backend/Rules/add' ?>" method="post">	
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                </form>
                <div class="row">
                    <div class="col-md-3"><b>Judul</b></div>
                    <div class="col-md-7"><b>Rule</b></div>
                    <div class="col-md-2"></div>
                </div>
                <?php foreach ($rules AS $r){ ?>
                    <div class="row">
                        <div class="col-md-3">
                            <?= $r->ru_title; ?>
                        </div>
                        <div class="col-md-7">
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
<script src="<?= base_url(); ?>assets/js/jquery-3.6.1.min.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
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