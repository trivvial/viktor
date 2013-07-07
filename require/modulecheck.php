<?php
if ($_SESSION['typ'] === "1"){
if ($_SESSION['edit'] === "1")
	 {include('editadminmodule.html');}
else {include('adminmodule.html');}}
else {include('usermodule.html');}
?>