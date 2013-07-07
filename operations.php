<?php
session_start();
 //require('add/check.php');
require('add/body_top.php');
?>
  <div id="stred">
   <p>This page allows you to:</p>
   <ul>
         <li><a href="gen_conf.php">Generate configuration files</a></li>
         <li><a href="chan_conf.php">Make changes to saved configuration files</a></li>
         <li><a href="#">Add configuration file</a></li>
      </ul>
   <p>Basic info before you start:</p>
   <p>Double check values you are about to enter! This way you can avoid possible troubles.</p>
   <p>Thank you.</p>
  </div>
    <?php
require('add/body_btm.php');
 ?>