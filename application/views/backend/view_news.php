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
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="1%"></th>
                                <th width="1%"></th>
                                <th>Date</th>
                                <th>Title</th>
                                <th width="15%">Photo</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($news AS $r){ ?>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-success" onclick='update(<?= $r->news_id; ?>)' data-toggle="tooltip" data-placement="top" title="Edit News"><i class="fa fa-edit"></i></button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick='del(<?= $r->news_id; ?>)' data-toggle="tooltip" data-placement="top" title="Delete News"><i class="fa fa-close"></i></button>    
                                    </td>
                                    <td class="text-nowrap">
                                        <?= $r->date; ?>
                                    </td>
                                    <td>
                                        <?= $r->title; ?>
                                    </td>
                                    <td>
                                        <?php if ($r->type == $this->config->item('stud')){ ?>
                                            <img src="<?= base_url().'uploads/stud/'.$r->photo ?>" class="img-fluid img-thumbnail" id="stud<?= $r->news_id ?>" onclick="display('stud<?= $r->news_id ?>')">
                                        <?php } else if ($r->type == $this->config->item('birth')){ ?>
                                            <img src="<?= base_url().'uploads/births/'.$r->photo ?>" class="img-fluid img-thumbnail" id="birth<?= $r->news_id ?>" onclick="display('birth<?= $r->news_id ?>')">
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?= $r->description; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
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