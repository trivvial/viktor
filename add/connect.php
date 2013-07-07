 <?php
 $dat = new mysqli('localhost','root','','kristian');
 if ($dat->connect_errno) {
    $stat = "Connect to database failed. Contact system administrator.";
}
 ?>