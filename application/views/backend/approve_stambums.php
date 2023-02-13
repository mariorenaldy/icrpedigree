<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Approve Child Registration</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center text-primary">Approve Child Registration</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('approve')){
                            echo 'Child Registration has been approved<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('error_message')){
                            echo $this->session->flashdata('error_message').'<br/>';
                        }
                        if ($this->session->flashdata('reject')){
                            echo 'Child Registration has been rejected<br/>';
                        }
                    ?>
                </div>
                <div class="search-container my-3">
                    <form action="<?= base_url().'backend/Stambums/search_approve'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Name/Kennel" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Search Stambum"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Breed</th>
                                <th>Gender</th>
                                <th>Date of Birth</th>
                                <th>Kennel</th>
                                <th>Owner</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stambum AS $r){ ?>
                                <tr>
                                    <td><button type="button" class="btn btn-success" onclick='approve(<?= $r->stb_id; ?>, "<?= $r->stb_a_s; ?>")' data-toggle="tooltip" data-placement="top" title="Accept Canine"><i class="fa fa-check"></i></button></td>
                                    <td><button type="button" class="btn btn-danger" onclick='reject(<?= $r->stb_id; ?>, "<?= $r->stb_a_s; ?>")' data-toggle="tooltip" data-placement="top" title="Reject Canine"><i class="fa fa-close"></i></button></td>
                                    <td>
                                        <?php if ($r->stb_photo && $r->stb_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/canine/'.$r->stb_photo) ?>" class="img-fluid img-thumbnail" alt="canine">
                                        <?php } else{ ?>
                                            <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine">
                                        <?php } ?>
                                    </td>
                                    <td><?= $r->stb_a_s; ?></td>
                                    <td><?= $r->stb_breed; ?></td>
                                    <td><?= $r->stb_gender; ?></td>
                                    <td class="text-nowrap"><?= $r->stb_date_of_birth; ?></td>
                                    <td><?= $r->ken_name; ?></td>
                                    <td><?= $r->mem_name; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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
                window.location = "<?= base_url(); ?>backend/Stambums/approve/"+id;
            }
        }
        function reject(id, nama){
            var proceed = confirm("Reject "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Stambums/reject/"+id;
            }
        }
    </script>
</body>
</html>