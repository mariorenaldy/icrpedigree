<nav class="navbar">
    <div class="flex-container d-flex justify-content-around align-items-end container-fluid fs-5">
        <?php if ($this->session->userdata('username')){ ?>
            <a href="<?= base_url().'frontend/Beranda' ?>" class="text-decoration-none text-reset link-warning"><i class="fa fa-home"></i> Home</a>
        <?php } ?>
        <a href="<?= base_url().'frontend/Rules' ?>" class="text-decoration-none text-reset link-warning"><i class="fa fa-list"></i> Rules</a>
        <!-- <a href="<?= base_url().'frontend/News' ?>" class="text-decoration-none text-reset link-warning"><i class="fa fa-newspaper"></i> News</a> -->
        <?php if ($this->session->userdata('username')) : ?>
            <?php if ($this->session->userdata('mem_type') == '1'){ ?>
                <div class="dropdown">
                    <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-file"></i> Canine Registry
                    </span>
                    <ul class="dropdown-menu">
                        <!-- <li><a href="<?= base_url().'frontend/Pedigree' ?>" class="text-decoration-none text-reset link-warning">Cari Silsilah</a> -->
                        <li><a class="dropdown-item" href="<?= base_url().'frontend/Canines/add' ?>">Tambah Canine Generasi Satu</a></li>
                        <li><a class="dropdown-item" href="<?= base_url().'frontend/Studs/add' ?>">Lapor Pacak</a></li>
                        <!-- <li><a class="dropdown-item" href="<?= base_url().'frontend/Studs' ?>">List Pacak</a></li> -->
                        <!-- <li><a class="dropdown-item" href="<?= base_url().'frontend/Births' ?>">List Lahir</a></li> -->
                    </ul>
                </div>
            <?php } ?>
            <a href="<?= base_url().'frontend/Canines' ?>" class="text-decoration-none text-reset link-warning"><i class="fa fa-dog"></i> My Canine</a>
            <!-- <a href="<?= base_url().'frontend/Notification' ?>" class="text-decoration-none text-reset link-warning"><i class="fas fa-envelope"></i> <?= $this->session->userdata('notif_count') ?></a></li> -->
            <div class="dropdown">
                <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?= $this->session->userdata('mem_pp') ?>" class="img-fluid pp" alt="pp">
                    <?= $this->session->userdata('username') ?>
                </span>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?= base_url().'frontend/Members/profile' ?>">Profile</a></li>
                    <li><a class="dropdown-item" href="<?= base_url().'frontend/Members/view_edit_password' ?>">Ubah Password</a></li>
                    <li><a class="dropdown-item" href="<?= base_url().'frontend/Members/logout' ?>">Logout</a></li>
                </ul>
            </div>
        <?php else : ?>
            <a href="<?= base_url().'frontend/Members' ?>" class="text-decoration-none text-reset link-warning"><i class="fa fa-user"></i> Members</a>
        <?php endif;?>
            <!-- <a href="<?= base_url().'frontend/marketplace' ?>" class="text-decoration-none text-reset link-warning"><i class="fa fa-shopping-cart"></i> Marketplace</a> -->
    </div> 
</nav>
<hr>