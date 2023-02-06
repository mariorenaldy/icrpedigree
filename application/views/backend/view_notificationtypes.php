<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Notification Type List</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                         
                <h3 class="text-center text-primary">Notification Type List</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('update_success')){
                            echo 'Notification Type has been updated<br/>';
                        }
                    ?>
                </div>
                <div class="row mb-1">
                    <div class="col-md-3"><b>Title</b></div>
                    <div class="col-md-8"><b>Description</b></div>
                    <div class="col-md-1"></div>
                </div>
                <?php foreach ($notif AS $r){ ?>
                    <div class="row">
                        <div class="col-md-3">
                            <?= $r->title; ?>
                        </div>
                        <div class="col-md-8 mb-1">
                            <?= $r->description; ?>
                        </div>
                        <div class="col-md-1 mb-1">
                            <button type="button" class="btn btn-success" onclick='update(<?= $r->notificationtype_id; ?>)' data-toggle="tooltip" data-placement="top" title="Edit Notification Type"><i class="fa fa-edit"></i></button>    
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
            window.location = "<?= base_url(); ?>backend/Notificationtype/edit/"+id;
        }
    </script>
</body>
</html>