<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Back Certificate</title>
  <?php $this->load->view('templates/head'); ?>
  <link href="<?= base_url(); ?>assets/css/tree-styles.css" rel="stylesheet" />
</head>
<body>
  <?php $this->load->view('templates/redirect'); ?>
  <div>
    <div id="wrapper"> 
      <div class="bg-container"></div>
      <br/><br/>
      <span class="label" id="main">
        <p class="fs-5 text-center"><?= $canine->can_breed ?></p>
        <?php if ($canine->can_photo && $canine->can_photo != '-'){ ?>
          <figure class="text-center">
            <img src="<?= base_url().$this->config->item('path_canine').$canine->can_photo ?>" class="img-fluid canine" alt="canine">
          </figure>
        <?php } else { ?>
          <div class="imgReplacement"></div>
        <?php } ?>
        <?php if ($canine->can_icr_number && $canine->can_icr_number != '-') { ?>
          <p class="text-center fs-4 red"><?= $canine->can_a_s ?></p>
        <?php } else { ?>
          <p class="text-center fs-4 black"><?= $canine->can_a_s ?></p>
        <?php } ?>
        <div class="container">
          <div class="row gx-0">
            <div class="col-4">
              <p>ICR Number</p>
            </div>
            <div class="col-1 text-center">:</div>
            <div class="col"><?= $canine->can_icr_number ?></div>
          </div>
          <div class="row gx-0">
            <div class="col-4">
              <p>Gender</p>
            </div>
            <div class="col-1 text-center">:</div>
            <div class="col">
              <?= $canine->can_gender ?>
            </div>
          </div>
          <div class="row gx-0">
            <div class="col-4">
              <p>Color</p>
            </div>
            <div class="col-1 text-center">:</div>
            <div class="col">
              <?= $canine->can_color ?>
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
              <p>ICR Microchip</p>
            </div>
            <div class="col-1 text-center">:</div>
            <div class="col">
              <?= $canine->can_chip_number ?>
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
          <div class="row gx-0">
            <div class="col-4">
              <p>Address</p>
            </div>
            <div class="col-1 text-center">:</div>
            <div class="col">
              <?= $canine->mem_mail_address ?>
            </div>
          </div>
        </div>
      </span>
      <div class="branch lv1">
        <div class="entry" style=""><span class="label">
          <?php if ($sire && $sire->can_icr_number && $sire->can_icr_number != '-') { ?>
            <p class="fs-7">Sire:</p>
            <?php if (strlen($sire->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 red">'; else echo '<p class="fs-7 red">'; echo $sire->can_a_s.'</p>'; ?>
            <p class="fs-7"><?= $sire->can_icr_number; ?></p>
            <p class="fs-7"><?= $sire->can_color; ?></p>
          <?php } else if ($sire) { ?>
            <p class="fs-7">Sire:</p>
            <?php if (strlen($sire->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 black">'; else echo '<p class="fs-7 black">'; echo $sire->can_a_s.'</p>'; ?>
            <p class="fs-7"><?= $sire->can_icr_number; ?></p>
            <p class="fs-7"><?= $sire->can_color; ?></p>
          <?php } else { ?>
            <p class="fs-7"></p>
            <p class="fs-7"></p>
            <p class="fs-7"></p>
            <p class="fs-7"></p>
          <?php } ?>
          </span>
          <div class="branch lv2">
            <div class="entry"><span class="label">
              <?php if ($sire21 && $sire21->can_icr_number && $sire21->can_icr_number != '-') { ?>
                <p class="fs-7">Sire:</p>
                <?php if (strlen($sire21->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 red">'; else echo '<p class="fs-7 red">'; echo $sire21->can_a_s.'</p>'; ?>
                <p class="fs-7"><?= $sire21->can_icr_number; ?></p>
                <p class="fs-7"><?= $sire21->can_color; ?></p>
              <?php } else if ($sire21) { ?>
                <p class="fs-7">Sire:</p>
                <?php if (strlen($sire21->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 black">'; else echo '<p class="fs-7 black">'; echo $sire21->can_a_s.'</p>'; ?>
                <p class="fs-7"><?= $sire21->can_icr_number; ?></p>
                <p class="fs-7"><?= $sire21->can_color; ?></p>
              <?php } else { ?>
                <p class="fs-7"></p>
                <p class="fs-7"></p>
                <p class="fs-7"></p>
                <p class="fs-7"></p>
              <?php } ?>
              </span>
              <div class="branch lv3">
                <div class="entry"><span class="label">
                  <?php if ($sire31 && $sire31->can_icr_number && $sire31->can_icr_number != '-') { ?>
                    <p class="fs-7">Sire:</p>
                    <?php if (strlen($sire31->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 red">'; else echo '<p class="fs-7 red">'; echo $sire31->can_a_s.'</p>'; ?>
                    <p class="fs-7"><?= $sire31->can_icr_number; ?></p>
                    <p class="fs-7"><?= $sire31->can_color; ?></p>
                  <?php } else if ($sire31) { ?>
                    <p class="fs-7">Sire:</p>
                    <?php if (strlen($sire31->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 black">'; else echo '<p class="fs-7 black">'; echo $sire31->can_a_s.'</p>'; ?>
                    <p class="fs-7"><?= $sire31->can_icr_number; ?></p>
                    <p class="fs-7"><?= $sire31->can_color; ?></p>
                  <?php } else { ?>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                  <?php } ?>
                  </span></div>
                <div class="entry"><span class="label">
                  <?php if ($dam31 && $dam31->can_icr_number && $dam31->can_icr_number != '-') { ?>
                    <p class="fs-7">Dam:</p>
                    <?php if (strlen($dam31->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 red">'; else echo '<p class="fs-7 red">'; echo $dam31->can_a_s.'</p>'; ?>
                    <p class="fs-7"><?= $dam31->can_icr_number; ?></p>
                    <p class="fs-7"><?= $dam31->can_color; ?></p>
                  <?php } else if ($dam31) { ?>
                    <p class="fs-7">Dam:</p>
                    <?php if (strlen($dam31->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 black">'; else echo '<p class="fs-7 black">'; echo $dam31->can_a_s.'</p>'; ?>
                    <p class="fs-7"><?= $dam31->can_icr_number; ?></p>
                    <p class="fs-7"><?= $dam31->can_color; ?></p>
                  <?php } else { ?>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                  <?php } ?>
                </span></div>
              </div>
            </div>  
            <div class="entry"><span class="label">
              <?php if ($dam21 && $dam21->can_icr_number && $dam21->can_icr_number != '-') { ?>
                <p class="fs-7">Dam:</p>
                <?php if (strlen($dam21->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 red">'; else echo '<p class="fs-7 red">'; echo $dam21->can_a_s.'</p>'; ?>
                <p class="fs-7"><?= $dam21->can_icr_number; ?></p>
                <p class="fs-7"><?= $dam21->can_color; ?></p>
              <?php } else if ($dam21) { ?>
                <p class="fs-7">Dam:</p>
                <?php if (strlen($dam21->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 black">'; else echo '<p class="fs-7 black">'; echo $dam21->can_a_s.'</p>'; ?>
                <p class="fs-7"><?= $dam21->can_icr_number; ?></p>
                <p class="fs-7"><?= $dam21->can_color; ?></p>
              <?php } else { ?>
                <p class="fs-7"></p>
                <p class="fs-7"></p>
                <p class="fs-7"></p>
                <p class="fs-7"></p>
              <?php } ?>
              </span>
              <div class="branch lv3">
                <div class="entry"><span class="label">
                  <?php if ($sire32 && $sire32->can_icr_number && $sire32->can_icr_number != '-') { ?>
                    <p class="fs-7">Sire:</p>
                    <?php if (strlen($sire32->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 red">'; else echo '<p class="fs-7 red">'; echo $sire32->can_a_s.'</p>'; ?>
                    <p class="fs-7"><?= $sire32->can_icr_number; ?></p>
                    <p class="fs-7"><?= $sire32->can_color; ?></p>
                  <?php } else if ($sire32) { ?>
                    <p class="fs-7">Sire:</p>
                    <?php if (strlen($sire32->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 black">'; else echo '<p class="fs-7 black">'; echo $sire32->can_a_s.'</p>'; ?>
                    <p class="fs-7"><?= $sire32->can_icr_number; ?></p>
                    <p class="fs-7"><?= $sire32->can_color; ?></p>
                  <?php } else { ?>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                  <?php } ?>
                  </span></div>
                <div class="entry"><span class="label">
                  <?php if ($dam32 && $dam32->can_icr_number && $dam32->can_icr_number != '-') { ?>
                    <p class="fs-7">Dam:</p>
                    <?php if (strlen($dam32->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 red">'; else echo '<p class="fs-7 red">'; echo $dam32->can_a_s.'</p>'; ?>
                    <p class="fs-7"><?= $dam32->can_icr_number; ?></p>
                    <p class="fs-7"><?= $dam32->can_color; ?></p>
                  <?php } else if ($dam32) { ?>
                    <p class="fs-7">Dam:</p>
                    <?php if (strlen($dam32->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 black">'; else echo '<p class="fs-7 black">'; echo $dam32->can_a_s.'</p>'; ?>
                    <p class="fs-7"><?= $dam32->can_icr_number; ?></p>
                    <p class="fs-7"><?= $dam32->can_color; ?></p>
                  <?php } else { ?>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                  <?php } ?>
                </span></div>
              </div>
            </div>
          </div>
        </div>
          <div class="entry"><span class="label">
            <?php if ($dam && $dam->can_icr_number && $dam->can_icr_number != '-') { ?>
              <p class="fs-7">Dam:</p>
              <?php if (strlen($dam->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 red">'; else echo '<p class="fs-7 red">'; echo $dam->can_a_s.'</p>'; ?>
              <p class="fs-7"><?= $dam->can_icr_number; ?></p>
              <p class="fs-7"><?= $dam->can_color; ?></p>
            <?php } else if ($dam) { ?>
              <p class="fs-7">Dam:</p>
              <?php if (strlen($dam->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 black">'; else echo '<p class="fs-7 black">'; echo $dam->can_a_s.'</p>'; ?>
              <p class="fs-7"><?= $dam->can_icr_number; ?></p>
              <p class="fs-7"><?= $dam->can_color; ?></p>
            <?php } else { ?>
              <p class="fs-7"></p>
              <p class="fs-7"></p>
              <p class="fs-7"></p>
              <p class="fs-7"></p>
            <?php } ?>
            </span>
            <div class="branch lv2">
              <div class="entry"><span class="label">
                <?php if ($sire22 && $sire22->can_icr_number && $sire22->can_icr_number != '-') { ?>
                  <p class="fs-7">Sire:</p>
                  <?php if (strlen($sire22->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 red">'; else echo '<p class="fs-7 red">'; echo $sire22->can_a_s.'</p>'; ?>
                  <p class="fs-7"><?= $sire22->can_icr_number; ?></p>
                  <p class="fs-7"><?= $sire22->can_color; ?></p>
                <?php } else if ($sire22) { ?>
                  <p class="fs-7">Sire:</p>
                  <?php if (strlen($sire22->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 black">'; else echo '<p class="fs-7 black">'; echo $sire22->can_a_s.'</p>'; ?>
                  <p class="fs-7"><?= $sire22->can_icr_number; ?></p>
                  <p class="fs-7"><?= $sire22->can_color; ?></p>
                <?php } else { ?>
                  <p class="fs-7"></p>
                  <p class="fs-7"></p>
                  <p class="fs-7"></p>
                  <p class="fs-7"></p>
                <?php } ?>
              </span>
              <div class="branch lv3">
                <div class="entry"><span class="label">
                  <?php if ($sire33 && $sire33->can_icr_number && $sire33->can_icr_number != '-') { ?>
                    <p class="fs-7">Sire:</p>
                    <?php if (strlen($sire33->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 red">'; else echo '<p class="fs-7 red">'; echo $sire33->can_a_s.'</p>'; ?>
                    <p class="fs-7"><?= $sire33->can_icr_number; ?></p>
                    <p class="fs-7"><?= $sire33->can_color; ?></p>
                  <?php } else if ($sire33) { ?>
                    <p class="fs-7">Sire:</p>
                    <?php if (strlen($sire33->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 black">'; else echo '<p class="fs-7 black">'; echo $sire33->can_a_s.'</p>'; ?>
                    <p class="fs-7"><?= $sire33->can_icr_number; ?></p>
                    <p class="fs-7"><?= $sire33->can_color; ?></p>
                  <?php } else { ?>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                  <?php } ?>
                </span></div>
                <div class="entry"><span class="label">
                  <?php if ($dam33 && $dam33->can_icr_number && $dam33->can_icr_number != '-') { ?>
                    <p class="fs-7">Dam:</p>
                    <?php if (strlen($dam33->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 red">'; else echo '<p class="fs-7 red">'; echo $dam33->can_a_s.'</p>'; ?>
                    <p class="fs-7"><?= $dam33->can_icr_number; ?></p>
                    <p class="fs-7"><?= $dam33->can_color; ?></p>
                  <?php } else if ($dam33) { ?>
                    <p class="fs-7">Dam:</p>
                    <?php if (strlen($dam33->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 black">'; else echo '<p class="fs-7 black">'; echo $dam33->can_a_s.'</p>'; ?>
                    <p class="fs-7"><?= $dam33->can_icr_number; ?></p>
                    <p class="fs-7"><?= $dam33->can_color; ?></p>
                  <?php } else { ?>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                  <?php } ?>
                </span></div>
              </div>
            </div>
            <div class="entry"><span class="label">
              <?php if ($dam22 && $dam22->can_icr_number && $dam22->can_icr_number != '-') { ?>
                <p class="fs-7">Dam:</p>
                <?php if (strlen($dam22->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 red">'; else echo '<p class="fs-7 red">'; echo $dam22->can_a_s.'</p>'; ?>
                <p class="fs-7"><?= $dam22->can_icr_number; ?></p>
                <p class="fs-7"><?= $dam22->can_color; ?></p>
              <?php } else if ($dam22) { ?>
                <p class="fs-7">Dam:</p>
                <?php if (strlen($dam22->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 black">'; else echo '<p class="fs-7 black">'; echo $dam22->can_a_s.'</p>'; ?>
                <p class="fs-7"><?= $dam22->can_icr_number; ?></p>
                <p class="fs-7"><?= $dam22->can_color; ?></p>
              <?php } else { ?>
                <p class="fs-7"></p>
                <p class="fs-7"></p>
                <p class="fs-7"></p>
                <p class="fs-7"></p>
              <?php } ?>
              </span>
              <div class="branch lv3">
                <div class="entry"><span class="label">
                  <?php if ($sire34 && $sire34->can_icr_number && $sire34->can_icr_number != '-') { ?>
                    <p class="fs-7">Sire:</p>
                    <?php if (strlen($sire34->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 red">'; else echo '<p class="fs-7 red">'; echo $sire34->can_a_s.'</p>'; ?>
                    <p class="fs-7"><?= $sire34->can_icr_number; ?></p>
                    <p class="fs-7"><?= $sire34->can_color; ?></p>
                  <?php } else if ($sire34) { ?>
                    <p class="fs-7">Sire:</p>
                    <?php if (strlen($sire34->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 black">'; else echo '<p class="fs-7 black">'; echo $sire34->can_a_s.'</p>'; ?>
                    <p class="fs-7"><?= $sire34->can_icr_number; ?></p>
                    <p class="fs-7"><?= $sire34->can_color; ?></p>
                  <?php } else { ?>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                  <?php } ?>
                </span></div>
                <div class="entry"><span class="label">
                  <?php if ($dam34 && $dam34->can_icr_number && $dam34->can_icr_number != '-') { ?>
                    <p class="fs-7">Dam:</p>
                    <?php if (strlen($dam34->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 red">'; else echo '<p class="fs-7 red">'; echo $dam34->can_a_s.'</p>'; ?>
                    <p class="fs-7"><?= $dam34->can_icr_number; ?></p>
                    <p class="fs-7"><?= $dam34->can_color; ?></p>
                  <?php } else if ($dam34) { ?>
                    <p class="fs-7">Dam:</p>
                    <?php if (strlen($dam34->can_a_s) <= $this->config->item('can_name_length')) echo '<p class="fs-6 black">'; else echo '<p class="fs-7 black">'; echo $dam34->can_a_s.'</p>'; ?>
                    <p class="fs-7"><?= $dam34->can_icr_number; ?></p>
                    <p class="fs-7"><?= $dam34->can_color; ?></p>
                  <?php } else { ?>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                    <p class="fs-7"></p>
                  <?php } ?>
                </span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <p class="text-center position-absolute president">CEO of Indonesian Canine Registry</p>
        <p class="text-center position-absolute president-name">KRIS JOHAN</p>
      </div>
    </div>
  </div>
  <?php $this->load->view('templates/script'); ?>
</body>
</html>