<html lang="en-US">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="MobileOptimized" content="width" />
	<meta name="HandheldFriendly" content="true" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
	<title>Ubah Password</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/oneui/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.css">
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
		<div class="row">
			<div class="col-sm-12">
				<h4 class="text-center">Ubah Password</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="traperror">
					<?php echo validation_errors(); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<form class="form-horizontal" action="<?php echo base_url(); ?>app/Email/changepassword" method="post">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<div class="form-group">
					<label class="control-label col-sm-2" for="password">Password:</label>
					<div class="col-sm-10">
						<input class="form-control" type="password" id="password" name="password" placeholder="Password" value="">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="confirm">Konfirmasi Password:</label>
					<div class="col-sm-10">
						<input class="form-control" type="password" id="confirm" name="confirm" placeholder="Confirm Password" value="">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-8 col-sm-offset-2">
						<button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-save"></i></button>
					</div>
				</div>
			</form>
		</div>
		<?php $this->load->view('templates/footer'); ?>
	</div>
</body>
</html>
