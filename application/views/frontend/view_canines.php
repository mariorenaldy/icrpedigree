<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List Canine</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
<?php $this->load->view('frontend/layout/header_member'); ?> 
<?php $this->load->view('frontend/layout/navbar'); ?>
    <div class="container">
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center text-warning">List Canine</h3>
                <div class="text-success mb-3">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'Canine berhasil disimpan<br/>';
                        }
                    ?>
                </div>
                <div class="search-container">
                    <form action="<?= base_url().'frontend/Canines/search'?>" method="post">
                        <div class="input-group my-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="No. ICR/Nama" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-warning" onclick="add()"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-md-2"><b>Foto</b></div>
                    <div class="col-md-2"><b>Nomor ICR</b></div>
                    <div class="col-md-2"><b>Nama</b></div>
                    <div class="col-md-2"><b>Kennel</b></div>
                    <div class="col-md-2"><b>Owner</b></div>
                    <div class="col-md-1"><b>Status</b></div>
                    <div class="col-md-1"></div>
                </div>
                <?php foreach ($canines AS $c){ ?>
                    <div class="row">
                        <div class="col-md-2 mb-1">
                            <?php if ($c->can_photo != '-'){ ?>
                                <img src="<?= base_url('uploads/canine/'.$c->can_photo) ?>" class="img-fluid img-thumbnail" alt="canine">
                            <?php } else{ ?>
                                <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine">
                            <?php } ?>
                        </div>
                        <div class="col-md-2">
                            <?php echo $c->can_icr_number; ?>
                        </div>
                        <div class="col-md-2">
                            <?php echo $c->can_a_s; ?>
                        </div>
                        <div class="col-md-2">
                            <?= $c->ken_name; ?>
                        </div>
                        <div class="col-md-2">
                            <?= $c->mem_name; ?>
                        </div>
                        <div class="col-md-1">
                            <?php echo $c->stat_name; ?>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-info mb-1" onclick="detail(<?= $c->can_id ?>)" data-toggle="tooltip" data-placement="top" title="Canine Detail"><i class="fa fa-file-o"></i></button>
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
            window.location = "<?= base_url(); ?>frontend/Canines/add";
        }
        function detail(id){
            window.location = "<?= base_url(); ?>frontend/Canines/view_detail/"+id;
        }
    </script>
</body>
</html>