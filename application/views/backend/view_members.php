<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Kennel List</title>
    <?php $this->load->view('templates/head'); ?>
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datatables.min.css" /> -->
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center text-primary">Kennel List</h3>
                <div class="search-container my-3">
                    <form id="formMember" action="<?= base_url().'backend/Members/search'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-6">    
                                <input type="text" class="form-control" placeholder="Name / Phone number / Kennel / KTP number" name="keywords" value="<?= $keywords ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Search Kennel"><i class="fa fa-search"></i></button>
                            </div>
                            <label for="mem_type" class="col-md-1 my-2 text-center">Type: </label>
                            <div class="col-md-1 my-1 text-end">
                                <?php
                                    $type[$this->config->item('pro_member')] = 'Pro';
                                    $type[$this->config->item('all_member')] = 'All';  
                                    $type[$this->config->item('free_member')] = 'Free';
                                    echo form_dropdown('mem_type', $type, $mem_type, 'class="form-control", id="mem_type"');
                            ?>
                            </div>
                        </div>
                    <!-- </form> -->
                </div>
                <!-- <form action="<?= base_url().'backend/Members/search'?>" method="post"> -->
                <div class="input-group">
                        <label class="col-md-1">Sort by: </label>
                        <div class="col-md-2">
                            <?php
                                $pil['mem_app_date2'] = 'Updated Date';
                                $pil['ken_name'] = 'Kennel';
                                $pil['mem_name'] = 'Name';
                                echo form_dropdown('sort_by', $pil, $sort_by, 'class="form-control"'); 
                            ?>
                        </div>
                        <div class="col-md-1 ms-1">
                            <?php
                                $pil2['desc'] = 'Desc';
                                $pil2['asc'] = 'Asc';
                                echo form_dropdown('sort_type', $pil2, $sort_type, 'class="form-control"'); 
                            ?>
                        </div>
                        <div class="col-md-1 ms-1">
                            <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sort Canine"><i class="fa fa-sort"></i></button>
                        </div>
                    </div>
                </form>
                <div class="row my-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" onclick="add()" data-toggle="tooltip" data-placement="top" title="Add Kennel"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <?= $this->pagination->create_links(); ?>
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="no-sort"></th>
                                <th class="no-sort"></th>
                                <th>Kennel</th>
                                <th class="no-sort">Username</th>
                                <th>Name</th>
                                <th class="no-sort">Phone Number</th>
                                <th class="no-sort">Reg. Date</th>
                                <th class="no-sort">Mail Address</th>
                                <th class="no-sort">Address</th>
                                <th class="no-sort">City</th>
                                <th class="no-sort">Postal Code</th>
                                <th>KTP</th>
                                <th class="no-sort">email</th>
                                <th class="no-sort">Type</th>
                                <th class="no-sort">Last Login</th>
                                <th class="no-sort">Status</th>
                                <th style="display: none;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 0;  
                                foreach ($member AS $m){ 
                                    if ($m->mem_id) { ?>
                                    <tr>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-success mb-1" onclick="edit(<?= $m->mem_id ?>)" data-toggle="tooltip" data-placement="top" title="Edit Member"><i class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-warning mb-1" onclick="resetPass(<?= $m->mem_id ?>)" data-toggle="tooltip" data-placement="top" title="Reset Password"><i class="fa fa-refresh"></i></button>
                                            <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                                                <button type="button" class="btn btn-dark mb-1" onclick="log(<?= $m->mem_id ?>)" data-toggle="tooltip" data-placement="top" title="Kennel Log"><i class="fa fa-history"></i></button>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($this->session->userdata('use_type_id') == $this->config->item('super') && $m->mem_stat != $this->config->item('rejected')){ ?>
                                            <button type="button" class="btn btn-danger mb-1" onclick="del(<?= $m->mem_id ?>, '<?= $m->mem_name ?>')" data-toggle="tooltip" data-placement="top" title="Delete Member"><i class="fa fa-trash"></i></button>
                                            <?php }
                                                if ($m->mem_type == $this->config->item('free_member')){ ?>
                                                <button type="button" class="btn btn-primary mb-1" onclick="payment(<?= $m->mem_id ?>, '<?= $m->mem_name ?>')" data-toggle="tooltip" data-placement="top" title="Payment"><i class="fas fa-money-bill"></i></button>
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $m->ken_name;
                                            if ($m->mem_type == $this->config->item('pro_member')){ 
                                                echo ' <i class="fa fa-check"></i>';
                                            } 
                                        ?></td>
                                        <td><?= $m->mem_username; ?></td>
                                        <td><?= $m->mem_name; ?></td>
                                        <td><?= $m->mem_hp; ?></td>
                                        <td class="text-nowrap"><?= $m->mem_created_at; ?></td>
                                        <td><?= $m->mem_mail_address; ?></td>
                                        <td><?= $m->mem_address; ?></td>
                                        <td><?= $m->mem_kota; ?></td>
                                        <td><?= $m->mem_kode_pos; ?></td>
                                        <td><?= $m->mem_ktp; ?></td>
                                        <td><?= $m->mem_email; ?></td>
                                        <td><?php if ($m->mem_type == $this->config->item('pro_member')) 
                                                echo 'Pro<br/>'.$m->use_username.' (<span class="text-nowrap">'.$m->mem_app_date.'</span>)';
                                            else 
                                                echo 'Free'; 
                                            ?></td>
                                        <td class="text-nowrap"><?= $m->last_login; ?></td>
                                        <td><?= $m->stat_name.'<br/>'.$m->use_username.' (<span class="text-nowrap">'.$m->mem_date.'</span>)'; ?></td>
                                        <td style="display: none;"><?= $m->mem_app_date2; ?></td>
                                    </tr>
                                    <?php $i++; 
                                } 
                            }?>
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
                                    <div class="col-12">Kennel has been saved</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('edit_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Kennel has been edited</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('delete_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Kennel has been deleted</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('payment_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Kennel's payment has been saved</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('reset_password')){ ?>
                                <div class="row">
                                    <div class="col-12">Password has been reset</div>
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
            window.location = "<?= base_url(); ?>backend/Members/add";
        }
        function edit(id){
            window.location = "<?= base_url(); ?>backend/Members/edit/"+id;
        }
        function del(id, nama){
            var proceed = window.prompt("Delete "+nama+" ?", "");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Members/delete/"+id+"/"+encodeURI(proceed);
            }
        }
        function payment(id, nama){
            var proceed = confirm("Set payment for "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Members/payment/"+id;
            }
        }
        function resetPass(id){
            window.location = "<?= base_url(); ?>backend/Members/view_reset/"+id;
        }
        function log(id){
            window.location = "<?= base_url(); ?>backend/Members/log/"+id;
        }

        $(document).ready(function () {
        //     $('#datatable').DataTable({searching: false, info: false, "ordering": true, order: [[15, 'desc']], dom: 'lpftrip',
        //         columnDefs: [{
        //             orderable: false,
        //             targets: "no-sort"
        //         }]
        //     });
            $('#mem_type').on("change", function(){
                $('#formMember').attr('action', "<?= base_url(); ?>backend/Members/search").submit();
            });

            <?php		
                if ($this->session->flashdata('add_success') || $this->session->flashdata('edit_success') ||
                    $this->session->flashdata('delete_success') || $this->session->flashdata('payment_success') || 
                    $this->session->flashdata('reset_password')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>

            <?php if ($this->session->flashdata('delete_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });

        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
    <!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script> -->
</body>
</html>