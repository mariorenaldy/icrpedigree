<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Approve Canine</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center">Approve Canine</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('approve')){
                            echo 'Canine has been approved<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('error')){
                            echo $this->session->flashdata('error').'<br/>';
                        }
                        if ($this->session->flashdata('reject')){
                            echo 'Canine has been rejected<br/>';
                        }
                    ?>
                </div>
                <div class="search-container my-3">
                    <form action="<?= base_url().'backend/Canines/search_approve'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Registration number/Name" name="keywords">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row mb-1">
                    <div class="col-md-2"><b>Photo</b></div>
                    <div class="col-md-2"><b>ICR Number</b></div>
                    <div class="col-md-2"><b>Name</b></div>
                    <div class="col-md-2"></div>
                </div>
                <?php foreach ($canine AS $c){ ?>
                    <div class="row">
                        <div class="col-md-2 mb-1">
                            <?php if ($c->can_photo != '-'){ ?>
                                <img src="<?= base_url('uploads/canine/'.$c->can_photo) ?>" class="img-fluid img-thumbnail" alt="canine">
                            <?php } else{ ?>
                                <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine">
                            <?php } ?>
                        </div>
                        <div class="col-md-2">
                            <?= $c->can_reg_number; ?>
                        </div>
                        <div class="col-md-2">
                            <?= $c->can_a_s; ?>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success" onclick='approve(<?= $c->can_id; ?>, "<?= $c->can_a_s; ?>")'><i class="fa fa-check"></i></button>
                            <button type="button" class="btn btn-danger" onclick='reject(<?= $c->can_id; ?>, "<?= $c->can_a_s; ?>")'><i class="fa fa-close"></i></button>
                        </div>
                    </div>
                <?php } ?>
            </div>                           
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script>
        function approve(id, nama){
            var proceed = confirm("Approve "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Canines/approve_canine/"+id;
            }
        }
        function reject(id, nama){
            var proceed = confirm("Tolak "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Canines/reject_canine/"+id;
            }
        }
    </script>
</body>
</html>