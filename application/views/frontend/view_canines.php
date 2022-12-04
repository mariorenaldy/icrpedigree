<main class="container" id="beranda-main">
    <article class="row align-items-center justify-content-around">
        <header>
            <h2 class="text-center fw-bold">List Anjing</h2>
        </header>

        <div class="search-container">
            <form action="/action_page.php">
            <input type="text" placeholder="No. ICR/Nama" name="search">
            <button type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
        
        <table class="table text-white">
        <thead>
            <tr>
            <th scope="col">Foto</th>
            <th scope="col">Nomor ICR</th>
            <th scope="col">Nama</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="col"><img src="<?= base_url('uploads/canines/husky.png') ?>"></th>
            <th scope="col">121</th>
            <th scope="col">Snow</th>
            <th scope="col"><a href="canine_detail" class="btn btn-light"><i class="bi bi-list"></i></a></th>
            <th scope="col"><a href="edit_canine" class="btn btn-light"><i class="bi bi-pencil-square"></i></a></th>
            <th scope="col"><a href="canine_detail" class="btn btn-light"><i class="bi bi-file-earmark"></i></a></th>
            </tr>
            <tr>
            <th scope="col"><img src="<?= base_url('uploads/canines/poodle.png') ?>"></th>
            <th scope="col">122</th>
            <th scope="col">Sera</th>
            <th scope="col"><a href="canine_detail" class="btn btn-light"><i class="bi bi-list"></i></a></th>
            <th scope="col"><a href="edit_canine" class="btn btn-light"><i class="bi bi-pencil-square"></i></a></th>
            <th scope="col"><a href="canine_detail" class="btn btn-light"><i class="bi bi-file-earmark"></i></a></th>
            </tr>
            <tr>
            <th scope="col"><img src="<?= base_url('uploads/canines/bulldog.png') ?>"></th>
            <th scope="col">123</th>
            <th scope="col">Bobby</th>
            <th scope="col"><a href="canine_detail" class="btn btn-light"><i class="bi bi-list"></i></a></th>
            <th scope="col"><a href="edit_canine" class="btn btn-light"><i class="bi bi-pencil-square"></i></a></th>
            <th scope="col"><a href="canine_detail" class="btn btn-light"><i class="bi bi-file-earmark"></i></a></th>
            </tr>
        </tbody>
        </table>
    </article>
</main>