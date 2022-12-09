<main class="container" id="beranda-main">
    <article class="align-items-center justify-content-around">
        <header>
            <h2 class="text-center fw-bold">List Pacak</h2>
        </header>

        <div class="search-container">
            <form action="/action_page.php">
            <input type="text" placeholder="Tanggal Pacak" name="search">
            <button type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
        <p class="text-muted">Format Tanggal Pacak: tgl-bulan-tahun. Contoh: 12-12-2012</p>
        
        <a href="canine_detail" class="btn btn-light btn-sm"><i class="bi bi-plus-lg"></i></a>
        <span>Tambah Pacak</span>
        <table class="table text-white">
        <thead>
            <tr>
            <th scope="col">Pacak</th>
            <th scope="col">Tanggal Pacak</th>
            <th scope="col">Sire</th>
            <th scope="col">Dam</th>
            <th scope="col">Status</th>
            <th scope="col">Approver</th>
            <th scope="col">Tanggal Approve</th>
            <th scope="col">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="col"><img src="<?= base_url('assets/img/canines/terrier.png') ?>"></th>
            <th scope="col">08-09-2021</th>
            <th scope="col"><img src="<?= base_url('assets/img/canines/bulldog.png') ?>"></th>
            <th scope="col"><img src="<?= base_url('assets/img/canines/poodle.png') ?>"></th>
            <th scope="col">Dalam Pemrosesan</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"><a href="edit_canine" class="btn btn-light"><i class="bi bi-pencil-square"></i></a></th>
            </tr>
            <tr>
            <th scope="col"><img src="<?= base_url('assets/img/canines/pom.png') ?>"></th>
            <th scope="col">15-10-2021</th>
            <th scope="col"><img src="<?= base_url('assets/img/canines/husky.png') ?>"></th>
            <th scope="col"><img src="<?= base_url('assets/img/canines/rottweiler.png') ?>"></th>
            <th scope="col">Disetujui</th>
            <th scope="col">Admin</th>
            <th scope="col">15-11-2021</th>
            <th scope="col"><a href="edit_canine" class="btn btn-success"><i class="bi bi-plus-lg "></i></a></th>
            </tr>
            <tr>
            <th scope="col"><img src="<?= base_url('assets/img/canines/swiss-shepherd.png') ?>"></th>
            <th scope="col">21-12-2021</th>
            <th scope="col"><img src="<?= base_url('assets/img/canines/pharaoh-hound.png') ?>"></th>
            <th scope="col"><img src="<?= base_url('assets/img/canines/wolfdog.png') ?>"></th>
            <th scope="col">Ditolak</th>
            <th scope="col">Admin</th>
            <th scope="col">02-01-2022</th>
            <th scope="col"></th>
            </tr>
        </tbody>
        </table>
    </article>
</main>