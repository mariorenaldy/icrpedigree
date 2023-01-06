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
    <?php $this->load->view('templates/header'); ?>
    <div class="text-danger">
        <?php		
            if ($this->session->flashdata('error')){
                echo $this->session->flashdata('error').'<br/>';
            }
        ?>
    </div>
    <div class="row">
      <div class="col md-3">
        <figure class="text-center">
          <img src="<?= base_url('assets/img/icr_logo.png') ?>" class="center-block text-center" style="width: 20vw;">
        </figure>
        <h5 class="gold mb-3 text-center">INDONESIAN CANINE REGISTRY</h5>
        <p>Lorem ipsum dolor sit arnet consectetur adipi-scing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullam-co lebons nisi ut aliquip ex ea commodo conse-quat. </p>
      </div>
      <div class="col-md-6">
        <?php foreach ($rules AS $r){ ?>
          <?= $r->ru_title; ?>
          <span class="desc"><?= $r->ru_desc; ?></span>  
        <?php } ?>
      </div>
      <div class="col md-3">
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
    <div class="row">
      <div class="col text-center">
        <button class="btn btn-primary" onclick="print()"><i class="fa fa-print"></i></button>
        <button type="button" class="btn btn-primary" onclick=view_back()>Back Certificate</button>
      </div>
    </div>
    <?php $this->load->view('templates/footer'); ?>
  </div>
  <?php $this->load->view('templates/script'); ?>
  <script>
    function view_back() {
      window.location = "<?= base_url(); ?>backend/Certificate/back/<?= $canine->can_id ?>";
    }
    function print() {
      w = window.open("<?= base_url(); ?>backend/Certificate/front/<?= $canine->can_id ?>/print", "_blank");
      w.print();
      w.onafterprint = function(){ 
        w.close();
      };
    }
  </script>
</body>
</html>