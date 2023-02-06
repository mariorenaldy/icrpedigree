<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Edit Notification Type</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">  
                <h3 class="text-center text-primary">Edit Notification Type</h3>                        
                <form class="form-horizontal" action="<?= base_url(); ?>backend/Notificationtype/validate_edit" method="post">
                    <div class="text-danger">
                        <?php		
                            if ($this->session->flashdata('edit_error')){
                                echo $this->session->flashdata('edit_error').'<br/>';
                            }
                            echo validation_errors().'<br/>';
                        ?>
                    </div>
                    <div class="input-group mb-3">
                        <label for="title" class="control-label col-md-1">Title </label>
                        <div class="col-md-10">
                            <?php if (!$mode){ ?>
                                <input type="text" class="form-control" name="title" value="<?= $notif->title ?>" placeholder="Title">
                            <?php } else { ?>
                                <input type="text" class="form-control" name="title" value="<?= set_value('title'); ?>" placeholder="Title">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="password" class="control-label col-md-1">Description </label>
                        <div class="col-md-10">
                            <?php if (!$mode){ ?>
                                <input type="hidden" name="notificationtype_id" value="<?= $notif->notificationtype_id ?>" />
                                <textarea class="form-control" rows="10" name="description"><?= $notif->description ?></textarea>
                            <?php } else { ?>
                                <input type="hidden" name="notificationtype_id" value="<?= set_value('notificationtype_id') ?>" />
                                <textarea class="form-control" rows="10" name="description"><?= set_value('description') ?></textarea>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" onclick="window.location = '<?= base_url() ?>backend/Notificationtype'">Back</button>
                    </div>
                </form>
            </div>                           
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
    <?php $this->load->view('templates/script'); ?>
</body>
</html>