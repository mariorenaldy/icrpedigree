<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Klaim Canine</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_member'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <div class="container">
            <h3 class="text-center text-warning">Klaim Canine</h3>
            <div class="row">            
                <div class="col-md-12 align-items-center">                          
                    <form id="formCanine" class="form-horizontal" action="<?php echo base_url(); ?>frontend/Canines/validate_claim_canine" method="post">
                        <div class="text-success">
                            <?php		
                                if ($this->session->flashdata('claim_success')){
                                    echo 'Klaim canine berhasil disimpan.<br/>Hubungi Admin untuk mendapatkan approval.<br/>';
                                }
                            ?>
                        </div>
                        <div class="text-danger">
                            <?php		
                            if ($this->session->flashdata('error_message')){
                                echo $this->session->flashdata('error_message').'<br/>';
                            }
                            ?>
                        </div>
                        <div class="input-group mb-3">
                            <label for="ken_name" class="control-label col-md-2">Nama Canine</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" placeholder="Nama Canine" name="can_a_s" value="<?= set_value('can_a_s'); ?>">
                            </div>
                            <div class="col-md-1 text-end">
                                <button id="buttonSearch" class="btn btn-warning" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Canine</label>
                            <div class="col-md-10">
                                <?php
                                    $can = [];
                                    foreach($canines as $row){
                                        $can[$row->can_id] = $row->can_a_s;
                                    }
                                    echo form_dropdown('can_id', $can, set_value('can_id'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-5">
                            <label class="control-label col-md-2">Kennel</label>
                            <div class="col-md-10">
                                <?php
                                    $ken = [];
                                    foreach($kennel as $row){
                                        $ken[$row->ken_id] = $row->ken_name;
                                    }
                                    echo form_dropdown('ken_id', $ken, set_value('ken_id'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary btn-lg" type="submit">Simpan</button>
                            <button class="btn btn-danger btn-lg" type="button" onclick="window.location = '<?= base_url() ?>frontend/Dashboard'">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script>
        $('#buttonSearch').on("click", function(e){
            e.preventDefault();
            $('#formCanine').attr('action', "<?= base_url(); ?>frontend/Canines/validate_canine").submit();
        });
    </script>
</body>
</html>

