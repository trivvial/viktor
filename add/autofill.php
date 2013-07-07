<?php
require('../require/connect.php');
$s="";$t="";$q="";$r=""; $prem=""; $prem2="";

if (!isset($_GET["q"])) { $q="";$r=""; } else { $q=$_GET["q"];$r=$_GET["r"]; }
if (!isset($_GET["s"])) { $s="";$t=""; } else { $s=$_GET["s"];$t=$_GET["t"]; }

/*
$q= 47465-00 » 01200.100.100
$r= DANUBIA-METALLKONTOR AB
$s= id supplier e.g. 1 , 2
$t= id article e.g.  47465-00
*/

if ($s == "") {
  if ($r && $q) {
    $eu=explode("»", $q);
    $result = $dat->query("select articles.IdItem,IdArticle,Drawing,MQS,RevNumber, Item from articles,items where articles.IdItem=items.IdItem  and IdArticle = '".$eu[0]."'");
    $result2 = $dat->query("select * from suppliers where Supplier = '". $r . "'");
    $ves = $result2->fetch_assoc();
    $num_results_ves = $result2->num_rows;
    if ($num_results_ves > 0) {$prem = $ves['IdSupplier']; $prem2 = $ves['Supplier'];} else {$prem = $r; $prem2 = $r;}
    // Fill up array with names
    $num_results = $result->num_rows;
    if ($num_results > 0) {
      while($row = $result->fetch_assoc())
      {
        echo '<form>';
        echo '<table>';
        echo '<input id ="dodd" TYPE="hidden" VALUE="' . $prem . '"><input id ="artkl" TYPE="hidden" VALUE="' . $row['IdArticle'] . '">';
        echo '<tr><td id="co">Dodávateľ:</td><td><input type="text" value="' . $prem2 . '"  name="supplier" readonly /></td><td id="formular_surname_errorloc"></td></tr>';
        echo '<tr><td id="co">Artikel:</td><td> <input type="text" value="' . $row['IdArticle'] . ' &raquo; ' . $row['Item'] . '" name="article" readonly /></td><td id="formular_username_errorloc"></td></tr>';
        echo '<tr><td id="co">Výkres:</td><td> <input type="text" value="' . $row['Drawing'] . '"  name="drawing" readonly /></td><td id="formular_email_errorloc"></td></tr>';
        echo '<tr><td id="co">MQS:</td><td> <input type="text" value="' . $row['MQS'] . '"  name="mqs" readonly/></td><td id="formular_email_errorloc"></td></tr>';
        echo '<tr><td id="co">Level:</td><td> <input type="text" value="' . $row['RevNumber'] . '"  name="revnr" readonly/></td><td id="formular_email_errorloc"></td></tr>';
       // echo '<tr><td></td><td><input style="width:60px;" type="submit" name="but" class="rounded" value="Kontrola" onclick="grabInfo2(this.value);return false;" /></td></tr>';
        echo '<tr><td></td><td><input style="width:60px;" type="submit" name="but" class="rounded" value="Kontrola" onclick="setInput(this);grabInfo2(this.value);return false;" /></td></tr>';

        echo '<table>';
        echo '</form>';
      }
    }
    else {
      unset($result);
      //<select name="artrv" onchange="doSomething2(value); grabInfo(this.value);">
       $result = $dat->query("select * from items order by Item");
       $num_results = $result->num_rows;

       echo '<form id="formular" action="insp.php" method="post" autocomplete="off"><input id ="" TYPE="hidden" NAME="novyart" VALUE="">';
        echo '<table>';
        echo '<tr><td id="co">Artikel č.:</td><td><input style="border: 1px solid #ccc; margin-left:10px;" type"text" name="artikel" value="' . $q . '"></td></tr>';
        echo '<tr><td id="co">Revízia č.:</td><td><input style="border: 1px solid #ccc; margin-left:10px;" type"text" name="revc" value=""></td></tr>';
        echo '<tr><td id="co">Položka:</td><td><input style="border: 1px solid #ccc; margin-left:10px;" type"text" name="polozka" value="" placeholder="Nová">alebo</td><td><select name="polozkab" style="border: 1px solid #CCC; -webkit-border-radius: 5px; font-size: 12px;padding: 0px 1px;"><option value="" label="Existujúca"></option>';
        for ($i=0; $i <$num_results; $i++){
              $row = $result->fetch_assoc();
        echo '<option style="border: 1px solid #ccc; margin-left:10px;" value="'.$row['IdItem'].'">'.$row['Item'].'</option>';}
        echo '</select></td></tr>';
        echo '<tr><td id="co">Výkres:</td><td><input style="border: 1px solid #ccc; margin-left:10px;" type"text" name="vykres" value=""></td></tr>';
        echo '<tr><td id="co">MQS:</td><td><input style="border: 1px solid #ccc; margin-left:10px;" type"text" name="mqs" value=""></td>';
        echo '<td><input style="width:50px; margin-left:10px;"type="submit" class="rounded" value="Ulož!"></td></tr>';
        echo '<table>';
        echo '</form>';
    }
  }
}

