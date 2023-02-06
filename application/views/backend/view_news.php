<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>News</title>
    <?php $this->load->view('templates/head'); ?>
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                         
                <h3 class="text-center text-primary">News</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('update_success')){
                            echo 'News has been updated<br/>';
                        }
                        if ($this->session->flashdata('delete_success')){
                            echo 'News has been deleted<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('delete_error')){
                            echo $this->session->flashdata('delete_error').'<br/>';
                        }
                    ?>
                </div>
                <div class="row mb-1">
                    <div class="col-md-2"><b>Date</b></div>
                    <div class="col-md-2"><b>Title</b></div>
                    <div class="col-md-6"><b>Description</b></div>
                    <div class="col-md-2"></div>
                </div>
                <?php foreach ($news AS $r){ ?>
                    <div class="row">
                        <div class="col-md-2">
                            <?= $r->date; ?>
                        </div>
                        <div class="col-md-2">
                            <?= $r->title; ?>
                        </div>
                        <div class="col-md-6 mb-1">
                            <?= $r->description; ?>
                        </div>
                        <div class="col-md-2 mb-1">
                            <button type="button" class="btn btn-success" onclick='update(<?= $r->news_id; ?>)' data-toggle="tooltip" data-placement="top" title="Edit News"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger" onclick='del(<?= $r->news_id; ?>)' data-toggle="tooltip" data-placement="top" title="Delete News"><i class="fa fa-close"></i></button>    
                        </div>
                    </div>
                <?php } ?>
            </div>                           
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script>
        function update(id){
            window.location = "<?= base_url(); ?>backend/News/edit/"+id;
        }
        function del(id){
            var proceed = confirm("Delete news?");
            if (proceed){             
                window.location = "<?= base_url(); ?>backend/News/delete/"+id;
            }
        }
    </script>
</body>
</html>