<?php

// ---- STEP 1: Establish DB connection
$host = "303.itpwebdev.com";
$user = "nayeon_db_user";
$password = "uscItp2020!"; 
$db = "nayeon_song_db";

// Connect to the database by creating an instance of the MySQLi class
$mysqli = new mysqli($host, $user, $password, $db);
// Check for DB connection errors
// connect_errno returns an integer - 0 if no erros, 1 or more if there is an error
if( $mysqli->connect_errno ) {
	echo $mysqli->connect_error;
	// Exit terminates the program. No subsequent code is run.
	exit();
}

// ---- STEP 2: Generate & Submit SQL Query
$sql = "SELECT * FROM genres;";

echo "<hr>" . $sql . "<hr>";

// Submit SQL query to the databse using a mthod called query()
// query() method submits and returns results
$results = $mysqli->query($sql);

// Check or any SQL/result errors when we get results back. $mysqli->query() will return FALSE if there were any errors with the query
if(!$results) {
	echo $mysqli->error;
	exit();
}

// dump out results real quick - we don't see all the results yet at this point, just info like num_rows, field_count, etc
var_dump($results);

// Make another query for the media types
$sql_media_types = "SELECT * FROM media_types";
$results_media_types = $mysqli->query($sql_media_types);
if(!$results_media_types) {
	echo $mysqli->error;
	exit();
}


// ---- STEP 3: Display results
echo "<hr>";
echo "Number of results: " . $results->num_rows;

// fetch_assoc() - fetches one result row as an associatve array
echo "<hr>";
// var_dump($results->fetch_assoc());

// That means if i want to see ALL the results, I need a loop!

// while( $row = $results->fetch_assoc() ) {
// 	var_dump($row);
// 	echo "<hr>";
// }


// ---- STEP 4: Close connection
$mysqli->close();





?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Search Form</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		.form-check-label {
			padding-top: calc(.5rem - 1px * 2);
			padding-bottom: calc(.5rem - 1px * 2);
			margin-bottom: 0;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Song Search Form</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">

		<form action="search_results.php" method="GET">

			<div class="form-group row">
				<label for="name-id" class="col-sm-3 col-form-label text-sm-right">Track Name:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name-id" name="track_name">
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Genre:</label>
				<div class="col-sm-9">
<select name="genre" id="genre-id" class="form-control">
	<option value="" selected>-- All --</option>

	<!-- <option value='1'>Rock</option>
	<option value='2'>Jazz</option>
	<option value='3'>Metal</option>
	<option value='4'>Alternative & Punk</option>
	<option value='5'>Rock And Roll</option> -->

	<?php
		// Run through the results and display the HTML 

		// This is one way to do it but it's very messy
		// while($row = $results->fetch_assoc()) {
		// 	echo "<option value=''>" . "<option>";
		// }

	?>

	<!-- Alternate PHP syntax -->
	<?php while($row = $results->fetch_assoc()) : ?>

		<option value="<?php echo $row['genre_id']?>">
			<?php echo $row['name'] ?>
		</option>

	<?php endwhile; ?>

</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="media-type-id" class="col-sm-3 col-form-label text-sm-right">Media Type:</label>
				<div class="col-sm-9">
					<select name="media_type" id="media-type-id" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- <option value='1'>MPEG audio file</option>
						<option value='2'>Protected AAC audio file</option> -->

						<!-- Alternate PHP syntax -->
	<?php while($row = $results_media_types->fetch_assoc()) : ?>

		<option value="<?php echo $row['media_types_id']?>">
			<?php echo $row['name'] ?>
		</option>

	<?php endwhile; ?>

					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Search</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->
		</form>
	</div> <!-- .container -->
</body>
</html>