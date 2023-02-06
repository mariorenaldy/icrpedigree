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
                <div class="row mt-3">
                    <div class="col-md-5"></div>
                    <div class="col-md-2 text-center">
                        <?php if ($canine->can_photo && $canine->can_photo != '-') { ?>
                            <img src="<?= base_url('uploads/canine/'.$canine->can_photo) ?>" class="img-fluid img-thumbnail" alt="canine">
                        <?php } else { ?>
                            <img src="<?= base_url().'assets/img/'.$this->config->item('canine_img') ?>" class="img-fluid img-thumbnail" alt="canine">
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                        <?php if ($canine->can_icr_number && $canine->can_icr_number != '-') { ?>
                            <div class="col-md-6 text-center fs-5 text-danger"><?= $canine->can_a_s ?></div>
                        <?php } else { ?>
                            <div class="col-md-6 text-center fs-5"><?= $canine->can_a_s ?></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">Current Reg. Number</div>
                    <div class="col-md-4">: <?= $canine->can_reg_number ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">ICR Number</div>
                    <div class="col-md-4">: <?= $canine->can_icr_number ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">Chip Number</div>
                    <div class="col-md-4">: <?= $canine->can_chip_number ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">Date of Birth</div>
                    <div class="col-md-4">: <?= $canine->can_date_of_birth ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">Breed</div>
                    <div class="col-md-4">: <?= $canine->can_breed ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">Gender</div>
                    <div class="col-md-4">: <?= $canine->can_gender ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">Color</div>
                    <div class="col-md-4">: <?= $canine->can_color ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">Kennel</div>
                    <div class="col-md-4">: <?= $canine->ken_name ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">Owner</div>
                    <div class="col-md-4">: <?= $canine->mem_name ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">Reg. Date</div>
                    <div class="col-md-4">: <?= $canine->can_reg_date ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">Status</div>
                    <div class="col-md-4">: <?= $canine->stat_name ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">Approved by</div>
                    <div class="col-md-4">: <?= $canine->use_name ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">Approved Date</div>
                    <div class="col-md-4">: <?= $canine->can_app_date ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">Note</div>
                    <div class="col-md-4">: <?= $canine->can_note ?></div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">Sire</div>
                    <div class="col-md-6">: <?= $sire->can_a_s ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">Dam</div>
                    <div class="col-md-6">: <?= $dam->can_a_s ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">Siblings</div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">Male</div>
                    <div class="col-md-6">: <?php
                            $i = 0; 
                            foreach ($male_siblings as $s) {
                                if (!$i)
                                    echo $s->can_a_s; 
                                else
                                    echo ','. $s->can_a_s; 
                                $i++;
                            }
                            if (!$i)
                                echo '-';
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">Female</div>
                    <div class="col-md-4">: <?php
                            $i = 0; 
                            foreach ($female_siblings as $s) {
                                if (!$i)
                                    echo $s->can_a_s; 
                                else
                                    echo ','. $s->can_a_s; 
                                $i++;
                            }
                            if (!$i)
                                echo '-';
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('templates/footer'); ?>
    </div>
    <?php $this->load->view('templates/script'); ?>
</body>
</html>