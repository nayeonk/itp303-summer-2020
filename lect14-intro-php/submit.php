<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Intro to PHP</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Intro to PHP</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
		<div class="row">

			<h2 class="col-12 mt-4 mb-3">PHP Output</h2>

<div class="col-12">
	<!-- Display Test Output Here -->
	<?php 
		// PHP code in here
		echo "<strong>Hello World!</strong>";
		echo "<hr>";

		// Variables
		$name = "Tommy";
		$age = 18;

		// Error checking to ensure a variable exists
		if (isset($name) && !empty($name)){
			echo $name;
		}
 		else {
 			echo "No name!";
 		}

 		echo "<hr>";
 		// quick way to view variables - it also tells u its data type
 		var_dump($name);

 		// Concatenation - use periods in PHP
 		echo "<hr>";
 		echo "My name is " . $name;
 		// With double quotes can utilize variable interpolation 
 		echo "<hr>";
 		echo "My name is $name";

 		// However, single quotes display everythign as is
 		echo "<hr>";
 		echo 'My name is $name';

 		echo "<hr>";
 		// Set a timezone
 		date_default_timezone_set("America/Los_Angeles");
 		// Formatting day & time w/ date()
 		echo date("m/d/y H:i:s T");

 		echo "<hr>";
 		// Index based arrays
 		$colors = ["red", "blue", "green"];
 		echo $colors[0];
 		echo "<hr>";
 		// Can interate through arrays using for loop like any other language
 		for($i = 0; $i<sizeof($colors); $i++) {
 			echo "<hr>";
 			echo $colors[$i];
 		}

 		// PHP loves associative arrays. Assoc arrays are like a regular array but have String keys intead of integers.
 		$courses = [
 			"ITP 303" => "Full-Stack Web Development",
 			"ITP 104" => "Web Publishing",
 			"ITP 404" => "Advanced Front-End Web Development"
 		];
 		echo "<hr>";
 		echo $courses["ITP 303"];

 		// Loop through an associative array
 		echo "<hr>";
 		foreach($courses as $courseNumber => $courseName ) {
 			echo $courseNumber . ":" . $courseName;
 			echo "<br>";
 		}
 		echo "<hr>";
 		foreach($courses as $courseName ) {
 			echo $courseName;
 			echo "<br>";
 		}

 		// echo only prints strings - cant do this
 		// echo $courses;
 		// can use var_dump to quickly dump out value that a variable holds
 		var_dump($courses);

 		// older way to create arrays
 		$numbers = array(1,2,3,4);


 		// ---- SUPERGLOBALS
 		echo "<hr>";
 		var_dump($_SERVER);
 		echo "<hr>";
 		echo $_SERVER["HTTP_USER_AGENT"];

 		echo "<hr>";
 		echo "GET superglobal: ";
 		var_dump($_GET);

 		echo "<hr>";
 		echo "POST superglobal: ";
 		var_dump($_POST);


	?>
</div>

		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
		<div class="row">

			<h2 class="col-12 mt-4">Form Data</h2>

		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-3 text-right">Name:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				<?php
					if(isset($_POST["name"]) && !empty($_POST["name"])) {
						echo $_POST["name"];
					}
					else {
						echo "<div class='text-danger'>Not provided</div>";
					}
					
				?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Email:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				<?php
					if(isset($_POST["email"]) && !empty($_POST["email"])) {
						echo $_POST["email"];
					}
					else {
						echo "<div class='text-danger'>Not provided</div>";
					}
					
				?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Current Student:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				<?php
					if(isset($_POST["current-student"]) && !empty($_POST["current-student"])) {
						echo $_POST["current-student"];
					}
					else {
						echo "<div class='text-danger'>Not provided</div>";
					}
					
				?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Subscribe:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				<?php
					if(isset($_POST["subscribe"]) && !empty($_POST["subscribe"])) {

						// Loop through the values that user checked for subscribe

						// for($i = 0; $i < sizeof($_POST["subscribe"]); $i++) {
						// 	echo $_POST["subscribe"][$i] . ", ";
						// }

						foreach($_POST["subscribe"] as $subscribe) {
							echo $subscribe . ", ";
						}
						
					}
					else {
						echo "<div class='text-danger'>Not provided</div>";
					}
					
				?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Subject:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Message:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
			</div>
		</div> <!-- .row -->

		<div class="row mt-4 mb-4">
			<a href="form.php" role="button" class="btn btn-primary">Back to Form</a>
		</div> <!-- .row -->

	</div> <!-- .container -->
	
</body>
</html>