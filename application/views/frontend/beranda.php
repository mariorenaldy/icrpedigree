<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?> 
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container" id="beranda-main">
        <article class="row align-items-center justify-content-around">
            <div class="col-sm-12 text-center mb-1">
                <div class="text-success mb-3">
                    <?php		
                        if ($this->session->flashdata('add_canine_success')){
                            echo 'Canine berhasil disimpan<br/>';
                        }
                        if ($this->session->flashdata('add_stud_success')){
                            echo 'Pacak berhasil disimpan<br/>';
                        }
                    ?>
                </div>
            </div>
            <div id="adsCarousel" class="carousel slide" data-bs-ride="carousel" style="width: 800px;">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#adsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#adsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#adsCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner mb-5">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="<?= base_url('assets/img/brown-dog.svg') ?>" class="d-block m-auto" alt="..." style="height:300px;">
                    </div>
                    <div class="carousel-item"  data-bs-interval="10000">
                        <img src="<?= base_url('assets/img/white-dog.svg') ?>" class="d-block m-auto" alt="..." style="height:300px;">
                    </div>
                    <div class="carousel-item"  data-bs-interval="10000">
                        <video id="carouselVideo" controls muted autoplay class="d-block m-auto" style="height:300px;">
                            <source src="<?= base_url('assets/video/OneEyedJack.mp4') ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
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
            <div class="col-sm-6 mb-5">
                <header>
                    <h2 id="article-heading" class="fw-bold">Pastikan anjing kesayangan anda tersertifikasi</h2>
                </header>
                <p id="article-paragraph">Kami siap melayani!</p>
                <a href="#contact" id="article-button" class="btn text-decoration-none text-reset">Hubungi Kami</a>
            </div>
            <aside class="col-sm-6 text-center">
                <figure>
                    <img src="<?= base_url('assets/img/icr_logo.png') ?>" class="center-block text-center" style="width: 30vw;">
                </figure>
            </aside>
            <!-- <div class="col-sm-12 text-center">
                <video controls muted style="width: 30vw; margin-top: 5vh;">
                    <source src="<?= base_url('assets/video/OneEyedJack.mp4') ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div> -->
        </article>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
</html>