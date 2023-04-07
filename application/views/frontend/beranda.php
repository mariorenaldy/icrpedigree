<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
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
            </div>
            <div class="carousel-inner mb-5">
                <div class="carousel-item active" data-bs-interval="<?= $this->config->item('carousel_interval') ?>">
                    <img src="<?= base_url('assets/img/Pengumuman1.jpg') ?>" class="d-block m-auto img-fluid" alt="ICR Pedigree">
                </div>
                <div class="carousel-item" data-bs-interval="<?= $this->config->item('carousel_interval') ?>">
                    <video id="carouselVideo" controls muted autoplay class="d-block m-auto">
                        <source src="<?= base_url('assets/video/OneEyedJack.mp4') ?>" type="video/mp4">
                        Your browser does not support the video tag.
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
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#adsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <?php if (!$this->session->userdata('username')){ ?>
            <div class="col-sm-12 text-center">
                <button class="btn btn-primary btn-lg" type="button" onclick="window.location = '<?= base_url() ?>frontend/Members'">Login</button>
                <button class="btn btn-danger btn-lg" type="button" onclick="window.location = '<?= base_url() ?>frontend/Members/register'"><?= lang("home_register"); ?></button>
                <!-- <a href="mailto:icr_indonesia@yahoo.com" id="article-button" class="btn text-decoration-none text-reset">Hubungi Kami</a> -->
            </div>
        <?php } ?>
        <div class="modal fade text-dark" id="message-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pemberitahuan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-success">
                            <?php if ($this->session->flashdata('add_stud_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Pacak berhasil disimpan</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('add_birth_success')){ ?>
                                <div class="row">
                                    <div class="col-12">Lahir berhasil disimpan</div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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