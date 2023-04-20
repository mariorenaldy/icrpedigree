<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>News</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                         
                <h3 class="text-center text-primary">News</h3>
                <?= $this->pagination->create_links(); ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="1%"></th>
                                <th width="1%"></th>
                                <th>Date</th>
                                <th>Title</th>
                                <th width="15%">Photo</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($news AS $r){ ?>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-success" onclick='update(<?= $r->news_id; ?>)' data-toggle="tooltip" data-placement="top" title="Edit News"><i class="fa fa-edit"></i></button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick='del(<?= $r->news_id; ?>)' data-toggle="tooltip" data-placement="top" title="Delete News"><i class="fa fa-close"></i></button>    
                                    </td>
                                    <td class="text-nowrap">
                                        <?= $r->date; ?>
                                    </td>
                                    <td>
                                        <?= $r->title; ?>
                                    </td>
                                    <td>
                                        <?php if ($r->type == $this->config->item('stud')){ ?>
                                            <img src="<?= base_url().'uploads/stud/'.$r->photo ?>" class="img-fluid img-thumbnail" id="stud<?= $r->news_id ?>" onclick="display('stud<?= $r->news_id ?>')">
                                        <?php } else if ($r->type == $this->config->item('birth')){ ?>
                                            <img src="<?= base_url().'uploads/births/'.$r->photo ?>" class="img-fluid img-thumbnail" id="birth<?= $r->news_id ?>" onclick="display('birth<?= $r->news_id ?>')">
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?= $r->description; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <br/>
                    <?= $this->pagination->create_links(); ?>
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
                            <?php if ($this->session->flashdata('edit_success')){ ?>
                                <div class="row">
                                    <div class="col-12">News has been edited</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('delete_success')){ ?>
                                <div class="row">
                                    <div class="col-12">News has been deleted</div>
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
            window.location = "<?= base_url(); ?>backend/News/edit/"+id;
        }
        function del(id){
            var proceed = confirm("Delete news?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/News/delete/"+id;
            }
        }

        $(document).ready(function () {
            <?php		
                if ($this->session->flashdata('edit_success') || $this->session->flashdata('delete_success')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>

            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>
</html>