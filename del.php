<?php
session_start();
include('add/connect.php');
include('add/functions.php');

/*skript na vymazanie masiny z db, vykona sa po stlaceni tlacidla delete*/
if (isset($_POST['del'])) {
  $MachineID = $dat->real_escape_string(stripslashes($_POST['del']));
  $delete = $dat->query("delete FROM `machines` WHERE idmachine = '".$MachineID."'");
  if ($delete) {$odpoved = 'Machine was successfully deleted from database';}
  else {$odpoved = 'Unable to delete selected machine from database try again later';}
  echo '<meta http-equiv="refresh" content="0;url=delete.php?o='.$odpoved.'">';
}
else {
  echo '<meta http-equiv="refresh" content="0;url=delete.php?o=No direct access please, thanks!">';
}
?>