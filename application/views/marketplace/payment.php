<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title><?= lang("pro_cart"); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>

<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container mb-5">
        <div class="container-fluid">
            <div class="alert alert-success">
                <p class="text-center align-middle">Selamat, Pesanan anda berhasil diproses!</p>
            </div>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>

</html>