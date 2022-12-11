<div class="header">
   <div class="title">
      <?php 
         if ($this->session->userdata('use_username')){ ?>
            <nav class="navbar">
                <div class="container-fluid">
                     <div class="dropdown">
                        <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Members</span>
                        <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="<?= base_url('backend/Members/view_approve') ?>">Approve</a></li>
                           <li><a class="dropdown-item" href="<?= base_url('backend/Members/') ?>">Manage</a></li>
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
                           <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <?= $this->session->userdata('use_username'); ?>
                           </span>
                           <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="<?= base_url('backend/Users/logout') ?>">Logout</a></li>
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