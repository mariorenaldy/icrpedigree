<main class="container">
    <article class="mt-5 mb-5">
        <div class="d-flex flex-column align-items-center">
            <div class="bg-white text-black p-5" style="min-height: 50vh; min-width: 50vw; border-radius: 50px;">
                <div style="margin-left: 10%; margin-right:10%;">
                    <header>
                        <h2 class="fw-bold">Sign In</h2>
                    </header>

                    <form action="<?= base_url() ?>" method="post" class="form-login d-flex flex-column gap-3" style="margin-top: 5%;">
                        <input type="text" placeholder="Username" id="username">
                        <input type="password" placeholder="Password" id="password">

                        <div>
                            <button id="btn-masuk" class="btn">Masuk</button>
                            <a href="<?= base_url('frontend/register') ?>" id="btn-daftar" class="btn">Daftar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </article>
</main>

<script src="{{base_url()}}assets/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{base_url()}}assets/oneui/js/pages/login.js"></script>