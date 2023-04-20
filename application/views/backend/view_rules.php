<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Rule List</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                         
                <h3 class="text-center text-primary">Rule List</h3>
                <form action="<?= base_url().'backend/Rules/add' ?>" method="post" class="my-3">	
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                </form>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="1%"></th>
                                <th width="1%"></th>
                                <th>Title</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rules AS $r){ ?>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-success" onclick='update(<?= $r->ru_rule_id; ?>)' data-toggle="tooltip" data-placement="top" title="Edit Rule"><i class="fa fa-edit"></i></button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick='del(<?= $r->ru_rule_id; ?>)' data-toggle="tooltip" data-placement="top" title="Delete Rule"><i class="fa fa-close"></i></button>    
                                    </td>
                                    <td>
                                        <?= $r->ru_title; ?>
                                    </td>
                                    <td>
                                        <?= $r->ru_desc; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
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
        <div class="modal fade text-dark" id="message-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Notification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-success">
                            <?php if ($this->session->flashdata('add_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Rule has been saved</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('edit_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Rule has been edited</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('delete_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Rule has been deleted</div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
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
            var proceed = confirm("Delete rule?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Rules/delete/"+id;
            }
        }

        $(document).ready(function () {
            <?php		
                if ($this->session->flashdata('add_success') || $this->session->flashdata('edit_success') ||
                    $this->session->flashdata('delete_success')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>

            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>
</html>