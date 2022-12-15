<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Approve Member</title>
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
                <h3>Approve Member</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('approve')){
                            echo 'Member berhasil di-approve<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('reject')){
                            echo 'Member berhasil ditolak<br/>';
                        }
                    ?>
                </div>
                <div class="search-container">
                    <form action="<?= base_url().'backend/Members/search_approve'?>">
                        <input type="text" placeholder="Nama/Alamat/No Telp." name="keywords">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-3"><b>KTP</b></div>
                    <div class="col-md-2"><b>Nama</b></div>
                    <div class="col-md-3"><b>Alamat</b></div>
                    <div class="col-md-2"><b>No. Telp</b></div>
                    <div class="col-md-2"></div>
                </div>
                <?php foreach ($member AS $m){ ?>
                    <div class="row">
                        <div class="col-md-3">
                            <img src="<?= base_url('uploads/members/'.$m->mem_photo) ?>" class="img-fluid img-thumbnail" alt="KTP">
                        </div>
                        <div class="col-md-2">
                            <?= $m->mem_name; ?>
                        </div>
                        <div class="col-md-3">
                            <?= $m->mem_address; ?>
                        </div>
                        <div class="col-md-2">
                            <?= $m->mem_hp; ?>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success" onclick="approve(<?= $m->mem_id ?>, '<?= $m->mem_name ?>')"><i class="fa fa-check"></i></button>
                            <button type="button" class="btn btn-danger" onclick="reject(<?= $m->mem_id ?>, '<?= $m->mem_name ?>')"><i class="fa fa-close"></i></button>
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
    function approve(id, nama){
        var proceed = confirm("Approve "+nama+" ?");
        if (proceed){             
            window.location = "<?= base_url(); ?>backend/Members/approve/"+id;
        }
    }
    function reject(id, nama){
        var proceed = confirm("Tolak "+nama+" ?");
        if (proceed){             
            window.location = "<?= base_url(); ?>backend/Members/reject/"+id;
        }
    }
</script>
</body>
</html>