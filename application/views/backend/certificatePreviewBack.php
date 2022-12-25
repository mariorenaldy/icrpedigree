<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Certificate</title>
  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/css/tree-styles.css" rel="stylesheet" />
</head>

<body>
  <?php
  if (!$this->session->userdata('use_username')) {
    echo '<script type="text/javascript">';
    echo 'window.location = "' . base_url() . 'backend/Users/login";';
    echo '</script>';
  }
  ?>
  <div>
    <?php $this->load->view('templates/header'); ?>
    <div id="wrapper"><span class="label">
        <figure>
          <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine" style="width: 15vw;">
        </figure>
        <p class="text-center fs-5" style="font-weight:700; color: #e62225;">DOGO VON DOGGY</p>
        <p>ICR Number: </p>
        <p>Breed:</p>
        <p>Gender:</p>
        <p>Color:</p>
        <p>Date of Birth:</p>
        <p>Microchip:</p>
        <p>Breeder:</p>
      </span>
      <div class="branch lv1">
        <div class="entry"><span class="label">
            <p class="text-center fs-5" style="font-weight:700; color: #e62225;">MAMA VON DOGGY</p>
            <p>ICR Number</p>
          </span>
          <div class="branch lv2">
            <div class="entry"><span class="label">
                <p class="text-center fs-5" style="font-weight:700; color: #e62225;">MAMA2 VON DOGGY</p>
                <p>ICR Number</p>
              </span>
              <div class="branch lv3">
                <div class="entry"><span class="label">
                    <p class="text-center fs-5" style="font-weight:700; color: #e62225;">MAMA4 VON DOGGY</p>
                    <p>ICR Number</p>
                  </span></div>
                <div class="entry"><span class="label">
                    <p class="text-center fs-5" style="font-weight:700; color: #e62225;">PAPA4 VON DOGGY</p>
                    <p>ICR Number</p>
                  </span></div>
              </div>
            </div>
            <div class="entry"><span class="label">
                <p class="text-center fs-5" style="font-weight:700; color: #e62225;">PAPA2 VON DOGGY</p>
                <p>ICR Number</p>
              </span>
              <div class="branch lv3">
                <div class="entry"><span class="label">
                    <p class="text-center fs-5" style="font-weight:700; color: #e62225;">MAMA5 VON DOGGY</p>
                    <p>ICR Number</p>
                  </span></div>
                <div class="entry"><span class="label">
                    <p class="text-center fs-5" style="font-weight:700; color: #e62225;">PAPA5 VON DOGGY</p>
                    <p>ICR Number</p>
                  </span></div>
              </div>
            </div>
          </div>
        </div>
        <div class="entry"><span class="label">
            <p class="text-center fs-5" style="font-weight:700; color: #e62225;">PAPA VON DOGGY</p>
            <p>ICR Number</p>
          </span>
          <div class="branch lv2">
            <div class="entry"><span class="label">
                <p class="text-center fs-5" style="font-weight:700; color: #e62225;">MAMA3 VON DOGGY</p>
                <p>ICR Number</p>
              </span>
              <div class="branch lv3">
                <div class="entry"><span class="label">
                    <p class="text-center fs-5" style="font-weight:700; color: #e62225;">MAMA6 VON DOGGY</p>
                    <p>ICR Number</p>
                  </span></div>
                <div class="entry"><span class="label">
                    <p class="text-center fs-5" style="font-weight:700; color: #e62225;">PAPA6 VON DOGGY</p>
                    <p>ICR Number</p>
                  </span></div>
              </div>
            </div>
            <div class="entry"><span class="label">
                <p class="text-center fs-5" style="font-weight:700; color: #e62225;">PAPA3 VON DOGGY</p>
                <p>ICR Number</p>
              </span>
              <div class="branch lv3">
                <div class="entry"><span class="label">
                    <p class="text-center fs-5" style="font-weight:700; color: #e62225;">MAMA7 VON DOGGY</p>
                    <p>ICR Number</p>
                  </span></div>
                <div class="entry"><span class="label">
                    <p class="text-center fs-5" style="font-weight:700; color: #e62225;">PAPA7 VON DOGGY</p>
                    <p>ICR Number</p>
                  </span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div style="margin-bottom: 100px;"></div>
    <button class="btn btn-primary" onclick="window.print();">Cetak Sertifikat</button>
    <?php $this->load->view('templates/footer'); ?>
  </div>
  <script src="<?= base_url(); ?>assets/js/jquery-3.6.1.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>