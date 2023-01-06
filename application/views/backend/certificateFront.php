<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Certificate</title>
  <?php $this->load->view('templates/head'); ?>
  <link href="<?php echo base_url(); ?>assets/css/backend-styles.css" rel="stylesheet" media='all' />
</head>
<body>
  <?php $this->load->view('templates/redirect'); ?>
  <div class="container">
    <div class="row">
      <div class="col md-4">
        <figure class="text-center">
          <img src="<?= base_url('assets/img/icr_logo.png') ?>" class="center-block text-center" style="width: 20vw;">
        </figure>
        <h5 class="gold mb-3 text-center" style="color: #d09724; font-weight: 700;">INDONESIAN CANINE REGISTRY</h5>
        <p>Lorem ipsum dolor sit arnet consectetur adipi-scing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullam-co lebons nisi ut aliquip ex ea commodo conse-quat. </p>
      </div>
      <?php foreach ($rules AS $r){ ?>
        <div class="col-md-4">
          <?= $r->ru_title; ?>
          <span class="desc"><?= $r->ru_desc; ?></span>  
        </div>
      <?php } ?>
      <div class="col md-4">
        <h5 class="gold mb-3 text-center">Awards & Appreciation:</h5>
        <ol class="p-0" style="list-style-position: inside;">
          <li>July 4, 1969: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
          <li>20 July, 1969: Nam hendrerit nisi sed sollicitu-din pellentesque. </li>
          <li>January 4, 1996: Nunc posuere purus rhon-Cols pulvinar aliquam. </li>
          <li>August 6, 1945: Ut aliquet tristique nisi vitae volutpat. </li>
          <li>April 13, 1961: Nulls aliquet porttitor venena-tis. </li>
          <li>October 12, 1942: Donee a dui et dui fringilla consectetur id nec massa. </li>
        </ol>
      </div>
    </div>
  </div>
  <?php $this->load->view('templates/script'); ?>
</body>
</html>