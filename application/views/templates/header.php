<div class="header">
   <div class="title">
      <?php 
         if ($this->session->userdata('use_username')){ ?>
            <nav class="navbar">
                <div class="container-fluid">
                    <a href="<?= site_url('backend/Members') ?>" class="text-decoration-none text-reset link-primary">Kelola Member</a>
                    <a href="<?= site_url('backend/Canines/view_approve') ?>" class="text-decoration-none text-reset link-primary">Kelola Anjing</a>
                    <a href="<?= site_url('backend/Studs') ?>" class="text-decoration-none text-reset link-primary">Kelola Pacak</a>
                    <a href="<?= site_url('backend/Births') ?>" class="text-decoration-none text-reset link-primary">Kelola Lahir</a>
                    <div class="dropdown">
                        <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                           <?php echo $this->session->userdata('use_username'); ?>
                        </span>
                        <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="<?= site_url('backend/Users/logout') ?>">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
      <?php } else { ?>
         <h1>ICR Pedigree</h1>
      <?php } ?>
   </div>
   <hr/>
</div>