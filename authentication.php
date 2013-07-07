<?php
session_start();
include('add/connect.php');
  if (!isset($_SESSION['logged'])) {
    $meno = $dat->real_escape_string(stripslashes($_POST['meno']));
    $heslo = md5($dat->real_escape_string(stripslashes($_POST['heslo'])));

  if (!$meno || !$heslo)
  {
    session_destroy();
    echo '<meta http-equiv="refresh" content="0.1;url=index.php?var=Wrong username or password">';
    exit;
  }

  $result = $dat->query("SELECT * FROM users WHERE username='$meno' && password='$heslo'");
  $zaznamov = $result->num_rows;

 if($zaznamov == 1) {
  $row = $result->fetch_assoc();
  //$dat->query("insert into log values('','".$row['idlogin']."',CURRENT_TIMESTAMP())");
  $_SESSION['logged'] = 1;
  $_SESSION['user'] = $row['username'];
  // $_SESSION['login'] = $row['login'];
  // $_SESSION['meno'] = $row['InspName'];
  // $_SESSION['priezvisko'] = $row['InspSurname'];
  // $_SESSION['typ'] = $row['Admin'];
  // $_SESSION['edit'] = $row['Edit'];
  // $_SESSION['active'] = $row['Active'];
  // $result = $dat->query("select max(LoginDate) as timestamp from log where Login = '".$row['idlogin']."'");
  // $row = $result->fetch_assoc();
  // $_SESSION['timestamp'] = $row['timestamp'];

  echo '<meta http-equiv="refresh" content="0.1;url=index_logged.php">';
  }
 else {
  // $_SESSION['active'] = "ine";
  // echo '<meta http-equiv="refresh" content="0.1;url=indexno.php">';
   session_destroy();
    echo '<meta http-equiv="refresh" content="0.1;url=index.php?var=Wrong username or password">';
    exit;
  }
 }
  else {
  echo '<meta http-equiv="refresh" content="0.1;url=index.php">';
  }
?>