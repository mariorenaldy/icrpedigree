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
                                <input type="text" class="form-control" placeholder="Name/Address/Phone number" name="keywords">
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
                <div class="row mb-1">
                    <div class="col-md-2"><b>KTP</b></div>
                    <div class="col-md-2"><b>Name</b></div>
                    <div class="col-md-2"><b>Address</b></div>
                    <div class="col-md-2"><b>Phone Number</b></div>
                    <div class="col-md-2"><b>Type</b></div>
                    <div class="col-md-2"></div>
                </div>
                <?php foreach ($member AS $m){ 
                    if ($m->mem_stat){ ?>
                        <div class="row">
                            <div class="col-md-2 mb-1">
                                <img src="<?= base_url('uploads/members/'.$m->mem_photo) ?>" class="img-fluid img-thumbnail" alt="KTP">
                            </div>
                            <div class="col-md-2">
                                <?= $m->mem_name; ?>
                            </div>
                            <div class="col-md-2">
                                <?= $m->mem_address; ?>
                            </div>
                            <div class="col-md-2">
                                <?= $m->mem_hp; ?>
                            </div>
                            <div class="col-md-2">
                                <?php if ($m->mem_stat == 1) echo 'Paid'; else echo 'Non Paid'; ?>
                            </div>
                            <div class="col-md-2">
                                <?php if ($m->mem_stat == 2){ ?>
                                    <button type="button" class="btn btn-primary" onclick="payment(<?= $m->mem_id ?>, '<?= $m->mem_name ?>')"><i class="fa fa-money"></i></button>
                                <?php } ?>
                                <!-- <button type="button" class="btn btn-danger" onclick="reject(<?= $m->mem_id ?>, '<?= $m->mem_name ?>')"><i class="fa fa-close"></i></button> -->
                            </div>
                        </div>
                <?php 
                        } 
                    } ?>
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
    </script>
</body>
</html>