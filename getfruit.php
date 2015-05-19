<?php
/*
Name: Shaun Gehrke
Class: SSL 1411
Assignment: DEVELOP Fruit Dadtabase App (ADD-ON)
*/	

// This is the GET portion of the assignment that will establish the database connection and Query a result that will be random. Fruitads will GET the contents of this page to display

	$user = 'root';
	$user = 'root';
	//delete database class
	$dbh = new PDO('mysql:host=localhost;dbname=ssl', $user, $user);

	
	$stmt = $dbh->prepare("SELECT fruit_id, fruit_name, fruit_color, fruit_img 
						   FROM fruits
						   ORDER BY RAND()
						   LIMIT 1;");
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$result = array("fruits"=>$result);
	
	
	header("Content-type:application/json");
	//echo print_r($result);
	//encode into json so the fruitads.php page can decode and display on page
	$jsonfile = json_encode($result);
	// echo out results so tehy can be decoded
	echo $jsonfile;
	
	
	
?>