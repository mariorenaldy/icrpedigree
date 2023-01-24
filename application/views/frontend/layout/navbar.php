<nav class="navbar">
    <div class="flex-container d-flex justify-content-around align-items-end container-fluid fs-5">
        <a href="<?= base_url().'frontend/rules' ?>" class="text-decoration-none text-reset link-warning">Rules</a>
<?php 
    if ($this->session->userdata('username')) : ?>
        <a href="<?= base_url().'frontend/beranda' ?>" class="text-decoration-none text-reset link-warning">Home</a>
        <?php if ($this->session->userdata('mem_stat') == '1'){ ?>
            <div class="dropdown">
                <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Canine Registry
                </span>
                <ul class="dropdown-menu">
                    <!-- <li><a href="<?= base_url().'frontend/Pedigree' ?>" class="text-decoration-none text-reset link-warning">Cari Silsilah</a> -->
                    <li><a class="dropdown-item" href="<?= base_url().'frontend/Canines/add' ?>">Tambah Canine Generasi Satu</a></li>
                    <li><a class="dropdown-item" href="<?= base_url().'frontend/Studs/add' ?>">Lapor Pacak</a></li>
                    <!-- <li><a class="dropdown-item" href="<?= base_url().'frontend/Canines' ?>">List Canine</a></li> -->
                    <!-- <li><a class="dropdown-item" href="<?= base_url().'frontend/Canines/search_canine' ?>">Klaim Canine</a></li> -->
                    <!-- <li><a class="dropdown-item" href="<?= base_url().'frontend/Studs' ?>">List Pacak</a></li> -->
                    <!-- <li><a class="dropdown-item" href="<?= base_url().'frontend/Births' ?>">List Lahir</a></li> -->
                </ul>
            </div>
        <?php } ?>
        <div class="dropdown">
            <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?= $this->session->userdata('mem_pp') ?>" class="img-fluid pp" alt="pp">
                <?= $this->session->userdata('username') ?>
            </span>
            <ul class="dropdown-menu">
                <!-- <?php if ($this->session->userdata('mem_stat') == '1'){ ?>
                    <li><a class="dropdown-item" href="<?= base_url().'frontend/Kennels' ?>">List Kennel</a></li>
                <?php } ?> -->
                <li><a class="dropdown-item" href="<?= base_url().'frontend/Members/profile' ?>">Profile</a></li>
                <li><a class="dropdown-item" href="<?= base_url().'frontend/Members/view_edit_password' ?>">Ubah Password</a></li>
                <li><a class="dropdown-item" href="<?= base_url().'frontend/Members/logout' ?>">Logout</a></li>
            </ul>
        </div>
    <?php else : ?>
        <a href="<?= base_url().'frontend/Members' ?>" class="text-decoration-none text-reset link-warning">Members</a>
    <?php endif;?>
        <!-- <a href="<?= base_url().'frontend/marketplace' ?>" class="text-decoration-none text-reset link-warning">Marketplace</a> -->
    </div> 
</nav>
<hr>