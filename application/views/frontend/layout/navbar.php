<?php 
if ($this->session->userdata('username')) : ?>
    <nav class="navbar">
        <div class="flex-container d-flex justify-content-around align-items-end container-fluid fs-5">
            <a href="<?= base_url('frontend/rules') ?>" class="text-decoration-none text-reset link-warning">Rules</a>
            <a href="<?= base_url('frontend/beranda') ?>" class="text-decoration-none text-reset link-warning">Beranda</a>
            <!-- <a href="<?= base_url('frontend/acara') ?>" class="text-decoration-none text-reset link-warning">Acara</a> -->
            <?php if ($this->session->userdata('mem_stat') == '1'){ ?>
                <div class="dropdown">
                    <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Canine Registry
                    </span>
                    <ul class="dropdown-menu">
                        <!-- <li><a href="<?= base_url('frontend/Pedigree') ?>" class="text-decoration-none text-reset link-warning">Cari Silsilah</a> -->
                        <li><a class="dropdown-item" href="<?= base_url('frontend/Canines') ?>">List Canine</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('frontend/Studs') ?>">List Pacak</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('frontend/Births') ?>">List Lahir</a></li>
                    </ul>
                </div>
            <?php } ?>
            <div class="dropdown">
                <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?= base_url('uploads/members/'.$this->session->userdata('mem_pp')) ?>" class="img-fluid" style="max-width: 25px;">
                    <?= $this->session->userdata('username') ?>
                </span>
                <ul class="dropdown-menu">
                    <?php if ($this->session->userdata('mem_stat') == '1'){ ?>
                        <li><a class="dropdown-item" href="<?= base_url('frontend/Kennels') ?>">List Kennel</a></li>
                    <?php } ?>
                    <li><a class="dropdown-item" href="<?= base_url('frontend/Members/profile') ?>">Profile</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('frontend/Members/view_edit_password') ?>">Ubah Password</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('frontend/Members/logout') ?>">Logout</a></li>
                </ul>
            </div>
            <a href="<?= base_url('frontend/marketplace') ?>" class="text-decoration-none text-reset link-warning">Marketplace</a>
        </div> 
    </nav>
    <hr>
<?php else : ?>
    <nav class="navbar">
        <div class="flex-container d-flex justify-content-around align-items-end container-fluid fs-5">
            <a href="<?= base_url('frontend/Rules') ?>" class="text-decoration-none text-reset link-warning">Rules</a>
            <a href="<?= base_url('frontend/Members') ?>" class="text-decoration-none text-reset link-warning">Members</a>
            <a href="<?= base_url('frontend/Marketplace') ?>" class="text-decoration-none text-reset link-warning">Marketplace</a>
        </div>
    </nav>
    <hr>
<?php endif;?>