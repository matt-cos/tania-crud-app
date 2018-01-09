<?php 
session_start();


require "../config.php";
require "../common.php";

try {
	$connection = new PDO($dsn, $username, $password, $options);

	$sql = "SELECT * 
			FROM runs
			WHERE username = 'userName'";

	$usernameeee = 'userName';

	$statement = $connection->prepare($sql);
	$statement->bindParam(':username', $usernameeee, PDO::PARAM_STR);
	$statement->execute();

	$result = $statement->fetchAll();

}

catch(PDOException $error) {
	echo $sql . "<br>" . $error->getMessage();
}

?>

<?php include "templates/header.php"; ?>

<?php if ($result && $statement->rowCount() > 0): ?>
	
	<h2>Your runs</h2>

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
		
		<?php foreach ($result as $row): ?>
			<tr>
				<td><?php echo escape($row["run_date"]); ?></td>
				<td><?php echo escape($row["distance"]); ?></td>
				<td><?php echo escape($row["run_time"]); ?></td>
				<td>XX:XX</td>
			</tr>
		<?php endforeach; ?>

		</tbody>
	</table>
	
<?php else: ?>

	<blockquote>No results found for <?php echo escape($_POST['location']); ?>.</blockquote>

<?php endif; ?>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>