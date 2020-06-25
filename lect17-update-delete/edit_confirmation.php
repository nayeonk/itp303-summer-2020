<?php

require "config/config.php";

$isUpdated = false;


// First check that required fields have been filled out
if ( !isset($_POST['track_name']) || empty($_POST['track_name']) 
	|| !isset($_POST['genre']) || empty($_POST['genre']) ) {

	$error = "Please fill out all required fields.";
}
else {

	// 1. Connect to DB
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	// 2. Generate and submit the SQL query 

	// Cover optional field
	if ( isset($_POST['composer']) && !empty($_POST['composer']) ) {
		// $composer = "'" . $_POST['composer'] . "'";
		// No need for single quotes here because prepared statements will turn this into a string
		$composer = $_POST['composer'];
	} else {
		$composer = "null";
	}

	$sql = "UPDATE tracks
		SET name = '" . $_POST["track_name"] . "',
		genre_id = " . $_POST["genre"] . ", 
		composer =  " . $composer .
		" WHERE track_id = " . $_POST["track_id"] . ";";

	echo "<hr>" . $sql . "<hr>";

	// --- Prepared statement 
	$statement = $mysqli->prepare("UPDATE tracks SET name = ?, genre_id = ?, composer = ? WHERE track_id = ?");
	// bind the ? placeholder with the actual user input
	// first param: is the data type for each user input. one string.
	// the rest of the param is the variable that holds the user input information, in order of the ? placeholders
	$statement->bind_param("sisi", $_POST["track_name"], $_POST["genre"], $composer, $_POST["track_id"]);

	// execute the statement, aka query the DB
	$executed = $statement->execute();
	// check for errors
	if(!$executed) {
		echo $mysqli->error;
	}
	// if updated is succesful, $mysqli->affected_rows will return the number of records taht were updated. in our case, we should receive 1 because only ONE record was updated
	if($statement->affected_rows == 1) {
		$isUpdated = true;
	}
	$statement->close();

	$mysqli->close();

}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Confirmation | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item"><a href="details.php?track_id=<?php echo $_POST['track_id']; ?>">Details</a></li>
		<li class="breadcrumb-item"><a href="edit_form.php?track_id=<?php echo $_POST['track_id']; ?>">Edit</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Edit Confirmation</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

		<!-- If there is an error ($error variable is set and not empty, display $error) -->
		<?php if ( isset($error) && !empty($error) ) : ?>
			<div class="text-danger">
				<?php echo $error; ?>
			</div>
		<?php endif; ?>


		<?php if ($isUpdated) : ?>
			<div class="text-success">
				<span class="font-italic"><?php echo $_GET['track_name']; ?></span> was successfully edited.
			</div>
		<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="details.php?track_id=<?php echo $_POST['track_id']; ?>" role="button" class="btn btn-primary">Back to Details</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>