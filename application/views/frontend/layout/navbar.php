<nav class="navbar navbar-expand-lg navbar-dark my-navbar">
    <button class="navbar-toggler mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#mainCollapse" aria-controls="mainCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span style="color:white">MENU</span>
    </button>
    <div class="collapse navbar-collapse" id="mainCollapse">
        <div class="flex-container d-flex justify-content-around align-items-center container-fluid fs-5 navbar-nav" id="main-nav-container" style="height:70px;">
            <a href="<?= base_url().'frontend/Beranda' ?>" class="text-decoration-none text-reset link-warning"><i class="fa fa-home"></i> <span class="nav-text"><?= lang("nav_home"); ?></span></a>
            <a href="<?= base_url().'frontend/Rules' ?>" class="text-decoration-none text-reset link-warning"><i class="fa fa-list"></i> <span class="nav-text"><?= lang("nav_rules"); ?></span></a>
            <a href="<?= base_url().'frontend/News' ?>" class="text-decoration-none text-reset link-warning"><i class="fa fa-newspaper"></i> <span class="nav-text"><?= lang("nav_news"); ?></span></a>
            <?php if ($this->session->userdata('username')){ ?>
                <a href="<?= base_url().'frontend/Pedigree' ?>" class="text-decoration-none text-reset link-warning"><i class="fas fa-book-open"></i> <span class="nav-text"><?= lang("nav_find_dogs"); ?></span></a>
                <?php if ($this->session->userdata('mem_type') == '1'){ ?>
                    <div class="dropdown">
                        <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-file"></i> <span class="nav-text"><?= lang("nav_registration"); ?></span>
                        </span>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url().'frontend/Canines/add' ?>"><?= lang("nav_add_first_generation"); ?></a></li>
                            <li><a class="dropdown-item" href="<?= base_url().'frontend/Requestexport/add' ?>"><?= lang("nav_export_stambum"); ?></a></li>
                            <li><a class="dropdown-item" href="<?= base_url().'frontend/Studs/add' ?>"><?= lang("nav_report_stud"); ?></a></li>
                            <li><a class="dropdown-item" href="<?= base_url().'frontend/Studs/view_approved' ?>"><?= lang("nav_report_birth"); ?></a></li>
                            <li><a class="dropdown-item" href="<?= base_url().'frontend/Births/view_approved' ?>"><?= lang("nav_report_puppy"); ?></a></li>
                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item" href="<?= base_url().'frontend/Studs' ?>"><?= lang("nav_stud_list"); ?></a></li>
                            <li><a class="dropdown-item" href="<?= base_url().'frontend/Births' ?>"><?= lang("nav_birth_list"); ?></a></li>
                            <li><a class="dropdown-item" href="<?= base_url().'frontend/Stambums' ?>"><?= lang("nav_puppy_list"); ?></a></li>
                        </ul>
                    </div>
                <?php } ?>
                <a href="<?= base_url().'frontend/Canines' ?>" class="text-decoration-none text-reset link-warning"><i class="fa fa-dog"></i> <span class="nav-text"><?= lang("nav_my_dogs"); ?></span></a>
                <a href="<?= base_url().'frontend/Notification' ?>" class="text-decoration-none text-reset link-warning" id="notif-nav"><i class="fas fa-envelope"></i><br> <span class="nav-text notif-text text-warning"><?= $this->session->userdata('notif_count') ?></span></a></li>
                <div class="dropdown">
                    <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?= $this->session->userdata('mem_pp') ?>" class="img-fluid pp" alt="pp"> <span class="nav-text notif-text"><?= $this->session->userdata('mem_name') ?></span>
                    </span>
                    <ul class="dropdown-menu">
                        <?php if ($this->session->userdata('mem_type') == $this->config->item('pro_member')){ ?>
                            <li><a class="dropdown-item" href="<?= base_url() ?>frontend/Requestmember/edit_profile"><?= lang("nav_report_kennel_change"); ?></a></li>
                            <li><a class="dropdown-item" href="<?= base_url() ?>frontend/Requestmember"><?= lang("nav_kennel_change_list"); ?></a></li>
                        <?php } else { ?>
                            <li><a class="dropdown-item" href="<?= base_url() ?>frontend/Requestpro/become_pro"><?= lang("nav_become_pro"); ?></a></li>
                            <li><a class="dropdown-item" href="<?= base_url() ?>frontend/Requestpro"><?= lang("nav_become_pro_list"); ?></a></li>
                        <?php } ?>
                        <li><a class="dropdown-item" href="<?= base_url().'frontend/Members/profile' ?>"><?= lang("nav_profile"); ?></a></li>
                        <li><a class="dropdown-item" href="<?= base_url().'frontend/Members/view_edit_password' ?>"><?= lang("nav_change_password"); ?></a></li>
                        <li><a class="dropdown-item" href="<?= base_url().'frontend/Members/logout' ?>">Logout</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-shopping-cart"></i> <span class="nav-text">Marketplace</span> 
                    </span>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url().'marketplace/Products' ?>">Produk</a></li>
                        <li><a class="dropdown-item" href="<?= base_url().'marketplace/Orders' ?>">Orders</a></li>
                    </ul>
                </div>
            <?php } else { ?>
                <a href="<?= base_url().'frontend/Pedigree/view' ?>" class="text-decoration-none text-reset link-warning"><i class="fas fa-book-open"></i> <span class="nav-text"><?= lang("nav_find_dogs"); ?></span></a>
                <a href="<?= base_url().'frontend/Members' ?>" class="text-decoration-none text-reset link-warning"><i class="fa fa-user"></i> <span class="nav-text">Members</span></a>
            <?php } ?>
                <div class="dropdown">
                    <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php if ($this->input->cookie('site_lang') && $this->input->cookie('site_lang') == 'english') { ?>
                        <i class="fa fa-language"></i> <span class="nav-text">Eng</span> 
                    </span>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url().'frontend/LangSwitch/switchLanguage/indonesia' ?>">Ind</a></li>
                        </ul>
                    <?php } else { ?>
                        <i class="fa fa-language"></i> <span class="nav-text">Ind</span> 
                    </span>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url().'frontend/LangSwitch/switchLanguage/english' ?>">Eng</a></li>
                        </ul>
                    <?php } ?>
                </div>
        </div>
    </div>
</nav>
<hr>
