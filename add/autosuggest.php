<?php
require('connect.php');

	if(!$dat) {
		echo 'Could not connect to the database.';
	} else {

		if(isset($_POST['queryString'])) {
			$queryString = $dat->real_escape_string($_POST['queryString']);

			if(strlen($queryString) >0) {

				$query = $dat->query("SELECT * FROM suppliers WHERE Supplier LIKE '$queryString%' LIMIT 10");
				if($query) {
					while ($result = $query ->fetch_object()) {
	         			echo '<p onClick="fill(\''.addslashes($result->Supplier).'\','.$result->IdSupplier.');">'.$result->Supplier.'</p>';
	         		}
				} else {
					echo 'SQL query failed!';
				}
			} else {
				// do nothing
			}
		} else {
			echo '<p>There should be no direct access to this script!</p></br><a href="../index.php">Back</a>';
		}
	}
?>