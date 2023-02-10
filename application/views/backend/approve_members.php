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
                <h3 class="text-center text-primary">Approve Kennel</h3>
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
                            echo 'Kennel has been rejected<br/>';
                        }
                    ?>
                </div>
                <div class="search-container my-3">
                    <form action="<?= base_url().'backend/Members/search_approve'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-6">    
                                <input type="text" class="form-control" placeholder="Name/Address/Phone number/Kennel" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Search Kennel"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th colspan="2"></th>
                                <th>Kennel</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Reg. Date</th>
                                <th>Mail Address</th>
                                <th>Certificate Address</th>
                                <th>City</th>
                                <th>Postal Code</th>
                                <th>KTP</th>
                                <th>email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 0;  
                                foreach ($member AS $m){ 
                                    if ($m->mem_id) { ?>
                                    <tr>
                                        <td><button type="button" class="btn btn-success" onclick="approve(<?= $m->mem_id ?>, '<?= $m->mem_name ?>')" data-toggle="tooltip" data-placement="top" title="Approve Kennel"><i class="fa fa-check"></i></button></td>
                                        <td><button type="button" class="btn btn-danger" onclick="reject(<?= $m->mem_id ?>, '<?= $m->mem_name ?>')" data-toggle="tooltip" data-placement="top" title="Reject Kennel"><i class="fa fa-close"></i></button></td>
                                        <td><?php
                                        foreach ($kennel[$i] AS $k){
                                            echo '<div>'.$k->ken_name.'</div>';
                                        }  
                                        ?></td>
                                        <td><?= $m->mem_name; ?></td>
                                        <td><?= $m->mem_hp; ?></td>
                                        <td class="text-nowrap"><?= $m->mem_created_at; ?></td>
                                        <td><?= $m->mem_address; ?></td>
                                        <td><?= $m->mem_mail_address; ?></td>
                                        <td><?= $m->mem_kota; ?></td>
                                        <td><?= $m->mem_kode_pos; ?></td>
                                        <td><?= $m->mem_ktp; ?></td>
                                        <td><?= $m->mem_email; ?></td>
                                    </tr>
                                <?php $i++; 
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
        function approve(id, nama){
            var proceed = confirm("Approve "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Members/approve/"+id;
            }
        }
        function reject(id, nama){
            var proceed = confirm("Reject "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Members/reject/"+id;
            }
        }
    </script>
</body>
</html>