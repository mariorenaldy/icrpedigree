<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Kennel List</title>
    <?php $this->load->view('templates/head'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datatables.min.css" />
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center text-primary">Kennel List</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'Kennel has been saved<br/>';
                        }
                        if ($this->session->flashdata('edit_success')){
                            echo 'Kennel has been edited<br/>';
                        }
                        if ($this->session->flashdata('delete_success')){
                            echo 'Kennel has been deleted<br/>';
                        }
                        if ($this->session->flashdata('payment_success')){
                            echo 'Kennel\'s payment has been saved<br/>';
                        }
                        if ($this->session->flashdata('reset_password')){
                            echo 'Password has been reset<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('error_message')){
                            echo $this->session->flashdata('error_message').'<br/>';
                        }
                    ?>
                </div>
                <div class="search-container my-3">
                    <form action="<?= base_url().'backend/Members/search'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-6">    
                                <input type="text" class="form-control" placeholder="Name/Address/Phone number" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-md-1 my-1 text-end">
                                <label for="mem_type">Type:</label>
                            </div>
                            <div class="col-md-1 ms-1">
                            <?php
                                $type[$this->config->item('all_member')] = 'All'; 
                                $type[$this->config->item('free_member')] = 'Free'; 
                                $type[$this->config->item('pro_member')] = 'Pro'; 
                                echo form_dropdown('mem_type', $type, set_value('mem_type'), 'class="form-control"');
                            ?>
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" onclick="add()"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>KTP</th>
                                <th>Name</th>
                                <th class="no-sort">Address</th>
                                <th class="no-sort">Mail Address</th>
                                <th class="no-sort">City</th>
                                <th class="no-sort">Postal Code</th>
                                <th class="no-sort">Phone Number</th>
                                <th>Kennel</th>
                                <th class="no-sort">Type</th>
                                <th class="no-sort">email</th>
                                <th class="no-sort">Reg. Date</th>
                                <th class="no-sort">Username</th>
                                <th style="display: none;"></th>
                                <th style="display: none;"></th>
                                <th style="display: none;"></th>
                                <th style="display: none;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 0;  
                                foreach ($member AS $m){ ?>
                                <tr>
                                    <td><?= $m->mem_ktp; ?></td>
                                    <td><?= $m->mem_name; ?></td>
                                    <td><?= $m->mem_address; ?></td>
                                    <td><?= $m->mem_mail_address; ?></td>
                                    <td><?= $m->mem_kota; ?></td>
                                    <td><?= $m->mem_kode_pos; ?></td>
                                    <td><?= $m->mem_hp; ?></td>
                                    <td><?php
                                    foreach ($kennel[$i] AS $k){
                                        echo '<div>'.$k->ken_name.'</div>';
                                    }  
                                    ?></td>
                                    <td><?php if ($m->mem_type == $this->config->item('pro_member')) 
                                            echo 'Pro<br/>'.$m->use_name.' (<span class="text-nowrap">'.$m->mem_app_date.'</span>)';
                                        else 
                                            echo 'Free'; 
                                        ?></td>
                                    <td><?= $m->mem_email; ?></td>
                                    <td class="text-nowrap"><?= $m->mem_created_at; ?></td>
                                    <td><?= $m->mem_username; ?></td>
                                    <td><button type="button" class="btn btn-success mb-1" onclick="edit(<?= $m->mem_id ?>)" data-toggle="tooltip" data-placement="top" title="Edit Member"><i class="fa fa-edit"></i></button></td>
                                    <td><button type="button" class="btn btn-danger mb-1" onclick="del(<?= $m->mem_id ?>, '<?= $m->mem_name ?>')" data-toggle="tooltip" data-placement="top" title="Delete Member"><i class="fa fa-close"></i></button></td>
                                    <td><button type="button" class="btn btn-warning mb-1" onclick="resetPass(<?= $m->mem_id ?>)" data-toggle="tooltip" data-placement="top" title="Reset Password"><i class="fa fa-refresh"></i></button></td>
                                    <td><?php if ($m->mem_type == $this->config->item('free_member')){ ?>
                                        <button type="button" class="btn btn-primary mb-1" onclick="payment(<?= $m->mem_id ?>, '<?= $m->mem_name ?>')" data-toggle="tooltip" data-placement="top" title="Payment"><i class="fa fa-money"></i></button>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php $i++; 
                            } ?>
                        </tbody>
                    </table>
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
            var proceed = confirm("Delete "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Members/delete/"+id;
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
        $(document).ready(function () {
            $('#datatable').DataTable({searching: false, info: false, "ordering": true, order: [[1, 'asc']],
                columnDefs: [{
                    orderable: false,
                    targets: "no-sort"
                }]
            });
        });
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script>
</body>
</html>