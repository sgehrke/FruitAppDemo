<?php

/*
Name: Shaun Gehrke
Class: SSL 1411
Assignment: DEVELOP Fruit Dadtabase App (ADD-ON)
*/

ini_set('display_errors',0);


// This is where we will call the API and decode the JSON
	// grabs the contents (which is json) of the getfruit.php 
	$contents = file_get_contents("http://localhost:8888/Week3/homework/part2/getfruit.php");
	// decodes the json into an array of usable data
	$encoded = json_decode($contents);
	// runs a loop to find the image path and sets it as a variable to be used later
	foreach($encoded->fruits as $fruit) {
		$rand_fruit = $fruit->fruit_img;
	}
	
	//	setup MySQL database
	$mysql = 'mysql:host=localhost; dbname=ssl';//DSN
	//$db = new PDO($mysql, 'root', 'root');
	//the videos show to always use try/catch
	try {
		$db = new PDO($mysql, 'root', 'root');
		$errorInfo = $db->errorInfo();
		if (isset($errorInfo[2])) {
			$error = $errorInfo[2];
		}
	} catch (PDOException $e) {
		$error = $e->getMessage();
	}
	
	
	// this makes sure that the user submitted the form by checking the request..Alternativley if ($_POST['submit']) but that can send request withut data
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		//Once the condition is met for begin storing the info in variables
		$fruit_name = $_POST['fruit_name'];
		$fruit_color = $_POST['fruit_color'];
		$fruit_img = $_POST['fruit_img'];
		//Added this query to create a condition to check against 
		$query =  "SELECT * 
					FROM fruits 
					WHERE fruit_name = :fruit_name 
					AND fruit_color = :fruit_color";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':fruit_name', $fruit_name);
		$stmt->bindParam(':fruit_color', $fruit_color);
		$stmt->execute();
		$errorInfo = $stmt->errorInfo();
		if (isset($errorInfo[2])) {
			$error = $errorInfo[2];
			echo "<h1 style='color:white;background-color:red'>$error</h1>";
			
		} else {
			$numRows = $stmt->rowCount();
			//echo $numRows;
			
			if ($numRows > 0) {
				$message = '<p class="animated pulse">That fruit has already been entered</p>';
			} else {
			//Take the variables from the user input and place them in an array that will be Inserted to the DB 
			$stmt = $db->prepare("INSERT INTO fruits (fruit_name, fruit_color, fruit_img) VALUES (:fruit_name, :fruit_color, :fruit_img);");
			
			$stmt->bindParam(':fruit_name', $fruit_name);
			$stmt->bindParam(':fruit_color', $fruit_color);
			$stmt->bindParam(':fruit_img', $fruit_img);
			$stmt->execute();
			}
		}
	} 

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Shaun's Fruit App</title>
		<link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/slotstyle.css" type="text/css" media="screen" />
		<script src="js/jquery-2.1.0.min.js" charset="utf-8"></script>
		<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<header>
				<h1 id="logo">Welcome to Shaun's Fruit APP!</h1>
				<form action="fruitads.php" method="POST" accept-charset="utf-8">
					<input id="fruit_name" type="text" name="fruit_name" value="" placeholder="Fruit Name" required>
					<input id="fruit_color" type="text" name="fruit_color" value="" placeholder="Fruit Color" required>
					<input id="fruit_img" type="text" name="fruit_img" value="" placeholder="Paste Fruit Image URL" required>
					<input id="submit" class="button_add" type="submit" name="submit" value="Add">
					<?php
						if (isset($message) && $_POST['submit']) {
						echo $message;
						}
					?>
				</form>
			</header>
			
