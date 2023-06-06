<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Approve Reset Password</title>
    <?php $this->load->view('templates/head'); ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/backend-modal.css" />
</head>
<body>
<?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center text-primary">Approve Reset Password</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('success')){
                            echo 'email has been send.<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('error_message')){
                            echo $this->session->flashdata('error_message').'<br/>';
                        }
                        if ($this->session->flashdata('reject')){
                            echo 'Reset password has been rejected<br/>';
                        }
                    ?>
                </div>
                <div class="search-container sticky-top">
                    <form action="<?= base_url().'backend/Requestreset/search'?>" method="post">
                        <div class="input-group my-3">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Name/Kennel" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-sm-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Search Kennel"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="1%"></th>
                                <th width="1%"></th>
                                <th>Name</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($request AS $r){ ?>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-success" onclick='approve(<?= $r->req_id; ?>, "<?= $r->mem_name; ?>")' data-toggle="tooltip" data-placement="top" title="Accept Reset password"><i class="fa fa-check"></i></button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick='reject(<?= $r->req_id; ?>, "<?= $r->mem_name; ?>")' data-toggle="tooltip" data-placement="top" title="Reject Reset password"><i class="fa fa-close"></i></button>
                                    </td>
                                    <td>
                                        <?= $r->mem_name.' ('.$r->ken_name.')'; ?>
                                    </td>
                                    <td>
                                        <?= $r->req_date; ?>
                                    </td>
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
                window.location = "<?= base_url(); ?>backend/Requestreset/approve/"+id;
            }
        }
        function reject(id, nama){
            var proceed = window.prompt("Reject "+nama+" ?", "");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Requestreset/reject/"+id+"/"+encodeURI(proceed);
            }
        }
    </script>
</body>
</html>