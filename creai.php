<?php
session_start();
 //require('add/check.php');
require('add/connect.php');
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
border-top: 1px solid #FF9900;border-right: 1px solid #FF9900;"><a href="creai.php" id="Create" style="color:#FF9900;">Add software</a></li>
         <li><a href="editi.php" id="Edit">Edit software</a></li>
         <li><a href="deletei.php" id="Delete">Delete software</a></li>
      </ul>
   </div>
<?php
if (isset($_GET["o"])) {$o=$dat->real_escape_string(stripslashes($_GET["o"]));} else {$o="";}
if (isset($_GET["n"])) {$n=$dat->real_escape_string(stripslashes($_GET["n"]));} else {$n="";}
if (isset($_GET["m"])) {$m=$dat->real_escape_string(stripslashes($_GET["m"]));} else {$m="";}
if (isset($_GET["i"])) {$i=$dat->real_escape_string(stripslashes($_GET["i"]));} else {$i="";}

if (isset($_POST["e"])) {
  $e=$dat->real_escape_string(stripslashes($_POST["e"]));
  $kveri = $dat->query("select * from programs where idprogram='".$e."'");
  $row = $kveri->fetch_assoc();
  $n = $row["program"]; $i=$row["installpath"];
  $o = "You are editing software: <code>". $n . " - " . $i ."</code>";
} else {$e="";}
?>
<p>Add new software to database or edit existing one:
</p>
<p id="odpoved"><?php echo $o; ?></p>
<form id="formular" action="creai_save.php" method="post">
    <?php if (isset($_POST["e"])) {
    echo '<input TYPE="hidden" VALUE="'.$e.'" name="update">';
   } ?>
    <table border="0">

      <tr>
        <td>Software name</td>
        <td><input type="text" class="rounded" id="img_name" name="img_name" value="<?php echo $n;?>" maxlength="20" size="20" /></td>
      </tr>

      <tr>
        <td>Install path</td>
        <td> <input type="text" class="rounded" id="path" name="path" value="<?php echo $i;?>" maxlength="32" size="20" />
        </td>
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
  echo '<br><a href="editi.php" id="odpoved">&lt;&lt;cancel&gt;&gt;</a>';
} else {$e="";}
?>
  </div>
  <div id="pravy">

		 <?php include('add/r_menu.html'); ?>

  </div>
</div>
</body>
</html>