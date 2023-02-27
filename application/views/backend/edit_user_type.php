<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Edit User Type</title>
    <?php $this->load->view('templates/head'); ?>
    <link href="<?= base_url(); ?>/assets/css/jquery-ui.min.css" rel="stylesheet" />
</head>
<body>
    <?php $this->load->view('templates/redirect'); ?>
    <main class="container">
        <?php $this->load->view('templates/header'); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-items-center">
                    <h3 class="text-center text-primary">Edit User Type</h3>  
                    <form class="form-horizontal" action="<?= base_url(); ?>backend/Users/validate_edit_user_type" method="post">
                        <div class="row mb-2">
                            <div class="col-sm-2">Username</div>
                            <div class="col-sm-4">: <?= $user->use_username ?></div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="control-label col-md-2">User Type</label>
                            <div class="col-md-10">
                                <?php
                                foreach ($type as $row) {
                                    $pil[$row->user_type_id] = $row->user_type_name;
                                }
                                if (!$mode)
                                    echo form_dropdown('use_type_id', $pil, $user->use_type_id, 'class="form-control"');
                                else
                                    echo form_dropdown('use_type_id', $pil, set_value('use_type_id'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <input type="hidden" name="use_id" value="<?= $user->use_id ?>" />
                        <div class="text-center">
                            <button id="buttonSubmit" class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-danger" type="button" onclick="window.location = '<?= base_url() ?>backend/Users'">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php $this->load->view('templates/footer'); ?>
    </main>
    <?php $this->load->view('templates/script'); ?>
    <script src="<?= base_url(); ?>assets/js/jquery-ui.min.js"></script>
</body>

</html>