<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Product Type List</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center text-primary">Product Type List</h3>
                <?php if ($this->session->userdata('use_type_id') == $this->config->item('stock_manager')){ ?>
                    <div class="row my-3">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary" onclick="add()"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                <?php } ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="1%"></th>
                                <th width="1%"></th>
                                <th>Product Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($product_types AS $pt){ ?>
                                <tr>
                                    <td>
                                    <?php if ($this->session->userdata('use_type_id') == $this->config->item('stock_manager')){ ?>
                                        <button type="button" class="btn btn-success mb-1" onclick="update(<?= $pt->pro_type_id ?>)" data-toggle="tooltip" data-placement="top" title="Edit Product Type"><i class="fa fa-pencil"></i></button>
                                    <?php } ?>
                                    </td>
                                    <td>
                                        <?php 
                                            if ($this->session->userdata('use_type_id') == $this->config->item('stock_manager')){ 
                                                if (!$pt->pro_type_stat){ ?>
                                                    <button type="button" class="btn btn-primary mb-1" onclick="activate(<?= $pt->pro_type_id ?>, '<?= $pt->pro_type_name ?>')" data-toggle="tooltip" data-placement="top" title="Activate Product Type"><i class="fa fa-check"></i></button>
                                        <?php } else { ?>
                                                    <button type="button" class="btn btn-danger mb-1" onclick="del(<?= $pt->pro_type_id ?>, '<?= $pt->pro_type_name ?>')" data-toggle="tooltip" data-placement="top" title="Delete Product Type"><i class="fa fa-trash"></i></button>
                                        <?php }
                                        } ?>
                                    </td>
                                    <td>
                                        <?= $pt->pro_type_name; ?>
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
                                    <div class="col-12">Product Type has been saved</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('edit_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Product Type has been edited</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('delete_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Product Type has been deleted</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('activate_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Product Type has been activated</div>
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
            window.location = "<?= base_url(); ?>marketplace/Product_Type/add";
        }
        function update(id){
            window.location = "<?= base_url(); ?>marketplace/Product_Type/edit/"+id;
        }
        function del(id, nama){
            var proceed = confirm("Delete "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>marketplace/Product_Type/delete/"+id;
            }
        }
        function activate(id, nama){
            var proceed = confirm("Activate "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>marketplace/Product_Type/activate/"+id;
            }
        }

        $(document).ready(function () {
            <?php		
                if ($this->session->flashdata('add_success') || $this->session->flashdata('edit_success') ||
                    $this->session->flashdata('delete_success') || $this->session->flashdata('activate_success')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>

            <?php if ($this->session->flashdata('delete_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>
</html>