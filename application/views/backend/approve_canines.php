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
                <h3 class="text-center text-primary">Approve Canine</h3>
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
                                <input type="text" class="form-control" placeholder="Registration number/Chip number/Name" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Current Reg. Number</th>
                                <th>ICR Number</th>
                                <th>Chip Number</th>
                                <th>Name</th>
                                <th>Breed</th>
                                <th>Gender</th>
                                <th>Color</th>
                                <th>Date of Birth</th>
                                <th>Kennel</th>
                                <th>Owner</th>
                                <th>Reg. Date</th>
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($canine AS $c){ ?>
                                <tr>
                                    <td>
                                        <?php if ($c->can_photo && $c->can_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/canine/'.$c->can_photo) ?>" class="img-fluid img-thumbnail" alt="canine">
                                        <?php } else{ ?>
                                            <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine">
                                        <?php } ?>
                                    </td>
                                    <td><?= $c->can_reg_number; ?></td>
                                    <td><?= $c->can_icr_number; ?></td>
                                    <td><?= $c->can_chip_number; ?></td>
                                    <td><?= $c->can_a_s; ?></td>
                                    <td><?= $c->can_breed; ?></td>
                                    <td><?= $c->can_gender; ?></td>
                                    <td><?= $c->can_color; ?></td>
                                    <td class="text-nowrap"><?= $c->can_date_of_birth; ?></td>
                                    <td><?= $c->ken_name; ?></td>
                                    <td><?= $c->mem_name; ?></td>
                                    <td class="text-nowrap"><?= $c->can_reg_date; ?></td>
                                    <td><button type="button" class="btn btn-success" onclick='approve(<?= $c->can_id; ?>, "<?= $c->can_a_s; ?>")' data-toggle="tooltip" data-placement="top" title="Accept Canine"><i class="fa fa-check"></i></button></td>
                                    <td><button type="button" class="btn btn-danger" onclick='reject(<?= $c->can_id; ?>, "<?= $c->can_a_s; ?>")' data-toggle="tooltip" data-placement="top" title="Reject Canine"><i class="fa fa-close"></i></button></td>
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