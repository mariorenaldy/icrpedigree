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
    <?php $this->load->view('templates/header'); ?>
    <p class="fs-5 position-absolute ms-2"><?= $canine->can_breed ?></p>
    <div id="wrapper"><span class="label" id="main">
        <figure>
          <img src="<?= base_url().$this->config->item('path_canine').$canine->can_photo ?>" class="img-fluid img-thumbnail" alt="canine" style="width: 15vw;">
        </figure>
        <?php if ($canine->can_icr_number && $canine->can_icr_number != '-'){ ?>
          <p class="text-center fs-6 red"><?= $canine->can_a_s ?></p>
        <?php } else { ?>
          <p class="text-center fs-6 black"><?= $canine->can_a_s ?></p>
        <?php } ?>
        <p class="mt-2">ICR Number: <?= $canine->can_icr_number ?></p>
        <p>Gender: <?= $canine->can_gender ?></p>
        <p>Color: <?= $canine->can_color ?></p>
        <p>Date of Birth: <?= $canine->can_date_of_birth ?></p>
        <p>Microchip: <?= $canine->can_chip_number ?></p>
        <p>Breeder: <?= $canine->mem_name ?></p>
      </span>
      <div class="branch lv1">
        <div class="entry"><span class="label">
          <?php if ($dam && $dam->can_icr_number && $dam->can_icr_number != '-'){ ?>
            <p class="text-center fs-6 red"><?= $dam->can_a_s; ?></p>
            <p class="text-center"><?= $dam->can_icr_number; ?></p>
          <?php } else if ($dam){ ?>
            <p class="text-center fs-6 black"><?= $dam->can_a_s; ?></p>
            <p class="text-center"><?= $dam->can_icr_number; ?></p>
          <?php } else { ?>
            <p></p>
            <p></p>
          <?php } ?>
          </span>
          <div class="branch lv2">
            <div class="entry"><span class="label">
              <?php if ($dam21 && $dam21->can_icr_number && $dam21->can_icr_number != '-'){ ?>
                <p class="text-center fs-6 red"><?= $dam21->can_a_s; ?></p>
                <p class="text-center"><?= $dam21->can_icr_number; ?></p>
              <?php } else if ($dam21){ ?>
                <p class="text-center fs-6 black"><?= $dam21->can_a_s; ?></p>
                <p class="text-center"><?= $dam21->can_icr_number; ?></p>
              <?php } else { ?>
                <p></p>
                <p></p>
              <?php } ?>
              </span>
              <div class="branch lv3">
                <div class="entry"><span class="label">
                  <?php if ($dam32 && $dam32->can_icr_number && $dam32->can_icr_number != '-'){ ?>
                    <p class="text-center fs-6 red"><?= $dam32->can_a_s; ?></p>
                    <p class="text-center"><?= $dam32->can_icr_number; ?></p>
                  <?php } else if ($dam32){ ?>
                    <p class="text-center fs-6 black"><?= $dam32->can_a_s; ?></p>
                    <p class="text-center"><?= $dam32->can_icr_number; ?></p>
                  <?php } else {?>
                    <p></p>
                    <p></p>
                  <?php } ?>
                  </span></div>
                <div class="entry"><span class="label">
                  <?php if ($sire32 && $sire32->can_icr_number && $sire32->can_icr_number != '-'){ ?>
                    <p class="text-center fs-6 red"><?= $sire32->can_a_s; ?></p>
                    <p class="text-center"><?= $sire32->can_icr_number; ?></p>
                  <?php } else if ($sire32){ ?>
                    <p class="text-center fs-6 black"><?= $sire32->can_a_s; ?></p>
                    <p class="text-center"><?= $sire32->can_icr_number; ?></p>
                  <?php } else {?>
                    <p></p>
                    <p></p>
                  <?php } ?>
                </span></div>
              </div>
            </div>  
            <div class="entry"><span class="label">
              <?php if ($sire21 && $sire21->can_icr_number && $sire21->can_icr_number != '-'){ ?>
                <p class="text-center fs-6 red"><?= $sire21->can_a_s; ?></p>
                <p class="text-center"><?= $sire21->can_icr_number; ?></p>
              <?php } else if ($sire21){ ?>
                <p class="text-center fs-6 black"><?= $sire21->can_a_s; ?></p>
                <p class="text-center"><?= $sire21->can_icr_number; ?></p>
              <?php } else {?>
                <p></p>
                <p></p>
              <?php } ?>
              </span>
              <div class="branch lv3">
                <div class="entry"><span class="label">
                  <?php if ($dam31 && $dam31->can_icr_number && $dam31->can_icr_number != '-'){ ?>
                    <p class="text-center fs-6 red"><?= $dam31->can_a_s; ?></p>
                    <p class="text-center"><?= $dam31->can_icr_number; ?></p>
                  <?php } else if ($dam31){ ?>
                    <p class="text-center fs-6 black"><?= $dam31->can_a_s; ?></p>
                    <p class="text-center"><?= $dam31->can_icr_number; ?></p>
                  <?php } else { ?>
                    <p></p>
                    <p></p>
                  <?php } ?>
                </span></div>
                <div class="entry"><span class="label">
                  <?php if ($sire31 && $sire31->can_icr_number && $sire31->can_icr_number != '-'){ ?>
                    <p class="text-center fs-6 red"><?= $sire31->can_a_s; ?></p>
                    <p class="text-center"><?= $sire31->can_icr_number; ?></p>
                  <?php } else if ($sire31){ ?>
                    <p class="text-center fs-6 black"><?= $sire31->can_a_s; ?></p>
                    <p class="text-center"><?= $sire31->can_icr_number; ?></p>
                  <?php } else {?>
                    <p></p>
                    <p></p>
                  <?php } ?>
                </span></div>
              </div>
            </div>
          </div>
        </div>
          <div class="entry"><span class="label">
            <?php if ($sire && $sire->can_icr_number && $sire->can_icr_number != '-'){ ?>
              <p class="text-center fs-6 red"><?= $sire->can_a_s; ?></p>
              <p class="text-center"><?= $sire->can_icr_number; ?></p>
            <?php } else if ($sire){ ?>
              <p class="text-center fs-6 black"><?= $sire->can_a_s; ?></p>
              <p class="text-center"><?= $sire->can_icr_number; ?></p>
            <?php } else {?>
              <p></p>
              <p></p>
            <?php } ?>
            </span>
            <div class="branch lv2">
              <div class="entry"><span class="label">
                <?php if ($dam22 && $dam22->can_icr_number && $dam22->can_icr_number != '-'){ ?>
                <p class="text-center fs-6 red"><?= $dam22->can_a_s; ?></p>
                <p class="text-center"><?= $dam22->can_icr_number; ?></p>
              <?php } else if ($dam22){ ?>
                <p class="text-center fs-6 black"><?= $dam22->can_a_s; ?></p>
                <p class="text-center"><?= $dam22->can_icr_number; ?></p>
              <?php } else { ?>
                <p></p>
                <p></p>
              <?php } ?>
              </span>
              <div class="branch lv3">
                <div class="entry"><span class="label">
                  <?php if ($dam34 && $dam34->can_icr_number && $dam34->can_icr_number != '-'){ ?>
                    <p class="text-center fs-6 red"><?= $dam34->can_a_s; ?></p>
                    <p class="text-center"><?= $dam34->can_icr_number; ?></p>
                  <?php } else if ($dam34){ ?>
                    <p class="text-center fs-6 black"><?= $dam34->can_a_s; ?></p>
                    <p class="text-center"><?= $dam34->can_icr_number; ?></p>
                  <?php } else { ?>
                    <p></p>
                    <p></p>
                  <?php } ?>
                </span></div>
                <div class="entry"><span class="label">
                  <?php if ($sire34 && $sire34->can_icr_number && $sire34->can_icr_number != '-'){ ?>
                    <p class="text-center fs-6 red"><?= $sire34->can_a_s; ?></p>
                    <p class="text-center"><?= $sire34->can_icr_number; ?></p>
                  <?php } else if ($sire34){ ?>
                    <p class="text-center fs-6 black"><?= $sire34->can_a_s; ?></p>
                    <p class="text-center"><?= $sire34->can_icr_number; ?></p>
                  <?php } else {?>
                    <p></p>
                    <p></p>
                  <?php } ?>
                </span></div>
              </div>
            </div>
            <div class="entry"><span class="label">
              <?php if ($sire22 && $sire22->can_icr_number && $sire22->can_icr_number != '-'){ ?>
                <p class="text-center fs-6 red"><?= $sire22->can_a_s; ?></p>
                <p class="text-center"><?= $sire22->can_icr_number; ?></p>
              <?php } else if ($sire22){ ?>
                <p class="text-center fs-6 black"><?= $sire22->can_a_s; ?></p>
                <p class="text-center"><?= $sire22->can_icr_number; ?></p>
              <?php } else {?>
                <p></p>
                <p></p>
              <?php } ?>
              </span>
              <div class="branch lv3">
                <div class="entry"><span class="label">
                  <?php if ($dam33 && $dam33->can_icr_number && $dam33->can_icr_number != '-'){ ?>
                    <p class="text-center fs-6 red"><?= $dam33->can_a_s; ?></p>
                    <p class="text-center"><?= $dam33->can_icr_number; ?></p>
                  <?php } else if ($dam33){ ?>
                    <p class="text-center fs-6 black"><?= $dam33->can_a_s; ?></p>
                    <p class="text-center"><?= $dam33->can_icr_number; ?></p>
                  <?php } else { ?>
                    <p></p>
                    <p></p>
                  <?php } ?>
                </span></div>
                <div class="entry"><span class="label">
                  <?php if ($sire33 && $sire33->can_icr_number && $sire33->can_icr_number != '-'){ ?>
                    <p class="text-center fs-6 red"><?= $sire33->can_a_s; ?></p>
                    <p class="text-center"><?= $sire33->can_icr_number; ?></p>
                  <?php } else if ($sire33){ ?>
                    <p class="text-center fs-6 black"><?= $sire33->can_a_s; ?></p>
                    <p class="text-center"><?= $sire33->can_icr_number; ?></p>
                  <?php } else {?>
                    <p></p>
                    <p></p>
                  <?php } ?>
                </span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mb-5 mt-5">
      <div class="col text-center">
        <button class="btn btn-primary" onclick="print();"><i class="fa fa-print"></i></button>
        <button class="btn btn-primary" onclick="back();"><i class="fa fa-close"></i></button>
      </div>
    </div>
    <?php $this->load->view('templates/footer'); ?>
  </div>
  <?php $this->load->view('templates/script'); ?>
  <script>
    function print() {
      w = window.open("<?= base_url(); ?>backend/Certificate/back/<?= $canine->can_id ?>/print", "_blank");
      w.print();
      w.onafterprint = function(){ 
        w.close();
      };
    }
    function back(){
      window.location = "<?= base_url(); ?>backend/Canines";
    }
  </script>
</body>
</html>