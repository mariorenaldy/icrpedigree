<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List Lahir</title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_member'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <div class="container">
        <div class="row">            
            <div class="col-sm-12">                          
                <h3 class="text-center text-warning">List Lahir</h3>
                <div class="text-success mb-3">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'Lahir berhasil disimpan<br/>';
                        }
                    ?>
                </div>
                <div class="search-container">
                    <form id="formBirth" action="<?= base_url().'frontend/Births/search'?>" method="post">
                        <div class="input-group my-3">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" placeholder="Tanggal lahir" name="keywords" id="keywords" autocomplete="off" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-sm-1 ms-1">
                                <button type="submit" class="btn btn-warning"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="Cari Lahir"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row my-3">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-warning" onclick="add()" data-toggle="tooltip" data-placement="top" title="Lapor Lahir"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-2 text-center"><b>Foto</b></div>
                    <div class="col-sm-2"><b>DOB</b></div>
                    <div class="col-sm-1 text-center"><b>Jumlah Jantan</b></div>
                    <div class="col-sm-1 text-center"><b>Jumlah Betina</b></div>
                    <div class="col-sm-2"><b>Status</b></div>
                    <div class="col-sm-2"></div>
                </div>
                <?php 
                    $i = 0;
                    foreach ($births AS $b){ 
                        if ($b){ ?>
                            <div class="row">
                                <div class="col-sm-2 mb-1">
                                    <img src="<?= base_url('uploads/births/'.$b->bir_dam_photo) ?>" class="img-fluid img-thumbnail" alt="canine">
                                </div>
                                <div class="col-sm-2">
                                    <?= $b->bir_date_of_birth; ?>
                                </div>
                                <div class="col-sm-1" align="right">
                                    <?= $b->bir_male; ?>
                                </div>
                                <div class="col-sm-1" align="right">
                                    <?= $b->bir_female; ?>
                                </div>
                                <div class="col-sm-2">
                                    <?= $b->stat_name; ?>
                                </div>
                                <div class="col-sm-2">
                                <?php if ($b->bir_stat == $this->config->item('accepted') && $stambum_stat[$i]){ ?>
                                        <button type="button" class="btn btn-primary mb-1" onclick="addStambum(<?= $b->bir_id ?>)" data-toggle="tooltip" data-placement="top" title="Lapor Anak"><i class="fa fa-plus"></i> Anak</button>
                                <?php } ?>
                                </div>
                            </div>
                        <?php }
                        $i++;
                    } ?>
            </div>                           
        </div> 
    </div>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script>
        function setDatePicker(id) {
            $(id).datepicker({ dateFormat: 'dd-mm-yy' });
            $(id).readOnly = true;
        }
        setDatePicker('#keywords');
        function add(){
            window.location = "<?= base_url(); ?>frontend/Studs/view";
        }
        function addStambum(birthId){
            window.location = "<?= base_url(); ?>frontend/Stambums/add/"+birthId;
        }
        $(document).ready(function () {
            $('#keywords').on("change", function(){
                $('#formBirth').attr('action', "<?= base_url(); ?>frontend/Births/search").submit();
            });
        });
    </script>
</body>
</html>