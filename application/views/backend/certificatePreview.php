<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Certificate</title>
  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" media='all' />
  <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" media='all' />
</head>

<body>
  <?php
  if (!$this->session->userdata('use_username')) {
    echo '<script type="text/javascript">';
    echo 'window.location = "' . base_url() . 'backend/Users/login";';
    echo '</script>';
  }
  ?>
  <div class="container">
    <?php $this->load->view('templates/header'); ?>
    <div class="row">
      <div class="col text-center">
        <figure>
          <img src="<?= base_url('assets/img/icr_logo.png') ?>" class="center-block text-center" style="width: 20vw;">
        </figure>
        <h5 class="mb-3" style="color: #d09724; font-weight: 700;">INDONESIAN CANINE REGISTRY</h5>
        <p>Lorem ipsum dolor sit arnet consectetur adipi-scing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullam-co lebons nisi ut aliquip ex ea commodo conse-quat. </p>
      </div>
      <div class="col">
        <h5 class="mb-3" style="color: #d09724; font-weight: 700;">Registry Rules:</h5>
        <ol class="p-0" style="list-style-position: inside;">
          <li>Lorem ipso dolor sit amet consectetur adipiscing elit. </li>
          <li>Nam hendrerit nisi sed sollicitudin pellen-tesque. </li>
          <li>Nunc posuere purus rhoncus pulvinar ali-quam. </li>
          <li>Ut aliquet tristique nisi vitae volutpat. </li>
          <li>Nulls aliquet porttitor venenatis. </li>
          <li>Donec a dui et dui fringilla consectetur id nec massa. </li>
        </ol>
      </div>
      <div class="col">
        <h5 class="mb-3" style="color: #d09724; font-weight: 700;">Awards & Appreciation:</h5>
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
    <button type="button" class="btn btn-primary" onclick=view_back()>Belakang</button>
    <button class="btn btn-primary" onclick="window.print();">Cetak Sertifikat Depan</button>
    <?php $this->load->view('templates/footer'); ?>
  </div>
  <script src="<?= base_url(); ?>assets/js/jquery-3.6.1.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
  <script>
    // function view_back(id) {
    //   window.location = "<?= base_url(); ?>backend/Certificate/view_back/" + id;
    // }
    function view_back() {
      window.location = "<?= base_url(); ?>backend/Certificate/view_back/";
    }
  </script>
</body>

</html>