<?php
session_start();
 //require('add/check.php');
require('add/connect.php');
require('add/functions.php');
require('add/body_top.php');
?>
  <div id="stred">
<?php
//require('add/menu.php');
?>
   <p>This page allows you add, edit or delete a software from database</p>
   <p>List of all stored softwares:</p>
<div id="tabule">
<table id="hor-minimalist-b"  >
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Install Path</th>
      <th scope="col">Edit</th>
      <th scope="col">Del</th>
    </tr>
  </thead>
  <tbody>
  <?php
/*generovanie tabulky s polozkami*/
$result = $dat->query("select * from programs order by idprogram");
$num_results = $result->num_rows;
$nIndex = 0;
for ($i=0; $i <$num_results; $i++)

  { $row = $result->fetch_assoc();
    echo "<tr>";
    echo "<td>".$row['idprogram']."</td>";
    echo "<td>".$row['program']."</td>";
    echo "<td>".$row['installpath']."</td>";
    echo "<form ACTION=\"creai.php\" METHOD=\"post\">";
    echo "<input TYPE=hidden NAME=\"e\" VALUE =\"".$row['idprogram']."\">";
    echo "<td><input type=\"image\" src=images/ceruzka16x15.png></td>";
    echo "</form>";
    echo "<form ACTION=\"deli.php\" METHOD=\"post\">";
    echo "<input TYPE=hidden NAME=\"del\" VALUE =\"".$row['idprogram']."\">";
    echo "<td><input type=\"image\" src=images/delete.png></td>";
    echo "</form>";
    echo "</tr>";
    $nIndex++;
  }

$dat->close();
?>
        </tbody>
      </table>
    </div>
  </div>
    <?php
require('add/body_btm.php');
 ?>