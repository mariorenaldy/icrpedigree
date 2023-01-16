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
    <div id="wrapper" style="font-family: 'Times New Roman', Times, serif;">
      <div class="bg-container">
      </div>
      <span class="label" id="main" style="min-width: 350px;">
        <p class="fs-4 text-center"><?= $canine->can_breed ?></p>
        <figure class="text-center">
          <img src="<?= base_url() . $this->config->item('path_canine') . $canine->can_photo ?>" class="img-fluid" alt="canine" style="width: 250px;">
        </figure>
        <?php if ($canine->can_icr_number && $canine->can_icr_number != '-') { ?>
          <p class="text-center fs-2 red" style="font-family: Impact; font-weight:normal;"><?= $canine->can_a_s ?></p>
        <?php } else { ?>
          <p class="text-center fs-2 black" style="font-family: Impact; font-weight:normal;"><?= $canine->can_a_s ?></p>
        <?php } ?>
        <div class="container">
          <div class="row gx-0">
            <div class="col-4">
              <p>ICR Number</p>
            </div>
            <div class="col">
              : <?= $canine->can_icr_number ?>
            </div>
          </div>
          <div class="row gx-0">
            <div class="col-4">
              <p>Gender</p>
            </div>
            <div class="col">
              : <?= $canine->can_gender ?>
            </div>
          </div>
          <div class="row gx-0">
            <div class="col-4">
              <p>Color</p>
            </div>
            <div class="col">
              : <?= $canine->can_color ?>
            </div>
          </div>
          <div class="row gx-0">
            <div class="col-4">
              <p>Date of Birth</p>
            </div>
            <div class="col">
              : <?= $canine->can_date_of_birth ?>
            </div>
          </div>
          <div class="row gx-0">
            <div class="col-4">
              <p>ICR Microchip</p>
            </div>
            <div class="col">
              : <?= $canine->can_chip_number ?>
            </div>
          </div>
          <div class="row gx-0">
            <div class="col-4">
              <p>Owner</p>
            </div>
            <div class="col">
              : <?= $canine->mem_name ?>
            </div>
          </div>
          <div class="row gx-0">
            <div class="col-4">
              <p>Kennel</p>
            </div>
            <div class="col">
              : <?= $canine->ken_name ?>
            </div>
          </div>
          <div class="row gx-0">
            <div class="col-4">
              <p>Address</p>
            </div>
            <div class="col">
              : <?= $canine->mem_address ?>
            </div>
          </div>
        </div>
        <p class="text-center mt-4">President of Indonesian Canine Registry</p>
      </span>
      <div class="branch lv1" style="margin-left: 350px;">
        <div class="entry"><span class="label">
            <?php if ($sire && $sire->can_icr_number && $sire->can_icr_number != '-') { ?>
              <p>Sire:</p>
              <p class="fs-6 red"><?= $sire->can_a_s; ?></p>
              <p><?= $sire->can_icr_number; ?></p>
              <p><?= $sire->can_color; ?></p>
            <?php } else if ($sire) { ?>
              <p>Sire:</p>
              <p class="fs-6 black"><?= $sire->can_a_s; ?></p>
              <p><?= $sire->can_icr_number; ?></p>
              <p><?= $sire->can_color; ?></p>
            <?php } else { ?>
              <p></p>
              <p></p>
              <p></p>
              <p></p>
            <?php } ?>
          </span>
          <div class="branch lv2" style="margin-left: 250px;">
            <div class="entry"><span class="label">
                <?php if ($sire22 && $sire22->can_icr_number && $sire22->can_icr_number != '-') { ?>
                  <p>Sire:</p>
                  <p class="fs-6 red"><?= $sire22->can_a_s; ?></p>
                  <p><?= $sire22->can_icr_number; ?></p>
                  <p><?= $sire22->can_color; ?></p>
                <?php } else if ($sire22) { ?>
                  <p>Sire:</p>
                  <p class="fs-6 black"><?= $sire22->can_a_s; ?></p>
                  <p><?= $sire22->can_icr_number; ?></p>
                  <p><?= $sire22->can_color; ?></p>
                <?php } else { ?>
                  <p></p>
                  <p></p>
                  <p></p>
                  <p></p>
                <?php } ?>
              </span>
              <div class="branch lv3" style="margin-left: 250px;">
                <div class="entry"><span class="label">
                    <?php if ($sire33 && $sire33->can_icr_number && $sire33->can_icr_number != '-') { ?>
                      <p>Sire:</p>
                      <p class="fs-6 red"><?= $sire33->can_a_s; ?></p>
                      <p><?= $sire33->can_icr_number; ?></p>
                      <p><?= $sire33->can_color; ?></p>
                    <?php } else if ($sire33) { ?>
                      <p>Sire:</p>
                      <p class="fs-6 black"><?= $sire33->can_a_s; ?></p>
                      <p><?= $sire33->can_icr_number; ?></p>
                      <p><?= $sire33->can_color; ?></p>
                    <?php } else { ?>
                      <p></p>
                      <p></p>
                      <p></p>
                      <p></p>
                    <?php } ?>
                  </span></div>
                <div class="entry"><span class="label">
                    <?php if ($dam33 && $dam33->can_icr_number && $dam33->can_icr_number != '-') { ?>
                      <p>Dam:</p>
                      <p class="fs-6 red"><?= $dam33->can_a_s; ?></p>
                      <p><?= $dam33->can_icr_number; ?></p>
                      <p><?= $dam33->can_color; ?></p>
                    <?php } else if ($dam33) { ?>
                      <p>Dam:</p>
                      <p class="fs-6 black"><?= $dam33->can_a_s; ?></p>
                      <p><?= $dam33->can_icr_number; ?></p>
                      <p><?= $dam33->can_color; ?></p>
                    <?php } else { ?>
                      <p></p>
                      <p></p>
                      <p></p>
                      <p></p>
                    <?php } ?>
                  </span></div>
              </div>
            </div>
            <div class="entry"><span class="label">
                <?php if ($dam22 && $dam22->can_icr_number && $dam22->can_icr_number != '-') { ?>
                  <p>Dam:</p>
                  <p class="fs-6 red"><?= $dam22->can_a_s; ?></p>
                  <p><?= $dam22->can_icr_number; ?></p>
                  <p><?= $dam22->can_color; ?></p>
                <?php } else if ($dam22) { ?>
                  <p>Dam:</p>
                  <p class="fs-6 black"><?= $dam22->can_a_s; ?></p>
                  <p><?= $dam22->can_icr_number; ?></p>
                  <p><?= $dam22->can_color; ?></p>
                <?php } else { ?>
                  <p></p>
                  <p></p>
                  <p></p>
                  <p></p>
                <?php } ?>
              </span>
              <div class="branch lv3" style="margin-left: 250px;">
                <div class="entry"><span class="label">
                    <?php if ($sire34 && $sire34->can_icr_number && $sire34->can_icr_number != '-') { ?>
                      <p>Sire:</p>
                      <p class="fs-6 red"><?= $sire34->can_a_s; ?></p>
                      <p><?= $sire34->can_icr_number; ?></p>
                      <p><?= $sire34->can_color; ?></p>
                    <?php } else if ($sire34) { ?>
                      <p>Sire:</p>
                      <p class="fs-6 black"><?= $sire34->can_a_s; ?></p>
                      <p><?= $sire34->can_icr_number; ?></p>
                      <p><?= $sire34->can_color; ?></p>
                    <?php } else { ?>
                      <p></p>
                      <p></p>
                      <p></p>
                      <p></p>
                    <?php } ?>
                  </span></div>
                <div class="entry"><span class="label">
                    <?php if ($dam34 && $dam34->can_icr_number && $dam34->can_icr_number != '-') { ?>
                      <p>Dam:</p>
                      <p class="fs-6 red"><?= $dam34->can_a_s; ?></p>
                      <p><?= $dam34->can_icr_number; ?></p>
                      <p><?= $dam34->can_color; ?></p>
                    <?php } else if ($dam34) { ?>
                      <p>Dam:</p>
                      <p class="fs-6 black"><?= $dam34->can_a_s; ?></p>
                      <p><?= $dam34->can_icr_number; ?></p>
                      <p><?= $dam34->can_color; ?></p>
                    <?php } else { ?>
                      <p></p>
                      <p></p>
                      <p></p>
                      <p></p>
                    <?php } ?>
                  </span></div>
              </div>
            </div>
          </div>
        </div>
        <div class="entry"><span class="label">
            <?php if ($dam && $dam->can_icr_number && $dam->can_icr_number != '-') { ?>
              <p>Dam:</p>
              <p class="fs-6 red"><?= $dam->can_a_s; ?></p>
              <p><?= $dam->can_icr_number; ?></p>
              <p><?= $dam->can_color; ?></p>
            <?php } else if ($dam) { ?>
              <p>Dam:</p>
              <p class="fs-6 black"><?= $dam->can_a_s; ?></p>
              <p><?= $dam->can_icr_number; ?></p>
              <p><?= $dam->can_color; ?></p>
            <?php } else { ?>
              <p></p>
              <p></p>
              <p></p>
              <p></p>
            <?php } ?>
          </span>
          <div class="branch lv2" style="margin-left: 250px;">
            <div class="entry"><span class="label">
                <?php if ($sire21 && $sire21->can_icr_number && $sire21->can_icr_number != '-') { ?>
                  <p>Sire:</p>
                  <p class="fs-6 red"><?= $sire21->can_a_s; ?></p>
                  <p><?= $sire21->can_icr_number; ?></p>
                  <p><?= $sire21->can_color; ?></p>
                <?php } else if ($sire21) { ?>
                  <p>Sire:</p>
                  <p class="fs-6 black"><?= $sire21->can_a_s; ?></p>
                  <p><?= $sire21->can_icr_number; ?></p>
                  <p><?= $sire21->can_color; ?></p>
                <?php } else { ?>
                  <p></p>
                  <p></p>
                  <p></p>
                  <p></p>
                <?php } ?>
              </span>
              <div class="branch lv3" style="margin-left: 250px;">
                <div class="entry"><span class="label">
                    <?php if ($sire31 && $sire31->can_icr_number && $sire31->can_icr_number != '-') { ?>
                      <p>Sire:</p>
                      <p class="fs-6 red"><?= $sire31->can_a_s; ?></p>
                      <p><?= $sire31->can_icr_number; ?></p>
                      <p><?= $sire31->can_color; ?></p>
                    <?php } else if ($sire31) { ?>
                      <p>Sire:</p>
                      <p class="fs-6 black"><?= $sire31->can_a_s; ?></p>
                      <p><?= $sire31->can_icr_number; ?></p>
                      <p><?= $sire31->can_color; ?></p>
                    <?php } else { ?>
                      <p></p>
                      <p></p>
                      <p></p>
                      <p></p>
                    <?php } ?>
                  </span></div>
                <div class="entry"><span class="label">
                    <?php if ($dam31 && $dam31->can_icr_number && $dam31->can_icr_number != '-') { ?>
                      <p>Dam:</p>
                      <p class="fs-6 red"><?= $dam31->can_a_s; ?></p>
                      <p><?= $dam31->can_icr_number; ?></p>
                      <p><?= $dam31->can_color; ?></p>
                    <?php } else if ($dam31) { ?>
                      <p>Dam:</p>
                      <p class="fs-6 black"><?= $dam31->can_a_s; ?></p>
                      <p><?= $dam31->can_icr_number; ?></p>
                      <p><?= $dam31->can_color; ?></p>
                    <?php } else { ?>
                      <p></p>
                      <p></p>
                      <p></p>
                      <p></p>
                    <?php } ?>
                  </span></div>
              </div>
            </div>
            <div class="entry"><span class="label">
                <?php if ($dam21 && $dam21->can_icr_number && $dam21->can_icr_number != '-') { ?>
                  <p>Dam:</p>
                  <p class="fs-6 red"><?= $dam21->can_a_s; ?></p>
                  <p><?= $dam21->can_icr_number; ?></p>
                  <p><?= $dam21->can_color; ?></p>
                <?php } else if ($dam21) { ?>
                  <p>Dam:</p>
                  <p class="fs-6 black"><?= $dam21->can_a_s; ?></p>
                  <p><?= $dam21->can_icr_number; ?></p>
                  <p><?= $dam21->can_color; ?></p>
                <?php } else { ?>
                  <p></p>
                  <p></p>
                  <p></p>
                  <p></p>
                  <p></p>
                <?php } ?>
              </span>
              <div class="branch lv3" style="margin-left: 250px;">
                <div class="entry"><span class="label">
                    <?php if ($sire32 && $sire32->can_icr_number && $sire32->can_icr_number != '-') { ?>
                      <p>Sire:</p>
                      <p class="fs-6 red"><?= $sire32->can_a_s; ?></p>
                      <p><?= $sire32->can_icr_number; ?></p>
                      <p><?= $sire32->can_color; ?></p>
                    <?php } else if ($sire32) { ?>
                      <p>Sire:</p>
                      <p class="fs-6 black"><?= $sire32->can_a_s; ?></p>
                      <p><?= $sire32->can_icr_number; ?></p>
                      <p><?= $sire32->can_color; ?></p>
                    <?php } else { ?>
                      <p></p>
                      <p></p>
                      <p></p>
                      <p></p>
                    <?php } ?>
                  </span></div>
                <div class="entry"><span class="label">
                    <?php if ($dam32 && $dam32->can_icr_number && $dam32->can_icr_number != '-') { ?>
                      <p>Dam:</p>
                      <p class="fs-6 red"><?= $dam32->can_a_s; ?></p>
                      <p><?= $dam32->can_icr_number; ?></p>
                      <p><?= $dam32->can_color; ?></p>
                    <?php } else if ($dam32) { ?>
                      <p>Dam:</p>
                      <p class="fs-6 black"><?= $dam32->can_a_s; ?></p>
                      <p><?= $dam32->can_icr_number; ?></p>
                      <p><?= $dam32->can_color; ?></p>
                    <?php } else { ?>
                      <p></p>
                      <p></p>
                      <p></p>
                      <p></p>
                    <?php } ?>
                  </span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <p class="text-center position-absolute" style="bottom:2%; left:120px;"><?= $canine->mem_name ?></p>
    </div>
    <div class="row bottom-0 start-50">
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
      w.onafterprint = function() {
        w.close();
      };
    }

    function back() {
      window.location = "<?= base_url(); ?>backend/Canines";
    }
  </script>
</body>

</html>