<?php

session_start();

if (!isset($_SESSION['username'])):
	header('Location: login.php');
endif;

$pageName = "Add a Run";

if (isset($_POST['submit'])) {

	require "../config.php";
	require "../common.php";

	if (empty($_POST['run_date']) or empty($_POST['distance']) or empty($_POST['run_time'])) {

		echo "ya left some blanks";
		
	} else {

		try {
			$connection = new PDO($dsn, $username, $password, $options);

			$miles = escape($_POST['distance']);
			$run_time_in_seconds = time_to_seconds(escape($_POST['run_time']));
			$seconds_per_mile = $run_time_in_seconds / $miles;
			$pace = seconds_to_time($seconds_per_mile);
			
			$new_run = array(
				"username" => $_SESSION['username'],
				"distance" => $_POST['distance'],
				"run_time" => $_POST['run_time'],
				"pace"	   => $pace,
				"run_date" => $_POST['run_date'],
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

<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
	
	<?php include "templates/layout-header.php"; ?>
	
	<?php include "templates/sidebar.php"; ?>

	<main class="mdl-layout__content mdl-color--grey-100">
		<div class="mdl-grid demo-content">
			<div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
				
				<!-- <h2>Add a run.</h2> -->
				<?php if (isset($_POST['submit']) && $statement) { ?>
					<!-- success statement -->
					<blockquote><?php echo $_POST['distance']; ?> miles successfully added.</blockquote>
				<?php } ?>

				<form method="post">
					<label for="run_date">Date of Run</label>
					<input type="date" name="run_date" id="run_date">

					<label for="distance">Distance (mi)</label>
					<input type="text" name="distance" id="distance">

					<label for="run_time">Total Time</label>
					<input type="text" name="run_time" id="run_time" placeholder="XX:XX:XX" pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){2}">
					
					<input type="submit" name="submit" value="Submit">
				</form>

			</div>

			<?php include "templates/demo-content.php"; ?>
			
			<?php include "templates/cards.php"; ?>

		</div>
	</main>
</div>

<?php include "templates/svg.php"; ?>

<?php include "templates/footer.php"; ?>
