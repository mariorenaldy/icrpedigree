<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>List Canine</title>
  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/css/new-tree-style.css" rel="stylesheet" />
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
    <div class="tree">
      <ul>
        <li>
          <a href="#">
            <p>Anak</p>
            <div class="text-start">
              <p>Breeder: Adam</p>
              <p>Siblings: </p>
              <p>Saudara laki-laki</p>
              <p>Saudara perempuan</p>
            </div>
          </a>
          <ul>
            <li>
              <a href="#">
                <p>Sire: Ayah</p>
                <div class="text-start">
                  <p>Current Reg. Number: UKC A266,984</p>
                  <p>Current ICR Number: 13-D-05-033-M</p>
                  <p>Fawn white</p>
                </div>
              </a>
              <ul>
                <li>
                  <a href="#">
                    <p>Sire: Kakek</p>
                    <div class="text-start">
                      <p>Current Reg. Number: UKC A266,984</p>
                      <p>Current ICR Number: 13-D-05-033-M</p>
                      <p>Fawn white</p>
                    </div>
                  </a>
                  <ul>
                    <li>
                      <a href="#">
                        <p>Sire: Kakek Buyut</p>
                        <div class="text-start">
                          <p>Current Reg. Number: UKC A266,984</p>
                          <p>Current ICR Number: 13-D-05-033-M</p>
                          <p>Fawn white</p>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <p>Dam: Nenek Buyut</p>
                        <div class="text-start">
                          <p>Current Reg. Number: UKC A266,984</p>
                          <p>Current ICR Number: 13-D-05-033-M</p>
                          <p>Fawn white</p>
                        </div>
                      </a>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="#">
                    <p>Dam: Nenek</p>
                    <div class="text-start">
                      <p>Current Reg. Number: UKC A266,984</p>
                      <p>Current ICR Number: 13-D-05-033-M</p>
                      <p>Fawn white</p>
                    </div>
                  </a>
                  <ul>
                    <li>
                      <a href="#">
                        <p>Sire: Kakek Buyut</p>
                        <div class="text-start">
                          <p>Current Reg. Number: UKC A266,984</p>
                          <p>Current ICR Number: 13-D-05-033-M</p>
                          <p>Fawn white</p>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <p>Dam: Nenek Buyut</p>
                        <div class="text-start">
                          <p>Current Reg. Number: UKC A266,984</p>
                          <p>Current ICR Number: 13-D-05-033-M</p>
                          <p>Fawn white</p>
                        </div>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
            <li>
              <a href="#">
                <p>Dam: Ibu</p>
                <div class="text-start">
                  <p>Current Reg. Number: UKC A266,984</p>
                  <p>Current ICR Number: 13-D-05-033-M</p>
                  <p>Fawn white</p>
                </div>
              </a>
              <ul>
                <li>
                  <a href="#">
                    <p>Sire: Kakek</p>
                    <div class="text-start">
                      <p>Current Reg. Number: UKC A266,984</p>
                      <p>Current ICR Number: 13-D-05-033-M</p>
                      <p>Fawn white</p>
                    </div>
                  </a>
                  <ul>
                    <li>
                      <a href="#">
                        <p>Sire: Kakek Buyut</p>
                        <div class="text-start">
                          <p>Current Reg. Number: UKC A266,984</p>
                          <p>Current ICR Number: 13-D-05-033-M</p>
                          <p>Fawn white</p>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <p>Dam: Nenek Buyut</p>
                        <div class="text-start">
                          <p>Current Reg. Number: UKC A266,984</p>
                          <p>Current ICR Number: 13-D-05-033-M</p>
                          <p>Fawn white</p>
                        </div>
                      </a>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="#">Nenek</a>
                  <a href="#">
                    <p>Dam: Nenek</p>
                    <div class="text-start">
                      <p>Current Reg. Number: UKC A266,984</p>
                      <p>Current ICR Number: 13-D-05-033-M</p>
                      <p>Fawn white</p>
                    </div>
                  </a>
                  <ul>
                    <li>
                      <a href="#">Kakek Buyut</a>
                      <a href="#">
                        <p>Sire: Kakek Buyut</p>
                        <div class="text-start">
                          <p>Current Reg. Number: UKC A266,984</p>
                          <p>Current ICR Number: 13-D-05-033-M</p>
                          <p>Fawn white</p>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#">Nenek Buyut</a>
                      <a href="#">
                        <p>Dam: Nenek Buyut</p>
                        <div class="text-start">
                          <p>Current Reg. Number: UKC A266,984</p>
                          <p>Current ICR Number: 13-D-05-033-M</p>
                          <p>Fawn white</p>
                        </div>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- <button class="btn btn-primary pull-right hidden-print" onclick="_print(this)" title="Cetak Sertifikat"><i class="si si-printer"></i>&nbsp;&nbsp;Cetak Sertifikat</button> -->
    <?php $this->load->view('templates/footer'); ?>
  </div>
  <script src="<?= base_url(); ?>assets/js/jquery-3.6.1.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>