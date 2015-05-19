<?php
/*
Name: Shaun Gehrke
Class: SSL 1411
Assignment: ANALYYZE, DESIGN! Fruit Dadtabase App
*/
	
	$user = 'root';
	$user = 'root';
	//delete database class
	$deldb = new PDO('mysql:host=localhost;dbname=ssl', $user, $user);
	//grabs the id of item selected
	$fruit_id = $_GET['id'];
	
	$fruitArray = $deldb->prepare("DELETE FROM fruits where fruit_id IN (:fruit_id);");
	
	$fruitArray->bindParam(':fruit_id',  $fruit_id);
	$fruitArray->execute();
	header('Location: fruitads.php');
	die();
?>