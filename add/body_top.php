<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<META http-equiv="Content-Type" content="text/html" charset="UTF-8">
<html>
<head>
<title>Base Controller</title>
<link rel="stylesheet" href="css/css.css" type="text/css" />
</head>
<body>
<!-- <div id="hlavny"> -->
	<span id="spanovy">» [<?php echo date('m-d-Y H:i:s', time());?>]<br>» <?php echo /*$_SESSION['user']*/'vkristi';?>@unattended:~$<div class="cursor"> </div></span>
  <div id="lavy">
  	<h1 style="margin-left:15px;">Links</h1>
		<?php include('add/l_menu.html'); ?>
  </div>