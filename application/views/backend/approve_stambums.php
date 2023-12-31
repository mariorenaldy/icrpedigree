<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Approve Puppy</title>
    <?php $this->load->view('templates/head'); ?>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/backend-modal.css" />
</head>
<body>
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImg">
    </div>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center text-primary">Approve Puppy</h3>
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
                                <th style="width: 10%">Birth Photo</th>
                                <th style="width: 10%">Photo</th>
                                <th>Name</th>
                                <th>Breed</th>
                                <th>Gender</th>
                                <th>Date of Birth</th>
                                <th>Kennel</th>
                                <th>Owner</th>
                                <th>Payment Method</th>
                                <th>DOKU Invoice</th>
                                <th style="width: 10%">Payment Proof</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stambum AS $r){ ?>
                                <tr>
                                    <td><button type="button" class="btn btn-success" onclick='approve(<?= $r->stb_id; ?>, "<?= $r->stb_a_s; ?>")' data-toggle="tooltip" data-placement="top" title="Accept Canine"><i class="fa fa-check"></i></button></td>
                                    <td><button type="button" class="btn btn-danger" onclick='reject(<?= $r->stb_id; ?>, "<?= $r->stb_a_s; ?>")' data-toggle="tooltip" data-placement="top" title="Reject Canine"><i class="fa fa-close"></i></button></td>
                                    <td>
                                        <img src="<?= base_url('uploads/births/'.$r->bir_dam_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="birth<?= $r->stb_id ?>" onclick="display('birth<?= $r->stb_id ?>')">
                                    </td>
                                    <td>
                                        <?php if ($r->stb_photo && $r->stb_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/canine/'.$r->stb_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="myImg<?= $r->stb_id ?>" onclick="display('myImg<?= $r->stb_id ?>')">
                                        <?php } else{ ?>
                                            <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine" id="myImg<?= $r->stb_id ?>" onclick="display('myImg<?= $r->stb_id ?>')">
                                        <?php } ?>
                                    </td>
                                    <td><?= $r->stb_a_s; ?></td>
                                    <td><?= $r->stb_breed; ?></td>
                                    <td><?= $r->stb_gender; ?></td>
                                    <td class="text-nowrap"><?= $r->stb_date_of_birth; ?></td>
                                    <td><?= $r->ken_name; ?></td>
                                    <td><?= $r->mem_name; ?></td>
                                    <td><?= $r->pay_name; ?></td>
                                    <td><?= $r->stb_pay_invoice; ?></td>
                                    <td>
                                        <?php if ($r->stb_pay_photo && $r->stb_pay_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/payment/'.$r->stb_pay_photo) ?>" class="img-fluid img-thumbnail" alt="payment" id="myProof<?= $r->stb_id ?>" onclick="display('myProof<?= $r->stb_id ?>')">
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>                           
        </div> 
        <div class="modal fade text-dark" id="error-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-danger">
                        <?php if ($this->session->flashdata('error_message')){ ?>
                            <div class="row">
                                <div class="col-12"><?= $this->session->flashdata('error_message') ?></div>
                            </div>
                        <?php } ?>
                        <?php if (validation_errors()){ ?>
                            <div class="row">
                                <?= validation_errors() ?>
                            </div>
                        <?php } ?>
                        <?php if ($this->session->flashdata('reject')){ ?>
                            <div class="row">
                                <div class="col-12">Puppy has been rejected</div>
                            </div>
                        <?php } ?>
                        <div id="error-row" class="row" style="display: none;">
                            <div id="error-col" class="col-12"></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="message-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Notification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-success">
                            <?php if ($this->session->flashdata('approve')){ ?>
                                <div class="row">
                                    <div class="col-12">Puppy has been approved</div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                        </div>
                    </div>
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
            var proceed = window.prompt("Reject "+nama+" ?", "");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Stambums/reject/"+id+"?reason="+encodeURI(proceed);
            }
        }

        var modal = document.getElementById("myModal");
        function display(id){
            var img = document.getElementById(id);
            var modalImg = document.getElementById("modalImg");
            modal.style.display = "block";
            modalImg.src = img.src;
        }

        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
            modal.style.display = "none";
        }

        $(document).ready(function(){
            <?php		
                if ($this->session->flashdata('approve')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>

            <?php if ($this->session->flashdata('error_message') || validation_errors() || $this->session->flashdata('reject')){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });

        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>