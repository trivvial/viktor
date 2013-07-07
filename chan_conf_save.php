<?php
session_start();
include('add/connect.php');
include('add/functions.php');

/*skript na ulozenie zmien v konfiguraku do db, vykona sa po stlaceni tlacidla save*/
if (isset($_POST['idconf'])) {
  //$MachineName = $dat->real_escape_string(stripslashes($_POST['config']));
  $IDConfigurationFile = $_POST['idconf'];
  $ConfigurationFile = addslashes($_POST['config']);
  $NameOfConfFile = $_POST['nameconf'];
  if ($IDConfigurationFile=="") { $odpoved = 'Please select configuration file.';}
  else {
    $kveri = $dat->query("update confs set content='".$ConfigurationFile."' where idconf='".$IDConfigurationFile."'");
    if ($kveri) {
            $IDConfigurationFile="";$ConfigurationFile="";
            $odpoved = 'Configuration file '.$NameOfConfFile.' was successfully saved';
          }
          else {$odpoved = 'Unable to save changes, try again later';}
  }

  echo '<meta http-equiv="refresh" content="0;url=chan_conf.php?o='.$odpoved.'">';
}
else {
  echo '<meta http-equiv="refresh" content="0;url=chan_conf.php?o=No direct access please, thanks!">';
}
?>