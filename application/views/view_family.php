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
   <title>Family</title>
</head>
<body>

<div class="container-fluid">
	<h3>Family</h3>
	<br />
	<table>
	   <tr>
		<th>Spouse</th>	 
		<th>Sibling</th>
	   </tr>
	   <?php 
		foreach ($canines as $row){
		   echo '<tr>';
		   echo '<td>'.$row->spouse.'</td>';
		   echo '<td>'.$row->sibling.'</td>';
		   echo '</tr>';
		}
	   ?>
	</table>
</div>
</body>
</html>