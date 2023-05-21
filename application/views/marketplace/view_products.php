<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Product List</title>
    <?php $this->load->view('templates/head'); ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/datatables.min.css" />
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
                <h3 class="text-center text-primary">Product List</h3>
                <div class="text-success">
                    <?php		
                        if ($this->session->flashdata('add_success')){
                            echo 'Product has been saved<br/>';
                        }
                        if ($this->session->flashdata('edit_success')){
                            echo 'Product has been edited<br/>';
                        }
                        if ($this->session->flashdata('delete_success')){
                            echo 'Product has been deleted<br/>';
                        }
                    ?>
                </div>
                <div class="text-danger">
                    <?php		
                        if ($this->session->flashdata('error_message')){
                            echo $this->session->flashdata('error_message').'<br/>';
                        }
                    ?>
                </div>
                <div class="search-container my-3 sticky-top">
                    <form action="<?= base_url().'backend/Products/search'?>" method="post">
                        <div class="input-group">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Product Name" name="keywords" value="<?= set_value('keywords') ?>">
                            </div>
                            <div class="col-md-1 ms-1">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Search Product"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" onclick="add()" data-toggle="tooltip" data-placement="top" title="Add Product"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="no-sort"></th>
                                <th class="no-sort"></th>
                                <th class="no-sort"></th>
                                <th class="no-sort">Photo</th>
                                <th class="no-sort">Type</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th class="no-sort">Description</th>
                                <th class="no-sort">Created User</th>
                                <th class="no-sort">Updated User</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="no-sort">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products AS $p){ ?>
                                <tr>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success mb-1" onclick="edit(<?= $p->pro_id ?>)" data-toggle="tooltip" data-placement="top" title="Edit Product"><i class="fa fa-edit"></i></button>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                                        <button type="button" class="btn btn-danger mb-1" onclick="del(<?= $p->pro_id ?>, '<?= $p->pro_name ?>')" data-toggle="tooltip" data-placement="top" title="Delete Product"><i class="fa fa-trash"></i></button>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($this->session->userdata('use_type_id') == $this->config->item('super')){ ?>
                                            <button type="button" class="btn btn-dark mb-1" onclick="log(<?= $p->pro_id ?>)" data-toggle="tooltip" data-placement="top" title="Product Log"><i class="fa fa-history"></i></button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($p->pro_photo && $p->pro_photo != '-'){ ?>
                                            <img src="<?= base_url('uploads/products/'.$p->pro_photo) ?>" class="img-fluid img-thumbnail" alt="product" id="myImg<?= $p->pro_id ?>" onclick="display('myImg<?= $p->pro_id ?>')">
                                        <?php } else{ ?>
                                            <img src="<?= base_url().'assets/img/product.jpg' ?>" class="img-fluid img-thumbnail" alt="product" id="myImg<?= $p->pro_id ?>" onclick="display('myImg<?= $p->pro_id ?>')" style="max-height:100px;">
                                        <?php } ?>
                                    </td>
                                    <td><?= $p->pro_type_name; ?></td>
                                    <td><?= $p->pro_name; ?></td>
                                    <td><?= $p->pro_price; ?></td>
                                    <td><?= $p->pro_desc; ?></td>
                                    <td><?= $p->pro_created_user; ?></td>
                                    <td><?= $p->pro_updated_user; ?></td>
                                    <td class="text-nowrap"><?= $p->pro_created_at; ?></td>
                                    <td class="text-nowrap"><?= $p->pro_updated_at; ?></td>
                                    <td><?= $p->pro_stat; ?></td>
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
        function add(){
            window.location = "<?= base_url(); ?>marketplace/Products/add";
        }
        function edit(id){
            window.location = "<?= base_url(); ?>marketplace/Products/edit/"+id;
        }
        function del(id, nama){
            var proceed = confirm("Delete "+nama+" ?");
            if (proceed){             
                window.location = "<?= base_url(); ?>marketplace/Products/delete/"+id;
            }
        }
        function log(id){
            window.location = "<?= base_url(); ?>marketplace/Products/log/"+id;
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

        $(document).ready(function () {
            $('#datatable').DataTable({searching: false, info: false, "ordering": true, order: [[5, 'desc']], dom: 'lpftrip',
                columnDefs: [{
                    orderable: false,
                    targets: "no-sort"
                }]
            });
        });
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script>
</body>
</html>