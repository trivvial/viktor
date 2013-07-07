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
         <li><a href="creai.php" id="Create">Add software</a></li>
         <li style="border-bottom: none;border-left: 1px solid #FF9900;
border-top: 1px solid #FF9900;border-right: 1px solid #FF9900;"><a href="editi.php" id="Edit" style="color:#FF9900;">Edit software</a></li>
         <li><a href="deletei.php" id="Delete">Delete software</a></li>
      </ul>
   </div>

    <?php

/*tento if: ak user je superadmin umozni upravovat uzivatelov*/
//if($_SESSION['edit'] == 1) {
 $result = $dat->query("select * from programs order by idprogram");
 $num_results = $result->num_rows;
echo "<p>Select software you want to edit:</p>";
echo "<form action=\"creai.php\" method=\"post\">";
echo   "<table border=\"0\"><tr>";
echo    "<td width=\"90\">Software</td><td><select name=\"e\" class=\"rounded\">";
  for ($i=0; $i <$num_results; $i++)
  {
     $row = $result->fetch_assoc();
echo "<option value=".$row['idprogram'].">".$row['program']."</option>";
  }
echo "</select></td></tr><tr><td></td><td colspan=\"2\"><input style=\"width:50px;\" type=\"submit\" class=\"rounded\" value=\"Edit!\" maxlength=\"20\" size=\"20\"></td></tr></table></form>";
// }
// else {
//   echo "<h2>Váš administrátorský účet nemá oprávnenie upravovať užívateľské účty!</h2>";
// }
    ?>

  </div>
  <div id="pravy">

		 <?php include('add/r_menu.html'); ?>

  </div>
</div>
</body>
</html>