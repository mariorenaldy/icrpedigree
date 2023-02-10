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
                <h3 class="text-center">Approve Kennel</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('approve')){
                            echo 'Kennel has been approved<br/>';
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
                    <form action="<?= base_url().'backend/Kennels/search_approve'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Member Name/Kennel Name" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row mb-1">
                    <div class="col-md-2"><b>Photo</b></div>
                    <div class="col-md-2"><b>Formatted Name</b></div>
                    <div class="col-md-2"><b>Kennel Name</b></div>
                    <div class="col-md-2"><b>Member Name</b></div>
                    <div class="col-md-2"></div>
                </div>
                <?php foreach ($kennel AS $k){ ?>
                    <div class="row">
                        <div class="col-md-2 mb-1">
                            <?php if ($k->ken_photo != '-'){ ?>
                                <img src="<?= base_url('uploads/kennels/'.$k->ken_photo) ?>" class="img-fluid img-thumbnail" alt="kennel">
                            <?php } else{ ?>
                                <img src="<?= base_url('assets/img/avatar.jpg') ?>" class="img-fluid img-thumbnail" alt="kennel">
                            <?php } ?>
                        </div>
                        <div class="col-md-2">
                            <?php echo $k->ken_type_name; ?>
                        </div>
                        <div class="col-md-2">
                            <?php echo $k->ken_name; ?>
                        </div>
                        <div class="col-md-2">
                            <?php echo $k->mem_name; ?>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success" onclick='approve(<?= $k->ken_id; ?>, "<?= $k->ken_name; ?>")'><i class="fa fa-check"></i></button>
                            <button type="button" class="btn btn-danger" onclick='reject(<?= $k->ken_id; ?>, "<?= $k->ken_name; ?>")'><i class="fa fa-close"></i></button>
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
                window.location = "<?= base_url(); ?>backend/Kennels/approve/"+id;
            }
        }
        function reject(id, nama){
            var proceed = confirm("Tolak "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Kennels/reject/"+id;
            }
        }
    </script>
</body>
</html>