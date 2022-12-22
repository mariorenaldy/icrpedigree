<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>List Canine</title>
  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
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
      <div class="col-md-12">
        <?php if ($canine[0]->can_photo != '-') { ?>
          <img class="pull-right" style=" margin-right: 70px; margin-top: -15px;" src="<?= base_url('uploads/canine/' . $canine[0]->can_photo) ?>" width="400px" alt="" />
        <?php } else { ?>
          <img class="pull-right" style=" margin-right: 70px; margin-top: -15px;" src="<?= base_url('assets/img/' . $this->config->item('canine_img')) ?>" width="400px" alt="" />
        <?php } ?>

        <div>
          <p><?php echo $canine[0]->can_a_s; ?></p>
          <p><?php echo $canine[0]->can_icr_number; ?></p>
          <p><?php echo $canine[0]->can_breed; ?></p>
          <p><?php echo $canine[0]->can_color; ?></p>
          <p><?php echo $canine[0]->can_date_of_birth; ?></p>
          <p><?php echo $canine[0]->can_chip_number; ?></p>
          <div>
            <p class="text-center"><?php echo $member[0]->mem_name; ?></p>
            <p class="text-center"><?php echo $member[0]->mem_address; ?></p>
          </div>

          <!-- <a class="btn btn-primary" href="<?= base_url('backend/Certificate/view_back', $canine[0]->can_id) ?>">Belakang</a> -->
          <button type="button" class="btn btn-primary" onclick=print(<?= $canine[0]->can_id ?>)>Belakang</button>
          <button>Cetak Sertifikat</button>
        </div>

      </div>
    </div>
    <?php $this->load->view('templates/footer'); ?>
  </div>
  <script src="<?= base_url(); ?>assets/js/jquery-3.6.1.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
  <script>
    function print(id) {
      window.location = "<?= base_url(); ?>backend/Certificate/view_back/" + id;
    }
  </script>
</body>

</html>