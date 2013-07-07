<?php
require('../require/connect.php');

$s=$_GET["s"];
$t=$_GET["t"];

//echo $q;echo $r;
echo $s; echo $t;

  $result = $dat->query("select * from inspectionlevel where IdSupplier = '".$s."' and IdArticle = '".$t."'");
  // Fill up array with names
  $num_results = $result->num_rows;
  if ($num_results > 0) {
    while($row = $result->fetch_assoc())
    {

    echo '<input id ="dodd" TYPE="hidden" VALUE="' . $row['IdItem'] . '"><input id ="artkl" TYPE="hidden" VALUE="' . $row['IdArticle'] . '">';
    echo '<tr><td id="co">Level:</td><td><input type="text" value="' . $row['level'] . '"  name="supplier" readonly /></td><td id="formular_surname_errorloc"></td></tr>';
    echo '<tr><td id="co">Count:</td><td> <input type="text" value="' . $row['count'] . '" name="article" readonly /></td><td id="formular_username_errorloc"></td></tr>';
    echo '<tr><td id="co">Ok:</td><td> <input type="text" value="' . $row['ok'] . '"  name="drawing" readonly /></td><td id="formular_email_errorloc"></td></tr>';
    echo '<tr><td id="co">Rezervovane:</td><td> <input type="text" value="' . $row['ReserUser'] . '"  name="mqs" readonly/></td><td id="formular_email_errorloc"></td></tr>';
    echo '<tr><td id="co">IdInspLev:</td><td> <input type="text" value="' . $row['IdInspLev'] . '"  name="revnr" readonly/></td><td id="formular_email_errorloc"></td></tr>';
    echo '<tr><td></td><td><input style="width:60px;"type="submit" class="rounded" value="Kontrola"></td></tr>';
    echo '<table></form>';
    }
  }
  else {
    echo "nic nenasol";
  }

?>