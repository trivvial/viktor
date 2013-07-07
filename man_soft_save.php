<?php
session_start();
include('add/connect.php');
include('add/functions.php');

/*skript na ulozenie masiny do db, vykona sa po stlaceni tlacidla add*/
if (isset($_POST['cnt'])) {
  //if (isset($_POST['update'])) {$update=$dat->real_escape_string(stripslashes($_POST['update']));} else {$update=0;}
  $SftCnt = $dat->real_escape_string(stripslashes($_POST['cnt']));
  $IDBundle = $dat->real_escape_string(stripslashes($_POST['idbund']));
  $NameOfBundle = $dat->real_escape_string(stripslashes($_POST['namebundle']));
  // for ($i=0; $i < $SftCnt; $i++) {
  //   $Prog[$i] = $_POST['prog'.[$i+1]])
  // }

  // $MachineMac = $dat->real_escape_string(stripslashes($_POST['mac']));
  // $MachineIP = $dat->real_escape_string(stripslashes($_POST['ip']));
  // $MachineOS = $dat->real_escape_string(stripslashes($_POST['os']));
  //$MachineLang = $dat->real_escape_string(stripslashes($_POST['lang']));
  // $MachineBundle = $dat->real_escape_string(stripslashes($_POST['bundle']));
  if (!$SftCnt) {
    $odpoved = "Select bundle you want to make changes to!";
    echo '<meta http-equiv="refresh" content="0;url=man_soft.php?o='.$odpoved.'">';
  }
  else {
    /* ulozenie */
      $kveri = $dat->query("delete from combo where cidbundle = '".$IDBundle."'");
        if ($kveri) {
            if(!empty($_POST['prog'])) {
            $progs = $_POST['prog'];
            foreach($progs as $prog)
              {
               $kveri = $dat->query("insert into combo values('','".$IDBundle."','".$prog."')");
              }
            }
            $odpoved = "Software list of bundle: ".$NameOfBundle." was updated.";
        } else {$odpoved = "Previous bundle settings could not be removed.";}
  }
  echo '<meta http-equiv="refresh" content="0;url=man_soft.php?&o='.$odpoved.'">';
}
else {
  echo '<meta http-equiv="refresh" content="0;url=man_soft.php?o=No direct access please, thanks!">';
}
?>