<?php
session_start();
include('add/connect.php');
//require('add/check.php');
include('add/functions.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<META http-equiv="Content-Type" content="text/html" charset="UTF-8">
<html>
<head>
<title>Base Controller</title>
<link rel="stylesheet" href="css/css.css" type="text/css" />
</head>
<body>
<div id="hlavny">
	<span id="spanovy">» [<?php echo date('m-d-Y H:i:s', time());?>]<br>» <?php $name="vkristi";echo $name;?>@unattended:~$<div class="cursor"> </div></span>
  <div id="lavy">
  	<h1 style="margin-left:15px;">Links</h1>
<?php include('add/l_menu.html'); ?>
  </div>
  <div id="stred">
	<div id="menu">
      <ul>
         <li style="border-bottom: none;border-left: 1px solid #FF9900;
border-top: 1px solid #FF9900;border-right: 1px solid #FF9900;"><a href="crea.php" id="Create" style="color:#FF9900;">Create machine</a></li>
         <li><a href="edit.php" id="Edit">Edit machine</a></li>
         <li><a href="delete.php" id="Delete">Delete machine</a></li>
      </ul>
   </div>
<?php
if (isset($_GET["o"])) {$o=$dat->real_escape_string(stripslashes($_GET["o"]));} else {$o="";}
if (isset($_GET["n"])) {$n=$dat->real_escape_string(stripslashes($_GET["n"]));} else {$n="";}
if (isset($_GET["m"])) {$m=$dat->real_escape_string(stripslashes($_GET["m"])); $m=addSepare(remSepare($m));} else {$m="";}
if (isset($_GET["i"])) {$i=$dat->real_escape_string(stripslashes($_GET["i"]));} else {$i="";}
if (isset($_GET["l"])) {$l=$dat->real_escape_string(stripslashes($_GET["l"]));} else {$l="";}
if (isset($_GET["p"])) {$p=$dat->real_escape_string(stripslashes($_GET["p"]));} else {$p="";}
if (isset($_GET["q"])) {$q=$dat->real_escape_string(stripslashes($_GET["q"]));} else {$q="";}

if (isset($_POST["e"])) {
  $e=$dat->real_escape_string(stripslashes($_POST["e"]));
  $kveri = $dat->query("select machines.idmachine, machines.name, machines.mac, machines.ip, os.name as os, bundle.name as bundle, lang.language from machines, os, bundle, lang where machines.os=os.idos and machines.bundle=bundle.idbundle and os.lang=lang.idlang and machines.idmachine='".$e."'");
  $row = $kveri->fetch_assoc();
  $n = $row["name"]; $m = addSepare($row["mac"]); $i=$row["ip"]; $l=$row["os"]; $p=$row["language"]; $q=$row["bundle"];
  $o = "You are editing machine: <code>". $n . " " . $m ."</code>";
} else {$e="";}
?>
<p>Add new machine to database or edit existing one:
</p>
<p id="odpoved"><?php echo $o; ?></p>
<form id="formular" action="crea_save.php" method="post">
  <?php if (isset($_POST["e"])) {
    echo '<input TYPE="hidden" VALUE="'.$e.'" name="update">';
   } ?>
    <table border="0">

      <tr>
        <td>Machine name</td>
        <td><input type="text" class="rounded" name="name" value="<?php echo $n;?>" maxlength="20" size="20" /></td>
        <td id="formular_name_errorloc"> </td>
      </tr>

      <tr>
        <td>MAC address</td>
        <td> <input type="text" class="rounded" name="mac" value="<?php echo $m;?>" maxlength="17" size="20" />
        </td>
        <td id="formular_mac_errorloc"></td>
      </tr>

      <tr>
        <td>IP address</td>
        <td> <input type="text" class="rounded" name="ip" value="<?php echo $i;?>" maxlength="15" size="20" />
        </td>
        <td id="formular_ip_errorloc"></td>
      </tr>
      <tr>
        <td>OS</td>
        <td>
        <?php
        $os = $dat->query("select os.idos, os.name, lang.language from os, lang where os.lang=lang.idlang");
        $num_results = $os->num_rows;
        echo    "<select name=\"os\" class=\"rounded\" style=\"width: 160px;margin-left: 3px;\">";
        for ($i=0; $i <$num_results; $i++) {
          $row1 = $os->fetch_assoc();
          echo '<option value="'.$row1['idos'].'"';
          if ($row1['name'] == $l) { echo ' selected="selected"';}
          echo '>'.$row1['name'].' - '.$row1['language'].'</option>';
        }
        ?>
        </td>
        <td id="formular_location_errorloc"></td>
      </tr>

<!--       <tr>
        <td>Language</td>
        <td>
        <?php
        //$lang = $dat->query("select * from lang");
        //$num_results = $lang->num_rows;
        //echo    "<select name=\"lang\" class=\"rounded\" style=\"width: 160px;margin-left: 3px;\">";
        //for ($i=0; $i <$num_results; $i++) {
        //  $row2 = $lang->fetch_assoc();
        //  echo '<option value="'.$row2['idlang'].'"';
        //  if ($row2['language'] == $p) { echo ' selected="selected"';}
        //  echo '>'.$row2['language'].'</option>';
        //}
        ?>
        </td>
        <td id="formular_location_errorloc"></td>
      </tr> -->

      <tr>
        <td>Bundle</td>
        <td>
          <?php
        $bundle = $dat->query("select * from bundle");
        $num_results = $bundle->num_rows;
        echo    "<select name=\"bundle\" class=\"rounded\" style=\"width: 160px;margin-left: 3px;\">";
        for ($i=0; $i <$num_results; $i++) {
          $row3 = $bundle->fetch_assoc();
          echo '<option value="'.$row3['idbundle'].'"';
          if ($row3['name'] == $q) { echo ' selected="selected"';}
          echo '>'.$row3['name'].'</option>';
        }
        ?>
        </td>
        <td id="formular_location_errorloc"></td>
      </tr>

      <tr>
        <td></td>
        <td colspan="2">
          <input id="submit" type="submit" class="rounded" value="Add | Change"></td>
        <td></td>
      </tr>
    </table>
  </form>
<?php
   if (isset($_POST["e"])) {
  echo '<br><a href="edit.php" id="odpoved">&lt;&lt;cancel&gt;&gt;</a>';
} else {$e="";}
?>

  </div>
  <div id="pravy">
		 <?php include('add/r_menu.html'); ?>
  </div>
</div>
</body>
</html>