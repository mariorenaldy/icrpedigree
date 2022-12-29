<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Canine List</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center">Canine List</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'Canine has been saved<br/>';
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
                    <form action="<?= base_url().'backend/Canines/search'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="ICR number/Name" name="keywords">
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
                            <?= $c->can_icr_number; ?>
                        </div>
                        <div class="col-md-2">
                            <?= $c->can_a_s; ?>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary" onclick='print(<?= $c->can_id; ?>)'><i class="fa fa-print"></i></button>
                        </div>
                    </div>
                <?php } ?>
            </div>                           
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script>
        function add(){
            window.location = "<?= base_url(); ?>backend/Canines/add";
        }
        function print(id){
            window.location = "<?= base_url(); ?>backend/Certificate/front/"+id;
        }
    </script>
</body>
</html>