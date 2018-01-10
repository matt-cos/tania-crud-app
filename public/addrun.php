<?php

session_start();

if (!isset($_SESSION['username'])):
	header('Location: login.php');
endif;

if (isset($_POST['submit'])) {
	require "../config.php";
	require "../common.php";

	if (empty($_POST['run_date']) or empty($_POST['distance']) or empty($_POST['run_time'])) {
		echo "ya left some blanks";
	} else {

		try {
			$connection = new PDO($dsn, $username, $password, $options);
			
			$new_run = array(
				"username" => $_SESSION['username'],
				"run_date" => $_POST['run_date'],
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
}


?>

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
	<blockquote><?php echo $_POST['distance']; ?> miles successfully added.</blockquote>
<?php } ?>

<h2>Add a run.</h2>

<form method="post">
	<label for="run_date">Date of Run</label>
	<input type="date" name="run_date" id="run_date">

	<label for="distance">Distance (mi)</label>
	<input type="text" name="distance" id="distance">

	<label for="run_time">Total Time</label>
	<input type="text" name="run_time" id="run_time" placeholder="XX:XX:XX" pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){2}">
	
	<!-- the below link will help with converting times -->
	<!-- http://www.hashbangcode.com/blog/converting-and-decimal-time-php -->

	<input type="submit" name="submit" value="Submit">
</form>

<a href="dashboard.php">View my runs</a>
<br>
<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>
