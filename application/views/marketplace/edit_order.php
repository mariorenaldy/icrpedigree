<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Edit Order</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/cropper.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/crop-modal-styles.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/jquery-ui-timepicker-addon.min.css" rel="stylesheet" />
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <main class="container">
        <?php $this->load->view('templates/header'); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-items-center">
                    <h3 class="text-center text-primary">Edit Order</h3>  
                    <form id="formOrder" class="form-horizontal" action="<?= base_url(); ?>marketplace/Orders/validate_edit" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Member</label>
                            <div class="col-md-10">
                                <?= $order->mem_name; ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Total Weight</label>
                            <div class="col-md-10">
                                <?php 
                                    $totalWeight=0;
                                    $total=0;
                                    foreach($items as $itm):
                                        $totalWeight = $totalWeight+($itm->itm_quantity*$itm->pro_weight);
                                        $subtotal = $itm->itm_subtotal;
                                        $total += $subtotal; 
                                    endforeach;
                                    echo $totalWeight;
                                ?> gram
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Total Price without Shipping</label>
                            <div class="col-md-10">
                                <?php 
                                    echo "Rp ".number_format($total,0,",",".");
                                ?>
                            </div>
                        </div>
                        <hr/>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Invoice</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input type="hidden" name="ord_id" value="<?= $order->ord_id ?>">
                                    <input class="form-control" type="text" placeholder="Invoice" name="ord_invoice" value="<?= $order->ord_invoice ?>">
                                <?php } else { ?>
                                    <input type="hidden" name="ord_id" value="<?= set_value('ord_id'); ?>">
                                    <input class="form-control" type="text" placeholder="Invoice" name="ord_invoice" value="<?= set_value('ord_invoice'); ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Province</label>
                            <div class="col-md-10">
                                <?php
                                    $prov = [];
                                    foreach($province as $row){
                                        $prov[$row->prov_id] = $row->prov_name;
                                    }
                                    if (!$mode)
                                        echo form_dropdown('prov_id', $prov, $order->prov_id, 'class="form-control", id="prov_id"');
                                    else
                                        echo form_dropdown('prov_id', $prov, set_value('prov_id'), 'class="form-control", id="prov_id"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">City/Regency</label>
                            <div class="col-md-10">
                                <?php
                                    $cities = [];
                                    foreach($city as $row){
                                        $cities[$row->city_id] = $row->city_name;
                                    }
                                    if (!$mode)
                                        echo form_dropdown('city_id', $cities, $order->city_id, 'class="form-control", id="city_id"');
                                    else
                                        echo form_dropdown('city_id', $cities, set_value('city_id'), 'class="form-control", id="city_id"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Full Address</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Full Address" name="ord_address" value="<?= $order->ord_address; ?>">
                                <?php } else { ?>
                                    <input class="form-control" type="text" placeholder="Full Address" name="ord_address" value="<?= set_value('ord_address'); ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Shipping Service</label>
                            <div class="col-md-10">
                                <select class="form-control" name="shipping" id="shipping">
                                    <option shipCode="jne" value="1">JNE</option>
                                    <option shipCode="tiki" value="2">TIKI</option>
                                    <option shipCode="pos" value="3">POS</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Shipping Type</label>
                            <div class="col-md-10">
                                <select class="form-control" name="shipping_type" id="shipping_type">
                                </select>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Shipping Cost (Rp)</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="number" placeholder="Shipping Cost" name="ord_shipping_cost" value="<?= $order->ord_shipping_cost; ?>">
                                <?php } else { ?>
                                    <input class="form-control" type="number" placeholder="Shipping Cost" name="ord_shipping_cost" value="<?= set_value('ord_shipping_cost'); ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Grand Total (Rp)</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="number" placeholder="Total Price" name="ord_total_price" value="<?= $order->ord_total_price; ?>">
                                <?php } else { ?>
                                    <input class="form-control" type="number" placeholder="Total Price" name="ord_total_price" value="<?= set_value('ord_total_price'); ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Status</label>
                            <div class="col-md-10">
                                <?php
                                    $stat = [];
                                    foreach($status as $row){
                                        $stat[$row->ord_stat_id] = $row->ord_stat_name;
                                    }
                                    if (!$mode)
                                        echo form_dropdown('ord_stat_id', $stat, $order->ord_stat_id, 'class="form-control", id="ord_stat_id"');
                                    else
                                        echo form_dropdown('ord_stat_id', $stat, set_value('ord_stat_id'), 'class="form-control", id="ord_stat_id"');
                                ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Payment Date</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Payment Date" id="ord_pay_date" name="ord_pay_date" value="<?= $order->ord_pay_date; ?>" autocomplete="off">
                                <?php } else { ?>
                                    <input class="form-control" type="text" placeholder="Payment Date" id="ord_pay_date" name="ord_pay_date" value="<?= set_value('ord_pay_date'); ?>" autocomplete="off">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Payment Due Date</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Payment Due Date" id="ord_pay_due_date" name="ord_pay_due_date" value="<?= $order->ord_pay_due_date; ?>" autocomplete="off">
                                <?php } else { ?>
                                    <input class="form-control" type="text" placeholder="Payment Date" id="ord_pay_due_date" name="ord_pay_due_date" value="<?= set_value('ord_pay_due_date'); ?>" autocomplete="off">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Arrived Date</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Arrived Date" id="ord_arrived_date" name="ord_arrived_date" value="<?= $order->ord_arrived_date; ?>" autocomplete="off">
                                <?php } else { ?>
                                    <input class="form-control" type="text" placeholder="Arrived Date" id="ord_arrived_date" name="ord_arrived_date" value="<?= set_value('ord_arrived_date'); ?>" autocomplete="off">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">Completed Date</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <input class="form-control" type="text" placeholder="Completed Date" id="ord_completed_date" name="ord_completed_date" value="<?= $order->ord_completed_date; ?>" autocomplete="off">
                                <?php } else { ?>
                                    <input class="form-control" type="text" placeholder="Completed Date" id="ord_completed_date" name="ord_completed_date" value="<?= set_value('ord_completed_date'); ?>" autocomplete="off">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="password" class="control-label col-md-2">Reject Note</label>
                            <div class="col-md-10">
                                <?php if (!$mode){ ?>
                                    <textarea class="form-control" rows="10" placeholder="Reject Note" name="ord_reject_note"><?= $order->ord_reject_note ?></textarea>
                                <?php } else { ?>
                                    <textarea class="form-control" rows="10" placeholder="Reject Note" name="ord_reject_note"><?= set_value('ord_reject_note') ?></textarea>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="text-center">
                            <button id="buttonSubmit" class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>marketplace/Orders/listOrders'">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crop Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <img src="" id="sample_image" />
                                </div>
                                <div class="col-md-4">
                                    <div class="preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="crop" class="btn btn-primary">Crop</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel-btn">Batal</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade text-dark" id="error-modal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-danger">
                        <?php if ($this->session->flashdata('error_message')){ ?>
                            <div class="row">
                                <div class="col-12"><?= $this->session->flashdata('error_message') ?></div>
                            </div>
                        <?php } ?>
                        <?php if (validation_errors()){ ?>
                            <div class="row">
                                <?= validation_errors() ?>
                            </div>
                        <?php } ?>
                        <div id="error-row" class="row" style="display: none;">
                            <div id="error-col" class="col-12"></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('templates/footer'); ?>
    </main>
    <?php $this->load->view('templates/script'); ?>
    <script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery-ui-timepicker-addon.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/cropper.min.js"></script>
    <script>
        function setDatePicker(id) {
            $(id).datetimepicker({
                dateFormat: 'dd-mm-yy'
            });
            $(id).readOnly = true;
        }
        setDatePicker('#ord_pay_date');
        setDatePicker('#ord_pay_due_date');
        setDatePicker('#ord_arrived_date');
        setDatePicker('#ord_completed_date');

        $('#buttonSubmit').on("click", function(e){
            e.preventDefault();
            $('#formOrder').attr('action', "<?= base_url(); ?>marketplace/Orders/validate_edit").submit();
        });

        function getCost() {
            var cityID = $("#city_id").find(":selected").val();
            var weight = <?= $totalWeight; ?>;
            var shipping = $("select[name=shipping]").find(":selected").attr("shipCode");

            $.ajax({
                url: "<?= base_url() ?>marketplace/Shipping/getCostBackend",
                method: 'post',
                data: {cityID: cityID, weight: weight, shipping: shipping},
                success: function(response){
                    if (response.includes("Error")) {
                        if(response.includes("Weight tidak boleh lebih dari 30KG atau 30.000 gram")){
                            $('#errorMesage').html("<?= lang("pro_weight_exceed"); ?>");
                        }
                        else{
                            $('#errorMesage').html(response.slice(6));
                        }
                        $('#error-modal').modal('show');
                    }
                    else{
                        $("select[name=shipping_type]").html(response);
                        <?php if (!$mode){ ?>
                            $('#shipping_type option[value="<?= $order->ord_shipping_type ?>"]').attr("selected", "selected");
                        <?php } else { ?>
                            $('#shipping_type option[value="<?= set_value('shipping_type'); ?>"]').attr("selected", "selected");
                        <?php } ?>
                    }
                }
            });
        }

        $(document).ready(function(){
            <?php if ($this->session->flashdata('error_message') || validation_errors()){ ?>
                $('#error-modal').modal('show');
            <?php } ?>

            <?php if (!$mode){ ?>
                $('#shipping option[value="<?= $order->ord_shipping_id ?>"]').attr("selected", "selected");
            <?php } else { ?>
                $('#shipping option[value="<?= set_value('shipping'); ?>"]').attr("selected", "selected");
            <?php } ?>

            getCost();
        });

        $("#prov_id").on("change", function(){
            $("select[name=shipping_type]").empty();
            var provinceID = $(this).find(":selected").val();
            $.ajax({
                url: "<?= base_url() ?>marketplace/Shipping/getCity",
                method: 'post',
                data: 'provinceID='+provinceID,
                success: function(response){
                    if (response.includes("Error")) {
                        $('#errorMesage').html(response.slice(6));
                        $('#error-modal').modal('show');
                    }
                    else{
                        $("#city_id").html(response);
                        $('#city_id option:contains("Pilih")').text('--Select City/Regency--');
                    }
                }
            });
        });

        $("#city_id").on("change", function(){
            getCost();
        });

        $("#shipping").on("change", function(){
            getCost();
        });
    </script>
</body>

</html>