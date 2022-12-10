<?php
	header('Expires: Sun, 15 Dec 2002 06:00:00 GMT');
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0', false);
	header('Pragma: no-cache');
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="MobileOptimized" content="width" />
	<meta name="HandheldFriendly" content="true" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
	<title>Ubah Password</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/oneui/css/bootstrap.min.css">
	<style media="screen">
		.traperror{
			color: red;
		}
		.copyright{
			font-size: 90%;
		}
	</style>
</head>
<body>
	<div class="container">
		<?php $this->load->view('templates/header'); ?>
		<?php 
			if ($status){
		?>
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<h4>Ubah password berhasil. Login ke ICR Pedigree dengan password baru.</h4>
				</div>
			</div>
		<?php
			}
			else{
		?>
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<h4 class="traperror">Gagal ubah password. Hubungi ICR Pedigree Customer Service.</h4>
				</div>
			</div>
		<?php
			}
		?>
		<?php $this->load->view('templates/footer'); ?>
	</div>
</body>
</html>
