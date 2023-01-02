<!DOCTYPE html>
<html class="min-vh-100">
<head>
    <title>Ubah Password</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header_member'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <header class="d-flex flex-column align-items-center">
            <h2 class="fw-bold text-warning">Ubah Password</h2>
        </header>
        <div class="container">
            <div class="row">            
                <div class="col-md-12 align-items-center">                          
                    <form class="form-horizontal" action="<?= base_url(); ?>frontend/Members/validate_edit_password" method="post" enctype="multipart/form-data">
                        <div class="text-success">
                            <?php		
                                if ($this->session->flashdata('edit_password')){
                                    echo 'Password berhasil diubah <br/>';
                                }
                            ?>
                        </div>
                        <div class="text-danger">
                            <?php		
                            if ($this->session->flashdata('edit_password_error')){
                                echo $this->session->flashdata('edit_password_error').'<br/>';
                            }
                            ?>
                        </div>
                        <div class="text-danger">
                            <?php		
                            if ($this->session->flashdata('error_message')){
                                echo $this->session->flashdata('error_message').'<br/>';
                            }
                            echo validation_errors();
                            ?>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_name" class="control-label col-md-2">Username</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" placeholder="Username" name="mem_username" value="<?= $this->session->userdata('username'); ?>" disabled>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_name" class="control-label col-md-2">Password</label>
                            <div class="col-md-10">
                                <input class="form-control" type="password" placeholder="Password" name="password" value="<?= set_value('password'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_name" class="control-label col-md-2">Password Baru</label>
                            <div class="col-md-10">
                                <input class="form-control" type="password" placeholder="Password Baru" name="newpass" value="<?= set_value('newpass'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="mem_name" class="control-label col-md-2">Konfirmasi Password</label>
                            <div class="col-md-10">
                                <input class="form-control" type="password" placeholder="Konfirmasi Password" name="repass" value="<?= set_value('repass'); ?>">
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>frontend/Members'">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
</body>
</html>

