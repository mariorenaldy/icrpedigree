<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Approve Export Stambum</title>
    <?php $this->load->view('templates/head'); ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/backend-modal.css" />
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
                <h3 class="text-center text-primary">Approve Export Stambum</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('approve')){
                            echo 'Export stambum has been approved<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('error_message')){
                            echo $this->session->flashdata('error_message').'<br/>';
                        }
                        if ($this->session->flashdata('reject')){
                            echo 'Export stambum has been rejected<br/>';
                        }
                    ?>
                </div>
                <div class="search-container sticky-top">
                    <form action="<?= base_url().'backend/Requestexport/search'?>" method="post">
                        <div class="input-group my-3">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Member/Kennel" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-sm-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Search Canine"><i class="fa fa-search"></i></button>
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
                                <th width="15%">Canine Photo</th>
                                <th width="15%">Stambum Photo</th>
                                <th>Owner</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($req AS $r){ ?>
                                <tr>
                                    <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                                        <td>
                                            <button type="button" class="btn btn-success" onclick='approve(<?= $r->req_id; ?>)' data-toggle="tooltip" data-placement="top" title="Accept Export Stambum"><i class="fa fa-check"></i></button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" onclick='reject(<?= $r->req_id; ?>)' data-toggle="tooltip" data-placement="top" title="Reject Export Stambum"><i class="fa fa-close"></i></button>
                                        </td>
                                    <?php } else { ?>
                                        <td></td>
                                        <td></td>
                                    <?php } ?>
                                    <td>
                                        <img src="<?= base_url('uploads/canine/'.$r->req_can_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="canImg<?= $r->req_id ?>" onclick="display('canImg<?= $r->req_id ?>')">
                                    </td>
                                    <td>
                                        <img src="<?= base_url('uploads/export/'.$r->req_stb_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="stbImg<?= $r->req_id ?>" onclick="display('stbImg<?= $r->req_id ?>')">
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
        function approve(id){
            var proceed = confirm("Approve ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Requestexport/approve/"+id;
            }
        }
        function reject(id, nama){
            var proceed = window.prompt("Reject ?", "");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Requestexport/reject/"+id+"/"+encodeURI(proceed);
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
    </script>
</body>
</html>