<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_non_paid'); ?> 
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container" id="beranda-main">
        <article class="row align-items-center justify-content-around">
            <div class="col-md-12 text-center mb-1">
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
            <div class="col-md-6 mb-5">
                <header>
                    <h2 id="article-heading" class="fw-bold">Pastikan anjing kesayangan anda tersertifikasi</h2>
                </header>
                <p id="article-paragraph">Kami siap melayani!</p>
                <a href="#contact" id="article-button" class="btn text-decoration-none text-reset">Hubungi Kami</a>
            </div>
            <aside class="col-md-auto">
                <figure>
                    <img src="<?= base_url('assets/img/icr_logo.png') ?>" class="center-block text-center" style="width: 30vw;">
                </figure>
            </aside>
            <div class="col-md-12 text-center">
                <video controls muted style="width: 30vw; margin-top: 5vh;">
                    <source src="<?= base_url('assets/video/OneEyedJack.mp4') ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </article>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
</html>