<div class="header">
   <div class="title">
      <?php 
         if ($this->session->userdata('use_username')){ ?>
            <nav class="navbar navbar-dark bg-dark text-light fixed-top my-navbar">
                <div class="container-fluid">
                  <a href="<?= base_url('backend/Dashboard') ?>" class="text-decoration-none text-reset link-primary">Dashboard</a>
                     <div class="dropdown">
                        <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Kennels</span>
                        <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="<?= base_url('backend/Members/view_approve') ?>">Approve</a></li>
                           <li><a class="dropdown-item" href="<?= base_url('backend/Members/') ?>">Manage</a></li>
                           <li><a class="dropdown-item" href="<?= base_url('backend/Requestmember') ?>">Approve Update Kennel</a></li>
                           <!-- <li><a class="dropdown-item" href="<?= base_url('backend/Requestreset') ?>">Approve Reset Password</a></li> -->
                           <li><a class="dropdown-item" href="<?= base_url('backend/Requestpro') ?>">Approve Become Pro</a></li>
                        </ul>
                     </div>
                     <div class="dropdown">
                        <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Canines</span>
                        <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="<?= base_url('backend/Canines/view_approve') ?>">Approve</a></li>
                           <li><a class="dropdown-item" href="<?= base_url('backend/Canines/') ?>">Manage</a></li>
                           <li><a class="dropdown-item" href="<?= base_url('backend/Requestownershipcanine') ?>">Approve Change Ownership</a></li>
                           <li><a class="dropdown-item" href="<?= base_url('backend/Requestupdatecanine') ?>">Approve Update Photo & RIP</a></li>
                           <li><a class="dropdown-item" href="<?= base_url('backend/Requestexport') ?>">Approve Export Stambum</a></li>
                           <li><a class="dropdown-item" href="<?= base_url('backend/Requestexport/manage') ?>">Manage Export Stambum</a></li>
                        </ul>
                     </div>
                     <div class="dropdown">
                        <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Studs</span>
                        <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="<?= base_url('backend/Studs/view_approve') ?>">Approve</a></li>
                           <li><a class="dropdown-item" href="<?= base_url('backend/Studs/') ?>">Manage</a></li>
                           <li><a class="dropdown-item" href="<?= base_url('backend/Studs/all') ?>">Log</a></li>
                        </ul>
                     </div>
                     <div class="dropdown">
                        <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Births</span>
                        <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="<?= base_url('backend/Births/view_approve') ?>">Approve</a></li>
                           <li><a class="dropdown-item" href="<?= base_url('backend/Births/') ?>">Manage</a></li>
                           <li><a class="dropdown-item" href="<?= base_url('backend/Requestupdatebirth') ?>">Approve Update Birth</a></li>
                           <li><a class="dropdown-item" href="<?= base_url('backend/Births/all') ?>">Log</a></li>
                        </ul>
                     </div>
                     <div class="dropdown">
                        <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Puppies</span>
                        <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="<?= base_url('backend/Stambums/view_approve') ?>">Approve</a></li>
                           <li><a class="dropdown-item" href="<?= base_url('backend/Stambums/') ?>">Manage</a></li>
                        </ul>
                     </div>
                     <div class="dropdown">
                        <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Marketplace</span>
                        <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="<?= base_url('marketplace/Products/listProducts') ?>">Manage Products</a></li>
                           <li><a class="dropdown-item" href="<?= base_url('marketplace/Orders/listOrders') ?>">Manage Orders</a></li>
                        </ul>
                     </div>
                     <div class="dropdown">
                           <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Config
                           </span>
                           <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= base_url('backend/Breeds') ?>">Breeds</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('backend/News') ?>">News</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('backend/Notificationtype') ?>">Notification Type</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('backend/Users') ?>">Users</a></li>
                           </ul>
                     </div>
                     <div class="dropdown me-5">
                        <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                           <img src="<?= $this->session->userdata('use_pp') ?>" class="img-fluid pp" alt="pp"> <?= $this->session->userdata('use_username') ?>
                        </span>
                           <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="<?= base_url('backend/Users/edit_pp') ?>">Change PP</a></li>
                              <li><a class="dropdown-item" href="<?= base_url('backend/Users/edit_password') ?>">Edit Password</a></li>
                              <li><a class="dropdown-item" href="<?= base_url('backend/Users/logout') ?>">Logout</a></li>
                           </ul>
                     </div>
                </div>
            </nav>
            <div class="mt-5"></div>
      <?php } else { ?>
         <h1 class="text-center">ICR Pedigree</h1>
      <?php } ?>
   </div>
   <hr/>
</div>