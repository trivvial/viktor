<?php
session_start();
  //require('add/check.php');
  require('add/connect.php');
  require('add/functions.php');
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
         <li ><a href="gen_conf.php">Generate</a></li>
         <li style="border-bottom: none;border-left: 1px solid #FF9900;
border-top: 1px solid #FF9900;border-right: 1px solid #FF9900;"><a href="chan_conf.php" style="color:#FF9900;">Configuration files</a></li>
         <li><a href="#">Add configuration file</a></li>
      </ul>
   </div>

   <?php
  if (isset($_GET["o"])) {$o=$dat->real_escape_string(stripslashes($_GET["o"]));} else {$o="";}
  if (isset($_POST["confile"])) {
    $confile=$dat->real_escape_string(stripslashes($_POST["confile"]));
    $result = $dat->query("select name,content from confs where idconf='".$confile."'");
    $row = $result->fetch_assoc();
    $content = $row['content'];
    $meno = $row['name'];
  }
  else {$confile=""; $content = "";}

  $result = $dat->query("select idconf, name from confs order by name");
  $num_results = $result->num_rows;
  echo "<p>Select which configuration file you want to make changes to:</p>";
  //echo '<p id="odpoved">'.$o. '</p>';
  echo "<form action=\"chan_conf.php\" method=\"post\">";
  echo   "<table border=\"0\"><tr>";
  echo    "<td>Configuration file: </td><td><select name=\"confile\" class=\"rounded\">";
    for ($i=0; $i <$num_results; $i++)
    {
       $row = $result->fetch_assoc();
  echo '<option value="'.$row['idconf'].'"';
  if ($confile == $row['idconf']) {echo 'selected="selected"';}
  echo ">".$row['name']."</option>";
    }
  echo "</select></td></tr><tr><td></td><td colspan=\"2\"><input type=\"submit\" class=\"rounded\" value=\"Edit!\" maxlength=\"20\" size=\"20\"></td></tr></table></form>";
    ?>
    <br>

<form id="formular" action="chan_conf_save.php" method="post">
  <input type="hidden" name="idconf" value ="<?php echo $confile; ?>">
  <input type="hidden" name="nameconf" value ="<?php echo $meno; ?>">
  <textarea name="config" cols="70" rows="18" class="rounded"><?php echo $content; echo $o;?></textarea><br>
<input id="submit" type="submit" class="rounded" value="Save">
</form>
  </div>
  <div id="pravy">

		 <?php include('add/r_menu.html'); ?>

  </div>
</div>
</body>
</html>