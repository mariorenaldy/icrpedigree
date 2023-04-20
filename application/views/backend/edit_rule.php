<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Edit Rule</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>assets/css/suneditor.min.css" rel="stylesheet" />
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">  
                <h3 class="text-center text-primary">Edit Rule</h3>                        
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
                        <label for="title" class="control-label col-md-1">Title </label>
                        <div class="col-md-10">
                            <?php if (!$mode){ ?>
                                <input type="text" class="form-control" name="title" value="<?= $rule->ru_title ?>" placeholder="Title">
                            <?php } else { ?>
                                <input type="text" class="form-control" name="title" value="<?= set_value('title'); ?>" placeholder="Title">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="password" class="control-label col-md-1">Rule </label>
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
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" onclick="window.location = '<?= base_url() ?>backend/Rules'">Back</button>
                    </div>
                </form>
            </div>                           
        </div> 
        <div class="modal fade text-dark" id="error-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-danger">
                        <?php if ($this->session->flashdata('error_message')){ ?>
                            <div class="row">
                                <div class="col-12"><?= $this->session->flashdata('error_message') ?></div>
                            </div>
                        <?php } ?>
                        <?php if (validation_errors()){ ?>
                            <div class="row">
                                <?= validation_errors() ?>
                            </div>
                        <?php } ?>
                        <div id="error-row" class="row" style="display: none;">
                            <div id="error-col" class="col-12"></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('templates/footer'); ?>      
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script>
        $(document).ready(function(){
            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
    </script>
    <script src="<?= base_url(); ?>assets/js/suneditor.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/suneditor-setting.js"></script>
</body>
</html>