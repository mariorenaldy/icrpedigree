<main class="container">
    <article  class="mt-5 mb-5">
        <div class="d-flex flex-column align-items-center">
            <div class="bg-white text-black p-5" style="min-height: 50vh; min-width: 50vw; border-radius: 50px;">
                <div class="d-flex flex-column gap-3 p-2 align-items-center">
                    <header>
                        <h2>Sign Up</h2>
                    </header>

                    <img id="imgPreview" width="15%" src="<?= base_url('assets/oneui/img/avatars/avatar1.jpg') ?>">
                    <a href="<?= site_url('') ?>" class="btn" style="background-color:#FAFF00;">Upload KTP</a>

                    <img id="imgPreview" width="15%" src="<?= base_url('assets/oneui/img/avatars/avatar1.jpg') ?>">
                    <a href="<?= site_url('') ?>" class="btn" style="background-color:#61FF00;">Upload Profile Picture</a>

                    <input type="number" placeholder="No. KTP">
                    <input type="text" placeholder="Nama Sesuai KTP">
                    <input type="text" placeholder="Alamat Sesuai KTP">
                    <input type="text" placeholder="Alamat Surat Menyurat">
                    <input type="tel" placeholder="No. Telp">
                    <input type="text" placeholder="Kota">
                    <input type="number" placeholder="Kode Pos">
                    <input type="email" placeholder="Email">
                    <input type="text" placeholder="Username">
                    <input type="password" placeholder="Password">
                    <input type="password" placeholder="Konfirmasi Password">

                    <img id="imgPreview" width="15%" src="<?= base_url('assets/oneui/img/avatars/avatar1.jpg') ?>">
                    <a href="<?= site_url('') ?>" class="btn" style="background-color:#00D1FF;">Upload Logo</a>

                    <input type="text" placeholder="Nama Kennel">
                    <select>
                        <option value="" disabled selected>Format Penamaan Canine</option>
                        <option value="kennel + ' + xxx">kennel + ' + xxx</option>
                        <option value="xxx + von + kennel">xxx + von + kennel</option>
                    </select>

                    <a href="<?= site_url('') ?>" class="btn" style="background-color:#B897FF;">Simpan</a>
                </div>
            </div>
        </div>
    </article>
</main>