<?php

session_start();

if (!isset($_SESSION['username'])):
	header('Location: login.php');
endif;

if (isset($_POST['submit'])) {
	require "../config.php";
	require "../common.php";

	try {
		$connection = new PDO($dsn, $username, $password, $options);
		
		$new_run = array(
			"username" => $_SESSION['username'],
			"distance" => $_POST['distance'],
			"run_time" => $_POST['run_time'],
		);

		$sql = sprintf(
				"INSERT INTO %s (%s) values (%s)",
				"runs",
				implode(", ", array_keys($new_run)),
				":" . implode(", :", array_keys($new_run))
		);

		// the code above works the same as the below
		// $sql = "INSERT INTO runs (username, distance, run_time) values (:username, :distance, :run_time)";

		$statement = $connection->prepare($sql);
		$statement->execute($new_run);
	}

	catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}


?>

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
	<blockquote><?php echo $_POST['distance']; ?> miles successfully added.</blockquote>
<?php } ?>

<h2>Add a run.</h2>

<form method="post">
	<!-- <label for="username">Username</label>
	<input type="text" name="username" id="username" value="userName"> -->

	<label for="distance">Distance</label>
	<input type="text" name="distance" id="distance" value=1>

	<label for="run_time">Total Time</label>
	<input type="text" name="run_time" id="run_time" value=10>

	<input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>
