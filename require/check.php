<?php
if(!isset($_SESSION['is_logged_in'])) {
  header("location:index.php");
  die();
  }
  else {
  	if ($_SESSION['active'] == "0") {
  		unset($_SESSION['is_logged_in']);
 		unset($_SESSION['login']);
  		unset($_SESSION['meno']);
  		unset($_SESSION['priezvisko']);
  		unset($_SESSION['typ']);
  		unset($_SESSION['edit']);
  		//$_SESSION['active'] = "2";
  		header("location:indexno.php");
  		die();
	}
  }
?>

