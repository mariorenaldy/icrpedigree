<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Approve Stud</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/backend-modal.css" rel="stylesheet" />
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
                <h3 class="text-center text-primary">Approve Stud</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('approve')){
                            echo 'Stud has been approved<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('error_message')){
                            echo $this->session->flashdata('error_message').'<br/>';
                        }
                        if ($this->session->flashdata('reject')){
                            echo 'Stud has been rejected<br/>';
                        }
                    ?>
                </div>
                <div class="search-container my-3">
                    <form id="formStud" action="<?= base_url().'backend/Studs/search_approve'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Stud date" name="keywords" id="keywords" autocomplete="off" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Search Stud"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row mb-1">
                    <div class="col-md-2"></div>
                    <div class="col-md-2"><b>Photo</b></div>
                    <div class="col-md-2"><b>Sire</b></div>
                    <div class="col-md-2"><b>Dam</b></div>
                    <div class="col-md-2"><b>Date</b></div>
                </div>
                <?php foreach ($stud AS $s){ ?>
                    <div class="row">
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success" onclick="approve(<?= $s->stu_id ?>)" data-toggle="tooltip" data-placement="top" title="Approve"><i class="fa fa-check"></i></button>
                            <button type="button" class="btn btn-danger" onclick="reject(<?= $s->stu_id ?>)" data-toggle="tooltip" data-placement="top" title="Reject"><i class="fa fa-close"></i></button>
                        </div>
                        <div class="col-md-2 mb-1 text-center">
                            <img src="<?= base_url('uploads/stud/'.$s->stu_photo) ?>" class="img-fluid img-thumbnail" alt="Stud" id="stud<?= $s->stu_id ?>" onclick="display('stud<?= $s->stu_id ?>')">
                        </div>
                        <div class="col-md-2 mb-1 text-center">
                            <img src="<?= base_url('uploads/stud/'.$s->stu_sire_photo) ?>" class="img-fluid img-thumbnail" alt="Sire" id="sire<?= $s->stu_id ?>" onclick="display('sire<?= $s->stu_id ?>')">
                            <br/><?= $s->sire_a_s ?>
                        </div>
                        <div class="col-md-2 mb-1 text-center">
                            <img src="<?= base_url('uploads/stud/'.$s->stu_dam_photo) ?>" class="img-fluid img-thumbnail" alt="Dam" id="dam<?= $s->stu_id ?>" onclick="display('dam<?= $s->stu_id ?>')">
                            <br/><?= $s->dam_a_s ?>
                        </div>
                        <div class="col-md-2">
                            <?= $s->stu_stud_date; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>                           
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script>
        function setDatePicker(id) {
            $(id).datepicker({ dateFormat: 'dd-mm-yy' });
            $(id).readOnly = true;
        }
        setDatePicker('#keywords');

        function approve(id){
            var proceed = confirm("Approve pacak ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Studs/approve/"+id;
            }
        }
        function reject(id){
            var proceed = confirm("Reject pacak ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/Studs/reject/"+id;
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

        <?php if ($this->session->flashdata('telp') && $this->session->flashdata('mesg')){ ?>
			mesg = window.encodeURIComponent("<?= $this->session->flashdata('mesg') ?>");
			wa = "https://wa.me/" + <?= $this->session->flashdata('telp') ?> + "?text=" + mesg;
			window.open(wa, "_blank");
	    <?php } ?>

        $(document).ready(function () {
            $('#keywords').on("change", function(){
                $('#formStud').attr('action', "<?= base_url(); ?>backend/Studs/search_approve").submit();
            });
        });
    </script>
</body>
</html>