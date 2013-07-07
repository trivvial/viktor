<?php
require('connect.php');

	if(!$dat) {
		echo 'Could not connect to the database.';
	} else {

		if(isset($_POST['queryString'])) {
			$queryString = $dat->real_escape_string($_POST['queryString']);

			if(strlen($queryString) >0) {

				/*$query = $dat->query("select IdArticle, Item from articles, items where articles.IdItem=items.IdItem  AND Item LIKE '$queryString%' order by Item LIMIT 10");*/
				$query = $dat->query("select IdArticle, concat(IdArticle, ' » ', Item) as Item from articles, items where articles.IdItem=items.IdItem and concat(IdArticle, ' » ', Item) like '%$queryString%' LIMIT 30");
				if($query) {
					while ($result = $query ->fetch_object()) {

	         			/*echo '<p onClick="fill2(\''.addslashes($result->IdArticle.' » '.$result->Item).'\','.$result->IdArticle.');">'.$result->IdArticle.' » '.$result->Item.'</p>';*/

	         			echo '<p onClick="fill2(\''.addslashes($result->Item).'\','.$result->IdArticle.');">'.$result->Item.'</p>';
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