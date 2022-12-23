<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>List Canine</title>
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
    <div class="row bg-black text-light">
      <div class="col-md-12">
        <?php if ($canine[0]->can_photo != '-') { ?>
          <img class="pull-right" style=" margin-right: 70px; margin-top: -15px;" src="<?= base_url('uploads/canine/' . $canine[0]->can_photo) ?>" width="400px" alt="" />
        <?php } else { ?>
          <img class="pull-right" style=" margin-right: 70px; margin-top: -15px;" src="<?= base_url('assets/img/' . $this->config->item('canine_img')) ?>" width="400px" alt="" />
        <?php } ?>

        <div>
          <p>Doggie</p>
          <p>13-D-05-033-M</p>
          <p>AMERICAN PIT BULL TERRIER</p>
          <p>Fawn white</p>
          <p>February 16th, 2008</p>
          <p>900164000117733</p>
          <div>
            <p class="text-center">Owner</p>
            <p class="text-center">Gg. Virgo No. 3</p>
          </div>

          <button type="button" class="btn btn-primary" onclick=view_back()>Belakang</button>
          <button class="btn btn-primary" onclick="window.print();">Cetak Sertifikat Depan</button>
        </div>

      </div>
    </div>
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