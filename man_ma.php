<?php
session_start();
 //require('add/check.php');
require('add/connect.php');
require('add/functions.php');
require('add/body_top.php');

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

  <div id="stred">
   <p>This page allows you add, edit or delete a machine from database</p>
   <p>List of all stored machines:</p>
    <?php echo '<p id="odpoved">'.$o. '</p>';?>

<div id="tabule">
<table id="hor-minimalist-b"  >
  <thead >
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">MAC</th>
      <th scope="col">IP</th>
      <th scope="col">OS - Lang</th>
      <!-- <th scope="col" style="width:30px;">Lang</th> -->
      <th scope="col">Bundle</th>
      <th scope="col">Edit</th>
      <th scope="col">Del</th>
      <th scope="col">Gen</th>
    </tr>
  </thead>
  <tbody>
  <?php
/*generovanie tabulky s polozkami*/
$result = $dat->query("select machines.idmachine, machines.name, machines.mac, machines.ip, os.name as os, bundle.name as bundle, lang.language from machines, os, bundle, lang where machines.os=os.idos and machines.bundle=bundle.idbundle and os.lang=lang.idlang order by idmachine");
$num_results = $result->num_rows;
$nIndex = 0;

for ($x=0; $x <$num_results; $x++)

  { $row = $result->fetch_assoc();
    $mac = addSepare($row['mac']);

    echo "<tr>";
    echo "<td>".$row['idmachine']."</td>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$mac."</td>";
    echo "<td>".$row['ip']."</td>";
    echo "<td>".$row['os']." - ".$row['language']."</td>";
    //echo "<td>".$row['language']."</td>";
    echo "<td>".$row['bundle']."</td>";
    echo "<form ACTION=\"man_ma.php\" METHOD=\"post\">";
    //echo "<input TYPE=hidden NAME=\"e\" VALUE =\"".$row['idmachine']."\">";
    echo "<td><button type=\"submit\" name=\"e\" value=\"".$row['idmachine']."\"><img src=\"images/ceruzka16x15.png\" alt=\"edit\"></button></td>";
    //echo "<td><input type=\"image\" src=images/ceruzka16x15.png></td>";
    echo "</form>";
    echo "<form ACTION=\"del.php\" METHOD=\"post\">";
    //echo "<input TYPE=hidden NAME=\"del\" VALUE =\"".$row['idmachine']."\">";
    echo "<td><button type=\"submit\" name=\"del\" value=\"".$row['idmachine']."\"><img src=\"images/delete.png\" alt=\"delete\"></button></td>";
    //echo "<td><input type=\"image\" src=images/delete.png></td>";
    echo "</form>";
    echo "<form ACTION=\"gen_conf_save.php\" METHOD=\"post\">";
    //echo "<input TYPE=hidden NAME=\"gen\" VALUE =\"".$row['idmachine']."\">";
    echo "<td><button type=\"submit\" name=\"gen\" value=\"".$row['idmachine']."\"><img src=\"images/config.png\" alt=\"generate\"></button></td>";
    //echo "<td><input type=\"image\" src=images/config.png></td>";
    echo "</form>";
    echo "</tr>";
    $nIndex++;
  }
?>
  </tbody>
</table>
</div>
  <p>Add new machine:</p>
  <div id="tabule">
    <table id="hor-minimalist-b">
      <tr>
        <form id="formular" action="crea_save.php" method="post">
        <?php if (isset($_POST["e"])) {
          echo '<input TYPE="hidden" VALUE="'.$e.'" name="update">';
         } ?>
        <td>
          <input name="name" value="<?php echo $n;?>" maxlength="20" size="12" TYPE="text" placeholder="Name">
        </td>
        <td>
          <input name="mac" value="<?php echo $m;?>" maxlength="17" size="20" TYPE="text" placeholder="MAC">
        </td>
        <td>
          <input name="ip" value="<?php echo $i;?>" maxlength="15" size="18" placeholder="IP">
        </td>
        <td>
          <?php
        $os = $dat->query("select os.idos, os.name, lang.language from os, lang where os.lang=lang.idlang");
        $num_results = $os->num_rows;
        echo    "<select name=\"os\">";
        for ($i=0; $i <$num_results; $i++) {
          $row1 = $os->fetch_assoc();
          echo '<option value="'.$row1['idos'].'"';
          if ($row1['name'] == $l) { echo ' selected="selected"';}
          echo '>'.$row1['name'].' - '.$row1['language'].'</option>';
        }
        ?>
        </td>
        <td>
          <?php
        $bundle = $dat->query("select * from bundle");
        $num_results = $bundle->num_rows;
        echo    "<select name=\"bundle\">";
        for ($i=0; $i <$num_results; $i++) {
          $row3 = $bundle->fetch_assoc();
          echo '<option value="'.$row3['idbundle'].'"';
          if ($row3['name'] == $q) { echo ' selected="selected"';}
          echo '>'.$row3['name'].'</option>';
        }
        $dat->close();
        ?>
        </td>
        <td>
          <button type="submit" name="gen" value=".$row['idmachine']."><img src="images/tick.png" alt="save"></button>
        </td>
        </form>
      </tr>
    </table>
  </div>
  <?php
  if (isset($_POST["e"])) {
    echo '<br><a href="man_ma.php" id="odpoved">&lt;&lt;cancel&gt;&gt;</a>';} else {$e="";}
  ?>
</div>
  <?php
require('add/body_btm.php');
 ?>