<?php
 session_start();
 echo '<meta http-equiv="refresh" content="0.1;url=index_logged.php">';
 if(isset($_SESSION['logged'])) {
  header("location:index_logged.php");
  die();
  }
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
	<span id="spanovy">» [<?php echo date('m-d-Y H:i:s', time());?>]<br>» please, log in<div class="cursor"> </div></span><code>
<?php
  if (!isset($_GET["var"])) { $var="";} else {$var=$_GET["var"];}
  echo $var;
  echo "<br>";
?>
</code>
  <div id="login">


    <?php

    if (isset($_POST['meno'])) {
      $username = $_POST['meno'];
    echo '» login as: '.$username.'<br>';
    echo '<form id="formular" action="authentication.php" method="post"><input TYPE="hidden" name="meno" VALUE="' . $username . '">» heslo: <input type="password" class="login" name="heslo" maxlength="32" size="20" /></form>';

    }
    else {
      echo '<form id="formular" action="index.php" method="post">» login as: <input type="text" class="login" name="meno" maxlength="20" size="20" autocomplete="off"/><td colspan="2"><input id="submit" type="submit" class="login" value=""></form>';
    }
    ?>
  </div>
  <div id="stred" style="border-bottom:none;"></div>
  <div id="pravy" style="border-bottom:none;"></div>
</div>
</body>
</html>