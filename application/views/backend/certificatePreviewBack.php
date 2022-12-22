<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>List Canine</title>
  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/css/tree-style.css" rel="stylesheet" />
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
    <div class="row">
      <div class="col-md-12">
        <div class="tree">
          <ul>
            <li>
              <?php if (isset($canine[0]['can_a_s'])){ ?>
              <a href="#"><?= $canine[0]['can_a_s'] ?></a>
              <ul>
                <li>
                  <a href="#"><?= $canine[0]['sire'][0]['can_a_s'] ?></a>
                  <ul>
                    <li>
                      <a href="#"><?= $canine[0]['sire'][0]['sire'][0]['can_a_s'] ?></a>
                      <ul>
                        <li>
                          <a href="#"><?= $canine[0]['sire'][0]['sire'][0]['sire'][0]['can_a_s'] ?></a>
                        </li>
                        <li>
                          <a href="#"><?= $canine[0]['sire'][0]['sire'][0]['dam'][0]['can_a_s'] ?></a>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <a href="#"><?= $canine[0]['sire'][0]['dam'][0]['can_a_s'] ?></a>
                      <ul>
                        <li>
                          <a href="#"><?= $canine[0]['sire'][0]['dam'][0]['sire'][0]['can_a_s'] ?></a>
                        </li>
                        <li>
                          <a href="#"><?= $canine[0]['sire'][0]['dam'][0]['dam'][0]['can_a_s'] ?></a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="#"><?= $canine[0]['dam'][0]['can_a_s'] ?></a>
                  <ul>
                    <li>
                      <a href="#"><?= $canine[0]['dam'][0]['sire'][0]['can_a_s'] ?></a>
                      <ul>
                        <li>
                          <a href="#"><?= $canine[0]['dam'][0]['sire'][0]['sire'][0]['can_a_s'] ?></a>
                        </li>
                        <li>
                          <a href="#"><?= $canine[0]['dam'][0]['sire'][0]['dam'][0]['can_a_s'] ?></a>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <a href="#"><?= $canine[0]['dam'][0]['dam'][0]['can_a_s'] ?></a>
                      <ul>
                        <li>
                          <a href="#"><?= $canine[0]['dam'][0]['dam'][0]['sire'][0]['can_a_s'] ?></a>
                        </li>
                        <li>
                          <a href="#"><?= $canine[0]['dam'][0]['dam'][0]['dam'][0]['can_a_s'] ?></a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>
              </ul>
              <?php } ?>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <?php $this->load->view('templates/footer'); ?>
  </div>
  <script src="<?= base_url(); ?>assets/js/jquery-3.6.1.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>