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
   <title>Silsilah Anjing</title>
   <link href="<?php echo base_url(); ?>assets/oneui/css/bootstrap.min.css" rel="stylesheet" />
   <link href="{{base_url()}}assets/primitive/demo/js/jquery/ui-lightness/jquery-ui-1.10.2.custom.css" rel="stylesheet" />
   <link href="{{base_url()}}assets/primitive/demo/css/primitives.latest.css" media="screen" rel="stylesheet" type="text/css" />
    <style media="screen">
        .bp-title {
            text-overflow: ellipsis;
            -o-text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 10px;
            line-height: 16px;
            color: white;
            padding: 0;
        }

        .card {
            /* Add shadows to create the "card" effect */
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            width: 170px;
        }

        /* On mouse-over, add a deeper shadow */
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        /* Add some padding inside the card container */
        .containerCard {
            padding: 1px;
        }

        .small{
            font-size: x-small;
        }

        .middle-center{
            text-align: center !important;
            vertical-align: middle !important;
        }
    </style>
</head>
<body>
<div class="container-fluid text-center">
	<h3>Silsilah Anjing</h3>
	<br />
	<div class="block-content" style="overflow-y: auto;">
		<table class="table table-bordered table-responsive ">
			<tr>
				<!-- ARTechnology -->
				<td colspan="4" align="right">
                    <div class="card text-center">
                        <?php if ($canine[0]['can_photo'] == '-'){ ?>
                            <img src="<?php echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />
                        <?php } else { ?>
                            <img src="<?php echo base_url(); ?>uploads/canine/<?php echo $canine[0]['can_photo']; ?>" width="170px" alt="" />
                        <?php } ?>
                        <div class="containerCard">
                            <p><b><?php echo $canine[0]['can_a_s']; ?></b></p>
                            <p></p>
                        </div>
                    </div>
				</td>
				<td colspan="4" class="middle-center">
                    <div class="small"><?php echo $canine[0]['can_note']; ?></div>
				</td>
				<!-- ARTechnology -->
			</tr>
			<tr>
				<td colspan="4" align="center">
				<?php if ($canine[0]['sire'][0] != null){ ?>
					<div class="card text-center">
						<?php if ($canine[0]['sire'][0]['can_photo'] == '-' ){ ?>
							<img src="<?php echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />
                        <?php } else { ?>
							<img src="<?php echo base_url(); ?>uploads/canine/<?php echo $canine[0]['sire'][0]['can_photo']; ?>" width="170px" alt="" />
						<?php } ?>

						<div class="containerCard">
                            <p><b><?php echo $canine[0]['sire'][0]['can_a_s']; ?></b></p>
						</div>
					</div>
				<?php } else { ?>
					<div class="card">
                        <div class="containerCard">
                            <!-- ARTechnology -->
                            <p><b>NO MALE</b>
                            <!-- ARTechnology -->
                            </p>
                        </div>
					</div>
				<?php } ?>
				</td>
				<td colspan="4" align="center">
				<?php if ($canine[0]['mom'][0] != null ){ ?>
					<div class="card text-center">
						<?php if ($canine[0]['mom'][0]['can_photo'] == '-' ){ ?>
							<img src="<?php echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />
                        <?php } else { ?>
                            <img src="<?php echo base_url(); ?>uploads/canine/<?php echo $canine[0]['mom'][0]['can_photo']; ?>" width="170px" alt="" />
						<?php } ?>

						<div class="containerCard">
                            <p><b><?php echo $canine[0]['mom'][0]['can_a_s']; ?></b>
						</p>
						</div>
					</div>
				<?php } else { ?>
					<div class="card text-center">
                        <div class="containerCard">
                            <!-- ARTechnology -->
                            <p><b>NO FEMALE</b>
                            <!-- ARTechnology -->
                            </p>
                        </div>
					</div>
				<?php } ?>
				</td>
			</tr>

			<tr>
			<!-- father -->
				<td colspan="2" align="center">
				<?php if ($canine[0]['sire'][0]['sire'][0] != null ){ ?>
					<div class="card text-center">
						<?php if ($canine[0]['sire'][0]['sire'][0]['can_photo'] == '-' ){ ?>
							<img src="<?php echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />
                        <?php } else { ?>
							<img src="<?php echo base_url(); ?>uploads/canine/<?php echo $canine[0]['sire'][0]['sire'][0]['can_photo']; ?>" width="170px" alt="" />
						<?php } ?>

						<div class="containerCard">
                            <p><b><?php echo $canine[0]['sire'][0]['sire'][0]['can_a_s']; ?></b></p>
						</div>
					</div>
				<?php } else { ?>
					<div class="card text-center">
                        <!-- <img src="<?php //echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" /> -->
                        <div class="containerCard">
                            <!-- ARTechnology -->
                            <p><b>NO MALE</b>
                            <!-- ARTechnology -->
                            </p>
                        </div>
					</div>
				<?php } ?>
				</td>
				<td colspan="2" align="center">
				<?php if ($canine[0]['sire'][0]['mom'][0] != null ){ ?>
					<div class="card text-center">
						<?php if ($canine[0]['sire'][0]['mom'][0]['can_photo'] == '-' ){ ?>
							<img src="<?php echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />
                        <?php } else { ?>
							<img src="<?php echo base_url(); ?>uploads/canine/<?php echo $canine[0]['sire'][0]['mom'][0]['can_photo']; ?>" width="170px" alt="" />
						<?php } ?>
						<div class="containerCard">
                            <p><b><?php echo $canine[0]['sire'][0]['mom'][0]['can_a_s']; ?></b></p>
						</div>
					</div>
				<?php } else { ?>
					<div class="card text-center">
					<!-- <img src="<?php //echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" /> -->
                        <div class="containerCard">
                            <!-- ARTechnology -->
                            <p><b>NO FEMALE</b>
                            <!-- ARTechnology -->
                            </p>
                        </div>
					</div>
				<?php } ?>
				</td>
				<!-- ==============================================================================================================  -->
				<!-- mom -->
				<td colspan="2" align="center">
				<?php if ($canine[0]['mom'][0]['sire'][0] != null ){ ?>
					<div class="card text-center">
						<?php if ($canine[0]['mom'][0]['sire'][0]['can_photo'] == '-' ){ ?>
							<img src="<?php echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />
                        <?php } else { ?>
							<img src="<?php echo base_url(); ?>uploads/canine/<?php echo $canine[0]['mom'][0]['sire'][0]['can_photo']; ?>" width="170px" alt="" />
						<?php } ?>
						<div class="containerCard">
                            <p><b><?php echo $canine[0]['mom'][0]['sire'][0]['can_a_s']; ?></b></p>
						</div>
					</div>
				<?php } else { ?>
					<div class="card text-center">
					<!-- <img src="<?php //echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" /> -->
                        <div class="containerCard">
                            <!-- ARTechnology -->
                            <p><b>NO MALE</b>
                            <!-- ARTechnology -->
                            </p>
                        </div>
					</div>
				<?php } ?>
				</td>
				<td colspan="2" align="center">
				<?php if ($canine[0]['mom'][0]['mom'][0] != null ){ ?>
					<div class="card text-center">
						<?php if ($canine[0]['mom'][0]['mom'][0]['can_photo'] == '-' ){ ?>
							<img src="<?php echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />
                        <?php } else { ?>
							<img src="<?php echo base_url(); ?>uploads/canine/<?php echo $canine[0]['mom'][0]['mom'][0]['can_photo']; ?>" width="170px" alt="" />
						<?php } ?>
						<div class="containerCard">
                            <p><b><?php echo $canine[0]['mom'][0]['mom'][0]['can_a_s']; ?></b></p>
						</div>
					</div>
				<?php } else { ?>
					<div class="card text-center">
					<!-- <img src="<?php //echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" /> -->
                        <div class="containerCard">
                            <!-- ARTechnology -->
                            <p><b>NO FEMALE</b>
                            <!-- ARTechnology -->
                            </p>
                        </div>
					</div>
				<?php } ?>
				</td>
			</tr>

			<!--================================  -->
			<tr>
			<td>
				<?php if ($canine[0]['sire'][0]['sire'][0]['sire'][0] != null ){ ?>
					<div class="card text-center">
                        <?php if ($canine[0]['sire'][0]['sire'][0]['sire'][0]['can_photo'] == '-' ){ ?>
                            <img src="<?php echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />
                        <?php } else { ?>
                            <img src="<?php echo base_url(); ?>uploads/canine/<?php echo $canine[0]['sire'][0]['sire'][0]['sire'][0]['can_photo']; ?>" width="170px" alt="" />
                        <?php } ?>
                        <div class="containerCard">
                            <p><b><?php echo $canine[0]['sire'][0]['sire'][0]['sire'][0]['can_a_s']; ?></b></p>
                        </div>
					</div>
				<?php } else { ?>
				<div class="card text-center">
					<!-- <img src="<?php //echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" /> -->
                    <div class="containerCard">
                        <!-- ARTechnology -->
                        <p><b>NO MALE</b>
                        <!-- ARTechnology -->
                        </p>
                    </div>
				</div>
				<?php } ?>
			</td>
			<td>
				<?php if ($canine[0]['sire'][0]['sire'][0]['mom'][0] != null ){ ?>
					<div class="card text-center">
                        <?php if ($canine[0]['sire'][0]['sire'][0]['mom'][0]['can_photo'] == '-' ){ ?>
                            <img src="<?php echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />
                        <?php } else { ?>
                            <img src="<?php echo base_url(); ?>uploads/canine/<?php echo $canine[0]['sire'][0]['sire'][0]['mom'][0]['can_photo']; ?>" width="170px" alt="" />
                        <?php } ?>
                        <div class="containerCard">
                            <p><b><?php echo $canine[0]['sire'][0]['sire'][0]['mom'][0]['can_a_s']; ?></b></p>
                        </div>
					</div>
				<?php } else { ?>
				<div class="card text-center">
					<!-- <img src="<?php //echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" /> -->
					<div class="containerCard">
                        <!-- ARTechnology -->
                        <p><b>NO FEMALE</b>
                        <!-- ARTechnology -->
                        </p>
					</div>
				</div>
				<?php } ?>
			</td>
			<!-- sire sire sire-->
			<td>
				<?php if ($canine[0]['sire'][0]['mom'][0]['sire'][0] != null ){ ?>
					<div class="card text-center">
                        <?php if ($canine[0]['sire'][0]['mom'][0]['sire'][0]['can_photo'] == '-' ){ ?>
                            <img src="<?php echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />
                        <?php } else { ?>
                            <img src="<?php echo base_url(); ?>uploads/canine/<?php echo $canine[0]['sire'][0]['mom'][0]['sire'][0]['can_photo']; ?>" width="170px" alt="" />
                        <?php } ?>
                        <div class="containerCard">
                            <p><b><?php echo $canine[0]['sire'][0]['mom'][0]['sire'][0]['can_a_s']; ?></b></p>
                        </div>
					</div>
				<?php } else { ?>
				<div class="card text-center">
					<!-- <img src="<?php //echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" /> -->
					<div class="containerCard">
                        <!-- ARTechnology -->
                        <p><b>NO MALE</b>
                        <!-- ARTechnology -->
                        </p>
					</div>
				</div>
				<?php } ?>
			</td>
			<td>
				<?php if ($canine[0]['sire'][0]['mom'][0]['mom'][0] != null ){ ?>
					<div class="card text-center">
                        <?php if ($canine[0]['sire'][0]['mom'][0]['mom'][0]['can_photo'] == '-' ){ ?>
                            <img src="<?php echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />
                        <?php } else { ?>
                            <img src="<?php echo base_url(); ?>uploads/canine/<?php echo $canine[0]['sire'][0]['mom'][0]['mom'][0]['can_photo']; ?>" width="170px" alt="" />
                        <?php } ?>
                        <div class="containerCard">
                            <p><b><?php echo $canine[0]['sire'][0]['mom'][0]['mom'][0]['can_a_s']; ?></b></p>
                        </div>
					</div>
				<?php } else { ?>
				<div class="card text-center">
					<!-- <img src="<?php //echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" /> -->
					<div class="containerCard">
                        <!-- ARTechnology -->
                        <p><b>NO FEMALE</b>
                        <!-- ARTechnology -->
                        </p>
					</div>
				</div>
				<?php } ?>
			</td>
			<!-- sire sire mom -->

				<td>
				<?php if ($canine[0]['mom'][0]['sire'][0]['sire'][0] != null ){ ?>
					<div class="card text-center">
						<?php if ($canine[0]['mom'][0]['sire'][0]['sire'][0]['can_photo'] == '-' ){ ?>
							<img src="<?php echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />
                        <?php } else { ?>
							<img src="<?php echo base_url(); ?>uploads/canine/<?php echo $canine[0]['mom'][0]['sire'][0]['sire'][0]['can_photo']; ?>" width="170px" alt="" />
						<?php } ?>
						<div class="containerCard">
                            <p><b><?php echo $canine[0]['mom'][0]['sire'][0]['sire'][0]['can_a_s']; ?></b></p>
						</div>
					</div>
				<?php } else { ?>
					<div class="card text-center">
					<!-- <img src="<?php //echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" /> -->
                        <div class="containerCard">
                            <!-- ARTechnology -->
                            <p><b>NO MALE</b>
                            <!-- ARTechnology -->
                            </p>
                        </div>
					</div>
				<?php } ?>
				</td>
				<td>
				<?php if ($canine[0]['mom'][0]['sire'][0]['mom'][0] != null ){ ?>
					<div class="card text-center">
						<?php if ($canine[0]['mom'][0]['sire'][0]['mom'][0]['can_photo'] == '-' ){ ?>
							<img src="<?php echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />
                        <?php } else { ?>
							<img src="<?php echo base_url(); ?>uploads/canine/<?php echo $canine[0]['mom'][0]['sire'][0]['mom'][0]['can_photo']; ?>" width="170px" alt="" />
						<?php } ?>
						<div class="containerCard">
                            <p><b><?php echo $canine[0]['mom'][0]['sire'][0]['mom'][0]['can_a_s']; ?></b></p>
						</div>
					</div>
				<?php } else { ?>
					<div class="card text-center">
					<!-- <img src="<?php //echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" /> -->
                        <div class="containerCard">
                            <!-- ARTechnology -->
                            <p><b>NO FEMALE</b>
                            <!-- ARTechnology -->
                            </p>
                        </div>
					</div>
				<?php } ?>
				</td>

			<!-- mom mom sire -->
			<td>
				<?php if ($canine[0]['mom'][0]['mom'][0]['sire'][0] != null ){ ?>
					<div class="card text-center">
                        <?php if ($canine[0]['mom'][0]['mom'][0]['sire'][0]['can_photo'] == '-' ){ ?>
                            <img src="<?php echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />
                        <?php } else { ?>
                            <img src="<?php echo base_url(); ?>uploads/canine/<?php echo $canine[0]['mom'][0]['mom'][0]['sire'][0]['can_photo']; ?>" width="170px" alt="" />
                        <?php } ?>
                        <div class="containerCard">
                            <p><b><?php echo $canine[0]['mom'][0]['mom'][0]['sire'][0]['can_a_s']; ?></b></p>
                        </div>
					</div>
				<?php } else { ?>
				<div class="card text-center">
					<!-- <img src="<?php //echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" /> -->
					<div class="containerCard">
                        <!-- ARTechnology -->
                        <p><b>NO MALE</b>
                        <!-- ARTechnology -->
                        </p>
					</div>
				</div>
				<?php } ?>
			</td>
			<td>
				<?php if($canine[0]['mom'][0]['mom'][0]['mom'][0] != null ){ ?>
					<div class="card text-center">
                        <?php if ($canine[0]['mom'][0]['mom'][0]['mom'][0]['can_photo'] == '-' ){ ?>
                            <img src="<?php echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px" height="105px" alt="" />
                        <?php } else { ?>
                            <img src="<?php echo base_url(); ?>uploads/canine/<?php echo $canine[0]['mom'][0]['mom'][0]['mom'][0]['can_photo']; ?>" width="170px" alt="" />
                        <?php } ?>
                        <div class="containerCard">
                            <p><b><?php echo $canine[0]['mom'][0]['mom'][0]['mom'][0]['can_a_s']; ?></b></p>
                        </div>
					</div>
				<?php } else { ?>
				<div class="card text-center">
					<!-- <img src="<?php //echo base_url(); ?>assets/oneui/img/avatars/image.png" width="170px"  height="105px" alt="" /> -->
					<div class="containerCard">
                        <!-- ARTechnology -->
                        <p><b>NO FEMALE</b>
                        <!-- ARTechnology -->
                        </p>
					</div>
				</div>
				<?php } ?>
			</td>
			<!-- mom mom mom -->

			</tr>
		</table>

	</div>
</div>
</body>
</html>