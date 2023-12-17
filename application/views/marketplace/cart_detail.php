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
        <table class="table table-light table-bordered table-striped table-hover">
            <tr>
                <th>No.</th>
                <th><?= lang("pro_name"); ?></th>
                <th><?= lang("pro_quantity"); ?></th>
                <th><?= lang("pro_weight"); ?></th>
                <th><?= lang("pro_price"); ?></th>
                <th>Subtotal</th>
                <th></th>
            </tr>
            <?php 
            $no=1;
            $totalWeight=0;
            foreach($this->cart->contents() as $items):?>
                <?php $totalWeight = $totalWeight+($items['qty']*$items['weight']);?>
                <tr>
                    <td><?= $no++;?></td>
                    <td><?= $items['name'];?></td>
                    <td class="d-flex justify-content-between"><button type="button" class="fw-normal btn btn-sm btn-danger" onclick="decrease('<?= $items['rowid']; ?>', '<?= $items['qty']; ?>')">-</button><span><?= $items['qty'];?></span><button type="button" class="fw-normal btn btn-sm btn-primary" onclick="increase('<?= $items['rowid']; ?>', '<?= $items['id']; ?>')">+</button></td>
                    <td align="right"><?= number_format($items['qty']*$items['weight'],0,",",".") ?> gram</td>
                    <td align="right">Rp <?= number_format($items['price'],0,",",".") ?></td>
                    <td align="right">Rp <?= number_format($items['subtotal'],0,",",".") ?></td>
                    <td align="center"><button type="button" class="fw-normal btn btn-sm btn-danger" onclick="remove_item('<?= $items['rowid']; ?>')">Remove</button></td>
                </tr>
            <?php endforeach ?>
                <tr>
                    <td colspan="3" align="right" class="fw-bold">Total <?= lang("pro_weight"); ?>:</td>
                    <td align="right" class="fw-bold"><?= number_format($totalWeight,0,",",".") ?> gram</td>
                    <td align="right" class="fw-bold"><?= lang("pro_total_price"); ?>:</td>
                    <td align="right" class="fw-bold">Rp <?= number_format($this->cart->total(),0,",",".") ?></td>
                    <td></td>
                </tr>
        </table>

        <a href=""></a>
        <div align="right">
            <button type="button" class="fw-normal btn btn-sm btn-danger" onclick="clear_cart()"><?= lang("pro_empty_cart"); ?></button>
            <button type="button" class="fw-normal btn btn-sm btn-primary" onclick="market()"><?= lang("pro_continue_shopping"); ?></button>
            <button type="button" class="fw-normal btn btn-sm btn-success" onclick="checkout()"><?= lang("pro_checkout"); ?></button>
        </div>
    </main>
    <div class="modal fade text-dark" id="error-modal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= lang("common_error_message"); ?></h5>
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
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script>
        $(document).ready(function(){
            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });

        function decrease(id, qty){
            window.location = "<?= base_url(); ?>marketplace/Products/decrease/"+id+"/"+qty;
        }
        function increase(rowid, id){
            window.location = "<?= base_url(); ?>marketplace/Products/increase/"+rowid+"/"+id;
        }
        function remove_item(id){
            window.location = "<?= base_url(); ?>marketplace/Products/remove_item/"+id;
        }
        function clear_cart(){
            window.location = "<?= base_url(); ?>marketplace/Products/clear_cart/";
        }
        function market(){
            window.location = "<?= base_url(); ?>marketplace/Products/";
        }
        function checkout(){
            window.location = "<?= base_url(); ?>marketplace/Products/checkout/";
        }
    </script>
</body>

</html>