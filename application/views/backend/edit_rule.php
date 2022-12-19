<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Rule</title>
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/suneditor.min.css" rel="stylesheet" />
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
                <h3>Edit Rule</h3>                        
                <form class="form-horizontal" action="<?= base_url(); ?>backend/Rules/validate_edit" method="post" onsubmit="save();">
                    <div class="text-danger">
                        <?php		
                            if ($this->session->flashdata('edit_error')){
                                echo $this->session->flashdata('edit_error').'<br/>';
                            }
                            echo validation_errors().'<br/>';
                        ?>
                    </div>
                    <div class="input-group mb-3">
                        <label for="title" class="control-label col-md-1">Judul: </label>
                        <div class="col-md-10">
                            <?php if (!$mode){ ?>
                                <input type="text" class="form-control" name="title" value="<?= $rule->ru_title ?>" placeholder="Judul" aria-label="title" aria-describedby="basic-addon1">
                            <?php } else { ?>
                                <input type="text" class="form-control" name="title" value="<?= set_value('title'); ?>" placeholder="Judul" aria-label="title" aria-describedby="basic-addon1">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="password" class="control-label col-md-1">Rule: </label>
                        <div class="col-md-10">
                            <?php if (!$mode){ ?>
                                <input type="hidden" name="rule_id" value="<?= $rule->ru_rule_id ?>" />
                                <textarea class="form-control" rows="10" name="rule" id="rule" style="display:none;"><?= $rule->ru_desc ?></textarea>
                            <?php } else { ?>
                                <input type="hidden" name="rule_id" value="<?= set_value('rule_id') ?>" />
                                <textarea class="form-control" rows="10" name="rule" id="rule" style="display:none;"><?= set_value('rule') ?></textarea>
                            <?php } ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger" onclick="window.location = '<?= base_url() ?>backend/Rules'"><i class="fa fa-close"></i></button>
                </form>
            </div>                           
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
<script src="<?= base_url(); ?>assets/js/jquery-3.6.1.min.js"></script>
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