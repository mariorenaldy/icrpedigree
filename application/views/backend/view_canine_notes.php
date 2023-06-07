<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Canine Notes</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center text-primary">Canine Notes</h3>
                <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                    <div class="row my-3">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary" onclick="add()"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                <?php } ?>
                <div class="row mt-3">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">Name</div>
                    <div class="col-md-4">: <?= $canine->can_a_s ?></div>
                </div>
                <br/>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="1%"></th>
                                <th width="1%"></th>
                                <th>Date</th>
                                <th>Note</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($note AS $r){ ?>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-success mb-1" onclick="update(<?= $r->note_id ?>)" data-toggle="tooltip" data-placement="top" title="Edit Note"><i class="fa fa-pencil"></i></button>
                                    </td>
                                    <td>
                                        <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                                        <button type="button" class="btn btn-danger mb-1" onclick="del(<?= $r->note_id ?>)" data-toggle="tooltip" data-placement="top" title="Delete Note"><i class="fa fa-trash"></i></button>
                                        <button type="button" class="btn btn-dark mb-1" onclick="log(<?= $r->note_id ?>)" data-toggle="tooltip" data-placement="top" title="Note Log"><i class="fa fa-history"></i></button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?= $r->note_date; ?>
                                    </td>
                                    <td>
                                        <?= $r->note_desc; ?>
                                    </td>
                                    <td>
                                        <?= $r->use_username; ?>
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
                        <?php if ($this->session->flashdata('delete_message')){ ?>
                            <div class="row">
                                <div class="col-12"><?= $this->session->flashdata('delete_message') ?></div>
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
                                    <div class="col-12">Note has been saved</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('edit_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Note has been changed</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('delete_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Note has been deleted</div>
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
        function add(){
            window.location = "<?= base_url(); ?>backend/Caninenote/add/"+<?= $canine->can_id ?>;
        }
        function update(id){
            window.location = "<?= base_url(); ?>backend/Caninenote/edit/"+id;
        }
        function del(id){
            var proceed = confirm("Delete?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Caninenote/delete/<?= $canine->can_id ?>/"+id;
            }
        }
        function log(id){
            window.location = "<?= base_url(); ?>backend/Caninenote/log/<?= $canine->can_id ?>/"+id;
        }

        $(document).ready(function () {
            <?php		
                if ($this->session->flashdata('add_success') || $this->session->flashdata('edit_success') ||
                    $this->session->flashdata('delete_success')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>

            <?php if ($this->session->flashdata('delete_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>
</html>