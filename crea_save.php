<?php
session_start();
include('add/connect.php');
include('add/functions.php');

/*skript na ulozenie masiny do db, vykona sa po stlaceni tlacidla add*/
if (isset($_POST['name'])) {
  if (isset($_POST['update'])) {$update=$dat->real_escape_string(stripslashes($_POST['update']));} else {$update=0;}
  $MachineName = $dat->real_escape_string(stripslashes($_POST['name']));
  $MachineMac = $dat->real_escape_string(stripslashes($_POST['mac']));
  $MachineIP = $dat->real_escape_string(stripslashes($_POST['ip']));
  $MachineOS = $dat->real_escape_string(stripslashes($_POST['os']));
  //$MachineLang = $dat->real_escape_string(stripslashes($_POST['lang']));
  $MachineBundle = $dat->real_escape_string(stripslashes($_POST['bundle']));
  if (!$MachineName || !$MachineMac || !$MachineIP || !$MachineOS || !$MachineBundle) {
    $odpoved = "All fields are required!";
    //echo '<meta http-equiv="refresh" content="0;url=crea.php?n='.$MachineName.'&m='.$MachineMac.'&i='.$MachineIP.'&l='.$MachineOS.'&p='.$MachineLang.'&q='.$MachineBundle.'&o='.$odpoved.'">';
    echo '<meta http-equiv="refresh" content="0;url=crea.php?n='.$MachineName.'&m='.$MachineMac.'&i='.$MachineIP.'&l='.$MachineOS.'&q='.$MachineBundle.'&o='.$odpoved.'">';
  }
  else {
    /*zisti sa ci ip a mac maju spravny format a neexistuju v databaze a ulozia sa*/
    if (ip($MachineIP)==1) {
      if (mac($MachineMac)==1) {
        if ($update==0) {
          $macquery = "SELECT * FROM `machines` WHERE mac = '".$MachineMac."'";
          $ipquery = "SELECT * FROM `machines` WHERE ip = '".$MachineIP."'";
        }
        else {
          $macquery = "SELECT * FROM `machines` WHERE mac = '".$MachineMac."' and idmachine <> '".$update."'";
          $ipquery = "SELECT * FROM `machines` WHERE ip = '".$MachineIP."' and idmachine <> '".$update."'";
        }
        $MachineMac = remSepare($MachineMac);
        $exists = $dat->query($macquery);
        $num_results = $exists->num_rows;
        if ($num_results == 0) {
          $exists = $dat->query($ipquery);
          $num_results = $exists->num_rows;
          if ($num_results == 0) {
            if ($update==0) {
              $kveri = $dat->query("insert into machines values ('','".$MachineName."','".$MachineMac."','".$MachineIP."','".$MachineOS."','".$MachineBundle."')");
            }
            else {
              $kveri = $dat->query("update machines set name = '".$MachineName."', mac ='".$MachineMac."', ip='".$MachineIP."', os='".$MachineOS."', bundle='".$MachineBundle."' where idmachine='".$update."'");
            }
            if ($kveri) {
            $MachineName="";$MachineMac="";$MachineIP="";$MachineOS="";/*$MachineLang="";*/$MachineBundle="";
            $odpoved = 'Database updated with machine info';
            }
            else {$odpoved = 'Unable to add machine to database try again later';}
          }
          else {$odpoved = 'Machine with given IP address already exists!';}
        }
        else {$odpoved = 'Machine with given MAC address already exists!';}
      }
      else {$odpoved='Wrong MAC address or delimiter!';}
    }
    else {$odpoved='Wrong IP address!';}
  }
  echo '<meta http-equiv="refresh" content="0;url=crea.php?n='.$MachineName.'&m='.$MachineMac.'&i='.$MachineIP.'&l='.$MachineOS.'&q='.$MachineBundle.'&o='.$odpoved.'">';
}
else {
  echo '<meta http-equiv="refresh" content="0;url=crea.php?o=No direct access please, thanks!">';
}
?>