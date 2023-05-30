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
                <button type="button" data-bs-target="#adsCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#adsCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner mb-5">
                <div class="carousel-item active" data-bs-interval="<?= $this->config->item('carousel_interval') ?>">
                    <a href="https://www.facebook.com/Indonesian-Canine-Registry-1793017194288491/"><img src="<?= base_url('assets/img/lombafotoicr.png') ?>" class="d-block m-auto img-fluid" alt="ICR Pedigree"></a>
                </div>
                <div class="carousel-item" data-bs-interval="<?= $this->config->item('carousel_interval') ?>">
                    <img src="<?= base_url('assets/img/Pengumuman1.jpg') ?>" class="d-block m-auto img-fluid" alt="ICR Pedigree">
                </div>
                <div class="carousel-item" data-bs-interval="<?= $this->config->item('carousel_interval') ?>">
                    <video id="carouselVideo2" controls muted autoplay class="d-block m-auto">
                        <source src="<?= base_url('assets/video/OneEyedJack.mp4') ?>" type="video/mp4">
                        <?= lang("home_video_error"); ?>
                    </video>
                </div>
                <div class="carousel-item" data-bs-interval="<?= $this->config->item('carousel_interval') ?>">
                    <img src="<?= base_url('assets/img/dummy-slider.jpg') ?>" class="d-block m-auto img-fluid" alt="ICR Pedigree">
                </div>
                <!-- <div class="carousel-item" data-bs-interval="<?= $this->config->item('carousel_interval') ?>">
                    <iframe width="<?= $this->config->item('youtube_width') ?>" height="<?= $this->config->item('youtube_height') ?>" 
                        src="https://www.youtube.com/embed/4iEKJa9cK-Y?autoplay=1&mute=1"
                        class="d-block m-auto">
                    </iframe>
                </div> -->
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
        <div id="dogsCarousel" class="carousel slide" data-bs-ride="carousel" style="width: <?= $this->config->item('carousel_width') ?>">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#dogsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#dogsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#dogsCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner mb-5">
                <div class="carousel-item active" data-bs-interval="<?= $this->config->item('carousel_interval') ?>">
                    <table>
                        <tr>
                            <td class="border border-warning">
                                <img src="<?= base_url('uploads/canine/'.$dogs[0]['can_photo']) ?>" class="d-block img-fluid">
                            </td>
                            <td class="border border-warning">
                                <img src="<?= base_url('uploads/canine/'.$dogs[1]['can_photo']) ?>" class="d-block img-fluid">
                            </td>
                            <td class="border border-warning">
                                <img src="<?= base_url('uploads/canine/'.$dogs[2]['can_photo']) ?>" class="d-block img-fluid">
                            </td>
                            <td class="border border-warning">
                                <img src="<?= base_url('uploads/canine/'.$dogs[3]['can_photo']) ?>" class="d-block img-fluid">
                            </td>
                            <td class="border border-warning">
                                <img src="<?= base_url('uploads/canine/'.$dogs[4]['can_photo']) ?>" class="d-block img-fluid">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="carousel-item" data-bs-interval="<?= $this->config->item('carousel_interval') ?>">
                    <table>
                        <tr>
                            <td class="border border-warning">
                                <img src="<?= base_url('uploads/canine/'.$dogs[5]['can_photo']) ?>" class="d-block m-auto img-fluid">
                            </td>
                            <td class="border border-warning">
                                <img src="<?= base_url('uploads/canine/'.$dogs[6]['can_photo']) ?>" class="d-block m-auto img-fluid">
                            </td>
                            <td class="border border-warning">
                                <img src="<?= base_url('uploads/canine/'.$dogs[7]['can_photo']) ?>" class="d-block m-auto img-fluid">
                            </td>
                            <td class="border border-warning">
                                <img src="<?= base_url('uploads/canine/'.$dogs[8]['can_photo']) ?>" class="d-block m-auto img-fluid">
                            </td>
                            <td class="border border-warning">
                                <img src="<?= base_url('uploads/canine/'.$dogs[9]['can_photo']) ?>" class="d-block m-auto img-fluid">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="carousel-item" data-bs-interval="<?= $this->config->item('carousel_interval') ?>">
                    <table>
                        <tr>
                            <td class="border border-warning">
                                <img src="<?= base_url('uploads/canine/'.$dogs[10]['can_photo']) ?>" class="d-block m-auto img-fluid">
                            </td>
                            <td class="border border-warning">
                                <img src="<?= base_url('uploads/canine/'.$dogs[11]['can_photo']) ?>" class="d-block m-auto img-fluid">
                            </td>
                            <td class="border border-warning">
                                <img src="<?= base_url('uploads/canine/'.$dogs[12]['can_photo']) ?>" class="d-block m-auto img-fluid">
                            </td>
                            <td class="border border-warning">
                                <img src="<?= base_url('uploads/canine/'.$dogs[13]['can_photo']) ?>" class="d-block m-auto img-fluid">
                            </td>
                            <td class="border border-warning">
                                <img src="<?= base_url('uploads/canine/'.$dogs[14]['can_photo']) ?>" class="d-block m-auto img-fluid">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#dogsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><?= lang("common_prev"); ?></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#dogsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><?= lang("common_next"); ?></span>
            </button>
        </div>
        <?php if (!$this->session->userdata('username')){ ?>
            <div class="col-sm-12 text-center">
                <button class="btn btn-primary btn-lg" type="button" onclick="window.location = '<?= base_url() ?>frontend/Members'">Login</button>
                <button class="btn btn-danger btn-lg" type="button" onclick="window.location = '<?= base_url() ?>frontend/Members/register'"><?= lang("common_register"); ?></button>
                <!-- <a href="mailto:icr_indonesia@yahoo.com" id="article-button" class="btn text-decoration-none text-reset">Hubungi Kami</a> -->
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