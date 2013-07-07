<?php
session_start();
include('add/connect.php');
include('add/functions.php');

/*skript na vymazanie z db, vykona sa po stlaceni tlacidla delete*/
if (isset($_POST['del'])) {
  $ImageID = $dat->real_escape_string(stripslashes($_POST['del']));
  $delete = $dat->query("delete FROM `programs` WHERE idprogram = '".$ImageID."'");
  if ($delete) {$odpoved = 'Software was successfully deleted from database';}
  else {$odpoved = 'Unable to delete selected software from database try again later';}
  echo '<meta http-equiv="refresh" content="0;url=deletei.php?o='.$odpoved.'">';
}
else {
  echo '<meta http-equiv="refresh" content="0;url=deletei.php?o=No direct access please, thanks!">';
}
?>