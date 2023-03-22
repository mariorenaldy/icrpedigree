<!DOCTYPE html>
<html>
<head>
    <title>Lupa Password</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <div class="container">
            <h3 class="text-center text-warning">Lupa Password</h3>
            <div class="row">   
                <div class="col-sm-12 text-center">                          
                    <form class="form-horizontal" action="<?php echo base_url(); ?>frontend/Members/validate_reset" method="post">
                        <div class="input-group my-3">
                            <div class="col-sm-2"></div>
                            <label for="mem_hp" class="control-label col-sm-1">No. HP :</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" id="mem_hp" name="mem_hp" placeholder="No. HP" value="<?= set_value('mem_hp'); ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-sm-2"></div>
                            <label for="mem_email" class="control-label col-sm-1">email :</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" id="mem_email" name="mem_email" placeholder="email">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-7 text-start">
                                <button class="btn btn-primary btn-lg" type="submit">Reset</button>
                                <button class="btn btn-danger btn-lg" type="button" onclick="window.location = '<?= base_url() ?>frontend/Members'">Batal</button>
                            </div>
                        </div>    
                    </form>
                </div>                
            </div>
            <div class="modal fade text-dark" id="error-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pesan Kesalahan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-danger">
                            <?php if ($this->session->flashdata('error_message')){ ?>
                                <div class="row">
                                    <div class="col-12"><?= $this->session->flashdata('error_message') ?></div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="message-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pemberitahuan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-success">
                            <?php if ($this->session->flashdata('reset')){ ?>
                                <div class="row">
                                    <div class="col-12">Reset password berhasil.<br/>Silakan hubungi ICR admin untuk mendapatkan approval.</div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>      
    <script>
        $(document).ready(function(){
            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>

            <?php if ($this->session->flashdata('reset')){ ?>
                $('#message-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>
</html>