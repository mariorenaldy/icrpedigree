<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List Kennel</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
<?php $this->load->view('frontend/layout/header_member'); ?> 
<?php $this->load->view('frontend/layout/navbar'); ?>
    <div class="container mt-5" style="margin-bottom: 10vh;">
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center">List Kennel</h3>
                <div class="text-success mb-3">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'Kennel berhasil disimpan<br/>';
                        }
                    ?>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-light" onclick="add()"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-md-2"><b>Foto</b></div>
                    <div class="col-md-2"><b>Format Penamaan</b></div>
                    <div class="col-md-2"><b>Kennel</b></div>
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
                            <!-- <button type="button" class="btn btn-light"><i class="fa fa-bars" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modal-update-canines"><i class="fa fa-pencil-square-o"></i></button>
                            <button type="button" class="btn btn-light"><i class="fa fa-file-o" aria-hidden="true"></i></button> -->
                        </div>
                    </div>
                <?php } ?>
            </div>                           
        </div> 
    </div>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script>
        function add(){
            window.location = "<?= base_url(); ?>frontend/Kennels/add";
        }
    </script>
</body>
</html>