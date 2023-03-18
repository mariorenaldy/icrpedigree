<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Marketplace</title>
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php $this->load->view('frontend/layout/header'); ?>
    <?php $this->load->view('frontend/layout/navbar'); ?>
    <main class="container">
        <h3 class="text-center text-warning">Products</h3>
        <div class="search-container">
            <form action="<?= base_url().'frontend/marketplace/Products/search'?>" method="post">
                <div class="input-group my-3 d-flex justify-content-center">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Nama Produk" name="keywords" value="<?= set_value('keywords') ?>">
                    </div>
                    <div class="col-sm-1 ms-1">
                        <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Cari Produk"><i class="fa fa-search"></i></button>
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
                <div class="card col m-5">
                    <div class="d-flex align-items-center" style="height: 300px;">
                        <?php if ($p->pro_photo != '-' &&  $p->pro_photo != null){ ?>
                                <img src="<?= base_url('uploads/products/'.$p->pro_photo) ?>" class="card-img-top img-fluid img-thumbnail mh-100" alt="product">
                        <?php } else{ ?>
                            <img src="<?= base_url('assets/img/product.jpg') ?>" class="card-img-top img-fluid img-thumbnail mh-100" alt="product">
                        <?php } ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $p->pro_name ?></h5>
                        <p class="card-text"><?= $p->pro_desc ?></p>
                        <p class="card-text"><?= $p->pro_price ?></p>
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
        <div class="text-center">
            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>frontend/marketplace/Marketplace'">Kembali</button>
        </div>
    </main>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script>
        function detail(id){
            window.location = "<?= base_url(); ?>frontend/marketplace/Products/product_detail/"+id;
        }
    </script>
</body>
</html>