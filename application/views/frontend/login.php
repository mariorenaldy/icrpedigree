<main class="container">
    <article class="mt-5 mb-5">
        <div class="d-flex flex-column align-items-center">
            <div class="bg-white text-black p-5" style="min-height: 50vh; min-width: 50vw; border-radius: 50px;">
                <div style="margin-left: 10%; margin-right:10%;">
                    <header>
                        <h2 class="fw-bold">Sign In</h2>
                    </header>

                    <div class="d-flex flex-column gap-3" style="margin-top: 5%;">
                        <input type="text" placeholder="Username">
                        <input type="password" placeholder="Password">

                        <div>
                            <button id="btn-masuk" class="btn">Masuk</button>
                            <a href="<?= site_url('frontend/register') ?>" id="btn-daftar" class="btn">Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</main>