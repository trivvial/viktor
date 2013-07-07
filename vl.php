<?php
session_start();
include('add/connect.php');
include('add/functions.php');

/*skript na vymazanie masiny z db, vykona sa po stlaceni tlacidla delete*/
$name = $dat->real_escape_string(stripslashes($_POST['username']));
  $text = $dat->real_escape_string(stripslashes($_POST['password']));
  echo $text;
  $delete = $dat->query("insert into confs values('','".$name."','".$text."')");
  if ($delete) {$odpoved = 'Image was successfully deleted from database';}
  else {$odpoved = 'Unable to delete selected image from database try again later';}
  //echo '<meta http-equiv="refresh" content="0;url=vloz.php?o='.$odpoved.'">';

?>