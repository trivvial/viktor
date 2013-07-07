<?php
session_start();
 //require('add/check.php');
require('add/connect.php');
require('add/body_top.php');
?>
  <div id="stred">
   <p>Here you can make changes to saved software bundles</p>
   <p>List of all stored bundles:</p>
<?php
   if (isset($_GET["o"])) {$o=$dat->real_escape_string(stripslashes($_GET["o"]));} else {$o="";}
   if (isset($_POST['idbundle'])) {
    $IDBundle = $_POST['idbundle'];
    $BundleName = $_POST['namebundle'];
    $kveri = $dat->query("SELECT programs.idprogram, programs.program, bundle.idbundle, bundle.name, IFNULL( combo.cidprogram, 0 ) as je FROM programs CROSS JOIN bundle LEFT JOIN combo ON combo.cidprogram = programs.idprogram AND combo.cidbundle = bundle.idbundle WHERE bundle.idbundle = '".$IDBundle."' ORDER BY programs.idprogram ASC");
    $pocet = $kveri->num_rows;

    echo "<p id=\"odpoved\">You are editing bundle: <code>".$BundleName."</code></p>";
    echo "<form action=\"man_soft_save.php\" method=\"post\">";
    echo '<input TYPE="hidden" VALUE="'.$pocet.'" name="cnt">';
    echo '<input TYPE="hidden" VALUE="'.$IDBundle.'" name="idbund">';
    echo '<input TYPE="hidden" VALUE="'.$BundleName.'" name="namebundle">';
    //echo   "<table border=\"0\">";
    echo '<div class="boxes"><div class="row"><div class="span2">';
    for ($i=1; $i < $pocet+1; $i++) {
      $row = $kveri->fetch_assoc();

      echo '<label class="checkbox"><input type="checkbox" class="chkb" name="prog[]" value="'.$row['idprogram'].'"';
      if ($row['je']==0) {} else {echo 'checked="checked"';}
      echo '>'.$row['program'].'</label><br>';
      $prem = ($i % 4 == 0) ? '</div><div class="span2">' : '';
      echo $prem;
    }
    echo '</div></div></div>';
    echo "<input style=\"width:60px;\" type=\"submit\" class=\"rounded\" value=\"Save\" maxlength=\"20\" size=\"20\"></form>";
    //echo "<tr><td></td><td colspan=\"2\"><input style=\"width:60px;\" type=\"submit\" class=\"rounded\" value=\"Save\" maxlength=\"20\" size=\"20\"></td></tr></table></form>";
   }
   else {
    echo '<div id="tabule">';
    echo '<table id="hor-minimalist-b"  >';
    echo   '<thead>';
    echo     '<tr>';
    echo       '<th scope="col">ID</th>';
    echo       '<th scope="col">Bundle Name</th>';
    echo       '<th scope="col"># of soft.</th>';
    echo       '<th scope="col">Edit</th>';
    echo       '<th scope="col">Del</th>';
    echo     '</tr>';
    echo   '</thead>';
    echo   '<tbody>';

    /*generovanie tabulky s polozkami*/

    $result = $dat->query("select * from bundle order by idbundle");
    $num_results = $result->num_rows;
    $nIndex = 0;
    for ($i=0; $i <$num_results; $i++) {

        $row = $result->fetch_assoc();

        $kount = $dat->query("SELECT count(*) as pocet FROM combo WHERE cidbundle ='".$row['idbundle']."'");
        $pocet = $kount->fetch_object();

        echo "<tr>";
        echo "<td>".$row['idbundle']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$pocet->pocet."</td>";
        echo "<form ACTION=\"#\" METHOD=\"post\">";
        echo "<input TYPE=hidden NAME=\"idbundle\" VALUE =\"".$row['idbundle']."\">";
        echo "<input TYPE=hidden NAME=\"namebundle\" VALUE =\"".$row['name']."\">";
        echo "<td><input type=\"image\" src=images/ceruzka16x15.png></td>";
        echo "</form>";
        echo "<form ACTION=\"#\" METHOD=\"post\">";
        echo "<input TYPE=hidden NAME=\"del\" VALUE =\"".$row['idbundle']."\">";
        echo "<td><input type=\"image\" src=images/delete.png></td>";
        echo "</form>";
        echo "</tr>";
        $nIndex++;
      }

    $dat->close();
    echo   '</tbody>';
    echo '</table>';
    echo '<p id="odpoved">'.$o.'</p>';
    echo '</div>';
    //echo $o;

  }
    ?>

 <!--    <div class="boxes">
<div class="row">
<div class="span2">
  <label class="checkbox">
    <input type="checkbox" name="optionsCheckboxList1" value="option1">
    Option one
  </label>
  <label class="checkbox">
    <input type="checkbox" name="optionsCheckboxList2" value="option2">
    Option two
  </label>
  <label class="checkbox">
    <input type="checkbox" name="optionsCheckboxList3" value="option3">
    Option three
  </label>
    <label class="checkbox">
    <input type="checkbox" name="optionsCheckboxList3" value="option3">
    Option three
  </label>
    <label class="checkbox">
    <input type="checkbox" name="optionsCheckboxList3" value="option3">
    Option three
  </label>
</div>
    <div class="span2">
  <label class="checkbox">
    <input type="checkbox" name="optionsCheckboxList1" value="option1">
    Option one
  </label>
  <label class="checkbox">
    <input type="checkbox" name="optionsCheckboxList2" value="option2">
    Option two
  </label>
  <label class="checkbox">
    <input type="checkbox" name="optionsCheckboxList3" value="option3">
    Option three
  </label>
        <label class="checkbox">
    <input type="checkbox" name="optionsCheckboxList3" value="option3">
    Option three
  </label>
        <label class="checkbox">
    <input type="checkbox" name="optionsCheckboxList3" value="option3">
    Option three
  </label>
</div>
</div>
</div> -->
  </div>
<?php
require('add/body_btm.php');
 ?>