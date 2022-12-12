<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Register</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>

    <main class="container">
        <article  class="mt-5 mb-5">
            <div class="d-flex flex-column align-items-center">
                <div class="bg-white text-black p-5" style="min-height: 50vh; min-width: 50vw; border-radius: 50px;">
                    <div class="d-flex flex-column gap-3 p-2 align-items-center">
                        <header>
                            <h2>Sign Up</h2>
                        </header>

                        <form action="<?= base_url('frontend/register/signup') ?>" method="post">
                        <div>
                            <img id="imgPreview" width="15%" src="<?= base_url('assets/oneui/img/avatars/avatar1.jpg') ?>">
                            <!-- <a href="<?= base_url('') ?>" class="btn" style="background-color:#FAFF00;">Upload KTP</a> -->
                            <input type="file" class="upload" name="attachment_member" id="imageInput"/>

                            <img id="imgPreview" width="15%" src="<?= base_url('assets/oneui/img/avatars/avatar1.jpg') ?>">
                            <!-- <a href="<?= base_url('') ?>" class="btn" style="background-color:#61FF00;">Upload Profile Picture</a> -->
                            <input type="file" class="upload" name="attachment_pp" id="imageInputPP"/>
                        </div>
                            
                        <div>
                            <input type="number" placeholder="No. KTP" name="mem_ktp">
                        </div>
                        
                        <div>
                            <input type="text" placeholder="Nama Sesuai KTP" name="mem_name">
                        </div>
                        
                        <div>
                            <input type="text" placeholder="Alamat Sesuai KTP" name="mem_address">
                        </div>

                        <div>
                            <input type="text" placeholder="Alamat Surat Menyurat" name="mem_mail_address">
                        </div>
                        
                        <div>
                            <input type="number" placeholder="No. Telp" name="mem_hp">
                        </div>
                            
                        <div>
                            <input type="text" placeholder="Kota" name="mem_kota">
                        </div>
                            
                        <div>
                            <input type="number" placeholder="Kode Pos" name="mem_kode_pos">
                        </div>

                        <div>
                            <input type="email" placeholder="Email" name="mem_email">
                        </div>

                        <div>
                            <input type="text" placeholder="Username" name="mem_username">
                        </div>

                        <div>
                            <input type="password" placeholder="Password" name="password">
                        </div>

                        <div>
                            <input type="password" placeholder="Konfirmasi Password" name="repass">
                        </div>

                        <div>
                            <img id="imgPreview" width="15%" src="<?= base_url('assets/oneui/img/avatars/avatar1.jpg') ?>">
                            <!-- <a href="<?= base_url('') ?>" class="btn" style="background-color:#00D1FF;">Upload Logo</a> -->
                            <input type="file" class="upload" name="ken_photo" id="imageInputLogo"/>
                        </div>
                        
                        <div>
                            <input type="text" placeholder="Nama Kennel" name="ken_name">
                        </div>
                        
                        <div>
                            <select name="ken_type_id">
                                <option value="" disabled selected>Format Penamaan Canine</option>
                                <option value="kennel + ' + xxx">kennel + ' + xxx</option>
                                <option value="xxx + von + kennel">xxx + von + kennel</option>
                            </select>
                        </div>

                        <button type="submit" class="btn" style="background-color:#B897FF;">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </article>
    </main>
    
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
</html>

