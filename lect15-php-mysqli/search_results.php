<?php
// The search through the DB actually happens here

// See what use input was passed via the GET method
var_dump($_GET);
echo "<hr>";
echo $_GET["track_name"];


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
// Set a uniform character set -- utf8
$mysqli->set_charset('utf8');

// ---- STEP 2: Generate & Submit SQL Query

$sql = "SELECT tracks.name AS track, genres.name AS genre, media_types.name AS media_type
FROM tracks
LEFT JOIN genres
	ON genres.genre_id = tracks.genre_id
LEFT JOIN media_types
	ON media_types.media_type_id = tracks.media_type_id
WHERE 1 = 1";

// A user has inputted a track name
if( isset($_GET["track_name"]) && ! empty($_GET["track_name"])) {
	// Add where clause to the base SQL statement
	$sql = $sql . " AND tracks.name LIKE '%" . $_GET["track_name"] . "%'";
}

// A user has inputted a genre
if( isset($_GET["genre"]) && ! empty($_GET["genre"])) {
	// Add where clause to the base SQL statement
	$sql = $sql . " AND tracks.genre_id = " . $_GET["genre"];
}

// A user has inputted a media type
if( isset($_GET["media_type"]) && ! empty($_GET["media_type"])) {
	// Add where clause to the base SQL statement
	$sql = $sql . " AND tracks.media_type_id = " . $_GET["media_type"];
}

// Lastly, dont forget the semicolon for the end of the SQL statement
$sql = $sql . ";";

// Good idea to echo out the sql statement before running it
echo "<hr>" . $sql . "<hr>";


// Submit the query
$results = $mysqli->query($sql);
if(!$results) {
	echo $mysqli->error;
	exit();
}


// ---- STEP 3: Display results




// ---- STEP 4: Close connection
$mysqli->close();


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<h1 class="col-12 mt-4">Song Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
	<div class="container-fluid">
		<div class="row mb-4 mt-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row">
			<div class="col-12">

				Showing 2 result(s).

			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th>Track</th>
							<th>Genre</th>
							<th>Media Type</th>
						</tr>
					</thead>
					<tbody>

<!-- <tr>
	<td>For Those About To Rock (We Salute You)</td>
	<td>Rock</td>
	<td>MPEG audio file</td>
</tr>

<tr>
	<td>Put The Finger On You</td>
	<td>Rock</td>
	<td>MPEG audio file</td>
</tr> -->

<?php while( $row = $results->fetch_assoc() ) :?>
	<tr>
		<td> <?php echo $row["track"];?> </td>
		<td> <?php echo $row["genre"];?> </td>
		<td> <?php echo $row["media_type"];?> </td>
	</tr>
<?php endwhile;?>



					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
</body>
</html>