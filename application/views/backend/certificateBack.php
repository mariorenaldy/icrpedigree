<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Back Certificate</title>
  <?php $this->load->view('templates/head'); ?>
  <link href="<?php echo base_url(); ?>assets/css/tree-styles.css" rel="stylesheet" />
</head>
<body>
  <?php $this->load->view('templates/redirect'); ?>
  <div>
    <div id="wrapper"><span class="label">
        <figure>
          <img src="<?= base_url().$this->config->item('path_canine').$canine->can_photo ?>" class="img-fluid img-thumbnail" alt="canine" style="width: 15vw;">
        </figure>
        <p class="text-center fs-5" style="font-weight:700; color: #e62225;"><?= $canine->can_a_s ?></p>
        <p>ICR Number: <?= $canine->can_icr_number ?></p>
        <p>Breed: <?= $canine->can_breed ?></p>
        <p>Gender: <?= $canine->can_gender ?></p>
        <p>Color: <?= $canine->can_color ?></p>
        <p>Date of Birth: <?= $canine->can_date_of_birth ?></p>
        <p>Microchip: <?= $canine->can_chip_number ?></p>
        <p>Breeder: <?= $canine->mem_name ?></p>
      </span>
      <div class="branch lv1">
        <div class="entry"><span class="label">
            <p class="text-center fs-5" style="font-weight:700; color: #e62225;"><?php if ($dam) echo $dam->can_a_s; ?></p>
            <p><?php if ($dam) echo $dam->can_icr_number; ?></p>
          </span>
          <div class="branch lv2">
            <div class="entry"><span class="label">
                <p class="text-center fs-5" style="font-weight:700; color: #e62225;"><?php if ($dam21) echo $dam21->can_a_s; ?></p>
                <p><?php if ($dam21) echo $dam21->can_icr_number; ?></p>
              </span>
              <div class="branch lv3">
                <div class="entry"><span class="label">
                    <p class="text-center fs-5" style="font-weight:700; color: #e62225;"><?php if ($dam32) echo $dam32->can_a_s; ?></p>
                    <p><?php if ($dam32) echo $dam32->can_icr_number; ?></p>
                  </span></div>
                <div class="entry"><span class="label">
                    <p class="text-center fs-5" style="font-weight:700; color: #e62225;"><?php if ($sire32) echo $sire32->can_a_s; ?></p>
                    <p><?php if ($sire32) echo $sire32->can_icr_number; ?></p>
                </span></div>
              </div>
            </div>  
            <div class="entry"><span class="label">
                <p class="text-center fs-5" style="font-weight:700; color: #e62225;"><?php if ($sire21) echo $sire21->can_a_s; ?></p>
                <p><?php if ($sire21) echo $sire21->can_icr_number; ?></p>
              </span>
              <div class="branch lv3">
                <div class="entry"><span class="label">
                    <p class="text-center fs-5" style="font-weight:700; color: #e62225;"><?php if ($dam31) echo $dam31->can_a_s; ?></p>
                    <p><?php if ($dam31) echo $dam31->can_icr_number; ?></p>
                </span></div>
                <div class="entry"><span class="label">
                  <p class="text-center fs-5" style="font-weight:700; color: #e62225;"><?php if ($sire31) echo $sire31->can_a_s; ?></p>
                  <p><?php if ($sire31) echo $sire31->can_icr_number; ?></p>
                </span></div>
              </div>
            </div>
          </div>
        </div>
          <div class="entry"><span class="label">
            <p class="text-center fs-5" style="font-weight:700; color: #e62225;"><?php if ($sire) echo $sire->can_a_s; ?></p>
            <p><?php if ($sire) echo $sire->can_icr_number; ?></p>
          </span>
          <div class="branch lv2">
            <div class="entry"><span class="label">
                <p class="text-center fs-5" style="font-weight:700; color: #e62225;"><?php if ($dam22) echo $dam22->can_a_s; ?></p>
                <p><?php if ($dam22) echo $dam22->can_icr_number; ?></p>
              </span>
              <div class="branch lv3">
                <div class="entry"><span class="label">
                    <p class="text-center fs-5" style="font-weight:700; color: #e62225;"><?php if ($dam34) echo $dam34->can_a_s; ?></p>
                    <p><?php if ($dam34) echo $dam34->can_icr_number; ?></p>
                  </span></div>
                <div class="entry"><span class="label">
                    <p class="text-center fs-5" style="font-weight:700; color: #e62225;"><?php if ($sire34) echo $sire34->can_a_s; ?></p>
                    <p><?php if ($sire34) echo $sire34->can_icr_number; ?></p>
                  </span></div>
              </div>
            </div>
            <div class="entry"><span class="label">
                <p class="text-center fs-5" style="font-weight:700; color: #e62225;"><?php if ($sire22) echo $sire22->can_a_s; ?></p>
                <p><?php if ($sire22) echo $sire22->can_icr_number; ?></p>
              </span>
              <div class="branch lv3">
                <div class="entry"><span class="label">
                    <p class="text-center fs-5" style="font-weight:700; color: #e62225;"><?php if ($dam33) echo $dam33->can_a_s; ?></p>
                    <p><?php if ($dam33) echo $dam33->can_icr_number; ?></p>
                  </span></div>
                <div class="entry"><span class="label">
                    <p class="text-center fs-5" style="font-weight:700; color: #e62225;"><?php if ($sire33) echo $sire33->can_a_s; ?></p>
                    <p><?php if ($sire33) echo $sire33->can_icr_number; ?></p>
                  </span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('templates/script'); ?>
</body>
</html>