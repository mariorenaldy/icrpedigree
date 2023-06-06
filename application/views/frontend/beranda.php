<!DOCTYPE html>
<html>
<head>
    <title><?= lang("home_title"); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?> 
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="row align-items-center justify-content-around" id="beranda-main">
        <div id="adsCarousel" class="carousel slide" data-bs-ride="carousel" style="width: <?= $this->config->item('carousel_width') ?>">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#adsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#adsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner mb-5">
                <div class="carousel-item active" data-bs-interval="<?= $this->config->item('carousel_interval') ?>">
                    <img src="<?= base_url('assets/img/dummy-slider.jpg') ?>" class="d-block m-auto img-fluid" alt="ICR Pedigree">
                </div>
                <div class="carousel-item" data-bs-interval="<?= $this->config->item('carousel_interval') ?>">
                    <img src="<?= base_url('assets/img/Pengumuman1.jpg') ?>" class="d-block m-auto img-fluid" alt="ICR Pedigree">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#adsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><?= lang("common_prev"); ?></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#adsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><?= lang("common_next"); ?></span>
            </button>
        </div>
        <?php if (!$this->session->userdata('username')){ ?>
            <div class="col-sm-12 text-center">
                <button class="btn btn-primary btn-lg" type="button" onclick="window.location = '<?= base_url() ?>frontend/Members'">Login</button>
                <button class="btn btn-danger btn-lg" type="button" onclick="window.location = '<?= base_url() ?>frontend/Members/register'"><?= lang("common_register"); ?></button>
            </div>
        <?php } ?>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script>
        $(document).ready(function(){
            <?php if ($this->session->flashdata('add_stud_success') || $this->session->flashdata('add_birth_success')){ ?>
                $('#message-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>
</html>