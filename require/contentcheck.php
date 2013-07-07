<?php
if ($_SESSION['typ'] === "1"){
if ($_SESSION['edit'] === "1")
	 {include('editadmincontent.html');}
else {include('admincontent.html');}}
else {include('usercontent.html');}
?>