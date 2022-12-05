<main class="container" id="beranda-main">
    <article class="align-items-center justify-content-around">
        <header>
            <h2 class="text-center fw-bold">List Lahir</h2>
        </header>

        <div class="search-container">
            <form action="/action_page.php">
            <input type="text" placeholder="Nama" name="search">
            <button type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
        
        <table class="table text-white">
        <thead>
            <tr>
            <th scope="col">Foto</th>
            <th scope="col">Nama</th>
            <th scope="col">Keterangan</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="col"><img src="<?= base_url('uploads/canines/rottweiler.png') ?>"></th>
            <th scope="col">Chop</th>
            <th scope="col"><a href="edit_canine" class="btn btn-light"><i class="bi bi-pencil-square"></i></a></th>
            <th scope="col"><a href="canine_detail" class="btn btn-light"><i class="bi bi-list"></i></a></th>
            </tr>
            <tr>
            <th scope="col"><img src="<?= base_url('uploads/canines/pharaoh-hound.png') ?>"></th>
            <th scope="col">Terry</th>
            <th scope="col"><a href="edit_canine" class="btn btn-light"><i class="bi bi-pencil-square"></i></a></th>
            <th scope="col"><a href="canine_detail" class="btn btn-light"><i class="bi bi-list"></i></a></th>
            </tr>
            <tr>
            <th scope="col"><img src="<?= base_url('uploads/canines/wolfdog.png') ?>"></th>
            <th scope="col">Rain</th>
            <th scope="col"><a href="edit_canine" class="btn btn-light"><i class="bi bi-pencil-square"></i></a></th>
            <th scope="col"><a href="canine_detail" class="btn btn-light"><i class="bi bi-list"></i></a></th>
            </tr>
        </tbody>
        </table>
    </article>
</main>