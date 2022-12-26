<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Approve Birth</title>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
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
                <h3 class="text-center">Approve Birth</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('approve')){
                            echo 'Lahir berhasil di-approve<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('error')){
                            echo $this->session->flashdata('error').'<br/>';
                        }
                        if ($this->session->flashdata('reject')){
                            echo 'Lahir berhasil ditolak<br/>';
                        }
                    ?>
                </div>
                <div class="search-container my-3">
                    <form action="<?= base_url().'backend/Births/search_approve'?>" method="post">
                        <input type="text" placeholder="Nama" name="keywords">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="row mb-1">
                    <div class="col-md-3"><b>Foto</b></div>
                    <div class="col-md-3"><b>DOB</b></div>
                    <div class="col-md-2" align="center"><b>Jumlah Jantan</b></div>
                    <div class="col-md-2" align="center"><b>Jumlah Betina</b></div>
                    <div class="col-md-2"></div>
                </div>
                <?php foreach ($birth AS $b){ ?>
                    <div class="row">
                        <div class="col-md-3 mb-1">
                            <img src="<?= base_url('uploads/births/'.$b->bir_dam_photo) ?>" class="img-fluid img-thumbnail" alt="canine">
                        </div>
                        <div class="col-md-3">
                            <?= $b->bir_date_of_birth; ?>
                        </div>
                        <div class="col-md-2" align="right">
                            <?= $b->bir_male; ?>
                        </div>
                        <div class="col-md-2" align="right">
                            <?= $b->bir_female; ?>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success" onclick='approve(<?= $b->bir_id ?>, "<?= $b->bir_a_s ?>")'><i class="fa fa-check"></i></button>
                            <button type="button" class="btn btn-danger" onclick='reject(<?= $b->bir_id ?>, "<?= $b->bir_a_s ?>")'><i class="fa fa-close"></i></button>
                        </div>
                    </div>
                <?php } ?>
            </div>                           
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
<script src="<?php echo base_url(); ?>assets/js/jquery-3.6.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
<script>
    function approve(id, nama){
        var proceed = confirm("Approve "+nama+" ?");
        if (proceed){             
            window.location = "<?= base_url(); ?>backend/Births/approve/"+id;
        }
    }
    function reject(id, nama){
        var proceed = confirm("Tolak "+nama+" ?");
        if (proceed){             
            window.location = "<?= base_url(); ?>backend/Births/reject/"+id;
        }
    }
</script>
</body>
</html>