<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Anjing Saya</title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/backend-modal.css" />
</head>
<body class="text-white text-break">
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImg">
</div>
<?php $this->load->view('frontend/layout/header_non_paid'); ?> 
<?php $this->load->view('frontend/layout/navbar'); ?>
    <div class="container">
        <div class="row">            
            <div class="col-sm-12">                          
                <h3 class="text-center text-warning">Anjing Saya</h3>
                <div class="text-success mb-3">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'Anjing berhasil disimpan<br/>';
                        }
                    ?>
                </div>
                <div class="search-container">
                    <form action="<?= base_url().'frontend/Canines/search'?>" method="post">
                        <div class="input-group my-3">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="No. ICR/Nama" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-sm-1 ms-1">
                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Cari Anjing"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row my-3">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-warning" onclick="add()" data-toggle="tooltip" data-placement="top" title="Tambah Generasi Satu"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-1"><b>Foto</b></div>
                    <div class="col-sm-2"><b>Nama</b></div>
                    <div class="col-sm-2"><b>Deskripsi</b></div>
                    <div class="col-sm-2"><b>Kennel</b></div>
                    <div class="col-sm-2"><b>Owner</b></div>
                    <div class="col-sm-1"><b>Status</b></div>
                    <div class="col-sm-2"></div>
                </div>
                <?php foreach ($canines AS $c){ ?>
                    <div class="row">
                        <div class="col-sm-1 mb-1">
                            <?php if ($c->can_photo != '-'){ ?>
                                <img src="<?= base_url('uploads/canine/'.$c->can_photo) ?>" class="img-fluid img-thumbnail" alt="canine" id="myImg<?= $c->can_id ?>" onclick="display('myImg<?= $c->can_id ?>')">
                            <?php } else{ ?>
                                <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine" id="myImg<?= $c->can_id ?>" onclick="display('myImg<?= $c->can_id ?>')">
                            <?php } ?>
                        </div>
                        <div class="col-sm-2">
                            <?php 
                                echo $c->can_a_s.'<br/>'; 
                                if ($c->can_icr_number) 
                                    echo $c->can_icr_number; 
                                else 
                                    echo $c->can_reg_number; 
                            ?>
                        </div>
                        <div class="col-sm-2">
                            <?php 
                                echo $c->can_breed.'<br/>';
                                echo $c->can_gender.'<br/>';
                                echo $c->can_color; 
                            ?>
                        </div>
                        <div class="col-sm-2">
                            <?= $c->ken_name; ?>
                        </div>
                        <div class="col-sm-2">
                            <?= $c->mem_name; ?>
                        </div>
                        <div class="col-sm-1">
                            <?php echo $c->stat_name; ?>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-info mb-1" onclick="detail(<?= $c->can_id ?>)" data-toggle="tooltip" data-placement="top" title="Detil"><i class="fa fa-dog"></i></button>
                            <button type="button" class="btn btn-primary mb-1" onclick="pedigree(<?= $c->can_id ?>)" data-toggle="tooltip" data-placement="top" title="Pedigree"><i class="fas fa-book-open"></i></button>
                            <button type="button" class="btn btn-success mb-1" onclick="edit_owner(<?= $c->can_id ?>)" data-toggle="tooltip" data-placement="top" title="Ubah Pemilik"><i class="fa fa-edit" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-light mb-1" onclick="edit_canine(<?= $c->can_id ?>)" data-bs-toggle="modal" data-placement="top" title="Ubah Foto Anjing"><i class="fa fa-image"></i></button>
                            <!-- <button type="button" class="btn btn-light"><i class="fa fa-file-o" aria-hidden="true"></i></button> -->
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
        function pedigree(id){
            window.location = "<?= base_url(); ?>frontend/Certificate/index/"+id;
        }
        function edit_owner(id){
            window.location = "<?= base_url(); ?>frontend/Requestownershipcanine/add/"+id;
        }
        function edit_canine(id){
            window.location = "<?= base_url(); ?>frontend/Requestupdatecanine/add/"+id;
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