<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Approve Birth</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center">Approve Birth</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('approve')){
                            echo 'Birth has been approved<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('error')){
                            echo $this->session->flashdata('error').'<br/>';
                        }
                        if ($this->session->flashdata('reject')){
                            echo 'Birth has been rejected<br/>';
                        }
                    ?>
                </div>
                <div class="search-container my-3">
                    <form action="<?= base_url().'backend/Births/search_approve'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Name" name="keywords">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row mb-1">
                    <div class="col-md-3"><b>Photo</b></div>
                    <div class="col-md-2"><b>Date of Birth</b></div>
                    <div class="col-md-1" align="center"><b>Male</b></div>
                    <div class="col-md-1" align="center"><b>Female</b></div>
                    <div class="col-md-2"></div>
                </div>
                <?php foreach ($birth AS $b){ ?>
                    <div class="row">
                        <div class="col-md-3 mb-1">
                            <img src="<?= base_url('uploads/births/'.$b->bir_dam_photo) ?>" class="img-fluid img-thumbnail" alt="canine">
                        </div>
                        <div class="col-md-2">
                            <?= $b->bir_date_of_birth; ?>
                        </div>
                        <div class="col-md-1" align="right">
                            <?= $b->bir_male; ?>
                        </div>
                        <div class="col-md-1" align="right">
                            <?= $b->bir_female; ?>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success" onclick='approve(<?= $b->bir_id ?>, "<?= $b->bir_a_s ?>")'><i class="fa fa-check"></i></button>
                            <button type="button" class="btn btn-danger" onclick='reject(<?= $b->bir_id ?>, "<?= $b->bir_a_s ?>")'><i class="fa fa-close"></i></button>
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
                window.location = "<?= base_url(); ?>backend/Births/approve/"+id;
            }
        }
        function reject(id, nama){
            var proceed = confirm("Reject "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Births/reject/"+id;
            }
        }
    </script>
</body>
</html>