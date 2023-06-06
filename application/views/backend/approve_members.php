<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Approve Kennel</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center text-primary">Approve Kennel</h3>
                <div class="search-container my-3 sticky-top">
                    <form action="<?= base_url().'backend/Members/search_approve'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-6">    
                                <input type="text" class="form-control" placeholder="Name/Phone number/Kennel" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Search Kennel"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th colspan="2"></th>
                                <th>Kennel</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Reg. Date</th>
                                <th>Mail Address</th>
                                <th>Certificate Address</th>
                                <th>City</th>
                                <th>Postal Code</th>
                                <th>KTP</th>
                                <th>email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 0;  
                                foreach ($member AS $m){ 
                                    if ($m->mem_id) { ?>
                                    <tr>
                                        <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                                            <td><button type="button" class="btn btn-success" onclick="approve(<?= $m->mem_id ?>, '<?= $m->mem_name ?>')" data-toggle="tooltip" data-placement="top" title="Approve Kennel"><i class="fa fa-check"></i></button></td>
                                            <td><button type="button" class="btn btn-danger" onclick="reject(<?= $m->mem_id ?>, '<?= $m->mem_name ?>')" data-toggle="tooltip" data-placement="top" title="Reject Kennel"><i class="fa fa-close"></i></button></td>
                                        <?php } else { ?>
                                            <td></td>
                                            <td></td>
                                        <?php } ?>
                                        <td><?= $m->ken_name ?></td>
                                        <td><?= $m->mem_name; ?></td>
                                        <td><?= $m->mem_hp; ?></td>
                                        <td class="text-nowrap"><?= $m->mem_created_at; ?></td>
                                        <td><?= $m->mem_address; ?></td>
                                        <td><?= $m->mem_mail_address; ?></td>
                                        <td><?= $m->mem_kota; ?></td>
                                        <td><?= $m->mem_kode_pos; ?></td>
                                        <td><?= $m->mem_ktp; ?></td>
                                        <td><?= $m->mem_email; ?></td>
                                    </tr>
                                <?php $i++; 
                                } 
                            } ?>
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
                        <?php if ($this->session->flashdata('reject')){ ?>
                            <div class="row">
                                <div class="col-12">Kennel has been rejected</div>
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
                            <?php if ($this->session->flashdata('approve')){ ?>
                                <div class="row">
                                    <div class="col-12">Kennel has been approved</div>
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
        function approve(id, nama){
            var proceed = confirm("Approve "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Members/approve/"+id;
            }
        }
        function reject(id, nama){
            var proceed = window.prompt("Reject "+nama+" ?", "");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Members/reject/"+id+"/"+encodeURI(proceed);
            }
        }

        $(document).ready(function(){
            <?php		
                if ($this->session->flashdata('approve')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>

            <?php if ($this->session->flashdata('error_message') || validation_errors() || $this->session->flashdata('reject')){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });

        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>