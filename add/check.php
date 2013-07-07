<?php
if(!isset($_SESSION['logged'])) {
  session_destroy();
  header("location:index.php");
  die();
  }
?>

