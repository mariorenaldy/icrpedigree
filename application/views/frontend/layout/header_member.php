<header class="web-heading mt-3">
    <a href="<?= base_url() ?>" class="text-decoration-none text-reset"><h1 id="wordmark" class="text-center fw-normal">Indonesian Canine Registry</h1></a>
</header>
<?php
    if (!$this->session->userdata('username')){
        echo '<script type="text/javascript">';
        echo 'window.location = "'.base_url().'frontend/Members";';
        echo '</script>';
    }
    if ($this->session->userdata('mem_type') != $this->config->item('pro_member')){
        echo '<script type="text/javascript">';
        echo 'window.location = "'.base_url().'frontend/Beranda";';
        echo '</script>';
    }
?>
