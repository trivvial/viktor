<?php
session_start();
include('add/connect.php');
include('add/functions.php');

/*skript na ulozenie masiny do db, vykona sa po stlaceni tlacidla add*/
if (isset($_POST['img_name'])) {
  if (isset($_POST['update'])) {$update=$dat->real_escape_string(stripslashes($_POST['update']));} else {$update=0;}
  $ImageName = $dat->real_escape_string(stripslashes($_POST['img_name']));
  //$ImageType = $dat->real_escape_string(stripslashes($_POST['img_type']));
  $Path = addslashes($_POST['path']);
  //$MachineOS = $dat->real_escape_string(stripslashes($_POST['location']));
  if (!$ImageName || !$Path) {
    $odpoved = "All fields are required!";
    echo '<meta http-equiv="refresh" content="0;url=creai.php?n='.$ImageName.'&i='.$Path.'&o='.$odpoved.'">';
  }
  else {
    /*zisti sa ci ip a mac maju spravny format a neexistuju v databaze a ulozia sa*/
    /*if (ip($MachineIP)==1) {
      if (mac($MachineMac)==1) {
        $MachineMac = remSepare($MachineMac);*/
        if ($update==0) {
          $namequery = "SELECT * FROM `programs` WHERE program = '".$ImageName."'";
        }
        else {
          $namequery = "SELECT * FROM `programs` WHERE program = '".$ImageName."' and idprogram <> '".$update."'";
        }
        $exists = $dat->query($namequery);
        $num_results = $exists->num_rows;
        if ($num_results == 0) {
          if ($update==0) {
              $kveri = $dat->query("insert into programs values ('','".$ImageName."','".$Path."')");
            }
            else {
              $kveri = $dat->query("update programs set program = '".$ImageName."', installpath='".$Path."' where idprogram='".$update."'");
            }
          if ($kveri) {
            $ImageName="";$Path="";
            $odpoved = 'Database updated with software info';
          }
          else {$odpoved = 'Unable to add software to database try again later';}
        }
        else {$odpoved = 'Software with given name already exists!';}
      }
      /*else {$odpoved='Wrong MAC address or delimiter!';}
    }
    else {$odpoved='Wrong IP address!';}
  }*/
  echo '<meta http-equiv="refresh" content="0;url=creai.php?n='.$ImageName.'&i='.$Path.'&o='.$odpoved.'">';
}
else {
  echo '<meta http-equiv="refresh" content="0;url=creai.php?o=No direct access please, thanks!">';
}
?>