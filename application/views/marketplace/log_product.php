<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Product Log</title>
    <?php $this->load->view('templates/head'); ?>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/backend-modal.css" />
</head>
<body>
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImg">
    </div>
    <?php $this->load->view('templates/redirect'); ?>
    <div class="container">
        <?php $this->load->view('templates/header'); ?>  
        <div class="row">            
            <div class="col-md-12">                          
                <h3 class="text-center text-primary">Product Log</h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Last Modified</th>
                                <th>Photo</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Price (Rp)</th>
                                <th>Weight</th>
                                <th>Description</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($product AS $p){ ?>
                                    <tr>
                                        <td><span class="text-nowrap"><?= $p->log_date; ?></span><br/>(<?= $p->user; ?>)</td>
                                        <td>
                                            <?php
                                                if ($p->log_product_photo && $p->log_product_photo != '-'){
                                                    echo '<img src="'.base_url().'uploads/products/'.$p->log_product_photo.'" class="img-fluid img-thumbnail" alt="product" id="myImg'.$p->log_product_id.'" onclick="display(\'myImg'.$p->log_product_id.'\')" style="max-height:100px;">';
                                                } 
                                                else {
                                                    echo '<img src="'.base_url().'assets/img/product.jpg'.'" class="img-fluid img-thumbnail" alt="product" id="myImg'.$p->log_product_id.'" onclick="display(\'myImg'.$p->log_product_id.'\')" style="max-height:100px;">';
                                                }
                                            ?>
                                        </td>
                                        <td><?= $p->pro_type_name; ?></td>
                                        <td><?= $p->log_product_name; ?></td>
                                        <td><?= number_format($p->log_product_price,0,",","."); ?></td>
                                        <td><?= $p->log_product_weight; ?></td>
                                        <td><?= $p->log_product_desc; ?></td>
                                        <td><?= $p->stat_name; ?></td>
                                    </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div> 
            <div class="col-md-12 text-center">
                <button class="btn btn-primary" type="button" onclick="window.location = '<?= base_url() ?>marketplace/Products/listProducts'"><i class="fa fa-arrow-left"></i></button>
            </div>                      
        </div> 
        <?php $this->load->view('templates/footer'); ?>      
    </div>
    <?php $this->load->view('templates/script'); ?>
    <script>
        var modal = document.getElementById("myModal");
        function display(id){
            var img = document.getElementById(id);
            var modalImg = document.getElementById("modalImg");
            modal.style.display = "block";
            modalImg.src = img.src;
        }

        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
            modal.style.display = "none";
        }
    </script>
</body>
</html>