<!-- dynamically created area for the random fruit -->
			
			<div class="row">
				<div class="col-md-4 machineContainer">
					<div id="machine1" class="slotMachine">
						
						
						<?php $spinFruit = $db->prepare('SELECT fruit_img FROM fruits ORDER BY fruit_id ASC;');
							$spinFruit->execute();
							$result = $spinFruit->fetchAll(PDO::FETCH_ASSOC);
							
							foreach($result as $row) {
							
							echo '
						<div class="slot">
							<img src="' . $row['fruit_img'] . '" width=400/>
						</div>
						<div class="slot ">
							<img src="' . $row['fruit_img'] . '" width=400/>
						</div>
						<div class="slot thisone">
							<img src="' . $rand_fruit . '" width=400/>
						</div>
						<div class="slot ">
							<img src="' . $row['fruit_img']  . '" width=400/>
						</div>
						<div class="slot ">
							<img src="' . $row['fruit_img']  . '" width=400/>
						</div>
						<div class="slot ">
							<img src="' . $row['fruit_img']  . '" width=400/>
						</div>';
						
						} ?>
						
					</div>	
				</div>	
			</div>
			
								
			<div class="inner ">	
				<table>
					<thead>
						<tr>
							<th>Fruit ID</th>
							<th>Fruit Name</th>
							<th>Fruit Color</th>
							<th>Image Website</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<!-- 	This is where the dynamic MySQL database info will populate the HTML  -->
						<?php
							$fruitArray = $db->prepare('SELECT * FROM fruits ORDER BY fruit_id ASC;');
							$fruitArray->execute();
							$result = $fruitArray->fetchAll(PDO::FETCH_ASSOC);
							foreach($result as $row) {
								$img = $row['fruit_img'];
								$imgURL = parse_url($img);
								
								echo 	'
						<tr>
							<td>' .$row['fruit_id'] . '</td>
							<td>' . $row['fruit_name'] . '</td>
							<td>' . $row['fruit_color'] . '</td>
							<td>' . $imgURL['host'] . '</td>
							<td><a class="button_delete" href="delete.php?id=' . $row['fruit_id'] . '">DELETE</a></td>
						</tr>
						';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>	<!-- end wrapper -->
		<footer class="footer">
			<p>Shaun Gehrke |<span><img src="images/logo.png" alt="logo" width="60" height="50"></span>Full Sail University | SSL 1411</p>
		</footer>
		
		
		<script>
				$(document).ready(function(){
					var machine1 = $("#machine1").slotMachine({
						active	: 0,
						delay	: 500
					});
					
					function onComplete(active){
						switch(this.element[0].id){
							case 'machine1':
								$("#machine1Result").text("Index: "+this.active);
								break;
						}
					}
					
					$(window).load(function(){
						
						machine1.shuffle(5, onComplete);
						
					})
				});
			</script>
			<script>
				var topDiv = document.getElementById("wrapper");
				var speed = -5.5; //Use a negative number to make the parrallax go up...positive goes down..bigger the number the slower
				
				window.onscroll = function(){
					var scrollPos = $(window).scrollTop();
					console.log(scrollPos);
					var yOffset = window.pageYOffset;
						
					topDiv.style.backgroundPosition = "0px "+ (yOffset / speed) + "px";
				}
				
				/*
setTimeout(function() {
					$('.row').addClass('animated fadeOut')}, 6000);
			
				
*/
			</script>
			<script>
				$(document).ready(function(){
				
				jQuery.prototype.extend({
				
					
				  headerShrink : function() {
				    
				    var $el = $(this),
				        scrollPsiotion = $(document).scrollTop();
				    
				    if(scrollPsiotion > 10) {
				      
				      $el.addClass('small-header');
				      
				    }
				
				    $(window).on('scroll', function(){
				        
				      if( $(this).scrollTop() <= 10){
				        $el.removeClass('small-header');
				      }
				      else {
				        $el.addClass('small-header');
				      }
				        
				    });
				   
				  }
				  
				}); //end jQuery extend
				  
				  $('header').headerShrink(); 
				  
				}); //end ready  
			</script>
		<script src="js/jquery.slotmachine.js"></script>
	</body>
</html>