<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Edit Pedigree</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <main class="container">
        <?php $this->load->view('templates/header'); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-items-center">
                    <h3 class="text-center text-primary">Edit Pedigree</h3>  
                    <form id="formPedigree" class="form-horizontal" method="post" action="<?php echo base_url(); ?>backend/Canines/validate_edit_pedigree">
                        <div class="text-danger">
                            <?php
                            if ($this->session->flashdata('error_message')) {
                                echo $this->session->flashdata('error_message') . '<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <div class="input-group my-3">
                            <label class="control-label col-md-2">Nama Canine</label>
                            <div class="col-md-10"><?= $canine->can_a_s ?></div>
                        </div>
                        <div class="input-group my-3">
                            <label class="control-label col-md-2">Sire Name</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" placeholder="Sire Name" name="sire_a_s" value="<?php echo set_value('sire_a_s'); ?>">
                            </div>
                            <div class="col-md-1 text-end">
                                <button id="buttonSireSearch" class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="stu_sire_id" class="control-label col-md-2">Sire</label>
                            <div class="col-md-10">
                                <?php
                                    $pil = [];
                                    foreach ($sire as $row) {
                                        $pil[$row->can_id] = $row->can_a_s;
                                    }
                                    if (!$mode){
                                        echo '<input type="hidden" name="ped_canine_id" value='.$ped->ped_canine_id.' />';
                                        echo form_dropdown('ped_sire_id', $pil, $ped->ped_sire_id, 'class="form-control"');
                                    }
                                    else{
                                        echo '<input type="hidden" name="ped_canine_id" value='.set_value('ped_canine_id').' />';
                                        echo form_dropdown('ped_sire_id', $pil, set_value('ped_sire_id'), 'class="form-control"');
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="can_a_s" class="control-label col-md-2">Dam Name</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" placeholder="Dam Name" name="dam_a_s" value="<?= set_value('dam_a_s'); ?>">
                            </div>
                            <div class="col-md-1 text-end">
                                <button id="buttonDamSearch" class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="stu_dam_id" class="control-label col-md-2">Dam</label>
                            <div class="col-md-10">
                                <?php
                                    $opt = [];
                                    foreach ($dam as $row) {
                                        $opt[$row->can_id] = $row->can_a_s;
                                    }
                                    if (!$mode)
                                        echo form_dropdown('ped_dam_id', $opt, $ped->ped_dam_id, 'class="form-control"');
                                    else
                                        echo form_dropdown('ped_dam_id', $opt, set_value('ped_dam_id'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="text-center">
                            <button id="buttonSubmit" class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>backend/Canines'">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php $this->load->view('templates/footer'); ?>
    </main>
    <?php $this->load->view('templates/script'); ?>
    <script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script>
        $('#buttonSireSearch').on("click", function(e) {
            e.preventDefault();
            $('#formPedigree').attr('action', "<?= base_url(); ?>backend/Canines/search_pedigree").submit();
        });

        $('#buttonDamSearch').on("click", function(e) {
            e.preventDefault();
            $('#formPedigree').attr('action', "<?= base_url(); ?>backend/Canines/search_pedigree").submit();
        });

        $('#buttonSubmit').on("click", function(e) {
            e.preventDefault();
            $('#formPedigree').attr('action', "<?= base_url(); ?>backend/Canines/validate_edit_pedigree").submit();
        });
    </script>
</body>

</html>