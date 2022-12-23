<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>List Canine</title>
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
        <p>Anak</p>
        <p>Breeder: Adam</p>
        <p>Siblings: </p>
        <p>Saudara laki-laki</p>
        <p>Saudara perempuan</p>
      </span>
      <div class="branch lv1">
        <div class="entry"><span class="label">
            <p>Sire: Ayah</p>
            <p>Current Reg. Number: UKC A266,984</p>
            <p>Current ICR Number: 13-D-05-033-M</p>
            <p>Fawn white</p>
          </span>
          <div class="branch lv2">
            <div class="entry"><span class="label">
                <p>Sire: Kakek</p>
                <p>Current Reg. Number: UKC A266,984</p>
                <p>Current ICR Number: 13-D-05-033-M</p>
                <p>Fawn white</p>
              </span>
              <div class="branch lv3">
                <div class="entry"><span class="label">
                    <p>Sire: Kakek Buyut</p>
                    <p>Current Reg. Number: UKC A266,984</p>
                    <p>Current ICR Number: 13-D-05-033-M</p>
                    <p>Fawn white</p>
                  </span></div>
                <div class="entry"><span class="label">
                    <p>Dam: Nenek Buyut</p>
                    <p>Current Reg. Number: UKC A266,984</p>
                    <p>Current ICR Number: 13-D-05-033-M</p>
                    <p>Fawn white</p>
                  </span></div>
              </div>
            </div>
            <div class="entry"><span class="label">
                <p>Dam: Nenek</p>
                <p>Current Reg. Number: UKC A266,984</p>
                <p>Current ICR Number: 13-D-05-033-M</p>
                <p>Fawn white</p>
              </span>
              <div class="branch lv3">
                <div class="entry"><span class="label">
                    <p>Sire: Kakek Buyut</p>
                    <p>Current Reg. Number: UKC A266,984</p>
                    <p>Current ICR Number: 13-D-05-033-M</p>
                    <p>Fawn white</p>
                  </span></div>
                <div class="entry"><span class="label">
                    <p>Dam: Nenek Buyut</p>
                    <p>Current Reg. Number: UKC A266,984</p>
                    <p>Current ICR Number: 13-D-05-033-M</p>
                    <p>Fawn white</p>
                  </span></div>
              </div>
            </div>
          </div>
        </div>
        <div class="entry"><span class="label">
            <p>Dam: Ibu</p>
            <p>Current Reg. Number: UKC A266,984</p>
            <p>Current ICR Number: 13-D-05-033-M</p>
            <p>Fawn white</p>
          </span>
          <div class="branch lv2">
            <div class="entry"><span class="label">
                <p>Sire: Kakek</p>
                <p>Current Reg. Number: UKC A266,984</p>
                <p>Current ICR Number: 13-D-05-033-M</p>
                <p>Fawn white</p>
              </span>
              <div class="branch lv3">
                <div class="entry"><span class="label">
                    <p>Sire: Kakek Buyut</p>
                    <p>Current Reg. Number: UKC A266,984</p>
                    <p>Current ICR Number: 13-D-05-033-M</p>
                    <p>Fawn white</p>
                  </span></div>
                <div class="entry"><span class="label">
                    <p>Dam: Nenek Buyut</p>
                    <p>Current Reg. Number: UKC A266,984</p>
                    <p>Current ICR Number: 13-D-05-033-M</p>
                    <p>Fawn white</p>
                  </span></div>
              </div>
            </div>
            <div class="entry"><span class="label">
                <p>Dam: Nenek</p>
                <p>Current Reg. Number: UKC A266,984</p>
                <p>Current ICR Number: 13-D-05-033-M</p>
                <p>Fawn white</p>
              </span>
              <div class="branch lv3">
                <div class="entry"><span class="label">
                    <p>Sire: Kakek Buyut</p>
                    <p>Current Reg. Number: UKC A266,984</p>
                    <p>Current ICR Number: 13-D-05-033-M</p>
                    <p>Fawn white</p>
                  </span></div>
                <div class="entry"><span class="label">
                    <p>Dam: Nenek Buyut</p>
                    <p>Current Reg. Number: UKC A266,984</p>
                    <p>Current ICR Number: 13-D-05-033-M</p>
                    <p>Fawn white</p>
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