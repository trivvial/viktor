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
         <li style="border-bottom: none;border-left: 1px solid #FF9900;
border-top: 1px solid #FF9900;border-right: 1px solid #FF9900;"><a href="gen_conf.php" style="color:#FF9900;">Generate</a></li>
         <li ><a href="chan_conf.php">Configuration files</a></li>
         <li><a href="#">Add configuration file</a></li>
      </ul>
   </div>

   <?php
   if (isset($_GET["o"])) {$o=$dat->real_escape_string(stripslashes($_GET["o"]));} else {$o="";}

 // $result = $dat->query("select * from machines order by name");
 // $num_results = $result->num_rows;
echo "<p>Here you can generate configuration file for listed machines.</p>";
 echo "<p>Select for which machine you want to generate configuration file:</p>";
// echo '<p id="odpoved">'.$o. '</p>';
// echo "<form action=\"gen_conf_save.php\" method=\"post\">";
// echo   "<table border=\"0\"><tr>";
// echo    "<td>Generate for: </td><td><select name=\"gen\" class=\"rounded\">";
//   for ($i=0; $i <$num_results; $i++)
//   {
//      $row = $result->fetch_assoc();
//      $mac = addSepare($row['mac']);
// echo "<option value=".$row['idmachine'].">".$row['name']." - ".$mac."</option>";
//   }
// echo "</select></td></tr><tr><td></td><td colspan=\"2\"><input type=\"submit\" class=\"rounded\" value=\"Generate!\" maxlength=\"20\" size=\"20\"></td></tr></table></form>";
    ?>

<div id="tabule">
<table id="hor-minimalist-b"  >
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">MAC</th>
      <th scope="col">IP</th>
      <th scope="col">OS</th>
      <th scope="col">Lang</th>
      <th scope="col">Bundle</th>
      <th scope="col">Gen</th>
    </tr>
  </thead>
  <tbody>
  <?php
/*generovanie tabulky s polozkami*/
$result = $dat->query("select machines.idmachine, machines.name, machines.mac, machines.ip, os.name as os, bundle.name as bundle, lang.language from machines, os, bundle, lang where machines.os=os.idos and machines.bundle=bundle.idbundle and os.lang=lang.idlang order by idmachine");
$num_results = $result->num_rows;
$nIndex = 0;
for ($i=0; $i <$num_results; $i++)

  { $row = $result->fetch_assoc();
    $mac = addSepare($row['mac']);

    echo "<tr>";
    echo "<td>".$row['idmachine']."</td>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$mac."</td>";
    echo "<td>".$row['ip']."</td>";
    echo "<td>".$row['os']."</td>";
    echo "<td>".$row['language']."</td>";
    echo "<td>".$row['bundle']."</td>";
    echo "<form ACTION=\"gen_conf_save.php\" METHOD=\"post\">";
    echo "<input TYPE=hidden NAME=\"gen\" VALUE =\"".$row['idmachine']."\">";
    echo "<td><input type=\"image\" src=images/config.png></td>";
    echo "</form>";
    // echo "<form ACTION=\"del.php\" METHOD=\"post\">";
    // echo "<input TYPE=hidden NAME=\"del\" VALUE =\"".$row['idmachine']."\">";
    // echo "<td><input type=\"image\" src=images/delete.png></td>";
    // echo "</form>";
    echo "</tr>";
    $nIndex++;
  }
?>
  </tbody>
</table>
<?php echo '<p id="odpoved">'.$o. '</p>'; $dat->close(); ?>
</div>

  </div>

  <div id="pravy">

		 <?php include('add/r_menu.html'); ?>

  </div>
</div>
</body>
</html>