<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Canine Detail</title>
    <?php $this->load->view('templates/head'); ?>
</head>

<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center text-primary">Canine Detail</h3>
                <div class="text-danger">
                    <?php
                    if ($this->session->flashdata('error_message')) {
                        echo $this->session->flashdata('error_message') . '<br/>';
                    }
                    ?>
                </div>
                <div class="mx-auto" style="width: 500px;">
                    <div class="me-1" style="display: inline-block;">
                        <?php if ($canine->can_photo && $canine->can_photo != '-') { ?>
                            <img src="<?= base_url('uploads/canine/' . $canine->can_photo) ?>" id="myImg" class="img-fluid img-thumbnail" alt="canine" style="width:270px;height:auto;">
                        <?php } else { ?>
                            <img src="<?= base_url() . 'assets/img/' . $this->config->item('canine_img') ?>" id="myImg" class="img-fluid img-thumbnail" alt="canine">
                        <?php } ?>
                    </div>
                    <div class="align-middle" style="display: inline-block;">
                        <?php if ($canine->can_icr_number && $canine->can_icr_number != '-') { ?>
                            <p class="text-center fs-4 red"><?= $canine->can_a_s ?></p>
                        <?php } else { ?>
                            <p class="text-center fs-4 black"><?= $canine->can_a_s ?></p>
                        <?php } ?>
                        <p><?= $canine->can_breed; ?></p>
                        <p><?= $canine->can_gender; ?></p>
                        <p><?= $canine->can_color; ?></p>
                    </div>
                </div>
                <div class="container mx-auto mb-3" style="width: 500px;">
                    <div class="row gx-0">
                        <div class="col-4">
                            <p>Current Reg. Number</p>
                        </div>
                        <div class="col-1 text-center">:</div>
                        <div class="col"><?= $canine->can_reg_number ?></div>
                    </div>
                    <div class="row gx-0">
                        <div class="col-4">
                            <p>ICR Number</p>
                        </div>
                        <div class="col-1 text-center">:</div>
                        <div class="col"><?= $canine->can_icr_number ?></div>
                    </div>
                    <div class="row gx-0">
                        <div class="col-4">
                            <p>Chip Number</p>
                        </div>
                        <div class="col-1 text-center">:</div>
                        <div class="col">
                            <?= $canine->can_chip_number ?>
                        </div>
                    </div>
                    <div class="row gx-0">
                        <div class="col-4">
                            <p>Date of Birth</p>
                        </div>
                        <div class="col-1 text-center">:</div>
                        <div class="col">
                            <?= $canine->can_date_of_birth ?>
                        </div>
                    </div>
                    <div class="row gx-0">
                        <div class="col-4">
                            <p>Owner</p>
                        </div>
                        <div class="col-1 text-center">:</div>
                        <div class="col">
                            <?= $canine->mem_name ?>
                        </div>
                    </div>
                    <div class="row gx-0">
                        <div class="col-4">
                            <p>Kennel</p>
                        </div>
                        <div class="col-1 text-center">:</div>
                        <div class="col">
                            <?= $canine->ken_name ?>
                        </div>
                    </div>
                </div>
                <div class="container mx-auto" style="width: 500px;">
                    <div class="row gx-0">
                        <div class="col-4">
                            <p>Sire</p>
                        </div>
                        <div class="col-1 text-center">:</div>
                        <?php if (!empty($sire)) { ?>
                            <div class="col"><?= $sire->can_a_s; ?></div>
                        <?php } else { ?>
                            <div class="col">-</div>
                        <?php } ?>
                    </div>
                    <div class="row gx-0">
                        <div class="col-4">
                            <p>Dam</p>
                        </div>
                        <div class="col-1 text-center">:</div>
                        <div class="col">
                            <?php if (!empty($dam)) { ?>
                                <div class="col"><?= $dam->can_a_s; ?></div>
                            <?php } else { ?>
                                <div class="col">-</div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row gx-0">
                        <div class="col-4">
                            <p>Siblings</p>
                        </div>
                        <div class="col-1 text-center">:</div>
                        <div class="col">
                            <?php if (!empty($siblings)) { ?>
                                <?php foreach ($siblings as $s) { ?>
                                    <p><?= $s->can_a_s; ?></p>
                                <?php } ?>
                            <?php } else { ?>
                                <p>-</p>
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>backend/Canines'">Back</button>
                </div>
            </div>
        </div>
        <?php $this->load->view('templates/footer'); ?>
    </div>
    <?php $this->load->view('templates/script'); ?>
</body>

</html>