<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Approve Stud</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center">Approve Stud</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('approve')){
                            echo 'Stud has been approved<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('error')){
                            echo $this->session->flashdata('error').'<br/>';
                        }
                        if ($this->session->flashdata('reject')){
                            echo 'Stud has been rejected<br/>';
                        }
                    ?>
                </div>
                <div class="search-container my-3">
                    <form action="<?= base_url().'backend/Studs/search_approve'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Stud date" name="keywords" id="keywords" autocomplete="off">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row mb-1">
                    <div class="col-md-2"><b>Photo</b></div>
                    <div class="col-md-2"><b>Sire</b></div>
                    <div class="col-md-2"><b>Dam</b></div>
                    <div class="col-md-2"><b>Date</b></div>
                    <div class="col-md-2"></div>
                </div>
                <?php foreach ($stud AS $s){ ?>
                    <div class="row">
                        <div class="col-md-2 mb-1">
                            <img src="<?= base_url('uploads/stud/'.$s->stu_photo) ?>" class="img-fluid img-thumbnail" alt="Stud">
                        </div>
                        <div class="col-md-2 mb-1">
                            <img src="<?= base_url('uploads/stud/'.$s->stu_sire_photo) ?>" class="img-fluid img-thumbnail" alt="Sire">
                            <br/><?= $s->sire_a_s ?>
                        </div>
                        <div class="col-md-2 mb-1">
                            <img src="<?= base_url('uploads/stud/'.$s->stu_dam_photo) ?>" class="img-fluid img-thumbnail" alt="Dam">
                            <br/><?= $s->dam_a_s ?>
                        </div>
                        <div class="col-md-2">
                            <?= $s->stu_stud_date; ?>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success" onclick="approve(<?= $s->stu_id ?>)"><i class="fa fa-check"></i></button>
                            <button type="button" class="btn btn-danger" onclick="reject(<?= $s->stu_id ?>)"><i class="fa fa-close"></i></button>
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
    </script>
</body>
</html>