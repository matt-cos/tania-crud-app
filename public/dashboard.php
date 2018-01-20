<?php 

session_start();

if (!isset($_SESSION['username'])):
	header('Location: login.php');
endif;

require "../config.php";
require "../common.php";

try {
	$connection = new PDO($dsn, $username, $password, $options);

	$username = $_SESSION['username'];

	$sql = "SELECT * FROM runs WHERE username = :username";

	$statement = $connection->prepare($sql);
	$statement->bindParam(':username', $username, PDO::PARAM_STR);
	$statement->execute();

	$result = $statement->fetchAll();

}

catch(PDOException $error) {
	echo $sql . "<br>" . $error->getMessage();
}

?>

<?php include "templates/header.php"; ?>

<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
	
	<?php include "templates/layout-header.php"; ?>
	
	<?php include "templates/sidebar.php"; ?>

	<main class="mdl-layout__content mdl-color--grey-100">
		<div class="mdl-grid demo-content">
			<div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
				
				<?php if ($result && $statement->rowCount() > 0): ?>

					<table>
						<thead>
							<tr>
								<th>Date</th>
								<th>Distance</th>
								<th>Time</th>
								<th>Pace</th>
							</tr>
						</thead>
						<tbody>
						
						<?php 

						foreach ($result as $row): 

							$miles = escape($row["distance"]);
							$run_time_in_seconds = time_to_seconds(escape($row["run_time"]));
							$seconds_per_mile = $run_time_in_seconds / $miles;

						?>
							<tr>
								<td><?php echo escape($row["run_date"]); ?></td>
								<td><?php echo $miles; ?> miles</td>
								<td><?php echo escape($row["run_time"]); ?></td>
								<td><?php echo seconds_to_time($seconds_per_mile); ?></td>

							</tr>
						<?php endforeach; ?>

						</tbody>
					</table>
					
				<?php else: ?>

					<blockquote>No results found for <?php echo $username ?>. Add a run <a href="addrun.php">here</a>.</blockquote>

				<?php endif; ?>

			</div>

			<?php include "templates/demo-content.php"; ?>
			
			<?php include "templates/cards.php"; ?>

		</div>
	</main>
</div>

<?php include "templates/svg.php"; ?>

<!-- can use wunderground API for historical weather -->
<!-- https://www.wunderground.com/weather/api/d/docs?d=data/history -->

<?php include "templates/footer.php"; ?>