<!DOCTYPE html>
<html class="min-vh-100">
<head>
<title><?= lang('common_rules'); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <div class="container">
        <h3 class="text-center text-warning mb-3"><?= lang('common_rules'); ?></h3>
        <div class="row">
            <div class="col-12"><h5 class="text-warning">Lapor Pacak</h5></div>
        </div>
        <div class="row mb-5">
            <div class="col-12">
                <ul>
                    <li>Setiap pemohon wajib menjadi anggota ICR dan mendaftarkan kennel dengan membayar iuran tahunan.</li>
                    <li>Indukan dan pejantan yang akan dikawinkan (pacak) wajib memiliki stambum ICR</li>
                    <li>Mengirimkan foto stambum pejantan dan indukan (bagian belakang) yg akan dikawinkan (pacak) melalui website ICRPedigree</li>
                    <li>Mengirimkan dokumentasi berupa foto kawin (pacak) sesuai dengan tanggal dilangsungkannya perkawinan (pacak) melalui website ICRPedigree</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12"><h5 class="text-warning">Lapor Lahir</h5></div>
        </div>
        <div class="row mb-5">
            <div class="col-12">
                <ul>
                    <li>Pelaporan tanggal kelahiran anakan, jumlah anakan serta jenis kelamin anakan, dikirimkan melalui website ICRPedigree</li>
                    <li>Mengirimkan dokumentasi berupa foto indukan yang sedang menyusui anakannya melalui website ICRPedigree</li>
                    <li>Batas waktu pelaporan lahir, terhitung  75 hari dari tanggal pelaporan kawin (pacak).</li>
                    <li>Pihak ICR berhak menolak pengajuan lahiran apabila pelaporan lahiran melewati batas waktu  yang telah ditentukan.</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12"><h5 class="text-warning">PENGAJUAN STAMBUM ANAKAN</h5></div>
        </div>
        <div class="row mb-5">
            <div class="col-12">
                <ul>
                    <li>Tanggal kelahiran anakan (DOB)</li>
                    <li>Foto anakan</li>
                    <li>Nama anakan</li>
                    <li>Nama indukan dan pejantan</li>
                    <li>Nama kennel</li>
                    <li>Nama owner</li>
                    <li>Batas waktu pengajuan registrasi anakan terhitung 100 hari dari tanggal pelaporan lahiran.</li>
                    <li>Apabila pengajuan registrasi melewati dari tanggal yang telah di tentukan (100 hari terhitung dari pelaporan lahiran) maka pada anakan tersebut  akan dianggap generasi pertama dan tidak akan memiliki silsilah keturunan  ( F1 ) , seluruh pengajuan di daftarkan melalui website ICRPedigree</li>
                </ul>
                <br>
                <p><strong>CATATAN</strong>: Setiap anggota ICR wajib memenuhi syarat dan ketentuan yang telah diberikan, pihak ICR berhak melakukan pembatalan pengajuan apabila salah satu poin diatas tidak dipenuhi.</p>
                <p>Syarat dan ketentuan dapat berubah sewaktu waktu dan akan di informasikan melalui website ICRPedigree</p>
            </div>
        </div>
        </div>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
</html>