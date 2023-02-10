<div class="header">
   <div class="title">
      <?php 
         if ($this->session->userdata('use_username')){ ?>
            <nav class="navbar">
                <div class="container-fluid">
                  <a href="<?= base_url('backend/Dashboard') ?>" class="text-decoration-none text-reset link-primary">Dashboard</a>
                     <div class="dropdown">
                        <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Kennels</span>
                        <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="<?= base_url('backend/Members/view_approve') ?>">Approve Kennel</a></li>
                           <li><a class="dropdown-item" href="<?= base_url('backend/Members/') ?>">Manage Kennel</a></li>
                        </ul>
                     </div>
                     <div class="dropdown">
                        <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Canines</span>
                        <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="<?= base_url('backend/Canines/view_approve') ?>">Approve</a></li>
                           <li><a class="dropdown-item" href="<?= base_url('backend/Canines/') ?>">Manage</a></li>
                        </ul>
                     </div>
                     <div class="dropdown">
                        <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Studs</span>
                        <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="<?= base_url('backend/Studs/view_approve') ?>">Approve</a></li>
                           <li><a class="dropdown-item" href="<?= base_url('backend/Studs/') ?>">Manage</a></li>
                        </ul>
                     </div>
                     <div class="dropdown">
                        <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Births</span>
                        <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="<?= base_url('backend/Births/view_approve') ?>">Approve</a></li>
                           <li><a class="dropdown-item" href="<?= base_url('backend/Births/') ?>">Manage</a></li>
                        </ul>
                     </div>
                     <div class="dropdown">
                        <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Stambums</span>
                        <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="<?= base_url('backend/Stambums/view_approve') ?>">Approve</a></li>
                           <li><a class="dropdown-item" href="<?= base_url('backend/Stambums/') ?>">Manage</a></li>
                        </ul>
                     </div>
                     <?php if (!$this->session->userdata('use_akses')){ ?>
                        <div class="dropdown">
                              <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                 Config
                              </span>
                              <ul class="dropdown-menu">
                                 <li><a class="dropdown-item" href="<?= base_url('backend/News') ?>">News</a></li>
                                 <li><a class="dropdown-item" href="<?= base_url('backend/Notificationtype') ?>">Notification Type</a></li>
                                 <li><a class="dropdown-item" href="<?= base_url('backend/Rules') ?>">Rules</a></li>
                                 <li><a class="dropdown-item" href="<?= base_url('backend/Setting') ?>">Setting</a></li>
                                 <li><a class="dropdown-item" href="<?= base_url('backend/Users') ?>">Users</a></li>
                              </ul>
                        </div>
                     <?php } ?>
                     <div class="dropdown">
                           <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <?= $this->session->userdata('use_username'); ?>
                           </span>
                           <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="<?= base_url('backend/Users/edit_password') ?>">Edit Password</a></li>
                              <li><a class="dropdown-item" href="<?= base_url('backend/Users/logout') ?>">Logout</a></li>
                           </ul>
                     </div>
                </div>
            </nav>
      <?php } else { ?>
         <h1 class="text-center">ICR Pedigree</h1>
      <?php } ?>
   </div>
   <hr/>
</div>