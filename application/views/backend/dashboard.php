<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Dashboard</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                           
                <h3 class="text-center text-primary">Dashboard</h3>
            </div>                    
        </div> 
        <div class="modal fade text-dark" id="message-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Notification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-success">
                            <?php if ($this->session->flashdata('edit_password')){ ?>
                                <div class="row">
                                    <div class="col-12">Password has been saved</div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('edit_pp')){ ?>
                                <div class="row">
                                    <div class="col-12">PP has been changed</div>
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
        <?php $this->load->view('templates/footer'); ?>      
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script>
        $(document).ready(function(){
            <?php		
                if ($this->session->flashdata('edit_password') || $this->session->flashdata('edit_pp')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>
        });
    </script>
</body>
</html>