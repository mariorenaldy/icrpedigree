<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?= lang("pro_products"); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <h3 class="text-center text-warning"><?= lang("pro_products"); ?></h3>
        <div class="search-container">
            <form id="formProduct" action="<?= base_url().'marketplace/Products/search_all'?>" method="POST">
                <div class="input-group my-3 d-flex justify-content-center">
                    <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="<?= lang("pro_name"); ?>" name="keyword" value="<?= set_value('keyword') ?>">
                    </div>
                    <div class="col-sm-1 ms-1">
                        <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="<?= lang("pro_search"); ?>"><i class="fa fa-search"></i></button>
                    </div>
                    <label for="types" class="col-md-1 my-2 me-2 text-center"><?= lang("pro_type"); ?>: </label>
                    <div class="col-md-4 my-1 text-end">
                        <?php
                            $typeOpts = [];
                            $typeOpts[0] = lang("pro_all");
                            foreach($pro_types as $type){
                                $typeOpts[$type->pro_type_id] = $type->pro_type_name;
                            }
                            echo form_dropdown('types', $typeOpts, $types, 'class="form-control", id="types"');
                    ?>
                    </div>
                </div>
            </form>
        </div>
        <div class="text-dark" id="productsContainer">
            <?php $counter=0;
            $len = count($products);
            $pads = 3 - $len % 3;
            foreach($products as $p) : 
            if($counter % 3 == 0){ ?>
                <div class="row m-5">
            <?php } ?>
                <div class="card m-5" style="width:300px;">
                    <div class="d-flex align-items-center" style="height: 300px;">
                        <?php if ($p->pro_photo != '-' &&  $p->pro_photo != null){ ?>
                                <img src="<?= base_url('uploads/products/'.$p->pro_photo) ?>" class="card-img-top img-fluid img-thumbnail mh-100" alt="product">
                        <?php } else{ ?>
                            <img src="<?= base_url('assets/img/product.jpg') ?>" class="card-img-top img-fluid img-thumbnail mh-100" alt="product">
                        <?php } ?>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-danger"><?= $p->pro_name ?></h5>
                        <p class="card-text flex-grow-1"><?= $p->pro_type_name ?></p>
                        <h5 class="card-text">Rp <?= number_format($p->pro_price,0,",",".") ?></h5>
                        <button type="button" class="btn btn-primary stretched-link" onclick="detail(<?= $p->pro_id ?>)">Detail</button>
                    </div>
                </div>
            <?php $counter++; if($counter % 3 == 0){ ?>
                </div>
            <?php }
            if($counter == $len && $pads !== 3){
                for ($j = 0 ; $j < $pads; $j++){ ?>
                    <div class="card col m-5" style="visibility: hidden;">
                    </div>
                <?php }
            }
            endforeach; ?>
        </div>
        <?= $this->pagination->create_links(); ?>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script>
        function detail(id){
            window.location = "<?= base_url(); ?>marketplace/Products/product_detail/"+id;
        }

        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }

        $(document).ready(function () {
            $('#types').on("change", function(){
                $('#formProduct').attr('action', "<?= base_url(); ?>marketplace/Products/search_all").submit();
            });
        });
    </script>
</body>
</html>