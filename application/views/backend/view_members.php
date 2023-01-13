<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Member List</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center">Member List</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'Member has been saved<br/>';
                        }
                        if ($this->session->flashdata('payment_success')){
                            echo 'Member\'s payment has been saved<br/>';
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
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>KTP</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Type</th>
                                <th></th>
                                <th>id</th>
                                <th>mail_address</th>
                                <th>photo</th>
                                <th>created_at</th>
                                <th>app_user</th>
                                <th>app_date</th>
                                <th>username</th>
                                <th>password</th>
                                <th>email</th>
                                <th>pp</th>
                                <th>kota</th>
                                <th>kode_pos</th>
                                <th>firebase_token</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($member AS $m){
                                if ($m->mem_stat){ ?>
                                <tr>
                                    <td>
                                        <img src="<?= base_url('uploads/members/'.$m->mem_photo) ?>" class="img-fluid img-thumbnail" alt="KTP">
                                    </td>
                                    <td><?= $m->mem_name; ?></td>
                                    <td><?= $m->mem_address; ?></td>
                                    <td><?= $m->mem_hp; ?></td>
                                    <td><?php if ($m->mem_stat == 1) echo 'Paid'; else echo 'Non Paid'; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning" onclick="resetPass(<?= $m->mem_id ?>)"><i class="fa fa-refresh"></i></button>
                                        <?php if ($m->mem_stat == 2){ ?>
                                            <button type="button" class="btn btn-primary" onclick="payment(<?= $m->mem_id ?>, '<?= $m->mem_name ?>')"><i class="fa fa-money"></i></button>
                                        <?php } ?>
                                    </td>
                                    <td><?= $m->mem_id; ?></td>
                                    <td><?= $m->mem_mail_address; ?></td>
                                    <td>
                                        <?php if ($m->mem_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/members/'.$m->mem_photo) ?>" class="img-fluid img-thumbnail" alt="member">
                                        <?php } else{ ?>
                                            -
                                        <?php } ?>
                                    </td>
                                    <td><?= $m->mem_created_at; ?></td>
                                    <td><?= $m->mem_app_user; ?></td>
                                    <td><?= $m->mem_app_date; ?></td>
                                    <td><?= $m->mem_username; ?></td>
                                    <td><?= $m->mem_password; ?></td>
                                    <td><?= $m->mem_email; ?></td>
                                    <td><?= $m->mem_pp; ?></td>
                                    <td><?= $m->mem_kota; ?></td>
                                    <td><?= $m->mem_kode_pos; ?></td>
                                    <td><?= $m->mem_firebase_token; ?></td>
                                </tr>
                                <?php 
                                } 
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
        function payment(id, nama){
            var proceed = confirm("Set payment for "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Members/payment/"+id;
            }
        }
        function resetPass(id){
            window.location = "<?= base_url(); ?>backend/Members/view_reset/"+id;
        }
    </script>
</body>
</html>