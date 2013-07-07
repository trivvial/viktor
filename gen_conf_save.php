<?php
session_start();
include('add/connect.php');
include('add/functions.php');

/*skript na generovanie konfiguraku podla masiny, vykona sa po stlaceni tlacidla generate*/
if (isset($_POST['gen'])) {
  $MachineID = $dat->real_escape_string(stripslashes($_POST['gen']));

  $machine = $dat->query("select * from machines where idmachine='".$MachineID."'");
  $row = $machine->fetch_assoc();
  $n = $row["name"]; $m = addSepare($row["mac"]); $i=$row["ip"]; $l=$row["os"]; $q=$row["bundle"];

  $nl = "\r\n";
  $text[0] = 'host '.$n.' {';
  $text[1] = '  hardware ethernet '.$m.';';
  $text[2] = '  fixed-address '.$i.';';
  $text[3] = '  option host-name "'.$n.'";';
  $text[4] = '}';

  $conf = $dat->query("select content from confs where idconf = 7");
  $row = $conf->fetch_assoc();
  $content = $row['content'];

  $subor = 'configs/isc-dhcpd3';
  $handle = fopen($subor, 'c') or die('Cannot open file:  '.$subor);

  fwrite($handle, $content);
  for ($i=0; $i < count($text); $i++) {
   fwrite($handle, $nl);
   fwrite($handle, $text[$i]);
  }
  fwrite($handle, $nl);
  fclose($handle);

  $odpoved = 'Configuration file for '.$n.' successfully generated';

  echo '<meta http-equiv="refresh" content="0;url=man_ma.php?o='.$odpoved.'">';
}
else {
  echo '<meta http-equiv="refresh" content="0;url=man_ma.php?o=No direct access please, thanks!">';
}
?>