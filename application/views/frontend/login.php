<main class="container">
    <article class="mt-5 mb-5">
        <div class="d-flex flex-column align-items-center">
            <div class="bg-white text-black p-5" style="min-height: 50vh; min-width: 50vw; border-radius: 50px;">
                <div style="margin-left: 10%; margin-right:10%;">
                    <header>
                        <h2 class="fw-bold">Sign In</h2>
                    </header>

                    <!-- <form action="<?= base_url('backend/auth') ?>" method="post" class="form-login d-flex flex-column gap-3" style="margin-top: 5%;">
                        <input type="text" placeholder="Username" id="username">
                        <input type="password" placeholder="Password" id="password">

                        <div>
                            <button id="btn-masuk" class="btn">Masuk</button>
                            <a href="<?= site_url('frontend/register') ?>" id="btn-daftar" class="btn">Daftar</a>
                        </div>
                    </form> -->

                    <div class="block-content ">
                      <form class="form-horizontal form-login" action="<?= base_url('backend/auth') ?>" method="post">
                        <div class="form-group">
                          <label class="control-label" for="username">Username</label>
                          <div class="">
                            <input class="form-control" type="text" id="username" name="username" placeholder="Masukan username" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label" for="password">Password</label>
                          <div class="">
                            <input class="form-control" type="password" id="password" name="password" placeholder="Masukan password">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="">
                            <button class="btn btn-md btn-default" type="submit"><i class="si si-login"></i> Masuk</button>
                            <!-- <a href="#" class="h5" style="float:right;margin-top:9px;">Lupa kata sandi?</a> -->
                          </div>
                        </div>
                      </form>
                    </div>

                </div>
            </div>
        </div>
    </article>
</main>

<script src="{{base_url()}}assets/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{base_url()}}assets/oneui/js/pages/login.js"></script>