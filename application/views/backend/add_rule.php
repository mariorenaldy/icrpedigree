<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Add Rule</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>assets/css/suneditor.min.css" rel="stylesheet" />
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">  
                <h3 class="text-center">Add Rule</h3>                        
                <form class="form-horizontal" action="<?= base_url(); ?>backend/Rules/validate_add" method="post" onsubmit="save();">
                    <div class="text-danger">
                        <?php		
                            if ($this->session->flashdata('add_error')){
                                echo $this->session->flashdata('add_error').'<br/>';
                            }
                            echo validation_errors().'<br/>';
                        ?>
                    </div>
                    <div class="input-group mb-3">
                        <label for="title" class="control-label col-md-1">Title: </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="<?= set_value('title'); ?>" placeholder="Title" aria-label="title" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="password" class="control-label col-md-1">Rule: </label>
                        <div class="col-md-10">
                            <textarea class="form-control" rows="10" name="rule" id="rule"><?= set_value('rule'); ?></textarea>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger" onclick="window.location = '<?= base_url() ?>backend/Rules'"><i class="fa fa-close"></i></button>
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