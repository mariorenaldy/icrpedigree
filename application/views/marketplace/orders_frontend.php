<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= lang("ord_orders"); ?></title>
    <?php $this->load->view('frontend/layout/head'); ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/backend-modal.css" />
</head>
<body class="text-white text-break">
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImg">
</div>
<?php $this->load->view('frontend/layout/header_non_paid'); ?> 
<?php $this->load->view('frontend/layout/navbar'); ?>
    <div class="container">
        <div class="row">     
            <div class="col-sm-12">                          
                <h3 class="text-center text-warning"><?= lang("ord_orders"); ?></h3>
                <div class="search-container">
                    <form action="<?= base_url().'marketplace/Orders/search'?>" method="post">
                        <div class="input-group my-3">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="<?= lang("ord_search_placeholder"); ?>" name="keywords" value="<?= $keywords ?>">
                            </div>
                            <div class="col-sm-1 ms-1">
                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="<?= lang("ord_search"); ?>"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <?= $this->pagination->create_links(); ?>
                <div class="row mb-3">
                    <div class="col"><b><?= lang("ord_invoice"); ?></b></div>
                    <div class="col"><b><?= lang("ord_address"); ?></b></div>
                    <div class="col"><b><?= lang("ord_shipping_type"); ?></b></div>
                    <div class="col"><b><?= lang("ord_total_price"); ?></b></div>
                    <div class="col"><b><?= lang("ord_date"); ?></b></div>
                    <div class="col"><b>Status</b></div>
                    <div class="col"></div>
                </div>
                <?php foreach ($orders AS $o){ ?>
                    <div class="row mb-5">
                        <div class="col">
                            <?php echo $o->ord_invoice.'<br/>'; ?>
                        </div>
                        <div class="col">
                            <?php echo $o->ord_address.'<br/>'; ?>
                        </div>
                        <div class="col">
                            <?php echo $o->ord_shipping.'<br/>'; ?>
                        </div>
                        <div class="col">
                            <?php echo 'Rp '.number_format($o->ord_total_price,0,",",".").'<br/>'; ?>
                        </div>
                        <div class="col">
                            <?php echo $o->ord_date.'<br/>'; ?>
                        </div>
                        <div class="col">
                            <?php echo $o->ord_stat_name; 
                            if ($o->ord_stat_id == $this->config->item('order_rejected')){
                                $site_lang = $this->input->cookie('site_lang');
                                if ($site_lang == 'indonesia') {
                                    echo '<br/>Alasan: ';
                                }
                                else{
                                    echo '<br/>Reason: ';
                                }
                                if ($o->ord_reject_note)
                                    echo $o->ord_reject_note;
                                else
                                    echo '-'; 
                            } ?>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-info mb-1" onclick="detail(<?= $o->ord_id ?>)" data-toggle="tooltip" data-placement="top" title="<?= lang("ord_detail"); ?>"><i class="fa-solid fa-list"></i></button>
                            <?php if ($o->ord_stat_id == $this->config->item('order_not_paid')){ ?>
                            <button type="button" class="btn btn-success mb-1" onclick="pay('<?= $o->ord_invoice;?>', <?= $o->ord_total_price;?>)" data-toggle="tooltip" data-placement="top" title="<?= lang("common_pay"); ?>"><i class="fa-solid fa-money-bill-1"></i></button>
                            <button type="button" class="btn btn-danger mb-1" onclick="confirm(<?= $o->ord_id ?>)" data-toggle="tooltip" data-placement="top" title="<?= lang("common_cancel_payment"); ?>"><i class="fa-solid fa-xmark"></i></button>
                            <?php } ?>
                            <?php if ($o->ord_stat_id == $this->config->item('order_arrived')){ ?>
                            <button type="button" class="btn btn-primary mb-1" onclick="confirmAccept('<?= $o->ord_id;?>')" data-toggle="tooltip" data-placement="top" title="<?= lang("ord_accepted"); ?>"><i class="fa-solid fa-check"></i></button>
                            <button type="button" class="btn btn-danger mb-1" onclick="complain('<?= $o->ord_id;?>')" data-toggle="tooltip" data-placement="top" title="<?= lang("ord_complain"); ?>"><i class="fa-solid fa-file-pen"></i></button>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <br>
                <?= $this->pagination->create_links(); ?>  
            </div>                       
        </div> 
        <div class="modal fade text-dark" id="confirm-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= lang("common_confirm"); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5><?= lang("ord_confirm_cancel"); ?></h5>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" onclick="cancel(<?= $o->ord_id ?>)"><?= lang("common_yes"); ?></button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="resetId()"><?= lang("common_no"); ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="confirm-accept-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= lang("common_confirm"); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5><?= lang("ord_confirm_accept"); ?></h5>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" onclick="accept(<?= $o->ord_id ?>)"><?= lang("common_yes"); ?></button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="resetAcceptId()"><?= lang("common_no"); ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="message-modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?= lang("common_notice"); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-success">
                            <?php if ($this->session->flashdata('add_success')){ ?>
                                <div class="row">
                                    <div class="col-12"><?= lang("ord_add_success"); ?></div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('cancel_success')){ ?>
                                <div class="row">
                                    <div class="col-12"><?= lang("ord_cancel_success"); ?></div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('accept_success')){ ?>
                                <div class="row">
                                    <div class="col-12"><?= lang("ord_accept_success"); ?></div>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('complain_success')){ ?>
                                <div class="row">
                                    <div class="col-12"><?= lang("ord_complain_success"); ?></div>
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
    </div>
    <?php $this->load->view('frontend/layout/footer'); ?>
    <script>
        function pay(inv, amount){
            $('.pay_button').attr("disabled", "disabled");
            $.ajax({
                url: "<?= base_url() ?>marketplace/Payment/checkout",
                method: 'post',
                data: {amount: amount, inv: inv},
                success: function(response){
                    if(response.status == 'success'){
                        window.location.href = response.url;
                        $('.pay_button').removeAttr("disabled");
                    }else if(response.status == 'error'){
                        alert("HTTP code: " + response.code + "\n" + response.message);
                        $('.pay_button').removeAttr("disabled");
                    }
                }
            });
        }
        function detail(id){
            window.location = "<?= base_url(); ?>marketplace/Orders/detail/"+id;
        }
        let cancelId = null;
        let acceptId = null;
        function resetId(){
            cancelId = null;
        }
        function resetAcceptId(){
            acceptId = null;
        }
        function cancel(){
            window.location = "<?= base_url(); ?>marketplace/Orders/cancel/"+cancelId;
        }
        function confirm(id){
            cancelId = id;
            $('#confirm-modal').modal('show');
        }
        function confirmAccept(id){
            acceptId = id;
            $('#confirm-accept-modal').modal('show');
        }
        function accept(id){
            window.location = "<?= base_url(); ?>marketplace/Orders/accept/"+acceptId;
        }
        function complain(id){
            window.location = "<?= base_url(); ?>marketplace/Orders/complain/"+id;
        }

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

        $(document).ready(function(){
            <?php		
                if ($this->session->flashdata('add_success')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>

            <?php		
                if ($this->session->flashdata('cancel_success')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>

            <?php		
                if ($this->session->flashdata('accept_success')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>

            <?php		
                if ($this->session->flashdata('complain_success')){ ?>
                    $('#message-modal').modal('show');
            <?php } ?>

            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>
        });
        
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>