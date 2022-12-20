<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List Pacak</title>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
    <?php $this->load->view('frontend/layout/head'); ?>
</head>
<body class="text-white text-break">
    <?php
        if (!$this->session->userdata('username')){
            echo '<script type="text/javascript">';
            echo 'window.location = "'.base_url().'frontend/login";';
            echo '</script>';
        }
    ?>
    <?php $this->load->view('frontend/layout/header'); ?>  
    <?php $this->load->view('frontend/layout/navbar'); ?>

    <div class="container mt-5" style="margin-bottom: 10vh;">
        
        <!-- <?php $this->load->view('templates/header'); ?>   -->
        <div class="row">            
            <div class="col-md-12">                          
                <h3>List Pacak</h3>
                <div class="search-container">
                    <form action="/action_page.php" method="post">
                        <input type="text" placeholder="Tanggal Pacak" name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                    <p class="text-muted">Format Tanggal Pacak: tgl-bulan-tahun. Contoh: 12-12-2012</p>
                </div>
                
                <div class="mb-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add-canine"><i class="fa fa-plus"></i></button><span> Tambah Pacak</span>
                </div>

                <div class="row">
                    <div class="col-md"><b>Pacak</b></div>
                    <div class="col-md"><b>Tanggal Pacak</b></div>
                    <div class="col-md"><b>Sire</b></div>
                    <div class="col-md"><b>Dam</b></div>
                    <div class="col-md"><b>Status</b></div>
                    <div class="col-md"><b>Approver</b></div>
                    <div class="col-md-2"><b>Tanggal Approve</b></div>
                    <div class="col-md"><b>Keterangan</b></div>
                </div>

                <?php foreach ($studs AS $s){ ?>
                    <div class="row">
                        <div class="col-md">
                            <?php if ($s->can_photo != '-'){ ?>
                                <img src="<?= base_url('uploads/stud/'.$s->stu_photo) ?>" class="img-fluid img-thumbnail" alt="canine">
                            <?php } else{ ?>
                                <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine">
                            <?php } ?>
                        </div>
                        <div class="col-md">
                            <?php echo $s->stu_stud_date; ?>
                        </div>
                        <div class="col-md">
                            <?php if ($s->stu_sire_photo != '-'){ ?>
                                <img src="<?= base_url('uploads/stud/'.$s->stu_photo) ?>" class="img-fluid img-thumbnail" alt="canine">
                            <?php } else{ ?>
                                <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine">
                            <?php } ?>
                        </div>
                        <div class="col-md">
                            <?php if ($s->stu_dam_photo != '-'){ ?>
                                <img src="<?= base_url('uploads/stud/'.$s->stu_photo) ?>" class="img-fluid img-thumbnail" alt="canine">
                            <?php } else{ ?>
                                <img src="<?= base_url('assets/img/'.$this->config->item('canine_img')) ?>" class="img-fluid img-thumbnail" alt="canine">
                            <?php } ?>
                        </div>
                        <div class="col-md">
                            <?php echo $s->stat_name; ?>
                        </div>
                        <div class="col-md">
                            <?php echo $s->use_name; ?>
                        </div>
                        <div class="col-md-2">
                            <?php echo $s->stu_app_date; ?>
                        </div>
                        <div class="col-md">
                            <?php if ($s->stat_name == 'Dalam Pemrosesan'){ ?>
                                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modal-update-note"><i class="fa fa-pencil-square-o"></i></button>
                            <?php } else if($s->stat_name == 'Disetujui'){ ?>
                                <button type="button" class="btn btn-light"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            <?php } ?>
                        </div>
                        <!-- <div class="col-md">
                            <button type="button" class="btn btn-light"><i class="fa fa-bars" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modal-update-canines"><i class="fa fa-pencil-square-o"></i></button>
                            <button type="button" class="btn btn-light"><i class="fa fa-file-o" aria-hidden="true"></i></button>
                        </div> -->
                    </div>
                <?php } ?>
            </div>                           
        </div> 
    </div>

    <div class="modal fade" id="modal-update-canines" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content text-dark">
                <form action="" class="form-update-canine form-horizontal" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title" id="myModalLabel">Request Pengubahan Data Canine</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-xs-4 col-xs-offset-4">
                                <img id="imgPreview-update" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">
                                <div class="fileUpload btn btn-default btn-flat btn-block text-center">
                                    <label for="imageInput" class="btn">Cari Gambar</label>
                                    <input type="file" class="upload hidden" name="can_photo" id="imageInput" />
                                    <input type="hidden" class="" name="srcDataCrop" id="srcDataCrop-update" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                            <label for="can_cage">Kennel</label>
                            <input class="form-control" name="can_cage" id="can_cage" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                            <label for="can_address">Alamat</label>
                            <input class="form-control" name="can_address" id="can_address" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                            <label for="can_owner">Pemilik</label>
                            <input class="form-control" name="can_owner" id="can_owner" type="text" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-update-canines">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- <div class="modal fade" id="modal-add-canine" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content text-dark">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>tes</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div> -->

    <div class="modal fade" id="modal-add-canine" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content text-dark">
                <form action="" class="form-add-canine form-horizontal" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title" id="myModalLabel">Request Penambahan Data Canine</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-xs-4 col-xs-offset-4">
                                <img id="imgPreview" width="100%" src="{{base_url()}}assets/oneui/img/avatars/avatar1.jpg">
                                <div class="fileUpload btn btn-default btn-flat btn-block text-center">
                                    <label for="imageInputCanine" class="btn">Gambar Canine</label>
                                    <input type="file" class="upload hidden" name="can_photo" id="imageInputCanine" />
                                    <input type="hidden" class="" name="srcDataCrop" id="srcDataCrop" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                            <label for="as-add-canines">Nama</label>
                            <input class="form-control" id="as-add-canines" name="can_a_s" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                            <label for="as-add-canines">No. Registrasi</label>
                            <input class="form-control" id="reg-number-add-canines" name="can_current_reg_number" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                            <label for="breed-add-canines">Breed</label>
                            <select class="form-control" id="breed-add-canines" name="can_breed" required>
                                <?php foreach ($trahs AS $trah){
                                    echo '<option value='.$trah->tra_name.'>'.$trah->tra_name.'</option>';
                                }?>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                            <label for="gender-add-canines">Gender</label>
                            <br>
                            <input id="gender-add-canines" name="can_gender" type="radio" value="Male" checked>Male&nbsp;&nbsp;
                            <input id="gender-add-canines" name="can_gender" type="radio" value="Female" />Female
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                            <label for="color-add-canines">Color</label>
                            <input class="form-control" id="color-add-canines" name="can_color" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label for="date-add-canine">Tanggal Lahir</label>
                                <input class="form-control" id="date-add-canine" name="can_date_of_birth" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12" id="breeder-canines">
                            <label for="breeder">Breeder</label>
                            <input class="form-control typeahead" id="breeder" name="can_owner_name" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12" id="kennel-canines">
                            <label for="kennel">Kennel</label>
                            <input class="form-control typeahead" id="kennel" name="can_cage" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12" id="owner-canines">
                            <label for="owner">Pemilik</label>
                            <input class="form-control typeahead" id="owner" name="can_owner" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12" id="address-canines">
                            <label for="address">Address</label>
                            <input class="form-control typeahead" id="address" name="can_address" type="text" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary submit-add-canine">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php $this->load->view('frontend/layout/footer'); ?>
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.1.slim.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>