else {
  $result = $dat->query("select * from inspectionlevel where IdSupplier = '".$s."' and IdArticle = '".$t."'");
  /*$result2 = $dat->query("select * from suppliers where Supplier = '". $s . "'");
  $ves = $result2->fetch_assoc();*/
  // Fill up array with names
  $num_results = $result->num_rows;

  if ($num_results == 0) {
    $result2 = $dat->query("SELECT EXISTS(SELECT 1 FROM suppliers WHERE IdSupplier = '". $s ."') AS VYSLEDOK");
    $row = $result2->fetch_assoc();$vysl = $row['VYSLEDOK'];
    if ($vysl == 0) {
      $dat->query("insert into suppliers values ('','".$s."')");
      $result3 = $dat->query("select * from suppliers where Supplier = '".$s."'");
      $row = $result3->fetch_assoc();
      //$dat->query("insert into inspectionlevel values ('','".$row['IdSupplier']."','".$t."','3','0','0','')");
      //$Addpolozka = $row['IdItem'];

      echo '<form id="formular" action="insp.php" method="post" autocomplete="off">';
      echo '<table>';
      echo '<input id ="iddod" TYPE="hidden" VALUE="' . $row['IdSupplier'] . '"><input id ="artkl" TYPE="hidden" VALUE="' . $t . '"><input TYPE="hidden" NAME="artadd" VALUE="">';
      echo '<tr><td id="co">Level:</td><td><input type="text" value="3"  name="supplier" readonly /></td><td id="co">ResultInspOK</td><td><input type="radio" value="1"  name="supplier" readonly /><td id="formular_surname_errorloc"></td></tr>';
      echo '<tr><td id="co">Count:</td><td> <input type="text" value="0" name="article" readonly /></td><td id="co">ResultInspFail</td><td><input type="radio" value="-1"  name="supplier" readonly /><td id="formular_username_errorloc"></td></tr>';
      echo '<tr><td id="co">Ok:</td><td> <input type="text" value="0"  name="drawing" readonly /></td><td id="formular_email_errorloc"></td></tr>';
      echo '<tr><td id="co">Rezervované:</td><td> <input type="text" value="Nie"  name="mqs" readonly/></td><td id="formular_email_errorloc"></td></tr>';
      echo '<tr><td id="co">Inšpekcia:</td><td> <span id="w">Áno</span></td><td id="formular_email_errorloc"></td></tr>';
      echo '<tr><td></td><td></td><td></td><td><input style="width:60px;" type="submit" class="rounded" value="Ulož!" /></td></tr>';
      echo '<table>';
      echo'</form>';

    }

    else {
//prerobit v pripade,ze dodavatel existuje

      //echo '<form id="formular" action="#" method="post" autocomplete="off"><table>';
      echo'<table>';
      echo '<input id ="iddod" TYPE="hidden" VALUE="' . $s . '"><input id ="idartkl" TYPE="hidden" VALUE="' . $t . '">';
      echo '<tr><td id="co">Level:</td><td><input type="text" value="3"  name="supplier" readonly /></td><td id="co">ResultInspOK</td><td><input type="radio" value="1"  name="supplier" readonly /><td id="formular_surname_errorloc"></td></tr>';
      echo '<tr><td id="co">Count:</td><td> <input type="text" value="0" name="article" readonly /></td><td id="co">ResultInspFail</td><td><input type="radio" value="-1"  name="supplier" readonly /><td id="formular_username_errorloc"></td></tr>';
      echo '<tr><td id="co">Ok:</td><td> <input type="text" value="0"  name="drawing" readonly /></td><td id="formular_email_errorloc"></td></tr>';
      echo '<tr><td id="co">Rezervované:</td><td> <input type="text" value="Nie"  name="mqs" readonly/></td><td id="formular_email_errorloc"></td></tr>';
      echo '<tr><td id="co">Inšpekcia:</td><td> <input type="text" value="Nepriradené"  name="revnr" readonly/></td><td id="formular_email_errorloc"></td></tr>';
      echo '<tr><td></td><td></td><td></td><td><input style="width:60px;" type="submit" class="rounded" value="Ulož!" /></td></tr>';
      echo '<table>';
      echo '</form>';
    }
  }

  if ($num_results > 0) {
    while($row = $result->fetch_assoc())
    {

      echo '<form id="formular" action="insp.php" method="post" autocomplete="off"><table>';
      //echo '<input id ="dodd" TYPE="hidden" VALUE="' . $ves['IdSupplier'] . '"><input id ="artkl" TYPE="hidden" VALUE="' . $row['IdArticle'] . '">';
      echo '<tr><td id="co">Level:</td><td><input type="text" value="' . $row['level'] . '"  name="supplier" readonly /></td><td id="formular_surname_errorloc"></td></tr>';
      echo '<tr><td id="co">Count:</td><td> <input type="text" value="' . $row['count'] . '" name="article" readonly /></td><td id="formular_username_errorloc"></td></tr>';
      echo '<tr><td id="co">Ok:</td><td> <input type="text" value="' . $row['ok'] . '"  name="drawing" readonly /></td><td id="formular_email_errorloc"></td></tr>';
      echo '<tr><td id="co">Rezervovane:</td><td> <input type="text" value="' . $row['ReserUser'] . '"  name="mqs" readonly/></td><td id="formular_email_errorloc"></td></tr>';
      echo '<tr><td id="co">IdInspLev:</td><td> <input type="text" value="' . $row['IdInspLev'] . '"  name="revnr" readonly/></td><td id="formular_email_errorloc"></td></tr>';
      echo '<tr><td></td><td></td><td></td><td><input style="width:60px;" type="submit" class="rounded" value="Ulož!" /></td></tr>';
      echo '<table></form>';
    }
  }
  else {
  /*  echo "tu pride tabulka<br> pre neexistujuci zaznam";

    $existcheck = $dat->query("select supplier from suppliers where Supplier = '".$AddSupplier."'");
    $num_results = $existcheck->num_rows;
    if ($num_results == 0) {
      $result = $dat->query("insert into suppliers values ('','$AddSupplier')");
      unset($result);
      $odpoveda = "<td id=\"logusr\">Pridaný!</td>";
    }
    else {
        $odpoveda = "<td id=\"logusr\">Existuje!</td>";
    }*/
  }
}

?>