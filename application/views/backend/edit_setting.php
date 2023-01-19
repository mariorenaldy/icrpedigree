<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Edit Setting</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>assets/css/suneditor.min.css" rel="stylesheet" />
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">  
                <h3 class="text-center text-primary">Edit Setting</h3>                        
                <form class="form-horizontal" action="<?= base_url(); ?>backend/Setting/validate" method="post" onsubmit="save();">
                    <div class="text-success">
                        <?php		
                            if ($this->session->flashdata('edit_success')){
                                echo 'Setting has been saved.<br/>';
                            }
                        ?>
                    </div>
                    <div class="text-danger">
                        <?php		
                            if ($this->session->flashdata('error_message')){
                                echo $this->session->flashdata('error_message').'<br/>';
                            }
                            echo validation_errors().'<br/>';
                        ?>
                    </div>
                    <div class="input-group mb-3">
                        <label for="title" class="control-label col-md-2">Term & Condition: </label>
                        <div class="col-md-10">
                            <?php if (!$mode){ ?>
                                <textarea class="form-control" rows="10" name="set_tc"><?= $setting->set_tc ?></textarea>
                            <?php } else { ?>
                                <textarea class="form-control" rows="10" name="set_tc"><?= set_value('set_tc') ?></textarea>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="password" class="control-label col-md-2">Certificate Rules: </label>
                        <div class="col-md-10">
                            <?php if (!$mode){ ?>
                                <textarea class="form-control" rows="10" name="set_rule" id="rule" style="display:none;"><?= $setting->set_rule ?></textarea>
                            <?php } else { ?>
                                <textarea class="form-control" rows="10" name="set_rule" id="rule" style="display:none;"><?= set_value('set_rule') ?></textarea>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" onclick="window.location = '<?= base_url() ?>backend/Setting'">Back</button>
                    </div>
                </form>
            </div>                           
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script src="<?= base_url(); ?>assets/js/suneditor.min.js"></script>
    <script>
        var suneditor = SUNEDITOR.create('rule', {
            mode: 'inline',
            display: 'block',
            width: '100%',
            height: '162',
            popupDisplay: 'full',
            buttonList: [
                ['bold', 'underline', 'list']
            ],
            placeholder: 'Start typing something...'
        });

        function save(){
            suneditor.save();
        }
    </script>
</body>
</html>