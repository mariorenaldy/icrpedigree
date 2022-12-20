<!DOCTYPE html>
<html class="min-vh-100">
<head>
<title>Rules</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <header class="d-flex flex-column align-items-center">
            <h2 class="fw-bold">Rules</h2>
        </header>
        <div>
            <?php foreach ($rules AS $r){ 
                echo '<p>'.$r->ru_title.'</p>'; 
                echo $r->ru_desc; 
            } ?>    
            <p>Laporan langsung ke email icr_indonesia@yahoo.com atau ke aplikasi</p>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
</html>