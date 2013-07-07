<?php
session_start();
 //require('add/check.php');
require('add/connect.php');
require('add/functions.php');
require('add/body_top.php');
if (isset($_GET["o"])) {$o=$dat->real_escape_string(stripslashes($_GET["o"]));} else {$o="";}
?>
  <div id="stred">
   <p>This page allows you add, edit or delete a machine from database</p>
   <p>List of all stored machines:</p>
    <?php echo '<p id="odpoved">'.$o. '</p>';?>


<div id="tabule1">
<table id="hor-minimalist-b"  >
  <thead>
    <tr>
      <th scope="col" style="width:4%;">ID</th>
      <th scope="col" style="width:17%;">Name</th>
      <th scope="col" style="width:18%;">MAC</th>
      <th scope="col" style="width:16%;">IP</th>
      <th scope="col" style="width:18%;">OS - Lang</th>
      <!-- <th scope="col" style="width:30px;">Lang</th> -->
      <th scope="col" style="width:15%;">Bundle</th>
      <th scope="col" style="width:27px;">Edit</th>
      <th scope="col" style="width:22px;">Del</th>
      <th scope="col" style="width:28px;">Gen</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>
</div>


<div id="tabule">
<table id="hor-minimalist-b"  >
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
    echo "<td style=\"width:4%;\">".$row['idmachine']."</td>";
    echo "<td style=\"width:17%;\">".$row['name']."</td>";
    echo "<td style=\"width:18%;\">".$mac."</td>";
    echo "<td style=\"width:16%;\">".$row['ip']."</td>";
    echo "<td style=\"width:18%;\">".$row['os']." - ".$row['language']."</td>";
    //echo "<td>".$row['language']."</td>";
    echo "<td style=\"width:15%;\">".$row['bundle']."</td>";
    echo "<form ACTION=\"crea.php\" METHOD=\"post\">";
    echo "<input TYPE=hidden NAME=\"e\" VALUE =\"".$row['idmachine']."\">";
    echo "<td style=\"width:27px;\"><input type=\"image\" src=images/ceruzka16x15.png></td>";
    echo "</form>";
    echo "<form ACTION=\"del.php\" METHOD=\"post\">";
    echo "<input TYPE=hidden NAME=\"del\" VALUE =\"".$row['idmachine']."\">";
    echo "<td style=\"width:22px;\"><input type=\"image\" src=images/delete.png></td>";
    echo "</form>";
    echo "<form ACTION=\"gen_conf_save.php\" METHOD=\"post\">";
    echo "<input TYPE=hidden NAME=\"gen\" VALUE =\"".$row['idmachine']."\">";
    echo "<td style=\"width:28px;\"><input type=\"image\" src=images/config.png></td>";
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