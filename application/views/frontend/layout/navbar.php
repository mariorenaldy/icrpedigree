<?php 
if ($this->session->userdata('username')) : ?>
    <nav class="navbar">
        <div class="flex-container d-flex justify-content-around align-items-end container-fluid fs-5">
            <a href="<?= base_url('frontend/rules') ?>" class="text-decoration-none text-reset link-primary">Rules</a>
            <a href="<?= base_url('frontend/beranda') ?>" class="text-decoration-none text-reset link-primary">Beranda</a>
            <!-- <a href="<?= base_url('frontend/acara') ?>" class="text-decoration-none text-reset link-primary">Acara</a> -->
            <!-- <a href="<?= base_url('frontend/Pedigree') ?>" class="text-decoration-none text-reset link-primary">Cari Silsilah</a> -->
            <a href="<?= base_url('frontend/Canines') ?>" class="text-decoration-none text-reset link-primary">List Canine</a>
            <a href="<?= base_url('frontend/Studs') ?>" class="text-decoration-none text-reset link-primary">List Pacak</a>
            <a href="<?= base_url('frontend/Births') ?>" class="text-decoration-none text-reset link-primary">List Lahir</a>
            <div class="dropdown">
                <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= $this->session->userdata('username') ?>
                </span>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?= base_url('frontend/Members/logout') ?>">Logout</a></li>
                </ul>
            </div>
            <a href="<?= base_url('frontend/marketplace') ?>" class="text-decoration-none text-reset link-primary">Marketplace</a>
        </div> 
    </nav>
    <hr>
<?php else : ?>
    <nav class="navbar">
        <div class="flex-container d-flex justify-content-around align-items-end container-fluid fs-5">
            <a href="<?= base_url('frontend/Rules') ?>" class="text-decoration-none text-reset link-primary">Rules</a>
            <a href="<?= base_url('frontend/Members') ?>" class="text-decoration-none text-reset link-primary">Members</a>
            <a href="<?= base_url('frontend/Marketplace') ?>" class="text-decoration-none text-reset link-primary">Marketplace</a>
        </div>
    </nav>
    <hr>
<?php endif;?>