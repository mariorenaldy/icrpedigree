<nav class="navbar">
    <div class="flex-container d-flex justify-content-around align-items-end container-fluid fs-5">
        <?php if ($this->session->userdata('username')){ ?>
            <a href="<?= base_url().'frontend/Beranda' ?>" class="text-decoration-none text-reset link-warning"><i class="fa fa-home"></i><span class="nav-text"> Home</span></a>
        <?php } ?>
        <a href="<?= base_url().'frontend/Rules' ?>" class="text-decoration-none text-reset link-warning"><i class="fa fa-list"></i><span class="nav-text"> Rules</span></a>
        <!-- <a href="<?= base_url().'frontend/News' ?>" class="text-decoration-none text-reset link-warning"><i class="fa fa-newspaper"></i><span class="nav-text"> News</span></a> -->
        <?php if ($this->session->userdata('username')) : ?>
            <?php if ($this->session->userdata('mem_type') == '1'){ ?>
                <div class="dropdown">
                    <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-file"></i><span class="nav-text"> Canine Registry</span>
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
            <a href="<?= base_url().'frontend/Canines' ?>" class="text-decoration-none text-reset link-warning"><i class="fa fa-dog"></i><span class="nav-text"> My Canine</span></a>
            <!-- <a href="<?= base_url().'frontend/Notification' ?>" class="text-decoration-none text-reset link-warning"><i class="fas fa-envelope"></i><?= $this->session->userdata('notif_count') ?></a></li> -->
            <div class="dropdown">
                <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?= $this->session->userdata('mem_pp') ?>" class="img-fluid pp" alt="pp">
                    <span class="nav-text"> <?= $this->session->userdata('username') ?></span>
                </span>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?= base_url().'frontend/Members/profile' ?>">Profile</a></li>
                    <li><a class="dropdown-item" href="<?= base_url().'frontend/Members/view_edit_password' ?>">Ubah Password</a></li>
                    <li><a class="dropdown-item" href="<?= base_url().'frontend/Members/logout' ?>">Logout</a></li>
                </ul>
            </div>
        <?php else : ?>
            <a href="<?= base_url().'frontend/Members' ?>" class="text-decoration-none text-reset link-warning"><i class="fa fa-user"></i><span class="nav-text"> Members</span></a>
        <?php endif;?>
            <!-- <a href="<?= base_url().'frontend/marketplace' ?>" class="text-decoration-none text-reset link-warning"><i class="fa fa-shopping-cart"></i><span class="nav-text"> Marketplace</span></a> -->
    </div> 
</nav>
<hr>